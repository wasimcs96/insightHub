@extends('employee.layout.app')

@section('title', 'Dashboard')

@section('styles')
    {{-- <link rel="stylesheet" type="text/css" href="{{ url('/css/carrer-pathing-styles.css') }}" /> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <style>
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

        .display-none-cl {
            display: none;
        }

        .upper-wrapper {
            margin: 1rem 0rem;
            padding: 0px;
        }

        .section-wrapper {
            margin: 20px 0px;
        }

        .card-wrapper {
            padding: 30px;
            gap: 10px;
            background: #FFFFFF;
            box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
            border-radius: 8px;

        }

        .question-text {
            /* .Input Label / Small */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            margin: 1.5rem 0px;
            font-size: 18px;
            line-height: 22px;
            /* identical to box height */
            text-transform: capitalize;


            color: #5B5B5B;
        }

        .career-button {
            padding: 14px 20px;
            background: #F7941C;
            border-radius: 4px;
            border: none;
            /* Label/Large/Semi Bold */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 20px;
            /* identical to box height, or 143% */

            color: #FFFFFF;


            /* Inside auto layout */


        }

        .answer-text {
            /* .Input Field */
            margin: 10px 0px;
            box-sizing: border-box;
            width: 40%;
            min-width: 250px;
            /* Auto layout */
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 10.368px 13.824px;
            border: 1.152px solid #A0A0A0;
            border-radius: 4.608px;


        }

        .tabs-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            border-bottom: 1px solid #e6e6e6;
            /* Light border for the container */
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            gap: 24px;
            /* Spacing between tabs */
            /* padding-bottom: 10px; */
        }

        /* Default tab style */
        .tab {
            text-decoration: none;
            cursor: pointer;
            padding-bottom: 4px;
            transition: color 0.3s ease;
            border-bottom: 2px solid transparent;
            height: 35px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 14.95px;
            line-height: 18px;
            color: #C4CADA;
        }

        .short-term-head {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 19px;
            line-height: 26px;
            /* or 137% */

            color: #1E1E1E;
        }

        .tab-active {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 14.95px;
            line-height: 18px;
            /* identical to box height, or 120% */

            color: #000000;
            border-bottom: 3px solid #F7941C;


        }

        /* Hover effect for better UX */
        .tab:hover {
            color: #000000;
        }


        /* .tab.active {
                                        color: #000000;
                                        font-weight: bold;
                                        position: relative;
                                      }
                                       */




        .dropdown {
            position: relative;
            display: inline-block;
            font-family: Arial, sans-serif;

        }

        .dropdown::after {
            display: none;
        }

        .selected-option {
            border-color: #F7941C;
            border-width: 2px;
        }

        /* Button styling */
        .dropdown-toggle {
            width: 400px;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            cursor: pointer;
            font-size: 16px;
            color: #000;
            text-align: left;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .dropdown-toggle:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }


        .dropdown-menu a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: background-color 0.2s ease-in-out;
        }

        .dropdown-menu a:hover {
            background-color: #f5f5f5;
        }

        /* Show dropdown on toggle */
        .dropdown.active .dropdown-menu {
            display: block;
        }

        .career-aspiration-text {
            /* Career Aspiration Goals */



            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 19.5px;
            line-height: 27px;
            /* identical to box height, or 138% */

            color: #1E1E1E;



        }


        .edit-text {

            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 15px;
            /* identical to box height, or 125% */
            text-align: center;

            /* Orange */
            color: #F7941C;
        }

        .card-wrapper {
            /* Frame 36367 */
            margin: 10px 0px;
            padding: 30px;
            background: #FFFFFF;
            /* Drop Shadow (XS) */
            box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
            border-radius: 8px;
        }

        .card-wrapper-two {
            padding: 20px;
            background: #FFFFFF;
            border: 2px solid #F7941C;
            /* Drop Shadow/200 */
            box-shadow: 0px 1px 4px rgba(12, 12, 13, 0.1), 0px 1px 4px rgba(12, 12, 13, 0.05);
            border-radius: 4px;

        }

        .unselect-card {
            border: 2px solid #B7B7B7;
        }

        .card-wrapper-blue-two {
            padding: 20px;
            background: #FFFFFF;
            border: 2px solid #1AC2C2;
            /* Drop Shadow/200 */
            box-shadow: 0px 1px 4px rgba(12, 12, 13, 0.1), 0px 1px 4px rgba(12, 12, 13, 0.05);
            border-radius: 4px;

        }

        .carrer-card-head {
            /* Turnaround Coordinator */
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            /* identical to box height, or 150% */
            letter-spacing: 0.15px;

            color: #1E1E1E;
        }

        .career-card-sub {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 16px;
            /* or 133% */
            letter-spacing: 0.4px;

            color: #757575;


            /* Inside auto layout */
            flex: none;
            order: 1;
            align-self: stretch;
            flex-grow: 0;

        }

        .skill-requirement-text {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */
            letter-spacing: 0.5px;

            color: #4B5675;


        }

        .small-grey-text {
            /* M3/title/medium */
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            /* identical to box height, or 150% */
            letter-spacing: 0.15px;

            color: #757575;

        }

        .card-head-wrapper {

            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 22px;
            /* identical to box height */
            text-transform: capitalize;

            /* Dark Grey */
            color: #5B5B5B;
        }

        .view-more-job-button {
            /* CCS-Expansion button */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 8px 15px;


            /* Shade/White */
            background: #FFFFFF;
            /* Primary/Orange 60 */
            border: 1px solid #F7941C;
            border-radius: 4.4px;

            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 14.3px;
            line-height: 17px;
            text-align: center;

            /* Primary/Orange 60 */
            color: #F7941C;
        }

        .roaster-planner-text {

            /* Heading/H2/Bold */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-size: 19.5px;
            line-height: 23px;
            /* identical to box height, or 120% */

            color: #1E1E1E;
        }

        .card-sub-wrapper {
            /* .Input Placeholder / Small / On */
            margin-top: 10px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 16.128px;
            line-height: 20px;
            /* identical to box height */
            text-transform: capitalize;

            /* Dark Grey */
            color: #5B5B5B;

        }

        .skill-chips {
            /* Skill Label New */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 6px 14px;
            gap: 8px;


            /* Success/Green 10 */
            background: #DDF5E2;
            border-radius: 80px;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */
            letter-spacing: 0.5px;

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
            padding: 6px 14px;

            /* Label */
            /* M3/label/small */
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 11px;
            line-height: 16px;
            /* identical to box height, or 145% */
            letter-spacing: 0.5px;

            /* Primary/Orange 70 */
            color: #99A1B7;


        }

        .skill-yellow-chips {
            /* Skill Label New */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 6px 14px;
            gap: 8px;



            /* Success/Green 10 */
            background: #FFF3E0;
            border-radius: 80px;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */
            letter-spacing: 0.5px;

            /* Success/Green 80 */
            color: #975102;


        }

        .current-chip {
            /* Label */
            /* M3/label/small */
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 11px;
            line-height: 16px;
            /* identical to box height, or 145% */
            letter-spacing: 0.5px;

            /* Primary/Orange 70 */
            color: #CE7B17;
            /* Frame 32 */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 12px;
            gap: 10px;

            background: #FEF2E2;
            border-radius: 50px;

        }

        .job-position-container {
            display: grid;
            grid-template-columns: 33% 33% 33%;
            gap: 6px;
            padding: 0px;
            /* Spacing between chips */
            padding: 8px;
            width: 100%;
            /* Adjust based on your container */
            box-sizing: border-box;
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
            font-family: 'Roboto';
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

        .chip-brown {
            /* Frame 32 */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 12px;

            background: #FFEBB4;
            border-radius: 50px;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 11px;
            line-height: 16px;
            /* identical to box height, or 145% */
            letter-spacing: 0.5px;

            color: #806210;

        }

        .high-match-chip {
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: end;
            padding: 3.2px 9.6px;
            background: #BBECC5;
            border-radius: 40px;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 8.8px;
            line-height: 13px;
            /* identical to box height, or 145% */
            letter-spacing: 0.4px;

            color: #196329;
        }

        .meduim-match-chip {
            /* Frame 32 */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: center;
            padding: 3.2px 9.6px;
            gap: 8px;


            background: #FFEBB4;
            border-radius: 40px;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 8.8px;
            line-height: 13px;
            /* identical to box height, or 145% */
            letter-spacing: 0.4px;

            color: #806210;


        }

        .low-match-chip {
            /* Frame 32 */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: center;
            padding: 3.2px 9.6px;
            gap: 8px;



            background: #FFE0DD;
            border-radius: 40px;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 8.8px;
            line-height: 13px;
            /* identical to box height, or 145% */
            letter-spacing: 0.4px;

            /* Error/Red 60 */
            color: #F24130;



        }

        .enter-program-text {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */
            letter-spacing: 0.4px;

            color: #757575;


        }

        .card-wrapper-three {
            /* Frame 36367 */

            /* Auto layout */
            /* display: flex;
                                    flex-direction: row;
                                    justify-content: center;
                                    align-items: flex-start; */
            padding: 30px;
            background: #FFFFFF;
            /* Drop Shadow (XS) */
            box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
            border-radius: 8px;

        }

        .card-wrapper-three-head {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 17.55px;
            line-height: 21px;
            /* or 120% */

            color: #071437;
        }

        .card-wrapper-three-head-2 {
            margin-top: 20px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 21px;

            color: #071437;
        }

        .card-wrapper-three-sub {
            margin-top: 10px;
            /* Long Paragraph/Medium */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 22px;
            /* or 157% */

            color: #4B5675;

        }

        .card-sub-text-1 {

            /* Label/Large/Medium */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 20px;
            /* or 143% */
            display: flex;
            align-items: center;

            color: #4B5675;

        }

        .small-chip {
            /* Frame 329 */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 3px 7px;

            /* Success/Green 20 */
            background: #BBECC5;
            border-radius: 10px;
            /* BASIC */


            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            text-transform: uppercase;

            /* Success/Green 80 */
            color: #218336;

        }

        .yellow-small-text {

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 14.4px;
            line-height: 19px;
            /* identical to box height, or 133% */
            letter-spacing: 0.6px;

            color: #975102;

        }

        .progress-container {
            width: 120px;
            /* Adjust as needed */
            height: 15px;
            background-color: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            display: inline-block;
            vertical-align: middle;
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
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 11px;
            line-height: 16px;
            /* identical to box height, or 145% */
            letter-spacing: 0.5px;

            /* Primary/Orange 70 */
            color: #975102;

        }

        .completed-chip {
            /* Label */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 12px;

            /* Success/Green 10 */
            background: #DDF5E2;
            border-radius: 80px;
            /* Label */
            /* Label/Small/Semi Bold */
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 14px;
            /* identical to box height, or 140% */
            text-align: center;

            /* Success/Green 90 */
            color: #196329;
        }

        .enrolled-card-chip {
            /* Label */

            /* Auto layout */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 12px;

            background: #E2F6F6;
            border-radius: 80px;
            /* Label */

            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 14px;
            /* identical to box height, or 140% */
            text-align: center;

            /* Teal/Teal 90 */
            color: #0C6464;


        }

        .roaster-planner-text .card-progress-chip {

            font-family: 'Inter';
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

        .progress-bar {
            height: 100%;
            background-color: #e6853c !important;
            /* Match the color */
            border-radius: 10px 0 0 10px;
            /* Rounded corners */
        }

        .progress-text {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            /* identical to box height, or 133% */

            color: #4B5675;
        }

        .dropdown-toggle::after {
            content: none;
        }

        @media (max-width: 576px) {
            body {
                width: 100vh;
            }


        }

        .star-gold,
        .timeline-gold {
            color: #f7941c !important;
        }

        .s-career-goal {
            background: #E2F6F6;
            color: #108585;
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: center;
            padding: 3.2px 9.6px;
            gap: 8px;

            border-radius: 40px;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 8.8px;
            line-height: 13px;
            letter-spacing: 0.4px;

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

        .card {
            border-radius: 4px;
            justify-content: space-between;
        }

        /* Modal container */


        .bg-career-map-modal {
            background-color: #F5F5F5;
            padding: 0px;
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

        .text-active-primary.active {
            color: #f7941d !important;
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
                    <div id="tab-screen-comp" class="card-wrapper">
                        <div class="tabs-container">
                            <div class="tab tab-active" onclick="selectNavTab(this,'short-term')">Short Term Goal</div>
                            <div class="tab" onclick="selectNavTab(this,'long-term')">Long Term Goal</div>
                            <div class="tab" onclick="selectNavTab(this, 'future-roles')">Desired-Future Roles</div>
                            <div class="tab" onclick="selectNavTab(this, 'cross-departmental')">Cross-Departmental Roles
                            </div>

                        </div>
                        <div id="short-term" class="tab-content">
                            <div class="question-text">
                                1. What are your immediate career goals for the next 1 to 2 Years?
                            </div>
                            <div class="answer-text" id="promotion">Promotion</div>
                            <div class="answer-text " id="role_transition">Role Transition
                            </div>

                            <div id="role-transition-comp" style="display: none;">
                                <div class="question-text">
                                    2. Are there any Role Transition you’d like to take on in the near future?
                                </div>
                                <div class="row-div" style="justify-content: start">
                                    <div class="short-term-head">Suggestion Role Transition based on your Level 3 Position
                                    </div>
                                    <div class="row-div" style="gap: 5px; margin-left: 10px;">
                                        {{-- <img style="height: 15px;" class="icon_wrapper"
                                            src="{{ asset('images/development-plan/icons/analytics_icon.png') }}"
                                            alt="Flowers in Chania"> --}}
                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold" width="24"
                                            height="24"></iconify-icon>
                                        <div class="small-grey-text">3</div>
                                    </div>
                                    <div style=" margin-left: 10px;" class="roaster-planner-text">Staff II- Officer in
                                        Charge_Timekeeping_HQ</div>
                                    <a class="career-button row-div" href="#" data-bs-toggle="modal"
                                        data-bs-target="#careerMapModal" style="gap: 10px; margin-left: auto;">
                                        Career Map
                                        {{-- <img height="24px" src="{{ asset('images/development-plan/zoom_out_img.png') }}"> --}}
                                        <iconify-icon icon="gridicons:fullscreen" width="24"
                                            height="24"></iconify-icon>
                                    </a>
                                </div>
                                <div class="section-wrapper">
                                    <div class="job-position-container">
                                        <div class="card-wrapper-two card pb-0" style="width: 100%;">
                                            <div>
                                                <div class="row-div" style="justify-content: space-between;">
                                                    <div class="row-div" style="gap: 5px;">
                                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                            width="24" height="24"></iconify-icon>
                                                        <div class="small-grey-text">3</div>
                                                    </div>
                                                    <div class="meduim-match-chip">Current</div>
                                                </div>
                                                <div class="row-div"
                                                    style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                    <div class="carrer-card-head">HR Officer - People Operation and Services
                                                    </div>
                                                    {{-- <div class="current-chip">Current</div> --}}
                                                </div>
                                                <div class="career-card-sub">Primary responsible for promoting a positive
                                                    work environment and fostering strong relationships between employees
                                                    and management. Plays the key role in resolving workplace...</div>
                                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                    requirement
                                                </div>
                                                <div class="chip-container">
                                                    <div class="skill-chips">
                                                        Collaboration
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Communication
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Problem Solving
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Digital Fluency
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Human Resource Systems Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Data Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>



                                                    <div class="add-skill-chip">+ 10 more skills</div>
                                                </div>
                                            </div>


                                            <div class="row-div s-more-info-btn" style="gap: 10px;"
                                                onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                                <div class="enter-program-text"> More Info</div>
                                                <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                    height="24"></iconify-icon>

                                            </div>

                                        </div>
                                        <div class="card-wrapper-two unselect-card card pb-0" style="width: 100%;">
                                            <div>

                                                <div class="row-div" style="justify-content: space-between;">
                                                    <div class="row-div" style="gap: 5px;">
                                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                            width="24" height="24"></iconify-icon>
                                                        <div class="small-grey-text">3</div>
                                                    </div>
                                                    <div class="high-match-chip">86% Match</div>
                                                </div>
                                                <div class="row-div"
                                                    style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                    <div class="carrer-card-head">Staff II- Officer in
                                                        Charge_Timekeeping_HQ</div>
                                                </div>
                                                <div class="career-card-sub">Works under the supervision of the Senior
                                                    Manager- People Operations and Services . Supervises, direct and take
                                                    control of timekeeping activities such as enforcement of...</div>
                                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                    requirement
                                                </div>
                                                <div class="chip-container">
                                                    <div class="skill-chips">
                                                        Collaboration
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Communication
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Problem Solving
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Creative Thinking
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Human Resource System Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Data Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>


                                                    <div class="add-skill-chip">+ 10 more skills</div>
                                                </div>
                                            </div>

                                            <div class="row-div  s-more-info-btn" style="gap: 10px;"
                                                onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                                <div class="enter-program-text"> More Info</div>
                                                <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                    height="24"></iconify-icon>

                                            </div>

                                        </div>
                                    </div>

                                    {{-- <div class="row-div" style="justify-content: center; margin-top: 20px;">
                                        <div class="view-more-job-button">
                                            View More Job Positions
                                        </div>
                                    </div> --}}
                                    <div class="row-div" style="justify-content: end; margin-top: 20px;">
                                        <button class="career-button" onclick="nextTab('long-term')">Next Section: Long
                                            Term Goal</button>
                                    </div>



                                </div>

                            </div>
                            <div id="promotion-comp" style="display: none;">

                                <div class="question-text">
                                    2. Are there any Specific Role you’d like to take on in the near future?
                                </div>
                                <div class="row-div" style="justify-content: start">
                                    <div class="short-term-head">Suggestion promotion
                                        based on your Level 3 Position</div>
                                    <div class="row-div" style="gap: 5px; margin-left: 10px;">
                                        {{-- <img style="height: 15px;" class="icon_wrapper"
                                            src="{{ asset('images/development-plan/icons/analytics_icon.png') }}"
                                            alt="Flowers in Chania"> --}}
                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold" width="24"
                                            height="24"></iconify-icon>
                                        <div class="small-grey-text">7</div>
                                    </div>
                                    <div style=" margin-left: 10px;" class="roaster-planner-text">Senior Manager - People
                                        Operations and Services</div>
                                    <a class="career-button row-div" href="#" data-bs-toggle="modal"
                                        data-bs-target="#careerMapModal" style="gap: 10px; margin-left: auto;">
                                        Career Map
                                        {{-- <img height="24px" src="{{ asset('images/development-plan/zoom_out_img.png') }}"> --}}
                                        <iconify-icon icon="gridicons:fullscreen" width="24"
                                            height="24"></iconify-icon>
                                    </a>
                                </div>
                                <div class="section-wrapper">

                                    <div class="job-position-container">
                                        <div class="card-wrapper-two unselect-card card pb-0" style="width: 100%;">
                                            <div>
                                                <div class="row-div" style="justify-content: space-between;">
                                                    <div class="row-div" style="gap: 5px;">
                                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                            width="24" height="24"></iconify-icon>
                                                        <div class="small-grey-text">3</div>
                                                    </div>
                                                    <div class="meduim-match-chip">Current</div>
                                                </div>
                                                <div class="row-div"
                                                    style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                    <div class="carrer-card-head">HR Officer - People Operation and
                                                        Services</div>
                                                    {{-- <div class="current-chip">Current</div> --}}
                                                </div>
                                                <div class="career-card-sub">Primary responsible for promoting a positive
                                                    work environment and fostering strong relationships between employees
                                                    and management. Plays the key role in resolving workplace...</div>
                                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                    requirement
                                                </div>
                                                <div class="chip-container">
                                                    <div class="skill-chips">
                                                        Collaboration
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Communication
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Problem Solving
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Digital Fluency
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Human Resource Systems Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Data Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>



                                                    <div class="add-skill-chip">+ 10 more skills</div>
                                                </div>
                                            </div>

                                            <div class="row-div  s-more-info-btn" style="gap: 10px;"
                                                onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                                <div class="enter-program-text"> More Info</div>
                                                <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                    height="24"></iconify-icon>

                                            </div>

                                        </div>
                                        <div class="card-wrapper-two card pb-0" style="width: 100%;">
                                            <div>
                                                <div class="row-div" style="justify-content: space-between;">
                                                    <div class="row-div" style="gap: 5px;">
                                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                            width="24" height="24"></iconify-icon>
                                                        <div class="small-grey-text">7</div>
                                                    </div>

                                                    <div class="s-career-goal">Next Career Goal</div>
                                                </div>
                                                <div class="row-div"
                                                    style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                    <div class="carrer-card-head">Senior Manager - People Operations and
                                                        Services</div>
                                                    {{-- <div class="current-chip">Current</div> --}}
                                                </div>
                                                <div class="career-card-sub">Senior Manager – People Operations and
                                                    Services is the head of the People Operations and Services Department
                                                    and Timekeeping group of the entire domestic... </div>
                                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                    requirement
                                                </div>
                                                <div class="chip-container">
                                                    <div class="skill-chips">
                                                        Communication
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Decision Making
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>

                                                    <div class="skill-chips">
                                                        Developing People
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Problem Solving
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Workplace Optimization
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            5
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Technology Integration
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            5
                                                        </div>

                                                    </div>

                                                    <div class="add-skill-chip">+ 10 more skills</div>
                                                </div>
                                            </div>

                                            <div class="row-div  s-more-info-btn" style="gap: 10px;"
                                                onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                                <div class="enter-program-text"> More Info</div>
                                                <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                    height="24"></iconify-icon>

                                            </div>

                                        </div>
                                        {{-- <div class="card-wrapper-two unselect-card card pb-0" style="width: 100%;">
                                            <div>
                                                <div class="row-div" style="justify-content: space-between;">
                                                    <div class="row-div" style="gap: 5px;">
                                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                            width="24" height="24"></iconify-icon>
                                                        <div class="small-grey-text">3</div>
                                                    </div>
                                                    <div class="meduim-match-chip">63% Match</div>
                                                </div>
                                                <div class="row-div"
                                                    style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                    <div class="carrer-card-head">Manager Rostering & Advanced Crewing
                                                    </div>
                                                    <div class="current-chip">Current</div>
                                                </div>
                                                <div class="career-card-sub">The Manager, Rostering & Advanced Crewing at
                                                    AirAsia
                                                    is a pivotal leadership role responsible for planning, directing, and
                                                    coordinating crew scheduling and advanced crewing operatio...</div>
                                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                    requirement
                                                </div>
                                                <div class="chip-container">
                                                    <div class="skill-chips">
                                                        Decision Making
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Global Perspective
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Problem Solving
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Collaboration
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Aircraft Performance Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            5
                                                        </div>

                                                    </div>

                                                    <div class="add-skill-chip">+ 10 more skills</div>
                                                </div>
                                            </div>

                                            <div class="row-div  s-more-info-btn" style="gap: 10px;"
                                            onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                                <div class="enter-program-text"> More Info</div>
                                                <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                    height="24"></iconify-icon>

                                            </div>

                                        </div> --}}
                                    </div>

                                    <div class="row-div" style="justify-content: space-between; margin-top: 3rem;">
                                        <div class="career-button" onclick="prevTab('short-term')">Previous Section:
                                            Short-Term Goal</div>
                                        <button class="career-button" onclick="nextTab('future-roles')">Next Section:
                                            Desired
                                            Future Roles</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="long-term" class="tab-content" style="display: none;">
                            <div class="question-text">
                                1. Where do you see yourself professionally in the next 3 to 5 years?
                            </div>
                            <div class="answer-text" id="ltpromotion">Promotion</div>
                            <div class="answer-text " id="ltrole_transition">Role Transition
                            </div>

                            <div id="ltrole-transition-comp" style="display: none;">
                                <div class="question-text">
                                    2. Are there any Role Transition you’d like to take on in the near future?
                                </div>
                                <div class="row-div" style="justify-content: start">
                                    <div class="short-term-head">Suggestion Role Transition based on your Level 3 Position
                                    </div>
                                    <div class="row-div" style="gap: 5px; margin-left: 10px;">
                                        {{-- <img style="height: 15px;" class="icon_wrapper"
                                            src="{{ asset('images/development-plan/icons/analytics_icon.png') }}"
                                            alt="Flowers in Chania"> --}}
                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold" width="24"
                                            height="24"></iconify-icon>
                                        <div class="small-grey-text">3</div>
                                    </div>
                                    <div style=" margin-left: 10px;" class="roaster-planner-text">Staff II- Officer in
                                        Charge_Timekeeping_HQ</div>
                                    <a class="career-button row-div" href="#" data-bs-toggle="modal"
                                        data-bs-target="#careerMapModal" style="gap: 10px; margin-left: auto;">
                                        Career Map
                                        {{-- <img height="24px" src="{{ asset('images/development-plan/zoom_out_img.png') }}"> --}}
                                        <iconify-icon icon="gridicons:fullscreen" width="24"
                                            height="24"></iconify-icon>
                                    </a>
                                </div>
                                <div class="section-wrapper">
                                    <div class="job-position-container">
                                        <div class="card-wrapper-two card pb-0" style="width: 100%;">
                                            <div>
                                                <div class="row-div" style="justify-content: space-between;">
                                                    <div class="row-div" style="gap: 5px;">
                                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                            width="24" height="24"></iconify-icon>
                                                        <div class="small-grey-text">3</div>
                                                    </div>
                                                    <div class="meduim-match-chip">Current</div>
                                                </div>
                                                <div class="row-div"
                                                    style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                    <div class="carrer-card-head">HR Officer - People Operation and
                                                        Services</div>
                                                    {{-- <div class="current-chip">Current</div> --}}
                                                </div>
                                                <div class="career-card-sub">Primary responsible for promoting a positive
                                                    work environment and fostering strong relationships between employees
                                                    and management. Plays the key role in resolving workplace...</div>
                                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                    requirement
                                                </div>
                                                <div class="chip-container">
                                                    <div class="skill-chips">
                                                        Collaboration
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Communication
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Problem Solving
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Digital Fluency
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Human Resource Systems Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Data Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>



                                                    <div class="add-skill-chip">+ 10 more skills</div>
                                                </div>
                                            </div>


                                            <div class="row-div s-more-info-btn" style="gap: 10px;"
                                                onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                                <div class="enter-program-text"> More Info</div>
                                                <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                    height="24"></iconify-icon>

                                            </div>

                                        </div>
                                        <div class="card-wrapper-two unselect-card card pb-0" style="width: 100%;">
                                            <div>

                                                <div class="row-div" style="justify-content: space-between;">
                                                    <div class="row-div" style="gap: 5px;">
                                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                            width="24" height="24"></iconify-icon>
                                                        <div class="small-grey-text">3</div>
                                                    </div>
                                                    <div class="high-match-chip">86% Match</div>
                                                </div>
                                                <div class="row-div"
                                                    style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                    <div class="carrer-card-head">Staff II- Officer in
                                                        Charge_Timekeeping_HQ</div>
                                                </div>
                                                <div class="career-card-sub">Works under the supervision of the Senior
                                                    Manager- People Operations and Services . Supervises, direct and take
                                                    control of timekeeping activities such as enforcement of...</div>
                                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                    requirement
                                                </div>
                                                <div class="chip-container">
                                                    <div class="skill-chips">
                                                        Collaboration
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Communication
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Problem Solving
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Creative Thinking
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Human Resource System Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Data Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>


                                                    <div class="add-skill-chip">+ 10 more skills</div>
                                                </div>
                                            </div>

                                            <div class="row-div  s-more-info-btn" style="gap: 10px;"
                                                onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                                <div class="enter-program-text"> More Info</div>
                                                <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                    height="24"></iconify-icon>

                                            </div>

                                        </div>
                                    </div>

                                    {{-- <div class="row-div" style="justify-content: center; margin-top: 20px;">
                                        <div class="view-more-job-button">
                                            View More Job Positions
                                        </div>
                                    </div> --}}
                                    <div class="row-div" style="justify-content: end; margin-top: 20px;">
                                        <button class="career-button" onclick="nextTab('long-term')">Next Section: Long
                                            Term Goal</button>
                                    </div>



                                </div>

                            </div>

                            <div id="ltpromotion-comp" style="display: none;">

                                <div class="question-text">
                                    2. Are there any Specific Role you’d like to take on in the near future?
                                </div>
                                <div class="row-div" style="justify-content: start">
                                    <div class="short-term-head">Suggestion promotion
                                        based on your Level 3 Position</div>
                                    <div class="row-div" style="gap: 5px; margin-left: 10px;">
                                        {{-- <img style="height: 15px;" class="icon_wrapper"
                                            src="{{ asset('images/development-plan/icons/analytics_icon.png') }}"
                                            alt="Flowers in Chania"> --}}
                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold" width="24"
                                            height="24"></iconify-icon>
                                        <div class="small-grey-text">7</div>
                                    </div>
                                    <div style=" margin-left: 10px;" class="roaster-planner-text">Senior Manager - People
                                        Operations and Services</div>
                                    <a class="career-button row-div" href="#" data-bs-toggle="modal"
                                        data-bs-target="#careerMapModal" style="gap: 10px; margin-left: auto;">
                                        Career Map
                                        {{-- <img height="24px" src="{{ asset('images/development-plan/zoom_out_img.png') }}"> --}}
                                        <iconify-icon icon="gridicons:fullscreen" width="24"
                                            height="24"></iconify-icon>
                                    </a>
                                </div>
                                <div class="section-wrapper">

                                    <div class="job-position-container">
                                        <div class="card-wrapper-two unselect-card card pb-0" style="width: 100%;">
                                            <div>
                                                <div class="row-div" style="justify-content: space-between;">
                                                    <div class="row-div" style="gap: 5px;">
                                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                            width="24" height="24"></iconify-icon>
                                                        <div class="small-grey-text">3</div>
                                                    </div>
                                                    <div class="meduim-match-chip">Current</div>
                                                </div>
                                                <div class="row-div"
                                                    style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                    <div class="carrer-card-head">HR Officer - People Operation and
                                                        Services</div>
                                                    {{-- <div class="current-chip">Current</div> --}}
                                                </div>
                                                <div class="career-card-sub">Primary responsible for promoting a positive
                                                    work environment and fostering strong relationships between employees
                                                    and management. Plays the key role in resolving workplace...</div>
                                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                    requirement
                                                </div>
                                                <div class="chip-container">
                                                    <div class="skill-chips">
                                                        Collaboration
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Communication
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Problem Solving
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Digital Fluency
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            1
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Human Resource Systems Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Data Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            2
                                                        </div>

                                                    </div>



                                                    <div class="add-skill-chip">+ 10 more skills</div>
                                                </div>
                                            </div>

                                            <div class="row-div  s-more-info-btn" style="gap: 10px;"
                                                onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                                <div class="enter-program-text"> More Info</div>
                                                <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                    height="24"></iconify-icon>

                                            </div>

                                        </div>
                                        <div class="card-wrapper-two card pb-0" style="width: 100%;">
                                            <div>
                                                <div class="row-div" style="justify-content: space-between;">
                                                    <div class="row-div" style="gap: 5px;">
                                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                            width="24" height="24"></iconify-icon>
                                                        <div class="small-grey-text">7</div>
                                                    </div>

                                                    <div class="s-career-goal">Next Career Goal</div>
                                                </div>
                                                <div class="row-div"
                                                    style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                    <div class="carrer-card-head">Senior Manager - People Operations and
                                                        Services</div>
                                                    {{-- <div class="current-chip">Current</div> --}}
                                                </div>
                                                <div class="career-card-sub">Senior Manager – People Operations and
                                                    Services is the head of the People Operations and Services Department
                                                    and Timekeeping group of the entire domestic... </div>
                                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                    requirement
                                                </div>
                                                <div class="chip-container">
                                                    <div class="skill-chips">
                                                        Communication
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Decision Making
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>

                                                    <div class="skill-chips">
                                                        Developing People
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Problem Solving
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Workplace Optimization
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            5
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Technology Integration
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            5
                                                        </div>

                                                    </div>

                                                    <div class="add-skill-chip">+ 10 more skills</div>
                                                </div>
                                            </div>

                                            <div class="row-div  s-more-info-btn" style="gap: 10px;"
                                                onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                                <div class="enter-program-text"> More Info</div>
                                                <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                    height="24"></iconify-icon>

                                            </div>

                                        </div>
                                        {{-- <div class="card-wrapper-two unselect-card card pb-0" style="width: 100%;">
                                            <div>
                                                <div class="row-div" style="justify-content: space-between;">
                                                    <div class="row-div" style="gap: 5px;">
                                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                            width="24" height="24"></iconify-icon>
                                                        <div class="small-grey-text">3</div>
                                                    </div>
                                                    <div class="meduim-match-chip">63% Match</div>
                                                </div>
                                                <div class="row-div"
                                                    style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                    <div class="carrer-card-head">Manager Rostering & Advanced Crewing
                                                    </div>
                                                    <div class="current-chip">Current</div>
                                                </div>
                                                <div class="career-card-sub">The Manager, Rostering & Advanced Crewing at
                                                    AirAsia
                                                    is a pivotal leadership role responsible for planning, directing, and
                                                    coordinating crew scheduling and advanced crewing operatio...</div>
                                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                    requirement
                                                </div>
                                                <div class="chip-container">
                                                    <div class="skill-chips">
                                                        Decision Making
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Global Perspective
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-chips">
                                                        Problem Solving
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Collaboration
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            3
                                                        </div>

                                                    </div>
                                                    <div class="skill-yellow-chips">
                                                        Aircraft Performance Management
                                                        <div class="row-div" style="gap: 3px;">
                                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                                class="star-gold"></iconify-icon>
                                                            5
                                                        </div>

                                                    </div>

                                                    <div class="add-skill-chip">+ 10 more skills</div>
                                                </div>
                                            </div>

                                            <div class="row-div  s-more-info-btn" style="gap: 10px;"
                                            onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                                <div class="enter-program-text"> More Info</div>
                                                <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                    height="24"></iconify-icon>

                                            </div>

                                        </div> --}}
                                    </div>

                                    <div class="row-div" style="justify-content: space-between; margin-top: 3rem;">
                                        <div class="career-button" onclick="prevTab('short-term')">Previous Section:
                                            Short-Term Goal</div>
                                        <button class="career-button" onclick="nextTab('future-roles')">Next Section:
                                            Desired
                                            Future Roles</button>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="future-roles" class="tab-content" style="display: none">
                            <div class="question-text">
                                1. Are there any specific Manager roles you’re aiming for?
                            </div>
                            <div class="row-div" style="justify-content: start">
                                <div class="short-term-head">Suggested Manager Role</div>
                                <div class="row-div" style="gap: 5px; margin-left: 10px;">
                                    {{-- <img style="height: 15px;" class="icon_wrapper"
                                        src="{{ asset('images/development-plan/icons/analytics_icon.png') }}"
                                        alt="Flowers in Chania"> --}}
                                    <iconify-icon icon="ic:baseline-timeline" class="timeline-gold" width="24"
                                        height="24"></iconify-icon>
                                    <div class="small-grey-text">10</div>
                                </div>
                                <div style=" margin-left: 10px;" class="roaster-planner-text">Vice President - People Performance and Culture</div>
                                <a class="career-button row-div" href="#" data-bs-toggle="modal"
                                    data-bs-target="#careerMapModal" style="gap: 10px; margin-left: auto;">
                                    Career Map
                                    {{-- <img height="24px" src="{{ asset('images/development-plan/zoom_out_img.png') }}"> --}}
                                    <iconify-icon icon="gridicons:fullscreen" width="24"
                                        height="24"></iconify-icon>
                                </a>
                            </div>
                            <div class="section-wrapper">
                                <div class="job-position-container">
                                    <div class="card-wrapper-two unselect-card card pb-0" style="width: 100%;">
                                        <div>
                                            <div class="row-div" style="justify-content: space-between;">
                                                <div class="row-div" style="gap: 5px;">
                                                    <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                        width="24" height="24"></iconify-icon>
                                                    <div class="small-grey-text">3</div>
                                                </div>
                                                <div class="meduim-match-chip">Current</div>
                                            </div>
                                            <div class="row-div"
                                                style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                <div class="carrer-card-head">HR Officer - People Operation and
                                                    Services</div>
                                                {{-- <div class="current-chip">Current</div> --}}
                                            </div>
                                            <div class="career-card-sub">Primary responsible for promoting a positive
                                                work environment and fostering strong relationships between employees
                                                and management. Plays the key role in resolving workplace...</div>
                                            <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                requirement
                                            </div>
                                            <div class="chip-container">
                                                <div class="skill-chips">
                                                    Collaboration
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        1
                                                    </div>

                                                </div>
                                                <div class="skill-chips">
                                                    Communication
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        1
                                                    </div>

                                                </div>
                                                <div class="skill-chips">
                                                    Problem Solving
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        2
                                                    </div>

                                                </div>
                                                <div class="skill-chips">
                                                    Digital Fluency
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        1
                                                    </div>

                                                </div>
                                                <div class="skill-yellow-chips">
                                                    Human Resource Systems Management
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        2
                                                    </div>

                                                </div>
                                                <div class="skill-yellow-chips">
                                                    Data Management
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        2
                                                    </div>

                                                </div>



                                                <div class="add-skill-chip">+ 10 more skills</div>
                                            </div>
                                        </div>

                                        <div class="row-div  s-more-info-btn" style="gap: 10px;"
                                            onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                            <div class="enter-program-text"> More Info</div>
                                            <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                height="24"></iconify-icon>

                                        </div>

                                    </div>
                                    <div class="card-wrapper-two card pb-0" style="width: 100%;">
                                        <div>
                                            <div class="row-div" style="justify-content: space-between;">
                                                <div class="row-div" style="gap: 5px;">
                                                    <iconify-icon icon="ic:baseline-timeline" class="timeline-gold"
                                                        width="24" height="24"></iconify-icon>
                                                    <div class="small-grey-text">7</div>
                                                </div>

                                                <div class="s-career-goal">Next Career Goal</div>
                                            </div>
                                            <div class="row-div"
                                                style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                                <div class="carrer-card-head">Senior Manager - People Operations and
                                                    Services</div>
                                                {{-- <div class="current-chip">Current</div> --}}
                                            </div>
                                            <div class="career-card-sub">The Vice President for People Performance and Culture leads all the aspects of Human resources in alignment to recruitment or hiring, onboarding, retention, benefits, performance... </div>
                                            <div class="skill-requirement-text" style="margin: 5px 0px;">Skill
                                                requirement
                                            </div>
                                            <div class="chip-container">
                                                <div class="skill-chips">
                                                    Communication
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        3
                                                    </div>

                                                </div>
                                                <div class="skill-chips">
                                                    Decision Making
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        3
                                                    </div>

                                                </div>

                                                <div class="skill-chips">
                                                    Collaboration
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        3
                                                    </div>

                                                </div>
                                                <div class="skill-chips">
                                                    Global Perspective
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        3
                                                    </div>

                                                </div>
                                                <div class="skill-yellow-chips">
                                                    Workplace Optimization
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        5
                                                    </div>

                                                </div>
                                                <div class="skill-yellow-chips">
                                                    Technology Integration
                                                    <div class="row-div" style="gap: 3px;">
                                                        <iconify-icon icon="mdi:star" width="18" height="18"
                                                            class="star-gold"></iconify-icon>
                                                        6
                                                    </div>

                                                </div>

                                                <div class="add-skill-chip">+ 10 more skills</div>
                                            </div>
                                        </div>

                                        <div class="row-div  s-more-info-btn" style="gap: 10px;"
                                            onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                            <div class="enter-program-text"> More Info</div>
                                            <iconify-icon icon="ri:arrow-right-s-line" width="24"
                                                height="24"></iconify-icon>

                                        </div>

                                    </div>
                                </div>
                                {{-- <div class="row-div" style="justify-content: center; margin-top: 20px;">
                                    <div class="view-more-job-button">
                                        View More Job Positions
                                    </div>
                                </div> --}}

                                <div class="row-div" style="justify-content: space-between; margin-top: 3rem;">
                                    <div class="career-button" onclick="prevTab('long-term')">Previous Section:
                                        Long-Term
                                        Goal</div>
                                    <button class="career-button" onclick="nextTab('cross-departmental')">Next Section:
                                        Cross-Departmental Roles</button>

                                </div>


                            </div>


                        </div>
                        <div id="cross-departmental" class="tab-content" style="display: none">
                            <div id="question-comp">
                                <div class="question-text">
                                    1. Are you interested in exploring cross-departmental roles or participating in projects
                                    that involve collaboration across different teams or functions?
                                </div>
                                <div class="answer-text" id="yes-choice">Yes</div>
                                <div class="answer-text selected-option" id="no-choice">No</div>
                                {{-- <div class="role-choice" id="yes-choice">Yes</div>
                                <div class="role-choice" id="no-choice">No</div> --}}
                                <div id="department-select-box" style="display: none;">
                                    <div class="question-text">
                                        2. If so, which departments or areas would you like to work with?
                                    </div>

                                    <div class="col-lg-3">
                                        <select class="form-control form-select">
                                            <option>Choose Department</option>
                                            <option>Network Management Center
                                            </option>
                                            <option>Testing
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row-div" style="justify-content: space-between; margin-top: 3rem;">
                                    <div class="career-button" onclick="prevTab('future-roles')">Previous Section:
                                        Desired-Future Roles</div>
                                    <button class="career-button" onclick="handleSubmit(this)">Submit</button>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div id="career-result" style="display: none">
                        <div class="row-div" style="justify-content: start; gap: 10px;">
                            <div class="career-aspiration-text">Career Aspiration Goals</div>
                            <div class="row-div" style="gap: 5px;">
                                <a class="edit-text" href="">Edit</a>
                                <img style="height: 10px;" class="icon_wrapper"
                                    src="{{ asset('images/development-plan/icons/edit_icon.png') }}"
                                    alt="Flowers in Chania">

                            </div>
                        </div>
                        <div class="card-wrapper" style="margin-bottom: 3rem;">
                            <div class="col-div" style="gap: 20px;">
                                <div>
                                    <div class="card-head-wrapper">
                                        Short-Term Goal:
                                    </div>

                                    <div class="card-sub-wrapper">
                                        Role Transition, Roster Planner
                                    </div>
                                </div>

                                <div>
                                    <div class="card-head-wrapper">
                                        Long-Term Goal:
                                    </div>

                                    <div class="card-sub-wrapper">
                                        Promotion, Roster Planning Supervisor
                                    </div>
                                </div>

                                <div>
                                    <div class="card-head-wrapper">
                                        Desired-Future Roles:
                                    </div>

                                    <div class="card-sub-wrapper">
                                        Manager Rostering & Advance Crewing
                                    </div>
                                </div>

                                <div>
                                    <div class="card-head-wrapper">
                                        Cross-Departmental Roles:
                                    </div>

                                    <div class="card-sub-wrapper">
                                        No
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row-div" style="justify-content: start; gap: 10px; margin: 10px 0px;">
                            <img style="height: 20px;" class="icon_wrapper"
                                src="../images/icons/calendar_anal_icon.png" alt="Flowers in Chania">
                            <div class="career-aspiration-text">My Next Career Growth (Role Transition):</div>
                            <div class="row-div" style="gap: 5px;">
                                {{-- <img style="height: 15px;" class="icon_wrapper"
                                    src="{{ asset('images/development-plan/icons/analytics_icon.png') }}"
                                    alt="Flowers in Chania"> --}}
                                <iconify-icon icon="ic:baseline-timeline" class="timeline-gold" width="24"
                                    height="24"></iconify-icon>
                                <div class="small-grey-text">1</div>
                            </div>
                            <div class="roaster-planner-text">Roaster Planner</div>

                        </div>
                        <div class="row-div" style="justify-content: space-between; gap: 20px;">
                            <div class="card-wrapper-two" style="width: 100%;">
                                <div class="row-div" style="justify-content: space-between;">
                                    <div class="row-div" style="gap: 5px;">
                                        {{-- <img style="height: 15px;" class="icon_wrapper"
                                            src="{{ asset('images/development-plan/icons/analytics_icon.png') }}"
                                            alt="Flowers in Chania"> --}}
                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold" width="24"
                                            height="24"></iconify-icon>
                                        <div class="small-grey-text">1</div>
                                    </div>
                                    <div class="chip-brown">65% Match</div>
                                </div>
                                <div class="row-div" style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                    <div class="carrer-card-head">Turnaround Coordinator</div>
                                    <div class="current-chip">Current</div>
                                </div>
                                <div class="career-card-sub">The Turnaround Coordinator at AirAsia is responsible for
                                    ensuring the smooth and efficient management of flight operations during turnaround
                                    processes. This role involves coordinating with relevant stakeholders such as airlines,
                                    airport agencies, and authorities to resolve any operational issues...</div>
                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill requirement</div>
                                <div class="chip-container">
                                    <div class="skill-chips">
                                        Communication
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            3
                                        </div>

                                    </div>
                                    <div class="skill-chips">
                                        Customer Orientation
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            2
                                        </div>

                                    </div>
                                    <div class="skill-chips">
                                        Decision Making
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            2
                                        </div>

                                    </div>
                                    <div class="skill-chips">
                                        Problem Solving
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            3
                                        </div>

                                    </div>
                                    <div class="skill-yellow-chips">
                                        Accident and Incident Response Management
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            3
                                        </div>

                                    </div>
                                    <div class="skill-yellow-chips">
                                        Accident and Incident Response Management
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            3
                                        </div>

                                    </div>
                                    <div class="skill-yellow-chips">
                                        Aircraft Turnaround Coordination
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            3
                                        </div>

                                    </div>
                                    <div class="skill-yellow-chips">
                                        Change Management
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            3
                                        </div>

                                    </div>
                                    <div class="add-skill-chip">+ 10 more skills</div>
                                </div>
                                <hr>
                                <div class="row-div" style="gap: 10px;"
                                    onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                    <div class="enter-program-text"> More Info</div>
                                    <img height="15px"
                                        src="{{ asset('images/development-plan/icons/arrow_right.png') }}"
                                        alt="...">

                                </div>

                            </div>
                            <div class="card-wrapper-blue-two" style="width: 100%;">
                                <div class="row-div" style="justify-content: space-between;">
                                    <div class="row-div" style="gap: 5px;">
                                        {{-- <img style="height: 15px;" class="icon_wrapper"
                                            src="{{ asset('images/development-plan/icons/analytics_icon.png') }}"
                                            alt="Flowers in Chania"> --}}
                                        <iconify-icon icon="ic:baseline-timeline" class="timeline-gold" width="24"
                                            height="24"></iconify-icon>
                                        <div class="small-grey-text">1</div>
                                    </div>
                                    <div class="chip-brown">93% Match</div>
                                </div>
                                <div class="row-div" style="justify-content: start; gap: 10px; margin: 5px 0px;">
                                    <div class="carrer-card-head">Rostering Planner</div>
                                    <div class="current-chip">Next Career Goal</div>
                                </div>
                                <div class="career-card-sub">The Rostering Planner at AirAsia is responsible for managing
                                    and optimizing crew rosters to ensure efficient deployment and compliance with
                                    regulatory and operational requirements. This role involves monitoring flight
                                    operations, including aircraft performance, movements, and operating conditions, an...
                                </div>
                                <div class="skill-requirement-text" style="margin: 5px 0px;">Skill requirement</div>
                                <div class="chip-container">
                                    <div class="skill-chips">
                                        Collaboration
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            2
                                        </div>

                                    </div>
                                    <div class="skill-chips">
                                        Communication
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            2
                                        </div>

                                    </div>
                                    <div class="skill-chips">
                                        Problem Solving
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            1
                                        </div>

                                    </div>
                                    <div class="skill-chips">
                                        Aircraft Performance Management
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            2
                                        </div>

                                    </div>
                                    <div class="skill-chips">
                                        Airline Crew Scheduling
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            2
                                        </div>

                                    </div>
                                    <div class="skill-yellow-chips">
                                        Airline Operations Management
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            2
                                        </div>

                                    </div>
                                    <div class="skill-yellow-chips">
                                        Airport Operations Management
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            2
                                        </div>

                                    </div>
                                    <div class="skill-yellow-chips">
                                        Change Management
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            2
                                        </div>

                                    </div>
                                    <div class="skill-yellow-chips">
                                        Data Analytics
                                        <div class="row-div" style="gap: 3px;">
                                            <iconify-icon icon="mdi:star" width="18" height="18"
                                                class="star-gold"></iconify-icon>
                                            2
                                        </div>

                                    </div>
                                    <div class="add-skill-chip">+ 10 more skills</div>
                                </div>
                                <hr>
                                <div class="row-div" style="gap: 10px;"
                                    onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                    <div class="enter-program-text"> More Info</div>
                                    <img height="15px"
                                        src="{{ asset('images/development-plan/icons/arrow_right.png') }}"
                                        alt="...">

                                </div>

                            </div>
                        </div>
                        <div class="row-div"
                            style="justify-content: space-between; gap: 20px; margin: 20px 0px; align-items: start;">
                            <div class="card-wrapper-three" style="width: 40%;">
                                <div class="row-div" style="justify-content: start; gap: 10px;">
                                    <img height="20px"
                                        src="{{ asset('images/development-plan/yellow_suggestion.png') }}"
                                        alt="...">
                                    <div class="card-wrapper-three-head">
                                        Career Recommendation
                                    </div>
                                </div>
                                <div class="card-wrapper-three-sub">
                                    <p>As a Turnaround Coordinator transitioning to the Rostering Planner role at AirAsia,
                                        you will focus on optimizing crew rosters for efficient deployment while adhering to
                                        regulatory standards. </p>
                                    <p>Key responsibilities include monitoring flight operations, adjusting schedules to
                                        address delays or cancellations, and collaborating with teams to recover disrupted
                                        flights. </p>
                                    <p>To excel, you will need to enhance skills in crew scheduling, airport operations
                                        management, and IROPs management to better adapt to disruptions and create
                                        contingency plans.</p>
                                </div>

                            </div>
                            <div class="card-wrapper-three" style="width: 60%; padding-bottom: 20px !important;">
                                <div class="row-div" style="justify-content: start; gap: 10px;">
                                    <img height="20px"
                                        src="{{ asset('images/development-plan/yellow_suggestion.png') }}"
                                        alt="...">

                                    <div class="card-wrapper-three-head">
                                        Skills Gap Analysis for Rostering Planner
                                    </div>

                                </div>
                                <div class="card-wrapper-three-head-2">
                                    Soft Skill I Need:
                                </div>
                                <div class="row-div" style="justify-content: start; margin: 10px 0px; gap: 10px;">
                                    <div class="card-sub-text-1">Communication</div>
                                    <div class="small-chip">Basic</div>
                                    <div class="progress-container" style="margin-left: auto;">
                                        <div class="progress-bar" style="width: 100%;"></div>
                                    </div>
                                    <div class="progress-text">100%</div>
                                    <div class="completed-chip">Completed</div>
                                </div>
                                <div class="card-wrapper-three-head-2" style="margin-top: 30px;">
                                    Technical Skill I Need:
                                </div>
                                <div class="row-div" style="justify-content: start; margin: 10px 0px; gap: 10px;">
                                    <div class="card-sub-text-1">Airline Crew Scheduling</div>
                                    <div class="row-div" style="gap: 5px;">
                                        <img height="20px"
                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                            alt="...">
                                        <div class="yellow-small-text">3</div>
                                    </div>

                                    <div class="progress-container" style="margin-left: auto;">
                                        <div class="progress-bar" style="width: 90%;"></div>
                                    </div>
                                    <div class="progress-text">100%</div>
                                    <div class="completed-chip">Completed</div>
                                </div>
                                <hr style="margin: 20px 0px;">
                                <div class="row-div" style="justify-content: start; margin: 10px 0px; gap: 10px;">
                                    <div class="card-sub-text-1">Airport Operations Management</div>
                                    <div class="row-div" style="gap: 5px;">
                                        <img height="20px"
                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                            alt="...">
                                        <div class="yellow-small-text">3</div>
                                    </div>

                                    <div class="progress-container" style="margin-left: auto;">
                                        <div class="progress-bar" style="width: 64%;"></div>
                                    </div>
                                    <div class="progress-text">64%</div>
                                    <div class="suggestion-card-chips">In Progess</div>
                                </div>
                                <hr style="margin: 20px 0px;">
                                <div class="row-div" style="justify-content: start; margin: 10px 0px; gap: 10px;">
                                    <div class="card-sub-text-1">Flight Disruptions and Irregular Operations Management
                                    </div>
                                    <div class="row-div" style="gap: 5px;">
                                        <img height="20px"
                                            src="{{ asset('images/development-plan/icons/yellow_star_icon.png') }}"
                                            alt="...">
                                        <div class="yellow-small-text">3</div>
                                    </div>

                                    <div class="progress-container" style="margin-left: auto;">
                                        <div class="progress-bar" style="width: 0%;"></div>
                                    </div>
                                    <div class="progress-text">0%</div>
                                    <div class="enrolled-card-chip">Enrolled</div>
                                </div>
                                <hr style="margin-top: 30px;">
                                <div class="row-div" style="gap: 10px;"
                                    onclick="window.open('{{ route('employee.dashboard.jd-details') }}', '_blank')">
                                    <div class="enter-program-text"> More Info</div>
                                    <img height="15px"
                                        src="{{ asset('images/development-plan/icons/arrow_right.png') }}"
                                        alt="...">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="careerMapModal" tabindex="-1" aria-labelledby="careerMapModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header career-map-modal-header">
                    <div></div>
                    <h5 class="modal-title" id="careerMapModalLabel">Career Map Overview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-career-map-modal">
                    <!-- Embed or load the career map page here -->
                    <iframe src="{{ route('career_map') }}"
                        style="width: 100vw; height: 100vh; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
    <script>
        // JavaScript function for toggling the active tab
        function selectNavTab(clickedTab, targetId) {
            // Get all tabs
            const tabs = document.querySelectorAll('.tab');
            // Remove the 'selected' class from all tabs
            tabs.forEach(tab => tab.classList.remove('tab-active'));

            // Add the 'selected' class to the clicked tab
            clickedTab.classList.add('tab-active');
            const contents = document.querySelectorAll('.tab-content');
            // Hide all content divs
            contents.forEach(content => (content.style.display = 'none'));

            // Show the corresponding content div
            const targetContent = document.getElementById(targetId);
            if (targetContent) {
                targetContent.style.display = 'block';
            } else {
                console.error(`Content with ID '${targetId}' not found.`);
            }
        }
        // Function to go to the next tab
        function nextTab(nextTabId) {
            const nextTab = document.querySelector(`.tab[onclick*="${nextTabId}"]`);
            if (nextTab) {
                selectNavTab(nextTab, nextTabId);
            } else {
                console.error(`Next tab '${nextTabId}' not found.`);
            }
        }

        // Function to go to the previous tab
        function prevTab(prevTabId) {
            const prevTab = document.querySelector(`.tab[onclick*="${prevTabId}"]`);
            if (prevTab) {
                selectNavTab(prevTab, prevTabId);
            } else {
                console.error(`Previous tab '${prevTabId}' not found.`);
            }
        }
    </script>
    <script>
        // JavaScript function for toggling the active tab
        function ShortTermSelectTab(clickedTab) {

            // Get all tabs
            const tabs = document.querySelectorAll('.answer-text');
            // Remove the 'selected' class from all tabs
            tabs.forEach(tab => tab.classList.remove('selected-option'));

            // Add the 'selected' class to the clicked tab
            clickedTab.classList.add('selected-option');
            //                       document.getElementById("role-transition-comp").display = 'none';
            // //   element.classList.remove("display-none");  
            //                     console.log("thisDocument",document.getElementById("role-transition-comp"))
            //   const targetElement = document.g 
        }
    </script>
    <script>
        // JavaScript function for toggling the active tab
        function selectTab(clickedTab) {
            // Get all tabs
            const tabs = document.querySelectorAll('.answer-text');
            // Remove the 'selected' class from all tabs
            tabs.forEach(tab => tab.classList.remove('selected-option'));

            // Add the 'selected' class to the clicked tab
            clickedTab.classList.add('selected-option');
        }
    </script>
    <script>
        // JavaScript function for toggling the active tab
        function selectTab(clickedTab) {
            // Get all tabs
            const tabs = document.querySelectorAll('.answer-text');
            // Remove the 'selected' class from all tabs
            tabs.forEach(tab => tab.classList.remove('selected-option'));

            // Add the 'selected' class to the clicked tab
            clickedTab.classList.add('selected-option');
        }

        function handleSubmit(elementID) {


            // Show the corresponding content div
            const questionContent = document.getElementById('tab-screen-comp');
            questionContent.style.display = 'none';
            console.log("questionCont", questionContent);
            const careerResultContent = document.getElementById('career-result');
            careerResultContent.style.display = 'block';
            console.log("careerResultCon", careerResultContent);

            // if (targetContent) {
            //   targetContent.style.display = 'none';
            // } else {
            //   console.error(`Content with ID '${targetId}' not found.`);
            // }
        }
    </script>
    {{-- <script>
        document.querySelector('.dropdown-toggle').addEventListener('click', function() {
            const dropdown = this.closest('.dropdown');
            dropdown.classList.toggle('active');
        });
    </script> --}}
    <script>
        // Get the 'Yes' and 'No' divs and the department select box
        const yesChoice = document.getElementById('yes-choice');
        const noChoice = document.getElementById('no-choice');
        const departmentSelectBox = document.getElementById('department-select-box');

        // Add event listeners to the 'Yes' and 'No' divs
        yesChoice.addEventListener('click', function() {
            departmentSelectBox.style.display = 'block'; // Show the select box when 'Yes' is clicked
            yesChoice.classList.add('selected-option');
            noChoice.classList.remove('selected-option');
        });

        noChoice.addEventListener('click', function() {
            departmentSelectBox.style.display = 'none'; // Hide the select box when 'No' is clicked
            noChoice.classList.add('selected-option');
            yesChoice.classList.remove('selected-option');
        });
    </script>


    <script>
        // Get the 'Yes' and 'No' divs and the department select box
        const promotionbtn = document.getElementById('promotion');
        const role_transitionbtn = document.getElementById('role_transition');
        const roleTransitionComp = document.getElementById('role-transition-comp');
        const promotionComp = document.getElementById('promotion-comp');


        // Add event listeners to the 'Yes' and 'No' divs
        role_transitionbtn.addEventListener('click', function() {
            console.log(roleTransitionComp);
            roleTransitionComp.style.display = 'grid'; // Show the select box when 'Yes' is clicked
            promotionComp.style.display = 'none'; // Hide the select box when 'No' is clicked

            role_transitionbtn.classList.add('selected-option');
            promotionbtn.classList.remove('selected-option');
        });

        promotionbtn.addEventListener('click', function() {
            console.log(promotionComp);
            promotionComp.style.display = 'grid'; // Hide the select box when 'No' is clicked
            roleTransitionComp.style.display = 'none'; // Show the select box when 'Yes' is clicked

            promotionbtn.classList.add('selected-option');
            role_transitionbtn.classList.remove('selected-option');
        });
    </script>

    <script>
        // Get the 'Yes' and 'No' divs and the department select box
        const ltpromotionbtn = document.getElementById('ltpromotion');
        const ltrole_transitionbtn = document.getElementById('ltrole_transition');
        const ltroleTransitionComp = document.getElementById('ltrole-transition-comp');
        const ltpromotionComp = document.getElementById('ltpromotion-comp');


        // Add event listeners to the 'Yes' and 'No' divs
        ltrole_transitionbtn.addEventListener('click', function() {
            console.log(roleTransitionComp);
            ltroleTransitionComp.style.display = 'grid'; // Show the select box when 'Yes' is clicked
            ltpromotionComp.style.display = 'none'; // Hide the select box when 'No' is clicked

            ltrole_transitionbtn.classList.add('selected-option');
            ltpromotionbtn.classList.remove('selected-option');
        });

        ltpromotionbtn.addEventListener('click', function() {
            console.log(roleTransitionComp);
            ltpromotionComp.style.display = 'grid'; // Hide the select box when 'No' is clicked
            ltroleTransitionComp.style.display = 'none'; // Show the select box when 'Yes' is clicked

            ltpromotionbtn.classList.add('selected-option');
            ltrole_transitionbtn.classList.remove('selected-option');
        });
    </script>
@endsection
