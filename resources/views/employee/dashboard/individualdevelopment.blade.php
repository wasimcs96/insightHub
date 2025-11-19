@extends('employee.layout.app')

@section('title', 'Dashboard')

@section('styles')
    <style>
        h1 {
            color: aquamarine;
        }

        body {
            background-color: #FCFCFC !important;
            margin: 0px;
        }

        .row-div {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .col-div {
            display: flex;
            flex-direction: column;

        }

        .icon_wrapper {
            height: 8px;
        }

        .gap-analysis-code {
            font-style: normal;
            font-weight: 500;
            font-size: 19.5px;
            line-height: 23px;
            /* identical to box height, or 120% */

            color: #1E1E1E;


        }

        .upper-wrapper {
            margin: 1rem 2rem;
            padding: 0;
        }

        .section-wrapper {
            margin: 20px 0px;
        }

        .turnaround-text {
            font-style: normal;
            font-weight: 700;
            font-size: 19.5px;
            line-height: 23px;
            /* identical to box height, or 120% */

            color: #1E1E1E;

        }

        .total-hours-text {
            /* Total Hours Required to Complete: 48 Hours */
            font-style: normal;
            font-weight: 500;
            font-size: 14.95px;
            line-height: 20px;
            /* identical to box height, or 130% */

            color: #071437;



        }

        /* ----------------------------------------------- chips styles ---------------------------- */

        .chip-yellow {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 12px;

            background: #FEF2E2;
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
            color: #CE7B17;



            /* Inside auto layout */

        }

        .next-career-chip {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 12px;

            background: #E2F6F6;
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
            color: #108585;



            /* Inside auto layout */

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

        .basic-chip {
            /* Frame 330 */

            /* Auto layout */

            padding: 3px 7px;

            /* Success/Green 20 */
            background: #BBECC5;
            border-radius: 10px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            text-transform: uppercase;

            /* Success/Green 80 */
            color: #218336;

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

        .courses_enrolled_chips {
            /* Label */

            /* AirAsia levels */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 8px 12px;
            gap: 2px;
            /* AirAsia red 10 */
            background: #FFE8E8;
            border-radius: 80px;

            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 10px;
            /* identical to box height */
            text-transform: uppercase;

            /* AirAsia red 50 */
            color: #FF2E2E;



        }

        .card-progress-chip {

            font-style: normal;
            font-weight: 600;
            font-size: 8px;
            line-height: 10px;
            /* identical to box height */
            text-transform: uppercase;

            /* Teal/Teal 80 */
            color: #108585;

            /* AirAsia Alignment */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 12px;

            width: 78px;
            height: 18px;

            /* Teal/Teal 20 */
            background: #B2ECEC;
            border-radius: 80px;




        }

        .card-completed-chip {

            font-style: normal;
            font-weight: 600;
            font-size: 8px;
            line-height: 10px;
            /* identical to box height */
            text-transform: uppercase;

            /* Teal/Teal 80 */
            color: #FF2E2E;

            /* AirAsia Alignment */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 12px;

            width: 78px;
            height: 18px;

            /* Teal/Teal 20 */
            background: #FFE8E8;
            border-radius: 80px;




        }


        /* ----------------------------------------------- chips styles ---------------------------- */


        .tabs-container {
            overflow: hidden;
            /* Keeps the border-radius intact */
            cursor: pointer;
            /* Adds interactivity */
        }

        /* Selected tab styling */
        .tab.selected {
            background: #F7941D;
            color: #FFFFFF;
            border: 1px solid #F7941C;
        }

        /* Unselected tab styling */
        .tab:not(.selected) {
            background: #FCFCFC;
            color: #F7941D;
            border: 1px solid #F7941D;
        }

        /* Add a hover effect (optional for better UX) */
        .tab:hover {
            opacity: 0.9;
        }

        .tabs-job-position-one {
            /* Toggle Tab */
            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 10px 15px;
            border-radius: 6px 0px 0px 6px;
            background: #F7941D;
            border: 0px solid #F7941C;
            /* Label/Medium/Semi Bold */
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 16px;

            /* Shades/White */
            color: #FFFFFF;


        }

        .tabs-job-position-two {
            /* Toggle */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 10px 15px;
            background: #FCFCFC;
            border: 1px solid #F7941D;
            border-radius: 0px 6px 6px 0px;
            /* Label/Medium/Semi Bold */
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */

            color: #F7941D;

        }

        /* ----------------------------------------------------- Table Desing ------------------------------------- */

        .table-container {
            /* max-width: 1200px; */
            margin: 20px auto;
            /* border: 1px solid #e0e0e0; */
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #fff;
            /* Set the header background to white */
            /* border-bottom: 2px solid #e0e0e0; */
            /* Add a bottom border to the header */
        }

        thead th {
            text-align: left;
            padding: 15px;
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */

            color: #99A1B7;
        }

        tbody td {
            padding: 15px;
            font-size: 14px;
            color: #333;
            border-top: 1px solid #e0e0e0;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 15px;
            color: #fff;
            font-size: 12px;
            display: inline-block;
        }

        .chip-advanced {
            /* Frame 329 */

            /* Auto layout */

            padding: 3px 7px;

            /* Purple/Purple 20 */
            background: #E1D8FB;
            border-radius: 10px;
            /* ADVANCED */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            text-transform: uppercase;

            /* Purple/Purple 70 */
            color: #7F66CA;




        }

        .badge.basic {
            background-color: #87cefa;
        }

        .badge.advanced {
            background-color: #d7aefb;
        }

        .status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
        }

        .status.completed {
            background-color: #c8e6c9;
            color: #2e7d32;
        }

        .status.in-progress {
            background-color: #FFF3E0;
            color: #975102;
        }

        .status.enrolled {
            background-color: #e3f2fd;
            color: #1e88e5;
        }

        .progress-bar {
            width: 100%;
            background-color: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            height: 8px;
        }

        .progress {
            height: 100%;
            background-color: #ff9800;
            position: absolute;
        }

        .progress-text {
            margin-left: 8px;
            font-size: 12px;
            color: #555;
        }

        tbody td {
            vertical-align: top;
            padding-top: 20px;
        }

        td {
            vertical-align: top;
            padding-top: 20px;

        }

        .body-text {
            vertical-align: top;
            padding-top: 20px;
            /* Communication */
            /* M3/title/small */
            font-style: normal;

            font-weight: 500;
            font-size: 14px;
            line-height: 20px;
            /* identical to box height, or 143% */
            letter-spacing: 0.1px;

            color: #4B5675;

        }

        .head-text {
            /* SS/TS Needs to Improve */
            /* Label/Medium/Semi Bold */
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */

            color: #99A1B7;



        }

        /* ----------------------------------------------------- Table Desing ------------------------------------- */


        .suggestion-head-text {
            /* Heading/H4/Medium */
            font-style: normal;
            font-weight: 500;
            font-size: 16.25px;
            line-height: 20px;
            /* identical to box height, or 120% */

            color: #071437;


        }

        .suggestion-sub-text {


            /* Short Paragraph/Small */
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 16px;
            /* or 133% */

            color: #4B5675;
        }

        .suggestion-card-title {
            /* Improving Communication Skills */


            font-style: normal;
            font-weight: 500;
            font-size: 14.95px;
            line-height: 18px;
            /* or 120% */

            color: #1E1E1E;

        }


        .suggestion-card-details {
            /* Label/Medium/Regular */
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */

            color: #4B5675;

        }

        .enter-program-text {

            /* Label/Medium/Medium */
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */

            color: #4B5675;


        }


        /*--------------------------------------------------------- Progress Bar ---------------------------------------- */


        .progress-bar-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background-color: #DBDFE9 !important;
            /* Light gray background */
            border-radius: 10px;
            overflow: hidden;
            /* border: 2px solid #0078d7;  */
        }

        .progress-fill {
            height: 100%;
            background-color: #ff4d4d;
            /* Red progress bar color */
            border-radius: 10px 10px 10px 10px;
            /* Ensure smooth edges */
        }

        .progress-percentage {
            /* 64% */

            /* Label/Medium/Medium */
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */
            text-align: right;

            color: #4B5675;

        }
    </style>
    <style>
        .app-wrapper {
            margin-top: 74px !important;
        }

        .app-content {
            padding-top: 15px !important;
        }

        .app-container {
            padding: 0px !important;
            margin: 0px 186px !important;
        }

        .nav-link {
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

        .psych-inner {
            padding: 30px 40px 45px 40px;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
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
            font-size: 12px;
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

        .bg-white {
            border-radius: 8px;
            background: #F1F1F4;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .inner-table {
            display: grid;
            grid-template-columns: 47% 47%;
            gap: 70px;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
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
        .cyan,
        .orange,
        .spring {
            font-size: 12px;
            font-weight: 600;
            line-height: normal;
        }

        .purple span,
        .cyan span,
        .orange span,
        .green span,
        .spring span {
            border-radius: 8px;
            position: relative;
            font-size: 11px;
            font-weight: 600;
            left: 6.4px;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .purple span {
            background: #E1D8FB;
            color: #7F66CA;
        }

        .cyan span {
            background: #B2ECEC;
            color: #108585;
        }

        .orange span {
            background: #FDE2C1;
            color: #F7941C;
        }

        .spring span {
            color: #F7941C;
            background: #FFEBB4;
        }

        .green span {
            color: #218336;
            background: #BBECC5 !important;
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

        .chip-container {
            display: flex;
            flex-wrap: wrap;
            /* Wrap to next line if necessary */
            gap: 8px;
            /* Spacing between chips */
            padding: 8px;
            width: 100%;
            /* Adjust based on your container */
            box-sizing: border-box;
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

        .dropdown-toggle::after {
            content: none;
        }


        .dropdown-toggle::after {
            content: none;
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

        .text-active-primary.active {
            color: #f7941d !important;
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

    
    </style>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <div id="kt_app_content_container" class="app-container  ">
            <div class="row mb-5 ms-0 me-0 justify-content-center mt-0">
                @include('employee.dashboard.includes.card')
                <div class="upper-wrapper">
                    <div class="row-div" style="justify-content: start;">
                        <div class="row-div" style="gap: 10px;">
                            <div class="gap-analysis-code" id="gap-analysis-text">Gap Analysis for Current Job Position: </div>
                            <img class="icon_wrapper" style="height: 16px;"
                                src="{{ asset('images/development-plan/icons/analytics_icon.png') }}"
                                alt="Flowers in Chania" />
                            <div style="color: #757575; font-size: 16px; font-family: Roboto; font-weight: 500; line-height: 24px; letter-spacing: 0.15px; word-wrap: break-word"
                                id="level-top">
                                3</div>
                            <div id="turnaround-cord" class="turnaround-text">HR Officer - People Operation & Services</div>
                            <div id="tab-chips" class="chip-yellow"> Current</div>
                        </div>
                        <div style="margin-left: auto;" class="tab-job-position-wrapper row-div tabs-container">
                            <div class="tabs-job-position-one tab selected" onclick="selectTab(this,'tab-section-one')">
                                Current Job Position
                            </div>
                            <div class="tabs-job-position-two tab " onclick="selectTab(this,'tab-section-two')">
                                Next Job Position
                            </div>
                        </div>
                        <script>
                            // JavaScript function for toggling the active tab
                            function selectTab(clickedTab, sectionToShow) {
                                // Get all tabs
                                const tabs = document.querySelectorAll('.tabs-container .tab');

                                // Remove the 'selected' class from all tabs
                                tabs.forEach(tab => tab.classList.remove('selected'));

                                // Add the 'selected' class to the clicked tab
                                clickedTab.classList.add('selected');
                                const tabContents = document.querySelectorAll('.tab-content');
                                tabContents.forEach(content => content.style.display = 'none');

                                // Show the relevant content section based on the selected tab
                                document.getElementById(sectionToShow).style.display = 'block';
                                if (sectionToShow == "tab-section-two") {
                                    document.getElementById('turnaround-cord').innerText = "Senior Manager - People Operations & Services";
                                    document.getElementById('level-top').innerText = "7";
                                    document.getElementById('gap-analysis-text').innerText = "Gap Analysis for Next Job Position: ";
                                    const chipDiv = document.getElementById('tab-chips');
                                    chipDiv.innerText = "Next Career Goal"
                                    chipDiv.className = 'next-career-chip';

                                } else {
                                    document.getElementById('turnaround-cord').innerText = "HR Officer - People Operation & Services";
                                    document.getElementById('level-top').innerText = "3";
                                    document.getElementById('gap-analysis-text').innerText = "Gap Analysis for Current Job Position: ";
                                    const chipDiv = document.getElementById('tab-chips');
                                    chipDiv.innerText = "Current"
                                    chipDiv.className = 'chip-yellow';
                                }
                            }
                        </script>
                    </div>
                    <div id="tab-section-one" class="tab-content">

                        <div class="row-div" style="justify-content: start;">
                            <div class="total-hours-text">
                                Total Hours Required to Complete: 40 Hours
                            </div>
                        </div>
                        <div class="idp-table mt-8">
                            <div class="table-row header">
                                <div>SS/TS Needs to Improve<iconify-icon icon="iconamoon:arrow-down-2-duotone"
                                        width="20" height="20"></div>
                                <div>Type<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20" height="20">
                                </div>
                                <div>Current Level<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                                <div>Skill Ascension<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                                <div>Status<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                                <div>Progress<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                                <div>Skill Endorsement<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                            </div>
                            <div class="table-row">
                                <div
                                    style="
                                                    color: #4B5675;
                                                    font-size: 14px;
                                                    font-weight: 500;
                                                ">
                                    Communication</div>
                                <div
                                    style="
                                                    color: #4B5675;
                                                    font-size: 14px;
                                                    font-weight: 500;
                                                ">
                                    Soft Skill</div>
                                <div class="green"><span
                                        style="
                                                        left: 0;
                                                    ">INTERMEDIATE</span>
                                </div>
                                <div class="purple"><span
                                        style="
                                                        left: 0;
                                                    ">ADVANCED</span>
                                </div>
                                <div class="cyan"><span
                                        style="
                                                        left: 0;
                                                        background: #DDF5E2;
                                                        padding: 4px 12px;
                                                        font-size: 10px;
                                                        font-weight: 600;
                                                        width: 100px;
                                                        text-align: center;
                                                        color: #196329;
                                                        text-transform: capitalize;
                                                        left: 0;
                                                        display: block;
                                                    ">Completed</span>
                                </div>
                                <div
                                    style="
                                                    padding: 0;
                                                ">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bar-career"
                                            style="
                                                padding: 0;
                                            ">
                                            <div class="bar" style="width: 100%;padding: 0;margin: initial;"></div>
                                        </div>
                                        <span>100%</span>
                                    </div>
                                </div>
                                <div>Approved</div>
                            </div>
                            <div class="table-row">
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Operational Excellence</div>
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Technical Skill</div>
                                <div class="badge level-2">Level 2 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div class="badge level-3">Level 5 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div class="cyan"><span
                                        style="
                                                            left: 0;
                                                            background: #DDF5E2;
                                                        padding: 4px 12px;
                                                        font-size: 10px;
                                                        font-weight: 600;
                                                        width: 100px;
                                                        text-align: center;
                                                        color: #196329;
                                                        text-transform: capitalize;
                                                left: 0;
                                                display: block;
                                                        ">Completed</span>
                                </div>
                                <div
                                    style="
                                            padding: 0;
                                        ">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bar-career"
                                            style="
                                        padding: 0;
                                    ">
                                            <div class="bar" style="width: 100%;padding: 0;margin: initial;"></div>
                                        </div>
                                        <span>100%</span>
                                    </div>
                                </div>
                                <div>Pending</div>
                            </div>
                            <div class="table-row">
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Operations Management</div>
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Technical Skill</div>
                                <div class="badge level-2">Level 1 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div class="badge level-3">Level 4 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div>
                                    <p class="m-0 s-top-right"><span class="s-yellow-right"
                                            style="
                                                    background: #FFF3E0;
                                                    padding: 4px 12px;
                                                    font-size: 10px;
                                                    font-weight: 600;
                                                    width: 100px;
                                                left: 0;
                                                    text-align: center;
                                                    letter-spacing: normal;
                                                    text-transform: capitalize;
                                                    left: 0;
                                                    display: block;
                                                                ">In
                                            Progress</span></p>
                                </div>
                                <div
                                    style="
                                                            padding: 0;
                                                        ">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bar-career"
                                            style="
                                                        padding: 0;
                                                    ">
                                            <div class="bar" style="width: 64%;padding: 0;margin: initial;"></div>
                                        </div>
                                        <span>64%</span>
                                    </div>
                                </div>
                                <div>Incomplete Requirement</div>
                            </div>
                            <div class="table-row">
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Risk Management</div>
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Technical Skill</div>
                                <div class="badge level-2">Level 0 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div class="badge level-3">Level 4 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div>
                                    <p class="m-0 s-head-span"><span class="s-career-goal"
                                            style="
                                                            left: 0;
                                                            background: #E2F6F6;
                                                        padding: 4px 12px;
                                                        font-size: 10px;
                                                        font-weight: 600;
                                                        width: 100px;
                                                        text-align: center;
                                                        color: #0C6464;
                                                        text-transform: capitalize;
                                                left: 0;
                                                display: block;
                                        ">Enrolled</span>
                                    </p>
                                </div>
                                <div
                                    style="
                                            padding: 0;
                                        ">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bar-career"
                                            style="
                                        padding: 0;
                                    ">
                                            <div class="bar" style="width: 0%;padding: 0;margin: initial;"></div>
                                        </div>
                                        <span>0%</span>
                                    </div>
                                </div>
                                <div>Incomplete Requirement</div>
                            </div>
                        </div>
                        <div class="section-wrapper">
                            <div class="row-div" style="justify-content: start; gap: 10px; margin-bottom: 20px;">
                                <img height="30px" src="{{ asset('images/development-plan/suggestion_image.png') }}"
                                    alt="Flowers in Chania" />
                                <div>
                                    <div class="suggestion-head-text">Required Training For Your Role</div>
                                    <div class="suggestion-sub-text">Complete these
                                        required
                                        courses to meet your current role's
                                        expectations</div>
                                </div>
                            </div>


                            <div class="d-flex mb-4 gap-4">
                                <div class="card col p-0  d-flex justify-content-between">
                                    <div>
                                        <img style="width: 100%"
                                            src="{{ asset('images/development-plan/splash_img.png') }}" alt="splash">
                                        <div class="success-inner d-grid">
                                            <div class="s-head-content">
                                                <div class="d-flex gap-2 align-items-center s-head-span">
                                                    <h5 class="m-0"
                                                        style="
                                            width: 200px;
                                            min-height: 40px;
                                        ">
                                                        Advanced Communication Skills</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="fluent-mdl2:date-time-12"
                                                        style="
                                                color: #99A1B7;
                                                "
                                                        width="12" height="12" class="mr-1"></iconify-icon> 1-4
                                                    weeks</p>
                                                <p class="m-0 d-flex align-items-center"> <iconify-icon
                                                        icon="ri:bar-chart-fill"
                                                        style="
                                                color: #99A1B7;
                                            "
                                                        width="12" height="12" class="mr-1"></iconify-icon>
                                                    Beginner
                                                </p>
                                            </div>
                                            <div class="s-green-text d-flex align-items-center" style="margin-top: 12px;">
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                            gap: 4px;
                                            padding: 4px 12px;
                                            font-size: 10px;
                                            line-height: 14px;
                                        ">
                                                    <p class="m-0">Organizational Communication Skills</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Leadership & Team Communication</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Problem Solving</p>
                                                </div>
                                                <span class="hidden-skills" style="display: none;">
                                                    <span class="suggestion-card-chips">Critical Thinking</span>
                                                    <span class="suggestion-card-chips">Time Management</span>
                                                    <span class="suggestion-card-chips">Conflict Resolution</span>

                                                    <!-- Add as many hidden skills as needed -->
                                                </span>
                                                <span onclick="toggleSkills(this)" class="add-skill-chip">
                                                    + 10 more skills
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="s-more-info-btn">
                                            View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                                class="s-info-btn"></iconify-icon>
                                        </div>
                                </div>
                                <div class="card col p-0  d-flex justify-content-between">
                                    <div>
                                        <img style="width: 100%" src="{{ asset('images/development-plan/hand.png') }}"
                                            alt="splash">
                                        <div class="success-inner p-4 d-grid">
                                            <div class="s-head-content">
                                                <div class="d-flex gap-2 align-items-center s-head-span">
                                                    <h5 class="m-0"
                                                        style="
                                            width: 200px;
                                            min-height: 40px;
                                        ">
                                                        Organizational Performance Management</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="fluent-mdl2:date-time-12"
                                                        style="
                                                color: #99A1B7;
                                                "
                                                        width="12" height="12" class="mr-1"></iconify-icon> 1-4
                                                    weeks</p>
                                                <p class="m-0 d-flex align-items-center"> <iconify-icon
                                                        icon="ri:bar-chart-fill"
                                                        style="
                                                color: #99A1B7;
                                            "
                                                        width="12" height="12" class="mr-1"></iconify-icon>
                                                    Beginner
                                                </p>
                                            </div>
                                            <div class="s-green-text d-flex align-items-center" style="margin-top: 12px;">
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Performance Management</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Operations Management</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Strategic Human Resource Management</p>
                                                </div>
                                                <span class="hidden-skills" style="display: none;">
                                                    <span class="suggestion-card-chips">Critical Thinking</span>
                                                    <span class="suggestion-card-chips">Time Management</span>
                                                    <span class="suggestion-card-chips">Conflict Resolution</span>

                                                    <!-- Add as many hidden skills as needed -->
                                                </span>
                                                <span onclick="toggleSkills(this)" class="add-skill-chip">
                                                    + 10 more skills
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                    <div class="s-more-info-btn">
                                        View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                            class="s-info-btn"></iconify-icon>
                                    </div>
                                </div>

                                <div class="card col p-0  d-flex justify-content-between">
                                    <div>
                                        <img style="width: 100%"
                                            src="{{ asset('images/development-plan/splash_img.png') }}" alt="splash">
                                        <div class="success-inner p-4 d-grid">
                                            <div class="s-head-content">
                                                <div class="d-flex gap-2 align-items-center s-head-span">
                                                    <h5 class="m-0"
                                                        style="
                                            width: 200px;
                                            min-height: 40px;
                                        ">
                                                        Handling Accident and Incident in Organization</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="fluent-mdl2:date-time-12"
                                                        style="
                                                color: #99A1B7;
                                                "
                                                        width="12" height="12" class="mr-1"></iconify-icon> 1-4
                                                    weeks</p>
                                                <p class="m-0 d-flex align-items-center"> <iconify-icon
                                                        icon="ri:bar-chart-fill"
                                                        style="
                                                color: #99A1B7;
                                            "
                                                        width="12" height="12" class="mr-1"></iconify-icon>
                                                    Beginner
                                                </p>
                                            </div>
                                            <div class="s-green-text d-flex align-items-center" style="margin-top: 12px;">
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Communication</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Accident and Incident Response Management</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Problem Solving</p>
                                                </div>
                                                <span class="hidden-skills" style="display: none;">
                                                    <span class="suggestion-card-chips">Critical Thinking</span>
                                                    <span class="suggestion-card-chips">Time Management</span>
                                                    <span class="suggestion-card-chips">Conflict Resolution</span>

                                                    <!-- Add as many hidden skills as needed -->
                                                </span>
                                                <span onclick="toggleSkills(this)" class="add-skill-chip">
                                                    + 10 more skills
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                    <div class="s-more-info-btn">
                                        View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                            class="s-info-btn"></iconify-icon>
                                    </div>
                                </div>

                                <div class="card col p-0  d-flex justify-content-between">
                                    <div>
                                        <img style="width: 100%" src="{{ asset('images/development-plan/hand.png') }}"
                                            alt="splash">
                                        <div class="success-inner p-4 d-grid">
                                            <div class="s-head-content">
                                                <div class="d-flex gap-2 align-items-center s-head-span">
                                                    <h5 class="m-0"
                                                        style="
                                            width: 200px;
                                            min-height: 40px;
                                        ">
                                                        Problem-Solving and Decision-Making</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="fluent-mdl2:date-time-12"
                                                        style="
                                                color: #99A1B7;
                                                "
                                                        width="12" height="12" class="mr-1"></iconify-icon> 1-4
                                                    weeks</p>
                                                <p class="m-0 d-flex align-items-center"> <iconify-icon
                                                        icon="ri:bar-chart-fill"
                                                        style="
                                                color: #99A1B7;
                                            "
                                                        width="12" height="12" class="mr-1"></iconify-icon>
                                                    Beginner
                                                </p>
                                            </div>
                                            <div class="s-green-text d-flex align-items-center" style="margin-top: 12px;">
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Problem Solving</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Leadership & Team Management</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Decision Making</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="s-more-info-btn">
                                        View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                            class="s-info-btn"></iconify-icon>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="section-wrapper">
                            <div class="row-div" style="justify-content: start; gap: 10px; margin-bottom: 20px;">
                                <img height="20px" src="{{ asset('images/development-plan/icons/book_icon.png') }}"
                                    alt="Flowers in Chania" />
                                <div class="suggestion-head-text">Learning and Development Plan</div>

                            </div>
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Program</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>
                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Skill Program</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>

                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Estimated Time Completed</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>

                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Status</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>

                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Progress</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>

                                            </th>

                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Test result</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>

                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="body-text">Improving Communication Skills</td>
                                            <td>
                                                <div class="col-div" style="align-items: start; gap: 5px;">
                                                    <span class="status in-progress">Communication
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        2 >>
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        3
                                                    </span>
                                                    <span class="status in-progress">Customer Orientation
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        2 >>
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        3
                                                    </span>

                                                    <span class="hidden-skills" style="display: none;">
                                                        <span class="suggestion-card-chips">Critical Thinking</span>
                                                        <span class="suggestion-card-chips">Time Management</span>
                                                        <span class="suggestion-card-chips">Conflict Resolution</span>

                                                        <!-- Add as many hidden skills as needed -->
                                                    </span>
                                                    <span onclick="toggleSkills(this)" class="add-skill-chip">
                                                        + 10 more skills
                                                    </span>
                                                </div>

                                            </td>
                                            <td class="body-text">10 Hours</td>
                                            <td><span class="status completed">Completed</span></td>
                                            <td class="d-flex align-items-center gap-2">
                                                <div class="progress-bar" style="width: 100px">
                                                    <div class="progress" style="width: 100%;"></div>
                                                </div>
                                                <span class="progress-text">100%</span>
                                            </td>
                                            <td class="body-text">74%</td>

                                        </tr>

                                        <tr>
                                            <td class="body-text">Talent Performance Management
                                            </td>
                                            <td>
                                                <div class="col-div" style="align-items: start; gap: 5px;">
                                                    <span class="status in-progress">Organizational Performance Management
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        2 >>
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        3
                                                    </span>
                                                    <span class="status in-progress">Organizational Operations Management

                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        2 >>
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        3
                                                    </span>
                                                    <span class="hidden-skills" style="display: none;">
                                                        <span class="suggestion-card-chips">Critical Thinking</span>
                                                        <span class="suggestion-card-chips">Time Management</span>
                                                        <span class="suggestion-card-chips">Conflict Resolution</span>

                                                        <!-- Add as many hidden skills as needed -->
                                                    </span>
                                                    <span onclick="toggleSkills(this)" class="add-skill-chip">
                                                        + 10 more skills
                                                    </span>
                                                </div>

                                            </td>
                                            <td class="body-text">48 Hours</td>
                                            <td><span class="status in-progress">In Progress</span></td>
                                            <td class="d-flex align-items-center gap-2">
                                                <div class="progress-bar" style="width: 100px">
                                                    <div class="progress" style="width: 64%;"></div>
                                                </div>
                                                <span class="progress-text">64%</span>
                                            </td>
                                            <td class="body-text">Requirement Unmet</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="path-top-text d-flex mt-8">
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="tdesign:dart-board" width="24" height="24"></iconify-icon>
                                <div>
                                    <p class="m-0">EEI Core Value Training</p>
                                </div>
                                <div class="red-top"><span>2 / 2 courses enrolled <iconify-icon
                                            icon="material-symbols:info" width="12"
                                            height="12"></iconify-icon></span></div>
                            </div>
                        </div>
                        <div class="d-flex mb-4 gap-4">
                            <div class="card col p-0">
                                <div class="p-0">
                                    <img class="icon_wrapper" style="padding: 3%"
                                        src="{{ asset('admin/media/udenna/unity.jpg') }}" alt="splash">
                                    <div class="success-inner d-grid gap-2">
                                        <div class="s-head-content">
                                            <div
                                                class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                                <h5 class="m-0">Teamwork</h5>
                                                <div class="cyan"><span
                                                        style="
                                            letter-spacing: normal;
                                            text-transform: capitalize;
                                        ">in
                                                        progress</span></div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                                    icon="fluent-mdl2:date-time-12"
                                                    style="
                                                        color: #99A1B7;
                                                    "
                                                    width="12" height="12" class="mr-1"></iconify-icon> 1-4
                                                weeks</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career"
                                                style="
                                                            width: 100%;
                                                        ">
                                                <div class="bar"
                                                    style="width: 24%;padding: 0;margin: initial;background: #FF2E2E;">
                                                </div>
                                            </div>
                                            <span>64%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="s-more-info-btn">
                                    Continue Your Progress <iconify-icon icon="iconamoon:arrow-right-2"
                                        class="s-info-btn"></iconify-icon>
                                </div>
                            </div>
                            <div class="card col p-0">
                                <div class="p-0">
                                    <img class="icon_wrapper" style="padding: 3%"
                                        src="{{ asset('admin/media/udenna/drive.jpg') }}" alt="splash">
                                    <div class="success-inner d-grid gap-2">
                                        <div class="s-head-content">
                                            <div
                                                class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                                <h5 class="m-0">Action Oriented</h5>
                                                <div class="cyan"><span
                                                        style="
                                                            letter-spacing: normal;
                                                            text-transform: capitalize;
                                                        ">in
                                                        progress</span></div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                                    icon="fluent-mdl2:date-time-12"
                                                    style="
                                                            color: #99A1B7;
                                                        "
                                                    width="12" height="12" class="mr-1"></iconify-icon> 1-4
                                                weeks</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career"
                                                style="
                                                                    width: 100%;
                                                                ">
                                                <div class="bar"
                                                    style="width: 64%;padding: 0;margin: initial;background: #FF2E2E;">
                                                </div>
                                            </div>
                                            <span>64%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="s-more-info-btn">
                                    Continue Your Progress <iconify-icon icon="iconamoon:arrow-right-2"
                                        class="s-info-btn"></iconify-icon>
                                </div>
                            </div>

                            <div class="col p-0">
                            </div>

                            <div class="col p-0">
                            </div>
                        </div>
                    </div>



                    {{-- --------------------------------------------------------- tab two section --------------------------------------------------------- --}}



                    <div id="tab-section-two" class="tab-content" style="display: none;">
                        {{-- <div class="row-div" style="justify-content: start;">
                            <div class="row-div" style="gap: 10px;">
                                <div class="gap-analysis-code">Gap Analysis: </div>
                                <img style="width: 100%" src="{{ asset('images/development-plan/icons/analytics_icon.png') }}"
                                    alt="Flowers in Chania" />
                                <div
                                    style="color: #757575; font-size: 16px; font-family: Roboto; font-weight: 500; line-height: 24px; letter-spacing: 0.15px; word-wrap: break-word">
                                    1</div>
                                <div class="turnaround-text">Rostering Planner</div>
                                <div class="chip-yellow"> Current</div>
                            </div>
                            <div style="margin-left: auto;" class="tab-job-position-wrapper row-div tabs-container">
                                <div class="tabs-job-position-one tab selected" onclick="selectTab(this,'tab-section-one')">
                                    Current Job Position
                                </div>
                                <div class="tabs-job-position-two tab " onclick="selectTab(this,'tab-section-two')">
                                    Next Job Position
                                </div>
                            </div>
                            <script>
                                // JavaScript function for toggling the active tab
                                function selectTab(clickedTab,sectionToShow) {
                                    // Get all tabs
                                    const tabs = document.querySelectorAll('.tabs-container .tab');
    
                                    // Remove the 'selected' class from all tabs
                                    tabs.forEach(tab => tab.classList.remove('selected'));
    
                                    // Add the 'selected' class to the clicked tab
                                    clickedTab.classList.add('selected');
                                    const tabContents = document.querySelectorAll('.tab-content');
                                    tabContents.forEach(content => content.style.display = 'none');

                                    // Show the relevant content section based on the selected tab
                                    document.getElementById(sectionToShow).style.display = 'block';
                                }
                            </script>
                        </div> --}}
                        <div class="row-div" style="justify-content: start;">
                            <div class="total-hours-text">
                                Total Hours Required to Complete: 60 Hours
                            </div>
                        </div>
                        <div class="idp-table mt-8">
                            <div class="table-row header">
                                <div>SS/TS Needs to Improve<iconify-icon icon="iconamoon:arrow-down-2-duotone"
                                        width="20" height="20"></div>
                                <div>Type<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                                <div>Current Level<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                                <div>Skill Ascension<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                                <div>Status<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                                <div>Progress<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                                <div>Skill Endorsement<iconify-icon icon="iconamoon:arrow-down-2-duotone" width="20"
                                        height="20">
                                </div>
                            </div>
                            <div class="table-row">
                                <div
                                    style="
                                                    color: #4B5675;
                                                    font-size: 14px;
                                                    font-weight: 500;
                                                ">
                                    Communication</div>
                                <div
                                    style="
                                                    color: #4B5675;
                                                    font-size: 14px;
                                                    font-weight: 500;
                                                ">
                                    Soft Skill</div>
                                <div class="green"><span
                                        style="
                                                        left: 0;
                                                    ">INTERMEDIATE</span>
                                </div>
                                <div class="purple"><span
                                        style="
                                                        left: 0;
                                                    ">ADVANCED</span>
                                </div>
                                <div class="cyan"><span
                                        style="
                                                        left: 0;
                                                        background: #DDF5E2;
                                                        padding: 4px 12px;
                                                        font-size: 10px;
                                                        font-weight: 600;
                                                        width: 100px;
                                                        text-align: center;
                                                        color: #196329;
                                                        text-transform: capitalize;
                                                        left: 0;
                                                        display: block;
                                                    ">Completed</span>
                                </div>
                                <div
                                    style="
                                                    padding: 0;
                                                ">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bar-career"
                                            style="
                                                padding: 0;
                                            ">
                                            <div class="bar" style="width: 100%;padding: 0;margin: initial;"></div>
                                        </div>
                                        <span>100%</span>
                                    </div>
                                </div>
                                <div>Approved</div>
                            </div>
                            <div class="table-row">
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Operational Excellence</div>
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Technical Skill</div>
                                <div class="badge level-2">Level 2 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div class="badge level-3">Level 5 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div class="cyan"><span
                                        style="
                                                            left: 0;
                                                            background: #DDF5E2;
                                                        padding: 4px 12px;
                                                        font-size: 10px;
                                                        font-weight: 600;
                                                        width: 100px;
                                                        text-align: center;
                                                        color: #196329;
                                                        text-transform: capitalize;
                                                left: 0;
                                                display: block;
                                                        ">Completed</span>
                                </div>
                                <div
                                    style="
                                            padding: 0;
                                        ">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bar-career"
                                            style="
                                        padding: 0;
                                    ">
                                            <div class="bar" style="width: 100%;padding: 0;margin: initial;"></div>
                                        </div>
                                        <span>100%</span>
                                    </div>
                                </div>
                                <div>Pending</div>
                            </div>
                            <div class="table-row">
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Operations Management</div>
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Technical Skill</div>
                                <div class="badge level-2">Level 1 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div class="badge level-3">Level 4 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div>
                                    <p class="m-0 s-top-right"><span class="s-yellow-right"
                                            style="
                                                    background: #FFF3E0;
                                                    padding: 4px 12px;
                                                    font-size: 10px;
                                                    font-weight: 600;
                                                    width: 100px;
                                                left: 0;
                                                    text-align: center;
                                                    letter-spacing: normal;
                                                    text-transform: capitalize;
                                                    left: 0;
                                                    display: block;
                                                                ">In
                                            Progress</span></p>
                                </div>
                                <div
                                    style="
                                                            padding: 0;
                                                        ">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bar-career"
                                            style="
                                                        padding: 0;
                                                    ">
                                            <div class="bar" style="width: 64%;padding: 0;margin: initial;"></div>
                                        </div>
                                        <span>64%</span>
                                    </div>
                                </div>
                                <div>Incomplete Requirement</div>
                            </div>
                            <div class="table-row">
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Risk Management</div>
                                <div
                                    style="
                                            color: #4B5675;
                                            font-size: 14px;
                                            font-weight: 500;">
                                    Technical Skill</div>
                                <div class="badge level-2">Level 0 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div class="badge level-3">Level 4 <iconify-icon icon="material-symbols:star"
                                        class="star"></iconify-icon></div>
                                <div>
                                    <p class="m-0 s-head-span"><span class="s-career-goal"
                                            style="
                                                            left: 0;
                                                            background: #E2F6F6;
                                                        padding: 4px 12px;
                                                        font-size: 10px;
                                                        font-weight: 600;
                                                        width: 100px;
                                                        text-align: center;
                                                        color: #0C6464;
                                                        text-transform: capitalize;
                                                left: 0;
                                                display: block;
                                        ">Enrolled</span>
                                    </p>
                                </div>
                                <div
                                    style="
                                            padding: 0;
                                        ">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bar-career"
                                            style="
                                        padding: 0;
                                    ">
                                            <div class="bar" style="width: 0%;padding: 0;margin: initial;"></div>
                                        </div>
                                        <span>0%</span>
                                    </div>
                                </div>
                                <div>Incomplete Requirement</div>
                            </div>
                        </div>
                        <div class="section-wrapper">
                            <div class="row-div" style="justify-content: start; gap: 10px; margin-bottom: 20px;">
                                <img height="30px" src="{{ asset('images/development-plan/suggestion_image.png') }}"
                                    alt="Flowers in Chania" />
                                <div>
                                    <div class="suggestion-head-text">Required Training For Your Role</div>
                                    <div class="suggestion-sub-text">Complete these
                                        required
                                        courses to meet your current role's
                                        expectations</div>
                                </div>
                            </div>


                            <div class="d-flex mb-4 gap-4">
                                <div class="card col p-0  d-flex justify-content-between">
                                <div>
                                        <img style="width: 100%"
                                            src="{{ asset('images/development-plan/splash_img.png') }}" alt="splash">
                                        <div class="success-inner d-grid">
                                            <div class="s-head-content">
                                                <div class="d-flex gap-2 align-items-center s-head-span">
                                                    <h5 class="m-0"
                                                        style="
                                            width: 200px;
                                            min-height: 40px;
                                        ">
                                                        Advanced Communication Skills</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="fluent-mdl2:date-time-12"
                                                        style="
                                                color: #99A1B7;
                                                "
                                                        width="12" height="12" class="mr-1"></iconify-icon> 1-4
                                                    weeks</p>
                                                <p class="m-0 d-flex align-items-center"> <iconify-icon
                                                        icon="ri:bar-chart-fill"
                                                        style="
                                                color: #99A1B7;
                                            "
                                                        width="12" height="12" class="mr-1"></iconify-icon>
                                                    Beginner
                                                </p>
                                            </div>
                                            <div class="s-green-text d-flex align-items-center" style="margin-top: 12px;">
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                            gap: 4px;
                                            padding: 4px 12px;
                                            font-size: 10px;
                                            line-height: 14px;
                                        ">
                                                    <p class="m-0">Organizational Communication Skills</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Leadership & Team Communication</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Problem Solving</p>
                                                </div>
                                                <span class="hidden-skills" style="display: none;">
                                                    <span class="suggestion-card-chips">Critical Thinking</span>
                                                    <span class="suggestion-card-chips">Time Management</span>
                                                    <span class="suggestion-card-chips">Conflict Resolution</span>

                                                    <!-- Add as many hidden skills as needed -->
                                                </span>
                                                <span onclick="toggleSkills(this)" class="add-skill-chip">
                                                    + 10 more skills
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="s-more-info-btn">
                                            View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                                class="s-info-btn"></iconify-icon>
                                        </div>
                                </div>
                                <div class="card col p-0  d-flex justify-content-between">
                                <div>
                                        <img style="width: 100%" src="{{ asset('images/development-plan/hand.png') }}"
                                            alt="splash">
                                        <div class="success-inner p-4 d-grid">
                                            <div class="s-head-content">
                                                <div class="d-flex gap-2 align-items-center s-head-span">
                                                    <h5 class="m-0"
                                                        style="
                                            width: 200px;
                                            min-height: 40px;
                                        ">
                                                        Organizational Performance Management</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="fluent-mdl2:date-time-12"
                                                        style="
                                                color: #99A1B7;
                                                "
                                                        width="12" height="12" class="mr-1"></iconify-icon> 1-4
                                                    weeks</p>
                                                <p class="m-0 d-flex align-items-center"> <iconify-icon
                                                        icon="ri:bar-chart-fill"
                                                        style="
                                                color: #99A1B7;
                                            "
                                                        width="12" height="12" class="mr-1"></iconify-icon>
                                                    Beginner
                                                </p>
                                            </div>
                                            <div class="s-green-text d-flex align-items-center" style="margin-top: 12px;">
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Performance Management</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Operations Management</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Strategic Human Resource Management</p>
                                                </div>
                                                <span class="hidden-skills" style="display: none;">
                                                    <span class="suggestion-card-chips">Critical Thinking</span>
                                                    <span class="suggestion-card-chips">Time Management</span>
                                                    <span class="suggestion-card-chips">Conflict Resolution</span>

                                                    <!-- Add as many hidden skills as needed -->
                                                </span>
                                                <span onclick="toggleSkills(this)" class="add-skill-chip">
                                                    + 10 more skills
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                    <div class="s-more-info-btn">
                                        View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                            class="s-info-btn"></iconify-icon>
                                    </div>
                                </div>

                                <div class="card col p-0  d-flex justify-content-between">
                                <div>
                                        <img style="width: 100%"
                                            src="{{ asset('images/development-plan/splash_img.png') }}" alt="splash">
                                        <div class="success-inner p-4 d-grid">
                                            <div class="s-head-content">
                                                <div class="d-flex gap-2 align-items-center s-head-span">
                                                    <h5 class="m-0"
                                                        style="
                                            width: 200px;
                                            min-height: 40px;
                                        ">
                                                        Handling Accident and Incident in Organization</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="fluent-mdl2:date-time-12"
                                                        style="
                                                color: #99A1B7;
                                                "
                                                        width="12" height="12" class="mr-1"></iconify-icon> 1-4
                                                    weeks</p>
                                                <p class="m-0 d-flex align-items-center"> <iconify-icon
                                                        icon="ri:bar-chart-fill"
                                                        style="
                                                color: #99A1B7;
                                            "
                                                        width="12" height="12" class="mr-1"></iconify-icon>
                                                    Beginner
                                                </p>
                                            </div>
                                            <div class="s-green-text d-flex align-items-center" style="margin-top: 12px;">
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Communication</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Accident and Incident Response Management</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Problem Solving</p>
                                                </div>
                                                <span class="hidden-skills" style="display: none;">
                                                    <span class="suggestion-card-chips">Critical Thinking</span>
                                                    <span class="suggestion-card-chips">Time Management</span>
                                                    <span class="suggestion-card-chips">Conflict Resolution</span>

                                                    <!-- Add as many hidden skills as needed -->
                                                </span>
                                                <span onclick="toggleSkills(this)" class="add-skill-chip">
                                                    + 10 more skills
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                    <div class="s-more-info-btn">
                                        View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                            class="s-info-btn"></iconify-icon>
                                    </div>
                                </div>

                                <div class="card col p-0  d-flex justify-content-between">
                                <div>
                                        <img style="width: 100%" src="{{ asset('images/development-plan/hand.png') }}"
                                            alt="splash">
                                        <div class="success-inner p-4 d-grid">
                                            <div class="s-head-content">
                                                <div class="d-flex gap-2 align-items-center s-head-span">
                                                    <h5 class="m-0"
                                                        style="
                                            width: 200px;
                                            min-height: 40px;
                                        ">
                                                        Problem-Solving and Decision-Making</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                                <p class="m-0 d-flex align-items-center"><iconify-icon
                                                        icon="fluent-mdl2:date-time-12"
                                                        style="
                                                color: #99A1B7;
                                                "
                                                        width="12" height="12" class="mr-1"></iconify-icon> 1-4
                                                    weeks</p>
                                                <p class="m-0 d-flex align-items-center"> <iconify-icon
                                                        icon="ri:bar-chart-fill"
                                                        style="
                                                color: #99A1B7;
                                            "
                                                        width="12" height="12" class="mr-1"></iconify-icon>
                                                    Beginner
                                                </p>
                                            </div>
                                            <div class="s-green-text d-flex align-items-center" style="margin-top: 12px;">
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Problem Solving</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Leadership & Team Management</p>
                                                </div>
                                                <div class="s-yellow-btn d-flex align-items-center"
                                                    style="
                                                            gap: 4px;
                                                            padding: 4px 12px;
                                                            font-size: 10px;
                                                            line-height: 14px;
                                                            ">
                                                    <p class="m-0">Decision Making</p>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                    <div class="s-more-info-btn">
                                        View Program <iconify-icon icon="iconamoon:arrow-right-2"
                                            class="s-info-btn"></iconify-icon>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="section-wrapper">
                            <div class="row-div" style="justify-content: start; gap: 10px; margin-bottom: 20px;">
                                <img height="20px" src="{{ asset('images/development-plan/icons/book_icon.png') }}"
                                    alt="Flowers in Chania" />
                                <div class="suggestion-head-text">Learning and Development Plan</div>

                            </div>
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Program</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>
                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Skill Program</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>

                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Estimated Time Completed</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>

                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Status</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>

                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Progress</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>

                                            </th>

                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="m-0">Test result</p>
                                                    <img style="color: #99A1B7;" class="icon_wrapper"
                                                        src="{{ asset('images/development-plan/icons/grey_array_down.png') }}"
                                                        alt="Flowers in Chania" />
                                                </div>

                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="body-text">Improving Communication Skills</td>
                                            <td>
                                                <div class="col-div" style="align-items: start; gap: 5px;">
                                                    <span class="status in-progress">Communication
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        2 >>
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        3
                                                    </span>
                                                    <span class="status in-progress">Customer Orientation
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        2 >>
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        3
                                                    </span>

                                                    <span class="hidden-skills" style="display: none;">
                                                        <span class="suggestion-card-chips">Critical Thinking</span>
                                                        <span class="suggestion-card-chips">Time Management</span>
                                                        <span class="suggestion-card-chips">Conflict Resolution</span>

                                                        <!-- Add as many hidden skills as needed -->
                                                    </span>
                                                    <span onclick="toggleSkills(this)" class="add-skill-chip">
                                                        + 10 more skills
                                                    </span>
                                                </div>

                                            </td>
                                            <td class="body-text">10 Hours</td>
                                            <td><span class="status completed">Completed</span></td>
                                            <td class="d-flex align-items-center gap-2">
                                                <div class="progress-bar" style="width: 100px">
                                                    <div class="progress" style="width: 100%;"></div>
                                                </div>
                                                <span class="progress-text">100%</span>
                                            </td>
                                            <td class="body-text">74%</td>

                                        </tr>

                                        <tr>
                                            <td class="body-text">Talent Performance Management
                                            </td>
                                            <td>
                                                <div class="col-div" style="align-items: start; gap: 5px;">
                                                    <span class="status in-progress">Organizational Performance Management
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        2 >>
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        3
                                                    </span>
                                                    <span class="status in-progress">Organizational Operations Management

                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        2 >>
                                                        <img style="color: #99A1B7;" class="icon_wrapper"
                                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                                            alt="Flowers in Chania" />
                                                        3
                                                    </span>
                                                    <span class="hidden-skills" style="display: none;">
                                                        <span class="suggestion-card-chips">Critical Thinking</span>
                                                        <span class="suggestion-card-chips">Time Management</span>
                                                        <span class="suggestion-card-chips">Conflict Resolution</span>

                                                        <!-- Add as many hidden skills as needed -->
                                                    </span>
                                                    <span onclick="toggleSkills(this)" class="add-skill-chip">
                                                        + 10 more skills
                                                    </span>
                                                </div>

                                            </td>
                                            <td class="body-text">48 Hours</td>
                                            <td><span class="status in-progress">In Progress</span></td>
                                            <td class="d-flex align-items-center gap-2">
                                                <div class="progress-bar" style="width: 100px">
                                                    <div class="progress" style="width: 64%;"></div>
                                                </div>
                                                <span class="progress-text">64%</span>
                                            </td>
                                            <td class="body-text">Requirement Unmet</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="path-top-text d-flex mt-8">
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="tdesign:dart-board" width="24" height="24"></iconify-icon>
                                <div>
                                    <p class="m-0">EEI Core Value Training</p>
                                </div>
                                <div class="red-top"><span>4 / 6 courses enrolled <iconify-icon
                                            icon="material-symbols:info" width="12"
                                            height="12"></iconify-icon></span></div>
                            </div>
                        </div>
                        <div class="d-flex mb-4 gap-4">
                            <div class="card col p-0">
                                    <img class="icon_wrapper" src="{{ asset('admin/media/udenna/unity.jpg') }}" alt="splash">
                                    <div class="success-inner d-grid gap-2">
                                        <div class="s-head-content">
                                            <div class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                                <h5 class="m-0">Teamwork</h5>
                                                <div class="cyan"><span
                                                        style="
                                                letter-spacing: normal;
                                                text-transform: capitalize;
                                            ">in
                                                        progress</span></div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                            <p class="m-0 d-flex align-items-center"><iconify-icon icon="fluent-mdl2:date-time-12"
                                                    style="
                    color: #99A1B7;
                    " width="12" height="12"
                                                    class="mr-1"></iconify-icon> 1-4 weeks</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career" style="
                                    width: 100%;
                                ">
                                                <div class="bar" style="width: 64%;padding: 0;margin: initial;background: #FF2E2E;">
                                                </div>
                                            </div>
                                            <span>64%</span>
                                        </div>
                                </div>
                                <div class="s-more-info-btn">
                                    Continue Your Progress <iconify-icon icon="iconamoon:arrow-right-2"
                                        class="s-info-btn"></iconify-icon>
                                </div>
                            </div>
                            <div class="card col p-0">
                                    <img class="icon_wrapper" src="{{ asset('admin/media/udenna/drive.jpg') }}" alt="splash">
                                    <div class="success-inner d-grid gap-2">
                                        <div class="s-head-content">
                                            <div class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                                <h5 class="m-0">Action Oriented</h5>
                                                <div class="cyan"><span
                                                        style="
                                                letter-spacing: normal;
                                                text-transform: capitalize;
                                            ">in
                                                        progress</span></div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                            <p class="m-0 d-flex align-items-center"><iconify-icon icon="fluent-mdl2:date-time-12"
                                                    style="
                    color: #99A1B7;
                    " width="12" height="12"
                                                    class="mr-1"></iconify-icon> 1-4 weeks</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career" style="
                                    width: 100%;
                                ">
                                                <div class="bar" style="width: 64%;padding: 0;margin: initial;background: #FF2E2E;">
                                                </div>
                                            </div>
                                            <span>64%</span>
                                        </div>
                                </div>
                                <div class="s-more-info-btn">
                                    Continue Your Progress <iconify-icon icon="iconamoon:arrow-right-2"
                                        class="s-info-btn"></iconify-icon>
                                </div>
                            </div>
                
                            <div class="card col p-0">
                                    <img class="icon_wrapper" src="{{ asset('admin/media/udenna/excellent.jpg') }}"
                                        alt="splash">
                                    <div class="success-inner d-grid gap-2">
                                        <div class="s-head-content">
                                            <div class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                                <h5 class="m-0">Respect </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                            <p class="m-0 d-flex align-items-center"><iconify-icon icon="fluent-mdl2:date-time-12"
                                                    style="
                    color: #99A1B7;
                    " width="12" height="12"
                                                    class="mr-1"></iconify-icon> 1-4 weeks</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career" style="
                                    width: 100%;
                                ">
                                                <div class="bar" style="width: 0%;padding: 0;margin: initial;background: #FF2E2E;">
                                                </div>
                                            </div>
                                            <span>0%</span>
                                        </div>
                                </div>
                            </div>
                
                            <div class="card col p-0">
                                    <img class="icon_wrapper" src="{{ asset('admin/media/udenna/nurturing.jpeg') }}"
                                        alt="splash">
                                    <div class="success-inner d-grid gap-2">
                                        <div class="s-head-content">
                                            <div class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                                <h5 class="m-0">Innovation</h5>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                            <p class="m-0 d-flex align-items-center"><iconify-icon icon="fluent-mdl2:date-time-12"
                                                    style="
                    color: #99A1B7;
                    " width="12" height="12"
                                                    class="mr-1"></iconify-icon> 1-4 weeks</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career" style="
                                    width: 100%;
                                ">
                                                <div class="bar" style="width: 0%;padding: 0;margin: initial;background: #FF2E2E;">
                                                </div>
                                            </div>
                                            <span>0%</span>
                                        </div>
                                </div>
                            </div>
                
                
                        </div>

                        <div class="d-flex mb-4 gap-4">
                            <div class="card col p-0">
                                    <img class="icon_wrapper" style="padding: 3%"   src="{{ asset('admin/media/udenna/need.jpeg') }}"
                                        alt="splash">
                                    <div class="success-inner d-grid gap-2">
                                        <div class="s-head-content">
                                            <div class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                                <h5 class="m-0">Transparency</h5>
                                                <div class="cyan"><span
                                                        style="
                                            letter-spacing: normal;
                                            text-transform: capitalize;
                                        ">in
                                                        progress</span></div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                            <p class="m-0 d-flex align-items-center"><iconify-icon icon="fluent-mdl2:date-time-12"
                                                    style="
                                                        color: #99A1B7;
                                                    " width="12" height="12"
                                                    class="mr-1"></iconify-icon> 1-4 weeks</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career" style="
                                                            width: 100%;
                                                        ">
                                                <div class="bar"
                                                    style="width: 24%;padding: 0;margin: initial;background: #FF2E2E;">
                                                </div>
                                            </div>
                                            <span>64%</span>
                                        </div>
                                </div>
                                <div class="s-more-info-btn">
                                    Continue Your Progress <iconify-icon icon="iconamoon:arrow-right-2"
                                        class="s-info-btn"></iconify-icon>
                                </div>
                            </div>
                            <div class="card col p-0">
                                    <img class="icon_wrapper" style="padding: 3%"   src="{{ asset('admin/media/udenna/accountable.jpeg') }}"
                                        alt="splash">
                                    <div class="success-inner d-grid gap-2">
                                        <div class="s-head-content">
                                            <div class="d-flex gap-2 align-items-center s-head-span justify-content-between">
                                                <h5 class="m-0">Integrity</h5>
                                                <div class="cyan"><span
                                                        style="
                                                            letter-spacing: normal;
                                                            text-transform: capitalize;
                                                        ">in
                                                        progress</span></div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-4 fs-7" style="color:#4B5675">
                                            <p class="m-0 d-flex align-items-center"><iconify-icon icon="fluent-mdl2:date-time-12"
                                                    style="
                                                            color: #99A1B7;
                                                        " width="12" height="12"
                                                    class="mr-1"></iconify-icon> 1-4 weeks</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bar-career" style="
                                                                    width: 100%;
                                                                ">
                                                <div class="bar"
                                                    style="width: 64%;padding: 0;margin: initial;background: #FF2E2E;">
                                                </div>
                                            </div>
                                            <span>64%</span>
                                        </div>
                                </div>
                                <div class="s-more-info-btn">
                                    Continue Your Progress <iconify-icon icon="iconamoon:arrow-right-2"
                                        class="s-info-btn"></iconify-icon>
                                </div>
                            </div>
        
                            <div class="col p-0">
                            </div>
        
                            <div class="col p-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        function toggleSkills(button) {
            // Find the closest hidden-skills container relative to the clicked button
            const hiddenSkills = button.previousElementSibling;
            console.log("hidden", hiddenSkills) // Get hidden-skills container
            hiddenSkills.classList.toggle('show'); // Toggle the 'show' class

            // Update button text dynamically
            button.innerText = hiddenSkills.classList.contains('show') ? "- Show fewer skills" : "+ 10 more skills";
        }
    </script>
@endsection
