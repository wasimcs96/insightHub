@props([
    'employeeData',
    'resultTAPsychometric',
    'availableLevels',
    'id',
    'completedCount',
    'incompleteCount',
    'positionsByLevelPsychometric',
    'levelsByPositionPsychometric'
])

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

    .custom-select-wrapper select {
        padding-right: 2rem !important; /* extra space before the dropdown icon */
    }

    .page-item.active .page-link{
        background-color: #F7941C !important;
        border-color: #F7941C !important;
        color: #fff !important;
    }

    .page-link{
        color: #78829D !important;
    }
    .pagination-wrapper {
        display: flex;
        justify-content: flex-end;
        margin-top: 1rem;
    }

    #per_page {
        padding: 5px 10px;
        margin-left: 10px;
    }


    .level-indicators-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: 15px;
    }

    .level-indicators-container h2 {
        margin: 0;
        padding: 5px;
        background: #f5f5f5;
        border-radius: 4px;
        text-align: center;
        font-size: 14px;
    }

    .profile-img-container {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
    }

    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 2px solid #fff; /* Optional white border */
        box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Optional subtle shadow */
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .svg-filter-gray {
        filter: brightness(0) saturate(100%) invert(67%) sepia(0%) saturate(0%) hue-rotate(180deg) brightness(93%) contrast(83%);
    }

    .off-screen {
        position: absolute;
        left: -10000px;
        /* Move far off-screen */
        top: -10000px;
        /* Move far off-screen */
        width: 1px;
        /* Minimize width */
        height: 1px;
        /* Minimize height */
        overflow: hidden;
        /* Ensure no overflow */
    }

    .table-container {
        overflow-x: auto;
        overflow-y: auto;
        height: 89vh;
    }

    .custom-table {
        width: max-content;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .custom-table thead th {
        padding: 16px;
        color: #4B5675;
        text-align: center;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
        border-bottom: 1px solid #DBDFE9;
    }

    .custom-table tr th:nth-child(3),
    .custom-table tbody td:nth-child(3) {
        background: #FFF5DA;
    }

    .custom-table th:nth-child(5),
    .custom-table td:nth-child(5),
    .custom-table th:nth-child(7),
    .custom-table td:nth-child(7) {
        background: #FAFAFB;
    }

    .employee-head {
        display: flex;
        justify-content: space-between;
    }

    .employee-head p,
    .top-row p {
        margin: 0;
    }

    .top-row {
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

    .custom-table tbody td {
        text-align: center;
        padding: 16px;
        font-size: 0.9rem;
        vertical-align: middle;
        border-bottom: 1px solid #DBDFE9;
    }

   /* Dropdown positioning fix */
   .employee-info {
        position: relative;
        z-index: 1;
        display: flex;
        width: 100%; /* ← Add this! */
        align-items: center; /* (optional) vertically align image + text nicely */
        gap: 10px; /* (optional) nice spacing between photo and text */
    }


    [data-kt-menu-trigger="click"] {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 8px;
    }

    .menu-sub-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 5px); /* Position below the trigger with small gap */
        right: 0;
        background: white;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        z-index: 1001; /* Higher than table rows */
        min-width: 180px;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
    }

    .menu-sub-dropdown.show {
        display: block;
    }

    /* Make sure table cells don't clip the dropdown */
    .custom-table td {
        position: relative; /* Contain the dropdown within cell */
        overflow: visible; /* Allow dropdown to overflow */
    }

    /* Increase z-index for sticky header to prevent clipping */
    .custom-table thead th {
        z-index: 1; /* Lower than dropdown */
    }

    .menu-sub-dropdown a {
        display: block;
        padding: 8px 16px;
        color: #333;
        text-decoration: none;
        white-space: nowrap;
    }

    .menu-sub-dropdown a:hover {
        background-color: #f5f5f5;
    }

    .employee-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .employee-info .employee-name {
        color: #071437;
        font-size: 12px;
        font-weight: 600;
        line-height: normal;
        margin: 0;
        text-align: left;
    }

    .employee-info .employee-role {
        color: #4B5675;
        font-size: 10px;
        font-weight: 500;
        line-height: 16px;
        margin: 0;
        text-align: left;
        margin-bottom: 5px;
    }

    .table-status {
        border-radius: 15px;
        padding: 4px 12px;
        width: max-content;
    }

    .high {
        background-color: #DDF5E2;
        color: #196329;
    }

    .moderate {
        background-color: #FFEBB4;
        color: #EB8100;
    }

    .low {
        background-color: #ffcdd2;
        color: #d32f2f;
    }

    .profile {
        color: #D9D9D9;
        font-size: 36px;
        width: 36px;
    }

    .profile-name-table {
        display: flex;
        flex-direction: column;
        font-size: 13px;
        font-weight: 500;
        width: 100%;
        text-align: left;
    }

    .profile-name-table p {
        margin-top: 4px;
    }

    .info {
        font-size: 20px;
        color: #757575;
        width: 20px;
    }

    .custom-table input[type="checkbox"] {
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

    .custom-table input[type="checkbox"]:checked {
        background-color: #F7941C;
        border: 4px solid #fff;
        box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }

    .custom-table td:first-child,
    .custom-table td:nth-child(2),
    .custom-table th:first-child,
    .custom-table th:nth-child(2) {
        position: sticky;
        left: 0;
        z-index: 1;
        background-color: white;
    }

    .custom-table th:nth-child(1),
    .custom-table th:nth-child(2) {
        z-index: 100;
        background-color: #f8f8f8;
    }

    .custom-table thead th {
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 1;
    }

    .custom-table td {
        background-color: #fff;
        z-index: 0;
    }

    .page-icon {
        font-size: 24px;
        color: #99A1B7;
    }

    .active>.page-link,
    .page-link.active {
        background: #071437;
    }

    .report-dropdown a {
        color: black;
        font-weight: 400;
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
        max-width: 150px;
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

    /* .filter-buttons input[type="checkbox"]:checked {
        accent-color: #F7941C !important;
    } */

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

    .form-check-input:checked {
        background-color: #F7941C !important;
        border-color: #F7941C !important;
    }

    .top-sub-heading {
        color: #252F4A;
        font-size: 22.75px;
        font-weight: 500;
        line-height: 27.3px;
    }

    .heading-round {
        width: 20px;
        height: 20px;
        border-radius: 100px;
        display: block;
    }

    .view-detail-btn {
        color: #F7941C;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        cursor: pointer;
    }

    .heading-round.next-gen-leader {
        background: #34792F;
    }

    .heading-round.rising-star, .heading-round.emerging-talent {
        background: #7DC76F;
    }

    .heading-round.solid-contributor, .heading-round.emerging-performer, .heading-round.trusted-professional {
        background: #F6E54B;
    }

    .heading-round.inconsistent-performer, .heading-round.valued-contributor {
        background: #F2B948;
    }

    .heading-round.lower-performer {
        background: #E66C6C;
    }

    .card-profile-box>div {
        width: 31%;
    }

    .card-box {
        display: flex;
        padding: 20px;
        align-items: center;
        gap: 20px;
        border-radius: 4px;
        cursor: pointer;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.10);
    }

    .card-box:hover {
        background-color: #FFF6EA;
    }

    .card-box p {
        margin: 0;
    }

    .profile-img {
        width: 50px;
        height: 50px;
        display: block;
        background: #DBDFE9;
        border-radius: 50px;
    }

    .card-box .name {
        color: #252F4A;
        font-size: 16.25px;
        font-weight: 500;
        line-height: 19.5px;
    }

    .card-box .designation {
        color: #78829D;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .card-box .email {
        color: #99A1B7;
        font-size: 10px;
        font-weight: 400;
        line-height: 14px;
        margin-top: 13px;
    }

    .profile-content span {
        padding: 4px 12px;
        border-radius: 80px;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .profile-content .green {
        color: #196329;
        background: #DDF5E2;
    }

    .filter-buttons h4 {
        color: #78829D;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
    }
    .psychometric-filter-buttons {
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
 
    .psychometric-filter-btn {
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
        /* Remove max-width constraint */
        /* max-width: 150px; */
        white-space: nowrap; /* Keep text in single line */
        height: 40px;
        /* Add min-width if needed */
        min-width: max-content;
    }
 
    .psychometric-filter-btn span {
        display: flex;
        align-items: center;
        gap: 8px;
        /* Remove max-width and overflow constraints */
        /* max-width: 100px; */
        /* overflow: hidden; */
        white-space: nowrap;
        /* Remove text-overflow */
        /* text-overflow: ellipsis; */
    }
 
    .psychometric-radio-input {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 15px;
        height: 13px;
        border: 1px solid #DBDFE9;
        border-radius: 50%;
        margin-right: 8px;
        position: relative;
        cursor: pointer;
        display: inline-block;
        vertical-align: middle;
    }
 
    .psychometric-radio-input:checked {
        border: 1px solid #F7941C;
        background-color: #fff;
    }
 
    .psychometric-radio-input:checked::after {
        content: '';
        display: block;
        width: 8px;
        height: 8px;
        background: #F7941C;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
 
    .psychometric-custom-check-input {
        padding: 12px 8px;
        cursor: pointer;
    }
 
    .psychometric-active-btn {
        border: 1px solid #F7941C;
        background: #FFF6EA;
        color: #F7941C;
        font-weight: 600;
    }
 
    .psychometric-dropdown-menu {
        border-radius: 4px;
        padding: 0;
        border: 1px solid #DBDFE9;
        display: none; /* Hidden by default */
        position: absolute;
        background: white;
        z-index: 1000;
    }
 
    .psychometric-button-div {
        padding: 12px 8px;
        gap: 12px;
        border-top: 1px solid #DBDFE9;
    }
 
    .psychometric-filter {
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
        border: none;
        cursor: pointer;
    }
 
    .psychometric-resetBtn {
        color: #5B5B5B;
        text-align: right;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
        background-color: white;
        border: none;
        cursor: pointer;
    }
 
    .psychometric-custom-check-input:hover {
        background: #FFF6EA;
    }
 
    .psychometric-custom-check-input.active {
        background: #FFF6EA;
    }
 
    .psychometric-custom-check-input label p {
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
        color: #000;
        margin: 0;
    }
 
    .psychometric-custom-check-input label span {
        color: #99A1B7;
    }

    .psychometric-employee-search {
        position: relative;
        display: flex;
    }

    .psychometric-employee-searchTerm {
        padding: 8px 12px;
        border: 1px solid #DBDFE9;
        border-radius: 4px;
    }

    .psychometric-employee-searchButton {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
    }
    .psychometric-content-first-tab{
        margin-bottom: 30px;
    }

    .psychometric-filter-buttons h4 {
        color: #78829D;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
    }

    .chart-card {
        background-color: #ffffff;
        border: 0.5px solid #d3d3d3;
        border-radius: 10px;
        padding: 15px;
    }
    .filter-container1{
        display: flex;
        gap: 15px;
        flex-direction: row;
        align-items: center;
    }
    .filter-btn1{
        max-width: 300px !important;
    }
    .filter-btn1 span{
        overflow: unset !important;
        max-width: unset !important;
    }
</style>

<div class="tab-content psychometric-main-content">
    <x-people-retention-department.tab-psychometric.nav-tab-psychometric />
    <div class="psychometric-nav-content-box">
        <div class="psychometric-content">
            <div class="psychometric-content-first-tab">
                <div class="error-container">
                    <h2 class="psychometric-title">Aggregated Department Report</h2>
                    <div id="pdf-error-msg" style="color: red; display: none; margin-top: 10px;"></div>                    
                </div>
                <button id="download-pdf" class="aggregated-report-download-btn">
                    <i class="bi bi-download"></i>
                    Download PDF
                </button>
            </div>
            <div class="psychometric-filter-buttons">
                <h4>Filter</h4>
                <div class="dropdown">
                    <button class="psychometric-filter-btn" type="button" id="psychometricPositionLevelChart" 
                            data-bs-toggle="psychometric-dropdown" data-default-text="Position Level Chart" aria-expanded="false">
                        <span style="color: #000">Position Level (Selection up to 4)</span> 
                        <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                    </button>
                    <div class="psychometric-dropdown-menu" style="width: 202px; max-height: 300px; overflow-y: auto;">
                        <?php 
                        $levelNames = config('helpers.levels');
                        
                        foreach ($availableLevels as $level): 
                            if ($level === "") continue;
                            
                            $levelName = $levelNames[$level] ?? "Level $level";
                        ?>
                            <div class="d-flex gap-3 align-items-center psychometric-custom-check-input">
                                <input class="psychometric-checkbox-input" type="checkbox" 
                                       name="psychometricPositionLevelChartFilter" 
                                       value="Level <?= $level ?>"
                                       data-target="psychometricPositionLevelChart">
                                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                    <p class="m-0"><?= $levelName ?></p>
                                </label>
                                
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="d-flex justify-content-end gap-4 align-items-center psychometric-button-div">
                            <button class="psychometric-resetBtn" data-target="psychometricPositionLevelChart">Reset</button>
                            <button class="psychometric-filter">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="selected-value-display1" style="display: none; margin-top: 20px; padding: 10px; border: 1px solid #ddd;">
            </div>
            <div id="selected-value-display2" style="display: none; margin-top: 20px; padding: 10px; border: 1px solid #ddd;">
            </div>
            <div id="selected-value-display3" style="display: none; margin-top: 20px; padding: 10px; border: 1px solid #ddd;">
            </div>
            <div id="selected-value-display4" style="display: none; margin-top: 20px; padding: 10px; border: 1px solid #ddd;">
            </div>
            <div id="selected-value-display5" style="display: none; margin-top: 20px; padding: 10px; border: 1px solid #ddd;">
            </div>
            <div id="selected-value-display6" style="display: none; margin-top: 20px; padding: 10px; border: 1px solid #ddd;">
            </div>
            <div id="selected-value-display7" style="display: none; margin-top: 20px; padding: 10px; border: 1px solid #ddd;">
            </div>
            <div id="selected-value-display8" style="display: none; margin-top: 20px; padding: 10px; border: 1px solid #ddd;">
            </div>
            <div id="selected-value-display9" style="display: none; margin-top: 20px; padding: 10px; border: 1px solid #ddd;">
            </div>
            <div class="aggregated-department-graph">
                <div class="aggregated-department-graph-container">
                    <div class="overall-match-rate chart-card">
                        <h2>Overall Match Rate</h2>
                        <div id="overall-match-rate-chart"></div>
                    </div>
                    <div class="technical-assessment chart-card">
                        <h2>Technical Assessment</h2>
                        <div id="technical-assessment-chart"></div>
                    </div>
                    <div class="behavioral-fit-rate chart-card">
                        <h2>Behavioral Fit Rate</h2>
                        <div id="behavioral-fit-rate-chart"></div>
                    </div>
                    <div class="job-match-rate chart-card">
                        <h2>Job Match Rate</h2>
                        <div id="job-match-rate-chart"></div>
                    </div>
                    <div class="ssmr-rate chart-card">
                        <h2>Soft Skill Match Rate</h2>
                        <div id="ssmr-chart"></div>
                    </div>
                    <div class="gp-rate chart-card">
                        <h2>Growth Potential</h2>
                        <div id="gp-chart"></div>
                    </div>
                    <div class="workplace-alignment-forecast chart-card">
                        <h2>Workplace Alignment Forecast</h2>
                        <div id="workplace-alignment-forecast-chart"></div>
                    </div>
                    <div class="flight-risk chart-card">
                        <h2>Flight Risk</h2>
                        <div id="flight-risk-chart"></div>
                    </div>
                    <div class="cognitive-ability chart-card">
                        <h2>Cognitive Ability</h2>
                        <div id="cognitive-ability-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="psychometric-content" id="tabPsychometric">
            <div class="psychometric-content-second-tab">
                <h2 class="psychometric-title">Psychometric Report</h2>
            </div>
            <div class="filter-buttons d-flex align-items-center mb-14 justify-content-between" data-tab="individual">
                <div class="filter-container1">
                    <h4>Filter</h4>
                    @php
                        $positionsByLevelPsychometric = $positionsByLevelPsychometric->sortKeys();
                        $levelsByPositionPsychometric = $levelsByPositionPsychometric->sortKeys();
                    @endphp

        
                    <div class="dropdown">
                        <button class="filter-btn" type="button" id="PositionLevelIndividual" data-bs-toggle="dropdown"
                            data-default-text="Position Level" aria-expanded="false">
                            <span>Position Level</span>
                            <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                        </button>
                        <div class="dropdown-menu mt-4" style="width: 210px; max-height: 300px; overflow-y: auto;">
                            @foreach($positionsByLevelPsychometric as $positionLevel)
                                <div class="d-flex flex-column gap-1 custom-check-input">
                                    <div class="d-flex gap-3 align-items-center">
                                        <input class="interview-option" type="radio" name="PositionLevelIndividualFilter"
                                            value="{{ $positionLevel['level'] }}" data-target="PositionLevelIndividual">
                                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                            <p class="m-0">Level {{ $positionLevel['level'] }}</p>
                                            <span>{{ $positionLevel['count'] }}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach

        
                            <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                                <button class="resetBtn border-0" data-target="PositionLevelIndividual">Reset</button>
                                <button class="filter border-0">Filter</button>
                            </div>
                        </div>
                    </div>
        
                    <div class="dropdown">
                        <button class="filter-btn" type="button" id="JobPositionIndividual" data-bs-toggle="dropdown"
                            data-default-text="Job Position" aria-expanded="false">
                            <span>Job Position</span>
                            <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                        </button>
                        <div class="dropdown-menu mt-4" style="width: 210px; max-height: 300px; overflow-y: auto;">
                           @foreach($levelsByPositionPsychometric as $jobPosition)
                                <div class="d-flex flex-column gap-1 custom-check-input">
                                    <div class="d-flex gap-3 align-items-center">
                                        <input class="interview-option" type="radio" name="JobPositionIndividualFilter"
                                            value="{{ $jobPosition['position_name'] }}" data-target="JobPositionIndividual">
                                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                            <p class="m-0">{{ $jobPosition['position_name'] }}</p>
                                            <span>{{ $jobPosition['count'] }}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach

        
                            <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                                <button class="resetBtn border-0" data-target="JobPositionIndividual">Cancel</button>
                                <button class="filter border-0" id="filterButton">Filter</button>
                            </div>
                        </div>
                    </div>
        
                    <div class="dropdown">
                        <button class="filter-btn filter-btn1" type="button" id="AssessmentCompletion" data-bs-toggle="dropdown"
                            data-default-text="Assessment Completion" aria-expanded="false">
                            <span>Assessment Completion</span> <iconify-icon icon="tabler:chevron-down" width="16"
                                height="16"></iconify-icon>
                        </button>
                        <div class="dropdown-menu mt-4" style="width: 202px;">
                            <div class="d-flex gap-3 align-items-center custom-check-input">
                                <input class="interview-option" type="radio" name="AssessmentCompletionFilter"
                                    value="All Assessments Completed" data-target="AssessmentCompletion">
                                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                    <p class="m-0">All Assessments Completed</p> <span>{{ $completedCount }}</span>
                                </label>
                            </div>
                            <div class="d-flex gap-3 align-items-center custom-check-input">
                                <input class="interview-option" type="radio" name="AssessmentCompletionFilter" value="Incomplete Assessments"
                                    data-target="AssessmentCompletion">
                                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                    <p class="m-0">Incomplete Assessments</p> <span>{{ $incompleteCount }}</span>
                                </label>
                            </div>
                            <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                                <button class="resetBtn border-0" data-target="AssessmentCompletion">Cancel</button>
                                <button class="filter border-0">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="employee-search employee-position-search ms-3">
                    <input type="text" class="employee-searchTerm" 
                           placeholder="Search Employee or Job Position" 
                           id="searchEmployeeInput">
                    <button type="button" class="employee-searchButton">
                        <i class="bi bi-search" style="color: #ffffff"></i>
                    </button>
                </div>
            </div>
        
            <div class="table-container">
                <table class="custom-table" id="resultTable" style="border-collapse: collapse; width: 100%;">
                    <colgroup>
                        <col style="width: 25%;"> <!-- Employee column (make it wider) -->
                        <col style="width: 14%;"> <!-- Other columns equally distributed -->
                        <col style="width: 14%;">
                        <col style="width: 14%;">
                        <col style="width: 14%;">
                        <col style="width: 14%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="sortable" data-sort-column="employee" style="background-color: white; z-index: 0 !important; position: static;">
                                <div class="employee-head">
                                    <p>Employee</p>
                                    <iconify-icon icon="ri:arrow-down-s-line" class="info"></iconify-icon>
                                </div>
                            </th>
                            <th class="sortable" data-sort-column="omr_level" style="background-color: white; z-index: 0 !important; position: static;">
                                <div class="top-row">
                                    <p><span class="top-text">Personality &</span><br>Motivation</p>
                                    <iconify-icon icon="ri:arrow-down-s-line" class="info"></iconify-icon>
                                </div>
                            </th>
                            <th class="sortable" data-sort-column="bfr_level" style="background-color: white; z-index: 0 !important; position: static;">
                                <div class="top-row">
                                    <p><span class="top-text">Work</span><br>Interest</p>
                                    <iconify-icon icon="ri:arrow-down-s-line" class="info"></iconify-icon>
                                </div>
                            </th>
                            <th class="sortable" data-sort-column="ta_level" style="background-color: white; z-index: 0 !important; position: static;">
                                <div class="top-row">
                                    <p><span class="top-text">Cognitive</span><br>Ability</p>
                                    <iconify-icon icon="ri:arrow-down-s-line" class="info"></iconify-icon>
                                </div>
                            </th>
                            <th class="sortable" data-sort-column="ssmr_level" style="background-color: white; z-index: 0 !important; position: static;">
                                <div class="top-row">
                                    <p><span class="top-text">Technical</span><br>Assessment</p>
                                    <iconify-icon icon="ri:arrow-down-s-line" class="info"></iconify-icon>
                                </div>
                            </th>
                            <th class="sortable" data-sort-column="jmr_level" style="background-color: white; z-index: 0 !important; position: static;">
                                <div class="top-row">
                                    <p>Last Download</p>
                                    <iconify-icon icon="ri:arrow-down-s-line" class="info"></iconify-icon>
                                </div>
                            </th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @include('components.people-retention-department.tab-psychometric.table-rows', ['resultTAPsychometric' => $resultTAPsychometric])
                    </tbody>
                </table>
            </div>
        
            <div class="d-flex align-items-center mt-4 gap-4 flex-wrap">
                <form method="GET" id="perPageForm" class="d-flex align-items-center gap-2">
                    <label for="per_page" class="mb-0">Rows per page:</label>
                    <div class="custom-select-wrapper">
                        <select name="per_page" id="per_page" class="form-select form-select-sm w-auto">
                            @foreach([10, 20, 50, 100] as $limit)
                                <option value="{{ $limit }}" {{ request('per_page', 10) == $limit ? 'selected' : '' }}>
                                    {{ $limit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="tab" value="2">
                </form>
        
                <div class="pagination-wrappe" style="margin-left: 50px;">
                    {{ $resultTAPsychometric->appends([
                        'job_position' => request('job_position'),
                        'position_level' => request('position_level'),
                        'assessment_completion' => request('assessment_completion'),
                        'search' => request('search'),
                        'per_page' => request('per_page', 10),  // Default per_page to 10
                        'tab' => 2
                    ])->links() }}
                </div>
            </div>
        </div>
        
        <div class="psychometric-content">
            @php
                $groupedEmployees = $employeeData->groupBy('bfr_level');
                $bfrLevelTitles = [
                    1 => ['title' => 'Emerging Performer', 'color' => '#F6E54B'],
                    2 => ['title' => 'Rising Star', 'color' => '#7DC76F'],
                    3 => ['title' => 'Next Gen Leader', 'color' => '#34792F'],
                    4 => ['title' => 'Inconsistent Performer', 'color' => '#F2B948'],
                    5 => ['title' => 'Solid Contributor', 'color' => '#F6E54B'],
                    6 => ['title' => 'Emerging Talent', 'color' => '#7DC76F'],
                    7 => ['title' => 'Lower Performer', 'color' => '#E66C6C'],
                    8 => ['title' => 'Valued Contributor', 'color' => '#F2B948'],
                    9 => ['title' => 'Trusted Professional', 'color' => '#F6E54B'],
                ];

                $bfrLevelPoints = [
                    1 => ['Low Prospect', 'High Performance'],
                    2 => ['High Prospect', 'Moderate Performance'],
                    3 => ['High Prospect', 'High Performance'],
                    4 => ['Moderate Prospect', 'Low Performance'],
                    5 => ['Moderate Prospect', 'Moderate Performance'],
                    6 => ['Moderate Prospect', 'High Performance'],
                    7 => ['Low Prospect', 'Low Performance'],
                    8 => ['Low Prospect', 'Moderate Performance'],
                    9 => ['Low Prospect', 'High Performance'],
                ];

                $bfrLevelCounts = [];
                foreach ($groupedEmployees as $bfrLevel => $employees) {
                    $bfrLevelCounts[$bfrLevel] = $employees->count();
                }

                $talentInsightTotal = [];
                foreach ($bfrLevelTitles as $bfrLevel => $details) {
                    $title = $details['title'];
                    $count = $bfrLevelCounts[$bfrLevel] ?? 0;
                    $talentInsightTotal[$title] = $count;
                }
            @endphp
            <div class="d-flex justify-content-between mb-14">
                <h2 class="top-heading m-0 psychometric-title">Talent Insights</h2>
                <div class="employee-wrap">
                    <div class="employee-search">
                        <input type="text" class="employee-searchTerm" placeholder="Search Employee" id="talentSearchInput">
                        <button type="button" class="employee-searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="filter-buttons d-flex align-items-center mb-14" data-tab="talent">
                <div class="dropdown">
                    <button class="filter-btn" type="button" id="9-GridFilter" data-bs-toggle="dropdown"
                        data-default-text="9-Grid Filter" aria-expanded="false">
                        <span>9-Grid Filter</span>
                        <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                    </button>
                    <div class="dropdown-menu mt-4" style="width: 202px;">
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="9-GridFilterFilter"
                                value="Next Gen Leader" data-target="9-GridFilter">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">Next Gen Leader</p> <span>1</span>
                            </label>
                        </div>
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="9-GridFilterFilter"
                                value="Rising Star" data-target="9-GridFilter">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">Rising Star</p> <span>6</span>
                            </label>
                        </div>
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="9-GridFilterFilter"
                                value="Emerging Talent" data-target="9-GridFilter">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">Emerging Talent</p> <span>9</span>
                            </label>
                        </div>
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="9-GridFilterFilter"
                                value="Solid Contributor" data-target="9-GridFilter">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">Solid Contributor</p> <span>9</span>
                            </label>
                        </div>
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="9-GridFilterFilter"
                                value="Emerging Performer" data-target="9-GridFilter">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">Emerging Performer</p> <span>9</span>
                            </label>
                        </div>
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="9-GridFilterFilter"
                                value="Trusted Professional" data-target="9-GridFilter">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">Trusted Professional</p> <span>9</span>
                            </label>
                        </div>
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="9-GridFilterFilter"
                                value="Inconsistent Performer" data-target="9-GridFilter">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">Inconsistent Performer</p> <span>9</span>
                            </label>
                        </div>
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="9-GridFilterFilter"
                                value="Valued Contributor" data-target="9-GridFilter">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">Valued Contributor</p> <span>9</span>
                            </label>
                        </div>
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="9-GridFilterFilter"
                                value="Lower Performer" data-target="9-GridFilter">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">Lower Performer</p> <span>9</span>
                            </label>
                        </div>
                        <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                            <button class="resetBtn border-0" data-target="9-GridFilter">Cancel</button>
                            <button class="filter border-0">Filter</button>
                        </div>
                    </div>
                </div>
                @php
                    $positionCounts = $employeeData->groupBy('position_name')->map->count()->sortKeys(); // <-- sorted alphabetically
                    $levelCounts = $employeeData->groupBy('level')->map->count()->sortKeys();
                @endphp

                <div class="dropdown">
                    <button class="filter-btn" type="button" id="JobPosition" data-bs-toggle="dropdown"
                        data-default-text="Job Position" aria-expanded="false">
                        <span>Job Position</span>
                        <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                    </button>
                    <div class="dropdown-menu mt-4" style="width: 210px; max-height: 300px; overflow-y: auto;">
                        @foreach($positionCounts as $position => $count)
                            <div class="d-flex gap-3 align-items-center custom-check-input">
                                <input class="interview-option" type="radio" name="JobPositionFilter"
                                    value="{{ $position }}" data-target="JobPosition">
                                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                    <p class="m-0">{{ $position }}</p> <span style="margin-left: 20px;">{{ $count }}</span>
                                </label>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                            <button class="resetBtn border-0" data-target="JobPosition">Cancel</button>
                            <button class="filter border-0">Filter</button>
                        </div>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="filter-btn" type="button" id="PositionLevel" data-bs-toggle="dropdown"
                        data-default-text="Position Level" aria-expanded="false">
                        <span>Position Level</span>
                        <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                    </button>
                    <div class="dropdown-menu mt-4" style="width: 210px; max-height: 300px; overflow-y: auto;">
                        @foreach($levelCounts as $level => $count)
                            <div class="d-flex gap-3 align-items-center custom-check-input">
                                <input class="interview-option" type="radio" name="PositionLevelFilter"
                                    value="{{ 'Level ' . $level }}" data-target="PositionLevel">
                                <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                    <p class="m-0">{{ 'Level ' . $level }}</p> <span>{{ $count }}</span>
                                </label>
                            </div>
                        @endforeach
                
                        <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                            <button class="resetBtn border-0" data-target="PositionLevel">Reset</button>
                            <button class="filter border-0">Filter</button>
                        </div>
                    </div>
                </div>
                
                <button class="filter-btn" type="button" style="max-width: 220px;" id="highPotentialFilter">
                    <span style="max-width: 220px;">High Potential Employees</span>
                    <div class="form-check form-switch d-flex justify-content-center p-0 align-items-center">
                        <input class="form-check-input position-relative m-0 p-0" type="checkbox" 
                               role="switch" id="highPotentialToggle">
                    </div>
                </button>
            </div>

            <div class="main-container">
                @php
                // Define the BFR level configurations
                $bfrLevelTitles = [
                    1 => ['title' => 'Emerging Performer', 'color' => '#F6E54B', 'class' => 'emerging-performer'],
                    2 => ['title' => 'Rising Star', 'color' => '#7DC76F', 'class' => 'rising-star'],
                    3 => ['title' => 'Next Gen Leader', 'color' => '#34792F', 'class' => 'next-gen-leader'],
                    4 => ['title' => 'Inconsistent Performer', 'color' => '#F2B948', 'class' => 'inconsistent-performer'],
                    5 => ['title' => 'Solid Contributor', 'color' => '#F6E54B', 'class' => 'solid-contributor'],
                    6 => ['title' => 'Emerging Talent', 'color' => '#7DC76F', 'class' => 'emerging-talent'],
                    7 => ['title' => 'Lower Performer', 'color' => '#E66C6C', 'class' => 'lower-performer'],
                    8 => ['title' => 'Valued Contributor', 'color' => '#F2B948', 'class' => 'valued-contributor'],
                    9 => ['title' => 'Trusted Professional', 'color' => '#F6E54B', 'class' => 'trusted-professional']
                ];
            
                $bfrLevelPoints = [
                    1 => ['Low Prospect', 'High Performance'],
                    2 => ['High Prospect', 'Moderate Performance'],
                    3 => ['High Prospect', 'High Performance'],
                    4 => ['Moderate Prospect', 'Low Performance'],
                    5 => ['Moderate Prospect', 'Moderate Performance'],
                    6 => ['Moderate Prospect', 'High Performance'],
                    7 => ['Low Prospect', 'Low Performance'],
                    8 => ['Low Prospect', 'Moderate Performance'],
                    9 => ['Low Prospect', 'High Performance'],
                ];
            
                // Group employees by BFR level
                $groupedEmployees = $employeeData->groupBy('bfr_level');
                
                // Count employees per level
                $bfrLevelCounts = [];
                foreach ($groupedEmployees as $bfrLevel => $employees) {
                    $bfrLevelCounts[$bfrLevel] = $employees->count();
                }
                @endphp
            
                @foreach($groupedEmployees as $bfrLevel => $employees)
                    @php
                        $levelInfo = $bfrLevelTitles[$bfrLevel] ?? ['title' => 'All Employees', 'color' => '#CCCCCC', 'class' => 'default-level'];
                        $points = $bfrLevelPoints[$bfrLevel] ?? [];
                        $employeeCount = $bfrLevelCounts[$bfrLevel] ?? 0;
                        
                        // Count high potential employees in this group
                        $highPotentialCount = $employees->where('is_high_potential', 1)->count();
                        
                        // Create tooltip content with the performance points
                        $tooltipContent = $levelInfo['title'] . "<br>" . implode("<br>", $points);
                    @endphp
            
                    <div class="main-box-div mb-12" data-bfr-level="{{ $bfrLevel }}" data-title="{{ $levelInfo['title'] }}" data-total-count="{{ $employeeCount }}" data-high-potential-count="{{ $highPotentialCount }}">
                        <div class="d-flex justify-content-between align-items-center mb-7">
                            <h5 class="top-sub-heading d-flex align-items-center gap-3">
                                <span class="heading-round {{ $levelInfo['class'] }}"></span>
                                {{ $levelInfo['title'] }}<span class="employee-count">{{$employeeCount}}</span>
                                <iconify-icon icon="material-symbols:info-outline" class="info" 
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true"
                                    data-bs-title="{{ $tooltipContent }}"></iconify-icon>
                            </h5>
                            <span class="view-detail-btn" data-id="{{ $bfrLevel }}">View Full Details</span>
                        </div>
                        
                        <div class="card-profile-box d-flex gap-5 flex-wrap">
                            @foreach($employees as $employee)
                                <div class="card-box" 
                                 data-id="{{ $employee->id }}"
                                    data-position-level="Level {{ $employee->level }}" 
                                    data-is-high-potential="{{ $employee->is_high_potential ? 'true' : 'false' }}"
                                    data-name="{{ strtolower($employee->name) }}"
                                    data-email="{{ strtolower($employee->email) }}"
                                    data-position="{{ strtolower($employee->position_name) }}">
                                    <div class="profile-img-container">
                                        <img class="profile-img rounded-circle" 
                                            src="{{ $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : asset('/images/default-user.svg') }}" 
                                            alt="{{ $employee->name }}">
                                    </div>
                                    <div class="profile-content">
                                        <p class="name mb-2">
                                            {{ $employee->name }}
                                            @if ($employee->is_high_potential == 1)
                                                <span class="green high-potential-badge">High Potential</span>
                                            @endif
                                        </p>
                                        <p class="designation">{{ $employee->position_name }}</p>
                                        <p class="email">{{ $employee->email }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://d3js.org/d3.v4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    window.bfrLevelData = @json($talentInsightTotal);

    document.getElementById("download-pdf").addEventListener("click", function (e) {
        const errorMsgDiv = document.getElementById("pdf-error-msg");
        const currentUrl = window.location.pathname;
        const departmentId = currentUrl.split('/').pop();

        const selectedLevels = Array.from(
            document.querySelectorAll('.psychometric-checkbox-input:checked')
        ).map(cb => cb.value.replace('Level ', ''));

        if (selectedLevels.length === 0) {
            e.preventDefault(); 
            errorMsgDiv.innerText = "Please select at least one level before downloading the PDF.";
            errorMsgDiv.style.display = "block";
            return;
        }

        errorMsgDiv.style.display = "none";

        const levelsParam = selectedLevels.join(',');

        window.location.href = `/admin/download-pdf/${departmentId}?levels=${levelsParam}`;
    });
</script>

{{-- Start Talent Insight Dropdown--}}

<script>

    window.employeeData = @json($employeeData);

    function updateAssessmentCompletionCounts() {
        const selectedLevelRadio = document.querySelector('input[name="PositionLevelIndividualFilter"]:checked');
        const selectedPositionRadio = document.querySelector('input[name="JobPositionIndividualFilter"]:checked');

        const selectedLevel = selectedLevelRadio ? selectedLevelRadio.value.replace('Level ', '').trim() : null;
        const selectedPosition = selectedPositionRadio ? selectedPositionRadio.value.trim().toLowerCase() : null;

        let filtered = window.employeeData;

        if (selectedLevel) {
            filtered = filtered.filter(user => String(user.level) === selectedLevel);
        }

        if (selectedPosition) {
            filtered = filtered.filter(user => user.position_name.toLowerCase() === selectedPosition);
        }

        const completed = filtered.filter(user =>
            user.is_personality_motivation_completed &&
            user.is_work_interest_completed &&
            user.is_cognitive_ability_completed
        ).length;

        const incomplete = filtered.length - completed;

        // Update the assessment dropdown counts in the UI
        const completedSpan = document.querySelector('input[name="AssessmentCompletionFilter"][value="All Assessments Completed"]')
            ?.closest('.custom-check-input')?.querySelector('span');
        const incompleteSpan = document.querySelector('input[name="AssessmentCompletionFilter"][value="Incomplete Assessments"]')
            ?.closest('.custom-check-input')?.querySelector('span');

        if (completedSpan) completedSpan.textContent = completed;
        if (incompleteSpan) incompleteSpan.textContent = incomplete;
    }

    function updateDependentDropdownsPsychometric() {
        const allEmployees = window.employeeData || [];

        // Get selected values
        const selectedLevelRadio = document.querySelector('input[name="PositionLevelIndividualFilter"]:checked');
        const selectedPositionRadio = document.querySelector('input[name="JobPositionIndividualFilter"]:checked');

        const selectedLevel = selectedLevelRadio ? selectedLevelRadio.value : null;
        const selectedPosition = selectedPositionRadio ? selectedPositionRadio.value.toLowerCase() : null;

        // Build count maps
        const positionLevelMap = {};
        const levelPositionMap = {};

        allEmployees.forEach(emp => {
            const level = String(emp.level);
            const position = emp.position_name.toLowerCase();

            if (!positionLevelMap[position]) positionLevelMap[position] = {};
            if (!positionLevelMap[position][level]) positionLevelMap[position][level] = 0;
            positionLevelMap[position][level]++;

            if (!levelPositionMap[level]) levelPositionMap[level] = {};
            if (!levelPositionMap[level][position]) levelPositionMap[level][position] = 0;
            levelPositionMap[level][position]++;
        });

        // Update Position Level counts
        document.querySelectorAll('input[name="PositionLevelIndividualFilter"]').forEach(radio => {
            const level = radio.value;
            const count = selectedPosition
                ? (levelPositionMap[level] && levelPositionMap[level][selectedPosition]) || 0
                : allEmployees.filter(emp => String(emp.level) === level).length;

            const label = radio.closest('.custom-check-input').querySelector('span');
            if (label) label.textContent = count;
        });

        // Update Job Position counts
        document.querySelectorAll('input[name="JobPositionIndividualFilter"]').forEach(radio => {
            const position = radio.value.toLowerCase();
            const count = selectedLevel
                ? (positionLevelMap[position] && positionLevelMap[position][selectedLevel]) || 0
                : allEmployees.filter(emp => emp.position_name.toLowerCase() === position).length;

            const label = radio.closest('.custom-check-input').querySelector('span');
            if (label) label.textContent = count;
        });
    }

    if (window.location.search) {
        const baseUrl = window.location.origin + window.location.pathname;
        window.location.replace(baseUrl);
    }

    function initializeFilters(tabContext) {
        const container = document.querySelector(`.filter-buttons[data-tab="${tabContext}"]`);
        
        if (!container) return;

        container.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.querySelectorAll('.custom-check-input').forEach(div => {
                div.addEventListener('click', function(e) {
                    e.stopPropagation(); 

                    let radio = this.querySelector('input[type="radio"]');
                    let targetButton = document.getElementById(radio.getAttribute("data-target"));

                    if (radio) {
                        radio.checked = true;
                        menu.querySelectorAll('.custom-check-input').forEach(item => item.classList.remove('active'));
                        this.classList.add('active');

                        if (targetButton) {
                            targetButton.querySelector("span").textContent = radio.value;
                            targetButton.classList.add("active-btn");
                        }

                        const filterButton = container.querySelector('.filter');
                        if (filterButton) {
                            filterButton.click();
                            updateAssessmentCompletionCounts();
                                updateDependentDropdownsPsychometric();  // ✅ Add this
                        }
                    }
                });

        });
    });

    container.querySelectorAll('.resetBtn').forEach(button => {
        button.addEventListener('click', function() {
            let menu = this.closest('.dropdown-menu');
            let targetButton = document.getElementById(this.getAttribute("data-target"));

            if (!menu || !targetButton) return;

            let radios = menu.querySelectorAll('input[type="radio"]');
            radios.forEach(radio => radio.checked = false);
            menu.querySelectorAll('.custom-check-input').forEach(item => item.classList.remove('active'));
            targetButton.querySelector("span").textContent = targetButton.getAttribute("data-default-text");
            targetButton.classList.remove("active-btn");
            updateAssessmentCompletionCounts();
            updateDependentDropdownsPsychometric();  // ✅ Add this

        });
    });
    }

    document.addEventListener('DOMContentLoaded', function() {
        initializeFilters('individual');
        initializeFilters('talent');
    });

    document.addEventListener('DOMContentLoaded', function () {
        let selectedGrid = null;
        let selectedJob = null;
        let selectedLevel = null;
        let highPotentialOnly = false;

        function filterTalentView() {
            const allGroups = document.querySelectorAll('.main-container .main-box-div');

            allGroups.forEach(group => {
                const groupTitle = group.getAttribute('data-title');
                const cards = group.querySelectorAll('.card-box');
                let visibleCount = 0;

                cards.forEach(card => {
                    const positionName = card.querySelector('.designation')?.textContent?.trim();
                    const cardLevel = card.getAttribute('data-position-level');
                    const isHighPotential = card.getAttribute('data-is-high-potential') === 'true';

                    const matchesGrid = !selectedGrid || groupTitle === selectedGrid;
                    const matchesJob = !selectedJob || positionName === selectedJob;
                    const matchesLevel = !selectedLevel || cardLevel === selectedLevel;
                    const matchesHighPotential = !highPotentialOnly || isHighPotential;

                    const showCard = matchesGrid && matchesJob && matchesLevel && matchesHighPotential;

                    card.style.display = showCard ? 'flex' : 'none';
                    if (showCard) visibleCount++;
                });

                group.style.display = visibleCount > 0 ? 'block' : 'none';

                const countElement = group.querySelector('.employee-count');
                if (countElement) countElement.textContent = visibleCount;
            });
        }

        const gridFilterBtns = document.querySelectorAll('[data-tab="talent"] .dropdown-menu .filter');
        gridFilterBtns.forEach(button => {
            button.addEventListener('click', function () {
                const container = button.closest('[data-tab="talent"]');
                const selectedRadio = container.querySelector('input[name="9-GridFilterFilter"]:checked');
                if (selectedRadio) {
                    selectedGrid = selectedRadio.value;
                    updateDropdown(selectedRadio, selectedGrid);
                }

                filterTalentView();
            });
        });

        const jobFilterBtns = document.querySelectorAll('[data-tab="talent"] .dropdown-menu .filter');
        jobFilterBtns.forEach(button => {
            button.addEventListener('click', function () {
                const container = button.closest('[data-tab="talent"]');
                const selectedRadio = container.querySelector('input[name="JobPositionFilter"]:checked');
                if (selectedRadio) {
                    selectedJob = selectedRadio.value;
                    updateDropdown(selectedRadio, selectedJob);
                }

                filterTalentView();
            });
        });

        const levelFilterBtns = document.querySelectorAll('[data-tab="talent"] .dropdown-menu .filter');
        levelFilterBtns.forEach(button => {
            button.addEventListener('click', function () {
                const container = button.closest('[data-tab="talent"]');
                const selectedRadio = container.querySelector('input[name="PositionLevelFilter"]:checked');
                if (selectedRadio) {
                    selectedLevel = selectedRadio.value;
                    updateDropdown(selectedRadio, selectedLevel);
                }

                filterTalentView();
            });
        });

        const searchInput = document.getElementById('talentSearchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const query = this.value.trim().toLowerCase();

                const allGroups = document.querySelectorAll('.main-container .main-box-div');

                allGroups.forEach(group => {
                    const cards = group.querySelectorAll('.card-box');
                    let visibleCount = 0;

                    cards.forEach(card => {
                        const name = card.getAttribute('data-name') || '';
                        const email = card.getAttribute('data-email') || '';
                        const position = card.getAttribute('data-position') || '';

                        const matches = name.includes(query) || email.includes(query) || position.includes(query);

                        card.style.display = matches ? 'flex' : 'none';
                        if (matches) visibleCount++;
                    });

                    group.style.display = visibleCount > 0 ? 'block' : 'none';

                    const countElement = group.querySelector('.employee-count');
                    if (countElement) countElement.textContent = visibleCount;
                });
            });
        }

        const resetBtns = document.querySelectorAll('[data-tab="talent"] .resetBtn');
        resetBtns.forEach(button => {
            button.addEventListener('click', function () {
                const target = button.getAttribute("data-target");

                if (target === "9-GridFilter") selectedGrid = null;
                if (target === "JobPosition") selectedJob = null;
                if (target === "PositionLevel") selectedLevel = null;

                filterTalentView();
            });
        });

        const highPotentialToggle = document.getElementById('highPotentialToggle');
        if (highPotentialToggle) {
            highPotentialToggle.addEventListener('change', function () {
                highPotentialOnly = this.checked;
                filterTalentView();
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const detailButtons = document.querySelectorAll('.view-detail-btn');

        detailButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const idLevel = this.getAttribute('data-id');
                if (idLevel) {
                    window.location.href = `/admin/talent/insight?data_id=${encodeURIComponent(idLevel)}`;
                } else {
                    alert('No BFR Level ID found.');
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.card-box').forEach(card => {
            card.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                if (id) {
                    window.location.href = `/admin/employee-details/${id}?page=overview`;
                }
            });
        });
    });

    function updateDependentDropdowns() {
        const container = document.querySelector('.filter-buttons[data-tab="individual"]');
        if (!container) return;

        // Get all employee rows from the table
        const allRows = Array.from(document.querySelectorAll('#resultTable tbody tr'));
        
        // Create maps to track relationships between positions and levels
        const positionLevelMap = {}; // { position: { level: count } }
        const levelPositionMap = {}; // { level: { position: count } }

        // Populate the maps with data from the table rows
        allRows.forEach(row => {
            const position = row.getAttribute('data-position') || '';
            const level = row.getAttribute('data-level') || '';
            
            if (!positionLevelMap[position]) positionLevelMap[position] = {};
            if (!positionLevelMap[position][level]) positionLevelMap[position][level] = 0;
            positionLevelMap[position][level]++;
            
            if (!levelPositionMap[level]) levelPositionMap[level] = {};
            if (!levelPositionMap[level][position]) levelPositionMap[level][position] = 0;
            levelPositionMap[level][position]++;
        });

        // Get current selections
        const selectedLevelRadio = container.querySelector('input[name="PositionLevelIndividualFilter"]:checked');
        const selectedPositionRadio = container.querySelector('input[name="JobPositionIndividualFilter"]:checked');
        
        const selectedLevel = selectedLevelRadio ? selectedLevelRadio.value.replace('Level ', '').trim() : null;
        const selectedPosition = selectedPositionRadio ? selectedPositionRadio.value.trim() : null;

        // Update position dropdown counts based on level selection
        container.querySelectorAll('input[name="JobPositionIndividualFilter"]').forEach(radio => {
            const position = radio.value.trim();
            let count = 0;
            
            if (selectedLevel) {
                // Count only rows that match both position and selected level
                count = positionLevelMap[position] && positionLevelMap[position][selectedLevel] 
                    ? positionLevelMap[position][selectedLevel] 
                    : 0;
            } else {
                // Count all rows with this position
                count = Object.values(positionLevelMap[position] || {}).reduce((sum, val) => sum + val, 0);
            }
            
            const countSpan = radio.closest('.custom-check-input').querySelector('span');
            if (countSpan) countSpan.textContent = count;
        });

        // Update level dropdown counts based on position selection
        container.querySelectorAll('input[name="PositionLevelIndividualFilter"]').forEach(radio => {
            const level = radio.value.replace('Level ', '').trim();
            let count = 0;
            
            if (selectedPosition) {
                // Count only rows that match both level and selected position
                count = levelPositionMap[level] && levelPositionMap[level][selectedPosition] 
                    ? levelPositionMap[level][selectedPosition] 
                    : 0;
            } else {
                // Count all rows with this level
                count = Object.values(levelPositionMap[level] || {}).reduce((sum, val) => sum + val, 0);
            }
            
            const countSpan = radio.closest('.custom-check-input').querySelector('span');
            if (countSpan) countSpan.textContent = count;
        });
    }

    $(document).ready(function() {
        const applyFilters = (page = 1) => {
            const filters = {
                job_position: $("input[name='JobPositionIndividualFilter']:checked").val(),
                position_level: $("input[name='PositionLevelIndividualFilter']:checked").val(),
                assessment_completion: $("input[name='AssessmentCompletionFilter']:checked").val(),
                search: $('#searchEmployeeInput').val().trim(),
                per_page: $('#per_page').val(),
                page: page,
                tab: 2
            };

            $('#resultTable tbody').html(`
                <tr>
                    <td colspan="7" class="text-center py-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="spinner-border text-primary me-2" role="status"></div>
                            <span>Loading results...</span>
                        </div>
                    </td>
                </tr>
            `);

            const departmentId = "{{ $id }}";
            $.ajax({
                url: `/admin/department/${departmentId}/filter-psychometric`,
                method: 'GET',
                data: filters,
                success: (response) => {
                    $('#resultTable tbody').html(response.tableHtml);
                    $('.pagination-wrappe').html(response.paginationHtml);

                    if (filters.search) {
                        highlightSearchTerms(filters.search);
                    }

                    updateUrlState(filters);  
                },
                error: (xhr, status, error) => {
                    console.error('Filter error:', error);
                    $('#resultTable tbody').html(`
                        <tr>
                            <td colspan="7" class="text-center text-danger py-3">
                                Error loading data. Please try again.
                            </td>
                        </tr>
                    `);
                }
            });
        };

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            const page = new URL($(this).attr('href')).searchParams.get('page');
            applyFilters(page);
        });


        function updateUrlState(filters) {
            const params = new URLSearchParams();

            Object.entries(filters).forEach(([key, value]) => {
                if (value) params.set(key, value);
            });

            history.replaceState(null, '', `?${params.toString()}`);
        }

        function initializeFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);

            ['job_position', 'position_level', 'assessment_completion'].forEach(param => {
                const value = urlParams.get(param);
                if (value) {
                    $(`input[name='${param}Filter'][value="${value}"]`).prop('checked', true);
                    $(`#${param}Individual span`).text(value);
                    $(`#${param}Individual`).addClass('active-btn');
                }
            });

            $('#searchEmployeeInput').val(urlParams.get('search') || '');
            $('#per_page').val(urlParams.get('per_page') || 10);  

            if (urlParams.toString()) {
                const page = urlParams.get('page') || 1;
                setTimeout(() => applyFilters(page), 100);
            }
        }

        initializeFromUrl();  

        $(document).on('change', '#per_page', function() {
            applyFilters(1); 
        });

        $(document).on('click', '.filter', function(e) {
            applyFilters(1);  
        });

        $('#tabPsychometric .employee-searchButton').click(function () {
            applyFilters(1);
        });

        $('#tabPsychometric #searchEmployeeInput').keypress(function(e) {
            if (e.which === 13) applyFilters(1);
        });

        $(document).on('click', '#tabPsychometric .resetBtn', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const target = $(this).data('target');
            const defaultText = $(`#${target}`).data('default-text');

            $(`input[name='${target}Filter']`).prop('checked', false);

            $(`#${target} span`).text(defaultText);

            $(`#${target}`).removeClass('active-btn');

            applyFilters(1);
        });

    });

    document.addEventListener('DOMContentLoaded', function() {
        const table = document.getElementById('resultTable');
        const headers = table.querySelectorAll('.sortable');
        
        headers.forEach(header => {
            header.addEventListener('click', () => {
                const column = header.dataset.sortColumn;
                const isAsc = header.classList.contains('asc');
                
                headers.forEach(h => {
                    h.classList.remove('asc', 'desc');
                    const arrowIcon = h.querySelector('p + iconify-icon.info');
                    if (arrowIcon) {
                        arrowIcon.setAttribute('icon', 'ri:arrow-down-s-line');
                    }
                });
                
                const direction = isAsc ? 'desc' : 'asc';
                header.classList.add(direction);
                
                const arrowIcon = header.querySelector('p + iconify-icon.info');
                if (arrowIcon) {
                    arrowIcon.setAttribute('icon', 
                        direction === 'asc' ? 'ri:arrow-up-s-line' : 'ri:arrow-down-s-line');
                }
                
                sortTable(column, direction);
            });
        });
            
        function sortTable(column, direction) {
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            rows.sort((a, b) => {
                const aValue = getCellValue(a, column);
                const bValue = getCellValue(b, column);
                
                if (column === 'employee') {
                    return direction === 'asc' 
                        ? aValue.localeCompare(bValue) 
                        : bValue.localeCompare(aValue);
                } else if (column === 'jmr_level') {
                    return direction === 'asc' 
                        ? new Date(aValue) - new Date(bValue) 
                        : new Date(bValue) - new Date(aValue);
                } else {
                    const order = { 'Yes': 1, 'No': 0, 'N/A': -1 };
                    return direction === 'asc' 
                        ? order[aValue] - order[bValue] 
                        : order[bValue] - order[aValue];
                }
            });
            
            rows.forEach(row => tbody.appendChild(row));
        }
        
        function getCellValue(row, column) {
            if (column === 'employee') {
                return row.querySelector('.employee-name').textContent.trim();
            } else if (column === 'jmr_level') {
                const dateText = row.querySelector('td:nth-child(7) .table-status').textContent.trim();
                return dateText === 'N/A' ? '1970-01-01' : dateText;
            } else {
                const colIndex = {
                    'omr_level': 3, 
                    'bfr_level': 4,   // Work Interest
                    'ta_level': 5,    // Cognitive Ability
                    'ssmr_level': 6   // Technical Assessment
                }[column];
                
                return row.querySelector(`td:nth-child(${colIndex}) .table-status`).textContent.trim();
            }
        }
    });
    
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            if (e.target.closest('[data-kt-menu-trigger="click"]')) {
                e.preventDefault();
                e.stopPropagation();
                
                const trigger = e.target.closest('[data-kt-menu-trigger="click"]');
                const dropdownMenu = trigger.nextElementSibling;
                
                document.querySelectorAll('.menu-sub-dropdown.show').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.classList.remove('show');
                    }
                });
                
                dropdownMenu.classList.toggle('show');
                
                if (dropdownMenu.classList.contains('show')) {
                    const menuRect = dropdownMenu.getBoundingClientRect();
                    const viewportHeight = window.innerHeight;
                    
                    if (menuRect.bottom > viewportHeight) {
                        dropdownMenu.style.top = 'auto';
                        dropdownMenu.style.bottom = '100%';
                        dropdownMenu.style.marginBottom = '5px';
                    } else {
                        dropdownMenu.style.top = 'calc(100% - 80px)';
                        dropdownMenu.style.bottom = 'auto';
                        dropdownMenu.style.marginBottom = '0';
                    }
                }
            }
            
            if (!e.target.closest('[data-kt-menu-trigger="click"]') && 
                !e.target.closest('.menu-sub-dropdown')) {
                document.querySelectorAll('.menu-sub-dropdown').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });
    });
</script>