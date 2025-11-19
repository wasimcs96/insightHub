@extends('admin.layout.app')

@section('title', 'Employee Details')
{{-- @endsection --}}
@section('styles')

    <style>
        .app-wrapper {
            margin-top: 130px !important;
        }

        .app-content {
            padding-top: 15px !important;
        }

        /* .app-container {
            padding: 0px !important;
            margin: 0px 186px !important;
        } */

        .profile-card .nav-link {
            padding: 16px !important;
            margin: 0px !important;
        }

        .profile-card {
            padding: 39px 24px 0px !important
        }

        .mb-11 {
            margin-bottom: 36px !important;
        }

        .gap-7 {
            gap: 24px !important;
        }

        .gap-4 {
            gap: 16px !important;
        }

        .psych-inner,
        .psych-inner-2,
        .psych-inner-3 {
            padding: 30px 40px 45px 40px;
        }

        .table-status {
            border-radius: 80px;
            padding: 4px 12px;
            width: max-content;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
        }

        .high {
            background-color: #DDF5E2;
            color: #196329;
        }

        .moderate {
            background-color: #FFEBB4;
            color: #EB8100;
        }

        .na {
            background-color: #f8f7f5;
            color: #E0E0E0;
        }

        .btn-primary,
        .btn-light {
            padding: 14px 20px;
            border-radius: 4px;
            border: 1px solid #F7941C !important;
        }

        .btn-primary {
            color: #fff !important;
        }

        .btn-light {
            color: #F7941C !important;
            background: #FFF !important;
        }

        .psych-inner-2 .inner-table {
            grid-template-columns: 44.6% 36%;
            gap: 70px;
        }


        .psych-inner-3 .inner-table {
            grid-template-columns: 47.2% 47.2%;
            gap: 30px;
        }

        .side-line-orange {
            padding-left: 15px;
            border-left: 2px solid #FABB6E;
        }

        .left-table-head {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 4px;
        }

        .left-table-head p {
            margin-bottom: 5px;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .progress-container {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 15px;
            height: 16px;
            background-color: #f0f0f0;
            position: relative;
            display: table;
            border-collapse: collapse;
        }

        .progress-fill {
            display: table-row;
        }

        .progress-segment {
            display: table-cell;
            height: 16px;
        }

        .segment-yellow,
        .segment-orange,
        .segment-blue {
            width: 33.33%;
        }

        .segment-yellow {
            background-color: #FFD76A;
        }

        .segment-orange {
            background-color: #99E2A8;
        }

        .segment-blue {
            background-color: #65DADA;
        }

        .progress-circle {
            position: absolute;
            top: 60%;
            /* transform: translate(398px, -50%); */
        }

        .line-grey {
            background-color: #e6e6e6;
            position: relative;
            margin-top: 15px;
            width: 100%;
            height: 15px;
            background: #EBEBEB;
        }

        .ocean-grey {
            margin-top: 14.4px;
            height: 21.28px;

        }

        .ocean-orange {
            height: 21.28px !important;
        }

        .line-orange {
            height: 15px;
        }

        .fade-orange {
            background: #FABB6E;
        }

        .dark-orange {
            background: #F7941C;
        }

        .svg-round-icon {
            position: absolute;
            bottom: -0.701px;
            top: 13%;
            transform: translateY(-50%);
        }

        .line {
            border-radius: 7.14px;
        }

        .line-bottom {
            background: #E1E1E1;
            width: 100%;
            height: 1px;
        }

        .tweleve-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: normal;
            margin-bottom: 15px;
        }

        .tweleve-desc {
            color: #5B5B5B;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8.4px;
        }

        .tweleve-desc img {
            margin-right: 5px;
            position: relative;
            top: 2px;
        }

        .skill-table {
            display: grid;
            gap: 30px;
        }

        .skill-table .table-desc {
            margin: 0;
        }

        .orange-bg {
            padding: 10px 10px 10px 15px;
            background: #FFF6EA;
            border-left: 2px solid #FABB6E;
        }

        .orange-bg .table-desc {
            margin: 0;
        }

        .work-right-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: 22px;
        }

        .work-orange {
            color: #F7941C;
            font-size: 36px;
            font-weight: 500;
            line-height: normal;
            margin: 12.8px 0px 6.4px 0px;
        }

        .inner-table {
            display: grid;
            grid-template-columns: 62% 32%;
            gap: 30px;
            align-items: flex-start;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
            min-height: 37px;
        }

        .right-bot {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            display: table;
            margin: 7px 0px;

        }

        .right-bot span {
            padding: 2.626px 6.795px;
            position: relative;
            left: 7px;
            border-radius: 5.421px;
            background: #F7941C;
            color: #FFF;
            font-size: 9px;
            line-height: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .purple,
        .purple-high,
        .cyan,
        .cyan-high,
        .orange,
        .spring,
        .yellow, .green {
            font-size: 12px;
            font-weight: 600;
            line-height: normal;
        }

        .purple span,
        .purple-high span,
        .cyan span,
        .cyan-high span,
        .orange span,
        .green span,
        .spring span,
        .yellow span {
            border-radius: 8px;
            position: relative;
            font-size: 11px;
            font-weight: 600;
            left: 6.4px;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .green {
            color: #2AA443;
        }

        .green span {
            color: #218336 !important;
            background: #BBECC5 !important;
        }

        .purple {
            color: #7F66CA;
        }

        .purple-high {
            color: #6652A1;
        }

        .success-green {
            color: #218336 !important;
        }

        .purple span, .purple-high span {
            color: #7F66CA;
            background: #E1D8FB;
        }

        .cyan {
            color: #108585;
        }

        .cyan span {
            background: #B2ECEC;
            color: #108585 !important;
        }

        .cyan-high {
            color: #108585;
        }

         .cyan-high span {
            background: #B2ECEC;
            color: #0C6464;
        }

        .orange {
            color: #F7941C;
        }

        .orange span {
            background: #FDE2C1;
            color: #F7941C !important;
        }

        .spring {
            color: #D4A21A;
        }

        .spring span {
            color: #F7941C;
            background: #FFEBB4 !important;
        }

        .yellow {
            color: #D4A21A !important;
        }

        .yellow span {
            color: #F7941C;
            background: #FFEBB4 !important;
        }

        .top-ranks-box {
            padding: 8px;
            border-radius: 8px;
            background: #F9F9F9;
            font-size: 16px;
            font-weight: 600;
        }

        .skill-table-button {
            padding: 8px 15px;
            color: #F7941C;
            font-size: 14.3px;
            font-weight: 400;
            line-height: normal;
            background: #fff;
            border: 1px solid;
            border-radius: 4.4px;
            display: flex;
            margin: auto;
            margin-top: 60px;
        }

        .moderate-icon-yellow {
            font-weight: 600;
            width: 16px;
            height: 16px;
            transform: rotate(45deg);
            background: #FFCD44;
            margin-right: 10px;
            margin-top: 4px;
        }

        .second-container {
            display: grid;
            grid-template-columns: 40% 60%;
        }

        /* Container Styling */
        .chart-container {
            position: relative;
            width: 270px;
            height: 270px;
            margin: auto;
        }

        /* Circular Chart Rotation */
        .circular-chart {
            transform: rotate(-90deg);
            /* Starts the chart from the top */
            margin: auto;
            display: block;
        }

        /* Chart Labels */
        .chart-label {
            position: absolute;
            text-align: center;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
            background: rgba(255, 255, 255, 0.8);
            padding: 5px 10px;
            border-radius: 5px;
        }

        .correct-label,
        .wrong-label,
        .missed-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .correct-label {
            top: 15%;
            left: 46%;
            background-color: #E2F6F6;
            color: #108585;

        }

        .wrong-label {
            top: 36%;
            right: 51%;
            background-color: #FFF6EA;
            color: #CE7B17;
        }

        /* Missed Label */
        .missed-label {
            bottom: 11%;
            left: 47%;
            background-color: #F2EEFD;
            color: #6652A1;
        }


        .circle-second-div p {
            color: #5B5B5B;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            align-items: center;
            margin-top: 13.44px;
            display: flex;
        }

        .circle-second-div span {
            width: 30.484px;
            height: 8.803px;
            position: relative;
            right: 7.17px;
        }

        .correct {
            background: #8CE3E3;
        }

        .wrong {
            background: #FFDC92;
        }

        .missed {
            background: #BBA7F6;
        }

        .succession-head {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .succession-head p {
            color: #1E1E1E;
            font-size: 19.5px;
            font-style: normal;
            font-weight: 500;
            line-height: 23.4px;
            margin: 0;
        }

        .success-chart {
            color: #B7B7B7;
            font-size: 28px;
        }

        .card {
            border-radius: 4px;
            justify-content: space-between;
        }

        .card-orange {
            border: 2px solid #F7941C;
        }

        .card-cyan {
            border: 2px solid #1AC2C2;
        }

        .card-pink {
            border: 2px solid #FF2E2E;
        }

        .line-chart {
            font-size: 24px;
            color: #F5872B;
        }

        .s-top-right {
            display: flex;
            align-items: center;
        }

        .s-top-right a {
            color: #99A1B7;
        }

        .three-dots {
            font-size: 18px;
        }

        .s-top-right span {
            border-radius: 50px;
            padding: 4px 12px;
            font-size: 11px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .s-yellow-right {
            background: #FFEBB4;
            color: #806210;
        }

        .s-green-right {
            background: #BBECC5;
            color: #196329;
        }

        .s-pink-right {
            background: #FCE4EC;
            color: #880E4F;
        }

        .s-head-span span {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .s-head-span h5 {
            color: #1E1E1E;
            font-size: 14.95px;
            font-style: normal;
            font-weight: 500;
            line-height: 17.94px;
        }

        .s-current {
            background: #FEF2E2;
            color: #CE7B17;
        }

        .s-career-goal {
            background: #E2F6F6;
            color: #108585;
        }

        .s-head-content p {
            font-size: 12px;
            color: #757575;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .s-green-text {
            display: flex;
            align-items: center;
            flex-flow: wrap;
            gap: 8px;
        }

        .s-green-text div {
            padding: 8px 16px;
            border-radius: 80px;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            color: #975102;
        }

        .s-green-btn {
            background: #DDF5E2;
            color: #218336;
        }

        .s-yellow-btn {
            background: #FFF3E0;
            color: #975102;
        }

        .s-more-skill-btn {
            padding: 8px 16px;
            border-radius: 80px;
            border: 1px solid #99A1B7;
            color: #99A1B7 !important;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
            line-height: 16px;
            width: fit-content;
            cursor: pointer;
        }

        .s-more-info-btn {
            border-top: 1px solid rgba(217, 217, 217, 0.50);
            display: flex;
            padding: 8px 8px 8px 12px;
            justify-content: center;
            color: #4B5675;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            align-items: center;
            cursor: pointer;
        }

        .success-inner {
            padding: 12px 16px;
        }

        .star {
            font-size: 16px;
            color: #F3AC60;
        }

        .s-info-btn {
            font-size: 18px;
        }

        .career-path-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .career-path-head button {
            padding: 8px 8px 8px 12px;
            border-radius: 4px;
            background: #F5872B;
            color: #FFF;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            align-items: center;
            display: flex;
            gap: 8px;
        }

        .career-map-icon {
            font-size: 24px;
        }

        .path-top-text {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .path-top-text p {
            color: #071437;
            font-size: 17.55px;
            font-style: normal;
            font-weight: 500;
            line-height: 21.06px;
        }

        .bar-career {
            width: 73px;
            height: 10px;
            background-color: #e3e6ed;
            border-radius: 10px;
            overflow: hidden;
        }

        .bar {
            height: 10px;
            background-color: #f08a3a;
            border-radius: 10px 0 0 10px;
        }

        .kpi-side-dropdown-btn {
            display: flex;
            min-width: 210px;
            padding: 6px 0px 6px 16px;
            align-items: center;
            border-radius: 8px;
            border: 1px solid #D9D9D9;
        }

        .kpi-calender {
            color: #F7941C;
            font-size: 16px;
        }

        .kp-select {
            color: #1E1E1E;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            border: none;
            padding: 0;
            width: 170px;
        }

        .performance table {
            width: 100%;
            border-collapse: collapse;
        }

        .performance thead th {
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
            padding: 8px;
            width: 12.5%;
        }

        .performance tbody td {
            text-align: left;
            padding: 8px;
            font-size: 12px;
            font-weight: 500;
            color: #4B5675;
            vertical-align: top;
        }

        .performance tbody tr:nth-child(odd) {
            background-color: #FAFAFB;
        }

        .kpi-inner {
            grid-template-columns: 17% 79%;
        }

        .sd-table-bot,
        .sd-table-bot-total {
            color: #071437;
            font-style: normal;
            text-align: right;
            padding: 8px;

        }

        .sd-table-bot {
            font-weight: 600;
            line-height: 16px;
            font-size: 12px;
            border-top: 1px solid #DBDFE9;
        }

        .sd-table-bot-total {
            font-size: 19.5px;
            font-weight: 700;
            line-height: 23.4px;
        }

        .sd-table-bot span,
        .sd-table-bot-total span {
            margin-left: 16px;
        }

        .kpi-table-head {
            color: #071437;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: 20px;
            margin-bottom: 8px;
        }

        .idp-table {
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .idp-table .table-row,
        .idp-table-2 .table-row {
            display: grid;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .idp-table .table-row {
            grid-template-columns: 14.28% 14.28% 14.28% 14.28% 14.28% 14.28% 14.28%;
        }

        .idp-table-2 .table-row {
            grid-template-columns: 11% 25% 20% 12% 21% 11%;
            align-items: flex-start;
        }

        .idp-table .table-row:last-child {
            border-bottom: none;
        }

        .idp-table .header div,
        .idp-table-2 .header th {
            border-bottom: 1px solid #F3F3F3;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #99A1B7;
            padding: 16px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .idp-table .header div {
            justify-content: flex-start;
            padding: 16px 0px 16px 16px !important;
        }

        .idp-table-2 .header th {
            border-bottom: none;
            justify-content: left;
            text-transform: capitalize;
        }

        .table-row div {
            padding: 24px;
            margin: auto;
        }

        .idp-table .table-row div {
            padding: 24px 0px 24px 16px;
            margin: inherit;
        }

        .idp-table .badge {
            display: flex;
            width: fit-content;
            margin: auto;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            color: #4B5675;

        }

        .idp-table .soft-skill {
            background: #e7f3ff;
            color: #007bff;
        }

        .idp-table .tech-skill {
            background: #ffe5e0;
            color: #d9534f;
        }

        .idp-table .basic-level {
            background: #d4edda;
            color: #155724;
        }

        .idp-table .advanced-skill {
            background: #e0e7ff;
            color: #4e73df;
        }

        .idp-table .completed {
            background: #d4edda;
            color: #28a745;
        }

        .idp-table .in-progress {
            background: #fff3cd;
            color: #856404;
        }

        .idp-table .progress-bar {
            width: 100%;
            height: 8px;
            background: #f0f0f0;
            border-radius: 4px;
            position: relative;
            overflow: hidden;
            padding: 0;
        }

        .idp-table .progress {
            height: 100%;
            background: #f7b500;
            border-radius: 4px;
        }

        .idp-table .requirement {
            color: #dc3545;
            font-weight: bold;
        }

        .progress-bar-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background-color: #DBDFE9 !important;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background-color: #f7b500;
            border-radius: 10px 10px 10px 10px;
        }

        .progress-percentage {
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            text-align: right;
            color: #4B5675;

        }

        .see-all {
            color: #F7941C !important;
            font-size: 14px !important;
            font-style: normal !important;
            font-weight: 500 !important;
            line-height: 20px !important;
            display: flex;
        }

        .idp-circular-progress {
            width: 262px;
            height: 262px;
            background: conic-gradient(#FABB6E 20% 20%,
                    #FDE2C1 20% 40%,
                    #F7941C 40% 60%,
                    #F9A845 60% 80%,
                    #FCCF98 80% 100%);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .idp-circular-progress::before {
            content: '';
            width: 210px;
            height: 210px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
        }

        .idp-percentage {
            position: absolute;
            text-align: center;
        }

        .idp-percentage h3 {
            color: #071437;
            text-align: center;
            font-size: 58.5px;
            font-style: normal;
            font-weight: 600;
            line-height: 70.2px;
        }

        .idp-percentage p {
            color: #4B5675;
            text-align: center;
            font-size: 17.55px;
            font-style: normal;
            font-weight: 500;
            line-height: 21.06px;
        }

        .orange-dot {
            width: 16px;
            height: 16px;
            border-radius: 8px;
        }

        .orange-1 {
            background: #F7941C;
        }

        .orange-2 {
            background: #F9A845;
        }

        .orange-3 {
            background: #FABB6E;
        }

        .orange-4 {
            background: #FCCF98;
        }

        .orange-5 {
            background: #FDE2C1;
        }

        .idp-table-2 table {
            width: 100%;
            border-collapse: collapse;
        }

        .idp-table-2 .table-row div {
            padding: 0px;
        }

        .idp-table-2 th,
        .idp-table-2 td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
        }

        .idp-table-2 th {
            color: #555;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9em;
        }

        .idp-table-2 .table-row div {
            margin: inherit
        }

        .idp-table-2 td .skill {
            display: inline-block;
            background-color: #fdf2e9;
            color: #d48a42;
            padding: 5px 10px;
            margin: 5px 0;
            border-radius: 20px;
            font-size: 0.85em;
        }

        .idp-table-2 .button {
            display: inline-block;
            color: #5a8fe8;
            font-size: 0.85em;
            cursor: pointer;
        }

        .test-result {
            color: #4B5675;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 20px;
            letter-spacing: 0.1px;
        }

        .red-top {
            border-radius: 80px;
            background: #FFE8E8;
            color: #FF2E2E;
            font-size: 8px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 4px 12px;
        }

        .red-top span {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
        }

        .icon_wrapper {
            width: 100%;
        }

        .tab-btn button {
            padding: 8px 16px !important;
            background: #FFF !important;
            border-color: #F7941D !important;
            color: #F7941D !important;
            font-size: 12px !important;
            font-weight: 600 !important;
        }

        .tab-btn button.active {
            background-color: #F7941C !important;
            color: #FFF !important;
            border-color: #F7941C !important;
            border: 0px !important;
        }

        .btn-tab-1 {
            border-width: 1px 0px 1px 1px !important;
            border-radius: 6px 0px 0px 6px !important;
        }

        .btn-tab-2 {
            border-width: 1px 1px 1px 0px !important;
            border-radius: 0px 4px 4px 0px !important;
        }

        .kpi-circular-progress {
            width: 210.424px;
            height: 210.424px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .donut-1 .kpi-circular-progress {
            background: conic-gradient(#F7941C 0% 89%,
                    /* 89% progress (2.68/3.00) */
                    #DBDFE9 89% 100%
                    /* Remaining segment */
                );
        }

        .donut-2 .kpi-circular-progress {
            background: conic-gradient(#F7941C 0% 100%,
                    /* 89% progress (2.68/3.00) */
                    #DBDFE9 0% 0%
                    /* Remaining segment */
                );
        }

        .kpi-circular-progress::before {
            content: '';
            width: 175px;
            height: 175px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
        }

        .kpi-circle-content {
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .kpi-circle-content h3 {
            color: #5B5B5B;
            text-align: center;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: 30px;
        }

        .kpi-circle-content p {
            color: #5B5B5B;
            text-align: center;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
        }

        .semi-circle-progress {
            width: 210.424px;
            /* Adjusted width */
            height: 105.212px;
            /* Half the width for a semi-circle */
            background: conic-gradient(#54CF6E 0deg 45deg,
                    /* First Segment: Green */
                    #99E2A8 45deg 90deg,
                    /* Second Segment: Light Green */
                    #DBDFE9 90deg 135deg,
                    /* Third Segment: Gray */
                    #2AA443 135deg 180deg
                    /* Fourth Segment: Dark Green */
                );
            border-radius: 105.212px 105.212px 0 0;
            /* Adjusted border-radius */
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .semi-circle-progress::before {
            content: '';
            width: 190px;
            /* Adjusted size for the inner white cover */
            height: 95px;
            background: #fff;
            border-radius: 95px 95px 0 0;
            position: absolute;
            top: 10px;
            /* Adjusted for proper centering */
            left: 10px;
            /* Adjusted for proper centering */
            z-index: 1;
        }

        .semi-circle-idp-percentage {
            position: absolute;
            bottom: 20%;
            text-align: center;
        }

        .action-dropdown {
            position: relative;
            width: 140px;
            font-size: 14px;
        }

        .action-dropdown select {
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            padding: 6px 16px;
            font-size: 12px;
        }

        .dropdown::after {
            right: 20px;
            /* Move the arrow to the left */
        }

        .modal-dialog {
            max-width: 100vw;
            margin: 0;
        }

        .career-map-modal-header {
            display: grid;
            grid-template-columns: 33% 33% 33%;
            padding: 16px;
        }

        .bg-career-map-modal {
            background-color: #F5F5F5;
            padding: 0px;
        }

        .career-map-modal-header button {
            display: flex;
            align-items: center;
            border-radius: 80px;
            border: 1px solid #D9D9D9;
        }

        .career-map-modal-header .btn-close {
            margin-right: 0px;
            padding: 8px;
            width: 24px;
            height: 24px;
        }

        .career-map-modal-header h5 {
            text-align: center;
            color: #1E1E1E;
            font-size: 28px;
            font-style: normal;
            font-weight: 400;
            line-height: 36px;
            letter-spacing: 0px;
        }
    </style>

    <style>
        .circle {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            position: relative;
        }

        .circle-completed {
            border: 10px solid #f7931e;

        }

        .circle-incompleted {
            border: 10px solid #a5a5a5;

        }

        .circle span {
            font-size: 18px;
            color: #f7931e;
            font-weight: 700;
        }

        .circle p {
            font-size: 12px;
            color: #666;
            position: absolute;
            bottom: -20px;
            width: 100%;
            text-align: center;
        }

        .circle.completed span {
            font-size: 36px;
        }

        .circle.completed p {
            font-size: 16px;
            color: #333;
        }

        .assessment-card .circle.completed span {
            color: #f7931e;
        }

        .card-body-riasec {
            box-shadow: none !important;
            border: none !important;
            padding: 0;
            margin: 0;
        }

        .hours-content {
            color: #071437;
            font-size: 14.95px;
            font-style: normal;
            font-weight: 500;
            line-height: 19.5px;
        }

        .all-star {
            display: grid;
            grid-template-columns: 46% 50%;
            gap: 50px;
        }

        .all-star-div {
            display: grid;
            gap: 16px;
            grid-template-columns: 48.4% 48.5%;
        }

        .all-star-div div {
            border-radius: 5.6px;
            height: fit-content;
            background: #FFF;
            box-shadow: 0px 2.24px 2.24px 0px rgba(0, 0, 0, 0.25);
        }

        .all-star-btn {
            padding: 8px 15px;
            border-radius: 4.4px;
            border: 1px solid #F00;
            background: #FFF;
            color: #F00;
            font-size: 14.3px;
            font-weight: 400;
            display: flex;
            margin: auto;
        }

        @media only screen and (min-width: 992px) and (max-width: 1101px) {
            .app-container {
                padding: 0px !important;
                margin: 0px 10px !important;
            }
        }

        @media only screen and (min-width: 1101px) and (max-width: 1201px) {
            .app-container {
                padding: 0px !important;
                margin: 0px 50px !important;
            }
        }

        @media only screen and (min-width: 1202px) and (max-width: 1351px) {
            .app-container {
                padding: 0px !important;
                margin: 0px 70px !important;
            }
        }

        @media only screen and (min-width: 1352px) and (max-width: 1401px) {
            .app-container {
                padding: 0px !important;
                margin: 0px 120px !important;
            }
        }

        @media (max-width: 360px) {
            .circle {
                width: 90px;
                height: 90px;
            }

            .emp_a {
                width: 15px;
                height: 15px;
            }

            .emp_b {
                width: 15px;
                height: 15px;
            }
        }
    </style>

    <style>
        .triangle {
            width: 0px;
            height: 0px;
            border-left: 6.5px solid transparent;
            /* Half of the width */
            border-right: 6.5px solid transparent;
            /* Half of the width */
            border-bottom: 11px solid #2AA443;
            /* Height and color of the triangle */
            margin-right: 10px;
            margin-top: 14px;
        }

        .triangle-down {
            width: 0;
            height: 0;
            border-left: 6.5px solid transparent;
            /* Half the width of the triangle */
            border-right: 6.5px solid transparent;
            /* Half the width of the triangle */
            border-top: 11px solid #e11f1f;
            /* Height and color of the triangle */
            /* transform: rotate(180deg); Flip the triangle to match the SVG direction */
            margin-right: 10px;
            margin-top: 3px;

            
        }

        .triangle-red {
            width: 0px;
            height: 0px;
            border-left: 6.5px solid transparent;
            /* Half of the width */
            border-right: 6.5px solid transparent;
            /* Half of the width */
            border-bottom: 11px solid #e11f1f;
            /* Height and color of the triangle */
            margin-right: 10px;
            margin-top: 3px;
        }

        .triangle-down-green {
            width: 0;
            height: 0;
            border-left: 6.5px solid transparent;
            /* Half the width of the triangle */
            border-right: 6.5px solid transparent;
            /* Half the width of the triangle */
            border-top: 11px solid #2AA443;
            /* Height and color of the triangle */
            /* transform: rotate(180deg); Flip the triangle to match the SVG direction */
            margin-right: 10px;
            margin-top: 3px;
        }

        .svg-round-icon>img {
            width: 24px;
            height: 24px;
        }

        .hidden-skills {
            display: none;
            /* Initially hidden */
            flex-wrap: wrap;
            /* Ensure the hidden chips also wrap */
            gap: 5px;
            /* Same gap as the parent container */
        }

        .hidden-skills.show {
            display: flex !important;
            /* Display hidden skills in a row with wrapping */
        }

        .suggestion-card-chips {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 12px;

            background: #FFF3E0;
            border-radius: 50px;
            /* Label */
            /* M3/label/small */
            font-style: normal;
            font-weight: 500;
            font-size: 11px;
            line-height: 16px;
            /* identical to box height, or 145% */
            letter-spacing: 0.5px;

            /* Primary/Orange 70 */
            color: #975102;

        }

        .add-skill-chip {
            /* Label */

            background: #FFFFFF;
            border: 1px solid #99A1B7;
            border-radius: 80px;

            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 12px;

            /* Label */
            /* M3/label/small */
            font-style: normal;
            font-weight: 500;
            font-size: 11px;
            line-height: 16px;
            /* identical to box height, or 145% */
            letter-spacing: 0.5px;

            /* Primary/Orange 70 */
            color: #99A1B7;


        }

        .main-top-heading {
            color: #5B5B5B;
            font-size: 32px;
            font-weight: 500;
            margin-bottom: 45px;
        }

        .profile-card .badge {
            display: flex;
            padding: 6.4px 12.8px;
            justify-content: center;
            align-items: center;
            border-radius: 64px;
            font-size: 12px;
            line-height: 16px;
        }

        .profile-card .badge.high {
            background: #DDF5E2;
            color: #196329;
        }

        .profile-card .badge.moderate {
            background: #FFEBB4;
            color: #EB8100;
        }

        .profile-card .badge.low {
            background-color: #ffcdd2;
            color: #d32f2f;
        }

        .low {
            background-color: #ffcdd2;
            color: #d32f2f;
        }

        .profile-card .badge.filled {
            background: #F2EEFD;
            color: #6652A1;
        }

        .profile-card .badge.rate {
            background: #FFEBB4;
            color: #A56313;
        }

        .purple span,
        .cyan span,
        .orange span,
        .green span,
        .spring span,
        .badge-custom {
            border-radius: 8px;
            position: relative;
            font-size: 11px;
            font-weight: 600;
            left: 6.4px;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .badge-custom {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 3.3px 7.7px;
            border-radius: 11px;
        }

        .badge-custom.entry {
            background: #FFEBB4 !important;
            color: #F7941C !important;
        }

        .badge-custom.individual-contributors {
            /* color: #F36B0A;
                            background: #FEECE5; */
            background: #FFEDCA !important;
            color: #F5872B !important;
        }

        .badge-custom.managers {
            color: #FF2E2E;
            background: #FFE8E8;
        }

        .badge-custom.leadership {
            color: #BF3173;
            background: #FFE4F1;
        }

        .badge-custom.higly-aligned,
        .advance-higly-aligned {
            color: #7F66CA !important;
            background: #E1D8FB;
        }

        .badge-custom.aligned,
        .Intermediate-critical {
            color: #108585 !important;
            background: #B2ECEC;
        }

        .badge-custom.needs-development { 
            background: #FFEBB4 !important;
            color: #F7941C !important;
        }
    </style>

    <style>
        .job-application-section {
            grid-template-columns: 65% 32.4%;
            gap: 32px;
        }

        .top-heading {
            color: #1E1E1E;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
        }

        .job-application-section .box,
        .psychometric-section .box {
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .job-application-section .box .heading-box {
            color: #000;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
            margin-bottom: 20px;
        }

        .skill-badge {
            padding: 8px 16px;
            border-radius: 80px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
        }

        .job-application-section .left-side .table-container {
            background: white;
        }

        .job-application-section .left-side .table-container .table thead th {
            border-radius: 5px 5px 0px 0px;
            border: 1px solid #F3F3F3;
            background: #FAFAFB;
            padding: 16px;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .job-application-section .left-side .table-container .table tbody td {
            color: #4B5675;
            padding: 24px 16px;
            border-bottom: 1px solid #F1F1F4;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            letter-spacing: 0.1px;
        }

        .custom-tooltip {
            text-align: left;
            height: 57px;
            padding: 6px 9px;
        }

        .custom-tooltip .label,
        .custom-tooltip .percentage {
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>

    <style>
        .psychometric-section .box {
            padding: 30px;
        }

        .psychometric-section .tweleve-inner {
            border-radius: 5.6px;
            background: #FFF;
            box-shadow: 0px 2.24px 2.24px 0px rgba(0, 0, 0, 0.25);
            padding: 20px 21px 20px 20px;
            height: fit-content;
        }

        .psychometric-section .card-info-btn .btn-orange {
            padding: 12px 20px;
            background: #fff;
            color: #F7941C;
            border: 1px solid #F7941C;
            border-radius: 4px;
        }

        .psychometric-section .top-heading {
            color: #5B5B5B;
            font-size: 32px;
            font-weight: 500;
            line-height: normal;
        }

        .psychometric-section .badge-custom {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 3.3px 7.7px;
            border-radius: 11px;
        }

        .psychometric-section .badge-custom.individual-contributors {
            color: #F36B0A;
            background: #FEECE5;
        }

        .psychometric-section .badge-custom.managers {
            color: #FF2E2E;
            background: #FFE8E8;
        }

        .psychometric-section .badge-custom.leadership {
            color: #BF3173;
            background: #FFE4F1;
        }

        .psychometric-section .badge-custom.higly-aligned,
        .psychometric-section .advance-higly-aligned {
            color: #7F66CA !important;
            background: #E1D8FB;
        }

        .psychometric-section .badge-custom.aligned,
        .psychometric-section .Intermediate-critical {
            color: #108585 !important;
            background: #B2ECEC;
        }

        .psychometric-section .circle-content {
            width: 100.069px;
            height: 99.347px;
            display: block;
            border-radius: 50%;
            border-width: 9px;
            border-style: solid;
        }

        .psychometric-section .circle-content.circle-low {
            border-color: #FF8277;
            background: #ffcdd2;
        }

        .psychometric-section .circle-content.circle-moderate {
            border-color: #FFEBB4;
            background: #FFDC92;
        }

        .psychometric-section .circle-content.circle-high {
            border-color: #d4f0d9;
            background: #DDF5E2;
        }

        .psychometric-section .circle-content span {
            position: relative;
            top: 40%;
            left: 10%;
            font-size: 14.151px;
            line-height: 20.216px;
        }

        .psychometric-section .color-moderate {
            color: #F7941C;
        }

        .psychometric-section .color-low {
            color: #d32f2f;
        }

        .psychometric-section .color-high {
            color: #196329;
        }

        .psychometric-section h2 {
            font-size: 24px;
            line-height: normal;
        }

        .psychometric-section h5 {
            color: #5B5B5B;
            font-size: 20px;
            line-height: normal;
            margin-bottom: 8px;
        }

        .psychometric-section .overview-heading {
            color: #5B5B5B;
            font-size: 16px;
            line-height: 22px;
            margin-bottom: 6px;
        }

        .psychometric-section .overview-sub-heading {
            color: #666;
            font-size: 14px;
            line-height: 20px;
        }

        .psychometric-section .moderate-icon {
            transform: rotate(45deg);
            color: #FFCD44;
        }

        .moderate-icon {
            transform: rotate(45deg);
            color: #FFCD44; 
        }

        .psychometric-section .reset-setting-text {
            color: #99A1B7;
            font-size: 12px;
            line-height: 15px;
        }

        .psychometric-section .box-top-text {
            font-size: 24px;
        }

        .psychometric-section .view-all-text {
            color: #F7941C;
            font-size: 12px;
            font-weight: 400;
            line-height: 15px;
        }

        .psychometric-section .grid-template {
            grid-template-columns: 57% 41.5%;
            gap: 17px;
        }

        .psychometric-section .skill-table {
            display: grid;
            gap: 30px;
        }

        .psychometric-section .skill-table .table-desc {
            margin: 0;
        }

        .psychometric-section .inner-table {
            display: grid;
            grid-template-columns: 62% 32%;
            gap: 30px;
            align-items: flex-start;
        }

        .psychometric-section .orange-bg .table-desc {
            margin: 0;
        }

        .psychometric-section .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
            line-height: 15px;
        }

        .psychometric-section .left-table-head {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
        }

        .psychometric-section .left-table-head p {
            margin-bottom: 5px;
        }

        .psychometric-section .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .psychometric-section .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .psychometric-section .line-grey {
            background-color: #e6e6e6;
            position: relative;
            margin-top: 15px;
            width: 100%;
            height: 15px;
            background: #EBEBEB;
        }

        .psychometric-section .line-orange {
            height: 15px;
        }

        .psychometric-section .line {
            border-radius: 7.14px;
        }

        .psychometric-section .line-bottom {
            background: #E1E1E1;
            width: 100%;
            height: 1px;
        }

        .psychometric-section .line-orange {
            height: 15px;
        }

        .psychometric-section .side-line-orange {
            padding-left: 15px;
            border-left: 2px solid #FABB6E;
        }

        .psychometric-section .dark-orange {
            background: #F7941C;
        }

        .psychometric-section .light-orange {
            background: #FFC549;
        }

        .psychometric-section .orange {
            background: #F9A845;
        }

        .psychometric-section .svg-round-icon {
            position: absolute;
            top: -32%;
            display: block;
            width: 24px;
            height: 24px;
            background: #F7941C;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .psychometric-section .right-table .badge-content {
            font-size: 14px;
            line-height: normal;
        }

        .psychometric-section .teal {
            color: #108585;
        }

        .psychometric-section .green {
            color: #2AA443;
        }

        .psychometric-section .purple {
            color: #997BF2;
        }

        .psychometric-section .yellow {
            color: #F7941C;
        }

        .psychometric-section .badge {
            padding: 3px 7px;
            border-radius: 10px;
            font-size: 10px;
            text-transform: uppercase;
        }

        .psychometric-section .color-teal {
            background: #B2ECEC;
            color: #0C6464;
        }

        .psychometric-section .color-green {
            background: #BBECC5;
            color: #218336;
        }

        .psychometric-section .color-purple {
            background: #E1D8FB;
            color: #7F66CA;
        }

        .psychometric-section .color-cyan {
            background: #B2ECEC;
            color: #108585;
        }

        .psychometric-section .color-yellow {
            background: #FFEBB4;
            color: #F7941C;
        }

        .psychometric-section .orange-basic {
            background: #FDE2C1;
            color: #F7941C;
        }

        .psychometric-section .orange-bg {
            padding: 10px 10px 10px 15px;
            background: #FFF6EA;
            border-left: 2px solid #FABB6E;
        }

        .psychometric-section .esi-text {
            color: #F7941C;
            font-size: 36px;
            line-height: normal;
        }

        .psychometric-section .progress-container {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 15px;
            height: 16px;
            background-color: #f0f0f0;
            position: relative;
            display: table;
            border-collapse: collapse;
        }

        .psychometric-section .progress-fill {
            display: table-row;
        }

        .psychometric-section .progress-segment {
            display: table-cell;
            height: 16px;
        }

        .psychometric-section .segment-yellow,
        .psychometric-section .segment-orange,
        .psychometric-section .segment-blue {
            width: 33.33%;
        }

        .psychometric-section .segment-yellow {
            background-color: #FFD76A;
        }

        .psychometric-section .segment-orange {
            background-color: #99E2A8;
        }

        .psychometric-section .segment-blue {
            background-color: #65DADA;
        }

        .psychometric-section .progress-circle {
            position: absolute;
            top: -38%;
            display: block;
            width: 28px;
            height: 28px;
            background: #14A6A6;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .psychometric-section .back-button {
            color: #F7941C;
            font-size: 14px;
            text-transform: capitalize;
        }

        .color-result p {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
            line-height: 15px;
        }

        .small-box {
            width: 28.442px;
            height: 6.477px;
            display: block;
        }

        .small-box.wrong {
            background-color: #FFDC92;
        }

        .small-box.correct {
            background-color: #8CE3E3;
        }

        .small-box.missed {
            background-color: #BBA7F6;
        }
    </style>

    <style>
        .job-centric h4 {
            height: 34px;
            padding: 4px 10px;
            background: #FFF6EA;
            color: #5B5B5B;
            font-size: 14px;
            line-height: 18px;
            text-transform: uppercase;
        }

        .job-centric .icon-p {
            gap: 8px;
            color: #666;
            font-size: 14px;
            line-height: 20px;
        }

        .job-centric .icon-p-border {
            padding: 10px;
            border: 1px solid #EBEBEB;
        }

        .job-centric-sticky p {
            color: #5B5B5B;
            font-size: 12px;
            line-height: 16px;
            text-transform: uppercase;
            padding: 15px;
        }

        .psychometric-section .strip {
            width: 42px;
            height: 7px;
            display: block;
        }

        .psychometric-section .small-strip {
            width: 24px;
            height: 5px;
            display: block;
        }

        .psychometric-section .strip.dark-red,
        .psychometric-section .small-strip.dark-red {
            color: #FF6355;
        }

        .psychometric-section .strip.light-orange,
        .psychometric-section .small-strip.light-orange {
            background-color: #FFDC92;
        }

        .psychometric-section .strip.dark-orange,
        .psychometric-section .small-strip.dark-orange {
            background-color: #FFAE00;
        }

        .psychometric-section .strip.grey,
        .psychometric-section .small-strip.grey {
            background-color: #EBEBEB;
        }

        .light-green {
            background-color: #ddf5e2;
        }

        .medium-green {
            background-color: #99e2a8;
        }

        .dark-green {
            background-color: #2aa443;
        }

        .dark-red {
            background-color: #FF6355;
        }

        .green-icon-color {
            color: #2AA443;
        }

        .rotate-90-red {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #FF6355;
            background: #FF6355;
            clip-path: polygon(
                50% 0%,   
                100% 52%, 
                54% 52%,   
                100% 100%, 
                0% 100%,   
                46% 52%,   
                0% 52%    
            );
        }

        .rotate-90-green {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #2AA443;
            background: #2AA443;
            clip-path: polygon(
                50% 0%,   
                100% 52%, 
                54% 52%,   
                100% 100%, 
                0% 100%,   
                46% 52%,   
                0% 52%    
            );
        }

        .rotate-minus-90-red {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #FF6355;
            background: #FF6355;
            clip-path: polygon(
                0% 0%,      
                100% 0%,    
                57% 48%,   
                100% 48%,   
                50% 100%,  
                0% 48%,    
                43% 48%    
            );
        }

        .rotate-minus-90-green {
            display: inline-block;
            width: 16px;
            height: 16px;
            color: #2AA443;
            background: #2AA443;
            clip-path: polygon(
                0% 0%,      
                100% 0%,    
                57% 48%,   
                100% 48%,   
                50% 100%,  
                0% 48%,    
                43% 48%    
            );
        }

        .red-icon-color,
        .red-circle-icon {
            color: #FF6355;
        }

        .green-circle-icon {
            color: #54CF6E;
        }

        .psych-inner,
        .psych-inner-2,
        .psych-inner-3 {
            padding: 30px 40px 45px 40px;
        }
        .cognitive-orange {
            background: #FFEBB4;
            color: #F7941C; /* Darker text for contrast */
        }

        .cognitive-green {
            background: #BBECC5;
            color: #218336; /* Darker green text */
        }

        .cognitive-blue {
            background: #B2ECEC;
            color: #108585; /* Darker teal text */
        }


        
    </style>

    <style>
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

        .svg-round {
            border: 5px solid #fff;
            background-color: #465F3F;
            border-radius: 50px;
            width: 25px;
            height: 25px;
        }

        .blue-round {
           background: #14A6A6;
           color: #14A6A6;
        }

        .green-round {
           background: #2AA443;
           color: #32C551;
        }

        .yellow-round {
           background: #FFAE00;
           color: #FFC549;
        }
    </style>

@endsection

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Employee Details
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="/admin/dashboard" class="text-muted text-hover-primary">
                                Home </a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            Organization Structure </li>
                                                    <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="/admin/myemployee" class="text-muted text-hover-primary">
                                Employee List
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            {{ $user->name ?? '' }} </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card mb-10">
                    <div class="card-body profile-card pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-wrap gap-7 flex-sm-nowrap mb-11">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="{{ asset($user->profile_picture ?? asset('images/default-user.svg')) }}"  onerror="this.onerror=null; this.src='{{ asset('images/default-user.svg') }}';" 
                                        alt="image" />
                                </div>
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column gap-4">
                                        <div class="d-flex align-items-center">
                                            {{-- <a href="#"
                                                class="text-gray-900 fs-2 fw-bolder me-1 lh-base">{{ $user->first_name ?? '' }}
                                                {{ $user->middle_name ?? '' }}
                                                {{ $user->last_name ?? '' }}
                                            </a> --}}
                                            <a href="#"
                                                class="text-gray-900 fs-2 fw-bolder me-4 lh-base">
                                                {{ $user->name ?? trim(($user->first_name ?? '') . ' ' . ($user->middle_name ?? '') . ' ' . ($user->last_name ?? '')) }}
                                            </a>

                                            @if ($user->is_high_potential)
                                                <p class="high table-status mb-0 mr-2 ml-3" style="margin-right: 4px;">Bookmarked</p>
                                            @endif

                                            @if ($strategicInsight['potential_value'] != 0)
                                                <p class="{{ config('helpers.strategic_insight_potential_class')[$strategicInsight['potential_value']] }} table-status mb-0 mr-2 ml-3" style="margin-right: 4px;"> {{ $strategicInsight['potential_title'] ?? 'N/A' }}</p>
                                            @endif
                                            @if ($strategicInsight['alignment_value'] != 0)
                                                <p class="{{ config('helpers.strategic_insight_alignment_class')[$strategicInsight['alignment_value']] }} table-status mb-0 mr-2 ml-3" style="margin-right: 4px;"> {{ $strategicInsight['alignment_title'] ?? 'N/A' }}</p>
                                            @endif
                                            <p class="moderate table-status m-0" id="successorText" style="display: none;">
                                                SUCCESSOR: Rostering Planning Supervisor
                                            </p>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                                            {{-- <a href="#"
                                            class="d-flex align-items-center text-gray-500 me-2 fw-normal">
                                            Behavioral Fit Rate:
                                            {{ config('helpers.behavior_fit_rate_levels')[$level] ?? '' }}
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 me-2 fw-normal">
                                            |
                                        </a> --}}
                                            <a href="#"
                                                class="d-flex align-items-center me-2 fw-normal gap-2"
                                                style="color: #4B5675; cursor: unset;">
                                                Job Title:
                                                <b
                                                    class="ml-1">{{ $user->job_position->title ?? ($user->job_title ?? '') }}</b>
                                            </a>
                                            {{-- <a href="#"
                                            class="d-flex align-items-center text-gray-500 me-2 fw-normal">
                                            |
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 me-2 fw-normal">
                                            Department: {{ $user->department->name ?? 'N/A' }} </a> --}}
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                                            {{-- <a href="#"
                                            class="d-flex align-items-center text-gray-500 me-2 fw-normal">
                                            Section: {{ $user->departmentSection->name ?? 'N/A' }}
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 me-2 fw-normal">
                                            |
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 me-2 fw-normal">
                                            Unit: {{ $user->sectionUnit->name ?? 'N/A' }} </a> --}}
                                            <a href="#"
                                                class="d-flex align-items-center me-2 fw-normal gap-2"
                                                style="color: #4B5675; cursor: unset;">
                                                Behavioral Fit Rate:
                                                <b
                                                    class="ml-1 badge {{ config('helpers.applicant_details_positive_levels_class_bfr')[$softSkillScoreLevel] }}" >{{ config('helpers.behavior_fit_rate_levels')[$softSkillScoreLevel] ?? '' }}</b>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                                            {{-- <a href="#"
                                            class="d-flex align-items-center text-gray-500 me-2 fw-normal">
                                            Emp ID: #EMP{{ $user->id ?? 'N/A' }}
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 me-2 fw-normal">
                                            |
                                        </a> --}}
                                            <a href="#"
                                                class="d-flex align-items-center me-2 fw-normal gap-2"
                                                style="color: #4B5675; cursor: unset;">
                                                Date of Hire:
                                                <b
                                                    class="ml-1">
                                                    @if (!($user->date_of_hire) || ($user->date_of_hire == '1900-01-01') || ($user->date_of_hire == '0000-00-00'))
                                                        N / A
                                                    @else
                                                       {{ \Carbon\Carbon::parse($user->date_of_hire)->format('F d, Y') ?? 'N/A' }}
                                                    @endif
                                                    </b>
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center me-2 fw-normal"
                                                style="color: #4B5675;">
                                                |
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center me-2 fw-normal gap-2"
                                                style="color: #4B5675; cursor: unset;">
                                                Employment Status:
                                                <b
                                                    class="ml-1">{{ config('constants.EMPLOYMENT_STATUSES.' . $user->employment_status) ?? 'Full Time' }}</b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex" style="height: fit-content;">
                                @php
                                    $isDownloadable = 
                                        $user->is_personality_motivation_completed == 1 &&
                                        $user->is_work_interest_completed == 1 &&
                                        $user->is_cognitive_ability_completed == 1;
                                @endphp

                                <a 
                                    class="btn {{ $isDownloadable ? 'btn-primary' : 'btn-secondary' }} me-4" 
                                    style="height: fit-content; {{ !$isDownloadable ? 'pointer-events: none; opacity: 0.6;' : '' }}" 
                                    href="{{ $isDownloadable ? route('admin.employee.details.download_report', $user->id) : '#' }}"
                                >
                                    <span class="indicator-label d-flex align-items-center gap-2">
                                        <iconify-icon icon="material-symbols:download-rounded" width="24" height="24"></iconify-icon> 
                                        Download
                                    </span>
                                </a>
                                <a href="mailto:{{ $user->email }}" class="btn btn-light" style="height: fit-content;">
                                    <span class="indicator-label d-flex align-items-center gap-2">
                                        <iconify-icon icon="tabler:send" width="20" height="20"></iconify-icon>
                                        Send Reminder Email
                                    </span>
                                </a>
                                
                            </div>
                        </div>
                        <ul class="nav nav-tabs nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'overview' ? 'active' : '' }} {{ request()->get('page') == '' ? 'active' : '' }}"
                                    href="?page=overview">Overview</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'psychometric-insights' ? 'active' : '' }}"
                                    href="?page=psychometric-insights">AirAsia Psychometric Insights
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'company-values' ? 'active' : '' }}"
                                    href="?page=company-values">
                                    @if (in_array(env('DB_DATABASE'), ['aboitiz_food_dev', 'aboitiz_food_prod']))
                                       Aboitiz Values
                                    @elseif(in_array(env('DB_DATABASE'), ['jgs_olefins_dev', 'jgs_olefins_prod']))
                                       JGS Values
                                    @else
                                      Values
                                    @endif
                                    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'psychometric' ? 'active' : '' }}"
                                    href="?page=psychometric">Psychometric
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'job-centric-report' ? 'active' : '' }}"
                                    href="?page=job-centric-report">Job-Centric Assessment Report
                                </a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'performance' ? 'active' : '' }}"
                                    href="?page=performance">Performance Review</a>
                            </li>
                           {{-- <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'succession' ? 'active' : '' }}"
                                    href="#">Succession
                                    Plan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'detail_career' ? 'active' : '' }}"
                                    href="#">Career
                                    Pathing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'detail_skill' ? 'active' : '' }}"
                                    href="#">Individual
                                    Development Plan (IDP)</a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'performance' ? 'active' : '' }}"
                                    href="?page=performance">Performance &
                                    Skill Review</a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'succession' ? 'active' : '' }}"
                                    href="?page=succession">Succession
                                    Plan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'detail_career' ? 'active' : '' }}"
                                    href="?page=detail_career">Career
                                    Pathing</a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'detail_comparison' ? 'active' : '' }}"
                                    href="?page=detail_comparison">Career
                                    Comparison</a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6 {{ request()->get('page') == 'detail_skill' ? 'active' : '' }}"
                                    href="?page=detail_skill">Individual
                                    Development Plan (IDP)</a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link text-active-primary fw-bold fs-6"
                                    href="#kt_tab_pane_operations">Operations</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">

                    <!--begin:: Panel 1-->


                    @php
                        $page = request()->get('page');
                    @endphp

                    @switch($page)
                        @case('overview')
                            @include('admin.employee-detail.detail_overview')
                        @break

                        @case('psychometric')
                            @include('admin.employee-detail.detail_psychometric')
                        @break

                        @case('job-centric-report')
                            @include('admin.employee-detail.job-centric-report')
                        @break

                        @case('psychometric-insights')
                            @include('admin.employee-detail.detail_psychometric_insights')
                        @break

                        @case('company-values')
                            @include('admin.employee-detail.detail_company_values')
                        @break

                        @case('performance')
                            @include('admin.employee-detail.performance')
                        @break

                        @case('succession')
                            @include('admin.employee-detail.succession')
                        @break

                        @case('detail_career')
                            @include('admin.employee-detail.detail_career')
                        @break

                        @case('detail_comparison')
                            @include('admin.employee-detail.detail_comparison')
                        @break

                        @case('detail_skill')
                            @include('admin.employee-detail.detail_skill')
                        @break

                        @default
                            @include('admin.employee-detail.detail_overview')
                    @endswitch



                    <!--begin::Panel 3-->






                    <!--begin::Panel 5-->

                    <!--end::Panel 5-->


                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
    @if (request()->get('page') == 'performance')
        <script>
            // Pass the ratings data from PHP to JavaScript using JSON encoding
            var ratingsData = @json($ratingsData); // This is all the data for the years
        
            // Initialize the chart with the initial data
var options = {
    series: [{
        name: "Rating",
        data: ratingsData.data // Y-axis values from the backend
    }],
    chart: {
        height: 340,
        type: 'line',
        toolbar: {
            show: false
        } // Disable toolbar
    },
    stroke: {
        width: 4, // Thicker line
        curve: 'straight'
    },
    markers: {
        size: 12, // Bigger round dots
        colors: ['#F7941C'],
        strokeWidth: 3,
        hover: {
            size: 14
        }
    },
    xaxis: {
        categories: ratingsData.categories, // X-axis labels from the backend
        labels: {
            offsetY: 20, // Move X-axis labels downward
            style: {
                colors: '#000',
                fontSize: '16px', // px is required
                fontWeight: 500,
                lineHeight: '46.8px'
            }
        },
        tooltip: {
        enabled: false
    }
    },
    yaxis: {
        min: 0,
        max: 4,
        tickAmount: 4, // Only show a few ticks (e.g., 1, 2.5, 4)
        labels: {
            style: {
                colors: '#000',
                fontSize: '16px',
                fontWeight: 500,
                lineHeight: '46.8px'
            },
            formatter: function(value) {
                return value;
            }
        }
    },
    colors: ['#F7941C'], // Orange line
    dataLabels: {
        enabled: false
    },
    grid: {
        borderColor: '#ccc',
        padding: {
            bottom: 20, // Ensure X-axis labels don't get cut off
            left: 30   // If Y-axis labels are cut off, increase this
        }
    }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

        
            // Attach change event listener to the year dropdown
            document.getElementById('yearSelect').addEventListener('change', function() {
                var selectedYear = this.value;
        
                // If no year is selected, reset to show all data
                if (!selectedYear) {
                    chart.updateOptions({
                        series: [{
                            name: "Data Points",
                            data: ratingsData.data // Show all years' data
                        }],
                        xaxis: {
                            categories: ratingsData.categories // Show all categories
                        }
                    });
                    return;
                }
        
                // Filter data based on selected year
                var filteredData = {
                    categories: [],
                    data: []
                };
        
                // Loop through all categories and data, filter by the selected year
                for (var i = 0; i < ratingsData.categories.length; i++) {
                    if (ratingsData.categories[i] === "Year " + selectedYear) {
                        filteredData.categories.push(ratingsData.categories[i]);
                        filteredData.data.push(ratingsData.data[i]);
                    }
                }

                // If only 1 point, add a dummy null so the marker stays visible
                if (filteredData.data.length === 1) {
                    filteredData.categories.push('');
                    filteredData.data.push(null);
                }
        
                // Update the chart with filtered data for the selected year
                chart.updateOptions({
                    series: [{
                        name: "Data Points",
                        data: filteredData.data // Update Y-axis values for the selected year
                    }],
                    xaxis: {
                        categories: filteredData.categories // Update X-axis labels for the selected year
                    }
                });
            });
        </script>
    @endif

    @if (request()->get('page') == 'psychometric')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var totalCorrectForCognitive = {{ $totalCorrectForCognitive }} * 2;
                var totalWrongForCognitive = {{ $totalWrongForCognitive }} * 2;
                var totalNonAttemptedForCognitive = {{ $totalNonAttemptedForCognitive }} * 2;

                // Ensure total doesn't exceed 100
                var totalSum = totalCorrectForCognitive + totalWrongForCognitive + totalNonAttemptedForCognitive;
                if (totalSum > 100) {
                    var scaleFactor = 100 / totalSum;
                    totalCorrectForCognitive *= scaleFactor;
                    totalWrongForCognitive *= scaleFactor;
                    totalNonAttemptedForCognitive *= scaleFactor;
                }

                var options = {
                    chart: {
                        type: 'donut',
                        height: 550
                    },
                    series: [totalCorrectForCognitive, totalWrongForCognitive, totalNonAttemptedForCognitive],
                    labels: ['Correct Answers', 'Wrong Answers', 'Missed Questions'],
                    colors: ['#8CE3E3', '#FFDC92', '#BBA7F6'],
                    stroke: {
                        width: 3
                    },
                    // dataLabels: {
                    //     enabled: false
                    // },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            // return val + '%';
                        },
                        style: {
                            fontSize: '10px',
                            fontWeight: 'lighter',
                            fontFamily: 'Roboto, sans-serif',
                            lineHeight: 1.2,
                            colors: ['#333'],
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '80%'
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'center'
                    },
                    tooltip: {
                        enabled: true,
                        custom: function({
                            series,
                            seriesIndex,
                            w
                        }) {
                            const labels = w.globals.labels;
                            const value = series[seriesIndex].toFixed(0) * 0.5
                            const label = labels[seriesIndex].toUpperCase();

                            // Define dynamic styles per index
                            const bgColors = ['#E2F6F6', '#FFF6EA', '#F2EEFD'];
                            const textColors = ['#108585', '#CE7B17', '#6652A1'];

                            const background = bgColors[seriesIndex];
                            const textColor = textColors[seriesIndex];

                            return `
                                <div class="custom-tooltip" style="background:${background};color:${textColor};">
                                    <div class="percentage" style="color:${textColor};">${value}</div>
                                    <div class="label" style="color:${textColor};">${label}</div>
                                </div>
                            `;
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#cognitiveChart"), options);
                chart.render();


            });
        </script>
    @endif

    <script>
        document.getElementById("tagSuccessor").addEventListener("click", function() {
            document.getElementById("successorText").style.display = "block";
            document.getElementById("tagSuccessor").style.display = "none";
            document.getElementById("removeSuccessor").style.display = "block";
        });

        document.getElementById("removeSuccessor").addEventListener("click", function() {
            document.getElementById("successorText").style.display = "none";
            document.getElementById("tagSuccessor").style.display = "block";
            document.getElementById("removeSuccessor").style.display = "none";
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const button = document.querySelector(".all-star-btn");
            const content = document.querySelector(".content-placeholder");

            button.addEventListener("click", function() {
                if (content.style.display === "none" || content.style.display === "") {
                    // Show content
                    content.style.display = "grid";
                    button.textContent = "Hide All Allstar Values";
                } else {
                    // Hide content
                    content.style.display = "none";
                    button.textContent = "View All Allstar Values";
                }
            });
        });
    </script>



@endsection
