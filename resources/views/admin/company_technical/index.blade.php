@extends('admin.layout.app')

@section('title', 'Skills Master List')
@section('styles')
    <style>
        .dept-skill-count {
            margin-top: 10px;
            color: #4B5675;
            font-size: 12px;
            font-weight: 400;
            line-height: 20px;
        }

        .job-tag {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 6px 8px;
            border-radius: 10px;
            font-size: 12px;
            color: #333;
            display: inline-flex;
            align-items: center;
        }

        .job-tag .remove-tag {
            margin-left: 6px;
            cursor: pointer;
            font-weight: bold;
            color: #888;
        }

        .job-tag .remove-tag:hover {
            color: red;
        }
    </style>

    <style>
        .sort-icon svg g:hover path {
            stroke: #F7941C;
            cursor: pointer;
            transition: stroke 0.2s ease;
        }

        .user {
            display: flex;
            align-items: center;
        }

        .breadcrumb-skill {
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            padding: 8px 186px 9.75px 186px;
            background: #fff;
        }

        .heading-bread {
            color: #071437;
            font-size: 17.55px;
            font-weight: 700;
            margin: 0;
        }

        .desc-bread {
            color: #99a1b7;
            font-size: 12.35px;
            margin-top: 3.25px;
            font-weight: 400;
            margin-bottom: 0px;
        }

        .main-master-list {
            margin: 4px 0px 30px 0px;
            padding: 48.75px;
            border-radius: 8.13px;
            background: #fff;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .top-heading {
            color: #071437;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
            margin-bottom: 24px;
        }

        .master-list-inner {
            display: grid;
            grid-template-columns: 18.1% 76.7%;
            gap: 65px;
        }

        .inner-left-top {
            color: #000;
            text-align: justify;
            font-size: 14.95px;
            font-weight: 700;
            line-height: 17.94px;
            margin-bottom: 18px;
        }

        input:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }

        .search-input {
            width: 100%;
            border-radius: 4px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            height: 32px;
        }

        .list-div ul {
            padding-left: 0px;
            padding-top: 12px;
        }

        .list-div ul li {
            list-style: none;
        }

        .list-div ul li a {
            display: flex;
            padding: 9.75px 13px;
            align-items: center;
            gap: 20px;
            justify-content: space-between;
            border-bottom: 1px solid #F1F1F4;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            /* width: 248px; */
        }

        .list-div ul li a span {
            padding: 4px 8px;
            border-radius: 6.8px;
            background: #F1F1F4;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 500;
            line-height: 14px;
        }

        .list-div ul li a:hover,
        .list-div ul li a:active {
            border-radius: 6.8px;
            border-bottom: 0px;
            background: #FFF6EA;
            color: #1E2129;
            font-weight: 600;
        }

        .list-div ul li a:hover span,
        .list-div ul li a:active span {
            background: #F7941C;
            font-weight: 600;
            color: #fff;
        }

        .right-heading {
            color: #000;
            font-size: 28px;
            font-weight: 700;
            line-height: 39px;
        }

        .top-filter {
            display: flex;
            border-bottom: 1px solid #f1f1f4;
            margin-bottom: 24px;
        }

        .search-right-icon {
            font-size: 16px;
        }

        .tab-button {
            padding: 16px;
            gap: 4px;
            color: #99A1B7;
            font-size: 14px;
            font-weight: 600;
            line-height: 18px;
            cursor: pointer;
        }

        .tab-button p {
            margin: 0;
        }

        .bottom-filter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 24px;
            gap: 24px;
            /* width: 99%; */
        }

        .bottom-left-filter {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .tab-button-bottom {
            padding: 8.46px 13px;
            border-radius: 6.8px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            height: 36.92px;
            cursor: pointer;
        }

        .tab-button-bottom:hover,
        .tab-button-bottom:active {
            background: #F7941C;
            color: #fff;
            font-weight: 600;
        }

        .title-found {
            color: #4B5675;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .title-tab {
            display: flex;
            align-items: center;
        }

        .title-head {
            display: grid;
            grid-template-columns: 31.05% 48% 16.7%;
            padding: 16px;
            align-items: center;
            gap: 24px;
            border-radius: 8px 8px 0px 0px;
            border-bottom: 1px solid #f3f3f3;
            background: #fafafb;
            color: #071437;
            font-size: 16.25px;
            font-weight: 700;
            line-height: 98.462% letter-spacing: 0.5px;
        }

        .tab-star-color {
            color: #F3AC60;
        }

        .tab-star ul,
        .tab-star ul li {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 0px;
        }

        .right-title-info {
            display: grid;
            grid-template-columns: 33% 46% 16.5%;
            padding: 16px;
            align-items: center;
            border-right: 1px solid #f1f1f4;
            border-bottom: 1px solid #f1f1f4;
            border-left: 1px solid #f1f1f4;
            gap: 24px;
        }

        .action-btn {
            display: flex;
            padding: 4px 12px;
            align-items: center;
            gap: 4px;
            border-radius: 6.8px;
            border: 1px solid #99a1b7;
            background: #fff;
            color: #99a1b7;
            font-size: 12px;
            font-style: normal;
            font-weight: 700;
            line-height: 16px;
            letter-spacing: 0.5px;
            width: fit-content;
            cursor: pointer;
            color: #4B5675;
        }

        .bottom-right-filter {
            display: flex;
            padding: 0px 12px;
            align-items: center;
            border-radius: 4px;
            border: 1px solid #C4CADA;
            background: #FFF;
            width: 279px;
            gap: 5px;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            height: 40px;
        }

        .bottom-right-filter input {
            display: flex;
            outline: none;
            border: none;
            height: 16px;
            padding-right: 38.43px;
            align-items: center;
            flex: 1 0 0;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
        }

        .bottom-right-filter button {
            border: none;
            background: none;
            padding: 0;
            margin-top: 3px;
        }

        .title-line {
            display: flex;
            align-items: center;
            width: fit-content;
            border-radius: 3.4px;
        }

        .title-line span:first-child {
            border-radius: 3.4px 0px 0px 3.4px;
        }

        .title-line span:last-child {
            border-radius: 0px 3.4px 3.4px 0px;
        }

        .title-line span {
            width: 92px;
            height: 12px;
            background: #f7941c;
        }

        .close-header {
            display: flex;
            padding: 22.75px;
            justify-content: space-between;
            align-items: center;
            border-radius: 8.134px 8.134px 0px 0px;
            border-bottom: 1px solid #f1f1f4;
            background: #fff;
        }

        .close-header p {
            color: #000;
            font-size: 17.55px;
            font-weight: 700;
        }

        .view-main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8.13px;
            background: #fff;
        }

        .view-inner-div {
            display: flex;
            gap: 17.88px;
            flex-flow: wrap;
            margin: auto;
            padding-bottom: 22.75px;
        }

        .inner-box {
            display: flex;
            padding: 1px;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 8.13px;
            border: 1px solid rgba(153, 161, 183, 0.3);
            background: #fff;
            transition: border 0.3s;
        }

        .eye-icon {
            font-size: 14px;
        }

        .box-header {
            display: flex;
            height: 69px;
            padding: 0px 29.25px;
            gap: 5px;
            align-items: center;
            align-self: stretch;
            border-bottom: 1px solid rgba(153, 161, 183, 0.3);
            color: #071437;
            font-size: 16.575px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .input-wrapper {
            height: 36px;
            padding: 0px 12px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        /* Invalid state for inputs inside modals/forms */
        .input-wrapper.is-invalid {
            border-color: #F24130 !important; /* red */
            box-shadow: 0 0 0 4px rgba(242, 65, 48, 0.06);
        }

        .input-wrapper.is-invalid input,
        .input-wrapper.is-invalid select,
        .input-wrapper.is-invalid textarea,
        .input-wrapper.is-invalid .form-control {
            border-color: #F24130 !important;
            color: #071437;
        }

        input:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }

        .box-content-div {
            padding: 26px 29.25px;
            height: 524.75px;
        }

        .radio-wrapper {
            width: 31.5%;
        }

        .radio-wrapper input[type="radio"] {
            display: none;
        }

        /* Selected styles */
        .radio-wrapper input[type="radio"]:checked+.inner-box {
            border: 1px solid #F7941D;
        }

        .radio-wrapper input[type="radio"]:checked+.inner-box .box-header {
            background: #F7941D;
            color: #fff;
        }

        .radio-wrapper input[type="radio"]:checked+.inner-box .box-header {
            color: #FFF;
            font-size: 16.575px;
            font-weight: 700;
            line-height: 24px;
            letter-spacing: 0.15px;
            border-radius: 6px 6px 0px 0px;
        }

        .box-p {
            color: #000;
            font-size: 14.95px;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin: 0px;
        }

        .icon-desc {
            margin: 16.25px 0px 20px 0px;
        }

        .icon-desc>p {
            color: #071437;
            font-size: 16.25px;
            font-weight: 700;
            line-height: 20px;
            letter-spacing: 0.1px;
            margin: 0px;
        }

        .icon-content {
            margin-top: 13px;
        }

        .icon-text {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 6.5px;
        }

        .icon-text-check {
            display: flex;
            align-items: center;
            border-radius: 100px;
            color: #F7941D;
            padding: 4px;
            font-size: 18px;
            background: #FFF6EA;
        }

        .icon-text p {
            color: #4b5675;
            font-size: 13px;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin: 0px;
        }

        .tab-main {
            margin: 0px 187px 68px 187px;
        }

        .tabs-star-head {
            border-bottom: 1px solid #dbdfe9;
            margin-bottom: 16px;
        }

        .tabs-star-head ul {
            display: flex;
            justify-content: flex-start;
            margin-top: 16px;
        }

        .tabs-star-head ul li {
            display: flex;
            padding: 12px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            color: #99a1b7;
            font-size: 17.55px;
            font-weight: 400;
            line-height: 23.4px;
        }

        .tabs-star-head ul li.active {
            border-bottom: 3px solid #f7941c;
            color: #000;
            font-weight: 500;
            line-height: 21.06px;
        }

        .tabs-desc.active {
            display: block;
        }

        .tabs-desc {
            display: none;
        }

        .tab-header {
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #f1f1f4;
            background: #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            color: #071437;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
            padding: 24px;
        }

        .tab-content {
            border-radius: 0px 0px 8px 8px;
            border-width: 0px 1px 1px 1px;
            border-color: #f1f1f4;
            border-style: solid;
            background: #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            padding: 24px;
            display: grid;
            gap: 24px;
        }

        .tab-desc-inner ul {
            padding-left: 26px;
        }

        .tab-desc-inner ul li {
            list-style: disc;
        }

        .inner-desc-p,
        .tab-desc-inner ul li {
            color: #3e3e3e;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .tab-desc-inner>p {
            color: #3e3e3e;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .modal-title {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .tab-content-tabs {
            display: none;
        }

        .tab-content-tabs.active {
            display: block;
        }

        .tab-button.active {
            border-bottom: 1px solid #F7941C;
            color: #F7941C;
            font-weight: 600;
        }

        .app-header {
            border-bottom: 1px dashed #DBDFE9;
        }

        /* .app-container {
                                                                                                                                                                                                                        padding-left: 0px !important;
                                                                                                                                                                                                                        padding-right: 0px !important;
                                                                                                                                                                                                                    } */

        .app-wrapper {
            margin-top: 75px !important;
        }

        .flex-root {
            background-color: #FAFAFB
        }

        .select-wrapper {
            position: relative;
        }

        .sector-wrapper,
        .category-wrapper {
            width: 279px;
        }

        .select-box,
        .jobdesc-select-box {
            display: flex;
            height: 40px;
            padding: 0px 12px;
            align-items: center;
            border-radius: 4px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            justify-content: space-between;
        }

        .select-box {
            width: 100%;
        }

        .dropdown {
            position: absolute;
            top: 110%;
            left: 11px;
            right: 0;
            background: #fff;
            border: 1px solid #C4CADA;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            z-index: 99;
            padding: 12px;
            display: none;
            max-height: 300px;
            overflow-y: auto;
            max-width: 260px;
        }

        #offcanvasRight .select-wrapper .dropdown {
            max-width: 100% !important;
            left: 0px !important;
        }

        .dropdown.show {
            display: block;
        }

        .checkbox-option {
            display: flex;
            align-items: center;
            margin: 24px 0;
        }

        .checkbox-option input {
            margin-right: 8px;
        }

        .dropdown-footer {
            display: flex;
            margin-top: 10px;
            padding-top: 10px;
            gap: 12px;
            border-top: 1px solid #eee;
            justify-content: flex-end;
            position: sticky;
            bottom: -13px;
            background: #fff;
            padding-bottom: 10px;
        }

        .btn-reset,
        .btn-filter {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
        }

        .btn-reset {
            background: #fff;
            color: #5B5B5B;
        }

        .btn-filter {
            background: #F7941C;
            color: white;
        }

        .arrow {
            transform: rotate(0deg);
            transition: transform 0.3s ease;
        }

        .select-box.open .arrow {
            transform: rotate(180deg);
        }

        .jobdesc-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            max-height: 300px;
            overflow-y: auto;
            display: none;
        }

        .jobdesc-search-input {
            width: 100%;
            padding: 10px 12px;
            border: none;
            border-bottom: 1px solid #eee;
            outline: none;
            font-size: 14px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            box-sizing: border-box;
        }

        .jobdesc-checkbox-option {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            font-size: 14px;
            border-bottom: 1px solid #f2f2f2;
            cursor: pointer;
        }

        .jobdesc-dropdown-footer {
            display: flex;
            justify-content: space-between;
            padding: 10px 12px;
            border-top: 1px solid #eee;
            background-color: #fff;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .jobdesc-btn-reset {
            background: none;
            border: none;
            color: #888;
            font-size: 14px;
            cursor: pointer;
        }

        .jobdesc-btn-filter {
            background-color: #f7901e;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 6px 16px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }

        .arrow {
            font-size: 14px;
            color: #666;
        }

        .jobdesc-selected-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 12px 0;
        }

        .jobdesc-tag {
            padding: 8.46px 13px;
            border-radius: 6.8px;
            background: v#F1F1F4;
            color: #4B5675;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            border-radius: 6.8px;
            background: #F1F1F4;
            align-items: center;
            display: flex;
        }

        .jobdesc-tag button {
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: #4B5675;
        }

        .add-skill-btn {
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            background: #F7941C;
            color: #FFF;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            transition: background-color 0.3s ease;
        }

        .approve-skill-job-btn {
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            background: #F7941C;
            color: #FFF;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            transition: background-color 0.3s ease;
        }


        .breadcrumb-skill .btn-warning {
            background-color: #f7901e !important;
            border-color: #f7901e !important;
        }

        .breadcrumb-skill .btn-warning:hover {
            background-color: #e27b12 !important;
            border-color: #e27b12 !important;
        }

        .breadcrumb-skill .btn-group .btn {
            border-radius: 0 !important;
        }

        .breadcrumb-skill .btn-group .btn:first-child {
            border-top-left-radius: 6px !important;
            border-bottom-left-radius: 6px !important;
        }

        .breadcrumb-skill .btn-group .btn:last-child {
            border-top-right-radius: 6px !important;
            border-bottom-right-radius: 6px !important;
        }

        .table-container {
            background: #fff;
            border-radius: 8px;
            width: 100%;
            max-width: 100%;
            position: relative;
            overflow: visible;
            /* max-height: 60vh; */
            overflow-y: auto;
        }

        .border-main {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table-container thead {
            background: #f5f7fa !important;
            position: sticky;
            top: -0.5px;
            z-index: 2;
        }

        .table-container th,
        .table-container td {
            padding: 16px 22px !important;
            text-align: left !important;
            font-size: 14px !important;
            color: #333 !important;
            border-bottom: 1px solid #eee;
        }

        .table-container th:nth-child(1),
        .table-container td:nth-child(1),
        .table-container th:nth-child(2),
        .table-container td:nth-child(2),
        {
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
        max-width: 200px !important;
        }

        .table-container th {
            font-weight: 600 !important;
            padding: 22px !important;
            color: #4B5675 !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            line-height: 20px !important;
        }

        .table-container th:nth-child(1),
        .table-container td:nth-child(1) {
            width: 20% !important;
            border-radius: 8px 0px 0px 0px !important;
        }

        .table-container th:nth-child(3),
        .table-container td:nth-child(3),
        .table-container th:nth-child(2),
        .table-container td:nth-child(2) {
            width: 13.5% !important;
        }

        .table-container th:nth-child(4),
        .table-container td:nth-child(4) {
            width: 11% !important;
        }

        /* .table-container th:nth-child(n+3):nth-child(-n+4),
                                            .table-container td:nth-child(n+3):nth-child(-n+4) {
                                                width: 7% !important;
                                                text-align: center !important;
                                            } */

        .table-container th:last-child,
        .table-container td:last-child {
            width: 8% !important;
            border-radius: 0px 8px 0px 0px !important;
            position: relative !important;
            text-align: center !important;

        }

        .table-container .star-header {
            color: #f7941d !important;
            position: relative;
            top: 2px;
        }

        .table-container .checkmark {
            color: #28c76f !important;
            font-size: 16px !important;
            font-weight: bold !important;
            text-align: center !important;
        }

        .table-container #profiles-table th:nth-child(1),
        .table-container #profiles-table th:nth-child(2),
        .table-container #profiles-table th:nth-child(3),
        .table-container #profiles-table th:nth-child(4) {
            position: sticky;
            background-color: #DBDFE9 !important;
            text-align: left !important;
            max-width: 200px !important;
            min-width: 200px !important;
            z-index: 1;
            border-right: 1px solid #fff;
        }

        .table-container #profiles-table td:nth-child(1),
        .table-container #profiles-table td:nth-child(2),
        .table-container #profiles-table td:nth-child(3),
        .table-container #profiles-table td:nth-child(4) {
            position: sticky;
            background-color: #fff !important;
            z-index: 1;
            max-width: 200px !important;
            min-width: 200px !important;
        }

        .table-container #profiles-table th:nth-child(1),
        .table-container #profiles-table td:nth-child(1) {
            left: -1px;
        }

        .table-container #profiles-table th:nth-child(2),
        .table-container #profiles-table td:nth-child(2) {
            left: 48px;
        }

        .table-container #profiles-table th:nth-child(3),
        .table-container #profiles-table td:nth-child(3) {
            left: 247px;
            max-width: 100px !important;
            min-width: 100px !important;
        }

        .table-container #profiles-table th:nth-child(4),
        .table-container #profiles-table td:nth-child(4) {
            left: 446px;
        }

        .table-container #profiles-table th {
            background-color: #fff;
        }

        .table-container #profiles-table td:nth-child(n+3):nth-child(-n+8),
        .table-container #profiles-table td:last-child {
            text-align: left !important
        }

        .actions {
            position: relative;
            overflow: visible;
            margin: auto;
            top: 4.5px;
        }

        .action-btn {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 18px;
            padding: 4px;
            margin: auto;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            /* right: 0; */
            top: 55px;
            background: #ffffff;
            border-radius: 6px;
            border: 1px solid #f0f0f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            z-index: 999;
            min-width: 180px;
            padding: 8px 0;
            left: -90px;
        }

        .dropdown-menu .dropdown-pointer {
            position: absolute;
            right: -8px;
            top: 14px;
            width: 0;
            height: 0;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-left: 8px solid #f7941d;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 16px;
            font-size: 13px;
            color: #333;
            text-decoration: none;
            transition: background 0.2s;
        }

        .dropdown-menu a:hover {
            background-color: #fff4ea;
            font-weight: 500;
            color: #000;
        }

        .search-form {
            width: 100%;
            max-width: 300px;
        }

        .search-wrapper {
            position: relative;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 10px 36px 10px 22px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            color: #334155;
            outline: none;
            transition: border-color 0.3s;
            overflow: hidden;
        }

        .search-input:focus {
            border-color: #F7941C;
        }

        .search-button {
            position: absolute;
            /* right: 10px; */
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .search-icon {
            font-size: 18px;
            color: #64748b;
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
            color: #fff !important;
        }

        .btn-view-skill {
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

        .right-heading-title {
            color: #071437;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
            margin-bottom: 12px;

        }

        input:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
    <style>
        .pagination .page-link {
            color: #78829D;
            border: none;
        }

        .pagination .page-link:hover {
            background-color: #f1f1f1;
            color: #78829D;
        }

        .pagination .page-item.active .page-link {
            background-color: #FABB6E !important;
            border-color: #FABB6E !important;
            color: #FFF !important;
        }

        input[type="checkbox"]:checked {
            accent-color: #f7901e;
            color: #f7901e;
        }

        .view-btn {
            display: flex;
            padding: 4px 12px;
            align-items: center;
            gap: 4px;
            border-radius: 6.8px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 700;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .view-btn:hover {
            border-color: #999;
            background-color: #f9f9f9;
        }

        .category-item.active {
            color: #F7941C;
            font-weight: 600;
            border-radius: 6.8px;
            border-bottom: 0px;
            background: #FFF6EA;
            color: #1E2129;
            font-weight: 600;
        }

        .bg-active {
            background-color: #F7941C !important;
            color: #FFF7ED !important;

        }
    </style>
    <style>
        .feedback-message {
            justify-content: space-between;
            display: none;
            border-radius: 8px;
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            padding: 24px;
        }

        .alert-dismissible .close {
            top: 4px !important;
            font-size: 2.5rem !important;
            font-weight: 300 !important;
        }

        .feedback-message p {
            color: #071437;
            font-size: 13.975px;
            line-height: 16.77px;
        }

        .feedback-message .icon,
        .alert-dismissible .close {
            color: #78829D;
        }

        .kt_app_content {
            margin-top: 40px !important;
        }

        .letter-scroll-wrapper {
            display: flex;
            align-items: center;
            gap: 4px;
            overflow: hidden;
            position: relative;
        }

        .letter-scroll-inner {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            max-width: 367px;
            /* width to fit ~7 letters; adjust as needed */
            padding: 4px 0;
            scrollbar-width: none;
            /* hide scrollbar (Firefox) */
            gap: 10px;
        }

        .letter-scroll-inner::-webkit-scrollbar {
            display: none;
            /* hide scrollbar (Chrome) */
        }

        .scroll-btn {
            background-color: #f3f3f3;
            border: none;
            font-size: 18px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .jobskill-th {
            font-size: 12px !important;
            font-weight: 400 !important;
            line-height: 20px !important;
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .truncate-3-lines {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            line-height: 1.5em;
            max-height: 4.5em;
            cursor: pointer;
        }

        .modal-body h4 {
            color: #071437;
            text-align: center;
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
        }

        .bg-modal-content {
            padding: 12px 18px;
            background: #F1F1F4;
            color: #071437;
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 20px;
            overflow: scroll;
            max-height: 144px;
        }

        .custom-grid-col {
            grid-template-columns: 100% !important;
        }

        .jobdesc-dropdown {
            display: none;
        }

        .jobdesc-wrapper.open .jobdesc-dropdown {
            display: block;
        }

        .sortable-header,
        .sortable-header:hover {
            color: black !important
        }

        .level-btn {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .level-btn.active {
            color: white !important;
            background: #F7941C;
            border: 1px solid #F7941C;
        }

        .alert-warning {
            display: flex;
            padding: 24px;
            align-items: center;
            color: #071437;
            font-size: 13.975px;
            font-weight: 500;
            line-height: 16.77px;
            gap: 12px;
        }

        .form-select:disabled {
            border: 1px solid #C8C8C9;
            background-color: #DBDFE9;
        }

        .table-container #profiles-table th,
        .table-container #profiles-table td {
            padding: 16px !important;
            max-width: 296px !important;
            min-width: 296px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 31px !important;
            vertical-align: middle;
        }

        .table-container #profiles-table td:nth-child(2) {
            white-space: initial !important;
            line-height: normal !important;
        }

        .table-container #profiles-table th:nth-child(1),
        .table-container #profiles-table td:nth-child(1) {
            max-width: 50px !important;
            min-width: 50px !important;
        }

        .edit-footer-btn button {
            padding: 14px 20px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .edit-footer-btn button.orange-outline {
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
        }

        .edit-footer-btn button.grey-outline {
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
        }

        .edit-footer-btn button.orange-fill {
            border: 1px solid #F7941C;
            background: #F7941C;
            color: #fff;
        }

        .badge-status {
            border-radius: 80px;
            padding: 5px 10px;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            margin: auto;
            display: flex;
            width: fit-content;
        }

        .badge-status.approved {
            background: #DDF5E2 !important;
            color: #196329 !important;
        }

        .badge-status.pending {
            background: #FFEBB4 !important;
            color: #EB8100 !important;
        }

        #profiles-container input[type=checkbox] {
            border-radius: 4px;
            border: 1px solid #99A1B7;
            width: 20px;
            height: 20px;
        }

        #profiles-container input[type=checkbox]:disabled {
            background: #DBDFE9;
            appearance: none;
            background: #DBDFE9;
            border: 1px solid #99A1B7;
        }

        #profiles-container input[type="checkbox"]:checked {
            accent-color: #f7901e;
            border: 1px solid #f7901e !important;
            color: #f7901e;
        }

        .editable-cell {
            position: relative;
        }

        .editable-cell:hover .pencil-table-icon {
            display: block;
        }

        .pencil-table-icon {
            display: none;
            cursor: pointer;
            position: absolute;
            top: 6px;
            right: 6px;
            cursor: pointer;
            display: none;
            padding: 2px;
            background: #FFF;
            color: #78829D;
            height: 24px;
            border-radius: 4px;
        }

        #profiles-container .pencil-table-icon:hover,
        .pencil-table-icon:checked {
            background: #78829D;
            color: #fff;
        }

        .bottom-render-line {
            width: 100%;
            height: 1px;
            background: #F1F1F4;
            margin: 48px 0px;
        }

        .jobskill-th .th-delete-icon {
            display: block;
            opacity: 0;
            color: #fff;
            padding: 6px;
            border-radius: 4px;
            background: #FF6355;
        }

        .jobskill-th:hover .th-delete-icon {
            display: flex;
            align-items: center;
            opacity: 1;
            cursor: pointer !important;
        }

        .scroll-text {
            color: #4B5675;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .empty-column {
            background-color: #ffe5e5 !important;
            /* light red */
        }

        .no-profile {
            background-color: #FFE0DD !important;
            /* Red background when no profile has this skill */
        }

        .select2-container {
            z-index: 99999 !important;
        }

        #selectSkill.error {
            border-color: red !important;
        }


        .form-check-input:checked {
            background-color: #F7941C;
            border-color: #F7941C;
        }

        .form-check-input:checked,
        .form-check-input[type=checkbox]:indeterminate {
            background-color: #F7941C;
            border-color: #F7941C;
        }


        .form-check:not(.form-switch) .form-check-input[type=checkbox] {
            background-size: 85% 85%;
        }

        #EditSkillPopup .modal-header {
            border-bottom: none;
            padding-bottom: 0px;
        }

        .modal-footer {
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
            margin: 16px auto 24px auto;
            color: #071437;
            text-align: center;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }

        .custom-popup-body p {
            color: #4B5675;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 24px;
            text-align: left !important;
        }

        .manually-radio {
            position: relative;
            width: 50%;
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
            height: 160px;
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

        .custom-btn {
            /* height: 35px; */
            padding: 14px 20px;
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
            border: 1px solid #F7941C !important;
        }

        .orange-outline-popup {
            border: 1px solid #F7941C !important;
            background: #FFF;
            color: #F7941C;
        }

        .disable-grey-popup {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .grey-outline-popup {
            border: 1px solid #99A1B7 !important;
            background: #FFF;
            color: #78829D;

        }

        #DuplicateSkillPopup .form-control {
            display: flex;
            height: 36px;
            padding: 0px 12px;
            align-items: center;
            align-self: stretch;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background: #FFF;
            margin-bottom: 16px;
        }

        .alert-danger {
            border-radius: 8px;
            border: 1px solid #FFC1BB;
            background: #FFE0DD;
            padding: 24px;
        }

        .alert-danger {
            border-radius: 8px;
            border: 1px solid #FFC1BB;
            background: #FFE0DD;
            padding: 24px;
        }

        .flex-none-custom {
            flex: none !important;
        }

        .hidden {
            display: none !important;
        }

        .custom-checkbox {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
            color: #0A1C3C;
            font-size: 15px;
            user-select: none;
        }

        .custom-checkbox input {
            display: none;
        }

        .custom-checkbox .checkmark {
            height: 18px;
            width: 18px;
            background-color: #fff;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .custom-checkbox input:checked+.checkmark {
            background-color: #F7941C;
            border-color: #F7941C;
        }

        .custom-checkbox .checkmark::after {
            content: "";
            position: absolute;
            display: none;
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .custom-checkbox input:checked+.checkmark::after {
            display: block;
        }

        .category-item.active a {
            background-color: #FFF7ED;
            color: #F7941C;
            font-weight: 600;
            border-radius: 6.8px;
        }

        .category-item.active .category-count,
        .category-item:hover .category-count {
            background: #F7941C;
            color: #fff;
            font-weight: 600;
        }

        .category-item.active .category-title,
        .category-item:hover .category-title {
            background: none;
            color: #000;
            font-weight: 600;
            font-size: 12px;
        }

        #title-proficency,
        #category-col,
        #add-skill-btn {
            display: none;
        }


        /* Right Sidebar filter start  */
        .select-wrapper {
            position: relative;
        }

        .select-box {
            display: flex;
            height: 40px;
            padding: 0px 12px;
            align-items: center;
            border-radius: 4px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            justify-content: space-between;
        }

        .select-box.disabled {
            border: 1px solid #C4CADA;
            background: #DBDFE9;
            cursor: default;
            pointer-events: none;
        }

        .dropdown {
            position: absolute;
            top: 48px;
            background: #fff;
            border: 1px solid #C4CADA;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            z-index: 99;
            padding: 12px;
            display: none;
            max-height: 300px;
            overflow-y: auto;
            width: 100%;
            display: none;
        }

        .dropdown.show {
            display: block;
        }

        .checkbox-option {
            display: flex;
            align-items: center;
            margin: 24px 0;
        }

        .checkbox-option input {
            margin-right: 8px;
        }

        .dropdown-footer {
            display: flex;
            margin-top: 10px;
            padding-top: 10px;
            gap: 12px;
            border-top: 1px solid #eee;
            justify-content: flex-end;
            position: sticky;
            bottom: -13px;
            background: #fff;
            padding-bottom: 10px;
        }

        .btn-reset,
        .btn-filter {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
        }

        .btn-reset {
            background: #fff;
            color: #5B5B5B;
        }

        .btn-filter {
            background: #F7941C;
            color: white;
        }

        .line {
            width: 2px;
            height: 25px;
            position: relative;
            left: 10px;
            background-color: #DBDFE9;
        }

        .offcanvas-body .footer-btn button {
            padding: 12px 18px;
            font-size: 12px;
            font-weight: 600;
            width: 100%;
            border-radius: 4px;
            line-height: 16px;
            background-color: #fff;
        }

        .offcanvas-body .footer-btn .clear-filter {
            border: 1px solid #99A1B7;
            color: #78829D;
        }

        .offcanvas-body .footer-btn .apply-filters {
            border: 1px solid #F7941C;
            color: #fff;
            background-color: #F7941C;
        }

        .offcanvas-body .footer-btn {
            position: absolute;
            bottom: 0px;
            width: 92%;
            padding: 24px 0px;
            background-color: #fff;
        }

        .tag-custom-chips span {
            color: #78829D;
        }

        .tag-custom-chips:hover {
            background: #4B5675;
            color: #fff;
        }

        .tag-custom-chips:hover span {
            color: #fff;
        }

        .add-skill-btn.outline {
            background-color: #fff;
            color: #F7941C;
            border: 1px solid #F7941C;
            height: 40px;
        }

        .badge-soft {
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

        }

        .badge-company {
            color: #A56313;
            background-color: #FFF5DA;
        }

        .badge-master {
            color: #125A78;
            background-color: #E3F7FF;
        }

        .span-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .offcanvas-title {
            color: #071437;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
        }

        .filter-side-heading {
            color: #071437;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            margin: 0 !important;
        }


        .filter-side-label label {
            color: #000;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .clear-filters {
            color: #99A1B7;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            cursor: pointer;
        }

        .filter-block>div {
            margin-bottom: 16px !important;
        }

        .tag-custom-chips {
            padding: 4px 12px;
            gap: 4px;
            border-radius: 80px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .tag-custom-chips span {
            color: #78829D;
        }

        .tag-custom-chips:hover {
            background: #4B5675;
            color: #fff;
        }

        .tag-custom-chips:hover span {
            color: #fff;
        }

        /* Right Sidebar filter end */
    </style>

@endsection
@section('content')

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Technical Skills Management
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Company Technical Skills</li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-5">
                <div class="navtab-btn">
                    <a href="{{ url('admin/company/sector-skills') }}"
                        class="tab-link active-tab {{ request()->is('admin/company/sector-skills') ? 'active-tab' : '' }}">
                        Company Technical Skills
                    </a>
                    <a href="{{ url('/admin/skill-management/dashboard') }}"
                        class="tab-link {{ request()->is('admin/skill-management/dashboard') ? 'active-tab' : '' }}">
                        Technical Skills Master List
                    </a>
                </div>
                <div class="line-h"></div>
                <a href="/admin/skill-management/search">
                    <button class="btn-view-skill d-flex align-items-center">
                        <iconify-icon icon="f7:sparkles" class="mr-1" width="16" height="16"></iconify-icon>
                        View Skill
                    </button>
                </a>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container">
            <section class="section mt-15">

                @if (session('alert'))
                    <x-alert :type="session('alert.type')" :message="session('alert.message')" />
                @endif

                <div class="main-master-list">

                    <div class="row col-12">
                        <div class="col-md-4">
                            <p class="top-heading">Company Technical Skills</p>
                        </div>
                        <div class="col-md-8" style="display: flex; justify-content: end; height: 44px;">
                            <div id="add-skill-btn">

                                <a id="filter-btn" class="filter-btn mx-3">
                                    <button class="add-skill-btn outline d-flex align-items-center gap-2">
                                        <iconify-icon icon="line-md:filter" width="16" height="16"></iconify-icon>
                                        <span>Filters <span class="total-filter-count"></span></span>
                                    </button>
                                </a>
                                <a href="{{ route('sector.skills.company.create') }}">
                                    <button class="add-skill-btn border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="plus-icon" width="16"
                                            height="16" fill="none" stroke="white" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M12 5v14M5 12h14" />
                                        </svg>
                                        <span id="add-skill-btn-text">Create New Technical Skill</span>
                                    </button>
                                </a>
                            </div>
                            <a id="AddJobFamilySKill" style="display: none">
                                <button class="add-skill-btn border-0" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Please select department to add technical skill" disabled  id="add-department-skill-btn">
                                    <iconify-icon icon="ic:round-plus" width="16" height="16"></iconify-icon>
                                    <span>Add Technical Skill</span>
                                </button>
                            </a>
                        </div>
                    </div>
                    {{-- master-list-inner --}}
                    <div class=" custom-grid-col" id="master-list-inner">


                        <div class="inner-right">
                            <div class="top-filter">
                                <div class="tab-button" data-tab="title">
                                    <p>By Technical Skill Title</p>
                                </div>
                                <div class="tab-button" data-tab="proficiency">
                                    <p>By Proficiency Level</p>
                                </div>
                                <div class="tab-button active" data-tab="joblevel">
                                    <p>Overview Summary</p>
                                </div>
                            </div>

                            <div id="title-proficency">
                                <div class="bottom-filter">
                                    <div class="bottom-left-filter title_filter">
                                        <div class="letter-scroll-wrapper">
                                            <button type="button" class="scroll-btn left"
                                                data-direction="left">&laquo;</button>
                                            <div id="letter-results" class="letter-scroll-inner">
                                                <a>
                                                    <div class="tab-button-bottom">
                                                        <p>ALL</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <button type="button" class="scroll-btn right"
                                                data-direction="right">&raquo;</button>
                                        </div>
                                    </div>

                                    <div class="bottom-left-filter proficiency_filter">
                                        @php $levelOptions = ['ALL', '1', '2', '3', '4', '5', '6']; @endphp
                                        @foreach ($levelOptions as $lvl)
                                            <a>
                                                <div class="tab-button-bottom" data-level="{{ $lvl }}">
                                                    <p>{{ $lvl }}</p>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div class="select-wrapper sector-wrapper" style="padding-right: 0px;">
                                            <div class="select-box sector-select" data-select="box">
                                                <span class="selected-label">0 Sector(s) selected</span>
                                                <span class="arrow">
                                                    <iconify-icon icon="fluent:chevron-down-16-filled" width="16"
                                                        height="16" style="color:#78829D;"></iconify-icon>
                                                </span>
                                            </div>
                                            <div class="dropdown" style="max-width: 268px;">
                                                <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                                                    <iconify-icon icon="stash:search-solid" width="16"
                                                        height="16"></iconify-icon>
                                                    <input type="text" class="search-field border-0"
                                                        placeholder="Search for Sector...">
                                                </div>
                                                <div class="options-list sector-options">
                                                    @foreach ($sectors as $sector)
                                                        <label class="checkbox-option">
                                                            <input type="checkbox" value="{{ $sector->id }}"
                                                                data-label="{{ $sector->name }}">
                                                            {{ $sector->name }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                                <div class="dropdown-footer">
                                                    <button class="btn-reset">Reset</button>
                                                    <button class="btn-filter">Filter</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="select-wrapper category-wrapper" style="font-size: 12px !important;">
                                            <div class="select-box category-select disabled" data-select="box">
                                                <span class="selected-label">0 Category(ies) selected</span>
                                                <span class="arrow">
                                                    <iconify-icon icon="fluent:chevron-down-16-filled" width="16"
                                                        height="16" style="color:#78829D;"></iconify-icon>
                                                </span>
                                            </div>
                                            <div class="dropdown">
                                                <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                                                    <iconify-icon icon="stash:search-solid" width="16"
                                                        height="16"></iconify-icon>
                                                    <input type="text" class="search-field border-0"
                                                        placeholder="Search for Category...">
                                                </div>
                                                <div class="options-list category-options">
                                                    <!-- Categories will be loaded dynamically -->
                                                </div>
                                                <div class="dropdown-footer">
                                                    <button class="btn-reset">Reset</button>
                                                    <button class="btn-filter">Filter</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="bottom-right-filter">
                                            <div class="search-wrapper">
                                                <button type="submit" class="search-button">
                                                    <iconify-icon icon="bx:search" class="search-icon"></iconify-icon>
                                                </button>
                                                <input type="text" name="search"
                                                    placeholder="Search Technical Skill by Title" id="search_job_title"
                                                    class="search-input" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="title-found m-0"><span id="technical_skill_found"></span> technical skills
                                        found.</p>
                                </div>

                                <div class="jobdesc-selected-tags" id="jobdesc-selected-tags"></div>
                                <div class="table-container" id="dept-tables-container"></div>
                            </div>

                            @include('admin.company_technical.job_level')
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- Add Skill Modal --}}
        <div class="modal fade" id="AddSkillPopup" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-medium">Add Technical Skill Column</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-left">
                            <p class="mb-1"><span class="fw-bolder">Division: </span><span
                                    id="add_ts_job_family_group"></span></p>
                            <p class="m-0"><span class="fw-bolder">Department: </span><span
                                    id="add_ts_job_family"></span></p>
                        </div>
                        <div class="mt-7 mb-5">
                            <label for="selectSkill" class="fw-medium fs-6 d-flex mb-2 form">Select Technical
                                Skill</label>
                            <select id="selectSkill" class="form-control mb-3 mb-lg-0 selectSkill"
                                data-placeholder="Select Technical skill" name="tech_skill">
                                <option value="" class="dark:bg-slate-700">Technical Skill</option>
                            </select>
                            <div id="selectSkillError" class="text-danger mt-1" style="display: none; color: #F24130;">
                                This field is required</div>
                        </div>
                        <div class="modal-footer justify-content-center border-0 p-0 gap-1">
                            <button type="button" class="custom-btn grey-outline-popup flex-grow-0"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="text-center custom-btn orange-fill-popup flex-grow-0"
                                id="proceedAddSkillBtn">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-skill-library.filter />
@endsection

@section('scripts')
    <script>
        // Technical Skills Manager - Optimized Version
        class TechnicalSkillsManager {
            constructor() {
                this.state = {
                    selectedDepartments: new Set(),
                    selectedJobIds: {}, // Object to store job IDs by department
                    selectedLetter: null,
                    selectedLevel: null,
                    selectedSectorIds: [],
                    selectedCategoryIds: [],
                    currentSort: 'created_at',
                    currentOrder: 'desc',
                    departmentSorting: {},
                    perPageMap: {
                        default: 10
                    },
                    currentRequestId: 0,
                    currentAbortController: null,
                    offcanvasFilters: {
                        business_unit_ids: [],
                        company_ids: [],
                        department_ids: [],
                        job_position_ids: [],
                    }
                };

                this.elements = {};
                this.debounceTimers = new Map();
                this.init();
            }



            // Cache DOM elements
            cacheElements() {
                this.elements = {
                    searchCategory: document.getElementById('search-category'),
                    categoryResults: document.getElementById('category-select'),
                    letterResults: document.getElementById('letter-results'),
                    searchJobTitle: document.getElementById('search_job_title'),
                    technicalSkillFound: document.getElementById('technical_skill_found'),
                    deptTablesContainer: document.getElementById('dept-tables-container'),
                    selectedLabel: document.getElementById('selectedLabel'),
                    dropdownMenu: document.getElementById('dropdownMenu'),
                    optionsList: document.getElementById('optionsList'),
                    addSkillBtn: document.getElementById('add-skill-btn'),
                    addSkillBtnText: document.getElementById('add-skill-btn-text'),
                    paginationLinks: document.getElementById('pagination-links')

                };
            }

            // Initialize the application
            init() {
                this.cacheElements();
                this.bindEvents();
                this.loadTechnicalSkills(1);
                this.initializeFeedbackMessage();
            }

            updateOffcanvasFilters(filterData) {
                this.state.offcanvasFilters = {
                    business_unit_ids: filterData.business_unit_ids || [],
                    company_ids: filterData.company_ids || [],
                    department_ids: filterData.department_ids || [],
                    job_position_ids: filterData.job_position_ids || [],
                };
                
                // Update job position tags immediately when filters change
                this.renderJobPositionTagsForRegularTable();
            }

            initializeTooltips() {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

                tooltipTriggerList.forEach(function(el) {
                    // Use data-bs-title instead of title
                    const title = el.getAttribute('data-bs-title');

                    // console.log(title);
                    if (title === null || title.trim() === '' || title.trim() === 'null') {
                        el.setAttribute('data-bs-title', 'Not Available');
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



            getOffcanvasFilterParams() {
                const filters = this.state.offcanvasFilters;
                const params = new URLSearchParams();

                if (filters.business_unit_ids.length > 0) {
                    params.append('business_unit_ids', filters.business_unit_ids.join(','));
                }
                if (filters.company_ids.length > 0) {
                    params.append('company_ids', filters.company_ids.join(','));
                }
                if (filters.department_ids.length > 0) {
                    params.append('department_ids', filters.department_ids.join(','));
                }
                if (filters.job_position_ids && filters.job_position_ids.length > 0) { // NEW
                    params.append('job_position_ids', filters.job_position_ids.join(','));
                }

                return params.toString();
            }

            // Bind all event listeners using event delegation where possible
            bindEvents() {

                // Remove department table job positions
                document.addEventListener('click', e => {
                    if (e.target.matches('.remove-job-position')) {
                        this.handleRemoveJobPosition(e.target);
                    }
                });
                // Remove regular table job positions
                document.addEventListener('click', e => {
                    if (e.target.matches('.remove-job-position-regular')) {
                        this.handleRemoveJobPositionFromRegularTable(e.target);
                    }
                });
                // Category search
                if (this.elements.searchCategory) {
                    this.elements.searchCategory.addEventListener('input',
                        this.debounce(e => this.filterCategories(e.target.value), 300)
                    );
                }

                // Add search functionality for sector and category dropdowns
                document.addEventListener('input', e => {
                    if (e.target.matches('.sector-wrapper .search-field')) {
                        this.filterDropdownOptions(e.target, '.sector-options');
                    }
                    if (e.target.matches('.category-wrapper .search-field')) {
                        this.filterDropdownOptions(e.target, '.category-options');
                    }
                });


                // Sector filtering
                // document.addEventListener('change', e => {
                //     if (e.target.closest('.sector-options input[type="checkbox"]')) {
                //         // console.log('sectiorrrrrrrrr')
                //         this.handleSectorChange();
                //     }
                // });

                // Category filtering
                document.addEventListener('change', e => {
                    if (e.target.closest('.category-options input[type="checkbox"]')) {
                        // console.log('categoryyyyy');

                        this.handleCategoryChange();
                    }
                });

                // Filter buttons
                document.addEventListener('click', e => {
                    if (e.target.matches('.sector-wrapper .btn-filter')) {
                        this.applySectorFilter();
                    }
                    if (e.target.matches('.category-wrapper .btn-filter')) {
                        this.applyCategoryFilter();
                    }
                });

                // Reset buttons
                document.addEventListener('click', e => {
                    if (e.target.matches('.sector-wrapper .btn-reset')) {
                        this.resetSectorFilter();
                    }
                    if (e.target.matches('.category-wrapper .btn-reset')) {
                        this.resetCategoryFilter();
                    }
                });


                // Letter filtering
                if (this.elements.letterResults) {
                    this.elements.letterResults.addEventListener('click', e => this.handleLetterClick(e));
                }

                // Search input
                if (this.elements.searchJobTitle) {
                    this.elements.searchJobTitle.addEventListener('input',
                        this.debounce(() => this.handleSearch(), 500)
                    );
                }

                // Tab switching
                document.addEventListener('click', e => {
                    if (e.target.closest('.tab-button[data-tab]')) {
                        this.handleTabSwitch(e.target.closest('.tab-button[data-tab]'));
                    }
                });

                // Level filtering
                document.addEventListener('click', e => {
                    if (e.target.closest('.tab-button-bottom[data-level]')) {
                        this.handleLevelClick(e.target.closest('.tab-button-bottom[data-level]'));
                    }
                });

                // Scroll buttons
                document.addEventListener('click', e => {
                    if (e.target.matches('.scroll-btn[data-direction]')) {
                        this.scrollLetters(e.target.dataset.direction);
                    }
                });



                document.addEventListener('click', e => {
                    if (e.target.closest('.sortable-header[data-column]')) {
                        const header = e.target.closest('.sortable-header[data-column]');
                        const column = header.dataset.column;
                        const deptId = header.dataset.dept;

                        if (deptId) {
                            // Hierarchical table sorting
                            this.handleHierarchicalSort(column, deptId);
                        } else {
                            // Regular table sorting
                            this.handleSort(column);
                        }
                    }
                });

                // Pagination
                document.addEventListener('click', e => {
                    if (e.target.matches('.pagination a[data-page]')) {
                        e.preventDefault();
                        this.loadTechnicalSkills(e.target.dataset.page);
                    }
                });

                // Action buttons and modals
                document.addEventListener('click', e => {
                    this.handleActionClicks(e);
                });

                // Close dropdowns when clicking outside

                // Department checkboxes
                if (this.elements.optionsList) {
                    this.elements.optionsList.addEventListener('change', e => {
                        if (e.target.type === 'checkbox') {

                        }
                    });
                }
            }

            handleRemoveJobPositionFromRegularTable(removeButton) {
                const jobId = parseInt(removeButton.dataset.jobId);

                if (!jobId) return;

                // Remove from offcanvas filters
                if (this.state.offcanvasFilters.job_position_ids) {
                    const index = this.state.offcanvasFilters.job_position_ids.indexOf(jobId);
                    if (index > -1) {
                        this.state.offcanvasFilters.job_position_ids.splice(index, 1);
                    }
                }

                // Update the offcanvas UI
                this.updateOffcanvasJobPositionSelection();

                // Reload technical skills with updated filters
                this.loadTechnicalSkills(1);
            }
            // Utility: Debounce function
            debounce(func, delay) {
                return (...args) => {
                    const key = func.name || 'anonymous';
                    clearTimeout(this.debounceTimers.get(key));
                    this.debounceTimers.set(key, setTimeout(() => func.apply(this, args), delay));
                };
            }

            // Filter dropdown options based on search input
            filterDropdownOptions(searchInput, optionsSelector) {
                const term = searchInput.value.toLowerCase().trim();
                const optionsContainer = document.querySelector(optionsSelector);
                if (!optionsContainer) return;

                const checkboxOptions = optionsContainer.querySelectorAll('.checkbox-option');
                checkboxOptions.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    option.style.display = text.includes(term) ? '' : 'none';
                });
            }

            // Handle category filtering
            // Handle sector selection change
            handleSectorChange() {
                const sectorCheckboxes = document.querySelectorAll('.sector-options input[type="checkbox"]:checked');
                this.state.selectedSectorIds = Array.from(sectorCheckboxes).map(cb => parseInt(cb.value));

                // Update sector label
                const sectorLabel = document.querySelector('.sector-wrapper .selected-label');
                if (sectorLabel) {
                    sectorLabel.textContent = `${this.state.selectedSectorIds.length} Sector(s) selected`;
                }

                // Enable/disable category dropdown
                const categoryWrapper = document.querySelector('.category-wrapper');
                const categorySelect = categoryWrapper.querySelector('.category-select');

                if (this.state.selectedSectorIds.length > 0) {
                    categorySelect.classList.remove('disabled');
                    this.loadCategoriesForSectors(this.state.selectedSectorIds);
                } else {
                    categorySelect.classList.add('disabled');
                    this.clearCategories();
                }
            }

            // Handle category selection change
            handleCategoryChange() {
                const categoryCheckboxes = document.querySelectorAll(
                    '.category-options input[type="checkbox"]:checked');
                this.state.selectedCategoryIds = Array.from(categoryCheckboxes).map(cb => parseInt(cb.value));

                // Update category label
                const categoryLabel = document.querySelector('.category-wrapper .selected-label');
                if (categoryLabel) {
                    categoryLabel.textContent = `${this.state.selectedCategoryIds.length} Category(ies) selected`;
                }
            }

            // Load categories for selected sectors
            async loadCategoriesForSectors(sectorIds) {
                if (sectorIds.length === 0) return;

                try {
                    showOverlay();
                    const response = await fetch(`/admin/ajax/technical-skill-category/${sectorIds.join(',')}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) throw new Error('Failed to fetch categories');

                    const categories = await response.json();

                    // Update category options
                    const categoryOptions = document.querySelector('.category-options');
                    categoryOptions.innerHTML = '';

                    categories.forEach(category => {
                        const isChecked = this.state.selectedCategoryIds.includes(category.id);
                        categoryOptions.innerHTML += `
                <label class="checkbox-option">
                    <input type="checkbox" value="${category.id}" data-label="${category.title}" ${isChecked ? 'checked' : ''}>
                    ${category.title}
                </label>
            `;
                    });

                    hideOverlay();
                } catch (error) {
                    console.error('Error loading categories:', error);
                    hideOverlay();
                }
            }

            // Clear categories
            clearCategories() {
                this.state.selectedCategoryIds = [];
                const categoryOptions = document.querySelector('.category-options');
                categoryOptions.innerHTML = '';

                // Clear category search input
                const categorySearchInput = document.querySelector('.category-wrapper .search-field');
                if (categorySearchInput) {
                    categorySearchInput.value = '';
                }

                const categoryLabel = document.querySelector('.category-wrapper .selected-label');
                if (categoryLabel) {
                    categoryLabel.textContent = '0 Category selected';
                }
            }

            // Apply sector filter
            applySectorFilter() {
                // Close dropdown
                document.querySelector('.sector-wrapper .dropdown').style.display = 'none';

                // Reload technical skills with sector filter
                this.handleSectorChange();
                this.loadTechnicalSkills(1);
            }

            // Apply category filter
            applyCategoryFilter() {
                // Close dropdown
                document.querySelector('.category-wrapper .dropdown').style.display = 'none';

                // Reload technical skills with category filter
                this.loadTechnicalSkills(1);
            }

            // Reset sector filter
            resetSectorFilter() {
                this.state.selectedSectorIds = [];
                this.state.selectedCategoryIds = [];

                // Uncheck all sector checkboxes
                document.querySelectorAll('.sector-options input[type="checkbox"]').forEach(cb => cb.checked = false);

                // Clear search input and reset option visibility
                const sectorSearchInput = document.querySelector('.sector-wrapper .search-field');
                if (sectorSearchInput) {
                    sectorSearchInput.value = '';
                    // Show all options after clearing search
                    document.querySelectorAll('.sector-options .checkbox-option').forEach(option => {
                        option.style.display = '';
                    });
                }

                // Update label
                document.querySelector('.sector-wrapper .selected-label').textContent = '0 Sector(s) selected';

                // Disable and clear categories
                document.querySelector('.category-wrapper .category-select').classList.add('disabled');
                this.clearCategories();

                // Reload technical skills
                this.loadTechnicalSkills(1);
            }

            // Reset category filter
            resetCategoryFilter() {
                this.state.selectedCategoryIds = [];

                // Uncheck all category checkboxes
                document.querySelectorAll('.category-options input[type="checkbox"]').forEach(cb => cb.checked = false);

                // Clear search input and reset option visibility
                const categorySearchInput = document.querySelector('.category-wrapper .search-field');
                if (categorySearchInput) {
                    categorySearchInput.value = '';
                    // Show all options after clearing search
                    document.querySelectorAll('.category-options .checkbox-option').forEach(option => {
                        option.style.display = '';
                    });
                }

                // Update label
                document.querySelector('.category-wrapper .selected-label').textContent = '0 Category selected';

                // Reload technical skills
                this.loadTechnicalSkills(1);
            }


            // Handle letter filtering
            handleLetterClick(event) {
                const letterBtn = event.target.closest('.tab-button-bottom');
                if (!letterBtn) return;

                this.state.selectedLetter = letterBtn.querySelector('p').textContent.trim();
                if (this.state.selectedLetter === 'ALL') this.state.selectedLetter = null;



                // Update visual state
                this.elements.letterResults.querySelectorAll('.tab-button-bottom').forEach(btn => {
                    btn.classList.remove('bg-active');
                });
                letterBtn.classList.add('bg-active');

                this.loadTechnicalSkills(1, this.state.selectedLetter, this.state.selectedLevel);
            }

            // Handle level filtering
            handleLevelClick(levelBtn) {
                const level = levelBtn.querySelector('p')?.textContent?.trim();
                if (!level) return;

                // Update visual state
                document.querySelectorAll('.proficiency_filter .tab-button-bottom').forEach(btn => {
                    btn.classList.remove('bg-active');
                });
                levelBtn.classList.add('bg-active');


                this.state.selectedLevel = level === 'ALL' ? null : level;
                this.loadTechnicalSkills(1, this.state.selectedLetter, this.state.selectedLevel);
            }

            // Handle search
            handleSearch() {

                this.loadTechnicalSkills(1, this.state.selectedLetter, this.state.selectedLevel);
            }

            // Handle tab switching
            handleTabSwitch(tabElement) {
                const tab = tabElement.dataset.tab;

                // Update visual state
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                tabElement.classList.add('active');

                // Show/hide appropriate filters
                document.querySelectorAll('.bottom-left-filter').forEach(filter => filter.style.display = 'none');

                if (tab !== 'joblevel') {
                    const activeFilter = document.querySelector(`.${tab}_filter`);
                    if (activeFilter) activeFilter.style.display = 'flex';

                    document.getElementById('title-proficency').style.display = 'block';
                    document.getElementById('joblevel').style.display = 'none';
                    // document.getElementById('master-list-inner').classList.remove('custom-grid-col');
                    // document.getElementById('category-col').style.display = 'block';
                    this.elements.addSkillBtn.style.display = 'flex';
                    document.getElementById('AddJobFamilySKill').style.display = 'none';

                    // this.setFirstCategoryActive();
                } else {
                    document.getElementById('title-proficency').style.display = 'none';
                    document.getElementById('joblevel').style.display = 'block';
                    // document.getElementById('master-list-inner').classList.add('custom-grid-col');
                    // document.getElementById('category-col').style.display = 'none';
                    this.elements.addSkillBtn.style.display = 'none';

                    const sectorSelect = document.getElementById('sector');
                    if (sectorSelect?.value) {
                        document.getElementById('AddJobFamilySKill').style.display = 'block';
                    }
                }

                // Update URL
                const url = new URL(window.location.href);
                url.searchParams.set('tab', tab);
                window.history.pushState({}, '', url);

                this.state.selectedLetter = null;
                this.loadTechnicalSkills(1);
            }

            // Set first category as active
            setFirstCategoryActive() {
                const categoryItems = this.elements.categoryResults.querySelectorAll('.category-item');
                categoryItems.forEach(item => item.classList.remove('active'));
                if (categoryItems[0]) {
                    categoryItems[0].classList.add('active');
                    categoryItems[0].scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

            // Handle sorting
            handleSort(column) {
                if (this.state.currentSort === column) {
                    this.state.currentOrder = this.state.currentOrder === 'desc' ? 'asc' : 'desc';
                } else {
                    this.state.currentSort = column;
                    this.state.currentOrder = 'desc';
                }

                this.updateSortIcons(column, this.state.currentOrder);
                this.loadTechnicalSkills(
                    1,
                    this.state.selectedLetter,
                    this.state.selectedLevel,
                    this.state.currentSort,
                    this.state.currentOrder
                );
            }

            // Update sort icons
            updateSortIcons(column, order) {
                // Reset all sort icons
                document.querySelectorAll(
                        '.sortable-header .sort-icon .sort-up path, .sortable-header .sort-icon .sort-down path')
                    .forEach(path => path.style.stroke = 'grey');

                // Update active sort icon
                const header = document.querySelector(`.sortable-header[data-column="${column}"]`);
                if (header) {
                    const upPath = header.querySelector('.sort-icon .sort-up path');
                    const downPath = header.querySelector('.sort-icon .sort-down path');

                    if (order === 'asc') {
                        upPath.style.stroke = 'orange';
                        downPath.style.stroke = 'grey';
                    } else {
                        upPath.style.stroke = 'grey';
                        downPath.style.stroke = 'orange';
                    }
                }
            }

            // Scroll letters
            scrollLetters(direction) {
                const container = this.elements.letterResults;
                const scrollAmount = 100;

                if (direction === 'left') {
                    container.scrollLeft -= scrollAmount;
                } else {
                    container.scrollLeft += scrollAmount;
                }
            }

            // Toggle department dropdown



            handleRemoveJobPosition(removeButton) {
                const jobId = removeButton.dataset.jobId;

                if (!jobId) return;

                // Remove from offcanvas filters
                if (this.state.offcanvasFilters.job_position_ids) {
                    const index = this.state.offcanvasFilters.job_position_ids.indexOf(parseInt(jobId));
                    if (index > -1) {
                        this.state.offcanvasFilters.job_position_ids.splice(index, 1);
                    }
                }

                // Update the offcanvas UI if it's open
                this.updateOffcanvasJobPositionSelection();

                // Reload technical skills with updated filters
                this.loadTechnicalSkills(1);
            }

            updateOffcanvasJobPositionSelection() {
                // Update checkboxes in offcanvas
                const jobPositionCheckboxes = document.querySelectorAll(
                    '[data-list="job_position"] input[type="checkbox"]');
                jobPositionCheckboxes.forEach(cb => {
                    const jobId = parseInt(cb.value);
                    cb.checked = this.state.offcanvasFilters.job_position_ids.includes(jobId);
                });

                // Update offcanvas labels and counts
                const jobPositionBlock = document.querySelector('[data-key="job_position"]');
                if (jobPositionBlock) {
                    this.updateOffcanvasSectionDisplay(jobPositionBlock);
                }
            }

            updateOffcanvasSectionDisplay(block) {
                const sectionName = block.getAttribute('data-type');
                const label = block.querySelector('.selected-label');
                const countSpan = block.querySelector('.filter-count');
                const tags = block.querySelector('[data-tags]');
                const checked = block.querySelectorAll('.options-list input[type="checkbox"]:checked');

                if (label) label.textContent = `${checked.length} ${sectionName}(s) selected`;
                if (countSpan) countSpan.textContent = `(${checked.length})`;

                // Update tags
                if (tags) {
                    tags.innerHTML = '';
                    checked.forEach(cb => {
                        const chip = document.createElement('span');
                        chip.className = 'tag-custom-chips mr-1 d-flex align-items-center';
                        chip.textContent = cb.dataset.label;
                        const x = document.createElement('span');
                        x.className = 'cursor-pointer mt-1';
                        x.innerHTML = '<iconify-icon icon="maki:cross" width="12" height="12"></iconify-icon>';
                        x.onclick = () => {
                            cb.checked = false;
                            const block = cb.closest('.filter-block');
                            this.handleOffcanvasFilterChange(block);
                        };
                        chip.appendChild(x);
                        tags.appendChild(chip);
                    });
                }
            }

            handleOffcanvasFilterChange(block) {
                const key = block.dataset.key;
                const checked = Array.from(block.querySelectorAll('.options-list input[type="checkbox"]:checked'))
                    .map(cb => parseInt(cb.value));

                if (key === 'job_position') {
                    this.state.offcanvasFilters.job_position_ids = checked;
                }

                this.updateOffcanvasSectionDisplay(block);
                this.loadTechnicalSkills(1);
            }


            // Update letter active state
            updateLetterActiveState() {
                this.elements.letterResults.querySelectorAll('.tab-button-bottom').forEach(btn => {
                    btn.classList.remove('bg-active');
                    if (btn.textContent.trim() === 'ALL') {
                        btn.classList.add('bg-active');
                    }
                });
            }



            // Handle action button clicks
            handleActionClicks(event) {
                const target = event.target;

                // Action dropdown toggle
                if (target.matches('.action-btn')) {
                    this.toggleActionDropdown(target);
                }

                // Delete skill
                if (target.matches('.delete-skill-btn')) {
                    this.handleDeleteSkill(target);
                }

                // Edit skill
                if (target.matches('.edit-skill-btn')) {
                    this.handleEditSkill(target);
                }

                if (target.matches('.create-company-skill-btn')) {
                    this.handleCreateCompanySkill(target);
                }


            }

            // Toggle action dropdown
            toggleActionDropdown(button) {
                const menu = button.nextElementSibling;

                // Close all other dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m !== menu) m.style.display = 'none';
                });

                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            }

            // Handle delete skill
            handleDeleteSkill(target) {
                const skillId = target.dataset.skillId;
                const skillName = target.dataset.skillName;
                const skillType = target.dataset.skillType;


                // Implementation for delete skill modal
                ModalManager.open({
                    module: 'company_skill_library',
                    key: "delete_technical_skill",
                    data: {
                        skillId: skillId,
                        skillName: skillName,
                        skillType: skillType,

                    },
                    onSubmit(modalEl1) {

                        showOverlay();

                        const deleteForm = modalEl1.querySelector('#deleteSkillForm');
                        deleteForm.submit(); // Submit the form programmatically

                        const bsModal = bootstrap.Modal.getInstance(modalEl1);
                        bsModal.hide(); // Hide the modal after form submission
                    },
                    onShown(modalEl) {
                        // Fetch related jobs once the modal is shown
                        fetch(`/admin/company/sector-skills/related-jobs/${skillId}`, {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json',
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Update modal content
                                document.getElementById('affectedJobList').textContent =
                                    data.affectedJobs.length ?
                                    data.affectedJobs.join(', ') :
                                    'No jobs are associated with this skill.';

                                document.getElementById('skillToDeleteName').textContent =
                                    skillName;
                            })
                            .catch(error => {
                                console.error('Error fetching related jobs:', error);
                            });
                    }
                });
                // This would integrate with your existing ModalManager
            }



            // Handle edit skill
            handleEditSkill(target) {
                const skillId = target.dataset.skillId;
                const skillName = target.dataset.skillName;
                const skillType = target.dataset.skillType;


                showOverlay();

                fetch(`/admin/company/sector-skills/related-jobs/${skillId}`)
                    .then(response => response.json())
                    .then(data => {
                        hideOverlay();
                        const jobCount = data.affectedJobs?.length || data.count || 0;

                        ModalManager.open({
                            module: 'company_skill_library',
                            key: "edit_technical_skill",
                            data: {
                                jobLevelCount: jobCount,
                            },
                            onSubmit(modalEl) {
                                const selectedRadio = modalEl.querySelector(
                                    '.modal-body input[type="radio"]:checked');

                                if (selectedRadio) {
                                    const radioValue = selectedRadio
                                        .value; // Get the value of the selected radio button
                                    console.log('Radio Value:', radioValue);

                                    if (radioValue === 'duplicate') {

                                        ModalManager.open({
                                            module: 'company_skill_library',
                                            key: "duplicate_technical_skill",
                                            data: {
                                                skillName: skillName,
                                                skillType: skillType
                                            },
                                            onSubmit(modalEl1) {
                                                const newTitle = document
                                                    .getElementById('skillInput')
                                                    .value.trim();

                                                const errorText = document
                                                    .getElementById(
                                                        'errorText');

                                                if (!newTitle) {
                                                    errorText.textContent = 'This field is required';
                                                    errorText.style.display = 'block';
                                                    return;
                                                }

                                                errorText.style.display = 'none';

                                                // Show loading state
                                                const submitButton = modalEl1.querySelector('[data-modal-submit]');
                                                const originalText = submitButton.textContent;
                                                submitButton.disabled = true;
                                                submitButton.textContent = 'Validating...';

                                                // Validate title via AJAX
                                                fetch(`/admin/company/sector-skills/validate-duplicate-title/${skillId}`, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                    },
                                                    body: JSON.stringify({
                                                        new_title: newTitle
                                                    })
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.exists) {
                                                        // Show error if title exists
                                                        errorText.textContent = data.message;
                                                        errorText.style.display = 'block';

                                                        // Make the field border red by adding is-invalid to the wrapper
                                                        const wrapper = modalEl1.querySelector('#skillInput')?.closest('.manually-modal-inner') || modalEl1.querySelector('#skillInput')?.closest('.input-wrapper') || modalEl1.querySelector('#skillInput')?.parentElement;
                                                        if (wrapper) wrapper.classList.add('is-invalid');

                                                        // Ensure aria-invalid for accessibility
                                                        const skillInputEl = modalEl1.querySelector('#skillInput');
                                                        if (skillInputEl) skillInputEl.setAttribute('aria-invalid', 'true');

                                                        // Re-enable button
                                                        submitButton.disabled = false;
                                                        submitButton.textContent = originalText;

                                                        // Remove invalid state when user types
                                                        if (skillInputEl) {
                                                            const clearInvalid = function() {
                                                                if (this.value.trim()) {
                                                                    errorText.style.display = 'none';
                                                                    skillInputEl.removeAttribute('aria-invalid');
                                                                    if (wrapper) wrapper.classList.remove('is-invalid');
                                                                    skillInputEl.removeEventListener('input', clearInvalid);
                                                                }
                                                            };
                                                            skillInputEl.addEventListener('input', clearInvalid);
                                                        }
                                                    } else {
                                                        // Title is available, proceed with duplicate
                                                        const baseUrl = `/admin/company/sector-skills/duplicate/${skillId}`;
                                                        const redirectUrl = `${baseUrl}?duplicate=true&skill_type=${skillType}&new_title=${encodeURIComponent(newTitle)}`;
                                                        window.location.href = redirectUrl;
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Validation error:', error);
                                                    errorText.textContent = 'An error occurred while validating the title. Please try again.';
                                                    errorText.style.display = 'block';
                                                    submitButton.disabled = false;
                                                    submitButton.textContent = originalText;
                                                });
                                            },
                                            onOpen(modalEl1) {
                                                // Add real-time validation to clear errors when user types
                                                const skillInput = modalEl1.querySelector('#skillInput');
                                                const errorText = modalEl1.querySelector('#errorText');

                                                if (skillInput && errorText) {
                                                    // Clear error and invalid state when user types
                                                    const handler = function() {
                                                        if (this.value.trim()) {
                                                            errorText.style.display = 'none';
                                                            this.removeAttribute('aria-invalid');
                                                            const wrapper = this.closest('.manually-modal-inner') || this.closest('.input-wrapper') || this.parentElement;
                                                            if (wrapper) wrapper.classList.remove('is-invalid');
                                                        }
                                                    };
                                                    skillInput.addEventListener('input', handler);
                                                }
                                            }
                                        });

                                        const bsModal = bootstrap.Modal.getInstance(
                                            modalEl);
                                        if (bsModal) bsModal.hide();

                                    } else if (radioValue === 'overwrite') {
                                        // If the "overwrite" option is selected, redirect the user
                                        const baseUrl =
                                            `/admin/company/sector-skills/edit/${skillId}`;
                                        const redirectUrl =
                                            `${baseUrl}?duplicate=false&skill_type=${skillType}`;
                                        window.location.href = redirectUrl;
                                        // window.location.href = `/admin/company/sector-skills/edit/${skillId}`; // Replace with the actual redirect URL
                                    }
                                } else {
                                    console.log('No radio button selected');
                                }



                            },
                            onShown(modalEl) {
                                const radios = modalEl.querySelectorAll(
                                    '.modal-body input[type="radio"]');
                                const proceedBtn = modalEl.querySelector(
                                    '#disabledProceedBtn');
                                proceedBtn.disabled = true;

                                radios.forEach(radio => {
                                    radio.addEventListener('change', () => {
                                        // Enable/Disable the button based on the selected radio option
                                        proceedBtn.disabled = !radio
                                            .checked;

                                        if (radio.checked) {
                                            proceedBtn.classList.remove(
                                                'disable-grey-popup');
                                        } else {
                                            proceedBtn.classList.add(
                                                'disable-grey-popup');
                                        }
                                    });
                                });

                            }
                        });
                        // This would integrate with your existing ModalManager
                    })
                    .catch(error => {
                        hideOverlay();
                        console.error('Error fetching related jobs:', error);
                    });

            }

            handleCreateCompanySkill(target) {
                const skillId = target.dataset.skillId;
                const skillName = target.dataset.skillName;
                const skillType = target.dataset.skillType;

                showOverlay();
                // Fetch child count first
                fetch(`/admin/ajax/skills/${encodeURIComponent(skillId)}/master-skill-children-count`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(r => r.ok ? r.json() : Promise.reject(r))
                    .then(({


                        count
                    }) => {
                        // Decide which modal key to open
                        const modalKey = count > 0 ?
                            "create_another_company_technical_skill" :
                            "create_company_technical_skill";
                        ModalManager.open({
                            module: 'company_skill_library',
                            key: modalKey,
                            data: {
                                skillName,
                                skillId
                            },
                            onSubmit(modalEl) {
                                const baseUrl = `/admin/company/sector-skills/duplicate/${skillId}`;
                                const redirectUrl = `${baseUrl}?duplicate=true&skill_type=${skillType}`;
                                window.location.href = redirectUrl;
                            },
                            onShown(modalEl) {
                                hideOverlay();
                                // const btnText = modalEl.querySelector('.submit-btn-text');
                                // const headerText = modalEl.querySelector('.header-text');
                                // const paraText = modalEl.querySelector('.para-text');
                                // headerText.textContent = 'loading...';
                            }
                        });
                    })
                    .catch(() => {
                        console.error("Failed to fetch skill children count");
                    });
            }



            // Get selected category ID
            getSelectedCategoryId() {
                // const activeCategory = this.elements.categoryResults.querySelector('.category-item.active');
                // return activeCategory?.dataset.category_id || null;
                const categorySelect = document.querySelector('select[name="category-select"]');
                console.log(categorySelect);
                return categorySelect?.value || null;
            }


            getActiveHierarchicalFilters() {
                return {
                    businessUnits: this.state.offcanvasFilters.business_unit_ids || [],
                    companies: this.state.offcanvasFilters.company_ids || [],
                    departments: this.state.offcanvasFilters.department_ids || []
                };
            }

            handleHierarchicalSort(column, deptId) {
                // Get current sort for this department
                const currentSort = this.state.departmentSorting[deptId] || {
                    sort: 'created_at',
                    order: 'desc'
                };

                let newOrder;
                if (currentSort.sort === column) {
                    newOrder = currentSort.order === 'desc' ? 'asc' : 'desc';
                } else {
                    newOrder = 'desc';
                }

                // Update department sorting state
                this.state.departmentSorting[deptId] = {
                    sort: column,
                    order: newOrder
                };

                // Update sort icons for this department
                this.updateDepartmentSortIcons(deptId, column, newOrder);

                // **CHANGED**: Use fetchDeptPage directly instead of reloadDepartmentData
                const deptWrapper = document.querySelector(`.dept-table[data-dept="${deptId}"]`);
                if (deptWrapper) {
                    // Build URL for current page with sorting parameters
                    const currentUrl = this.buildDepartmentSortUrl(deptId, 1); // Reset to page 1 when sorting
                    this.fetchDeptPage(deptWrapper, currentUrl);
                }
            }

            buildDepartmentSortUrl(deptId, page = 1) {
                const baseUrl = '/admin/company/technical/skill/fetch';
                const urlParams = new URLSearchParams();

                // Find the page parameter for this department
                const deptWrapper = document.querySelector(`.dept-table[data-dept="${deptId}"]`);
                const pageParam = deptWrapper?.querySelector('.pagination')?.dataset?.dept || `page_dept_${deptId}`;

                // Add page parameter
                urlParams.append(pageParam, page);

                // Add current search and filter parameters
                const search = encodeURIComponent(this.elements.searchJobTitle?.value || '');
                const categoryId = this.state.selectedCategoryId || '';
                const letter = this.state.selectedLetter || '';
                const level = this.state.selectedLevel || '';

                if (search) urlParams.append('search', search);
                if (categoryId) urlParams.append('category_id', categoryId);
                if (letter) urlParams.append('letter', letter);
                if (level) urlParams.append('level', level);

                // **NEW**: Add sector and category filters
                if (this.state.selectedSectorIds.length > 0) {
                    urlParams.append('sector_ids', this.state.selectedSectorIds.join(','));
                }
                if (this.state.selectedCategoryIds.length > 0) {
                    urlParams.append('filter_category_ids', this.state.selectedCategoryIds.join(','));
                }

                // **NEW**: Add sorting parameters for this department
                const deptSort = this.state.departmentSorting[deptId];
                if (deptSort) {
                    urlParams.append('sort', deptSort.sort);
                    urlParams.append('order', deptSort.order);
                }

                // Add offcanvas parameters
                const offcanvasParams = this.getOffcanvasFilterParams();
                if (offcanvasParams) {
                    const offcanvasUrlParams = new URLSearchParams(offcanvasParams);
                    offcanvasUrlParams.forEach((value, key) => {
                        urlParams.append(key, value);
                    });
                }

                // Add per-page parameter
                const perPage = this.state.perPageMap[deptId] || 10;
                urlParams.append(`per_page_dept_${deptId}`, perPage);

                return `${baseUrl}?${urlParams.toString()}`;
            }



            updateDepartmentSortIcons(deptId, column, order) {
                const deptTable = document.querySelector(`.dept-table[data-dept="${deptId}"]`);
                if (!deptTable) return;

                // Reset all sort icons in this department
                deptTable.querySelectorAll(
                        '.sortable-header .sort-icon .sort-up path, .sortable-header .sort-icon .sort-down path')
                    .forEach(path => path.style.stroke = 'grey');

                // Update active sort icon
                const header = deptTable.querySelector(`.sortable-header[data-column="${column}"]`);
                if (header) {
                    const upPath = header.querySelector('.sort-icon .sort-up path');
                    const downPath = header.querySelector('.sort-icon .sort-down path');

                    if (order === 'asc') {
                        upPath.style.stroke = 'orange';
                        downPath.style.stroke = 'grey';
                    } else {
                        upPath.style.stroke = 'grey';
                        downPath.style.stroke = 'orange';
                    }
                }
            }


            // Get common query parameters for API calls
            getCommonQueryParams() {
                const search = encodeURIComponent(this.elements.searchJobTitle.value || '');
                const categoryId = this.state.selectedCategoryId || '';
                const letter = this.state.selectedLetter || '';
                const level = this.state.selectedLevel || '';

                return `&search=${search}&category_id=${categoryId}&letter=${letter}&level=${level}`;
            }

            // Main method to load technical skills
            async loadTechnicalSkills(page, letter = null, level = null, sort = null, order = null) {
                // Cancel previous request
                if (this.state.currentAbortController) {
                    this.state.currentAbortController.abort();
                }

                this.state.currentAbortController = new AbortController();
                const requestId = ++this.state.currentRequestId;

                showOverlay();
                // console.log(this.elements.searchJobTitle.value,category_id);
                try {
                    const url = this.buildApiUrl({
                        category_id: this.state.selectedCategoryId,
                        page,
                        letter: letter || this.state.selectedLetter,
                        level: level || this.state.selectedLevel,
                        sort: sort || this.state.currentSort,
                        order: order || this.state.currentOrder,
                        search: this.elements.searchJobTitle.value,
                        perPage: this.state.perPageMap.default || 10
                    });

                    const response = await fetch(url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        signal: this.state.currentAbortController.signal
                    });

                    if (requestId !== this.state.currentRequestId) return;

                    const data = await response.json();

                    this.processSkillsData(data, page);
                    hideOverlay();

                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error('Error loading technical skills:', error);
                        hideOverlay();
                    }
                }
            }

            // Build API URL with parameters
            buildApiUrl(params) {
                const baseUrl = '/admin/company/technical/skill/fetch';
                const urlParams = new URLSearchParams();

                Object.entries(params).forEach(([key, value]) => {
                    if (value !== null && value !== undefined) {
                        if (key === 'department_ids' && Array.isArray(value)) {
                            urlParams.append(key, value.join(','));
                        } else {
                            urlParams.append(key, value);
                        }
                    }
                });

                // Add sector filter
                if (this.state.selectedSectorIds.length > 0) {
                    urlParams.append('sector_ids', this.state.selectedSectorIds.join(','));
                }

                // Add category filter (only if categories are selected)
                if (this.state.selectedCategoryIds.length > 0) {
                    urlParams.append('filter_category_ids', this.state.selectedCategoryIds.join(','));
                }

                // Add per-page parameters for departments
                Object.entries(this.state.perPageMap).forEach(([dept, value]) => {
                    if (dept !== 'default') {
                        urlParams.append(`per_page_dept_${dept}`, value);
                    }
                });

                const offcanvasParams = this.getOffcanvasFilterParams();
                if (offcanvasParams) {
                    const offcanvasUrlParams = new URLSearchParams(offcanvasParams);
                    offcanvasUrlParams.forEach((value, key) => {
                        urlParams.append(key, value);
                    });
                }


                return `${baseUrl}?${urlParams.toString()}`;
            }

            hasActiveHierarchicalFilters() {
                const filters = this.state.offcanvasFilters;

                return (
                    (filters.business_unit_ids && filters.business_unit_ids.length > 0) ||
                    (filters.company_ids && filters.company_ids.length > 0) ||
                    (filters.department_ids && filters.department_ids.length > 0)
                );
            }


            // Process skills data response
            processSkillsData(data, page) {
                if (data.visibleLetters) {
                    this.updateLetters(data.visibleLetters);
                }

                const countEl = this.elements.technicalSkillFound;
                const hasHierarchicalFilters = this.hasActiveHierarchicalFilters();

                console.log(hasHierarchicalFilters);
                if (hasHierarchicalFilters && data.skillsByDept && Object.keys(data.skillsByDept).length > 0) {

                    this.renderDeptTables(data.skillsByDept);

                    let total = 0;
                    Object.values(data.skillsByDept).forEach(dept => {
                        total += dept.pagination?.total || 0;
                    });

                    if (countEl) countEl.textContent = total;
                } else {
                    this.updateSkillsTable(data.technicalSkills);
                    if (countEl) countEl.textContent = data.technicalSkills?.total || 0;
                }

                this.updatePagination(data.pagination, page);
            }

            generateActionMenu(skill) {
                const skillId = skill.id;
                const skillName = skill.name;
                const skillType = skill.type;

                if (skillType == 0) {
                    // Master Skill (type = 0) - Limited actions
                    return `
                        <a href="/admin/company/sector-skills/view/${skillId}" class="view-skill-details-btn" data-skill-type="${skillType}" data-skill-id="${skillId}">
                           View Details
                        </a>
                        <a href="#" class="create-company-skill-btn" data-skill-name="${skillName}" data-skill-type="${skillType}" data-skill-id="${skillId}">
                           Create Company Skill
                        </a>
                        <a href="#" class="delete-skill-btn" data-skill-name="${skillName}" data-skill-type="${skillType}" data-skill-id="${skillId}">
                           Delete Technical Skill
                        </a>
                    `;
                } else {
                    // Company Skill (type != 0) - Full actions
                    return `
                        <a href="/admin/company/sector-skills/view/${skillId}" class="view-skill-details-btn" data-skill-type="${skillType}" data-skill-id="${skillId}">
                            View Details
                        </a>
                        <a href="#" class="edit-skill-btn" data-skill-name="${skillName}" data-skill-type="${skillType}" data-skill-id="${skillId}">
                           Edit Technical Skill
                        </a>
                        <a href="#" class="delete-skill-btn" data-skill-id="${skillId}" data-skill-type="${skillType}" data-skill-name="${skillName}">
                            Delete Technical Skill
                        </a>
                    `;
                }
            }
            // Update skills table
            updateSkillsTable(technicalSkills) {
                if (!technicalSkills || !technicalSkills.data) return;

                let table = this.elements.deptTablesContainer.querySelector('#skills-table');

                if (!table) {
                    this.createSkillsTable();
                    table = this.elements.deptTablesContainer.querySelector('#skills-table');
                }

                this.renderJobPositionTagsForRegularTable();
                this.initializeTooltips();
                const tableBody = table.querySelector('tbody');
                tableBody.innerHTML = '';

                if (technicalSkills.data.length === 0) {
                    tableBody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px 0; color: #999;">
                        No skills available.
                    </td>
                </tr>
                `;
                } else {
                    technicalSkills.data.forEach(skill => {
                        const row = this.createSkillRow(skill);
                        this.initializeTooltips();
                        tableBody.appendChild(row);
                    });
                }

                this.renderPaginationWithRowsDropdown(this.elements.deptTablesContainer, 'default');
            }

            renderJobPositionTagsForRegularTable() {
                const filters = this.state.offcanvasFilters;

                // Only show job position tags if ONLY job positions are selected (no hierarchy filters)
                const hasHierarchyFilters = (filters.business_unit_ids && filters.business_unit_ids.length > 0) ||
                    (filters.company_ids && filters.company_ids.length > 0) ||
                    (filters.department_ids && filters.department_ids.length > 0);

                const hasJobPositions = filters.job_position_ids && filters.job_position_ids.length > 0;

                // Find or create container for job position tags
                let tagsContainer = document.getElementById('job-position-tags-container');

                if (!tagsContainer) {
                    tagsContainer = document.createElement('div');
                    tagsContainer.id = 'job-position-tags-container';
                    tagsContainer.className = 'mb-3';

                    // Insert before the table container
                    const tableContainer = document.getElementById('dept-tables-container');
                    tableContainer.parentNode.insertBefore(tagsContainer, tableContainer);
                }

                if (!hasHierarchyFilters && hasJobPositions) {
                    // Get job position names from the offcanvas
                    const jobPositionNames = this.getJobPositionNames(filters.job_position_ids);

                    tagsContainer.innerHTML = `
                    <div class="job-position-tags">
                        <small class="text-muted d-block mb-2">Filtered by Job Positions:</small>
                        <div class="d-flex flex-wrap gap-2">
                            ${jobPositionNames.map(job => `
                                                                    <span class="badge rounded tag-custom-chips text-gray fs-7 fw-bold me-1 mb-1 position-relative" style="font-size: 0.8rem; padding-right: 1.5rem;" data-job-id="${job.id}">
                                                                       ${job.name}
                                                                        <button type="button" class="btn-close btn-close-sm fs-7 fw-bold position-absolute top-50 end-0 translate-middle-y me-1 remove-job-position-regular" 
                                                                                data-job-id="${job.id}" 
                                                                                style="font-size: 0.6rem; width: 0.8rem; height: 0.8rem;"
                                                                                aria-label="Remove ${job.name}">
                                                                        </button>
                                                                    </span>
                                                                `).join('')}
                        </div>
                    </div>
                `;
                } else {
                    tagsContainer.innerHTML = '';
                }
            }

            getJobPositionNames(jobPositionIds) {
                // Get names from the offcanvas options
                const jobPositionOptions = document.querySelectorAll(
                    '[data-list="job_position"] input[type="checkbox"]');
                const jobNames = [];

                jobPositionOptions.forEach(option => {
                    if (jobPositionIds.includes(parseInt(option.value))) {
                        jobNames.push({
                            id: parseInt(option.value),
                            name: option.dataset.label
                        });
                    }
                });

                return jobNames;
            }
            // Create skills table structure
            createSkillsTable() {
                const borderMain = document.createElement('div');
                borderMain.classList.add('border-main');

                const table = document.createElement('table');
                table.id = 'skills-table';
                table.classList.add('skills-table');
                table.innerHTML = `
            <thead>
                <tr>
                    <th>
                        <a href="javascript:void(0);" class="sortable-header" data-column="name" data-sort="asc">
                            Technical Skill Title
                            <span class="sort-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                    <g class="sort-up">
                                        <path transform="translate(0, -5)" fill="none" stroke="grey" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 14l-5-5l-5 5" />
                                    </g>
                                    <g class="sort-down">
                                        <path transform="translate(0, 5)" fill="none" stroke="grey" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10l5 5l5-5" />
                                    </g>
                                </svg>
                            </span>
                        </a>
                    </th>
                       <th>
                        <a href="javascript:void(0);" class="sortable-header" data-column="sector" data-sort="asc">
                           Sector
                            <span class="sort-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                    <g class="sort-up">
                                        <path transform="translate(0, -5)" fill="none" stroke="grey" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 14l-5-5l-5 5" />
                                    </g>
                                    <g class="sort-down">
                                        <path transform="translate(0, 5)" fill="none" stroke="grey" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10l5 5l5-5" />
                                    </g>
                                </svg>
                            </span>
                        </a>
                    </th>   
                    <th>
                        <a href="javascript:void(0);" class="sortable-header" data-column="category" data-sort="asc">
                            Category
                            <span class="sort-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                    <g class="sort-up">
                                        <path transform="translate(0, -5)" fill="none" stroke="grey" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 14l-5-5l-5 5" />
                                    </g>
                                    <g class="sort-down">
                                        <path transform="translate(0, 5)" fill="none" stroke="grey" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10l5 5l5-5" />
                                    </g>
                                </svg>
                            </span>
                        </a>
                    </th>
                    <th>
                        <a href="javascript:void(0);" class="sortable-header" data-column="custom_type" data-sort="asc">
                            Type
                            <span class="sort-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                    <g class="sort-up">
                                        <path transform="translate(0, -5)" fill="none" stroke="grey" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 14l-5-5l-5 5" />
                                    </g>
                                    <g class="sort-down">
                                        <path transform="translate(0, 5)" fill="none" stroke="grey" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10l5 5l5-5" />
                                    </g>
                                </svg>
                            </span>
                        </a>
                    </th>
                    ${[1,2,3,4,5,6].map(i => `
                                                                                                                                            <th>
                                                                                                                                                <iconify-icon icon="ic:baseline-star" width="15" height="15" class="star-header"></iconify-icon>
                                                                                                                                                ${i}
                                                                                                                                            </th>
                                                                                                                                        `).join('')}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        `;

                const paginationDiv = document.createElement('div');
                paginationDiv.classList.add('d-flex', 'align-items-center', 'justify-content-between', 'flex-wrap',
                    'gap-3', 'm-4', 'pagination-wrapper');
                paginationDiv.innerHTML = `
            <div class="d-flex align-items-center gap-2"></div>
            <nav>
                <ul class="pagination mb-0" id="pagination-links"></ul>
            </nav>
        `;

                borderMain.appendChild(table);
                borderMain.appendChild(paginationDiv);
                this.elements.deptTablesContainer.innerHTML = '';
                this.elements.deptTablesContainer.appendChild(borderMain);
            }

            // Create skill row
            createSkillRow(skill) {
                const row = document.createElement('tr');

                const actionMenu = this.generateActionMenu(skill);
                const isNew = this.isNewSkill(skill.created_at);
                const isUpdated = this.isUpdatedSkill(skill.updated_at);

                // if (isNew) {
                //     const newBadge = isNew ? '<span class="badge-status approved m-0 col-3">NEW</span>' : '';
                // } else if (isUpdated) {
                //     const updatedBadge = isUpdated ? '<span class="badge-status pending m-0 col-3">Updated</span>' : '';
                // } else {
                //     const newBadge = ''
                // }


                const typeBadge = skill.type == 0 ? '<span class="badge-soft badge-master m-0">Master Skill</span>' :
                    '<span class="badge-soft badge-company m-0">Company Skill</span>'

                row.innerHTML = `
            <td>
                <p class="m-0 row gap-3 align-items-center text-break justify-content-between">
                    <span class="col-9 p-0" style="width: 60%;">${skill.name}</span>${this.getSkillBadge(skill)}
                </p>
            </td>
              <td>
                <p class="m-0 span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill.sector_name}">
                    ${skill.sector_name}
                </p>
            </td>
               <td>
                <p class="m-0 span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill.category_name}">
                    ${skill.category_name}
                </p>
            </td>
            <td>${typeBadge}</td>
            ${[1,2,3,4,5,6].map(i => `
                                                                                                                                    <td class="checkmark">
                                                                                                                                        ${skill[`level_${i}_description`] ? '<iconify-icon icon="prime:check-circle" width="16" height="16"></iconify-icon>' : ''}
                                                                                                                                    </td>
                                                                                                                                `).join('')}
            <td class="actions text-center">
                <button class="action-btn">⋮</button>
                <div class="dropdown-menu">
                       ${actionMenu}
                  </div>
            </td>
        `;

                return row;
            }

            // Render department tables with full functionality
            renderDeptTables(skillsByDept) {
                this.elements.deptTablesContainer.innerHTML = '';

                Object.entries(skillsByDept).forEach(([deptId, deptBlock]) => {
                    const wrapper = this.createDepartmentTable(deptId, deptBlock);
                    this.elements.deptTablesContainer.appendChild(wrapper);

                    // Initialize per-page mapping
                    if (!this.state.perPageMap[deptId]) {
                        this.state.perPageMap[deptId] = 10;
                    }

                    // Setup rows per page dropdown for this department
                    this.renderPaginationWithRowsDropdown(wrapper.querySelector('.border-main'), deptId);
                });
            }

            // Create department table with full functionality
            createDepartmentTable(deptId, deptBlock) {
                const wrapper = document.createElement('div');
                wrapper.classList.add('dept-table');
                wrapper.dataset.dept = deptId;

                const jobDropdown = `
                    <div class="d-flex justify-content-between align-items-start mb-5 mt-7 flex-wrap gap-3">
                        <div class="d-flex flex-column">
                            <h4 class="m-0">${deptBlock.department}</h4>
                            <div class="dept-skill-count" data-dept-id="${deptId}"></div>
                              ${deptBlock.selected_job_positions && deptBlock.selected_job_positions.length > 0 ? `
                                                                                                            <div class="job-position-tags mt-3">
                                                                                                                <small class="text-muted d-block mb-2">Filtered by Job Positions:</small>
                                                                                                                <div class="d-flex flex-wrap gap-4">
                                                                                                                    ${deptBlock.selected_job_positions.map(job => `
                                            <span class="badge fw-medium rounded tag-custom-chips position-relative" style="font-size: 14px; padding: 8.46px 13px;" data-job-id="${job.id}">
                                                ${job.title}
                                                <span class="remove-job-position btn-close fw-bold btn-close-sm cursor-pointer mt-1" 
                                                        data-job-id="${job.id}" 
                                                        aria-label="Remove ${job.title}">
                                                </span>
                                            </span>
                                        `).join('')}
                                                                                                                                <div class="selected-job-tags d-flex flex-wrap gap-2 mt-5" data-dept-id="${deptId}"></div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        ` : ''}
                        </div>
                        <div class="select-wrapper jobdesc-wrapper" style="width: 261px;" data-dept="${deptBlock.pagination.page_param}">
                        
                        </div>
                    </div>
                `;
                const deptSort = this.state.departmentSorting[deptId] || {
                    sort: 'created_at',
                    order: 'desc'
                };

                wrapper.innerHTML = `
            ${jobDropdown}
            <div class="table-container">
                <div class="border-main">
                    <table class="table">
                       <thead>
                        <tr>
                            <th>
                                <a href="javascript:void(0);" class="sortable-header" data-column="name" data-dept="${deptId}">
                                    Technical Skill Title
                                    <span class="sort-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                            <g class="sort-up">
                                                <path transform="translate(0, -5)" fill="none" stroke="${deptSort.sort === 'name' && deptSort.order === 'asc' ? 'orange' : 'grey'}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 14l-5-5l-5 5" />
                                            </g>
                                            <g class="sort-down">
                                                <path transform="translate(0, 5)" fill="none" stroke="${deptSort.sort === 'name' && deptSort.order === 'desc' ? 'orange' : 'grey'}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10l5 5l5-5" />
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0);" class="sortable-header" data-column="sector" data-dept="${deptId}">
                                    Sector
                                    <span class="sort-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                            <g class="sort-up">
                                                <path transform="translate(0, -5)" fill="none" stroke="${deptSort.sort === 'sector' && deptSort.order === 'asc' ? 'orange' : 'grey'}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 14l-5-5l-5 5" />
                                            </g>
                                            <g class="sort-down">
                                                <path transform="translate(0, 5)" fill="none" stroke="${deptSort.sort === 'sector' && deptSort.order === 'desc' ? 'orange' : 'grey'}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10l5 5l5-5" />
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0);" class="sortable-header" data-column="category" data-dept="${deptId}">
                                    Category
                                    <span class="sort-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                            <g class="sort-up">
                                                <path transform="translate(0, -5)" fill="none" stroke="${deptSort.sort === 'category' && deptSort.order === 'asc' ? 'orange' : 'grey'}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 14l-5-5l-5 5" />
                                            </g>
                                            <g class="sort-down">
                                                <path transform="translate(0, 5)" fill="none" stroke="${deptSort.sort === 'category' && deptSort.order === 'desc' ? 'orange' : 'grey'}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10l5 5l5-5" />
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0);" class="sortable-header" data-column="custom_type" data-dept="${deptId}">
                                    Type
                                    <span class="sort-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                            <g class="sort-up">
                                                <path transform="translate(0, -5)" fill="none" stroke="${deptSort.sort === 'custom_type' && deptSort.order === 'asc' ? 'orange' : 'grey'}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 14l-5-5l-5 5" />
                                            </g>
                                            <g class="sort-down">
                                                <path transform="translate(0, 5)" fill="none" stroke="${deptSort.sort === 'custom_type' && deptSort.order === 'desc' ? 'orange' : 'grey'}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10l5 5l5-5" />
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </th>
                            ${[1,2,3,4,5,6].map(i => `<th><iconify-icon icon="ic:baseline-star" width="15" height="15" class="star-header"></iconify-icon> ${i}</th>`).join('')}
                            <th>Actions</th>
                        </tr>
                    </thead>
                        <tbody>
                            ${deptBlock.data.length === 0
                                ? `<tr><td colspan="9" style="text-align: center; padding: 40px 0; color: #999;">No skills available.</td></tr>`
                                : deptBlock.data.map(skill => `
                                                                                                                                                        <tr>
                                                                                                                                                            <td>
                                                                                                                                                                <p class="m-0 d-flex align-items-center gap-3">
                                                                                                                                                                    ${skill.name} ${this.getSkillBadge(skill)}
                                                                                                                                                                </p>
                                                                                                                                                            </td>
                                                                                                                                                             <td>
                                                                                                                                                                    <p class="m-0 span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill.sector_name}">
                                                                                                                                                                        ${skill.sector_name}
                                                                                                                                                                    </p>
                                                                                                                                                                </td>
                                                                                                                                                                <td>
                                                                                                                                                                    <p class="m-0 span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill.category_name}">
                                                                                                                                                                        ${skill.category_name}
                                                                                                                                                                    </p>
                                                                                                                                                                </td>
                                                                                                                                                       <td>${skill.type == 0 ? '<span class="badge-soft badge-master m-0">Master Skill</span>' :
                                                                                                '<span class="badge-soft badge-company m-0">Company Skill</span>'}</td>
                                                                                                                                                            ${[1,2,3,4,5,6].map(i => `
                                            <td class="checkmark">
                                                ${skill[`level_${i}_description`] ? '<iconify-icon icon="prime:check-circle" width="16" height="16"></iconify-icon>' : ''}
                                            </td>
                                        `).join('')}
                                                                                                                                                            <td class="actions text-center">
                                                                                                                                                                <button class="action-btn">⋮</button>
                                                                                                                                                                <div class="dropdown-menu">
                                                                                                                                                                     ${this.generateActionMenu(skill)}
                                                                                                                                                                </div>
                                                                                                                                                            </td>
                                                                                                                                                        </tr>
                                                                                                                                                    `).join('')}
                        </tbody>
                    </table>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 m-4 pagination-wrapper">
                        <div class="d-flex align-items-center gap-2"></div>
                        <nav>
                            <ul class="pagination" data-dept="${deptBlock.pagination.page_param}">
                                 ${this.buildPaginationHTML(deptBlock.pagination, deptId)}
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="bottom-render-line"></div>
            </div>
        `;

                // Set skill count
                const countTarget = wrapper.querySelector(`.dept-skill-count[data-dept-id="${deptId}"]`);
                if (countTarget) {
                    const count = deptBlock.pagination?.total ?? 0;
                    countTarget.innerHTML = `${count} technical skills found.`;
                }

                // Render job tags
                const jobTagContainer = wrapper.querySelector('.selected-job-tags');
                if (jobTagContainer) {
                    this.renderJobTags(deptId, jobTagContainer, deptBlock.jobs);
                }

                // Setup job dropdown functionality
                // this.setupJobDropdown(wrapper, deptId);

                // Setup pagination
                this.setupDeptPagination(wrapper);

                // Setup rows per page dropdown
                this.renderPaginationWithRowsDropdown(wrapper.querySelector('.border-main'), deptId);

                // 🔥 Initialize Bootstrap tooltips for this table
                // const tooltipTriggerList = [].slice.call(wrapper.querySelectorAll('[data-bs-toggle="tooltip"]'));
                // tooltipTriggerList.map(el => new bootstrap.Tooltip(el, { container: 'body' }));

                return wrapper;
            }



            // **CHANGED**: Updated buildPaginationHTML to include department sorting
            buildPaginationHTML(pagination, deptId = null) {
                let html = '';

                // **NEW**: Helper function to build complete URL with sorting
                const buildPaginationUrl = (page) => {
                    const baseUrl = '/admin/company/technical/skill/fetch';
                    const params = [];

                    // Add page parameter
                    params.push(`${pagination.page_param}=${page}`);

                    // Add current search parameters
                    const search = encodeURIComponent(this.elements.searchJobTitle?.value || '');
                    const categoryId = this.state.selectedCategoryId || '';
                    const letter = this.state.selectedLetter || '';
                    const level = this.state.selectedLevel || '';

                    if (search) params.push(`search=${search}`);
                    if (categoryId) params.push(`category_id=${categoryId}`);
                    if (letter) params.push(`letter=${letter}`);
                    if (level) params.push(`level=${level}`);

                    // **NEW**: Add sector and category filters
                    if (this.state.selectedSectorIds.length > 0) {
                        params.push(`sector_ids=${this.state.selectedSectorIds.join(',')}`);
                    }
                    if (this.state.selectedCategoryIds.length > 0) {
                        params.push(`filter_category_ids=${this.state.selectedCategoryIds.join(',')}`);
                    }

                    // **NEW**: Add department-specific sorting if this is a hierarchical table
                    if (deptId && this.state.departmentSorting[deptId]) {
                        const deptSort = this.state.departmentSorting[deptId];
                        params.push(`sort=${deptSort.sort}`);
                        params.push(`order=${deptSort.order}`);
                    }

                    // Add offcanvas parameters
                    const offcanvasParams = this.getOffcanvasFilterParams();
                    if (offcanvasParams) {
                        params.push(offcanvasParams);
                    }

                    // Add per-page parameter for department
                    if (deptId) {
                        const perPage = this.state.perPageMap[deptId] || 10;
                        params.push(`per_page_dept_${deptId}=${perPage}`);
                    }

                    return `${baseUrl}?${params.join('&')}`;
                };

                if (pagination.prev_url) {
                    const prevPage = pagination.current_page - 1;
                    html +=
                        `<li class="page-item"><a href="#" class="page-link" data-page-url="${buildPaginationUrl(prevPage)}">&laquo;</a></li>`;
                } else {
                    html += `<li class="page-item disabled"><span class="page-link">&laquo;</span></li>`;
                }

                // Page numbers with truncation logic (same as regular table)
                const lastPage = pagination.last_page || 1;
                const currentPageNumber = pagination.current_page || 1;
                const maxPageNumbersToShow = 5;
                let pageNumbers = [];

                if (lastPage > maxPageNumbersToShow) {
                    if (currentPageNumber <= 3) {
                        pageNumbers = [1, 2, 3, 4, '...', lastPage];
                    } else if (currentPageNumber >= lastPage - 2) {
                        pageNumbers = [1, '...', lastPage - 3, lastPage - 2, lastPage - 1, lastPage];
                    } else {
                        pageNumbers = [1, '...', currentPageNumber - 1, currentPageNumber, currentPageNumber + 1, '...', lastPage];
                    }
                } else {
                    for (let i = 1; i <= lastPage; i++) {
                        pageNumbers.push(i);
                    }
                }

                pageNumbers.forEach(page => {
                    if (page === '...') {
                        html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                    } else {
                        const activeClass = page === currentPageNumber ? 'active' : '';
                        const pageUrl = buildPaginationUrl(page);
                        html += `
                            <li class="page-item ${activeClass}">
                                <a class="page-link" href="#" data-page-url="${pageUrl}">${page}</a>
                            </li>
                        `;
                    }
                });

                if (pagination.next_url) {
                    const nextPage = pagination.current_page + 1;
                    html +=
                        `<li class="page-item"><a class="page-link" href="#" data-page-url="${buildPaginationUrl(nextPage)}">&raquo;</a></li>`;
                } else {
                    html += `<li class="page-item disabled"><span class="page-link">&raquo;</span></li>`;
                }

                return html;
            }

            // Setup job dropdown functionality
            setupJobDropdown(wrapper, deptId) {
                const jobdescSelect = wrapper.querySelector('.jobdesc-select');
                const jobdescSelectWrapper = wrapper.querySelector('.jobdesc-wrapper');
                const jobdescDropdown = wrapper.querySelector('.jobdesc-dropdown');
                const searchInput = jobdescDropdown.querySelector('input[type="text"]');
                const resetBtn = jobdescDropdown.querySelector('.btn-reset');
                const filterBtn = jobdescDropdown.querySelector('.btn-filter');
                const checkboxes = jobdescDropdown.querySelectorAll('input[type="checkbox"]');

                // Toggle dropdown
                jobdescSelect.addEventListener('click', () => {
                    jobdescSelectWrapper.classList.toggle('open');
                });

                // Search functionality
                searchInput.addEventListener('input', this.debounce(e => {
                    this.filterJobdescOptions(e.target, jobdescDropdown);
                }, 300));

                // Setup initial checkbox states
                const prevSet = this.state.selectedJobIds[deptId] || new Set();
                checkboxes.forEach(cb => {
                    if (prevSet.has(cb.value)) cb.checked = true;
                    cb.addEventListener('change', () => this.syncSelectedJobIds(deptId, wrapper));
                });

                // Reset button
                resetBtn.addEventListener('click', () => this.resetJobdescSelection(wrapper));

                // Filter button
                filterBtn.addEventListener('click', () => this.applyJobdescFilter(wrapper));

                this.updateJobdescLabel(wrapper);
            }

            // Setup department pagination
            setupDeptPagination(wrapper) {
                const paginationLinks = wrapper.querySelectorAll('.pagination a');

                paginationLinks.forEach(link => {
                    link.addEventListener('click', e => {
                        e.preventDefault();
                        const pageUrl = e.target.getAttribute('data-page-url');
                        this.fetchDeptPage(wrapper, pageUrl);
                    });
                });
            }

            // Render job tags
            renderJobTags(deptId, container, jobs) {
                const prevSelected = this.state.selectedJobIds[deptId] || new Set();
                const jobMap = (jobs || []).reduce((acc, job) => {
                    acc[job.id] = job.title;
                    return acc;
                }, {});

                container.innerHTML = Array.from(prevSelected).map(id => `
            <span class="job-tag" data-job-id="${id}" data-dept-id="${deptId}">
                ${jobMap[id] || 'Unknown'}
                <span class="remove-tag" data-job-id="${id}" data-dept-id="${deptId}">&times;</span>
            </span>
        `).join('');

                // Add event listeners to remove tags
                container.querySelectorAll('.remove-tag').forEach(tag => {
                    tag.addEventListener('click', e => {
                        const jobId = e.target.dataset.jobId;
                        const deptId = e.target.dataset.deptId;
                        this.removeJobTag(deptId, jobId);
                    });
                });
            }

            // Filter job description options
            filterJobdescOptions(input, dropdown) {
                const filter = input.value.toLowerCase();
                dropdown.querySelectorAll('.options-list label').forEach(label => {
                    const text = label.textContent.toLowerCase();
                    label.style.display = text.includes(filter) ? '' : 'none';
                });
            }

            // Sync selected job IDs
            syncSelectedJobIds(deptId, wrapper) {
                const selectedJobs = new Set();
                wrapper.querySelectorAll('.options-list input[type="checkbox"]:checked').forEach(cb => {
                    selectedJobs.add(cb.value);
                });
                this.state.selectedJobIds[deptId] = selectedJobs;
                this.updateJobdescLabel(wrapper);
            }

            // Update job description label
            updateJobdescLabel(wrapper) {
                const count = wrapper.querySelectorAll('.options-list input[type="checkbox"]:checked').length;
                const label = wrapper.querySelector('.jobdesc-label');
                if (label) {
                    label.textContent = `${count} selected`;
                }
            }

            // Reset job description selection
            resetJobdescSelection(wrapper) {
                const checkboxes = wrapper.querySelectorAll('.options-list input[type="checkbox"]:checked');
                checkboxes.forEach(cb => cb.checked = false);

                const deptParam = wrapper.querySelector('.jobdesc-wrapper').dataset.dept;
                const deptId = deptParam.replace('page_dept_', '');

                this.state.selectedJobIds[deptId] = new Set();
                this.updateJobdescLabel(wrapper);
                this.applyJobdescFilter(wrapper);
                wrapper.classList.remove('open');
            }


            // Remove job tag
            removeJobTag(deptId, jobId) {
                const wrapper = document.querySelector(`.dept-table[data-dept*="${deptId}"]`);
                if (!wrapper) return;

                const checkbox = wrapper.querySelector(`input[type="checkbox"][value="${jobId}"]`);
                if (checkbox) {
                    checkbox.checked = false;
                }

                // Re-apply filter
                this.applyJobdescFilter(wrapper);
            }

            // Fetch department page
            async fetchDeptPage(tableDiv, url) {
                console.log('fetchDeptPage', tableDiv, url)
                showOverlay();

                const deptParam = tableDiv.querySelector('.pagination').dataset.dept;
                const deptId = deptParam.replace('page_dept_', '');
                // const deptParam = tableDiv.querySelector('.pagination').dataset.dept;
                // const deptId = deptParam.replace('page_dept_', '');

                // Update pagination with sorting preserved


                // const perPage = this.state.perPageMap[deptId] || 10;

                // const selectedJobs = this.state.selectedJobIds[deptId] || new Set();
                // const jobIds = Array.from(selectedJobs).join(',');

                // // Add common parameters
                // const search = encodeURIComponent(this.elements.searchJobTitle.value);
                // const categoryId = this.state.selectedCategoryId || '';
                // const letter = this.state.selectedLetter || '';
                // const level = this.state.selectedLevel || '';
                // // const departmentIds = this.getSelectedDepartments().join(',');
                // const offcanvasParams = this.getOffcanvasFilterParams();
                // console.log('canvas vluesss', offcanvasParams);

                // let completeUrl = url;
                // completeUrl +=
                //     `&search=${search}&category_id=${categoryId}&letter=${letter}&level=${level}&per_page_dept_${deptId}=${perPage}&job_ids=${jobIds}`;

                // if (offcanvasParams) {
                //     completeUrl += `&${offcanvasParams}`;
                // }
                // const deptSort = this.state.departmentSorting?.[deptId];
                // if (deptSort) {
                //     completeUrl += `&sort=${deptSort.sort}`;
                //     completeUrl += `&order=${deptSort.order}`;
                // }
                // console.log('complete url', completeUrl);
                try {
                    const response = await fetch(url, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'

                        }
                    });

                    const data = await response.json();
                    const block = data.skillsByDept[deptId];

                    if (block) {
                        // Update table body
                        const tbody = tableDiv.querySelector('tbody');
                        tbody.innerHTML = block.data.length === 0 ?
                            `<tr><td colspan="9" style="text-align: center; padding: 40px 0; color: #999;">No skills available.</td></tr>` :
                            block.data.map(skill => `
                        <tr>
                            <td>
                                <p class="m-0 d-flex align-items-center gap-3">
                                    ${skill.name} ${this.getSkillBadge(skill)}
                                </p>
                            </td>
                                                                                 <td>
                                                                                        <p class="m-0 span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill.sector_name}">
                                                                                            ${skill.sector_name}
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="m-0 span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill.category_name}">
                                                                                            ${skill.category_name}
                                                                                        </p>
                                                                                    </td>
                                                                           <td>${skill.type == 0 ? '<span class="badge-soft badge-master m-0">Master Skill</span>' :
                    '<span class="badge-soft badge-company m-0">Company Skill</span>'}</td>
                            ${[1,2,3,4,5,6].map(i => `
                                                                                                                                                    <td class="checkmark">
                                                                                                                                                        ${skill[`level_${i}_description`] ? '<iconify-icon icon="prime:check-circle" width="16" height="16"></iconify-icon>' : ''}
                                                                                                                                                    </td>
                                                                                                                                                `).join('')}
                            <td class="actions text-center">
                                <button class="action-btn">⋮</button>
                                <div class="dropdown-menu">
                                  ${this.generateActionMenu(skill)}
                                </div>
                            </td>
                        </tr>
                    `).join('');

                        // Update pagination
                        // const pagination = tableDiv.querySelector('.pagination');
                        // pagination.innerHTML = this.buildPaginationHTML(block.pagination);
                        const pagination = tableDiv.querySelector('.pagination');
                        pagination.innerHTML = this.buildPaginationHTML(block.pagination, deptId);
                        // Re-attach pagination event listeners
                        this.setupDeptPagination(tableDiv);

                        // Update skill count
                        const countTarget = tableDiv.querySelector(`.dept-skill-count[data-dept-id="${deptId}"]`);
                        if (countTarget) {
                            countTarget.innerHTML = `${block.pagination?.total || 0} technical skills found.`;
                        }
                    }

                    hideOverlay();
                } catch (error) {
                    console.error('Error fetching department page:', error);
                    hideOverlay();
                }
            }

            // Update letters
            updateLetters(visibleLetters) {
                if (!this.elements.letterResults) return;

                this.elements.letterResults.innerHTML = `
            <a><div class="tab-button-bottom ${!this.state.selectedLetter ? 'bg-active' : ''}"><p>ALL</p></div></a>
            ${visibleLetters.map(letter => `
                                 <a><div class="tab-button-bottom ${this.state.selectedLetter === letter ? 'bg-active' : ''}"><p>${letter}</p></div></a> `).join('')}
        `;

                // Show/hide scroll buttons
                const leftButton = document.querySelector('.scroll-btn.left');
                const rightButton = document.querySelector('.scroll-btn.right');

                if (leftButton && rightButton) {
                    const showButtons = visibleLetters.length >= 5;
                    leftButton.style.display = showButtons ? 'block' : 'none';
                    rightButton.style.display = showButtons ? 'block' : 'none';
                }
            }

            // Update pagination
            updatePagination(pagination, currentPage) {
                if (!pagination || !this.elements.deptTablesContainer) return;

                let paginationLinks = this.elements.deptTablesContainer.querySelector('#pagination-links');
                if (!paginationLinks) {
                    paginationLinks = document.querySelector('#pagination-links');
                }

                if (!paginationLinks) return;

                paginationLinks.innerHTML = '';

                const lastPage = pagination.last_page || 1;
                const currentPageNumber = pagination.current_page || 1;

                // Previous button
                if (pagination.prev_page_url) {
                    paginationLinks.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" data-page="${currentPageNumber - 1}">&laquo;</a>
                </li>
            `;
                } else {
                    paginationLinks.innerHTML += `
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            `;
                }

                // Page numbers
                const maxPageNumbersToShow = 5;
                let pageNumbers = [];

                if (lastPage > maxPageNumbersToShow) {
                    if (currentPageNumber <= 3) {
                        pageNumbers = [1, 2, 3, 4, '...', lastPage];
                    } else if (currentPageNumber >= lastPage - 2) {
                        pageNumbers = [1, '...', lastPage - 3, lastPage - 2, lastPage - 1, lastPage];
                    } else {
                        pageNumbers = [1, '...', currentPageNumber - 1, currentPageNumber, currentPageNumber + 1, '...',
                            lastPage
                        ];
                    }
                } else {
                    for (let i = 1; i <= lastPage; i++) {
                        pageNumbers.push(i);
                    }
                }

                pageNumbers.forEach(page => {
                    if (page === '...') {
                        paginationLinks.innerHTML += `
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                `;
                    } else {
                        paginationLinks.innerHTML += `
                    <li class="page-item ${currentPageNumber === page ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${page}">${page}</a>
                    </li>
                `;
                    }
                });

                // Next button
                if (pagination.next_page_url) {
                    paginationLinks.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" data-page="${currentPageNumber + 1}">&raquo;</a>
                </li>
            `;
                } else {
                    paginationLinks.innerHTML += `
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            `;
                }
            }

            // Render pagination with rows dropdown
            renderPaginationWithRowsDropdown(container, deptId) {
                const wrapper = container.querySelector('.pagination-wrapper');
                if (!wrapper) return;

                const leftDiv = wrapper.querySelector('.d-flex.align-items-center.gap-2');
                if (!leftDiv) return;

                leftDiv.innerHTML = `
            <label for="rowsPerPageSelect_${deptId}">Rows per page:</label>
            <select id="rowsPerPageSelect_${deptId}" class="form-select form-select-sm" style="width: auto;">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        `;

                const dropdown = leftDiv.querySelector(`#rowsPerPageSelect_${deptId}`);
                dropdown.value = this.state.perPageMap[deptId] || 10;

                dropdown.addEventListener('change', () => {
                    this.state.perPageMap[deptId] = parseInt(dropdown.value);
                    this.loadTechnicalSkills(1, this.state.selectedLetter, this
                        .state.selectedLevel);
                });
            }

            // Utility: Check if skill is new (within 24 hours)
            getSkillBadge(skill) {
                console.log('created_at',skill.updated_at);
                if (this.isUpdatedSkill(skill.updated_at) && skill.is_overwrite == 1) {
                    return '<span class="badge-status pending m-0">UPDATED</span>';

                } else if (this.isNewSkill(skill.created_at) ) {
                    return '<span class="badge-status approved m-0">NEW</span>';

                }
                return '';
            }
            isNewSkill(createdAt) {
                const now = new Date();
                const createdDate = new Date(createdAt);
                const diffInHours = (now - createdDate) / (1000 * 60 * 60);
                return diffInHours <= 24;
            }

            isUpdatedSkill(updatedAt) {
                const now = new Date();
                const createdDate = new Date(updatedAt);
                const diffInHours = (now - createdDate) / (1000 * 60 * 60);
                return diffInHours <= 24;
            }


            // Utility: Format date
            formatDate(dateString) {
                const date = new Date(dateString);
                const day = String(date.getDate()).padStart(2, '0');
                const month = date.toLocaleString('default', {
                    month: 'short'
                });
                const year = date.getFullYear();
                const hours = date.getHours();
                const minutes = String(date.getMinutes()).padStart(2, '0');
                const ampm = hours >= 12 ? 'PM' : 'AM';
                const formattedHours = hours % 12 || 12;
                const time = `${formattedHours}:${minutes} ${ampm}`;
                return `${day} ${month} ${year}, ${time}`;
            }

            // Initialize feedback message
            initializeFeedbackMessage() {
                const feedbackMsg = document.getElementById('feedbackMessage');
                const closeIcon = document.getElementById('closeIcon');

                if (feedbackMsg) {
                    feedbackMsg.style.display = 'flex';
                    feedbackMsg.style.setProperty('margin-top', '40px', 'important');
                    feedbackMsg.style.setProperty('margin-left', '30px', 'important');
                    feedbackMsg.style.setProperty('margin-right', '30px', 'important');
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }

                if (closeIcon) {
                    closeIcon.addEventListener('click', () => {
                        feedbackMsg.style.display = 'none';
                    });
                }
            }


        }

        // Initialize the application when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            window.technicalSkillsManager = new TechnicalSkillsManager();
            window.applyOffcanvasFilters = function(filterData) {
                if (window.technicalSkillsManager) {
                    window.technicalSkillsManager.updateOffcanvasFilters(filterData);
                    window.technicalSkillsManager.loadTechnicalSkills(1);
                }
            };
            // Initialize tab from URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');

            if (tab) {
                const tabElement = document.querySelector(`.tab-button[data-tab="${tab}"]`);
                if (tabElement) {
                    window.technicalSkillsManager.handleTabSwitch(tabElement);
                }
            }
        });

        $(document).ready(function() {
            function updateSelectedLabel(wrapper) {
                let checked = wrapper.find('input[type="checkbox"]:checked');
                let label = wrapper.find('.selected-label');
                if (wrapper.hasClass("sector-wrapper")) {
                    label.text(checked.length + " " + "Sector(s) selected");
                }
                if (wrapper.hasClass("category-wrapper")) {
                    label.text(checked.length + " " + "Category(ies) selected");
                }

            }

            // function attachFilterLogic(wrapper) {
            //     let searchField = wrapper.find('.search-field');
            //     let optionsList = wrapper.find('.options-list');

            //     // Search filter
            //     // searchField.on("keyup", function() {
            //     //     let value = $(this).val().toLowerCase();
            //     //     optionsList.find("label").toggle(function() {
            //     //         return $(this).text().toLowerCase().indexOf(value) > -1;
            //     //     });
            //     // });

            //     searchField.on("keyup", function() {
            //         const term = this.value.toLowerCase();
            //         const dropdown = this.closest('.dropdown');
            //         const options = dropdown.querySelectorAll('.options-list .checkbox-option');

            //         options.forEach(opt => {
            //             opt.style.display = opt.innerText.toLowerCase().includes(term) ? '' :
            //                 'none';
            //         });
            //     });

            //     // Checkbox change
            //     optionsList.on("change", "input[type='checkbox']", function() {
            //         updateSelectedLabel(wrapper);
            //     });

            //     // Reset
            //     wrapper.find(".btn-reset").on("click", function() {
            //         optionsList.find("input[type='checkbox']").prop("checked", false);
            //         updateSelectedLabel(wrapper);
            //     });

            //     // Filter button (hook if needed)
            //     wrapper.find(".btn-filter").on("click", function() {
            //         console.log("Applied filter:", optionsList.find("input:checked").map(function() {
            //             return $(this).val();
            //         }).get());
            //     });
            // }

            // // Init logic
            // $(".select-wrapper").each(function() {
            //     attachFilterLogic($(this));
            // });

            // // Sector → Category AJAX
            // $(".sector-options").on("change", "input[type='checkbox']", function() {
            //     let sectorIds = $(".sector-options input:checked").map(function() {
            //         return $(this).val();
            //     }).get();

            //     let categoryWrapper = $(".category-wrapper");
            //     let categoryOptions = categoryWrapper.find(".category-options");

            //     if (sectorIds.length > 0) {
            //         categoryWrapper.find(".category-select").removeClass("disabled");

            //         $.ajax({
            //             url: "/admin/ajax/technical-skill-category/" + sectorIds.join(","),
            //             type: "GET",
            //             success: function(response) {
            //                 categoryOptions.empty();
            //                 $.each(response, function(index, category) {
            //                     categoryOptions.append(`
        //                 <label class="checkbox-option">
        //                     <input type="checkbox" value="${category.id}" data-label="${category.title}">
        //                     ${category.title}
        //                 </label>
        //             `);
            //                 });
            //             },
            //             error: function() {
            //                 alert("Failed to fetch categories");
            //             }
            //         });
            //     } else {
            //         categoryWrapper.find(".category-select").addClass("disabled");
            //         categoryOptions.empty();
            //     }
            // });


        });
    </script>


    <script>
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.actions')) {
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    m.style.display = 'none';
                });
            }
        });
    </script>

@endsection
