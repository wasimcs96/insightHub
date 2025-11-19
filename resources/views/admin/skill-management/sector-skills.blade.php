@extends('admin.layout.app')

@section('title', 'Skills Master List')
@section('styles')
    <style>
        .sort-icon svg g:hover path {
            stroke: #F7941C;
            cursor: pointer;
            transition: stroke 0.2s ease;
        }

        .page-item {
            cursor: pointer;
        }

        .sortable-header, .sortable-header:hover {
            color: black;
        }

        .user {
            display: flex;
            align-items: center;
        }

        /* Breadcrumb-skill */

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
            margin: 84px 30px 30px 30px;
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
            padding-bottom: 32px;
            margin-bottom: 32px;
            border-bottom: 1px solid #DBDFE9;
        }

        .master-list-inner {
            display: grid;
            grid-template-columns: 18.1% 76.7%;
            gap: 65px;
        }

        /* master inner left side */

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
            font-weight: 400;
            line-height: 16px;
        }

        .list-div ul li a:hover,
        .list-div ul li a:active {
            border-color: #FFF6EA;
            background: #FFF6EA;
            color: #1E2129;
        }

        .list-div ul li a:hover span,
        .list-div ul li a:active span {
            background: #F7941C;
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
            width: 99%;
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
        }

        .bottom-right-filter input {
            display: flex;
            outline: none;
            border: none;
            height: 16px;
            padding-right: 38.43px;
            align-items: center;
            flex: 1 0 0;
        }

        .bottom-right-filter button {
            border: none;
            background: none;
            padding: 0;
            margin-top: 5px;
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

        /* Overlay | Skills Levels */

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
            padding: 22.75px;
            justify-content: space-between;
            align-items: center;
            border-radius: 8.13px;
            background: #fff;
        }

        .view-inner-div {
            display: grid;
            grid-template-columns: 49% 49%;
            gap: 17.88px;
            margin: auto;
            padding-bottom: 22.75px;
        }

        .inner-box {
            display: flex;
            padding: 1px;
            width: 525px;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 8.13px;
            border: 1px solid rgba(153, 161, 183, 0.3);
            background: #fff;
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

        .box-content-div {
            padding: 26px 29.25px;
            height: 524.75px;
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

        /* Skill View Tab */

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
            color: #000;
            font-size: 17.55px;
            font-weight: 700;
            line-height: normal;
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

        .app-container {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }

        .app-wrapper {
            margin-top: 75px !important;
        }

        .flex-root {
            background-color: #FAFAFB
        }

        .select-wrapper {
            width: 279px;
            position: relative;
        }

        .select-box,
        .jobdesc-select-box {
            display: flex;
            width: 260px;
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
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            width: 100%;
            max-width: 100%;
            position: relative;
            overflow: visible;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        thead {
            background: #f5f7fa;
        }

        th,
        td {
            padding: 16px 12px;
            text-align: left;
            font-size: 14px;
            color: #333;
            border-bottom: 1px solid #eee;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        th {
            font-weight: 600;
            padding: 22px;
            color: #4B5675;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 20%;
            border-radius: 8px 0px 0px 0px;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 17%;
        }

        th:nth-child(n+3):nth-child(-n+8),
        td:nth-child(n+3):nth-child(-n+8) {
            width: 7%;
            text-align: center;
        }

        th:last-child,
        td:last-child {
            width: 12%;
            border-radius: 0px 8px 0px 0px;
            position: relative;
            text-align: center;

        }

        .star-header {
            color: #f7941d;
        }

        .checkmark {
            color: #28c76f;
            font-size: 16px;
            font-weight: bold;
        }

        /* Actions Cell & Button */
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

        /* Dropdown Menu Styling */
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 30px;
            background: #ffffff;
            border-radius: 6px;
            border: 1px solid #f0f0f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            z-index: 999;
            min-width: 180px;
            padding: 8px 0;
        }

        /* Orange Pointer */
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

        /* Dropdown Items */
        .dropdown-menu a {
            display: block;
            padding: 10px 16px;
            font-size: 13px;
            color: #333;
            text-decoration: none;
            transition: background 0.2s;
        }

        .dropdown-menu a:hover {
            background-color: #f7f7f7;
        }

        /* Highlight First Item */
        .dropdown-menu .highlight {
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
            padding: 10px 36px 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            color: #334155;
            outline: none;
            transition: border-color 0.3s;
        }

        .search-input:focus {
            border-color: #F7941C;
            /* orange focus */
        }

        .search-button {
            position: absolute;
            right: 10px;
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
            color: #fff;
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
            /* light text */
            border: none;
        }

        .pagination .page-link:hover {
            background-color: #f1f1f1;
            color: #78829D;
        }

        .pagination .page-item.active .page-link {
            background-color: #FABB6E !important;
            /* soft orange */
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
            background-color: #FFF7ED;
            /* subtle orange highlight (similar to Tailwind's orange-100) */
            color: #F7941C;
            /* Tailwind's orange-500 */
            font-weight: 600;
        }

        .bg-orange-500 {
            background-color: #F7941C;
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
        
        .letter-scroll-wrapper {
            display: flex;
            align-items: center;
            gap: 4px;
            overflow: hidden;
            position: relative;
        }
        .scroll-btn {
            background-color: #f3f3f3;
            border: none;
            font-size: 18px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .category-item.active .category-count, .category-item:hover .category-count {
            background: #F7941C;
            color: #fff;
            font-weight: 600;
        }

       .category-item.active .category-title, .category-item:hover .category-title  {
            background: none;
            color: #000;
            font-weight: 600;
            font-size: 12px;
        }

        .orange-check {
    color: #F7941D;
    font-size: 13px;
    border-radius: 50px;
    background-color: #f7941d29;
    padding: 3px;
        }

    </style>
@endsection
@section('content')
    <section class="section">


        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
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
                        <li class="breadcrumb-item text-muted">Master Technical Skills</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-5">
                    <div class="navtab-btn">
                        <a href="{{ url('admin/company/sector-skills') }}"
                            class="tab-link {{ request()->is('admin/company/sector-skills') ? 'active-tab' : '' }}">
                            Company Technical Skills
                        </a>

                        <a href="{{ url('/admin/skill-management/dashboard') }}"
                            class="tab-link active-tab {{ request()->is('admin/skill-management/dashboard') ? 'active-tab' : '' }}">
                            Technical Skills Master List
                        </a>
                    </div>

                    <div class="line-h"></div>
                    <a href="/admin/skill-management/search"><button class="btn-view-skill d-flex align-items-center">
                            <iconify-icon icon="f7:sparkles" class="mr-1" width="16" height="16"></iconify-icon>
                            View
                            Skill
                        </button></a>
                </div>
            </div>
        </div>


        <div class="main-master-list">
            <p class="top-heading">
                Master Technical Skills{{ $sector && $sector->name ? ' - ' . $sector->name : '' }}
            </p>
            <div class="master-list-inner">
                <div class="inner-left">
                    <p class="inner-left-top">Technical Skill Categories</p>

                    {{-- <div class="jd-search-bar">
                        <input type="text" id="search-category" placeholder="Search for categories..." />
                        <button class="search-button" id="search-button">
                            <iconify-icon icon="icon-park-outline:search" class="search-button-icon"></iconify-icon>
                        </button>
                    </div> --}}

                    <form data-kt-search-element="form" class="d-none d-lg-block mb-5 mb-lg-0 position-relative"
                        autocomplete="off">
                        <input type="hidden">
                        <iconify-icon icon="stash:search-solid"
                            class=" fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-4"></iconify-icon>
                        <input type="text" id="search-category" class="search-input pl-5" style="padding-left: 36px;"
                            placeholder="Search technical skill category">
                        <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5"
                            data-kt-search-element="spinner">
                            <span class="spinner-border h-15px w-15px align-middle text-gray-500"></span>
                        </span>
                        <span
                            class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4"
                            data-kt-search-element="clear">
                            <i class="ki-duotone ki-cross fs-2 me-0"><span class="path1"></span><span
                                    class="path2"></span></i> </span>
                    </form>

                    {{-- <div class="list-div space-y-2">
                        <ul id="category-results" class="space-y-1">

                            All Categories
                            <li>
                                <a href="{{ route('sector.skills', ['sector_id' => $sector_id]) }}"
                                    class="flex justify-between items-center px-4 py-2 rounded-lg font-semibold 
                                          {{ !$category_id ? 'bg-orange-50 text-black' : 'text-gray-400 hover:text-black' }}">
                                    All Categories
                                    <span
                                        class="text-xs font-bold px-2 py-1 rounded-full 
                                                 {{ !$category_id ? 'bg-white text-orange-500' : 'bg-gray-200 text-gray-500' }}">
                                        {{ $totalSkills }}
                                    </span>
                                </a>
                            </li>

                            Loop through categories
                            @foreach ($categories as $category)
                                @php
                                    $isActive = $category_id == $category->id;
                                @endphp
                                <li>
                                    <a href="{{ route('sector.skills', ['sector_id' => $sector_id, 'category_id' => $category->id]) }}"
                                        class="flex justify-between items-center px-4 py-2 rounded-lg transition
                                              {{ $isActive ? 'bg-orange-50 text-black font-semibold' : 'text-gray-400 hover:text-black' }}">
                                        {{ $category->title }}
                                        <span
                                            class="text-xs font-bold px-2 py-1 rounded-full 
                                                     {{ $isActive ? 'bg-white text-orange-500' : 'bg-gray-200 text-gray-500' }}">
                                            {{ $category->skills_count }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>

                    </div> --}}

                    {{-- <div class="list-div">
                        <ul id="category-results">
                            <li class="category-item {{ !$category_id ? 'active' : '' }}">
                                <a
                                    href="{{ route('sector.skills', ['sector_id' => $sector_id] + request()->only('level', 'search', 'letter')) }}">
                                    <span class="category-title bg-transparent">All Categories</span>
                                    <span class="category-count">{{ $totalSkills }}</span>
                                </a>
                            </li>

                            @foreach ($categories as $category)
                                <li class="category-item {{ $category_id == $category->id ? 'active' : '' }}">
                                    <a
                                        href="{{ route('sector.skills', ['sector_id' => $sector_id, 'category_id' => $category->id] + request()->only('level', 'search', 'letter')) }}">
                                        <span class="category-title bg-transparent">{{ $category->title }}</span>
                                        <span class="category-count">{{ $category->skills_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div> --}}
                    <div class="list-div">
                        <ul id="category-results">
                            <li class="category-item {{ !$category_id ? 'active' : '' }}">
                                <a
                                    href="{{ route('sector.skills', ['sector_id' => $sector_id] + request()->only('level', 'search', 'letter')) }}">
                                    <span class="category-title bg-transparent">All Categories</span>
                                    <span class="category-count">{{ $totalSkills }}</span>
                                </a>
                            </li>

                            @foreach ($categories as $category)
                                @if ($category->skills_count > 0)
                                    <li class="category-item {{ $category_id == $category->id ? 'active' : '' }}">
                                        <a
                                            href="{{ route('sector.skills', ['sector_id' => $sector_id, 'category_id' => $category->id] + request()->only('level', 'search', 'letter')) }}">
                                            <span class="category-title bg-transparent">{{ $category->title }}</span>
                                            <span class="category-count">{{ $category->skills_count }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                    </div>



                </div>

                <div class="inner-right">
                        <div class="col-12">
                            <p class="right-heading">
                                {{ $selectedCategory ? $selectedCategory->title : 'All Categories' }}
                            </p>
                        {{-- <div class="col-md-8" style="display: flex;justify-content: end;height: 44px;">
                          <a href="{{route('skill.management.create')}}">
                            <button class="add-skill-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="plus-icon" width="16" height="16"
                                    fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 5v14M5 12h14" />
                                </svg>
                                Add Technical Skill
                            </button>
                          </a>

                        </div> --}}
                    </div>

                    {{-- <div class="top-filter">
                        <div class="tab-button" onclick="showTabContent('tab1')">
                            <iconify-icon icon="ep:arrow-right-bold" style="font-size: 12px;"></iconify-icon>
                            <p>By Technical Skill Title</p>
                        </div>
                        <div class="tab-button" onclick="showTabContent('tab2')">
                            <iconify-icon icon="ep:arrow-right-bold" style="font-size: 12px;"></iconify-icon>
                            <p>By Proficiency Level</p>
                        </div>
                    </div> --}}

                    {{-- <div class="top-filter">
                        <div class="tab-button" onclick="showTabContent('tab1')">
                            <p>By Technical Skill Title</p>
                        </div>
                        <div class="tab-button" onclick="showTabContent('tab2')">
                            <p>By Proficiency Level</p>
                        </div>
                    </div> --}}
                    <div class="top-filter">
                        <div class="tab-button {{ request('tab') !== 'level' ? 'active' : '' }}"
                            onclick="reloadTab('title')">
                            <p>By Technical Skill Title</p>
                        </div>
                        <div class="tab-button {{ request('tab') === 'level' ? 'active' : '' }}"
                            onclick="reloadTab('level')">
                            <p>By Proficiency Level</p>
                        </div>
                    </div>
                    @php
                        $activeTab = request('tab') === 'level' ? 'tab2' : 'tab1';
                    @endphp

                    <div id="tab1" class="tab-content-tabs {{ $activeTab === 'tab1' ? 'active' : '' }}">
                        <div class="bottom-filter">
                            <div class="bottom-left-filter">
                                @php
                                    $baseParams = ['sector_id' => $sector_id];
                                    if ($category_id) {
                                        $baseParams['category_id'] = $category_id;
                                    }
                                    if ($level) {
                                        $baseParams['level'] = $level;
                                    }
                                    if ($search) {
                                        $baseParams['search'] = $search;
                                    }
                                @endphp
                                <div class="letter-scroll-wrapper">
                                    <button type="button" class="scroll-btn left"
                                        onclick="scrollLetters('left')">&laquo;</button>

                                    {{-- ALL --}}
                                    <div class="letter-scroll-inner" id="letter-results">
                                        <a href="{{ route('sector.skills', $baseParams) }}">
                                            <div
                                                class="tab-button-bottom {{ !$letter ? 'bg-orange-500 text-white' : '' }}">
                                                <p>ALL</p>
                                            </div>
                                        </a>


                                        @foreach ($visibleLetters as $ltr)
                                            <a
                                                href="{{ route(
                                                    'sector.skills',
                                                    array_merge(['sector_id' => $sector_id, 'category_id' => $category_id], request()->only('search', 'level'), [
                                                        'letter' => $ltr,
                                                    ]),
                                                ) }}">
                                                <div
                                                    class="tab-button-bottom {{ $letter === $ltr ? 'bg-orange-500 text-white' : '' }}">
                                                    <p>{{ $ltr }}</p>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>

                                    <button type="button" class="scroll-btn right"
                                        onclick="scrollLetters('right')">&raquo;</button>

                                </div>

                            </div>
                            <div class="row">
                                {{-- <div class="select-wrapper">
                                    <div class="select-box" onclick="toggleDropdown()">
                                        <span id="selectedLabel">0 departments selected</span>
                                        <span class="arrow">▼</span>
                                    </div>
                                    <div class="dropdown" id="dropdownMenu">
                                        <input type="text" class="search-input" placeholder="Search for Departments..."
                                            onkeyup="filterOptions(this)">
                                        <div id="optionsList">
                                            <!-- Dummy checkbox items -->
                                            <label class="checkbox-option"><input type="checkbox"
                                                    value="Airplane Operation Center"> Airplane Operation Center</label>
                                            <label class="checkbox-option"><input type="checkbox"
                                                    value="Crewing Management Center"> Crewing Management Center</label>
                                            <label class="checkbox-option"><input type="checkbox"
                                                    value="Network Management Center"> Network Management Center</label>
                                            <label class="checkbox-option"><input type="checkbox"
                                                    value="People Retention Department"> People Retention Department</label>
                                            <label class="checkbox-option"><input type="checkbox"
                                                    value="Ready Flight Operations"> Ready Flight Operations</label>
                                            <label class="checkbox-option"><input type="checkbox"
                                                    value="Service Crew Center">
                                                Service Crew Center</label>
                                            <label class="checkbox-option"><input type="checkbox" value="Sky Operations">
                                                Sky
                                                Operations</label>
                                            <label class="checkbox-option"><input type="checkbox"
                                                    value="Tarmac Services">
                                                Tarmac Services</label>
                                            <label class="checkbox-option"><input type="checkbox"
                                                    value="Uplift Management">
                                                Uplift Management</label>
                                            <label class="checkbox-option"><input type="checkbox"
                                                    value="Voyage Coordination">
                                                Voyage Coordination</label>
                                        </div>
                                        <div class="dropdown-footer">
                                            <button class="btn-reset" onclick="resetSelection()">Reset</button>
                                            <button class="btn-filter" onclick="applyFilter()">Filter</button>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="bottom-right-filter p-0">
                                    <form method="GET" action="{{ route('sector.skills', [$sector_id, $category_id]) }}"
                                        class="search-form">
                                        <div class="search-wrapper">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                placeholder="Search skill by title" class="search-input" />
                                            <button type="submit" class="search-button">
                                                <iconify-icon icon="bx:search" class="search-icon"></iconify-icon>
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        {{-- <p class="right-heading">
                            Aircraft Operations
                        </p> --}}
                        <div class="row col-12">

                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                {{-- <p class="right-heading-title">
                                    Network Management Center
                                </p> --}}
                                <p class="title-found m-0">{{ number_format($technicalSkills->total()) }} technical skills
                                    found.</p>
                            </div>
                        </div>

                        <div class="jobdesc-selected-tags" id="jobdesc-selected-tags"></div>
                        <div class="table-container">
                            {{-- <p style="font-size: 14px; color: #666;">
                                {{ number_format($technicalSkills->count()) }} technical skills found.
                            </p> --}}

                            <table id="skills-table">
                                <thead>
                                    <tr>
                                        @php
                                            $isNameSorted = request('sort') === 'name';
                                            $ascColorName = '#848484';
                                            $descColorName = '#848484';

                                            if ($isNameSorted && request('order') === 'asc') {
                                                $ascColorName = '#F7941C';
                                            } elseif ($isNameSorted && request('order') === 'desc') {
                                                $descColorName = '#F7941C';
                                            }
                                        @endphp

                                        <th>
                                            <a href="javascript:void(0);" onclick="sortTable('name')"
                                                class="sortable-header">
                                                Technical Skill Title
                                                <span class="sort-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="28"
                                                        viewBox="0 0 24 24">
                                                        <!-- Top arrow (ASC) -->
                                                        <g class="sort-up">
                                                            <path transform="translate(0, -5)" fill="none"
                                                                stroke="{{ $ascColorName }}" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m17 14l-5-5l-5 5" />
                                                        </g>
                                                        <!-- Bottom arrow (DESC) -->
                                                        <g class="sort-down">
                                                            <path transform="translate(0, 5)" fill="none"
                                                                stroke="{{ $descColorName }}" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m7 10l5 5l5-5" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>
                                        </th>
                                        @php
                                            $isDateSorted = request('sort') === 'created_at';
                                            $ascColorDate = '#848484';
                                            $descColorDate = '#848484';

                                            if ($isDateSorted && request('order') === 'asc') {
                                                $ascColorDate = '#F7941C';
                                            } elseif ($isDateSorted && request('order') === 'desc') {
                                                $descColorDate = '#F7941C';
                                            }
                                        @endphp

                                        <th>
                                            <a href="javascript:void(0);" onclick="sortTable('created_at')"
                                                class="sortable-header">
                                                Last Updated
                                                <span class="sort-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="28"
                                                        viewBox="0 0 24 24">
                                                        <!-- Top arrow (ASC) -->
                                                        <g class="sort-up">
                                                            <path transform="translate(0, -5)" fill="none"
                                                                stroke="{{ $ascColorDate }}" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m17 14l-5-5l-5 5" />
                                                        </g>
                                                        <!-- Bottom arrow (DESC) -->
                                                        <g class="sort-down">
                                                            <path transform="translate(0, 5)" fill="none"
                                                                stroke="{{ $descColorDate }}" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m7 10l5 5l5-5" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>
                                        </th>

                                        <th class="star-header"><iconify-icon icon="material-symbols:star"
                                                style="position: relative; top: 3px;" width="16"
                                                height="16"></iconify-icon> <span style="color: #4B5675;">1</span></th>
                                        <th class="star-header"><iconify-icon icon="material-symbols:star"
                                                style="position: relative; top: 3px;" width="16"
                                                height="16"></iconify-icon> <span style="color: #4B5675;">2</span></th>
                                        <th class="star-header"><iconify-icon icon="material-symbols:star"
                                                style="position: relative; top: 3px;" width="16"
                                                height="16"></iconify-icon> <span style="color: #4B5675;">3</span></th>
                                        <th class="star-header"><iconify-icon icon="material-symbols:star"
                                                style="position: relative; top: 3px;" width="16"
                                                height="16"></iconify-icon> <span style="color: #4B5675;">4</span></th>
                                        <th class="star-header"><iconify-icon icon="material-symbols:star"
                                                style="position: relative; top: 3px;" width="16"
                                                height="16"></iconify-icon> <span style="color: #4B5675;">5</span></th>
                                        <th class="star-header"><iconify-icon icon="material-symbols:star"
                                                style="position: relative; top: 3px;" width="16"
                                                height="16"></iconify-icon> <span style="color: #4B5675;">6</span></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="skills-table-body">
                                    @foreach ($technicalSkills as $skill)
                                        <tr>
                                            <td>{{ $skill->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($skill->created_at)->format('d M Y, h:i A') }}
                                            </td>

                                            {{-- Example checkmarks: Customize these based on your actual conditions --}}
                                            <td class="checkmark">
                                                @if ($skill->level_1_description)
                                                    <iconify-icon icon="prime:check-circle" width="24"
                                                        height="24"></iconify-icon>
                                                @endif
                                            </td>
                                            <td class="checkmark">
                                                @if ($skill->level_2_description)
                                                    <iconify-icon icon="prime:check-circle" width="24"
                                                        height="24"></iconify-icon>
                                                @endif
                                            </td>
                                            <td class="checkmark">
                                                @if ($skill->level_3_description)
                                                    <iconify-icon icon="prime:check-circle" width="24"
                                                        height="24"></iconify-icon>
                                                @endif
                                            </td>
                                            <td class="checkmark">
                                                @if ($skill->level_4_description)
                                                    <iconify-icon icon="prime:check-circle" width="24"
                                                        height="24"></iconify-icon>
                                                @endif
                                            </td>
                                            <td class="checkmark">
                                                @if ($skill->level_5_description)
                                                    <iconify-icon icon="prime:check-circle" width="24"
                                                        height="24"></iconify-icon>
                                                @endif
                                            </td>
                                            <td class="checkmark">
                                                @if ($skill->level_6_description)
                                                    <iconify-icon icon="prime:check-circle" width="24"
                                                        height="24"></iconify-icon>
                                                @endif
                                            </td>

                                            <td class="actions d-flex justify-content-center h-fit w-100">
                                                <button class="view-btn" data-id="{{ $skill->id }}"
                                                    data-name="{{ $skill->name }}"
                                                    data-description="{{ $skill->description }}"
                                                    data-levels='@json($skill->getRelevantLevels())' {{-- e.g., returns array like [{level: 4, ...}, {level: 5, ...}] --}}
                                                    onclick="openSkillPopup(this)">
                                                    <iconify-icon icon="mdi:eye-outline" width="16"
                                                        height="16"></iconify-icon>
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 m-4">
                                <!-- Rows per page -->
                                <div class="d-flex align-items-center gap-2">
                                    <span>Rows per page</span>
                                    <form method="GET" id="perPageForm">
                                        <input type="hidden" name="tab" value="{{ request('tab') }}">
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                        <input type="hidden" name="letter" value="{{ request('letter') }}">
                                        <input type="hidden" name="level" value="{{ request('level') }}">
                                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                                        <input type="hidden" name="order" value="{{ request('order') }}">

                                        <select name="per_page" class="form-select form-select w-auto"
                                            onchange="document.getElementById('perPageForm').submit()">
                                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10
                                            </option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25
                                            </option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                            </option>
                                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                            </option>
                                        </select>
                                    </form>

                                </div>

                                <!-- Pagination -->
                                <nav>
                                    <ul class="pagination mb-0">
                                        {{-- Previous --}}
                                        @if ($technicalSkills->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item"
                                                onclick="window.location='{{ $technicalSkills->previousPageUrl() }}'">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Smart Page Numbers --}}
                                        @php
                                            $currentPage = $technicalSkills->currentPage();
                                            $lastPage = $technicalSkills->lastPage();
                                        @endphp

                                        {{-- First --}}
                                        @if ($currentPage > 2)
                                            <li class="page-item"
                                                onclick="window.location='{{ $technicalSkills->url(1) }}'">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            @if ($currentPage > 3)
                                                <li class="page-item disabled"><a class="page-link" href="#">…</a>
                                                </li>
                                            @endif
                                        @endif

                                        {{-- Prev --}}
                                        @if ($currentPage - 1 > 1)
                                            <li class="page-item"
                                                onclick="window.location='{{ $technicalSkills->url($currentPage - 1) }}'">
                                                <a class="page-link" href="#">{{ $currentPage - 1 }}</a>
                                            </li>
                                        @endif

                                        {{-- Current --}}
                                        <li class="page-item active">
                                            <a class="page-link bg-warning border-warning text-dark"
                                                href="#">{{ $currentPage }}</a>
                                        </li>

                                        {{-- Next --}}
                                        @if ($currentPage + 1 < $lastPage)
                                            <li class="page-item"
                                                onclick="window.location='{{ $technicalSkills->url($currentPage + 1) }}'">
                                                <a class="page-link" href="#">{{ $currentPage + 1 }}</a>
                                            </li>
                                        @endif

                                        {{-- Last --}}
                                        @if ($currentPage < $lastPage - 1)
                                            @if ($currentPage < $lastPage - 2)
                                                <li class="page-item disabled"><a class="page-link" href="#">…</a>
                                                </li>
                                            @endif
                                            <li class="page-item"
                                                onclick="window.location='{{ $technicalSkills->url($lastPage) }}'">
                                                <a class="page-link" href="#">{{ $lastPage }}</a>
                                            </li>
                                        @endif

                                        {{-- Next arrow --}}
                                        @if ($technicalSkills->hasMorePages())
                                            <li class="page-item"
                                                onclick="window.location='{{ $technicalSkills->nextPageUrl() }}'">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>


                        </div>
                    </div>
                    <div id="tab2" class="tab-content-tabs {{ $activeTab === 'tab2' ? 'active' : '' }}">
                        <div class="bottom-filter">
                            <div class="bottom-left-filter">
                                @php
                                    $levelOptions = ['ALL', '1', '2', '3', '4', '5', '6'];
                                @endphp


                                @foreach ($levelOptions as $lvl)
                                    @php
                                        $isActive = request('level') == $lvl;
                                        $routeParams = [
                                            'sector_id' => $sector_id,
                                            'category_id' => $category_id,
                                            'tab' => 'level',
                                        ];
                                        // if ($lvl !== 'ALL') {
                                        $routeParams['level'] = $lvl;
                                        // }
                                    @endphp

                                    <a href="{{ route('sector.skills', array_filter($routeParams)) }}">
                                        <div class="tab-button-bottom {{ $isActive ? 'bg-orange-500 text-white' : '' }}">
                                            <p>{{ $lvl }}</p>
                                        </div>
                                    </a>
                                @endforeach


                            </div>

                            <div class="bottom-right-filter p-0">

                                <form method="GET"
                                    action="{{ route('sector.skills', ['sector_id' => $sector_id, 'category_id' => $category_id]) }}"
                                    class="search-form">
                                    {{-- Maintain current tab --}}
                                    <input type="hidden" name="tab" value="{{ request('tab', 'title') }}">

                                    {{-- Preserve filter based on active tab --}}
                                    @if (request('tab') === 'title' && request()->has('letter'))
                                        <input type="hidden" name="letter" value="{{ request('letter') }}">
                                    @elseif (request('tab') === 'level' && request()->has('level'))
                                        <input type="hidden" name="level" value="{{ request('level') }}">
                                    @endif

                                    <div class="search-wrapper">
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            placeholder="Search skill by title" class="search-input" />
                                        <button type="submit" class="search-button">
                                            <iconify-icon icon="bx:search" class="search-icon"></iconify-icon>
                                        </button>
                                    </div>
                                </form>



                            </div>
                        </div>
                        <p style="font-size: 14px; color: #666;">
                            {{ number_format($technicalSkills->total()) }} technical skills found.
                        </p>
                        <div class="table-container">


                            <table id="skills-table">
                                <thead>
                                    <tr>
                                        <th><a href="javascript:void(0);" onclick="sortTable('name')"
                                                class="sortable-header">
                                                Technical Skill Title
                                                <span class="sort-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="28"
                                                        viewBox="0 0 24 24">
                                                        <!-- Top arrow (ASC) -->
                                                        <g class="sort-up">
                                                            <path transform="translate(0, -5)" fill="none"
                                                                stroke="{{ $ascColorName }}" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m17 14l-5-5l-5 5" />
                                                        </g>
                                                        <!-- Bottom arrow (DESC) -->
                                                        <g class="sort-down">
                                                            <path transform="translate(0, 5)" fill="none"
                                                                stroke="{{ $descColorName }}" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m7 10l5 5l5-5" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a></th>
                                            @php
                                            $isDateSorted = request('sort') === 'created_at';
                                            $ascColorDate = '#848484';
                                            $descColorDate = '#848484';

                                            if ($isDateSorted && request('order') === 'asc') {
                                                $ascColorDate = '#F7941C';
                                            } elseif ($isDateSorted && request('order') === 'desc') {
                                                $descColorDate = '#F7941C';
                                            }
                                        @endphp
                                        <th><a href="javascript:void(0);" onclick="sortTable('created_at')"
                                                class="sortable-header">
                                                Last Updated
                                                <span class="sort-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="28"
                                                        viewBox="0 0 24 24">
                                                        <!-- Top arrow (ASC) -->
                                                        <g class="sort-up">
                                                            <path transform="translate(0, -5)" fill="none"
                                                                stroke="{{ $ascColorDate }}" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m17 14l-5-5l-5 5" />
                                                        </g>
                                                        <!-- Bottom arrow (DESC) -->
                                                        <g class="sort-down">
                                                            <path transform="translate(0, 5)" fill="none"
                                                                stroke="{{ $descColorDate }}" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m7 10l5 5l5-5" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a></th>

                                        @for ($i = 1; $i <= 6; $i++)
                                            <th class="star-header">★ {{ $i }}</th>
                                        @endfor

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="skills-table-body">
                                    @foreach ($technicalSkills as $skill)
                                        <tr>
                                            <td>{{ $skill->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($skill->created_at)->format('d M Y, h:i A') }}
                                            </td>

                                            @for ($i = 1; $i <= 6; $i++)
                                                <td class="checkmark">
                                                    {{-- @if (!$level || $level == $i) --}}
                                                    @if ($skill->{'level_' . $i . '_description'})
                                                        <iconify-icon icon="prime:check-circle" width="24"
                                                            height="24"></iconify-icon>
                                                    @endif
                                                    {{-- @endif --}}
                                                </td>
                                            @endfor

                                            <td class="actions d-flex justify-content-center h-fit w-100">
                                                <button class="view-btn" data-id="{{ $skill->id }}"
                                                    data-name="{{ $skill->name }}"
                                                    data-description="{{ $skill->description }}"
                                                    data-levels='@json($skill->getRelevantLevels())'
                                                    onclick="openSkillPopup(this)">
                                                    <iconify-icon icon="mdi:eye-outline" width="16"
                                                        height="16"></iconify-icon>
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>

                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 m-4">
                                <!-- Rows per page -->
                                <div class="d-flex align-items-center gap-2">
                                    <span>Rows per page</span>
                                    <form method="GET"
                                        action="{{ route('sector.skills', ['sector_id' => $sector_id, 'category_id' => $category_id]) }}"
                                        id="perPageFormLevel">
                                        <input type="hidden" name="tab" value="level">
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                        <input type="hidden" name="level" value="{{ request('level') }}">
                                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                                        <input type="hidden" name="order" value="{{ request('order') }}">

                                        <select name="per_page" class="form-select form-select w-auto"
                                            onchange="document.getElementById('perPageFormLevel').submit()">
                                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10
                                            </option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25
                                            </option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                            </option>
                                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                            </option>
                                        </select>
                                    </form>

                                </div>

                                <!-- Pagination -->
                                <nav>
                                    <ul class="pagination mb-0">

                                        @php
                                            $currentPage = $technicalSkills->currentPage();
                                            $lastPage = $technicalSkills->lastPage();
                                        @endphp

                                        {{-- Previous Arrow --}}
                                        @if ($technicalSkills->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#"
                                                    aria-label="Previous"><span>&laquo;</span></a>
                                            </li>
                                        @else
                                            <li class="page-item"
                                                onclick="window.location='{{ $technicalSkills->previousPageUrl() }}'">
                                                <a class="page-link" href="#"
                                                    aria-label="Previous"><span>&laquo;</span></a>
                                            </li>
                                        @endif

                                        {{-- Show first few pages (1–4) if current page <= 4 --}}
                                        @if ($currentPage <= 4)
                                            @for ($i = 1; $i <= min(4, $lastPage); $i++)
                                                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}"
                                                    @if ($i != $currentPage) onclick="window.location='{{ $technicalSkills->url($i) }}'" @endif>
                                                    <a
                                                        class="page-link {{ $i == $currentPage ? 'bg-warning border-warning text-dark' : '' }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            @if ($lastPage > 4)
                                                <li class="page-item disabled"><a class="page-link">…</a></li>
                                                <li class="page-item"
                                                    onclick="window.location='{{ $technicalSkills->url($lastPage) }}'">
                                                    <a class="page-link">{{ $lastPage }}</a>
                                                </li>
                                            @endif
                                        @else
                                            {{-- First page --}}
                                            <li class="page-item"
                                                onclick="window.location='{{ $technicalSkills->url(1) }}'">
                                                <a class="page-link">1</a>
                                            </li>
                                            <li class="page-item disabled"><a class="page-link">…</a></li>

                                            {{-- Current - 1, Current, Current + 1 --}}
                                            @for ($i = $currentPage - 1; $i <= min($currentPage + 1, $lastPage); $i++)
                                                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}"
                                                    @if ($i != $currentPage) onclick="window.location='{{ $technicalSkills->url($i) }}'" @endif>
                                                    <a
                                                        class="page-link {{ $i == $currentPage ? 'bg-warning border-warning text-dark' : '' }}">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            {{-- Show trailing ... and last page --}}
                                            @if ($currentPage + 1 < $lastPage - 1)
                                                <li class="page-item disabled"><a class="page-link">…</a></li>
                                            @endif

                                            @if ($currentPage + 1 < $lastPage)
                                                <li class="page-item"
                                                    onclick="window.location='{{ $technicalSkills->url($lastPage) }}'">
                                                    <a class="page-link">{{ $lastPage }}</a>
                                                </li>
                                            @endif
                                        @endif

                                        {{-- Next Arrow --}}
                                        @if ($technicalSkills->hasMorePages())
                                            <li class="page-item"
                                                onclick="window.location='{{ $technicalSkills->nextPageUrl() }}'">
                                                <a class="page-link" href="#"
                                                    aria-label="Next"><span>&raquo;</span></a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#"
                                                    aria-label="Next"><span>&raquo;</span></a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal bg-body fade" tabindex="-1" id="viewModal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Aircraft Cruise Operations</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">

                        <iconify-icon icon="line-md:close" class=" fs-2x"></iconify-icon>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="view-main">
                        <div class="view-inner-div">
                            <div class="inner-box">
                                <div class="box-header">
                                    Level 4 <iconify-icon icon="material-symbols:star"
                                        class="tab-star-color"></iconify-icon>
                                </div>
                                <div class="box-content-div">
                                    <p class="box-p">Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                    <div class="icon-desc">
                                        <p>Knowledge</p>
                                        <div class="icon-content">
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="icon-desc">
                                        <p>Ability</p>
                                        <div class="icon-content">
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Input journal entries, transactions and events relating to sales</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse lectus
                                                    fusce non
                                                    platea justo dictumst.</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-box">
                                <div class="box-header">
                                    Level 5 <iconify-icon icon="material-symbols:star"
                                        class="tab-star-color"></iconify-icon>
                                </div>
                                <div class="box-content-div">
                                    <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                    <div class="icon-desc">
                                        <p>Knowledge</p>
                                        <div class="icon-content">
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="icon-desc">
                                        <p>Ability</p>
                                        <div class="icon-content">
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse lectus
                                                    fusce non platea justo dictumst.</p>
                                            </div>
                                            <div class="icon-text">
                                                <iconify-icon icon="iconamoon:check-bold"
                                                    class="icon-text-check"></iconify-icon>
                                                <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse lectus
                                                    fusce non
                                                    platea justo dictumst.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<div class="modal fade" id="skillDetailModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                    <h5 id="modalSkillTitle" class="modal-title fw-bold"></h5>
                    <p id="modalSkillDescription" class="m-0"></p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h5 id="modalSkillTitle" class="fw-bold mb-1"></h5>
                    <div class="row" id="modalSkillLevels" style="row-gap: 20px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function sortTable(column) {
            const url = new URL(window.location.href);
            const searchParams = url.searchParams;

            // Get current sort values
            const currentSort = searchParams.get('sort');
            const currentOrder = searchParams.get('order');

            // Determine new order
            let newOrder = 'asc';
            if (currentSort === column && currentOrder === 'asc') {
                newOrder = 'desc';
            }

            // Update URL parameters
            searchParams.set('sort', column);
            searchParams.set('order', newOrder);

            // Reload with new parameters
            window.location.href = url.toString();
        }


        const tabButtons = document.querySelectorAll(".tabs-star-head ul li");
        const tabContents = document.querySelectorAll(".tabs-desc");

        tabButtons.forEach((button) => {
            button.addEventListener("click", () => {
                tabButtons.forEach((btn) => btn.classList.remove("active"));
                button.classList.add("active");

                tabContents.forEach((content) => content.classList.remove("active"));
                const tabId = button.getAttribute("data-tab");
                document.getElementById(tabId).classList.add("active");

                tabButtons.forEach((btn) => {
                    const img = btn.querySelector("img");
                    if (img) {
                        img.src = btn.classList.contains("active") ?
                            "{{ asset('admin/media/skill-management/star.svg') }}" :
                            "admin/media/skill-management/star-grey.svg";
                    }
                });
            });
        });
    </script>

    <script>
        function reloadTab(tabType) {
            const url = new URL(window.location.href);
            const searchParams = url.searchParams;

            // Always set the tab param
            searchParams.set('tab', tabType);

            // Remove pagination filters
            searchParams.delete('per_page');
            searchParams.delete('page');

            // Remove tab-specific filters
            if (tabType === 'title') {
                searchParams.delete('level');
            } else if (tabType === 'level') {
                searchParams.delete('letter');
            }

            // Optional: clean empty search
            if (!searchParams.get('search')) {
                searchParams.delete('search');
            }

            // Navigate to cleaned URL
            window.location.href = url.pathname + '?' + searchParams.toString();
        }
    </script>

    <script>
        const selectBox = document.querySelector('.select-box');
        const dropdown = document.getElementById('dropdownMenu');
        const checkboxes = dropdown.querySelectorAll('input[type="checkbox"]');
        const label = document.getElementById('selectedLabel');

        function toggleDropdown() {
            selectBox.classList.toggle('open');
            dropdown.classList.toggle('show');
        }

        function updateSelectedCount() {
            const checkedCount = [...checkboxes].filter(cb => cb.checked).length;
            label.textContent = `${checkedCount} department${checkedCount !== 1 ? 's' : ''} selected`;
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateSelectedCount);
        });

        function resetSelection() {
            checkboxes.forEach(cb => cb.checked = false);
            updateSelectedCount();
        }

        function applyFilter() {
            const selectedValues = [...checkboxes]
                .filter(cb => cb.checked)
                .map(cb => cb.value);
            alert("Selected: " + selectedValues.join(", "));
            toggleDropdown();
        }

        function filterOptions(input) {
            const filter = input.value.toLowerCase();
            document.querySelectorAll("#optionsList label").forEach(label => {
                const text = label.textContent.toLowerCase();
                label.style.display = text.includes(filter) ? '' : 'none';
            });
        }

        // Close dropdown if clicked outside
        window.addEventListener('click', (e) => {
            if (!document.querySelector('.select-wrapper').contains(e.target)) {
                dropdown.classList.remove('show');
                selectBox.classList.remove('open');
            }
        });
    </script>

    <script>
        function toggleDropdownTable(button) {
            const menu = button.nextElementSibling;
            document.querySelectorAll('.dropdown-menu').forEach(m => {
                if (m !== menu) m.style.display = 'none';
            });
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.actions')) {
                document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
            }
        });
    </script>

    <script>
        document.getElementById('search-category').addEventListener('input', function() {
            var query = this.value.toLowerCase();
            var listItems = document.querySelectorAll('#category-results li');

            listItems.forEach(function(item) {
                var title = item.querySelector('a').textContent.toLowerCase();

                if (title.indexOf(query) === -1) {
                    item.style.display = 'none'; // Hide the item
                } else {
                    item.style.display = ''; // Show the item
                }
            });
        });

        document.getElementById('search-category').addEventListener('input', function() {
            var query = this.value;

            if (query.length >= 3) { // Start searching when 3 characters are entered
                fetch(`/admin/sector-skills/search/${sector_id}?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        let results = data.categories;
                        let list = document.getElementById('category-results');
                        list.innerHTML = ''; // Clear previous results

                        results.forEach(category => {
                            let li = document.createElement('li');
                            li.innerHTML =
                                `<a href="/admin/sector-skills/${sector_id}/${category.id}">${category.title}</a>`;
                            list.appendChild(li);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>

    <script>
        function openSkillPopup(button) {
            const name = button.dataset.name;
            const description = button.dataset.description;
            const levels = JSON.parse(button.dataset.levels);

            document.getElementById('modalSkillTitle').innerText = name;
            document.getElementById('modalSkillDescription').innerText = description;

            const container = document.getElementById('modalSkillLevels');
            container.innerHTML = '';

            levels.forEach(level => {
                const knowledgeItems = typeof level.knowledge === 'string' ?
                    level.knowledge.split(';').map(k => k.trim()).filter(k => k) :
                    level.knowledge || [];

                const abilityItems = typeof level.ability === 'string' ?
                    level.ability.split(';').map(a => a.trim()).filter(a => a) :
                    level.ability || [];

                const block = `
            <div class="col-lg-4">
                <div class="h-100">
                    <div class="card card-stretch card-bordered mb-5 h-100">
                        <div class="card-header align-items-center justify-content-start">
                                    <h3 class="card-title">Level ${level.level}</h3>
                                    <iconify-icon icon="material-symbols:star" style="margin-left: 5px; color: #f7941d;"></iconify-icon>
                        </div>

                                <div class="card-body">
                    <h5 class="fs-6">${level.title ?? ''}</h5>
                                    <div class="py-3">
                                        <h4 class="fs-4 fw-bolder">Knowledge</h4>
                                        <div class="d-flex flex-column">
                                            <ul class="styled-list p-0">
                                ${knowledgeItems.map(k => `<li class="d-flex align-items-center py-2"><iconify-icon icon="material-symbols:check-rounded" class="orange-check me-3"></iconify-icon>${k}</li>`).join('')}
                            </ul>
                                        </div>
                                    </div>
                                    <div class="py-3">
                                        <h4 class="fs-4 fw-bolder">Ability</h4>
                                        <div class="d-flex flex-column">
                                            <ul class="styled-list p-0">
                                ${abilityItems.map(a => `<li class="d-flex align-items-center py-2"><iconify-icon icon="material-symbols:check-rounded" class="orange-check me-3"></iconify-icon>${a}</li>`).join('')}
                            </ul>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        `;

        // const block = `
        //     <div class="col-md-4">
        //         <div class="border rounded p-3 h-100 shadow-sm">
        //             <h6 class="fw-semibold mb-1 text-dark">Level ${level.level} <span style="color: #fbbf24;">★</span></h6>
        //             <p class="mb-3 text-dark">${level.title ?? ''}</p>

        //             <h6 class="section-title">Knowledge</h6>
        //             <ul class="styled-list">
        //                 ${knowledgeItems.map(k => `<li>${k}</li>`).join('')}
        //             </ul>

        //             <h6 class="section-title">Ability</h6>
        //             <ul class="styled-list">
        //                 ${abilityItems.map(a => `<li>${a}</li>`).join('')}
        //             </ul>
        //         </div>
        //     </div>
        // `;
                container.innerHTML += block;
            });

            const modal = new bootstrap.Modal(document.getElementById('skillDetailModal'));
            modal.show();
        }
    </script>

    <script>
       function scrollLetters(direction) {
    const container = document.getElementById('letter-results');
    const scrollAmount = 100;
    if (direction === 'left') {
        container.scrollLeft -= scrollAmount;
    } else {
        container.scrollLeft += scrollAmount;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const totalLetter = {{ json_encode($totalLetterPages) }};
    const leftButton = document.querySelector('.scroll-btn.left');
    const rightButton = document.querySelector('.scroll-btn.right');

    if (totalLetter < 5) {
        leftButton.style.display = 'none';
        rightButton.style.display = 'none';
    } else {
        leftButton.style.display = 'block';
        rightButton.style.display = 'block';
    }
});

    </script>
@endsection
