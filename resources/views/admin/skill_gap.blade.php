@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    /* Main Dashboard Container */
    .dashboard {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-around;
        padding: 20px 50px 0px 50px;
        width: 100%;
        box-sizing: border-box;
    }

    /* Left Column Widgets */
    .dashboard-left {
        display: flex;
        flex-direction: column;
        gap: 22px;
        width: 40%;
        max-width: 500px;
        box-sizing: border-box;
        justify-content: center;
    }

    .dashboard-widget {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 20px;
        background: #FFFFFF;
        box-shadow: 0px 1px 4px rgba(12, 12, 13, 0.05);
        border-radius: 8px;
        text-align: left;
        padding-left: 50px;
        height: 170px;
    }

    .number {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 38.5px;
        line-height: 1.2;
        color: #071437;
    }

    .widget-label {
        font-family: 'Roboto', sans-serif;
        font-weight: 400;
        font-size: 14px;
        line-height: 24px;
        color: #4B5675;
    }

    /* Right Column Widgets with Circular Charts */
    .dashboard-right {
        display: flex;
        flex-wrap: wrap;
        gap: 22px;
        width: 60%;
        max-width: 760px;
        box-sizing: border-box;
        justify-content: flex-end;
    }

    .chart-body {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .chart-widget {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 30px;
        background: #FFFFFF;
        box-shadow: 0px 1px 4px rgba(12, 12, 13, 0.05);
        border-radius: 8px;
        width: calc(50% - 11px);
        text-align: center;
        box-sizing: border-box;
        position: relative;
    }

    .chart-label {
        font-family: 'Roboto', sans-serif;
        font-weight: 400;
        font-size: 14px;
        line-height: 20px;
        text-align: center;
        letter-spacing: 0.25px;
        color: #4B5675;
    }

    .chart-title {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 17.55px;
        line-height: 21px;
        color: #071437;
        margin-bottom:10px;
    }

    /* Tabs Container */
    .tabs-container {
        display: flex;
        flex-direction: row;
        border: 2px solid #F7941D;
        border-radius: 5px;
        overflow: hidden;
    }

    .tab-button {
        flex: 1;
        padding: 10px 20px;
        text-align: center;
        font-size: 12px;
        font-weight: bold;
        color: #F7941D;
        text-decoration: none;
        transition: background-color 0.3s ease;
        border: none;
        outline: none;
        background-color: #ffffff;
    }

    .tab-button:not(:last-child) {
        border-right: 2px solid #F7941D;
    }

    .tab-button:hover:not(.active) {
        background-color: #F7941D;
        color: #ffffff;
    }

    .tab-button.active {
        background-color: #F7941D;
        color: #fff;
    }

    /* Proficiency Gap Section */
    .proficiency-gap {
        padding: 20px;
        background: #FFFFFF;
        box-shadow: 0px 1px 4px rgba(12, 12, 13, 0.05);
        border-radius: 8px;
        width: 70%;
    }

    /* Header for Top Proficiency Gap */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    /* Container for custom dropdown */
    .dropdown-container {
        position: relative;
        display: inline-block;
        width: 80px;
        /* Adjust width as per your design */
    }

    /* Hide default dropdown arrow */
    .filter-dropdown {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border: 1px solid #E6E6E6;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        background-color: white;
        width: 100%;
        cursor: pointer;
    }

    /* Position the custom SVG arrow */
    .custom-arrow {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
        /* Ensures the SVG doesn't block the dropdown click */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Optional: Adjust dropdown hover and focus effects */
    .filter-dropdown:hover,
    .filter-dropdown:focus {
        border-color: #F7941D;
        /* Highlighted border color */
        outline: none;
    }

    /* Proficiency Item Styles */
    .proficiency-item {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .proficiency-details {
        display: flex;
        flex-direction: column;
    }

    .proficiency-label-container {
        display: flex;
        align-items: center;
        gap: 8px;
        /* Adds space between label and demand tag */
    }

    .proficiency-label {
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: #071437;
    }

    .demand-tag {
        font-size: 10px;
        padding: 2px 6px;
        border-radius: 4px;
        font-weight: bold;
        height: fit-content;
        text-align: center;
    }

    .bar-container {
        position: relative;
        background: #E6E6E6;
        height: 8px;
        border-radius: 5px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .bar-fill {
        background: #F7941D;
        height: 100%;
        border-radius: 5px;
        position: absolute;
        top: 0;
        left: 0;
    }

    .growth-value {
        font-weight: 500;
        position: absolute;
        top: -26px;
        right: 0;
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
        color: #99A1B7;
    }

    .skills-forecast-overview {
        background: #FFFFFF;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0px 1px 4px rgba(12, 12, 13, 0.05);
        font-family: 'Roboto', sans-serif;
        width: 30%;
    }

    .skills-forecast-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .dropdown-container {
        position: relative;
        display: inline-block;
        width: 100px;
        /* Adjust width for better alignment */
    }

    .filter-dropdown {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border: 1px solid #E6E6E6;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        background-color: white;
        color: #757575;
        width: 100%;
        cursor: pointer;
    }

    .custom-arrow {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .forecast-item {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #E6E6E6;
    }

    .forecast-details {
        display: flex;
        flex-direction: column;
    }

    .forecast-label {
        font-size: 14px;
        font-weight: 500px;
        color: #071437;
    }

    .growth-info {
        font-size: 12px;
        color: #4B5675;
        margin-top: 5px;
    }

    .high-demand {
        background: #FFE0DD;
        color: #AA2D22;
    }

    .in-demand {
        background: #FFF3E0;
        color: #975102;
    }

    .more-info {
        background: #FFFFFF;
        color: #4B5675;
        border: 1px solid #F1F1F4;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 14px;
        margin-top: 20px;
        cursor: pointer;
        width: 100%;
    }

    .more-info:hover {
        color: #D97706;
    }

    .skills-gap-overview, .skills-overview, .training-progress{
        background: #FFFFFF;
        /* White background */
        border-radius: 16px;
        /* Rounded corners */
        padding: 20px;
        /* Add padding for inner spacing */
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
        /* Subtle shadow */
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
        /* Standard font size */
    }

    .skills-gap-overview .chart-title {
        font-size: 16px;
        font-weight: bold;
        color: #333333;
        /* Consistent color with Skills Overview */
    }

    .skills-gap-overview table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .skills-gap-overview th {
        text-align: left;
        padding: 10px;
        color: #99A1B7;
        /* Header text color */
        font-weight: 600;
        background: #F9FAFB;
        /* Subtle background for table header */
    }

    .skills-gap-overview td {
        padding: 10px;
        color: #333333;
        /* Standard text color */
    }

    .skills-gap-overview .gap-level {
        font-size: 12px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 12px;
    }

    .skills-gap-overview .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: end;
        gap: 10px;
        color: rgba(153, 161, 183, 1);
    }

    .training-table {
        background: #FFFFFF;
        border-radius: 16px;
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
        padding: 0px 16px;
        margin-top: 15.95px;
        width: 100%;
    }

    .training-table thead tr th,
    .training-table tbody tr td {
        padding: 24px 16px;
    }

    .training-table thead tr th {
        color: #99A1B7;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        line-height: 16px;
    }

    .training-name {
        color: #4B5675;
        font-size: 13.975px;
        font-style: normal;
        font-weight: 500;
        line-height: 16.77px;
    }

    .training-status span {
        display: flex;
        width: 87px;
        height: 24px;
        justify-content: center;
        align-items: center;
        border-radius: 80px;
        padding: 4px 12px;
        text-align: center;
        font-size: 10px;
        font-style: normal;
        font-weight: 600;
        line-height: 14px;
    }

    .training-status .complete {
        background: #DDF5E2;
        color: #196329;
    }

    .training-status .in-progress {
        background: #FFF3E0;
        color: #975102;
    }

    .training-status .Pending {
        background: #F2EEFD;
        color: #6652A1;
    }

    .training-img div {
        display: flex;
        gap: 1.67px;
        align-items: center;
    }

    .training-img div span {
        color: #99A1B7;
        font-size: 13.975px;
        font-style: normal;
        font-weight: 500;
        line-height: 16.77px;
    }

    .training-img img {
        width: 44px;
        height: 100%;
    }

    .training-progress div {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .training-progress div div {
        border-radius: 100px;
        background: #F5872B;
        height: 10px;
    }

    .training-progress span {
        color: #4B5675;
        font-size: 12px;
        font-style: normal;
        font-weight: 500;
        line-height: 16px;
    }

    .training-table button {
        border-radius: 4px;
        border: 1px solid #99A1B7;
        background: #FFF;
        display: flex;
        padding: 8px 16px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        color: #78829D;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        line-height: 16px;
    }

    .skills-gap-overview .header, .skills-overview .header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .right-header{
        display: flex;
        flex-direction:row;  
        gap: 20px; 
        align-items: center;
    }

    
    .span-gap{
            width: 70%; 
            display: flex; 
            justify-content: space-between;
            align-items: center;
        }

    .span-dep{
        width: 100%; 
        display: flex; 
        flex-direction: row;
        align-items: start;
    }

    .skills-gap-overview .header .chart-title{
            font-size: 18px;
            font-weight: 500;
            color: #071437;
        }

    .skills-overview .header .chart-title{
            font-size: 18px;
            font-weight: 500;
            color: #071437;
            margin-bottom:20px;
        }    

    .demand-overview .header{
        display: flex; 
        flex-direction: row;
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 20px;
    }

    .projected-content{
        display:flex; 
        flex-direction:row;
    }

    .projected-chart{
        width:35%; 
        padding:20px; 
        align-items:center; 
        justify-content: center;
    }

    .projected-table{
        width:65%; 
        padding:10px;
    }

    .recommendation{
        width:100%; 
        display:flex; 
        justify-content:space-between;
    }

    .recommendation-1{
        width:35%; 
        margin-right:10px; 
        padding: 20px; 
        background: #FFFFFF; 
        border-radius: 16px; 
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
    }

    .recommendation-2{
        width:65%; 
        padding: 20px; 
        background: #FFFFFF; 
        border-radius: 16px; 
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);
    }

    .training-container{
            display:flex;
            flex-direction:row;
            gap:10px;
            width:100%;
        }
    .training-progress{
        width: 60%;
    }
    .suggested{
        width: 40%; 
    }



    /* Responsive Design for Smaller Screens */
    @media (max-width: 1024px) {
        .dashboard {
            flex-direction: column;
            padding: 10px;
        }

        .tabs-container {
            flex-direction: row;
        }

        .dashboard-left,
        .dashboard-right {
            width: 100%;
            margin: 0;
            max-width: none;
            margin-bottom: 10px;
        }

        .dashboard-left .dashboard-widget {
            width: 100%;
        }

        .dashboard-right .chart-widget {
            width: 100%;
            margin-bottom: 20px;
        }

        .tab-button {
            width: 100%;
            text-align: center;
        }

        .skills-gap-overview,
        .demand-overview {
            width: 100%;
            margin: 0;
        }

        .proficiency-gap .proficiency-item {
            flex-direction: column;
        }

        .proficiency-gap{
            width:100%;
            margin-bottom:20px;
        }

        .skills-forecast-overview{
            width:100%;
        }

        .header {
            flex-direction: column;
            align-items: flex-start;
        }

        .skills-overview,
        .demand-overview {
            padding: 10px;
        }

        .search-bar {
            width: 100%;
        }

        table {
            display: block;
            overflow-x: auto;
            width: 100%;
        }

        thead {
            display: table-header-group;
        }

        tbody tr {
            display: table-row;
        }

        th,
        td {
            white-space: nowrap;
        }
        .training-container{
            display:flex;
            flex-direction:row;
            gap:10px;
        }

        .training-progress{
            width: 60%;
        }
        .suggested{
            width: 40%; 
        }
    }

    @media (max-width: 768px) {
        .dashboard {
            padding: 10px 5px;
            display: flex;
            flex: wrap;
        }

        .skills-overview,
        .demand-overview {
            padding: 10px 5px;
        }

        .dashboard-left,
        .dashboard-right {
            padding: 10px 5px;
        }

        .proficiency-gap,
        .skills-gap-overview {
            margin-bottom: 20px;
        }

        .proficiency-gap .header,
        .skills-gap-overview .header {
            flex-direction: row;
        }
        .tab-button {
            font-size: 12px;
            padding: 8px;
        }

        .chart-widget {
            padding: 15px;
        }

        .chart-body .chart-label {
            font-size: 12px;
        }

        .skills-overview th,
        .demand-overview th {
            font-size: 12px;
        }

        .skills-overview td,
        .demand-overview td {
            font-size: 12px;
            padding: 5px;
        }

        .pagination {
            flex-direction: row;
            align-items: end;
        }

        .skills-forecast-overview,
        .proficiency-gap {
            width: 100%;
        }

        .training-progress{
        width: 100%;
        margin-bottom:20px;
        }

        .training-container{
            display:flex;
            flex-direction:column;
        }
        .suggested{
            width: 100%; 
        }
    }

    @media (max-width: 480px) {

        .dashboard-widget,
        .chart-widget {
            padding: 10px;
        }

        .chart-body .chart-label {
            font-size: 10px;
        }

        .skills-overview th,
        .skills-overview td,
        .demand-overview th,
        .demand-overview td {
            font-size: 10px;
            padding: 3px;
        }

        .search-bar {
            width: 100%;
            margin-bottom: 10px;
        }

        .more-info {
            font-size: 12px;
            padding: 5px 10px;
        }

        .tab-button {
            font-size: 10px;
            padding: 5px;
        }

        .chart-widget,
        .dashboard-left .dashboard-widget {
            height: auto;
        }

        .pagination {
            gap: 5px;
        }

        .skills-gap-overview .header, .skills-overview .header {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .skills-gap-overview .header .chart-title{
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 500;
            color: #071437;
        }

        .right-header{
            display:flex;
            flex-direction:column;
        }
        .right-header .tabs-container{
            width:100%;
            display:flex;
            flex-direction:row;
        }

        .individual, .department, .technical, .soft{
            font-size:14px;
        }

        .span-gap{
            display: flex; 
            flex-direction: column;
            align-items: flex-start;
        }

        .span-dep{
        width: 100%; 
        display: flex; 
        flex-direction:column;
        align-items: start;
    }
    .demand-overview .header{
        display: flex; 
        flex-direction: column;
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 20px;
    }

    .projected-content{
        display:flex; 
        flex-direction:column;
    }
    
    .projected-chart{
        width:100%; 
    }

    .projected-table{
        width:100%;
    }

    .recommendation{
        width:100%; 
        display:flex; 
        flex-direction: column;
        justify-content:space-between;
        gap:20px;
    }

    .recommendation-1{
        width:100%; 
        margin-right:0px; 
    }

    .recommendation-2{
        width:100%; 
    }

    .training-container{
        display:flex;
        flex-direction:column;
    }
    .training-progress{
        width: 100%;
        margin-bottom:20px;
    }
    .suggested{
        width: 100%; 
    }
    }
</style>
@endsection

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Dashboard
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Skills Gap</li>
            </ul>
        </div>
        <div class="tabs-container" style="flex-direction:row;">
            <a class="tab-button" href="/admin/dashboard">Demographic</a>
            <a class="tab-button" href="/admin/analytical/dashboard">Analytical</a>
            <a class="tab-button active" href="/admin/skill-gap/dashboard">Skills Gap</a>
        </div>
    </div>
</div>
<!--end::Toolbar-->

<!--begin::Dashboard Content-->
<div class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">
        <div class="dashboard">
            <!-- Left Column Widgets -->
            <div class="dashboard-left" style="margin-right:20px;">
                <div class="dashboard-widget">
                    <div class="number">{{ $data['currentEmployees'] }}</div>
                    <p class="widget-label"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 2a2 2 0 0 0-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2m0 7c2.67 0 8 1.33 8 4v3H4v-3c0-2.67 5.33-4 8-4m0 1.9c-2.97 0-6.1 1.46-6.1 2.1v1.1h12.2V17c0-.64-3.13-2.1-6.1-2.1" />
                        </svg>
                        Current Employees</p>
                </div>
                <div class="dashboard-widget">
                    <div class="number">{{ $data['skillsRepresented'] }}</div>
                    <p class="widget-label"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10h3V7L6.5 3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1-3 3l-6-6a6 6 0 0 1-8-8z" />
                        </svg>
                        Skills Represented</p>
                </div>
            </div>

            <!-- Right Column Widgets with Circular Charts -->
            <div class="dashboard-right">
                <div class="chart-widget">
                    <div id="skills-utilised-chart"></div>
                    <div class="chart-body">
                        <div class="chart-label" style="font-size:40px; font-weight:bold; margin-bottom:10px;">{{ $data['skillsUtilised']['percentage'] }}%</div>
                        <div class="chart-label">{{ $data['skillsUtilised']['utilised'] }}/{{ $data['skillsUtilised']['total'] }}</div>
                        <div class="chart-label">Skills Utilised</div>
                    </div>
                    <p class="chart-title">Skills Utilisation Overview</p>
                </div>
                <div class="chart-widget">
                    <div id="skills-proficiency-chart"></div>
                    <div class="chart-body">
                        <div class="chart-label" style="font-size:40px; font-weight:bold; margin-bottom:10px;">{{ $data['skillsProficient']['percentage'] }}%</div>
                        <div class="chart-label">{{ $data['skillsProficient']['proficient'] }}/{{ $data['skillsProficient']['total'] }}</div>
                        <div class="chart-label">Proficient</div>
                    </div>
                    <p class="chart-title">Skills Proficiency Overview</p>
                </div>
            </div>
        </div>

        <div class="dashboard" style="width:100%;">
            <div class="proficiency-gap" style="margin-right:20px;">
                <div class="header" style="display: flex; flex-direction:row; justify-content: space-between; align-items: center;">
                    <h3 class="chart-title">Top Proficiency Gap</h3>
                    <div class="dropdown-container">
                        <select class="filter-dropdown">
                            <option value="top5">Top 5</option>
                            <option value="all">All</option>
                        </select>
                        <div class="custom-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M3.75 7a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 0 1.5h-15A.75.75 0 0 1 3.75 7m2.5 5a.75.75 0 0 1 .75-.75h10a.75.75 0 0 1 0 1.5H7a.75.75 0 0 1-.75-.75m3 5a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="proficiency-item">
                    <div class="proficiency-details">
                        <div class="proficiency-label-container">
                            <span class="proficiency-label">Airside Driving</span>
                            <span class="demand-tag" style="font-size: 12px; font-weight:600; padding: 4px 12px; border-radius: 12px; background:#FFE0DD; color:#AA2D22;">High</span>
                        </div>
                        <div class="bar-container">
                            <span class="growth-value">15/35</span>
                            <div class="bar-fill" style="width: 43%;"></div>
                        </div>
                    </div>
                </div>
                <div class="proficiency-item">
                    <div class="proficiency-details">
                        <div class="proficiency-label-container">
                            <span class="proficiency-label">Ground Support Operations</span>
                            <span class="demand-tag" style="font-size: 12px; font-weight:600; padding: 4px 12px; border-radius: 12px; background:#FFE0DD; color:#AA2D22;">Critical</span>
                        </div>
                        <div class="bar-container">
                            <span class="growth-value">5/17</span>
                            <div class="bar-fill" style="width: 29%;"></div>
                        </div>
                    </div>
                </div>
                <div class="proficiency-item">
                    <div class="proficiency-details">
                        <div class="proficiency-label-container">
                            <span class="proficiency-label">Innovation Management</span>
                            <span class="demand-tag" style="font-size: 12px; font-weight:600; padding: 4px 12px; border-radius: 12px; background:#FFF3E0; color:#975102;">Medium</span>
                        </div>
                        <div class="bar-container">
                            <span class="growth-value">8/20</span>
                            <div class="bar-fill" style="width: 40%;"></div>
                        </div>
                    </div>
                </div>
                <div class="proficiency-item">
                    <div class="proficiency-details">
                        <div class="proficiency-label-container">
                            <span class="proficiency-label">Stakeholder Management</span>
                            <span class="demand-tag" style="font-size: 12px; font-weight:600; padding: 4px 12px; border-radius: 12px; background:#FFE0DD; color:#AA2D22;">High</span>
                        </div>
                        <div class="bar-container">
                            <span class="growth-value">25/33</span>
                            <div class="bar-fill" style="width: 76%;"></div>
                        </div>
                    </div>
                </div>
                <div class="proficiency-item">
                    <div class="proficiency-details">
                        <div class="proficiency-label-container">
                            <span class="proficiency-label">Technology Application</span>
                            <span class="demand-tag" style="font-size: 12px; font-weight:600; padding: 4px 12px; border-radius: 12px; background:#DDF5E2; color:#196329;">Low</span>
                        </div>
                        <div class="bar-container">
                            <span class="growth-value">12/18</span>
                            <div class="bar-fill" style="width: 67%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills Forecast Overview Section -->
            <div class="skills-forecast-overview">
                <div class="skills-forecast-header" style="display:flex; flex-direction:row;">
                    <h3 class="chart-title">Skills Forecast Overview</h3>
                    <div class="dropdown-container">
                        <select class="filter-dropdown">
                            <option value="2024">In 2024</option>
                        </select>
                        <div class="custom-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M3.75 7a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 0 1.5h-15A.75.75 0 0 1 3.75 7m2.5 5a.75.75 0 0 1 .75-.75h10a.75.75 0 0 1 0 1.5H7a.75.75 0 0 1-.75-.75m3 5a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="forecast-item" style="border-bottom: 2px solid rgba(242, 65, 48, 1); background-color: rgba(254, 233, 231, 0.3); padding: 20px; margin-bottom: 10px;">
                    <div class="forecast-details">
                        <h6 class="forecast-label">Human Factors Management</h6>
                        <span class="growth-info">+50% growth</span>
                    </div>
                    <span class="demand-tag high-demand" style="font-size: 12px; font-weight:600; padding: 4px 12px; border-radius: 12px; ">High Demand</span>
                </div>
                <div class="forecast-item" style="border-bottom: 2px solid rgba(242, 65, 48, 1); background-color: rgba(254, 233, 231, 0.3); padding:20px; margin-bottom: 10px;">
                    <div class="forecast-details">
                        <h6 class="forecast-label">Innovation Management</h6>
                        <span class="growth-info">+73% growth</span>
                    </div>
                    <span class="demand-tag high-demand" style="font-size: 12px; font-weight:600; padding: 4px 12px; border-radius: 12px;">High Demand</span>
                </div>
                <div class="forecast-item" style="border-bottom: 2px solid rgba(245, 135, 43, 1); background-color: rgba(255, 251, 235, 0.3); padding:20px; margin-bottom: 10px;">
                    <div class="forecast-details">
                        <h6 class="forecast-label">Process Improvement and Optimisation</h6>
                        <span class="growth-info">+34% growth</span>
                    </div>
                    <span class="demand-tag in-demand" style="font-size: 12px; font-weight:600; padding: 4px 12px; border-radius: 12px;">In Demand</span>
                </div>
                <div class="forecast-item" style="border-bottom: 2px solid rgba(245, 135, 43, 1); background-color: rgba(255, 251, 235, 0.3); padding:20px; margin-bottom: 10px;">
                    <div class="forecast-details">
                        <h6 class="forecast-label">Manpower Planning</h6>
                        <span class="growth-info">+25% growth</span>
                    </div>
                    <span class="demand-tag in-demand" style="font-size: 12px; font-weight:600; padding: 4px 12px; border-radius: 12px;">In Demand</span>
                </div>
            </div>
        </div>

        <div class="dashboard" style="width:100%; display:flex; flex-direction:column;">
            <div class="skills-gap-overview" style="width:100%;">
                <div class="header">
                    <h3 class="chart-title">Skills Gap Overview</h3>
                    <div class="right-header">
                        <div class="search-bar" style="position: relative; width: 250px;">
                            <i class="fas fa-search" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); color: #ccc;"></i>
                            <input
                                type="text"
                                placeholder="Search individual"
                                style="width: 100%; padding: 10px; padding-left: 40px; border-radius: 5px; border: 1px solid #ccc;"
                                onkeyup="filterGapRecords()" />
                        </div>
                        <div class="tabs-container" style="display: flex;  flex-direction:row; ">
                            <button class="tab-button individual active" onclick="switchGapTab('individual')">
                                Individual
                            </button>
                            <button class="tab-button department" onclick="switchGapTab('department')">
                                Department
                            </button>
                        </div>
                    </div>
                </div>
                <table>
                    <tbody id="progress-container">
                        <!-- Dynamically populated rows -->
                    </tbody>
                </table>
                <div class="pagination">
                    <span id="gap-record-count" style="align-self: center; font-size: 12px; "></span>
                    <button onclick="goToGapFirstPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 20 20">
                            <path fill="currentColor" d="M8.397 2.21A.726.726 0 0 1 9.41 2.2a.69.69 0 0 1 .012.99l-6.7 6.707l7.07 6.908a.69.69 0 0 1 0 .99a.727.727 0 0 1-1.012 0L1.21 10.4a.69.69 0 0 1-.005-.985Zm9 0a.726.726 0 0 1 1.012-.01a.69.69 0 0 1 .012.99l-6.7 6.707l7.07 6.908a.69.69 0 0 1 0 .99a.727.727 0 0 1-1.012 0L10.21 10.4a.69.69 0 0 1-.005-.985Z" />
                        </svg>
                    </button>
                    <button onclick="previousGapPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 7l-5 5m0 0l5 5" />
                        </svg>
                    </button>
                    <button onclick="nextGapPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 17l5-5m0 0l-5-5" />
                        </svg>
                    </button>
                    <button onclick="goToGapLastPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 20 20">
                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>


        <div class="dashboard" style="width:100%; display:flex; flex-direction:column;">
            <div class="skills-overview" style="width:100%;">
                <div class="header">
                    <h3 class="chart-title">Skills Overview</h3>
                    <div class="right-header">
                        <div id="skills-tabs-container" class="tabs-container">
                            <button class="tab-button technical  active" onclick="switchSkillType('technical')">Technical Skills</button>
                            <button class="tab-button soft" onclick="switchSkillType('soft')">Soft Skills</button>
                        </div>
                        <div id="skills-search-bar" class="search-bar" style="position: relative; width: 250px;">
                            <i class="fas fa-search" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); color: #ccc;"></i>
                            <input
                                oninput="filterSkills()"
                                type="text"
                                placeholder="Search Technical Skill"
                                style="width: 100%; padding: 10px; padding-left: 40px; border-radius: 5px; border: 1px solid #ccc;">
                        </div>
                    </div>
                </div>
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead style="width: 100%;">
                        <tr>
                            <th style="text-align: left; padding: 10px; color: #99A1B7;">Skill <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                </svg></th>
                            <th style="text-align: left; padding: 10px; color: #99A1B7;">Employees <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                </svg></th>
                            <th style="text-align: left; padding: 10px; color: #99A1B7;">Proficiency Distribution <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                </svg></th>
                            <th style="text-align: left; padding: 10px; color: #99A1B7;">Utilization Rate <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                </svg></th>
                            <th style="text-align: left; padding: 10px; color: #99A1B7;">Skills Gap <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                </svg></th>
                            <th style="text-align: left; padding: 10px; color: #99A1B7;">Projected Demand <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                </svg></th>
                            <th style="text-align: left; padding: 10px; color: #99A1B7;">Avg. Performance Rating <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                </svg></th>
                        </tr>
                    </thead>
                    <tbody style="width: 100%;">
                        <!-- Dynamic data will be inserted here by JavaScript -->
                    </tbody>
                </table>
                <div class="pagination" style="margin-top: 20px; display: flex; justify-content: end; gap: 10px; color:rgba(153, 161, 183, 1);">
                    <span id="record-count" style="align-self: center; font-size: 12px; "></span>
                    <button onclick="goToFirstPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 20 20">
                            <path fill="currentColor" d="M8.397 2.21A.726.726 0 0 1 9.41 2.2a.69.69 0 0 1 .012.99l-6.7 6.707l7.07 6.908a.69.69 0 0 1 0 .99a.727.727 0 0 1-1.012 0L1.21 10.4a.69.69 0 0 1-.005-.985Zm9 0a.726.726 0 0 1 1.012-.01a.69.69 0 0 1 .012.99l-6.7 6.707l7.07 6.908a.69.69 0 0 1 0 .99a.727.727 0 0 1-1.012 0L10.21 10.4a.69.69 0 0 1-.005-.985Z" />
                        </svg>
                    </button>
                    <button onclick="skillsPreviousPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 7l-5 5m0 0l5 5" />
                        </svg>
                    </button>
                    <button onclick="skillsNextPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 17l5-5m0 0l-5-5" />
                        </svg>
                    </button>
                    <button onclick="goToLastPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 20 20">
                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="dashboard" style="width:100%;">
            <div class="demand-overview" style="width:100%; padding: 20px; background: #FFFFFF; border-radius: 16px; box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03);">
                <div class="header">
                    <h3 class="chart-title">Projected Skill Demand Over Time</h3>
                    <div>
                        <div id="demand-search-bar" class="search-bar" style="position: relative; width: 250px;">
                            <i class="fas fa-search" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); color: #ccc;"></i>
                            <input
                                oninput="filterSkillDemand()"
                                type="text"
                                placeholder="Search Skill"
                                style="width: 100%; padding: 10px; padding-left: 40px; border-radius: 5px; border: 1px solid #ccc;">
                        </div>
                    </div>
                </div>
                <div class="projected-content">
                    <div class="projected-chart">
                        <div id="projected-skill-demand-chart"></div>
                        <div style="display:flex; justify-content:end;">
                            <div class="dropdown-container">
                                <select class="filter-dropdown">
                                    <option>5 years</option>
                                </select>
                                <div class="custom-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M3.75 7a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 0 1.5h-15A.75.75 0 0 1 3.75 7m2.5 5a.75.75 0 0 1 .75-.75h10a.75.75 0 0 1 0 1.5H7a.75.75 0 0 1-.75-.75m3 5a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="projected-table">
                        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                            <thead style="width: 100%;">
                                <tr>
                                    <th style="text-align: left; padding: 10px; color: #99A1B7;">Skill <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                        </svg></th>
                                    <th style="text-align: left; padding: 10px; color: #99A1B7;">Current Demand <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                        </svg></th>
                                    <th style="text-align: left; padding: 10px; color: #99A1B7;">Projected Demand<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                        </svg></th>
                                    <th style="text-align: left; padding: 10px; color: #99A1B7;">Growth Rate <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                        </svg></th>
                                    <th style="text-align: left; padding: 10px; color: #99A1B7;">Current Skill Availability <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                        </svg></th>
                                    <th style="text-align: left; padding: 10px; color: #99A1B7;">Skill Gap Forecast <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                        </svg></th>
                                    <th style="text-align: left; padding: 10px; color: #99A1B7;">Urgency <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd" d="m6 7l6 6l6-6l2 2l-8 8l-8-8z" />
                                        </svg></th>
                                </tr>
                            </thead>
                            <tbody style="width: 100%;">
                                <!-- Dynamic data will be inserted here by JavaScript -->
                            </tbody>
                        </table>
                        <div class="pagination" style="margin-top: 20px; display: flex; justify-content: end; gap: 10px; color:rgba(153, 161, 183, 1);">
                            <span id="demand-record-count" style="align-self: center; font-size: 12px; "></span>
                            <button onclick="goToDemandFirstPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 20 20">
                                    <path fill="currentColor" d="M8.397 2.21A.726.726 0 0 1 9.41 2.2a.69.69 0 0 1 .012.99l-6.7 6.707l7.07 6.908a.69.69 0 0 1 0 .99a.727.727 0 0 1-1.012 0L1.21 10.4a.69.69 0 0 1-.005-.985Zm9 0a.726.726 0 0 1 1.012-.01a.69.69 0 0 1 .012.99l-6.7 6.707l7.07 6.908a.69.69 0 0 1 0 .99a.727.727 0 0 1-1.012 0L10.21 10.4a.69.69 0 0 1-.005-.985Z" />
                                </svg>
                            </button>
                            <button onclick="demandPreviousPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 7l-5 5m0 0l5 5" />
                                </svg>
                            </button>
                            <button onclick="demandNextPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 17l5-5m0 0l-5-5" />
                                </svg>
                            </button>
                            <button onclick="goToDemandLastPage()" style="cursor: pointer; padding: 10px; background: none; border: none; color:rgba(153, 161, 183, 1);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 20 20">
                                    <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard" style="margin-top: 20px;">
            <div class="recommendation">
                <!-- Recommendation Section -->
                <div class="recommendation-1">
                    <h3 class="chart-title">
                        ✨ Recommendation
                    </h3>
                    <p style="font-size: 14px; color: #4B5675; line-height: 1.6; text-align:justify;">
                        Based on the current analysis, there are skills gap in Airside Driving, Ground Support Operations,
                        Innovation Management, Stakeholder Management, and Technology Application within the Air Transport sector.
                        To close these gaps, the following tailored action plan is suggested to upskill your workforce effectively.
                        Implementing these actions will improve operational efficiency, drive innovation, and enhance collaboration
                        across key areas.
                    </p>
                </div>

                <!-- Recommended Action Items Section -->
                <div class="recommendation-2">
                    <h3 class="chart-title">
                        ✨ Recommended Action Items
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="width:70%; font-size: 14px; color: #4B5675; margin-right:20px; text-align:justify;">
                                Conduct certified Airside Driving and Ground Support Operations training programs for relevant staff
                            </span>

                            <span style="text-align:center; width:30%; font-size: 12px; font-weight:600; color:#196329; background: #DDF5E2; padding: 4px 12px; border-radius: 12px;">
                                Completed
                            </span>
                        </li>
                        <hr style="color:#F1F1F4; border:1px solid #F1F1F4">
                        <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="width:70%; font-size: 14px; color: #4B5675; margin-right:20px; text-align:justify;">
                                Organize workshops and create cross-functional teams to encourage innovation management and integrate
                                new technologies
                            </span>
                            <span style="text-align:center; width:30%;font-size: 12px; font-weight:600; color: #975102; background: #FFF3E0; padding: 4px 12px; border-radius: 12px;">
                                In Progress
                            </span>
                        </li>
                        <hr style="color:#F1F1F4; border:1px solid #F1F1F4">
                        <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="width:70%; font-size: 14px; color: #4B5675; margin-right:20px; text-align:justify;">
                                Develop stakeholder management training focusing on communication, negotiation, and relationship-building
                                skills
                            </span>
                            <span style="text-align:center; width:30%; font-size: 12px; font-weight:600; color: #6652A1; background: #F2EEFD; padding: 4px 12px; border-radius: 12px;">
                                Pending
                            </span>
                        </li>
                        <hr style="color:#F1F1F4; border:1px solid #F1F1F4">
                        <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="width:70%; font-size: 14px; color: #4B5675; margin-right:20px; text-align:justify;">
                                Implement technology application courses to introduce and train employees on emerging digital solutions
                                in aviation operations
                            </span>
                            <span style="text-align:center; width:30%; font-size: 12px; font-weight:600; color: #6652A1; background: #F2EEFD; padding: 4px 12px; border-radius: 12px;">
                                Pending
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="dashboard" style="margin-top: 20px;">
            <!-- Training Progress and Suggested Training Section -->
            <div class="training-container">
                <!-- Training Progress Section -->
                <div class="training-progress">
                    <h3 class="chart-title">Training Progress</h3>
                    <table class="training-table">
                        <thead>
                            <tr>
                                <th>Training name</th>
                                <th>Status</th>
                                <th>Enrolled</th>
                                <th>Progress</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="training-name">Airport Audit and Compliance</td>
                                <td class="training-status">
                                    <span class="complete">Completed</span>
                                </td>
                                <td class="training-img">
                                    <div>
                                        <img src="/images/people_head.png" alt="user">
                                        <span>214</span>
                                    </div>
                                </td>
                                <td class="training-progress">
                                    <div>
                                        <div style="width: 100%;">
                                            <div></div>
                                        </div>
                                        <span>100%</span>
                                    </div>
                                </td>
                                <td>
                                    <button>View</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="training-name">Aircraft Cruise Operations</td>
                                <td class="training-status">
                                    <span class="in-progress">In Progress</span>
                                </td>
                                <td class="training-img">
                                    <div>
                                        <img src="/images/people_head.png" alt="user">
                                        <span>171</span>
                                    </div>
                                </td>
                                <td class="training-progress">
                                    <div>
                                        <div style="width: 80%;">
                                            <div></div>
                                        </div>
                                        <span>80%</span>
                                    </div>
                                </td>

                                <td>
                                    <button>View</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="training-name">Aircraft Dispatch</td>
                                <td class="training-status">
                                    <span class="in-progress">In Progress</span>
                                </td>
                                <td class="training-img">
                                    <div>
                                        <img src="/images/people_head.png" alt="user">
                                        <span>128</span>
                                    </div>
                                </td>
                                <td class="training-progress">
                                    <div>
                                        <div style="width: 100%;">
                                            <div></div>
                                        </div>
                                        <span>60%</span>
                                    </div>
                                </td>
                                <td>
                                    <button>View</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="training-name">Aircraft Emergency Management</td>
                                <td class="training-status">
                                    <span class="Pending">Pending</span>
                                </td>
                                <td class="training-img">
                                    <div>
                                        <img src="/images/people_head.png" alt="user">
                                        <span>0</span>
                                    </div>
                                </td>
                                <td class="training-progress">
                                    <div>
                                        <div style="width: 100%;">
                                            <div></div>
                                        </div>
                                        <span>0%</span>
                                    </div>
                                </td>
                                <td>
                                    <button>View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <div class="training-left">
                            <div class="training-left-inner">
                                <div class="training-name head-content">Training name</div>
                                <div class="training-Status head-content">Status</div>
                                <div class="training-Enrolled head-content">Enrolled</div>
                                <div class="training-Progress head-content">Progress</div>
                                <div class="training-action head-content">Action</div>
                            <div>
                        </div> -->
                </div>



                <!-- Suggested Training Section -->
                <div class-="suggested" style="background: #FFFFFF; border-radius: 16px; padding: 20px; box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.03); font-family: 'Roboto', sans-serif; font-size: 14px;">
                    <h3 class="chart-title">Suggested Training</h3>
                    <div style="text-align: center;">
                        <img src="/images/people_hand.png" alt="Training Image"
                            style="width: 100%; height:250px; border-radius: 12px; margin-bottom: 16px;">
                        <h4
                            style="margin-left:5px; text-align: left; font-size: 16px; font-weight: bold; color: #333333;">
                            Ground Support Operations Certification</h4>
                        <div style="display:flex; flex-direction: row; margin-top:8px;">
                            <p style="text-align: left; font-size: 12px; color: #666666; margin: 0 0 8px 5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    viewBox="0 0 24 24">
                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                        <path d="M11.795 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4" />
                                        <path d="M14 18a4 4 0 1 0 8 0a4 4 0 1 0-8 0m1-15v4M7 3v4m-4 4h16" />
                                        <path d="M18 16.496V18l1 1" />
                                    </g>
                                </svg>
                                1-4 weeks
                            </p>
                            <p style="text-align: left; font-size: 12px; color: #666666; margin: 0 0 8px 5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M3 12h4v9H3zm14-4h4v13h-4zm-7-6h4v19h-4z" />
                                </svg>
                                Beginner
                            </p>
                        </div>
                        <div
                            style=" margin-left:5px;display: flex; justify-content: flex-start; gap: 8px; flex-wrap: wrap; margin-bottom: 16px;">
                            <span  style="text-align:center; font-size: 12px; font-weight:600; color: #975102; background: #FFF3E0; padding: 4px 12px; border-radius: 12px;">Problem Solving</span>
                            <span  style="text-align:center; font-size: 12px; font-weight:600; color: #975102; background: #FFF3E0; padding: 4px 12px; border-radius: 12px;">Leadership & Team Management</span>
                            <span  style="text-align:center; font-size: 12px; font-weight:600; color: #975102; background: #FFF3E0; padding: 4px 12px; border-radius: 12px;">Workflow Optimization</span>
                        </div>
                        <button class="more-info">More Info
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="m9.005 4l8 8l-8 8L7 18l6.005-6L7 6z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Dashboard Content-->
        @endsection

        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Skills Utilisation Chart
                var skillsUtilisedOptions = {
                    chart: {
                        height: 250,
                        type: 'donut',
                    },
                    series: [{{$data['skillsUtilised']['percentage']}}, {{100 - $data['skillsUtilised']['percentage']}}],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: false,
                                    total: {
                                        show: false,
                                        label: 'Skills Utilised',
                                        formatter: function(w) {
                                            return w.globals.series[0] + '%';
                                        },
                                        style: {
                                            fontSize: '28px',
                                            fontWeight: 'bold',
                                            color: '#071437',
                                            fontFamily: 'Inter, sans-serif',
                                        },
                                    },
                                },
                            },
                        },
                    },
                    colors: ['#F7941D', '#E6E6E6'],
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    tooltip: {
                        enabled: false
                    },
                };

                var skillsUtilisedChart = new ApexCharts(document.querySelector("#skills-utilised-chart"), skillsUtilisedOptions);
                skillsUtilisedChart.render();

                // Skills Proficiency Chart
                var skillsProficiencyOptions = {
                    chart: {
                        height: 250,
                        type: 'donut',
                    },
                    series: [{{$data['skillsProficient']['percentage']}}, {{100 - $data['skillsProficient']['percentage']}}],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: false,
                                    total: {
                                        show: false,
                                        label: 'Proficient',
                                        formatter: function(w) {
                                            return w.globals.series[0] + '%';
                                        },
                                        style: {
                                            fontSize: '28px',
                                            fontWeight: 'bold',
                                            color: '#071437',
                                            fontFamily: 'Inter, sans-serif',
                                        },
                                    },
                                },
                            },
                        },
                    },
                    colors: ['#FABB6E', '#E6E6E6'],
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    tooltip: {
                        enabled: false
                    },
                };

                var skillsProficiencyChart = new ApexCharts(document.querySelector("#skills-proficiency-chart"), skillsProficiencyOptions);
                skillsProficiencyChart.render();

                var chartTitle = skillDemandData[0]?.skill

                // Projected Skill Demand Chart
                var projectedSkillDemandOptions = {
                    chart: {
                        height: 250,
                        width: '100%',
                        toolbar: {
                            show: false, // Hide zoom, home, and burger icons
                        },
                    },
                    title: {
                        text: chartTitle, // Set the title dynamically
                        align: 'center',
                        margin: 10,
                        style: {
                            // fontSize: '16px',
                            fontWeight: 'bold',
                            color: '#333',
                            width:'100%',
                        },
                    },
                    series: [{
                            name: 'Current',
                            type: 'line', // Specify type for this series
                            data: [150, 150, 150, 150, 150], // Same value for all categories
                        },
                        {
                            name: 'Projected',
                            type: 'bar', // Specify type for this series
                            data: [120, 150, 180, 250, 200], // Example data
                        },
                    ],
                    xaxis: {
                        categories: ['2020', '2021', '2022', '2023', '2024'], // Example categories
                    },
                    yaxis: {
                        labels: {
                            show: false, // Hide the vertical axis labels
                        },
                    },
                    legend: {
                        position: 'bottom', // Place the legend at the bottom
                        offsetY: 0, // Add space below the chart
                    },
                    grid: {
                        padding: {
                            left: 0,
                            right: 0,
                        },
                    },
                    stroke: {
                        width: [2, 0], // Make the line for "Current" more pronounced
                        curve: 'straight', // Ensure the line is straight across
                    },
                    colors: ['#F7941D', '#071437'],
                    dataLabels: {
                        enabled: false
                    },
                    dropdown: {
                        enabled: true, // Add dropdown filter manually
                    },
                };

                // Render the chart
                var projectedSkillDemandChart = new ApexCharts(document.querySelector("#projected-skill-demand-chart"), projectedSkillDemandOptions);
                projectedSkillDemandChart.render();
            });

            // Tab and Pagination Functionality for Skills Gap Overview
            let currentGapTab = 'individual';
            let currentGapPage = 1;
            const recordsGapPerPage = 5;

            const gapIndividuals = [
                'Eylia Fariza Binti Hamzah',
                'Firdaus Daud',
                'Lyana Faridah Zulkifli',
                'Kok Weng Wong',
                'Pavithra Surendaram',
                'Ahmad Hafizi',
                'Nurul Ain Zahira',
                'Syed Imran',
                'Tan Mei Ling',
                'Ravi Kumar',
                'Liyana Hanim',
                'Azman Farhan',
                'Norliza Binti Hamid',
                'Goh Siew Mei',
                'Siti Zulaikha',
                'Amirul Hakim',
                'Rina Leong',
                'Mohd Faisal',
                'Chen Wei Ting',
                'Rajesh Nair'
            ];

            const gapDepartments = [
                'Flight Operations Department',
                'Aircraft Maintenance Department',
                'Air Traffic Management Department',
                'Cabin Crew Operations Department',
                'Ground Handling Department',
                'Airport Security Department',
                'Passenger Services Department',
                'Cargo and Logistics Department',
                'Aircraft Engineering Department',
                'Avionics Systems Department',
                'Flight Training and Simulation Department',
                'Quality Assurance and Safety Department',
                'Aircraft Dispatch Department',
                'Runway Operations Department',
                'Fuel Management Department',
                'Aircraft Procurement and Supply Chain Department',
                'Emergency Response and Rescue Department',
                'Weather and Navigation Systems Department',
                'Aerodynamics Research and Development Department',
                'Aircraft Compliance and Regulation Department'
            ];


            function switchGapTab(gapTab) {
                currentGapTab = gapTab;
                currentGapPage = 1;
                document.querySelectorAll('.skills-gap-overview .tab-button').forEach(button => {
                    if (button.textContent.includes(gapTab === 'individual' ? 'Individual' : 'Department')) {
                        button.classList.add('active');
                        button.style.backgroundColor = '#F7941D';
                        button.style.color = '#FFF';
                    } else {
                        button.classList.remove('active');
                        button.style.backgroundColor = '#FFF';
                        button.style.color = '#F7941D';
                    }
                });
                document.querySelector('.skills-gap-overview .search-bar input').placeholder = gapTab === 'individual' ? 'Search individual' : 'Search department';
                loadGapProgressBars();
                updateGapRecordCount();
            }

            function loadGapProgressBars() {
                const container = document.getElementById('progress-container');
                container.className = 'container';
                container.style = 'display: flex; flex-direction:column; align-items: center; width:100%; margin-bottom: 10px; padding: 10px; background: #FFF; border-radius: 8px;';
                container.innerHTML = '';
                const data = currentGapTab === 'individual' ? gapIndividuals : gapDepartments;
                const startIndex = (currentGapPage - 1) * recordsGapPerPage;
                const endIndex = startIndex + recordsGapPerPage;
                const currentRecords = data.slice(startIndex, endIndex);

                currentRecords.forEach((record) => {
                    const progressItem = document.createElement('div');
                    progressItem.className = 'progress-item';
                    progressItem.style = 'display: flex; align-items: center; width:100%; margin-bottom: 10px; padding: 10px; background: #FFF; border-radius: 8px;';
                    if (currentGapTab === 'individual') {
                        progressItem.innerHTML = `
                <div style="display: flex; flex-direction: column; width: 100%; justify-content: space-between; gap: 10px;">
                <!-- First Row -->
                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%;">
                    <span style="width: 30%; color: rgba(75, 86, 117, 1); font-weight: 500;">${record}</span>
                    <div style="width: 70%; display: flex; align-items: center;">
                        <!-- Multi-colored Progress Bar -->
                        <div style="display: flex; width: 100%; height: 10px; border-radius: 5px; overflow: hidden;">
                            <div style="flex: 30%; background: rgba(247, 148, 28, 1);"></div>
                            <div style="flex: 30%; background: rgba(249, 168, 69, 1);"></div>
                            <div style="flex: 32%; background: rgba(250, 187, 110, 1);"></div>
                            <div style="flex: 21%; background: rgba(252, 207, 152, 1);"></div>
                            <div style="flex: 9%; background: rgba(253, 226, 193, 1);"></div>
                        </div>
                    </div>
                </div>

                <!-- Second Row (Legend) -->
                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%;">
                    <span style="width: 30%; color: rgba(75, 86, 117, 1); font-weight: 500;"></span>
                    <div class="span-gap">
                        <span style="font-size: 12px; color: rgba(75, 86, 117, 1);"><span style="color: rgba(247, 148, 28, 1);">&#9679;</span> 30% Proficient</span>
                        <span style="font-size: 12px; color: rgba(75, 86, 117, 1);"><span style="color: rgba(249, 168, 69, 1);">&#9679;</span> 30% Exceeds Expectation</span>
                        <span style="font-size: 12px; color: rgba(75, 86, 117, 1);"><span style="color: rgba(250, 187, 110, 1);">&#9679;</span> 32% Below Expectation</span>
                        <span style="font-size: 12px; color: rgba(75, 86, 117, 1);"><span style="color: rgba(252, 207, 152, 1);">&#9679;</span> 21% Not Proficient</span>
                        <span style="font-size: 12px; color: rgba(75, 86, 117, 1);"><span style="color: rgba(253, 226, 193, 1);">&#9679;</span> 9% Projected</span>
                    </div>
                </div>
            </div>
        `;
                    } else {
                        progressItem.innerHTML = `
            <div style="display: flex; flex-direction: column; width: 100%; justify-content: space-between; gap: 10px;">
                <!-- First Row -->
                <div style="display: flex; flex-direction: column; align-items: start; width: 100%; gap:10px;">
                    <div style="display: flex; align-items: start;">
                        <span style="color: rgba(75, 86, 117, 1); font-weight: 500;">${record}</span>
                        <div style="color:#99A1B7; margin-left:10px;">
                            <img src="/images/people_head.png" alt="user" style="border-radius: 50%; margin-right: 5px; width: 50px; height: 24px;">
                            ${Math.floor(Math.random() * 300) + 100}
                        </div>
                    </div>
                </div>

                 <!-- Second Row -->
                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%;">
                    <div style="width: 100%; display: flex; align-items: center;">
                        <!-- Multi-colored Progress Bar -->
                        <div style="display: flex; width: 100%; height: 10px; border-radius: 5px; overflow: hidden;">
                            <div style="flex: 30%; background: rgba(247, 148, 28, 1);"></div>
                            <div style="flex: 30%; background: rgba(249, 168, 69, 1);"></div>
                            <div style="flex: 32%; background: rgba(250, 187, 110, 1);"></div>
                            <div style="flex: 21%; background: rgba(252, 207, 152, 1);"></div>
                            <div style="flex: 9%; background: rgba(253, 226, 193, 1);"></div>
                        </div>
                    </div>
                </div>

                <!-- Third Row (Legend) -->
                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%;">
                    <div class="span-dep">
                        <span style="margin-right:10px; font-weight:400; font-size: 12px; color: rgba(75, 86, 117, 1);"><span style="color: rgba(247, 148, 28, 1);">&#9679;</span> 54% Flight Planning</span>
                        <span style="margin-right:10px; font-weight:400; font-size: 12px; color: rgba(75, 86, 117, 1);"><span style="color: rgba(249, 168, 69, 1);">&#9679;</span> 32% Regulatory Knowledge</span>
                        <span style="margin-right:10px; font-weight:400; font-size: 12px; color: rgba(75, 86, 117, 1);"><span style="color: rgba(250, 187, 110, 1);">&#9679;</span> 21% Crisis Management</span>
                        <span style="margin-right:10px; font-weight:400; font-size: 12px; color: rgba(75, 86, 117, 1);"><span style="color: rgba(252, 207, 152, 1);">&#9679;</span> 9% Communication</span>
                        <span style="margin-right:10px; font-weight:400; font-size: 12px; color: rgba(75, 86, 117, 1);"><span style="color: rgba(253, 226, 193, 1);">&#9679;</span> 7% Technical Systems</span>
                    </div>
                </div>
            </div>
           `;
                    }
                    container.appendChild(progressItem);
                });
                updateGapRecordCount();
            }

            function updateGapRecordCount() {
                const data = currentGapTab === 'individual' ? gapIndividuals : gapDepartments;
                const totalRecords = data.length;
                const startRecord = (currentGapPage - 1) * recordsGapPerPage + 1;
                const endRecord = Math.min(currentGapPage * recordsGapPerPage, totalRecords);

                const recordCountElement = document.getElementById('gap-record-count');
                recordCountElement.textContent = `${startRecord}-${endRecord} of ${totalRecords}`;
            }


            function nextGapPage() {
                const data = currentGapTab === 'individual' ? gapIndividuals : gapDepartments;
                if (currentGapPage * recordsGapPerPage < data.length) {
                    currentGapPage++;
                    loadGapProgressBars();
                    updateGapRecordCount();
                }
            }

            function previousGapPage() {
                if (currentGapPage > 1) {
                    currentGapPage--;
                    loadGapProgressBars();
                    updateGapRecordCount();
                }
            }

            function goToGapFirstPage() {
                currentGapPage = 1; // Set to the first page
                loadGapProgressBars();
                updateGapRecordCount();
            }

            function goToGapLastPage() {
                const data = currentGapTab === 'individual' ? gapIndividuals : gapDepartments;
                currentGapPage = Math.ceil(data.length / recordsGapPerPage); // Set to the last page
                loadGapProgressBars();
                updateGapRecordCount();
            }

            function filterGapRecords() {
                const input = document.querySelector('.skills-gap-overview .search-bar input');
                const filter = input.value.toLowerCase();
                const data = currentGapTab === 'individual' ? gapIndividuals : gapDepartments;
                const filteredData = data.filter((record) => record.toLowerCase().includes(filter));

                const container = document.getElementById('progress-container');
                container.innerHTML = '';

                // Adjust pagination variables
                currentGapPage = 1;
                const totalRecords = filteredData.length;
                const startIndex = (currentGapPage - 1) * recordsGapPerPage;
                const endIndex = startIndex + recordsGapPerPage;
                const currentRecords = filteredData.slice(startIndex, endIndex);

                currentRecords.forEach((record) => {
                    const progressItem = document.createElement('div');
                    progressItem.className = 'progress-item';
                    progressItem.style = 'display: flex; align-items: center; width:100%; margin-bottom: 10px; padding: 10px; background: #FFF; border-radius: 8px;';

                    if (currentGapTab === 'individual') {
                        // Individual tab HTML structure
                        progressItem.innerHTML = `
                <div style="display: flex; flex-direction: column; width: 100%; justify-content: space-between; gap: 10px;">
                    <!-- First Row -->
                    <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%;">
                        <span style="width: 30%; color: rgba(75, 86, 117, 1); font-weight: 500;">${record}</span>
                        <div style="width: 70%; display: flex; align-items: center;">
                            <!-- Multi-colored Progress Bar -->
                            <div style="display: flex; width: 100%; height: 10px; border-radius: 5px; overflow: hidden;">
                                <div style="flex: 30%; background: rgba(247, 148, 28, 1);"></div>
                                <div style="flex: 30%; background: rgba(249, 168, 69, 1);"></div>
                                <div style="flex: 32%; background: rgba(250, 187, 110, 1);"></div>
                                <div style="flex: 21%; background: rgba(252, 207, 152, 1);"></div>
                                <div style="flex: 9%; background: rgba(253, 226, 193, 1);"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row (Legend) -->
                    <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%;">
                        <span style="width: 30%;"></span>
                        <div style="width: 70%; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 12px; color: rgba(75, 86, 117, 1);">
                                <span style="color: rgba(247, 148, 28, 1);">&#9679;</span> 30% Proficient
                            </span>
                            <span style="font-size: 12px; color: rgba(75, 86, 117, 1);">
                                <span style="color: rgba(249, 168, 69, 1);">&#9679;</span> 30% Exceeds Expectation
                            </span>
                            <span style="font-size: 12px; color: rgba(75, 86, 117, 1);">
                                <span style="color: rgba(250, 187, 110, 1);">&#9679;</span> 32% Below Expectation
                            </span>
                            <span style="font-size: 12px; color: rgba(75, 86, 117, 1);">
                                <span style="color: rgba(252, 207, 152, 1);">&#9679;</span> 21% Not Proficient
                            </span>
                            <span style="font-size: 12px; color: rgba(75, 86, 117, 1);">
                                <span style="color: rgba(253, 226, 193, 1);">&#9679;</span> 9% Projected
                            </span>
                        </div>
                    </div>
                </div>
            `;
                    } else {
                        // Department tab HTML structure
                        progressItem.innerHTML = `
                <div style="display: flex; flex-direction: column; width: 100%; gap: 10px;">
                    <!-- First Row -->
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                        <div style="display: flex; align-items: center;">
                            <span style="color: rgba(75, 86, 117, 1); font-weight: 500;">${record}</span>
                            <div style="color:#99A1B7; margin-left:10px;">
                                <img src="/images/people_head.png" alt="user" style="margin-right: 5px; width: 50px; height: 24px;">
                                ${Math.floor(Math.random() * 300) + 100}
                            </div>
                        </div>
                    </div>

                    <!-- Second Row -->
                    <div style="width: 100%; display: flex; align-items: center;">
                        <!-- Multi-colored Progress Bar -->
                        <div style="display: flex; width: 100%; height: 10px; border-radius: 5px; overflow: hidden;">
                            <div style="flex: 30%; background: rgba(247, 148, 28, 1);"></div>
                            <div style="flex: 30%; background: rgba(249, 168, 69, 1);"></div>
                            <div style="flex: 32%; background: rgba(250, 187, 110, 1);"></div>
                            <div style="flex: 21%; background: rgba(252, 207, 152, 1);"></div>
                            <div style="flex: 9%; background: rgba(253, 226, 193, 1);"></div>
                        </div>
                    </div>

                    <!-- Third Row (Legend) -->
                    <div style="width: 100%; display: flex; flex-wrap: wrap; align-items: center; margin-top: 5px;">
                        <span style="margin-right:10px; font-weight:400; font-size: 12px; color: rgba(75, 86, 117, 1);">
                            <span style="color: rgba(247, 148, 28, 1);">&#9679;</span> 54% Flight Planning
                        </span>
                        <span style="margin-right:10px; font-weight:400; font-size: 12px; color: rgba(75, 86, 117, 1);">
                            <span style="color: rgba(249, 168, 69, 1);">&#9679;</span> 32% Regulatory Knowledge
                        </span>
                        <span style="margin-right:10px; font-weight:400; font-size: 12px; color: rgba(75, 86, 117, 1);">
                            <span style="color: rgba(250, 187, 110, 1);">&#9679;</span> 21% Crisis Management
                        </span>
                        <span style="margin-right:10px; font-weight:400; font-size: 12px; color: rgba(75, 86, 117, 1);">
                            <span style="color: rgba(252, 207, 152, 1);">&#9679;</span> 9% Communication
                        </span>
                        <span style="margin-right:10px; font-weight:400; font-size: 12px; color: rgba(75, 86, 117, 1);">
                            <span style="color: rgba(253, 226, 193, 1);">&#9679;</span> 7% Technical Systems
                        </span>
                    </div>
                </div>
            `;
                    }

                    container.appendChild(progressItem);
                });

                // Update the record count after filtering
                const startRecord = totalRecords > 0 ? 1 : 0;
                const endRecord = Math.min(recordsGapPerPage, totalRecords);

                const recordCountElement = document.getElementById('gap-record-count');
                recordCountElement.textContent = `${startRecord}-${endRecord} of ${totalRecords}`;
            }

            function generateRandomPercentage() {
                return Math.floor(Math.random() * 100) + 1; // Random percentage between 1 and 100
            }


            const technicalSkills = [
                'Aircraft Maintenance', 'Engine Overhaul', 'Flight Planning', 'Navigation Systems',
                'Avionics Installation', 'Cabin Safety Systems', 'Fuel Management', 'Weather Forecast Analysis',
                'Ground Support Equipment Operations', 'Runway Inspection', 'Air Traffic Control Coordination',
                'Emergency Procedures', 'Cargo Loading and Balancing', 'Landing Gear Systems',
                'Autopilot Calibration', 'Flight Simulation Training', 'Aircraft Painting and Livery',
                'Wing Structure Repairs', 'Cockpit Instrumentation', 'Hydraulic Systems Management'
            ];

            const softSkills = [
                'Communication', 'Teamwork', 'Leadership', 'Problem Solving', 'Decision Making',
                'Adaptability', 'Critical Thinking', 'Conflict Resolution', 'Time Management',
                'Creativity', 'Interpersonal Skills', 'Work Ethic', 'Negotiation',
                'Emotional Intelligence', 'Resilience', 'Active Listening',
                'Collaboration', 'Empathy', 'Stress Management', 'Flexibility'
            ];

            let currentSkillType = 'technical';
            let currentSkillPage = 1;
            const recordsSkillPerPage = 5;

            function switchSkillType(skillType) {
                currentSkillType = skillType;
                currentSkillPage = 1;
                document.querySelectorAll('.skills-overview button').forEach(button => {
                    button.style.background = button.textContent.includes(skillType === 'technical' ? 'Technical' : 'Soft') ?
                        '#F7941D' :
                        '#FFF';
                    button.style.color = button.textContent.includes(skillType === 'technical' ? 'Technical' : 'Soft') ?
                        '#FFF' :
                        '#F7941D';
                });
                document.querySelector('#skills-search-bar input').placeholder = skillType === 'technical' ? 'Search Technical Skill' : 'Search Soft Skill';
                loadSkills();
                updateRecordCount();

            }

            function filterSkills() {
                const input = document.querySelector('#skills-search-bar input');
                const filter = input.value.toLowerCase();
                const skills = currentSkillType === 'technical' ? technicalSkills : softSkills;
                const filteredSkills = skills.filter(skill => skill.toLowerCase().includes(filter));
                currentSkillPage = 1; // Reset to the first page
                displaySkills(filteredSkills.slice(0, recordsSkillPerPage));
                updateRecordCount();
            }

            function loadSkills() {
                const skills = currentSkillType === 'technical' ? technicalSkills : softSkills;
                const startIndex = (currentSkillPage - 1) * recordsSkillPerPage;
                const endIndex = startIndex + recordsSkillPerPage;
                displaySkills(skills.slice(startIndex, endIndex));
                updateRecordCount();
            }

            function displaySkills(skills) {
                const isTechnical = currentSkillType === 'technical'; // Determine if the current skill type is technical
                const tbody = document.querySelector('.skills-overview tbody');
                tbody.innerHTML = ''; // Clear existing records

                skills.forEach(skill => {
                    const gapLevel = generateGapLevel(); // Generate gap level (High, Medium, Low)
                    const row = document.createElement('tr');

                    const progressBarImage = isTechnical ?
                        '/images/progress_bar_technical.png' :
                        '/images/progress_bar_soft.png'; // Assign image path based on skill type

                    row.innerHTML = `
                <td style="padding: 10px; color: #333;">${skill}</td>
                <td style="padding: 10px; color:#99A1B7;">
                    <img src="/images/people_head.png" alt="user" style="border-radius: 50%; margin-right: 5px; width: 50px; height: 24px;">
                    ${Math.floor(Math.random() * 300) + 100}
                </td>
                <td style="padding: 10px; text-align: center;">
                    <img src="${progressBarImage}" alt="Progress Bar" style="height: 8px; width: 100%; border-radius: 4px;">
                </td>
                <td style="padding: 10px; color: #333;">${Math.floor(Math.random() * 30) + 10}</td>
                <td style="padding: 10px; color: #333;">${Math.floor(Math.random() * 30) + 10}</td>
                <td style="padding: 10px;" width:100%; >
                    <span style="width:100%; color: ${generateGapColor(gapLevel)}; background: ${generateGapBackgroundColor(gapLevel)}; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 12px;">${gapLevel}</span>
                </td>
                <td style="padding: 10px; color: #333;">${(Math.random() * 2 + 3).toFixed(1)}</td>
            `;
                    tbody.appendChild(row);
                });
            }


            function updateRecordCount() {
                const skills = currentSkillType === 'technical' ? technicalSkills : softSkills;
                const totalRecords = skills.length;
                const startRecord = (currentSkillPage - 1) * recordsSkillPerPage + 1;
                const endRecord = Math.min(currentSkillPage * recordsSkillPerPage, totalRecords);

                const recordCountElement = document.getElementById('record-count');
                recordCountElement.textContent = `${startRecord}-${endRecord} of ${totalRecords}`;
            }

            function skillsNextPage() {
                const skills = currentSkillType === 'technical' ? technicalSkills : softSkills;
                if (currentSkillPage * recordsSkillPerPage < skills.length) {
                    currentSkillPage++;
                    loadSkills();
                    updateRecordCount();
                }
            }

            function skillsPreviousPage() {
                if (currentSkillPage > 1) {
                    currentSkillPage--;
                    loadSkills();
                    updateRecordCount();
                }
            }

            function goToFirstPage() {
                currentSkillPage = 1; // Set to the first page
                loadSkills();
                updateRecordCount();
            }

            function goToLastPage() {
                const skills = currentSkillType === 'technical' ? technicalSkills : softSkills;
                currentSkillPage = Math.ceil(skills.length / recordsSkillPerPage); // Set to the last page
                loadSkills();
                updateRecordCount();
            }

            function generateGapLevel() {
                const levels = ['High', 'Medium', 'Low'];
                return levels[Math.floor(Math.random() * levels.length)];
            }

            // Helper functions for generating random data
            function generateGapColor(level) {
                if (level === 'High') {
                    return '#AA2D22';
                } else if (level === 'Medium') {
                    return '#975102';
                } else if (level === 'Low') {
                    return '#196329';
                }
                return '#333'; // Default fallback color
            }

            function generateGapBackgroundColor(level) {
                if (level === 'High') {
                    return '#FFE0DD';
                } else if (level === 'Medium') {
                    return '#FFF3E0';
                } else if (level === 'Low') {
                    return '#DDF5E2';
                }
                return '#FFF'; // Default fallback background
            }

            // Projected Skill Demand Over Time Functions
            let currentDemandPage = 1;
            const recordsDemandPerPage = 5;
            let filteredSkillDemandData = [];

            const skillDemandData = [{
                    skill: 'Human Factors Management',
                    currentDemand: '150 positions',
                    projectedDemand: '200 positions',
                    currentSkillAvailability: '80',
                },
                {
                    skill: 'Innovation Management',
                    currentDemand: '100 positions',
                    projectedDemand: '130 positions',
                    currentSkillAvailability: '60',
                },
                {
                    skill: 'Process Improvement and Optimisation',
                    currentDemand: '120 positions',
                    projectedDemand: '160 positions',
                    currentSkillAvailability: '70',
                },
                {
                    skill: 'Manpower Planning',
                    currentDemand: '90 positions',
                    projectedDemand: '120 positions',
                    currentSkillAvailability: '50',
                },
                {
                    skill: 'Avionics Installation',
                    currentDemand: '80 positions',
                    projectedDemand: '110 positions',
                    currentSkillAvailability: '40',
                },
                {
                    skill: 'Cabin Safety Systems',
                    currentDemand: '70 positions',
                    projectedDemand: '100 positions',
                    currentSkillAvailability: '65',
                },
                {
                    skill: 'Fuel Management',
                    currentDemand: '60 positions',
                    projectedDemand: '90 positions',
                    currentSkillAvailability: '50',
                },
                {
                    skill: 'Weather Forecast Analysis',
                    currentDemand: '50 positions',
                    projectedDemand: '80 positions',
                    currentSkillAvailability: '30',
                },
                {
                    skill: 'Ground Support Equipment Operations',
                    currentDemand: '40 positions',
                    projectedDemand: '70 positions',
                    currentSkillAvailability: '25',
                },
                {
                    skill: 'Runway Inspection',
                    currentDemand: '30 positions',
                    projectedDemand: '60 positions',
                    currentSkillAvailability: '20',
                },
            ];


            // Function to calculate additional fields and add to each skill object
            skillDemandData.forEach(skill => {
                // Extract numeric values from strings
                const currentDemandNum = parseInt(skill.currentDemand);
                const projectedDemandNum = parseInt(skill.projectedDemand);
                const currentSkillAvailabilityNum = parseInt(skill.currentSkillAvailability.replace('+', '').replace('%', ''));

                // Calculate growth rate as a percentage
                const growth = ((projectedDemandNum - currentDemandNum) / currentDemandNum) * 100;
                skill.growthRate = growth.toFixed(1) + '%';

                // Skill gap forecast
                skill.skillGapForecast = projectedDemandNum - currentSkillAvailabilityNum;

                // Determine urgency based on the gap percentage
                const gapPercentage = skill.skillGapForecast / projectedDemandNum;
                if (gapPercentage > 0.5) {
                    skill.urgency = 'High';
                } else if (gapPercentage > 0.2) {
                    skill.urgency = 'Medium';
                } else {
                    skill.urgency = 'Low';
                }
            });

            // Initialize filtered data
            filteredSkillDemandData = [...skillDemandData];

            function loadSkillDemand() {
                const tbody = document.querySelector('.demand-overview tbody');
                tbody.innerHTML = '';
                const startIndex = (currentDemandPage - 1) * recordsDemandPerPage;
                const endIndex = startIndex + recordsDemandPerPage;
                const currentRecords = filteredSkillDemandData.slice(startIndex, endIndex);

                currentRecords.forEach(skill => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
            <td style="padding: 10px; color: #333;">${skill.skill}</td>
            <td style="padding: 10px; color: #333;">${skill.currentDemand}</td>
            <td style="padding: 10px; color: #333;">${skill.projectedDemand}</td>
            <td style="padding: 10px; color: #333;">${skill.growthRate}</td>
            <td style="padding: 10px; color: #333;"><img src="/images/people_head.png" alt="user" style="border-radius: 50%; margin-right: 5px; width: 50px;  height: 24px;">
            ${skill.currentSkillAvailability}</td>
            <td style="padding: 10px; color: #333;">${skill.skillGapForecast} positions</td>
            <td style="padding: 10px;">
                <span style="color: ${generateUrgencyColor(skill.urgency)}; background: ${generateUrgencyBackgroundColor(skill.urgency)}; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 12px;">${skill.urgency}</span>
            </td>
        `;
                    tbody.appendChild(row);
                });

                updateDemandRecordCount();
            }

            function updateDemandRecordCount() {
                const totalRecords = filteredSkillDemandData.length;
                const startRecord = (currentDemandPage - 1) * recordsDemandPerPage + 1;
                const endRecord = Math.min(currentDemandPage * recordsDemandPerPage, totalRecords);

                const recordCountElement = document.getElementById('demand-record-count');
                recordCountElement.textContent = `${startRecord}-${endRecord} of ${totalRecords}`;
            }

            function demandNextPage() {
                if (currentDemandPage * recordsDemandPerPage < filteredSkillDemandData.length) {
                    currentDemandPage++;
                    loadSkillDemand();
                    updateDemandRecordCount();
                }
            }

            function demandPreviousPage() {
                if (currentDemandPage > 1) {
                    currentDemandPage--;
                    loadSkillDemand();
                    updateDemandRecordCount();
                }
            }

            function goToDemandFirstPage() {
                currentDemandPage = 1;
                loadSkillDemand();
                updateDemandRecordCount();
            }

            function goToDemandLastPage() {
                currentDemandPage = Math.ceil(filteredSkillDemandData.length / recordsDemandPerPage);
                loadSkillDemand();
                updateDemandRecordCount();
            }

            function generateUrgencyColor(urgency) {
                if (urgency === 'High') {
                    return '#AA2D22';
                } else if (urgency === 'Medium') {
                    return '#975102';
                } else if (urgency === 'Low') {
                    return '#196329';
                }
                return '#333';
            }

            function generateUrgencyBackgroundColor(urgency) {
                if (urgency === 'High') {
                    return '#FFE0DD';
                } else if (urgency === 'Medium') {
                    return '#FFF3E0';
                } else if (urgency === 'Low') {
                    return '#DDF5E2';
                }
                return '#FFF';
            }

            // Function to filter skills based on search input
            function filterSkillDemand() {
                const input = document.querySelector('#demand-search-bar input');
                const filter = input.value.toLowerCase();
                filteredSkillDemandData = skillDemandData.filter(skill => skill.skill.toLowerCase().includes(filter));
                currentDemandPage = 1; // Reset to the first page
                loadSkillDemand();
                updateDemandRecordCount();
            }

            // Initial Load
            document.addEventListener('DOMContentLoaded', function() {
                loadGapProgressBars();
                updateGapRecordCount();
                loadSkills();
                updateRecordCount();
                loadSkillDemand();
                updateDemandRecordCount();
                generateProjectedSkillDemandChart();
            });
        </script>