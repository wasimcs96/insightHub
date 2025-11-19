@extends('admin.layout.app')

@section('title', 'Create Section')
@section('styles')

    <style>
        .setting {
            padding: 30px 60px 45px 30px;
            gap: 30px;
        }

        .modal-body h3 {
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
            margin: 0;
            color: #4B5675;
            margin: 0px 90px;
        }

        .modal-body p {
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            color: #4B5675;
            margin: 0;
        }

        .modal-body {
            text-align: center;
            padding: 0px 16px;
            gap: 16px;
            display: grid;
        }

        .setting h3 {
            color: #071437;
            font-size: 24px;
            font-weight: 600;
            line-height: normal;
            display: flex;
            gap: 15px;
            align-items: center;
            margin: 0;
        }

        .setting span {
            color: #F7941C;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            cursor: pointer;
        }

        .states p {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            margin-bottom: 10px;
        }

        .states div {
            padding: 7px 10px;
            border-radius: 14.5px;
        }

        .compare-selected {
            color: #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            background: #FFF6EA;
        }

        .type-dropdown {
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }

        .filtered,
        .filtered .states div {
            display: flex;
            align-items: center;
            gap: 15px 20px;
            align-self: stretch;
            flex-flow: wrap;
            color: #fff;
        }

        .filtered div,
        .add-comparison {
            gap: 6px !important;
            cursor: pointer;
        }

        .add-comparison {
            color: #F7941C;
            font-weight: 600;
        }

        .svg-plus {
            top: 3px;
            position: relative;
        }

        .modal-header,
        .modal-footer {
            padding: 16px;
            border: 0;
        }

        .modal-header {
            padding-bottom: 0px;
        }

        .modal-footer button {
            width: 48.6%;
            padding: 14px 20px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;

        }

        .btn-no {
            border: 1px solid #99A1B7;
            background: #fff;
            color: #78829D;
        }

        .btn-yes {
            background: #F24130;
            border: 1px solid #F24130;
            color: #fff;
        }

        .dropdown-menu {
            border-top: 1px solid #DBDFE9;
            border-right: 1px solid #DBDFE9;
            border-left: 1px solid #DBDFE9;
            border-radius: 4px 4px 0px 0px;
        }

        .dropdown-item {
            display: flex;
            padding: 12px 8px;
            align-items: center;
            gap: 6px;
            align-self: stretch;
            color: #000;
        }

        .dropdown-item:hover {
            background: #FFF6EA;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            background: #F7941C;
            color: #fff;
        }

        .filter-card {
            margin: 30px 0px;
            padding: 30px;
        }

        .filter-card h4 {
            color: #071437;
            font-size: 16.25px;
            font-weight: 700;
            line-height: 19.5px;
            margin-bottom: 24px;
        }

        .filter-dropdown {
            width: 100%;
            display: flex;
            padding: 0px 12px;
            height: 40px;
            align-items: center;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background: #FFF;
            justify-content: space-between;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .dropdown-menu {
            padding: 0;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .filter-inner {
            display: grid;
            grid-template-columns: 68% 0% 29%;
            gap: 18px;
        }

        .left-filter {
            display: grid;
            grid-template-columns: 49% 49%;
            gap: 16px;
        }

        .left-inner p {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            display: flex;
            justify-content: space-between;
        }

        .left-inner span {
            color: #F7941D;
            cursor: pointer;
        }

        .filter-footer {
            display: flex;
            padding: 12px 8px;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            border-top: 1px solid #D9D9D9;
        }

        .button-filter-apply {
            padding: 4px 20px;
            border-radius: 14.5px;
            background: #F7941C;
            color: #fff;
            border: 0;
        }

        .button-filter-cancel {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            border: 0;
            background: #fff;
        }

        .filter-item {
            display: flex;
            padding: 12px 8px;
            align-items: center;
            gap: 6px;
        }

        .line {
            height: auto;
            width: 1px;
            background: #DBDFE9;
        }

        .filter-menu-item {
            width: 100%;
            margin: 10px 0px !important;
        }

        .right-inner {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .right-inner p {
            margin: 0;
        }

        .line-card {
            padding: 30px 60px 45px 30px;
            display: grid;
            gap: 90px;
        }

        .top-content h3 {
            color: #071437;
            font-size: 24px;
            font-weight: 600;
            line-height: normal;
            margin-bottom: 6px;
        }

        .top-content p {
            color: #4B5675;
            font-size: 14px;
            font-weight: 400;
            line-height: 18px;
            margin: 0;
        }

        .main-content {
            display: grid;
            gap: 54px;
        }

        .inner-main {
            display: grid;
            gap: 48px;
        }

        .inner-text>p,
        .inner-text-heading>p {
            color: #071437;
            font-size: 16px;
            font-weight: 600;
            line-height: 22px;
            margin-bottom: 6px;
        }

        .inner-text>span {
            color: #4B5675;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            width: 460px;
            display: flex;
        }

        .colors-overview {
            display: flex;
            align-items: center;
            gap: 26px;
        }

        .overview-inner {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .overview-inner span {
            width: 34.13px;
            height: 7.772px;
            display: block;
        }

        .overview-inner p {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
            line-height: 15px;
            margin: 0;
        }

        .purple {
            background: #7F66CA;
        }

        .light-purple {
            background: #D0C2F9;
        }

        .light-green {
            background: #BBECC5;
        }

        .teal {
            background: #8CE3E3;
        }

        .teal-dark {
            background: #14A6A6;
        }

        .light-yellow {
            background: #FFD16D;
        }

        .cognitive-bottom {
            width: 728px;
            padding: 15px 20px;
            border-radius: 8px;
            background: #FFFAF3;
        }

        .cognitive-bottom>p {
            color: #071437;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: 22px;
            margin-bottom: 19px;
        }

        .cog-inner {
            display: grid;
            grid-template-columns: 14% 86%;
        }

        .cog-inner .cog-left {
            color: #F7941C;
            font-size: 18.4px;
            font-weight: 500;
            line-height: 22.08px;
        }

        .riasec-left {
            color: #F7941C;
            font-size: 38.4px;
            font-weight: 500;
            line-height: normal;
        }

        .riasec-inner {
            width: 650px;
            display: grid;
            grid-template-columns: 16% 84%;
        }
    </style>

    <style>
        .progress {
            height: 12px;
            background-color: #f0f0f0;
            border-radius: 0px;
        }

        .circle {
            /* position: relative; */
            position: absolute;
            top: -16px;
            display: flex;
            width: 35.061px;
            height: 35px;
            padding: 9px 7px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
            border-radius: 17.5px;
            border: 3px solid #FFF;
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25);
            color: #FFF;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            cursor: pointer;
        }

        .circle:hover {
            z-index: 100;
        }

        .circle-ml {
            background-color: #252F4A;
        }

        .circle-g {
            background-color: #FFC31F;
        }

        .circle-am {
            background-color: #AA91F4;
        }

        .circle-ns {
            background-color: #3FD0D0;
        }

        .circle-ta {
            background-color: #0C6464;
        }

        .inner-text-heading {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .company,
        .department {
            display: flex;
            height: 35px;
            padding: 3px 12px 3px 0px;
            justify-content: center;
            align-items: center;
            gap: 6px;
            border-radius: 80px;
            margin-bottom: 10px;
        }

        .company {
            background: #FFF6EA;
        }

        .department {
            background: #E3F7FF;
        }

        .company p,
        .department p {
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
            margin: 0;
        }

        .company p {
            color: #F7941C;
        }

        .department p {
            color: #1877A0;
        }

        .company .icon,
        .department .icon {
            width: 35.061px;
            display: flex;
            align-items: center;
            height: 35px;
            padding: 0px 6px;
            justify-content: center;
            gap: 10px;
            border-radius: 17.5px;
            border: 3px solid #FFF;
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25);
            color: #fff;
        }

        .company .icon {
            background: #F7941C;
        }

        .department .icon {
            background: #1877A0;
        }

        .tooltip {
            border-radius: 8px;
        }

        .tooltip-inner {
            padding: 8px 12px !important;
            max-width: 300px !important;
        }

        .cog-level {
            border-radius: 10px;
            padding: 3px 7px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .level-score {
            background: #FFF6EA;
            color: #F7941C;
            margin-left: 8px;

        }

        .level-text {
            font-size: 14px;
            font-weight: 600;
            line-height: normal;
            margin-right: 8px;
        }

        .level-score-very-low {
            background: #E1D8FB;
            color: #6652A1;
        }

        .level-score-low {
            background: #E1D8FB;
            color: #7F66CA;
        }

        .level-score-very-high {
            background: #B2ECEC;
            color: #0C6464;
        }

        .cog-level-high {
            background: #B2ECEC;
            color: #108585;
        }

        .cog-level-moderate {
            background: #BBECC5;
            color: #218336;
        }

        .cog-level-low {
            background: #FFEBB4;
            color: #F7941C;
        }

        .very-low-text {
            color: #4D3E79;
        }

        .low-text {
            color: #997BF2;
        }

        .moderate-text {
            color: #2AA443;
        }

        .high-text {
            color: #14A6A6;
        }

        .very-high-text {
            color: #108585;
        }

        .form-check-input:checked {
            background-color: #F7941C;
            border-color: #F7941C;
        }

        .user-icon {
            display: inline-block;
            width: 30px;
            height: 30px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            line-height: 30px;
            border-radius: 50%;
            font-weight: bold;
            cursor: pointer;
        }

        .user-tooltip {
            visibility: hidden;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-align: center;
            padding: 5px;
            border-radius: 4px;
            position: absolute;
            z-index: 1;
            bottom: 100%;
            /* Position above the icon */
            left: 50%;
            margin-left: -60px;
            width: 120px;
        }

        .user-icon:hover .user-tooltip {
            visibility: visible;
        }

        .stacked-user {
            position: absolute;
            transform: translateX(-50%);
            border-radius: 50%;
            border: 2px solid white;
            transition: transform 0.2s ease-in-out;
        }

        .stacked-user:hover {
            transform: translateX(-50%) scale(1.1);
        }
        .displayNone {
            display: none;
        }
    </style>

@endsection
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1
                    class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Advanced Comparison Report
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item link-a text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Advanced Comparison</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="setting card">
                <h3>Advanced Comparison Setting <span data-bs-toggle="modal" data-bs-target="#clearModel">Clear
                        Setting</span></h3>
                <div class="d-flex gap-5">
                    <div class="states">
                        <p>Pool Type</p>
                        <div class="compare-selected">
                            {{ str_replace(' ', '-', ucwords(str_replace('-', ' ', request('pool_type')))) }}</div>
                    </div>
                    <div class="states">
                        <p>Report Type</p>
                        <div class="type-dropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ $responseData['reportTypes'][request('report_type')] ?? 'OCEAN Domains' }}
                            <iconify-icon icon="ep:arrow-down-bold" width="16" height="16"></iconify-icon>
                        </div>

                        <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton" id="pills-tab" role="tablist">
                            @foreach ($responseData['reportTypes'] as $key => $label)
                                @php
                                    // Sanitize the label for use as an ID
                                    $sanitizedId = preg_replace('/[^a-zA-Z0-9 ]/', '_', $label); // Replace special characters with "_"
                                    $sanitizedId = str_replace(' ', '_', $sanitizedId); // Replace spaces with "_"
                                    $sanitizedId = preg_replace('/_+/', '_', $sanitizedId); // Remove multiple "_"

                                    // Ensure ID starts with a letter (prefix with 'id_' if it starts with a number)
                                    if (preg_match('/^\d/', $sanitizedId)) {
                                        $sanitizedId = 'id_' . $sanitizedId;
                                    }
                                @endphp
                                <li class="dropdown-item nav-item {{ request('report_type') == $key ? 'active' : '' }}"
                                    role="presentation">
                                    <a class="nav-link {{ request('report_type') == $key ? 'active' : '' }}"
                                        id="{{ $sanitizedId }}-tab" data-bs-toggle="pill"
                                        data-bs-target="#{{ $sanitizedId }}" type="button" role="tab"
                                        aria-controls="{{ $sanitizedId }}"
                                        aria-selected="{{ request('report_type') == $key ? 'true' : 'false' }}">
                                        <iconify-icon icon="material-symbols:check-rounded" width="16" height="16"
                                            style="color: #fff;"></iconify-icon>
                                        {{ $label }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>


                </div>
                <h3>Talent Comparison</h3>
                {{-- <div class="filtered">
                    <div class="states">
                        <p>Comparison 1</p>
                        <div style="background-color: #252F4A;">Mary Lucillo-Interview
                            Completed <iconify-icon icon="material-symbols:close-rounded" width="16"
                                height="16"></iconify-icon></div>
                    </div>
                    <div class="states">
                        <p>Comparison 2</p>
                        <div style="background-color: #FFC31F;">Gonzales-Flight Operations
                            Officer <iconify-icon icon="material-symbols:close-rounded" width="16"
                                height="16"></iconify-icon></div>
                    </div>
                    <div class="states">
                        <p>Comparison 3</p>
                        <div style="background-color: #AA91F4;">Ariel Cruz Mejia-Assessment
                            Completed <iconify-icon icon="material-symbols:close-rounded" width="16"
                                height="16"></iconify-icon></div>
                    </div>
                    <div class="states">
                        <p>Comparison 4</p>
                        <div style="background-color: #0C6464;">Timoteo Aricayos-Flight
                            Operations Officer <iconify-icon icon="material-symbols:close-rounded" width="16"
                                height="16"></iconify-icon></div>
                    </div>
                    <div class="states">
                        <p>Comparison 5</p>
                        <div style="background-color: #3FD0D0;">Nikki Galvez
                            Sena-Employee <iconify-icon icon="material-symbols:close-rounded" width="16"
                                height="16"></iconify-icon></div>
                    </div>
                    <div>
                        <p style="color: #fff">none</p>
                        <div class="add-comparison"><iconify-icon icon="ic:round-plus" width="16" height="16"
                                class="svg-plus"></iconify-icon> Add Comparison</div>
                    </div>
                </div> --}}
                <div class="filtered">
                    {{-- @php
                        $backgroundColors = ['#252F4A', '#FFC31F', '#AA91F4', '#0C6464', '#3FD0D0'];
                        $maxComparisons = 5; // Maximum number of comparisons
                    @endphp
                
                    @for ($i = 0; $i < $maxComparisons; $i++)
                        @if (isset($responseData['users'][$i]))
                            @php
                                $user = $responseData['users'][$i];
                                $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
                                $roleName = $user->role_name ?? 'No Position';
                            @endphp
                
                            <div class="states" id="user-{{ $user->id }}">
                                <p>Comparison {{ $i + 1 }}</p>
                                <div style="background-color: {{ $backgroundColors[$i % count($backgroundColors)] }};">
                                    {{ $fullName ?: 'Unknown User' }} - {{ $roleName }}
                                    <iconify-icon 
                                        icon="material-symbols:close-rounded" 
                                        width="16" 
                                        height="16" 
                                        data-user-id="{{ $user->id }}" 
                                        class="remove-user-icon">
                                    </iconify-icon>
                                </div>
                            </div>
                        @endif
                    @endfor --}}

                    @php
                        // Define colors for the background dynamically
                        $backgroundColors = ['#252F4A', '#FFC31F', '#AA91F4', '#0C6464', '#3FD0D0'];
                        $maxComparisons = 5; // Maximum number of comparisons
                        $userColors = []; // Store user ID with assigned color
                    @endphp

                    {{-- Loop through the number of comparisons --}}
                    @for ($i = 0; $i < $maxComparisons; $i++)
                        @if (isset($responseData['users'][$i]))
                            @php
                                $user = $responseData['users'][$i];
                                $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
                                $roleName = $user->role_name ?? 'No Position';
                                $assignedColor = $backgroundColors[$i % count($backgroundColors)]; // Assign color
                                $userColors[$user->id] = $assignedColor; // Store user color
                            @endphp

                            <div class="states" id="user-{{ $user->id }}">
                                <p>Comparison {{ $i + 1 }}</p>
                                <div style="background-color: {{ $assignedColor }};">
                                    {{ $fullName ?: 'Unknown User' }} - {{ $roleName }}
                                    <iconify-icon icon="material-symbols:close-rounded" width="16" height="16"
                                        data-user-id="{{ $user->id }}" class="remove-user-icon">
                                    </iconify-icon>
                                </div>
                            </div>
                        @endif
                    @endfor

                    {{-- Add comparison button only if there are fewer than the maximum comparisons --}}
                    @if (count($responseData['users']) < $maxComparisons)
                        <div>
                            <p style="color: #fff">none</p>
                            <div class="add-comparison">
                                <iconify-icon icon="ic:round-plus" width="16" height="16"
                                    class="svg-plus"></iconify-icon> Add Comparison
                            </div>
                        </div>
                    @endif
                </div>



            </div>

            <div class="tab-content" id="pills-tabContent">

                <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="clearModel" tabindex="-1" aria-labelledby="clearModelLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <iconify-icon icon="carbon:warning" width="70.13" height="70.13"
                                    class="justify-content-center d-flex" style="color: #F8BB86;"></iconify-icon>
                                <h3>Are you sure you want to clear current setting?</h3>
                                <p>You will need to reapply again if you change your mind</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-no" data-bs-dismiss="modal">No, keep the
                                    setting</button>
                                <button type="button" class="btn-yes">Yes, clear current setting</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="OCEAN_Domains" role="tabpanel" aria-labelledby="ocean-tab"tabindex="0">
                    <div class="filter-card card">
                        <h4>Filter</h4>
                        <div class="filter-inner">
                            <div class="left-filter">
                                <div class="left-inner">
                                    <p>Assessment Result <span>Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Assessment Result <iconify-icon icon="ep:arrow-down-bold"
                                                width="16" height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item" aria-labelledby="candidateDropdown">
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate1" value="Very High" />
                                                <label for="candidate1" class="m-0">Very High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate2" value="High" />
                                                <label for="candidate2" class="m-0">High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate3" value="Moderate" />
                                                <label for="candidate3" class="m-0">Medium</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate4" value="Low" />
                                                <label for="candidate4" class="m-0">Low</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate5" value="Very Low" />
                                                <label for="candidate5" class="m-0">Very Low</label>
                                            </li>
                                            <div class="filter-footer" data-type="OCEAN" OCEAN="OCEAN">
                                                <button class="button-filter-cancel">Cancel</button>
                                                <button class="button-filter-apply">Filter</button>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="left-inner">
                                    <p>Candidate <span id="clearFilter">Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Candidate <iconify-icon icon="ep:arrow-down-bold" width="16"
                                                height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item candidateList"
                                            aria-labelledby="candidateDropdown" id="candidateList">
                                            <li class="filter-footer-item">
                                                <div class="filter-footer" data-type="OCEAN">
                                                    <button class="button-filter-cancel">Cancel</button>
                                                    <button class="button-filter-apply">Filter</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="right-filter">
                                <p style="margin-bottom: 24px;">Population Comparison</p>
                                <div class="left-filter">
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="carbon:building" width="22"
                                            height="22"></iconify-icon>
                                        <p>Company</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input companyToggle" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="entypo:flow-tree" width="22"
                                            height="22"></iconify-icon>
                                        <p>Department</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input departmentToggle" type="checkbox"
                                                role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="line-card card">
                        <div class="top-content">
                            <h3>OCEAN Domain</h3>
                            <p>Hover over the user icon to view their percentile and percentage score for each domains</p>
                        </div>
                        <div class="main-content" id="ocean-domains-container">
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Imaginative, curious, open-minded, and willing to try new things. They tend to
                                        have a wide range of interests and a vivid imagination.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -37%;" data-bs-toggle="tooltip"
                                            data-bs-html="true"
                                            data-bs-title='<span class="very-low-text level-text">2nd</span><span class="level-score-very-low cog-level">VERY LOW</span><span class="level-score cog-level">SCORE: 52%</span>'>ML</span>
                                        <span class="circle circle-g" style="left: 0%;" data-bs-toggle="tooltip"
                                            data-bs-html="true"
                                            data-bs-title='<span class="low-text level-text">13th</span><span class="level-score-low cog-level">LOW</span><span class="level-score cog-level">SCORE: 52%</span>'>G</span>
                                        <span class="circle circle-am" style="left: -16%;" data-bs-toggle="tooltip"
                                            data-bs-html="true"
                                            data-bs-title='<span class="moderate-text level-text">68th</span><span class="cog-level-moderate cog-level">MODERATE</span><span class="level-score cog-level">SCORE: 52%</span>'>AM</span>
                                        <span class="circle circle-ns" style="left: 16%;" data-bs-toggle="tooltip"
                                            data-bs-html="true"
                                            data-bs-title='<span class="high-text level-text">84th</span><span class="cog-level-high cog-level">High</span><span class="level-score cog-level">SCORE: 52%</span>'>NS</span>
                                        <span class="circle circle-ta" style="left: -5%;" data-bs-toggle="tooltip"
                                            data-bs-html="true"
                                            data-bs-title='<span class="very-high-text level-text">99th</span><span class="level-score-very-high cog-level">very high</span><span class="level-score cog-level">SCORE: 52%</span>'>TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Conscientiousness</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Organized, dependable, and have a strong sense of duty. They are goal-oriented,
                                        disciplined, and prefer planned rather than spontaneous behavior.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 24%;">ML</span>
                                        <span class="circle circle-g" style="left: 25%;">G</span>
                                        <span class="circle circle-am" style="left: -30%;">AM</span>
                                        <span class="circle circle-ns" style="left: -4%;">NS</span>
                                        <span class="circle circle-ta" style="left: -40%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Extroversion</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Sociable, energetic, talkative, appeared to enjoy being around others. They are
                                        often perceived as outgoing and enthusiastic.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -17%;">ML</span>
                                        <span class="circle circle-g" style="left: 5%;">G</span>
                                        <span class="circle circle-am" style="left: 28%;">AM</span>
                                        <span class="circle circle-ns" style="left: -37%;">NS</span>
                                        <span class="circle circle-ta" style="left: 18%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Agreeableness</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Friendly, compassionate, cooperative, and eager to help others. They are often
                                        seen as trustworthy and good-natured.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 9%;">ML</span>
                                        <span class="circle circle-g" style="left: 47%;">G</span>
                                        <span class="circle circle-am" style="left: 7%;">AM</span>
                                        <span class="circle circle-ns" style="left: 44%;">NS</span>
                                        <span class="circle circle-ta" style="left: -11%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Emotional Stability</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Calm, emotionally stable, and less likely to experience negative emotions.They
                                        maintain a steady, calm demeanor, handling challenges with ease and are less
                                        affected by stress.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -17%;">ML</span>
                                        <span class="circle circle-g" style="left: -5%;">G</span>
                                        <span class="circle circle-am" style="left: 34%;">AM</span>
                                        <span class="circle circle-ns" style="left: 2%;">NS</span>
                                        <span class="circle circle-ta" style="left: -18%;">TA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="colors-overview">
                            <div class="overview-inner">
                                <span class="purple"></span>
                                <p>Very Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-purple"></span>
                                <p>Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-green"></span>
                                <p>Moderate</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal"></span>
                                <p>High</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal-dark"></span>
                                <p>Very High</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="id_30_Facets_Openness_to_Experience" role="tabpanel"
                    aria-labelledby="id_30_Facets_Openness_to_Experience-tab" tabindex="0">
                    <div class="filter-card card">
                        <h4>Filter</h4>
                        <div class="filter-inner">
                            <div class="left-filter">
                                <div class="left-inner">
                                    <p>Assessment Result <span>Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Assessment Result <iconify-icon icon="ep:arrow-down-bold"
                                                width="16" height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item" aria-labelledby="candidateDropdown">
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate1" value="Very High" />
                                                <label for="candidate1" class="m-0">Very High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate2" value="High" />
                                                <label for="candidate2" class="m-0">High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate3" value="Moderate" />
                                                <label for="candidate3" class="m-0">Medium</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate4" value="Low" />
                                                <label for="candidate4" class="m-0">Low</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate5" value="Very Low" />
                                                <label for="candidate5" class="m-0">Very Low</label>
                                            </li>
                                            <div class="filter-footer" data-type="Openness">
                                                <button class="button-filter-cancel">Cancel</button>
                                                <button class="button-filter-apply">Filter</button>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="left-inner">
                                    <p>Candidate <span id="clearFilter">Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Candidate <iconify-icon icon="ep:arrow-down-bold" width="16"
                                                height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item candidateList"
                                            aria-labelledby="candidateDropdown" id="candidateList">
                                            {{-- JavaScript will populate this dynamically --}}
                                            <li class="filter-footer-item">
                                                <div class="filter-footer" data-type="Openness">
                                                    <button class="button-filter-cancel">Cancel</button>
                                                    <button class="button-filter-apply">Filter</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="right-filter">
                                <p style="margin-bottom: 24px;">Population Comparison</p>
                                <div class="left-filter">
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="carbon:building" width="22"
                                            height="22"></iconify-icon>
                                        <p>Company</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input companyToggleOpenness" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="entypo:flow-tree" width="22"
                                            height="22"></iconify-icon>
                                        <p>Department</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input departmentToggleOpenness" type="checkbox"
                                                role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="line-card card">
                        <div class="top-content">
                            <h3>30 Facts Openness to Experience</h3>
                            <p>Hover over the user icon to view their percentile and percentage score for each domains</p>
                        </div>
                        <div class="main-content">
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Often think creatively, engaging in imaginative thinking and exploring beyond the
                                        obvious.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 6%;">ML</span>
                                        <span class="circle circle-g" style="left: 7%;">G</span>
                                        <span class="circle circle-am" style="left: 13%;">AM</span>
                                        <span class="circle circle-ns" style="left: 29%;">NS</span>
                                        <span class="circle circle-ta" style="left: 29%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Highly value and are deeply moved by art and beauty, often seeking out artistic
                                        experiences for enrichment and inspiration.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -36%;">ML</span>
                                        <span class="circle circle-g" style="left: 8%;">G</span>
                                        <span class="circle circle-am" style="left: 2%;">AM</span>
                                        <span class="circle circle-ns" style="left: -4%;">NS</span>
                                        <span class="circle circle-ta" style="left: -30%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Are very open with their emotions, valuing emotional expression and experiencing
                                        feelings deeply and vividly.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -28%;">ML</span>
                                        <span class="circle circle-g" style="left: -5%;">G</span>
                                        <span class="circle circle-am" style="left: -18%;">AM</span>
                                        <span class="circle circle-ns" style="left: 0%;">NS</span>
                                        <span class="circle circle-ta" style="left: -20%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Thrive on variety and change, often seeking out new experiences and challenging
                                        the status quo to avoid monotony.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -1%;">ML</span>
                                        <span class="circle circle-g" style="left: 4%;">G</span>
                                        <span class="circle circle-am" style="left: -28%;">AM</span>
                                        <span class="circle circle-ns" style="left: 15.5%;">NS</span>
                                        <span class="circle circle-ta" style="left: 16%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Often think creatively, engaging in imaginative thinking and exploring beyond the
                                        obvious.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 24%;">ML</span>
                                        <span class="circle circle-g" style="left: -10%;">G</span>
                                        <span class="circle circle-am" style="left: 32%;">AM</span>
                                        <span class="circle circle-ns" style="left: -8%;">NS</span>
                                        <span class="circle circle-ta" style="left: -14%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Are very open with their emotions, valuing emotional expression and experiencing
                                        feelings deeply and vividly.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 35%;">ML</span>
                                        <span class="circle circle-g" style="left: -11%;">G</span>
                                        <span class="circle circle-am" style="left: 18%;">AM</span>
                                        <span class="circle circle-ns" style="left: -22%;">NS</span>
                                        <span class="circle circle-ta" style="left: 8%;">TA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="colors-overview">
                            <div class="overview-inner">
                                <span class="purple"></span>
                                <p>Very Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-purple"></span>
                                <p>Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-green"></span>
                                <p>Moderate</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal"></span>
                                <p>High</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal-dark"></span>
                                <p>Very High</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="id_30_Facets_Conscientiousness" role="tabpanel"
                    aria-labelledby="id_30_Facets_Conscientiousness-tab" tabindex="0">
                    <div class="filter-card card">
                        <h4>Filter</h4>
                        <div class="filter-inner">
                            <div class="left-filter">
                                <div class="left-inner">
                                    <p>Assessment Result <span>Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Assessment Result <iconify-icon icon="ep:arrow-down-bold"
                                                width="16" height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item" aria-labelledby="candidateDropdown">
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate1" value="Very High" />
                                                <label for="candidate1" class="m-0">Very High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate2" value="High" />
                                                <label for="candidate2" class="m-0">High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate3" value="Moderate" />
                                                <label for="candidate3" class="m-0">Medium</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate4" value="Low" />
                                                <label for="candidate4" class="m-0">Low</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate5" value="Very Low" />
                                                <label for="candidate5" class="m-0">Very Low</label>
                                            </li>
                                            <div class="filter-footer" data-type="Conscientiousness">
                                                <button class="button-filter-cancel">Cancel</button>
                                                <button class="button-filter-apply">Filter</button>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="left-inner">
                                    <p>Candidate <span id="clearFilter">Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Candidate <iconify-icon icon="ep:arrow-down-bold" width="16"
                                                height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item candidateList"
                                            aria-labelledby="candidateDropdown" id="candidateList">
                                            {{-- JavaScript will populate this dynamically --}}
                                            <li class="filter-footer-item">
                                                <div class="filter-footer" data-type="Conscientiousness">
                                                    <button class="button-filter-cancel">Cancel</button>
                                                    <button class="button-filter-apply">Filter</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="right-filter">
                                <p style="margin-bottom: 24px;">Population Comparison</p>
                                <div class="left-filter">
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="carbon:building" width="22"
                                            height="22"></iconify-icon>
                                        <p>Company</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input companyToggleConscientiousness" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="entypo:flow-tree" width="22"
                                            height="22"></iconify-icon>
                                        <p>Department</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input departmentToggleConscientiousness" type="checkbox"
                                                role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="line-card card">
                        <div class="top-content">
                            <h3>30 Facts Conscientiousness</h3>
                            <p>Hover over the user icon to view their percentile and percentage score for each domains</p>
                        </div>
                        <div class="main-content">
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Often think creatively, engaging in imaginative thinking and exploring beyond the
                                        obvious.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 6%;">ML</span>
                                        <span class="circle circle-g" style="left: 7%;">G</span>
                                        <span class="circle circle-am" style="left: 13%;">AM</span>
                                        <span class="circle circle-ns" style="left: 29%;">NS</span>
                                        <span class="circle circle-ta" style="left: 29%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Highly value and are deeply moved by art and beauty, often seeking out artistic
                                        experiences for enrichment and inspiration.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -36%;">ML</span>
                                        <span class="circle circle-g" style="left: 8%;">G</span>
                                        <span class="circle circle-am" style="left: 2%;">AM</span>
                                        <span class="circle circle-ns" style="left: -4%;">NS</span>
                                        <span class="circle circle-ta" style="left: -30%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Are very open with their emotions, valuing emotional expression and experiencing
                                        feelings deeply and vividly.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -28%;">ML</span>
                                        <span class="circle circle-g" style="left: -5%;">G</span>
                                        <span class="circle circle-am" style="left: -18%;">AM</span>
                                        <span class="circle circle-ns" style="left: 0%;">NS</span>
                                        <span class="circle circle-ta" style="left: -20%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Thrive on variety and change, often seeking out new experiences and challenging
                                        the status quo to avoid monotony.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -1%;">ML</span>
                                        <span class="circle circle-g" style="left: 4%;">G</span>
                                        <span class="circle circle-am" style="left: -28%;">AM</span>
                                        <span class="circle circle-ns" style="left: 15.5%;">NS</span>
                                        <span class="circle circle-ta" style="left: 16%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Often think creatively, engaging in imaginative thinking and exploring beyond the
                                        obvious.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 24%;">ML</span>
                                        <span class="circle circle-g" style="left: -10%;">G</span>
                                        <span class="circle circle-am" style="left: 32%;">AM</span>
                                        <span class="circle circle-ns" style="left: -8%;">NS</span>
                                        <span class="circle circle-ta" style="left: -14%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Are very open with their emotions, valuing emotional expression and experiencing
                                        feelings deeply and vividly.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 35%;">ML</span>
                                        <span class="circle circle-g" style="left: -11%;">G</span>
                                        <span class="circle circle-am" style="left: 18%;">AM</span>
                                        <span class="circle circle-ns" style="left: -22%;">NS</span>
                                        <span class="circle circle-ta" style="left: 8%;">TA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="colors-overview">
                            <div class="overview-inner">
                                <span class="purple"></span>
                                <p>Very Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-purple"></span>
                                <p>Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-green"></span>
                                <p>Moderate</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal"></span>
                                <p>High</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal-dark"></span>
                                <p>Very High</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="id_30_Facets_Extraversion" role="tabpanel"
                    aria-labelledby="id_30_Facets_Extraversion-tab" tabindex="0">
                    <div class="filter-card card">
                        <h4>Filter</h4>
                        <div class="filter-inner">
                            <div class="left-filter">
                                <div class="left-inner">
                                    <p>Assessment Result <span>Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Assessment Result <iconify-icon icon="ep:arrow-down-bold"
                                                width="16" height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item" aria-labelledby="candidateDropdown">
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate1" value="Very High" />
                                                <label for="candidate1" class="m-0">Very High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate2" value="High" />
                                                <label for="candidate2" class="m-0">High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate3" value="Moderate" />
                                                <label for="candidate3" class="m-0">Medium</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate4" value="Low" />
                                                <label for="candidate4" class="m-0">Low</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate5" value="Very Low" />
                                                <label for="candidate5" class="m-0">Very Low</label>
                                            </li>
                                            <div class="filter-footer" data-type="Extraversion">
                                                <button class="button-filter-cancel">Cancel</button>
                                                <button class="button-filter-apply">Filter</button>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="left-inner">
                                    <p>Candidate <span id="clearFilter">Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Candidate <iconify-icon icon="ep:arrow-down-bold" width="16"
                                                height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item candidateList"
                                            aria-labelledby="candidateDropdown" id="candidateList">
                                            {{-- JavaScript will populate this dynamically --}}
                                            <li class="filter-footer-item">
                                                <div class="filter-footer" data-type="Extraversion">
                                                    <button class="button-filter-cancel">Cancel</button>
                                                    <button class="button-filter-apply">Filter</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="right-filter">
                                <p style="margin-bottom: 24px;">Population Comparison</p>
                                <div class="left-filter">
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="carbon:building" width="22"
                                            height="22"></iconify-icon>
                                        <p>Company</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input companyToggleExtraversion" type="checkbox"
                                                role="switch">
                                        </div>
                                    </div>
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="entypo:flow-tree" width="22"
                                            height="22"></iconify-icon>
                                        <p>Department</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input departmentToggleExtraversion" type="checkbox"
                                                role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="line-card card">
                        <div class="top-content">
                            <h3>30 Facts Extraversion</h3>
                            <p>Hover over the user icon to view their percentile and percentage score for each domains</p>
                        </div>
                        <div class="main-content">
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Often think creatively, engaging in imaginative thinking and exploring beyond the
                                        obvious.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 6%;">ML</span>
                                        <span class="circle circle-g" style="left: 7%;">G</span>
                                        <span class="circle circle-am" style="left: 13%;">AM</span>
                                        <span class="circle circle-ns" style="left: 29%;">NS</span>
                                        <span class="circle circle-ta" style="left: 29%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Highly value and are deeply moved by art and beauty, often seeking out artistic
                                        experiences for enrichment and inspiration.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -36%;">ML</span>
                                        <span class="circle circle-g" style="left: 8%;">G</span>
                                        <span class="circle circle-am" style="left: 2%;">AM</span>
                                        <span class="circle circle-ns" style="left: -4%;">NS</span>
                                        <span class="circle circle-ta" style="left: -30%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Are very open with their emotions, valuing emotional expression and experiencing
                                        feelings deeply and vividly.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -28%;">ML</span>
                                        <span class="circle circle-g" style="left: -5%;">G</span>
                                        <span class="circle circle-am" style="left: -18%;">AM</span>
                                        <span class="circle circle-ns" style="left: 0%;">NS</span>
                                        <span class="circle circle-ta" style="left: -20%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Thrive on variety and change, often seeking out new experiences and challenging
                                        the status quo to avoid monotony.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -1%;">ML</span>
                                        <span class="circle circle-g" style="left: 4%;">G</span>
                                        <span class="circle circle-am" style="left: -28%;">AM</span>
                                        <span class="circle circle-ns" style="left: 15.5%;">NS</span>
                                        <span class="circle circle-ta" style="left: 16%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Often think creatively, engaging in imaginative thinking and exploring beyond the
                                        obvious.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 24%;">ML</span>
                                        <span class="circle circle-g" style="left: -10%;">G</span>
                                        <span class="circle circle-am" style="left: 32%;">AM</span>
                                        <span class="circle circle-ns" style="left: -8%;">NS</span>
                                        <span class="circle circle-ta" style="left: -14%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Are very open with their emotions, valuing emotional expression and experiencing
                                        feelings deeply and vividly.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 35%;">ML</span>
                                        <span class="circle circle-g" style="left: -11%;">G</span>
                                        <span class="circle circle-am" style="left: 18%;">AM</span>
                                        <span class="circle circle-ns" style="left: -22%;">NS</span>
                                        <span class="circle circle-ta" style="left: 8%;">TA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="colors-overview">
                            <div class="overview-inner">
                                <span class="purple"></span>
                                <p>Very Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-purple"></span>
                                <p>Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-green"></span>
                                <p>Moderate</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal"></span>
                                <p>High</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal-dark"></span>
                                <p>Very High</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="id_30_Facets_Agreeableness" role="tabpanel"
                    aria-labelledby="id_30_Facets_Agreeableness-tab" tabindex="0">
                    <div class="filter-card card">
                        <h4>Filter</h4>
                        <div class="filter-inner">
                            <div class="left-filter">
                                <div class="left-inner">
                                    <p>Assessment Result <span>Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Assessment Result <iconify-icon icon="ep:arrow-down-bold"
                                                width="16" height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item" aria-labelledby="candidateDropdown">
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate1" value="Very High" />
                                                <label for="candidate1" class="m-0">Very High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate2" value="High" />
                                                <label for="candidate2" class="m-0">High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate3" value="Moderate" />
                                                <label for="candidate3" class="m-0">Medium</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate4" value="Low" />
                                                <label for="candidate4" class="m-0">Low</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate5" value="Very Low" />
                                                <label for="candidate5" class="m-0">Very Low</label>
                                            </li>
                                            <div class="filter-footer" data-type="Agreeableness">
                                                <button class="button-filter-cancel">Cancel</button>
                                                <button class="button-filter-apply">Filter</button>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="left-inner">
                                    <p>Candidate <span id="clearFilter">Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Candidate <iconify-icon icon="ep:arrow-down-bold" width="16"
                                                height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item candidateList"
                                            aria-labelledby="candidateDropdown" id="candidateList">
                                            {{-- JavaScript will populate this dynamically --}}
                                            <li class="filter-footer-item">
                                                <div class="filter-footer" data-type="Agreeableness">
                                                    <button class="button-filter-cancel">Cancel</button>
                                                    <button class="button-filter-apply">Filter</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="right-filter">
                                <p style="margin-bottom: 24px;">Population Comparison</p>
                                <div class="left-filter">
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="carbon:building" width="22"
                                            height="22"></iconify-icon>
                                        <p>Company</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input companyToggleAgreeableness" type="checkbox"
                                                role="switch">
                                        </div>
                                    </div>
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="entypo:flow-tree" width="22"
                                            height="22"></iconify-icon>
                                        <p>Department</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input departmentToggleAgreeableness" type="checkbox"
                                                role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="line-card card">
                        <div class="top-content">
                            <h3>30 Facts Agreeableness</h3>
                            <p>Hover over the user icon to view their percentile and percentage score for each domains</p>
                        </div>
                        <div class="main-content">
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Often think creatively, engaging in imaginative thinking and exploring beyond the
                                        obvious.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 6%;">ML</span>
                                        <span class="circle circle-g" style="left: 7%;">G</span>
                                        <span class="circle circle-am" style="left: 13%;">AM</span>
                                        <span class="circle circle-ns" style="left: 29%;">NS</span>
                                        <span class="circle circle-ta" style="left: 29%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Highly value and are deeply moved by art and beauty, often seeking out artistic
                                        experiences for enrichment and inspiration.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -36%;">ML</span>
                                        <span class="circle circle-g" style="left: 8%;">G</span>
                                        <span class="circle circle-am" style="left: 2%;">AM</span>
                                        <span class="circle circle-ns" style="left: -4%;">NS</span>
                                        <span class="circle circle-ta" style="left: -30%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Are very open with their emotions, valuing emotional expression and experiencing
                                        feelings deeply and vividly.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -28%;">ML</span>
                                        <span class="circle circle-g" style="left: -5%;">G</span>
                                        <span class="circle circle-am" style="left: -18%;">AM</span>
                                        <span class="circle circle-ns" style="left: 0%;">NS</span>
                                        <span class="circle circle-ta" style="left: -20%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Thrive on variety and change, often seeking out new experiences and challenging
                                        the status quo to avoid monotony.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -1%;">ML</span>
                                        <span class="circle circle-g" style="left: 4%;">G</span>
                                        <span class="circle circle-am" style="left: -28%;">AM</span>
                                        <span class="circle circle-ns" style="left: 15.5%;">NS</span>
                                        <span class="circle circle-ta" style="left: 16%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Often think creatively, engaging in imaginative thinking and exploring beyond the
                                        obvious.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 24%;">ML</span>
                                        <span class="circle circle-g" style="left: -10%;">G</span>
                                        <span class="circle circle-am" style="left: 32%;">AM</span>
                                        <span class="circle circle-ns" style="left: -8%;">NS</span>
                                        <span class="circle circle-ta" style="left: -14%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Are very open with their emotions, valuing emotional expression and experiencing
                                        feelings deeply and vividly.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 35%;">ML</span>
                                        <span class="circle circle-g" style="left: -11%;">G</span>
                                        <span class="circle circle-am" style="left: 18%;">AM</span>
                                        <span class="circle circle-ns" style="left: -22%;">NS</span>
                                        <span class="circle circle-ta" style="left: 8%;">TA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="colors-overview">
                            <div class="overview-inner">
                                <span class="purple"></span>
                                <p>Very Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-purple"></span>
                                <p>Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-green"></span>
                                <p>Moderate</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal"></span>
                                <p>High</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal-dark"></span>
                                <p>Very High</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="id_30_Facets_Emotional_Stability" role="tabpanel"
                    aria-labelledby="id_30_Facets_Emotional_Stability-tab" tabindex="0">
                    <div class="filter-card card">
                        <h4>Filter</h4>
                        <div class="filter-inner">
                            <div class="left-filter">
                                <div class="left-inner">
                                    <p>Assessment Result <span>Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Assessment Result <iconify-icon icon="ep:arrow-down-bold"
                                                width="16" height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item" aria-labelledby="candidateDropdown">
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate1" value="Very High" />
                                                <label for="candidate1" class="m-0">Very High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate2" value="High" />
                                                <label for="candidate2" class="m-0">High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate3" value="Moderate" />
                                                <label for="candidate3" class="m-0">Medium</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate4" value="Low" />
                                                <label for="candidate4" class="m-0">Low</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate5" value="Very Low" />
                                                <label for="candidate5" class="m-0">Very Low</label>
                                            </li>
                                            <div class="filter-footer" data-type="Emotional Stability">
                                                <button class="button-filter-cancel">Cancel</button>
                                                <button class="button-filter-apply">Filter</button>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="left-inner">
                                    <p>Candidate <span id="clearFilter">Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Candidate <iconify-icon icon="ep:arrow-down-bold" width="16"
                                                height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item candidateList"
                                            aria-labelledby="candidateDropdown" id="candidateList">
                                            {{-- JavaScript will populate this dynamically --}}
                                            <li class="filter-footer-item">
                                                <div class="filter-footer" data-type="Emotional Stability">
                                                    <button class="button-filter-cancel">Cancel</button>
                                                    <button class="button-filter-apply">Filter</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="right-filter">
                                <p style="margin-bottom: 24px;">Population Comparison</p>
                                <div class="left-filter">
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="carbon:building" width="22"
                                            height="22"></iconify-icon>
                                        <p>Company</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input companyToggleEmotional" type="checkbox"
                                                role="switch">
                                        </div>
                                    </div>
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="entypo:flow-tree" width="22"
                                            height="22"></iconify-icon>
                                        <p>Department</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input departmentToggleEmotional" type="checkbox"
                                                role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="line-card card">
                        <div class="top-content">
                            <h3>30 Facts Emotional Stability</h3>
                            <p>Hover over the user icon to view their percentile and percentage score for each domains</p>
                        </div>
                        <div class="main-content">
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Often think creatively, engaging in imaginative thinking and exploring beyond the
                                        obvious.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 6%;">ML</span>
                                        <span class="circle circle-g" style="left: 7%;">G</span>
                                        <span class="circle circle-am" style="left: 13%;">AM</span>
                                        <span class="circle circle-ns" style="left: 29%;">NS</span>
                                        <span class="circle circle-ta" style="left: 29%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Highly value and are deeply moved by art and beauty, often seeking out artistic
                                        experiences for enrichment and inspiration.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -36%;">ML</span>
                                        <span class="circle circle-g" style="left: 8%;">G</span>
                                        <span class="circle circle-am" style="left: 2%;">AM</span>
                                        <span class="circle circle-ns" style="left: -4%;">NS</span>
                                        <span class="circle circle-ta" style="left: -30%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Are very open with their emotions, valuing emotional expression and experiencing
                                        feelings deeply and vividly.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -28%;">ML</span>
                                        <span class="circle circle-g" style="left: -5%;">G</span>
                                        <span class="circle circle-am" style="left: -18%;">AM</span>
                                        <span class="circle circle-ns" style="left: 0%;">NS</span>
                                        <span class="circle circle-ta" style="left: -20%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Thrive on variety and change, often seeking out new experiences and challenging
                                        the status quo to avoid monotony.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: -1%;">ML</span>
                                        <span class="circle circle-g" style="left: 4%;">G</span>
                                        <span class="circle circle-am" style="left: -28%;">AM</span>
                                        <span class="circle circle-ns" style="left: 15.5%;">NS</span>
                                        <span class="circle circle-ta" style="left: 16%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Often think creatively, engaging in imaginative thinking and exploring beyond the
                                        obvious.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 24%;">ML</span>
                                        <span class="circle circle-g" style="left: -10%;">G</span>
                                        <span class="circle circle-am" style="left: 32%;">AM</span>
                                        <span class="circle circle-ns" style="left: -8%;">NS</span>
                                        <span class="circle circle-ta" style="left: -14%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Openness to Experience</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>Are very open with their emotions, valuing emotional expression and experiencing
                                        feelings deeply and vividly.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 35%;">ML</span>
                                        <span class="circle circle-g" style="left: -11%;">G</span>
                                        <span class="circle circle-am" style="left: 18%;">AM</span>
                                        <span class="circle circle-ns" style="left: -22%;">NS</span>
                                        <span class="circle circle-ta" style="left: 8%;">TA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="colors-overview">
                            <div class="overview-inner">
                                <span class="purple"></span>
                                <p>Very Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-purple"></span>
                                <p>Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-green"></span>
                                <p>Moderate</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal"></span>
                                <p>High</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal-dark"></span>
                                <p>Very High</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="RIASEC" role="tabpanel" aria-labelledby="RIASEC-tab"
                    tabindex="0">
                    <div class="line-card card" style="gap: 45px;">
                        <div class="top-content">
                            <h3>RIASEC (Work Interest)</h3>
                            <p>View the top three RIASEC codes of each employees</p>
                        </div>
                        <div class="riasec-bottom">
                            <div class="riasec-inner">
                                <div class="riasec-left">RIS</div>
                                <div class="cog-content">
                                    <p style="margin-bottom: 15px;">RIS individuals excel in practical, analytical, and
                                        supportive roles, thriving in healthcare, environmental science and tech support
                                        with their blend of empathy and problem-solving skills.</p>
                                    <div class="filtered">
                                        <div class="states">
                                            <div class="filter-selected-black" style="background-color: #252F4A;">Mary
                                                Mary Lucillo-Interview Completed</div>
                                        </div>
                                        <div class="states">
                                            <div class="filter-selected-yellow" style="background-color: #FFC31F;">
                                                Gonzales-Employee</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin: 15px 0px;">
                            <div class="riasec-inner">
                                <div class="riasec-left">ISC</div>
                                <div class="cog-content">
                                    <p style="margin-bottom: 15px;">RIS individuals excel in practical, analytical, and
                                        supportive roles, thriving in healthcare, environmental science and tech support
                                        with their blend of empathy and problem-solving skills. </p>
                                    <div class="filtered">
                                        <div class="states">
                                            <div class="filter-selected-black" style="background-color: #AA91F4;">
                                                Ariel Cruz Mejia-Assessment Completed</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin: 15px 0px;">
                            <div class="riasec-inner">
                                <div class="riasec-left">AEC</div>
                                <div class="cog-content">
                                    <p style="margin-bottom: 15px;">RIS individuals excel in practical, analytical, and
                                        supportive roles, thriving in healthcare, environmental science and tech support
                                        with their blend of empathy and problem-solving skills. </p>
                                    <div class="filtered">
                                        <div class="states">
                                            <div class="filter-selected-black" style="background-color: #3FD0D0;">
                                                Nikki Galvez Sena-Employee</div>
                                        </div>
                                        <div class="states">
                                            <div class="filter-selected-yellow" style="background-color: #0C6464;">
                                                Timoteo Aricayos-Employee</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="Cognitive_Ability" role="tabpanel" aria-labelledby="cognitive-tab"
                    tabindex="0">
                    <div class="filter-card card">
                        <h4>Filter</h4>
                        <div class="filter-inner">
                            <div class="left-filter">
                                <div class="left-inner">
                                    <p>Assessment Result <span>Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Assessment Result <iconify-icon icon="ep:arrow-down-bold"
                                                width="16" height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item" aria-labelledby="candidateDropdown">
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate1" value="Very High" />
                                                <label for="candidate1" class="m-0">Very High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate2" value="High" />
                                                <label for="candidate2" class="m-0">High</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate3" value="Moderate" />
                                                <label for="candidate3" class="m-0">Medium</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate4" value="Low" />
                                                <label for="candidate4" class="m-0">Low</label>
                                            </li>
                                            <li class="filter-item">
                                                <input type="checkbox" id="candidate5" value="Very Low" />
                                                <label for="candidate5" class="m-0">Very Low</label>
                                            </li>
                                            <div class="filter-footer" data-type="Cognitive Ability">
                                                <button class="button-filter-cancel">Cancel</button>
                                                <button class="button-filter-apply">Filter</button>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <div class="left-inner">
                                    <p>Candidate <span id="clearFilter">Clear filter</span></p>
                                    <div class="dropdown">
                                        <button class="filter-dropdown" type="button" id="candidateDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Candidate <iconify-icon icon="ep:arrow-down-bold" width="16"
                                                height="16"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu filter-menu-item candidateList"
                                            aria-labelledby="candidateDropdown" id="candidateList">
                                            {{-- JavaScript will populate this dynamically --}}
                                            <li class="filter-footer-item">
                                                <div class="filter-footer" data-type="Cognitive Ability">
                                                    <button class="button-filter-cancel">Cancel</button>
                                                    <button class="button-filter-apply">Filter</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="line"></div>
                            <div class="right-filter">
                                <p style="margin-bottom: 24px;">Population Comparison</p>
                                <div class="left-filter">
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="carbon:building" width="22"
                                            height="22"></iconify-icon>
                                        <p>Company</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input companyToggle" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="left-inner right-inner">
                                        <iconify-icon icon="entypo:flow-tree" width="22"
                                            height="22"></iconify-icon>
                                        <p>Department</p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input departmentToggle" type="checkbox"
                                                role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="line-card card">
                        <div class="top-content">
                            <h3>Cognitive Ability</h3>
                            <p>Hover over the user icon to view their percentage score for each cognitive ability</p>
                        </div>
                        <div class="main-content">
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Quantative knowledge</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>The ability to reason numerical concepts and relationships, and to manipulate
                                        numerical symbols.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar light-yellow" style="width: 33.33%;"></div>
                                        <div class="progress-bar light-green" style="width: 33.33%;"></div>
                                        <div class="progress-bar teal" style="width: 33.33%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 3%;" data-bs-toggle="tooltip"
                                            data-bs-html="true"
                                            data-bs-title='<span class="cog-level-high cog-level">High</span>'>ML</span>
                                        <span class="circle circle-g" style="left: 3%;" data-bs-toggle="tooltip"
                                            data-bs-html="true"
                                            data-bs-title='<span class="cog-level-moderate cog-level">moderate</span>'>G</span>
                                        <span class="circle circle-am" style="left: 3%;" data-bs-toggle="tooltip"
                                            data-bs-html="true"
                                            data-bs-title='<span class="cog-level-low cog-level">low</span>'>AM</span>
                                        <span class="circle circle-ns" style="left: 28%;">NS</span>
                                        <span class="circle circle-ta" style="left: 28%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Comprehensive Knowledge</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>A person's acquired knowledge as well as ability to communicate knowledge and
                                        ability to reason using previously learned experiences or procedures.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar light-yellow" style="width: 33.33%;"></div>
                                        <div class="progress-bar light-green" style="width: 33.33%;"></div>
                                        <div class="progress-bar teal" style="width: 33.33%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 3%;">ML</span>
                                        <span class="circle circle-g" style="left: 34%;">G</span>
                                        <span class="circle circle-am" style="left: 34%;">AM</span>
                                        <span class="circle circle-ns" style="left: 0%;">NS</span>
                                        <span class="circle circle-ta" style="left: -6%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Visual Reasoning</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>The ability to perceive, analyse and synthesize visual patterns, and to think with
                                        visual patterns, including the ability to store and recall visual
                                        representations.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar light-yellow" style="width: 33.33%;"></div>
                                        <div class="progress-bar light-green" style="width: 33.33%;"></div>
                                        <div class="progress-bar teal" style="width: 33.33%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 4%;">ML</span>
                                        <span class="circle circle-g" style="left: 36%;">G</span>
                                        <span class="circle circle-am" style="left: 1%;">AM</span>
                                        <span class="circle circle-ns" style="left: 33%;">NS</span>
                                        <span class="circle circle-ta" style="left: 24%;">TA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>Fluid Reasoning</p>
                                        <div class="company firstUI" style="display: none;">
                                            <iconify-icon icon="carbon:building" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                        <div class="department secondUI" style="display: none;">
                                            <iconify-icon icon="entypo:flow-tree" width="20" class="icon"
                                                height="20"></iconify-icon>
                                            <p>AVERAGE SCORE: 85%</p>
                                        </div>
                                    </div>
                                    <span>The ability to reason, form concepts, and solve problems using unfamiliar
                                        information or novel procedures.</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress">
                                        <div class="progress-bar light-yellow" style="width: 33.33%;"></div>
                                        <div class="progress-bar light-green" style="width: 33.33%;"></div>
                                        <div class="progress-bar teal" style="width: 33.33%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center position-absolute w-100"
                                        style="top: -6px;">
                                        <span class="circle circle-ml" style="left: 6%;">ML</span>
                                        <span class="circle circle-g" style="left: 6%;">G</span>
                                        <span class="circle circle-am" style="left: -3%;">AM</span>
                                        <span class="circle circle-ns" style="left: 28%;">NS</span>
                                        <span class="circle circle-ta" style="left: 28%;">TA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="colors-overview">
                            <div class="overview-inner">
                                <span class="light-yellow"></span>
                                <p>Low</p>
                            </div>
                            <div class="overview-inner">
                                <span class="light-green"></span>
                                <p>Moderate</p>
                            </div>
                            <div class="overview-inner">
                                <span class="teal"></span>
                                <p>High</p>
                            </div>
                        </div>
                        {{-- <div class="cognitive-bottom">
                            <p>Candidates’ Overall Cognitive Ability</p>
                            <div class="cognitive-main">
                                <div class="cog-inner">
                                    <div class="cog-left">Low</div>
                                    <div class="cog-content">
                                        <p style="margin-bottom: 15px;">The individual exhibits a developing cognitive
                                            ability. There may be noticeable
                                            challenges in tackling medium to difficult level questions. This score also
                                            represents an opportunity for targeted learning and development. With structured
                                            support, practice, and exposure to more challenging situations, the individual
                                            has the capacity to improve and build their cognitive abilities over time.</p>
                                        <div class="filtered">
                                            <div class="states">
                                                <div class="filter-selected-black" style="background-color: #252F4A;">
                                                    Mary
                                                    Lucillo-Interview
                                                    Completed</div>
                                            </div>
                                            <div class="states">
                                                <div class="filter-selected-yellow" style="background-color: #FFC31F;">
                                                    Gonzales-Employee</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin: 15px 0px;">
                                <div class="cog-inner">
                                    <div class="cog-left">Moderate</div>
                                    <div class="cog-content">
                                        <p style="margin-bottom: 15px;">The individual embodies a moderate level of
                                            cognitive ability. While they may
                                            face occasional challenges with more complex scenarios, their ability to learn
                                            and apply information is evident. The moderate score suggests steady potential
                                            for growth with further practice and training.</p>
                                        <div class="filtered">
                                            <div class="states">
                                                <div class="filter-selected-black" style="background-color: #AA91F4;">
                                                    Ariel Cruz Mejia-Assessment Completed</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin: 15px 0px;">
                                <div class="cog-inner">
                                    <div class="cog-left">High</div>
                                    <div class="cog-content">
                                        <p style="margin-bottom: 15px;">The individual posesess a strong cognitive
                                            ability.
                                            Their performance across
                                            easy, medium, and difficult questions reflects a comprehensive grasp of concepts
                                            and an ability to think critically and adaptively. They consistently show high
                                            analytical abilities, quick learning, and effective decision-making skills,
                                            indicating that they can handle challenging tasks and situations with ease.</p>
                                        <div class="filtered">
                                            <div class="states">
                                                <div class="filter-selected-black" style="background-color: #3FD0D0;">
                                                    Nikki Galvez Sena-Employee</div>
                                            </div>
                                            <div class="states">
                                                <div class="filter-selected-yellow" style="background-color: #0C6464;">
                                                    Timoteo Aricayos-Employee</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        const dropdownItems = document.querySelectorAll('.dropdown-item');
        const dropdownButton = document.querySelector('.type-dropdown');
        dropdownItems.forEach((item) => {
            item.addEventListener('click', (e) => {
                dropdownItems.forEach((item) => item.classList.remove('active'));
                e.target.classList.add('active');
                dropdownButton.innerHTML = `
                ${e.target.textContent}
                <iconify-icon
                    icon="ep:arrow-down-bold"
                    width="16"
                    height="16"
                ></iconify-icon>
            `;
            });
        });
    </script>

    <script>
        var responseData = @json($responseData);
        var userColors = @json($userColors);

        let cognitiveCategories = {
            low: new Map(),
            moderate: new Map(),
            high: new Map()
        };


        document.addEventListener("DOMContentLoaded", function() {
            if (typeof populateOceanDomains === "function") {
                populateOceanDomains(responseData.users);
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            if (typeof populateRIASEC === "function") {
                populateRIASEC(responseData.users);
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const companyToggle = document.querySelector(".companyToggle");
            const departmentToggle = document.querySelector(".departmentToggle");

            function toggleVisibility(toggle, className, parentClass) {
                const elements = document.querySelectorAll(className);
                elements.forEach((element) => {
                    const parent = element.closest(parentClass);
                    if (toggle.checked) {
                        element.style.display = "flex";
                        parent.style.display = "block";
                    } else {
                        element.style.display = "none";
                        if (!parent.querySelector(".firstUI[style='display: flex;']") &&
                            !parent.querySelector(".secondUI[style='display: flex;']")) {
                            parent.style.display = "none";
                        }
                    }
                });
            }

            if (companyToggle) {
                companyToggle.addEventListener("change", () => {
                    toggleVisibility(companyToggle, ".firstUI", ".inner-text-heading");
                });
            }

            if (departmentToggle) {
                departmentToggle.addEventListener("change", () => {
                    toggleVisibility(departmentToggle, ".secondUI", ".inner-text-heading");
                });
            }

            // Ensure correct state on page load
            toggleVisibility(companyToggle, ".firstUI", ".inner-text-heading");
            toggleVisibility(departmentToggle, ".secondUI", ".inner-text-heading");
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector(".btn-yes").addEventListener("click", function () {
                window.location.href = "{{ route('admin.talent_acquisition.advanced_comparison') }}";
            });
        });
    </script>
    <script>
        $(document).on('click', '.add-comparison', function() {
            window.location.href = "{{ route('admin.talent_acquisition.advanced_comparison') }}";
        });
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('[role="tab"]'); // All tabs
            const tabPanes = document.querySelectorAll('.tab-pane'); // All tab panes
            const oceanModal = document.getElementById('clearModel') ? new bootstrap.Modal(document.getElementById(
                'clearModel')) : null;

            function activateTab(tab) {
                // Deactivate all tabs
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });

                // Deactivate all tab panes
                tabPanes.forEach(pane => {
                    pane.classList.remove('active', 'show');
                });

                // Activate the selected tab
                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');

                // Get the associated tab pane using `getElementById`
                let targetPaneId = tab.getAttribute('data-bs-target') || tab.getAttribute('href');
                if (targetPaneId) {
                    targetPaneId = targetPaneId.replace('#', ''); // Remove the leading #
                    const targetPane = document.getElementById(targetPaneId);
                    if (targetPane) {
                        targetPane.classList.add('active', 'show');
                    }
                }
            }

            function initializeActiveTab() {
                const activeTab = document.querySelector(
                    '[role="tab"].active'); // Find the tab that is already marked active
                if (activeTab) {
                    activateTab(activeTab);
                } else {
                    // Default to the first available tab
                    const firstTab = tabs[0];
                    if (firstTab) {
                        activateTab(firstTab);
                    }
                }
            }

            // Add click event listeners to all tabs
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    activateTab(this);
                });
            });

            // Initialize the active tab on page load
            initializeActiveTab();
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('[role="tab"]'); // All tabs
            const tabPanes = document.querySelectorAll('.tab-pane'); // All tab panes
            const oceanModal = document.getElementById('clearModel') ? new bootstrap.Modal(document.getElementById('clearModel')) : null;
    
            // Core tab activation function
            function activateTab(tab) {
                // Deactivate all tabs
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });
    
                // Deactivate all tab panes
                tabPanes.forEach(pane => {
                    pane.classList.remove('active', 'show');
                });
    
                // Activate the selected tab
                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');
    
                // Get the associated tab pane using `getElementById`
                let targetPaneId = tab.getAttribute('data-bs-target') || tab.getAttribute('href');
                if (targetPaneId) {
                    targetPaneId = targetPaneId.replace('#', ''); // Remove the leading #
                    const targetPane = document.getElementById(targetPaneId);
                    if (targetPane) {
                        setTimeout(() => {
                            targetPane.classList.add('active', 'show');
                            targetPane.scrollIntoView({ behavior: "smooth", block: "start" }); // optional UX
                        }, 50);
                    } else {
                        console.warn('Target pane not found for:', targetPaneId);
                    }
                } else {
                    console.warn('No data-bs-target or href found for tab:', tab);
                }
            }
    
            // Initialize the first tab or the currently active one
            function initializeActiveTab() {
                const activeTab = document.querySelector('[role="tab"].active');
                if (activeTab) {
                    activateTab(activeTab);
                } else {
                    const firstTab = tabs[0];
                    if (firstTab) {
                        activateTab(firstTab);
                    }
                }
            }
    
            // Add click event listeners to all <a role="tab">
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    activateTab(this);
                });
            });
    
            // ✅ NEW: Click on <li class="dropdown-item"> triggers its <a> tab activation
            document.querySelectorAll('.dropdown-item').forEach(li => {
                li.addEventListener('click', function () {
                    const tab = li.querySelector('[role="tab"]'); // Find the <a> inside the <li>
                    if (tab) {
                        activateTab(tab);
                    }
                });
            });
    
            // Reapply tab-pane classes if Bootstrap event is triggered
            document.querySelectorAll('[data-bs-toggle="pill"]').forEach(tab => {
                tab.addEventListener('shown.bs.tab', function (event) {
                    const target = event.target.getAttribute('data-bs-target') || event.target.getAttribute('href');
                    if (target) {
                        const targetPane = document.querySelector(target);
                        if (targetPane) {
                            targetPane.classList.add('active', 'show');
                        }
                    }
                });
            });
    
            // Run this on page load
            initializeActiveTab();
        });
    </script>
    

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Pass users from Laravel to JavaScript
            const users = @json($responseData['users']);
            console.log(users);

            // Target all dropdown lists with the class 'candidateList'
            const candidateLists = document.getElementsByClassName('candidateList');

            // Function to render candidate checkboxes inside dropdowns
            function renderCandidateDropdown(users) {
                Array.from(candidateLists).forEach(candidateList => {
                    // Find the existing filter footer inside this dropdown
                    const footer = candidateList.querySelector('.filter-footer-item');

                    // Clear existing content but keep the footer
                    candidateList.innerHTML = '';

                    // Add candidates dynamically
                    users.forEach(user => {
                        const fullName = `${user.first_name} ${user.last_name || ''}`.trim(); // Combine first and last name
                        const id = `${user.id}`; // Unique ID for each candidate
                        const candidateItem = document.createElement('li');
                        candidateItem.className = 'filter-item';
                        candidateItem.innerHTML = `
                            <input type="checkbox" class="candidate-checkbox" value="${id}" />
                            <label class="m-0">${fullName}</label>
                        `;
                        candidateList.appendChild(candidateItem);
                    });

                    // Append the footer back to ensure it stays in the dropdown
                    if (footer) {
                        candidateList.appendChild(footer);
                    } else {
                        console.warn("Footer not found inside", candidateList);
                    }
                });
            }

            // Initial render for all dropdowns
            renderCandidateDropdown(users);

            // Event delegation for filter buttons
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('button-filter-apply')) {
                    const selectedCandidates = [];

                    // Find the parent dropdown where the button was clicked
                    const parentDropdown = e.target.closest('.candidateList');
                    if (parentDropdown) {
                        const checkboxes = parentDropdown.getElementsByClassName('candidate-checkbox');
                        for (let checkbox of checkboxes) {
                            if (checkbox.checked) {
                                selectedCandidates.push(checkbox.value);
                            }
                        }
                        console.log('Selected Candidates:', selectedCandidates);
                    }
                }

                if (e.target.classList.contains('button-filter-cancel')) {
                    const parentDropdown = e.target.closest('.candidateList');
                    if (parentDropdown) {
                        const checkboxes = parentDropdown.getElementsByClassName('candidate-checkbox');
                        for (let checkbox of checkboxes) {
                            checkbox.checked = false;
                        }
                    }
                }
            });

            // Debugging: Check if footer exists
            const footer = document.querySelector('.filter-footer-item');
            console.log('Footer element:', footer);
        });

    </script>

    {{-- <script>
        // Pass the users from Laravel to JavaScript
        const users = @json($responseData['users']);
        console.log(users);

        // Target all dropdown lists with the class 'candidateList'
        const candidateLists = document.getElementsByClassName('candidateList');

        // Function to render candidate dropdowns for all candidate lists
        function renderCandidateDropdown(users) {
            Array.from(candidateLists).forEach(candidateList => {
                candidateList.innerHTML = ''; // Clear existing content

                // Add candidates dynamically
                users.forEach((user, index) => {
                    const fullName = `${user.first_name} ${user.last_name || ''}`
                        .trim(); // Concatenate first and last name
                    const candidateItem = document.createElement('li');
                    candidateItem.className = 'filter-item';
                    candidateItem.innerHTML = `
                <input type="checkbox" class="candidate-checkbox" value="${fullName}" />
                <label class="m-0">${fullName}</label>
            `;
                    candidateList.appendChild(candidateItem);
                });

                // Add the filter footer inside each <ul>
                const footerWrapper = document.createElement('li');
                footerWrapper.className = 'filter-footer-item';
                footerWrapper.innerHTML = `
            <div class="filter-footer">
                <button class="button-filter-cancel">Cancel</button>
                <button class="button-filter-apply">Filter</button>
            </div>
        `;
                candidateList.appendChild(footerWrapper);
            });
        }

        // Initial render for all dropdowns
        renderCandidateDropdown(users);

        // Event delegation for filter buttons
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('button-filter-apply')) {
                const selectedCandidates = [];

                // Find the parent dropdown where the button was clicked
                const parentDropdown = e.target.closest('.candidateList');
                if (parentDropdown) {
                    const checkboxes = parentDropdown.getElementsByClassName('candidate-checkbox');
                    for (let checkbox of checkboxes) {
                        if (checkbox.checked) {
                            selectedCandidates.push(checkbox.value);
                        }
                    }
                    console.log('Selected Candidates:', selectedCandidates);
                }
            }

            if (e.target.classList.contains('button-filter-cancel')) {
                const parentDropdown = e.target.closest('.candidateList');
                if (parentDropdown) {
                    const checkboxes = parentDropdown.getElementsByClassName('candidate-checkbox');
                    for (let checkbox of checkboxes) {
                        checkbox.checked = false;
                    }
                }
            }
        });
    </script> --}}
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const companyToggle = document.querySelector(".companyToggle");
            const departmentToggle = document.querySelector(".departmentToggle");
            const companyToggleOpenness = document.querySelector(".companyToggleOpenness");
            const departmentToggleOpenness = document.querySelector(".departmentToggleOpenness");
            const companyToggleConscientiousness = document.querySelector(".companyToggleConscientiousness");
            const departmentToggleConscientiousness = document.querySelector(".departmentToggleConscientiousness");
            const companyToggleExtraversion = document.querySelector(".companyToggleExtraversion");
            const departmentToggleExtraversion = document.querySelector(".departmentToggleExtraversion");
            const companyToggleAgreeableness = document.querySelector(".companyToggleAgreeableness");
            const departmentToggleAgreeableness = document.querySelector(".departmentToggleAgreeableness");
            const companyToggleEmotional = document.querySelector(".companyToggleEmotional");
            const departmentToggleEmotional = document.querySelector(".departmentToggleEmotional");

            // Data from the backend
            let responseData = @json($responseData);

            // Helper function to ensure data is an array
            function validateArray(data) {
                if (Array.isArray(data)) {
                    return data;
                } else if (typeof data === "object" && data !== null) {
                    return Object.values(data); // Convert object properties into an array
                }
                return []; // Return empty array if data is invalid
            }

            function toggleVisibility() {
                const companyElements = document.querySelectorAll(".company.firstUI");
                const departmentElements = document.querySelectorAll(".department.secondUI");

                companyElements.forEach(el => {
                    if (companyToggle.checked || companyToggleOpenness.checked || companyToggleConscientiousness.checked || companyToggleExtraversion.checked || companyToggleAgreeableness.checked || companyToggleEmotional.checked) {
                        el.classList.remove("displayNone");
                    } else {
                        el.classList.add("displayNone");
                    }
                });

                departmentElements.forEach(el => {
                    if (departmentToggle.checked || departmentToggleOpenness.checked || departmentToggleConscientiousness.checked || departmentToggleExtraversion.checked || departmentToggleAgreeableness.checked || departmentToggleEmotional.checked) {
                        el.classList.remove("displayNone");
                    } else {
                        el.classList.add("displayNone");
                    }
                });
            }

            // Helper function to filter valid users
            function filterValidUsers(data) {
                return validateArray(data).filter(user => !user.removed);
            }


            function generateUserInitials(user) {
                const firstName = user.user?.first_name || "";
                const lastName = user.user?.last_name || "";
                return firstName && lastName ? firstName.charAt(0).toUpperCase() + lastName.charAt(0)
                    .toUpperCase() : (firstName.charAt(0).toUpperCase() || "?");
            }

            function getLevelClass(level) {
                switch (level.toLowerCase()) {
                    case "very low":
                        return "very-low";
                    case "low":
                        return "low";
                    case "moderate":
                        return "moderate";
                    case "high":
                        return "high";
                    case "very high":
                        return "very-high";
                    default:
                        return "unknown";
                }
            }

            function populateOceanDomains(data) {
                const container = document.querySelector("#OCEAN_Domains .main-content");
                container.innerHTML = ""; // Clear previous content

                const validatedData = filterValidUsers(data);
                if (validatedData.length === 0) {
                    container.innerHTML = "<p>No data available for OCEAN Domains.</p>";
                    return;
                }

                let domainUsers = {};
                let domainDescriptions = {};

                validatedData.forEach(user => {
                    if (!user || !user.oceanDomainResult) return;

                    const oceanData = Object.values(user.oceanDomainResult);
                    oceanData.forEach(domain => {
                        if (!domainUsers[domain.name]) {
                            domainUsers[domain.name] = [];
                            domainDescriptions[domain.name] = domain.description;
                        }
                        domainUsers[domain.name].push({
                            id: user.user_id,
                            initials: generateUserInitials(user),
                            fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`
                                .trim(),
                            percentage: domain.percentage || 0,
                            levelClass: getLevelClass(domain.level_description),
                            backgroundColor: userColors[user.user_id] || "#000"
                        });
                    });
                });

                // Loop through each domain to process data
                Object.keys(domainUsers).forEach(domain => {
                    if (!domainUsers[domain] || domainUsers[domain].length === 0) return;

                    // Sort users by percentage (optional)
                    domainUsers[domain].sort((a, b) => a.percentage - b.percentage);

                    // Recalculate the average score after removal
                    let totalScore = domainUsers[domain].reduce((sum, user) => sum + user.percentage, 0);

                    const domainKeyMap = {
                        "Openness to Experience": "openness-to-experience",
                        "Conscientiousness": "conscientiousness",
                        "Extraversion": "extraversion",
                        "Agreeableness": "agreeableness",
                        "Emotional Stability": "emotional-stability"
                    };

                    // Determine which data source to use based on toggles
                    let avgScore;
                    const domainKey = domainKeyMap[domain];

                    if (companyToggle.checked && responseData.companyAverage?.domains?.[domainKey]) {
                        // Use Company Average if the toggle is enabled
                        avgScore = (responseData.companyAverage.domains[domainKey] / 0.05).toFixed(2);
                    } 
                    else if (departmentToggle.checked && responseData.departmentAverage?.domains?.[domainKey] && !companyToggle.checked) {
                        // Use Department Average only if Company Toggle is OFF
                        avgScore = (responseData.departmentAverage.domains[domainKey] / 0.05).toFixed(2);
                    } 
                    else {
                        // Default calculation based on user data if both toggles are OFF
                        avgScore = domainUsers[domain].length > 0 
                            ? (totalScore / domainUsers[domain].length).toFixed(2) 
                            : "0.00";
                    }




                    // Group users by percentile for stacking
                    let stackedUsers = {};
                    domainUsers[domain].forEach(user => {
                        if (!stackedUsers[user.percentage]) {
                            stackedUsers[user.percentage] = [];
                        }
                        stackedUsers[user.percentage].push(user);
                    });

                    let userBadges = Object.keys(stackedUsers).map(percentile => {
                        let stackedIcons = stackedUsers[percentile].map((user, index) => {
                            let topOffset = index *
                            20; // Adjust stacking distance between icons
                            return `
                        <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index};"
                            data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                            data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                            <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                            <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                            <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                ${user.initials}
                            </div>
                        </span>
                    `;
                        }).join('');
                        return stackedIcons;
                    }).join('');

                    // Display dynamic average score
                    let companyInfo = companyToggle.checked ?
                        `<div class="company firstUI displayNone"><iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon><p>AVERAGE SCORE: ${avgScore}%</p></div>` :
                        "";

                    let departmentInfo = departmentToggle.checked ?
                        `<div class="department secondUI displayNone"><iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon><p>AVERAGE SCORE: ${avgScore}%</p></div>` :
                        "";

                    let html = `
                <div class="inner-main">
                    <div class="inner-text">
                        <div class="inner-text-heading">
                            <p>${domain}</p>
                            ${companyInfo}
                            ${departmentInfo}
                        </div>
                        <span>${domainDescriptions[domain]}</span>
                    </div>
                    <div class="position-relative">
                        <div class="progress" style="position: relative;">
                            <div class="progress-bar purple" style="width: 10%;"></div>
                            <div class="progress-bar light-purple" style="width: 18%;"></div>
                            <div class="progress-bar light-green" style="width: 44%;"></div>
                            <div class="progress-bar teal" style="width: 18%;"></div>
                            <div class="progress-bar teal-dark" style="width: 10%;"></div>
                        </div>
                        <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                            ${userBadges}
                        </div>
                    </div>
                </div>
                `;
                    container.innerHTML += html;
                });
                toggleVisibility(); 
                enableTooltips();
            }

            function capitalizeFirstLetter(string) {
                return string.replace(/-/g, ' ') // Replace hyphens with spaces
                            .replace(/\b\w/g, char => char.toUpperCase()); // Capitalize first letter of each word
            }

            function populate_Openness_to_Experience(data) {
                const traitConfig = {
                    traitName: "Openness to Experience",
                    traitSlugs: ["daydreaming", "aesthetic-appreciation", "feeling-aware", "explorer", "innovation", "open-mindedness"],
                    containerId: "#id_30_Facets_Openness_to_Experience .main-content"
                };

                const { traitName, traitSlugs, containerId } = traitConfig;
                    const container = document.querySelector(containerId);
                    if (!container) return;

                    container.innerHTML = "";
                    const validatedData = filterValidUsers(data);
                    if (validatedData.length === 0) {
                        container.innerHTML = `<p>No data available for ${traitName}.</p>`;
                        return;
                    }

                    let facetUsers = {};
                    let facetDescriptions = {};

                    validatedData.forEach(user => {
                        if (!user || !user.oceanAllFacetsResult) return;

                        // ✅ Ensure oceanAllFacetsResult is treated as an object
                        const facets = Object.entries(user.oceanAllFacetsResult || {});

                        facets.forEach(([facetKey, facet]) => {
                            if (traitSlugs.includes(facet.slug)) {
                                if (!facetUsers[facetKey]) {
                                    facetUsers[facetKey] = [];
                                    facetDescriptions[facetKey] = facet.description;
                                }

                                facetUsers[facetKey].push({
                                    id: user.user_id,
                                    initials: generateUserInitials(user),
                                    fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim(),
                                    percentage: facet.percentage || 0,
                                    levelClass: getLevelClass(facet.level_description),
                                    backgroundColor: userColors[user.user_id] || "#000"
                                });
                            }
                        });
                    });

                    Object.keys(facetUsers).forEach(facetKey => {
                        if (!facetUsers[facetKey] || facetUsers[facetKey].length === 0) return;

                        facetUsers[facetKey].sort((a, b) => a.percentage - b.percentage);

                        let totalScore = facetUsers[facetKey].reduce((sum, user) => sum + user.percentage, 0);
                        let avgScore;

                        const companyOpennessToggle = companyToggleOpenness.checked;
                        const departmentOpennessToggle = departmentToggleOpenness.checked;

                        if (companyOpennessToggle && responseData.companyAverage?.all_facets?.[facetKey]) {
                            avgScore = (responseData.companyAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else if (departmentOpennessToggle && responseData.departmentAverage?.all_facets?.[facetKey] && !companyOpennessToggle) {
                            avgScore = (responseData.departmentAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else {
                            avgScore = facetUsers[facetKey].length ? (totalScore / facetUsers[facetKey].length).toFixed(2) : "0.00";
                        }

                        let stackedUsers = {};
                        facetUsers[facetKey].forEach(user => {
                            if (!stackedUsers[user.percentage]) {
                                stackedUsers[user.percentage] = [];
                            }
                            stackedUsers[user.percentage].push(user);
                        });

                        let userBadges = Object.keys(stackedUsers).map(percentile => {
                            return stackedUsers[percentile].map((user, index) => {
                                let topOffset = index * -20;
                                return `
                                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index}; position: absolute;"
                                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                                        data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                                        <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                                        <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                            ${user.initials}
                                        </div>
                                    </span>
                                `;
                            }).join('');
                        }).join('');

                        // Display dynamic average score
                        let companyInfo = companyOpennessToggle ? `
                            <div class="company firstUI displayNone">
                                <iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";

                        let departmentInfo = departmentOpennessToggle ? `
                            <div class="department secondUI displayNone">
                                <iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";
                            
                        let html = `
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>${capitalizeFirstLetter(facetKey)}</p>
                                        ${companyInfo}
                                        ${departmentInfo}
                                    </div>
                                    <span>${facetDescriptions[facetKey]}</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                                        ${userBadges}
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += html;
                    });
                    
                toggleVisibility(); 
                enableTooltips();
            }


            function populate_Conscientiousness(data) {
                const traitConfig = {
                    traitName: "Conscientiousness",
                    traitSlugs: ["self-confidence", "tidiness", "responsibility", "drive-to-achieve", "willpower", "careful-thinking"],
                    containerId: "#id_30_Facets_Conscientiousness .main-content"
                };

                const { traitName, traitSlugs, containerId } = traitConfig;
                    const container = document.querySelector(containerId);
                    if (!container) return;

                    container.innerHTML = "";
                    const validatedData = filterValidUsers(data);
                    if (validatedData.length === 0) {
                        container.innerHTML = `<p>No data available for ${traitName}.</p>`;
                        return;
                    }

                    let facetUsers = {};
                    let facetDescriptions = {};

                    validatedData.forEach(user => {
                        if (!user || !user.oceanAllFacetsResult) return;

                        // ✅ Ensure oceanAllFacetsResult is treated as an object
                        const facets = Object.entries(user.oceanAllFacetsResult || {});

                        facets.forEach(([facetKey, facet]) => {
                            if (traitSlugs.includes(facet.slug)) {
                                if (!facetUsers[facetKey]) {
                                    facetUsers[facetKey] = [];
                                    facetDescriptions[facetKey] = facet.description;
                                }

                                facetUsers[facetKey].push({
                                    id: user.user_id,
                                    initials: generateUserInitials(user),
                                    fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim(),
                                    percentage: facet.percentage || 0,
                                    levelClass: getLevelClass(facet.level_description),
                                    backgroundColor: userColors[user.user_id] || "#000"
                                });
                            }
                        });
                    });

                    Object.keys(facetUsers).forEach(facetKey => {
                        if (!facetUsers[facetKey] || facetUsers[facetKey].length === 0) return;

                        facetUsers[facetKey].sort((a, b) => a.percentage - b.percentage);

                        let totalScore = facetUsers[facetKey].reduce((sum, user) => sum + user.percentage, 0);
                        let avgScore;

                        const companyConscientiousnessToggle = companyToggleConscientiousness.checked;
                        const departmentConscientiousnessToggle = departmentToggleConscientiousness.checked;

                        if (companyConscientiousnessToggle && responseData.companyAverage?.all_facets?.[facetKey]) {
                            avgScore = (responseData.companyAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else if (departmentConscientiousnessToggle && responseData.departmentAverage?.all_facets?.[facetKey] && !companyConscientiousnessToggle) {
                            avgScore = (responseData.departmentAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else {
                            avgScore = facetUsers[facetKey].length ? (totalScore / facetUsers[facetKey].length).toFixed(2) : "0.00";
                        }

                        let stackedUsers = {};
                        facetUsers[facetKey].forEach(user => {
                            if (!stackedUsers[user.percentage]) {
                                stackedUsers[user.percentage] = [];
                            }
                            stackedUsers[user.percentage].push(user);
                        });

                        let userBadges = Object.keys(stackedUsers).map(percentile => {
                            return stackedUsers[percentile].map((user, index) => {
                                let topOffset = index * -20;
                                return `
                                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index}; position: absolute;"
                                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                                        data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                                        <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                                        <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                            ${user.initials}
                                        </div>
                                    </span>
                                `;
                            }).join('');
                        }).join('');

                        // Display dynamic average score
                        let companyInfo = companyConscientiousnessToggle ? `
                            <div class="company firstUI displayNone">
                                <iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";

                        let departmentInfo = departmentConscientiousnessToggle ? `
                            <div class="department secondUI displayNone">
                                <iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";
                            
                        let html = `
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>${capitalizeFirstLetter(facetKey)}</p>
                                        ${companyInfo}
                                        ${departmentInfo}
                                    </div>
                                    <span>${facetDescriptions[facetKey]}</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                                        ${userBadges}
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += html;
                    });
                    
                toggleVisibility(); 
                enableTooltips();
            }


            function populate_Extraversion(data) {
                const traitConfig = {
                    traitName: "Extraversion",
                    traitSlugs: ["sociability", "crowd-enjoyment", "confidence", "energetic-lifestyle", "thrill-seeking", "optimism"],
                    containerId: "#id_30_Facets_Extraversion .main-content"
                };

                const { traitName, traitSlugs, containerId } = traitConfig;
                    const container = document.querySelector(containerId);
                    if (!container) return;

                    container.innerHTML = "";
                    const validatedData = filterValidUsers(data);
                    if (validatedData.length === 0) {
                        container.innerHTML = `<p>No data available for ${traitName}.</p>`;
                        return;
                    }

                    let facetUsers = {};
                    let facetDescriptions = {};

                    validatedData.forEach(user => {
                        if (!user || !user.oceanAllFacetsResult) return;

                        // ✅ Ensure oceanAllFacetsResult is treated as an object
                        const facets = Object.entries(user.oceanAllFacetsResult || {});

                        facets.forEach(([facetKey, facet]) => {
                            if (traitSlugs.includes(facet.slug)) {
                                if (!facetUsers[facetKey]) {
                                    facetUsers[facetKey] = [];
                                    facetDescriptions[facetKey] = facet.description;
                                }

                                facetUsers[facetKey].push({
                                    id: user.user_id,
                                    initials: generateUserInitials(user),
                                    fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim(),
                                    percentage: facet.percentage || 0,
                                    levelClass: getLevelClass(facet.level_description),
                                    backgroundColor: userColors[user.user_id] || "#000"
                                });
                            }
                        });
                    });

                    Object.keys(facetUsers).forEach(facetKey => {
                        if (!facetUsers[facetKey] || facetUsers[facetKey].length === 0) return;

                        facetUsers[facetKey].sort((a, b) => a.percentage - b.percentage);

                        let totalScore = facetUsers[facetKey].reduce((sum, user) => sum + user.percentage, 0);
                        let avgScore;

                        const companyExtraversionToggle = companyToggleExtraversion.checked;
                        const departmentExtraversionToggle = departmentToggleExtraversion.checked;

                        if (companyExtraversionToggle && responseData.companyAverage?.all_facets?.[facetKey]) {
                            avgScore = (responseData.companyAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else if (departmentExtraversionToggle && responseData.departmentAverage?.all_facets?.[facetKey] && !companyExtraversionToggle) {
                            avgScore = (responseData.departmentAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else {
                            avgScore = facetUsers[facetKey].length ? (totalScore / facetUsers[facetKey].length).toFixed(2) : "0.00";
                        }

                        let stackedUsers = {};
                        facetUsers[facetKey].forEach(user => {
                            if (!stackedUsers[user.percentage]) {
                                stackedUsers[user.percentage] = [];
                            }
                            stackedUsers[user.percentage].push(user);
                        });

                        let userBadges = Object.keys(stackedUsers).map(percentile => {
                            return stackedUsers[percentile].map((user, index) => {
                                let topOffset = index * -20;
                                return `
                                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index}; position: absolute;"
                                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                                        data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                                        <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                                        <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                            ${user.initials}
                                        </div>
                                    </span>
                                `;
                            }).join('');
                        }).join('');

                        // Display dynamic average score
                        let companyInfo = companyExtraversionToggle ? `
                            <div class="company firstUI displayNone">
                                <iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";

                        let departmentInfo = departmentExtraversionToggle ? `
                            <div class="department secondUI displayNone">
                                <iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";
                            
                        let html = `
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>${capitalizeFirstLetter(facetKey)}</p>
                                        ${companyInfo}
                                        ${departmentInfo}
                                    </div>
                                    <span>${facetDescriptions[facetKey]}</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                                        ${userBadges}
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += html;
                    });
                    
                toggleVisibility(); 
                enableTooltips();
            }


            function populate_Agreeableness(data) {
                const traitConfig = {
                    traitName: "Agreeableness",
                    traitSlugs: ["belief", "honesty", "helpfulness", "diplomacy", "humility", "compassion"],
                    containerId: "#id_30_Facets_Agreeableness .main-content"
                };

                const { traitName, traitSlugs, containerId } = traitConfig;
                    const container = document.querySelector(containerId);
                    if (!container) return;

                    container.innerHTML = "";
                    const validatedData = filterValidUsers(data);
                    if (validatedData.length === 0) {
                        container.innerHTML = `<p>No data available for ${traitName}.</p>`;
                        return;
                    }

                    let facetUsers = {};
                    let facetDescriptions = {};

                    validatedData.forEach(user => {
                        if (!user || !user.oceanAllFacetsResult) return;

                        // ✅ Ensure oceanAllFacetsResult is treated as an object
                        const facets = Object.entries(user.oceanAllFacetsResult || {});

                        facets.forEach(([facetKey, facet]) => {
                            if (traitSlugs.includes(facet.slug)) {
                                if (!facetUsers[facetKey]) {
                                    facetUsers[facetKey] = [];
                                    facetDescriptions[facetKey] = facet.description;
                                }

                                facetUsers[facetKey].push({
                                    id: user.user_id,
                                    initials: generateUserInitials(user),
                                    fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim(),
                                    percentage: facet.percentage || 0,
                                    levelClass: getLevelClass(facet.level_description),
                                    backgroundColor: userColors[user.user_id] || "#000"
                                });
                            }
                        });
                    });

                    Object.keys(facetUsers).forEach(facetKey => {
                        if (!facetUsers[facetKey] || facetUsers[facetKey].length === 0) return;

                        facetUsers[facetKey].sort((a, b) => a.percentage - b.percentage);

                        let totalScore = facetUsers[facetKey].reduce((sum, user) => sum + user.percentage, 0);
                        let avgScore;

                        const companyAgreeablenessToggle = companyToggleAgreeableness.checked;
                        const departmentAgreeablenessToggle = departmentToggleAgreeableness.checked;

                        if (companyAgreeablenessToggle && responseData.companyAverage?.all_facets?.[facetKey]) {
                            avgScore = (responseData.companyAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else if (departmentAgreeablenessToggle && responseData.departmentAverage?.all_facets?.[facetKey] && !companyAgreeablenessToggle) {
                            avgScore = (responseData.departmentAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else {
                            avgScore = facetUsers[facetKey].length ? (totalScore / facetUsers[facetKey].length).toFixed(2) : "0.00";
                        }

                        let stackedUsers = {};
                        facetUsers[facetKey].forEach(user => {
                            if (!stackedUsers[user.percentage]) {
                                stackedUsers[user.percentage] = [];
                            }
                            stackedUsers[user.percentage].push(user);
                        });

                        let userBadges = Object.keys(stackedUsers).map(percentile => {
                            return stackedUsers[percentile].map((user, index) => {
                                let topOffset = index * -20;
                                return `
                                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index}; position: absolute;"
                                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                                        data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                                        <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                                        <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                            ${user.initials}
                                        </div>
                                    </span>
                                `;
                            }).join('');
                        }).join('');

                        // Display dynamic average score
                        let companyInfo = companyAgreeablenessToggle ? `
                            <div class="company firstUI displayNone">
                                <iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";

                        let departmentInfo = departmentAgreeablenessToggle ? `
                            <div class="department secondUI displayNone">
                                <iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";
                            
                        let html = `
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>${capitalizeFirstLetter(facetKey)}</p>
                                        ${companyInfo}
                                        ${departmentInfo}
                                    </div>
                                    <span>${facetDescriptions[facetKey]}</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                                        ${userBadges}
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += html;
                    });
                    
                toggleVisibility(); 
                enableTooltips();
            }


            function populate_Emotional_Stability(data) {
                const traitConfig = {
                    traitName: "Emotional Stability",
                    traitSlugs: ["steadiness", "tolerance", "positivity", "social-sensitivity", "impulse-control", "stress-response"],
                    containerId: "#id_30_Facets_Emotional_Stability .main-content"
                };

                const { traitName, traitSlugs, containerId } = traitConfig;
                    const container = document.querySelector(containerId);
                    if (!container) return;

                    container.innerHTML = "";
                    const validatedData = filterValidUsers(data);
                    if (validatedData.length === 0) {
                        container.innerHTML = `<p>No data available for ${traitName}.</p>`;
                        return;
                    }

                    let facetUsers = {};
                    let facetDescriptions = {};

                    validatedData.forEach(user => {
                        if (!user || !user.oceanAllFacetsResult) return;

                        // ✅ Ensure oceanAllFacetsResult is treated as an object
                        const facets = Object.entries(user.oceanAllFacetsResult || {});

                        facets.forEach(([facetKey, facet]) => {
                            if (traitSlugs.includes(facet.slug)) {
                                if (!facetUsers[facetKey]) {
                                    facetUsers[facetKey] = [];
                                    facetDescriptions[facetKey] = facet.description;
                                }

                                facetUsers[facetKey].push({
                                    id: user.user_id,
                                    initials: generateUserInitials(user),
                                    fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim(),
                                    percentage: facet.percentage || 0,
                                    levelClass: getLevelClass(facet.level_description),
                                    backgroundColor: userColors[user.user_id] || "#000"
                                });
                            }
                        });
                    });

                    Object.keys(facetUsers).forEach(facetKey => {
                        if (!facetUsers[facetKey] || facetUsers[facetKey].length === 0) return;

                        facetUsers[facetKey].sort((a, b) => a.percentage - b.percentage);

                        let totalScore = facetUsers[facetKey].reduce((sum, user) => sum + user.percentage, 0);
                        let avgScore;

                        const companyEmotionalToggle = companyToggleEmotional.checked;
                        const departmentEmotionalToggle = departmentToggleEmotional.checked;

                        if (companyEmotionalToggle && responseData.companyAverage?.all_facets?.[facetKey]) {
                            avgScore = (responseData.companyAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else if (departmentEmotionalToggle && responseData.departmentAverage?.all_facets?.[facetKey] && !companyEmotionalToggle) {
                            avgScore = (responseData.departmentAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else {
                            avgScore = facetUsers[facetKey].length ? (totalScore / facetUsers[facetKey].length).toFixed(2) : "0.00";
                        }

                        let stackedUsers = {};
                        facetUsers[facetKey].forEach(user => {
                            if (!stackedUsers[user.percentage]) {
                                stackedUsers[user.percentage] = [];
                            }
                            stackedUsers[user.percentage].push(user);
                        });

                        let userBadges = Object.keys(stackedUsers).map(percentile => {
                            return stackedUsers[percentile].map((user, index) => {
                                let topOffset = index * -20;
                                return `
                                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index}; position: absolute;"
                                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                                        data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                                        <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                                        <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                            ${user.initials}
                                        </div>
                                    </span>
                                `;
                            }).join('');
                        }).join('');

                        // Display dynamic average score
                        let companyInfo = companyEmotionalToggle ? `
                            <div class="company firstUI displayNone">
                                <iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";

                        let departmentInfo = departmentEmotionalToggle ? `
                            <div class="department secondUI displayNone">
                                <iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";
                            
                        let html = `
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>${capitalizeFirstLetter(facetKey)}</p>
                                        ${companyInfo}
                                        ${departmentInfo}
                                    </div>
                                    <span>${facetDescriptions[facetKey]}</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                                        ${userBadges}
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += html;
                    });
                    
                toggleVisibility(); 
                enableTooltips();
            }




            // Populate RIASEC data

            function populateRIASEC(data) {
                const container = document.querySelector("#RIASEC .riasec-bottom");
                container.innerHTML = ""; // Clear existing content

                const validatedData = filterValidUsers(data);
                if (validatedData.length === 0) {
                    container.innerHTML = "<p>No data available for RIASEC.</p>";
                    return;
                }

                validatedData.forEach((user) => {
                    if (!user.user) {
                        console.warn("Skipping user due to missing user details:", user);
                        return;
                    }

                    const userId = user.user_id;
                    const riasecData = user.riasecTop3Result || {};
                    const assignedColor = userColors[userId] ||
                        "#000"; // Default to black if no color assigned

                    const html = `
                <div class="riasec-inner" id="riasec-user-${userId}">
                    <div class="riasec-left">${riasecData.string || "N/A"}</div>
                    <div class="cog-content">
                        <p>${riasecData.description || "N/A"}</p>
                        <div class="filtered">
                            <div class="states">
                                <div class="filter-selected" style="background-color: ${assignedColor};">
                                    ${user.user.first_name || "Unknown"} ${user.user.last_name || ""} - ${user.user.role_name || "N/A"}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            `;
                    container.innerHTML += html;
                });
            }



            function populateCognitiveAbility(data) {
                const container = document.querySelector("#Cognitive_Ability .main-content");
                if (!container) {
                    console.error("Cognitive Ability container not found.");
                    return;
                }

                container.innerHTML = ""; // Clear existing content

                const validatedData = filterValidUsers(data);
                if (validatedData.length === 0) {
                    container.innerHTML = "<p>No data available for Cognitive Ability.</p>";
                    return;
                }

                let cognitiveGroups = {};
                let cognitiveCategories = {
                    low: new Map(),
                    moderate: new Map(),
                    high: new Map()
                };

                validatedData.forEach((user) => {
                    if (!user.cognitiveDomainResult || Object.keys(user.cognitiveDomainResult).length ===
                        0) {
                        console.warn(`No cognitiveDomainResult for user ${user.user?.first_name}`);
                        return;
                    }

                    Object.values(user.cognitiveDomainResult).forEach((domain) => {
                        if (!domain.name || !domain.description) {
                            console.warn("Invalid domain data:", domain);
                            return;
                        }

                        if (!cognitiveGroups[domain.name]) {
                            cognitiveGroups[domain.name] = {
                                description: domain.description,
                                users: []
                            };
                        }

                        const userData = {
                            id: user.user_id,
                            initials: generateUserInitials(user),
                            fullName: `${user.user?.first_name} ${user.user?.last_name || ""}`
                                .trim(),
                            percentage: domain.percentage || 0,
                            levelClass: getLevelClass(domain.level_description),
                            backgroundColor: userColors[user.user_id] || "#000",
                            role: user.user?.role_name || "Unknown Role"
                        };

                        cognitiveGroups[domain.name].users.push(userData);

                        // Store unique users using Map
                        if (domain.level_description.toLowerCase() === "low") {
                            cognitiveCategories.low.set(userData.id, userData);
                        } else if (domain.level_description.toLowerCase() === "moderate") {
                            cognitiveCategories.moderate.set(userData.id, userData);
                        } else if (domain.level_description.toLowerCase() === "high") {
                            cognitiveCategories.high.set(userData.id, userData);
                        }
                    });
                });

                Object.keys(cognitiveGroups).forEach((ability) => {
                    let group = cognitiveGroups[ability];

                    group.users.sort((a, b) => a.percentage - b.percentage);

                    // Calculate total and average scores for the current ability
                    let totalScore = group.users.reduce((sum, user) => sum + user.percentage, 0);
                    let avgScore = group.users.length ? (totalScore / group.users.length).toFixed(2) : 0;

                    // Group users by percentile for stacking
                    let stackedUsers = {};
                    group.users.forEach(user => {
                        if (!stackedUsers[user.percentage]) {
                            stackedUsers[user.percentage] = [];
                        }
                        stackedUsers[user.percentage].push(user);
                    });

                    let userBadges = Object.keys(stackedUsers).map(percentile => {
                        let stackedIcons = stackedUsers[percentile].map((user, index) => {
                            let topOffset = index *
                                20; // Adjust stacking distance between icons

                            return `
                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index};"
                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                        data-bs-title='<span class="cog-level-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>'>
                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                            ${user.initials}
                        </div>
                    </span>
                `;
                        }).join('');

                        return stackedIcons;
                    }).join('');


                    let html = `
                    <div class="inner-main">
                        <div class="inner-text">
                            <span>${group.description}</span>
                        </div>
                        <div class="position-relative">
                            <div class="progress">
                                <div class="progress-bar light-yellow" style="width: 33.33%;"></div>
                                <div class="progress-bar light-green" style="width: 33.33%;"></div>
                                <div class="progress-bar teal" style="width: 33.33%;"></div>
                            </div>
                            <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                ${userBadges}
                            </div>
                        </div>
                    </div>
                `;
                    container.innerHTML += html;
                });

                // Ensure we only render the section if there's at least one user in a category
                if (cognitiveCategories.low.size > 0 || cognitiveCategories.moderate.size > 0 || cognitiveCategories
                    .high.size > 0) {
                    let summaryHtml = `
                        <div class="cognitive-bottom">
                            <p>Candidates’ Overall Cognitive Ability</p>
                            <div class="cognitive-main">
                    `;

                    if (cognitiveCategories.low.size > 0) {
                        summaryHtml += generateCognitiveCategoryHTML("Low", "#FFC31F", Array.from(
                            cognitiveCategories.low.values()));
                    }

                    if (cognitiveCategories.moderate.size > 0) {
                        summaryHtml += `<hr style="margin: 15px 0px;">`;
                        summaryHtml += generateCognitiveCategoryHTML("Moderate", "#AA91F4", Array.from(
                            cognitiveCategories.moderate.values()));
                    }

                    if (cognitiveCategories.high.size > 0) {
                        summaryHtml += `<hr style="margin: 15px 0px;">`;
                        summaryHtml += generateCognitiveCategoryHTML("High", "#0C6464", Array.from(
                            cognitiveCategories.high.values()));
                    }

                    summaryHtml += `</div></div>`;
                    container.innerHTML += summaryHtml;
                }

                enableTooltips();
            }

            function generateCognitiveCategoryHTML(level, color, users) {
                if (users.length === 0) return ""; // Skip empty categories

                let description = "";
                if (level === "Low") {
                    description =
                        "The individual exhibits a developing cognitive ability. They may face challenges in tackling medium to difficult questions, but with structured support, practice, and exposure, they have the potential to improve.";
                } else if (level === "Moderate") {
                    description =
                        "The individual embodies a moderate level of cognitive ability. While they may face occasional challenges with complex scenarios, they demonstrate a steady potential for growth with practice and training.";
                } else if (level === "High") {
                    description =
                        "The individual possesses a strong cognitive ability. Their performance across varying difficulty levels reflects a solid grasp of concepts, strong analytical skills, and effective decision-making.";
                }

                // Ensure unique users by checking user ID
                let uniqueUsers = [];
                let seenUserIds = new Set();

                users.forEach(user => {
                    if (!seenUserIds.has(user.id)) {
                        seenUserIds.add(user.id);
                        uniqueUsers.push(user);
                    }
                });

                // If no users remain after removing duplicates, return an empty section
                if (uniqueUsers.length === 0) return "";

                return `
                    <div class="cog-inner">
                        <div class="cog-left">${level}</div>
                        <div class="cog-content">
                            <p style="margin-bottom: 15px;">${description}</p>
                            <div class="filtered">
                                ${uniqueUsers.map(user => 
                                    `<div class="states">
                                                        <div class="filter-selected" style="background-color: ${user.backgroundColor};">
                                                            ${user.initials} - ${user.role || "Unknown Role"}
                                                        </div>
                                                    </div>`
                                ).join('')}
                            </div>
                        </div>
                    </div>
                `;
            }

            // Enable Bootstrap Tooltips
            function enableTooltips() {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach((tooltipTriggerEl) => {
                    new bootstrap.Tooltip(tooltipTriggerEl, {
                        html: true,
                    });
                });
            }

            function applyFilters() {
                console.log("Applying filters...");

                // Get selected assessment result filters
                const selectedAssessmentResults = new Set(
                    Array.from(document.querySelectorAll(".filter-menu-item input:checked"))
                        .map(checkbox => checkbox.value.toLowerCase())
                );

                // Get selected candidates filters
                const selectedCandidates = new Set(
                    Array.from(document.querySelectorAll(".candidateList input:checked"))
                        .map(checkbox => checkbox.value)
                );

                console.log("Selected Assessment Results:", selectedAssessmentResults);
                console.log("Selected Candidates:", selectedCandidates);

                // Ensure users exist before filtering
                if (!responseData.users || responseData.users.length === 0) {
                    console.log("No user data available.");
                    return;
                }

                // Filter users based on selected assessment levels and selected candidates
                const filteredData = responseData.users.filter(user => {
                    if (!user.oceanDomainResult && !user.oceanAllFacetsResult && !user.cognitiveDomainResult) {
                        return false;
                    }

                    const userFullName = `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim();
                    let matchesAssessment = selectedAssessmentResults.size === 0; // If no filters selected, show all
                    let matchesCandidate = selectedCandidates.size === 0 || selectedCandidates.has(userFullName);

                    // Extract assessment levels for debugging
                    let userAssessmentLevels = new Set();

                    // Check if user's OCEAN domains match selected assessment levels
                    if (user.oceanDomainResult && typeof user.oceanDomainResult === 'object') {
                        Object.values(user.oceanDomainResult.items || {}).forEach(domain => {
                            if (domain.level_description) {
                                userAssessmentLevels.add(domain.level_description.toLowerCase());
                                if (selectedAssessmentResults.has(domain.level_description.toLowerCase())) {
                                    matchesAssessment = true;
                                }
                            }
                        });
                    }

                    // Check if user's cognitive domains match selected assessment levels
                    if (user.cognitiveDomainResult && typeof user.cognitiveDomainResult === 'object') {
                        Object.values(user.cognitiveDomainResult.items || {}).forEach(domain => {
                            if (domain.level_description) {
                                userAssessmentLevels.add(domain.level_description.toLowerCase());
                                if (selectedAssessmentResults.has(domain.level_description.toLowerCase())) {
                                    matchesAssessment = true;
                                }
                            }
                        });
                    }

                    console.log(`User ${userFullName} - Assessment Levels:`, userAssessmentLevels);

                    return matchesAssessment && matchesCandidate;
                });

                console.log("Filtered Users:", filteredData);

                // Apply the filtered data to the UI
                populateOceanDomains(filteredData);
                populate_Openness_to_Experience(filteredData);
                populate_Conscientiousness(filteredData);
                populate_Extraversion(filteredData);
                populate_Agreeableness(filteredData);
                populate_Emotional_Stability(filteredData);
                populateCognitiveAbility(filteredData);
            }



            // Apply filter on "Filter" button click
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('button-filter-apply')) {
                    applyFilters();
                }

                if (e.target.classList.contains('button-filter-cancel')) {
                    // Clear all checkboxes
                    document.querySelectorAll('.filter-item input, .candidateList input').forEach(input =>
                        input.checked = false);
                    applyFilters(); // Reset the data
                }
            });

            function handleToggleChange(event) {
                if (event.target === companyToggle) {
                    departmentToggle.checked = false;
                } else if (event.target === departmentToggle) {
                    companyToggle.checked = false;
                }
                populateOceanDomains(responseData);
            }

            function handleOpennessToggleChange(event) {
                if (event.target === companyToggleOpenness) {
                    departmentToggleOpenness.checked = false;
                } else if (event.target === departmentToggleOpenness) {
                    companyToggleOpenness.checked = false;
                }
                populate_Openness_to_Experience(responseData);
            }

            function handleConscientiousnessToggleChange(event) {
                if (event.target === companyToggleConscientiousness) {
                    departmentToggleConscientiousness.checked = false;
                } else if (event.target === departmentToggleConscientiousness) {
                    companyToggleConscientiousness.checked = false;
                }
                populate_Conscientiousness(responseData);
            }

            function handleExtraversionToggleChange(event) {
                if (event.target === companyToggleExtraversion) {
                    departmentToggleExtraversion.checked = false;
                } else if (event.target === departmentToggleExtraversion) {
                    companyToggleExtraversion.checked = false;
                }
                populate_Extraversion(responseData);
            }

            function handleAgreeablenessToggleChange(event) {
                if (event.target === companyToggleAgreeableness) {
                    departmentToggleAgreeableness.checked = false;
                } else if (event.target === departmentToggleAgreeableness) {
                    companyToggleAgreeableness.checked = false;
                }
                populate_Agreeableness(responseData);
            }

            function handleEmotionalToggleChange(event) {
                if (event.target === companyToggleEmotional) {
                    departmentToggleEmotional.checked = false;
                } else if (event.target === departmentToggleEmotional) {
                    companyToggleEmotional.checked = false;
                }
                populate_Emotional_Stability(responseData);
            }

            companyToggle.addEventListener("change", handleToggleChange);
            departmentToggle.addEventListener("change", handleToggleChange);
            companyToggleOpenness.addEventListener("change", handleOpennessToggleChange);
            departmentToggleOpenness.addEventListener("change", handleOpennessToggleChange);
            companyToggleConscientiousness.addEventListener("change", handleConscientiousnessToggleChange);
            departmentToggleConscientiousness.addEventListener("change", handleConscientiousnessToggleChange);
            companyToggleExtraversion.addEventListener("change", handleExtraversionToggleChange);
            departmentToggleExtraversion.addEventListener("change", handleExtraversionToggleChange);
            companyToggleAgreeableness.addEventListener("change", handleAgreeablenessToggleChange);
            departmentToggleAgreeableness.addEventListener("change", handleAgreeablenessToggleChange);
            companyToggleEmotional.addEventListener("change", handleEmotionalToggleChange);
            departmentToggleEmotional.addEventListener("change", handleEmotionalToggleChange);

            // Initial population of data
            populateOceanDomains(responseData);
            populate_Openness_to_Experience(responseData);
            populate_Conscientiousness(responseData);
            populate_Extraversion(responseData);
            populate_Agreeableness(responseData);
            populate_Emotional_Stability(responseData);
            populateRIASEC(responseData);
            populateCognitiveAbility(responseData);
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const companyToggle = document.querySelector(".companyToggle");
            const departmentToggle = document.querySelector(".departmentToggle");
            const companyToggleOpenness = document.querySelector(".companyToggleOpenness");
            const departmentToggleOpenness = document.querySelector(".departmentToggleOpenness");
            const companyToggleConscientiousness = document.querySelector(".companyToggleConscientiousness");
            const departmentToggleConscientiousness = document.querySelector(".departmentToggleConscientiousness");
            const companyToggleExtraversion = document.querySelector(".companyToggleExtraversion");
            const departmentToggleExtraversion = document.querySelector(".departmentToggleExtraversion");
            const companyToggleAgreeableness = document.querySelector(".companyToggleAgreeableness");
            const departmentToggleAgreeableness = document.querySelector(".departmentToggleAgreeableness");
            const companyToggleEmotional = document.querySelector(".companyToggleEmotional");
            const departmentToggleEmotional = document.querySelector(".departmentToggleEmotional");

            // Data from the backend
            let responseData = @json($responseData);

            // Helper function to ensure data is an array
            function validateArray(data) {
                if (Array.isArray(data)) {
                    return data;
                } else if (typeof data === "object" && data !== null) {
                    return Object.values(data); // Convert object properties into an array
                }
                return []; // Return empty array if data is invalid
            }

            function toggleVisibility() {
                const companyElements = document.querySelectorAll(".company.firstUI");
                const departmentElements = document.querySelectorAll(".department.secondUI");

                companyElements.forEach(el => {
                    if (companyToggle.checked || companyToggleOpenness.checked || companyToggleConscientiousness.checked || companyToggleExtraversion.checked || companyToggleAgreeableness.checked || companyToggleEmotional.checked) {
                        el.classList.remove("displayNone");
                    } else {
                        el.classList.add("displayNone");
                    }
                });

                departmentElements.forEach(el => {
                    if (departmentToggle.checked || departmentToggleOpenness.checked || departmentToggleConscientiousness.checked || departmentToggleExtraversion.checked || departmentToggleAgreeableness.checked || departmentToggleEmotional.checked) {
                        el.classList.remove("displayNone");
                    } else {
                        el.classList.add("displayNone");
                    }
                });
            }

            // Get selected assessment result filters
            // function getSelectedAssessmentResults() {
            //     return new Set(
            //         Array.from(document.querySelectorAll(".filter-menu-item input:checked"))
            //             .map(checkbox => checkbox.value.toLowerCase())
            //     );
            // }
            
            function getSelectedAssessmentResults() {
                return new Set(
                    Array.from(document.querySelectorAll(".filter-menu-item input:checked"))
                        .map(checkbox => checkbox.value.toLowerCase())
                );
            }

            // Get selected candidates filters
            // function getSelectedCandidates() {
            //     return new Set(
            //         Array.from(document.querySelectorAll(".candidateList input:checked"))
            //             .map(checkbox => checkbox.value)
            //     );
            // }

            function getSelectedCandidates() {
                return new Set(
                    Array.from(document.querySelectorAll(".candidateList input:checked"))
                        .map(checkbox => checkbox.value.toString())
                );
            }


            // Helper function to filter valid users
            function filterValidUsers(data) {
                return validateArray(data).filter(user => !user.removed);
            }


            function generateUserInitials(user) {
                const firstName = user.user?.first_name || "";
                const lastName = user.user?.last_name || "";
                return firstName && lastName ? firstName.charAt(0).toUpperCase() + lastName.charAt(0)
                    .toUpperCase() : (firstName.charAt(0).toUpperCase() || "?");
            }

            function getLevelClass(level) {
                switch (level.toLowerCase()) {
                    case "very low":
                        return "very-low";
                    case "low":
                        return "low";
                    case "moderate":
                        return "moderate";
                    case "high":
                        return "high";
                    case "very high":
                        return "very-high";
                    default:
                        return "unknown";
                }
            }

            function populateOceanDomains(data) {
                const container = document.querySelector("#OCEAN_Domains .main-content");
                container.innerHTML = ""; // Clear previous content

                const validatedData = filterValidUsers(data);
                if (validatedData.length === 0) {
                    container.innerHTML = "<p>No data available for OCEAN Domains.</p>";
                    return;
                }

                let domainUsers = {};
                let domainDescriptions = {};

                validatedData.forEach(user => {
                    if (!user || !user.oceanDomainResult) return;

                    const oceanData = Object.values(user.oceanDomainResult);
                    oceanData.forEach(domain => {
                        if (!domainUsers[domain.name]) {
                            domainUsers[domain.name] = [];
                            domainDescriptions[domain.name] = domain.description;
                        }
                        domainUsers[domain.name].push({
                            id: user.user_id,
                            initials: generateUserInitials(user),
                            fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`
                                .trim(),
                            percentage: domain.percentage || 0,
                            levelClass: getLevelClass(domain.level_description),
                            backgroundColor: userColors[user.user_id] || "#000"
                        });
                    });
                });

                // Loop through each domain to process data
                Object.keys(domainUsers).forEach(domain => {
                    if (!domainUsers[domain] || domainUsers[domain].length === 0) return;

                    // Sort users by percentage (optional)
                    domainUsers[domain].sort((a, b) => a.percentage - b.percentage);

                    // Recalculate the average score after removal
                    let totalScore = domainUsers[domain].reduce((sum, user) => sum + user.percentage, 0);

                    const domainKeyMap = {
                        "Openness to Experience": "openness-to-experience",
                        "Conscientiousness": "conscientiousness",
                        "Extraversion": "extraversion",
                        "Agreeableness": "agreeableness",
                        "Emotional Stability": "emotional-stability"
                    };

                    // Determine which data source to use based on toggles
                    let avgScore;
                    const domainKey = domainKeyMap[domain];

                    if (companyToggle.checked && responseData.companyAverage?.domains?.[domainKey]) {
                        // Use Company Average if the toggle is enabled
                        avgScore = (responseData.companyAverage.domains[domainKey] / 0.05).toFixed(2);
                    } 
                    else if (departmentToggle.checked && responseData.departmentAverage?.domains?.[domainKey] && !companyToggle.checked) {
                        // Use Department Average only if Company Toggle is OFF
                        avgScore = (responseData.departmentAverage.domains[domainKey] / 0.05).toFixed(2);
                    } 
                    else {
                        // Default calculation based on user data if both toggles are OFF
                        avgScore = domainUsers[domain].length > 0 
                            ? (totalScore / domainUsers[domain].length).toFixed(2) 
                            : "0.00";
                    }




                    // Group users by percentile for stacking
                    let stackedUsers = {};
                    domainUsers[domain].forEach(user => {
                        if (!stackedUsers[user.percentage]) {
                            stackedUsers[user.percentage] = [];
                        }
                        stackedUsers[user.percentage].push(user);
                    });

                    let userBadges = Object.keys(stackedUsers).map(percentile => {
                        let stackedIcons = stackedUsers[percentile].map((user, index) => {
                            let topOffset = index *
                            20; // Adjust stacking distance between icons
                            return `
                        <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index};"
                            data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                            data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                            <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                            <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                            <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                ${user.initials}
                            </div>
                        </span>
                    `;
                        }).join('');
                        return stackedIcons;
                    }).join('');

                    // Display dynamic average score
                    let companyInfo = companyToggle.checked ?
                        `<div class="company firstUI displayNone"><iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon><p>AVERAGE SCORE: ${avgScore}%</p></div>` :
                        "";

                    let departmentInfo = departmentToggle.checked ?
                        `<div class="department secondUI displayNone"><iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon><p>AVERAGE SCORE: ${avgScore}%</p></div>` :
                        "";

                    let html = `
                <div class="inner-main">
                    <div class="inner-text">
                        <div class="inner-text-heading">
                            <p>${domain}</p>
                            ${companyInfo}
                            ${departmentInfo}
                        </div>
                        <span>${domainDescriptions[domain]}</span>
                    </div>
                    <div class="position-relative">
                        <div class="progress" style="position: relative;">
                            <div class="progress-bar purple" style="width: 10%;"></div>
                            <div class="progress-bar light-purple" style="width: 18%;"></div>
                            <div class="progress-bar light-green" style="width: 44%;"></div>
                            <div class="progress-bar teal" style="width: 18%;"></div>
                            <div class="progress-bar teal-dark" style="width: 10%;"></div>
                        </div>
                        <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                            ${userBadges}
                        </div>
                    </div>
                </div>
                `;
                    container.innerHTML += html;
                });
                toggleVisibility(); 
                enableTooltips();
            }

            function capitalizeFirstLetter(string) {
                return string.replace(/-/g, ' ') // Replace hyphens with spaces
                            .replace(/\b\w/g, char => char.toUpperCase()); // Capitalize first letter of each word
            }

            function populate_Openness_to_Experience(data) {
                const traitConfig = {
                    traitName: "Openness to Experience",
                    traitSlugs: ["daydreaming", "aesthetic-appreciation", "feeling-aware", "explorer", "innovation", "open-mindedness"],
                    containerId: "#id_30_Facets_Openness_to_Experience .main-content"
                };

                const { traitName, traitSlugs, containerId } = traitConfig;
                    const container = document.querySelector(containerId);
                    if (!container) return;

                    container.innerHTML = "";
                    const validatedData = filterValidUsers(data);
                    if (validatedData.length === 0) {
                        container.innerHTML = `<p>No data available for ${traitName}.</p>`;
                        return;
                    }

                    let facetUsers = {};
                    let facetDescriptions = {};

                    validatedData.forEach(user => {
                        if (!user || !user.oceanAllFacetsResult) return;

                        // ✅ Ensure oceanAllFacetsResult is treated as an object
                        const facets = Object.entries(user.oceanAllFacetsResult || {});

                        facets.forEach(([facetKey, facet]) => {
                            if (traitSlugs.includes(facet.slug)) {
                                if (!facetUsers[facetKey]) {
                                    facetUsers[facetKey] = [];
                                    facetDescriptions[facetKey] = facet.description;
                                }

                                facetUsers[facetKey].push({
                                    id: user.user_id,
                                    initials: generateUserInitials(user),
                                    fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim(),
                                    percentage: facet.percentage || 0,
                                    levelClass: getLevelClass(facet.level_description),
                                    backgroundColor: userColors[user.user_id] || "#000"
                                });
                            }
                        });
                    });

                    Object.keys(facetUsers).forEach(facetKey => {
                        if (!facetUsers[facetKey] || facetUsers[facetKey].length === 0) return;

                        facetUsers[facetKey].sort((a, b) => a.percentage - b.percentage);

                        let totalScore = facetUsers[facetKey].reduce((sum, user) => sum + user.percentage, 0);
                        let avgScore;

                        const companyOpennessToggle = companyToggleOpenness.checked;
                        const departmentOpennessToggle = departmentToggleOpenness.checked;

                        if (companyOpennessToggle && responseData.companyAverage?.all_facets?.[facetKey]) {
                            avgScore = (responseData.companyAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else if (departmentOpennessToggle && responseData.departmentAverage?.all_facets?.[facetKey] && !companyOpennessToggle) {
                            avgScore = (responseData.departmentAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else {
                            avgScore = facetUsers[facetKey].length ? (totalScore / facetUsers[facetKey].length).toFixed(2) : "0.00";
                        }

                        let stackedUsers = {};
                        facetUsers[facetKey].forEach(user => {
                            if (!stackedUsers[user.percentage]) {
                                stackedUsers[user.percentage] = [];
                            }
                            stackedUsers[user.percentage].push(user);
                        });

                        let userBadges = Object.keys(stackedUsers).map(percentile => {
                            return stackedUsers[percentile].map((user, index) => {
                                let topOffset = index * -20;
                                return `
                                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index}; position: absolute;"
                                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                                        data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                                        <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                                        <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                            ${user.initials}
                                        </div>
                                    </span>
                                `;
                            }).join('');
                        }).join('');

                        // Display dynamic average score
                        let companyInfo = companyOpennessToggle ? `
                            <div class="company firstUI displayNone">
                                <iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";

                        let departmentInfo = departmentOpennessToggle ? `
                            <div class="department secondUI displayNone">
                                <iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";
                            
                        let html = `
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>${capitalizeFirstLetter(facetKey)}</p>
                                        ${companyInfo}
                                        ${departmentInfo}
                                    </div>
                                    <span>${facetDescriptions[facetKey]}</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                                        ${userBadges}
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += html;
                    });
                    
                toggleVisibility(); 
                enableTooltips();
            }


            function populate_Conscientiousness(data) {
                const traitConfig = {
                    traitName: "Conscientiousness",
                    traitSlugs: ["self-confidence", "tidiness", "responsibility", "drive-to-achieve", "willpower", "careful-thinking"],
                    containerId: "#id_30_Facets_Conscientiousness .main-content"
                };

                const { traitName, traitSlugs, containerId } = traitConfig;
                    const container = document.querySelector(containerId);
                    if (!container) return;

                    container.innerHTML = "";
                    const validatedData = filterValidUsers(data);
                    if (validatedData.length === 0) {
                        container.innerHTML = `<p>No data available for ${traitName}.</p>`;
                        return;
                    }

                    let facetUsers = {};
                    let facetDescriptions = {};

                    validatedData.forEach(user => {
                        if (!user || !user.oceanAllFacetsResult) return;

                        // ✅ Ensure oceanAllFacetsResult is treated as an object
                        const facets = Object.entries(user.oceanAllFacetsResult || {});

                        facets.forEach(([facetKey, facet]) => {
                            if (traitSlugs.includes(facet.slug)) {
                                if (!facetUsers[facetKey]) {
                                    facetUsers[facetKey] = [];
                                    facetDescriptions[facetKey] = facet.description;
                                }

                                facetUsers[facetKey].push({
                                    id: user.user_id,
                                    initials: generateUserInitials(user),
                                    fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim(),
                                    percentage: facet.percentage || 0,
                                    levelClass: getLevelClass(facet.level_description),
                                    backgroundColor: userColors[user.user_id] || "#000"
                                });
                            }
                        });
                    });

                    Object.keys(facetUsers).forEach(facetKey => {
                        if (!facetUsers[facetKey] || facetUsers[facetKey].length === 0) return;

                        facetUsers[facetKey].sort((a, b) => a.percentage - b.percentage);

                        let totalScore = facetUsers[facetKey].reduce((sum, user) => sum + user.percentage, 0);
                        let avgScore;

                        const companyConscientiousnessToggle = companyToggleConscientiousness.checked;
                        const departmentConscientiousnessToggle = departmentToggleConscientiousness.checked;

                        if (companyConscientiousnessToggle && responseData.companyAverage?.all_facets?.[facetKey]) {
                            avgScore = (responseData.companyAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else if (departmentConscientiousnessToggle && responseData.departmentAverage?.all_facets?.[facetKey] && !companyConscientiousnessToggle) {
                            avgScore = (responseData.departmentAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else {
                            avgScore = facetUsers[facetKey].length ? (totalScore / facetUsers[facetKey].length).toFixed(2) : "0.00";
                        }

                        let stackedUsers = {};
                        facetUsers[facetKey].forEach(user => {
                            if (!stackedUsers[user.percentage]) {
                                stackedUsers[user.percentage] = [];
                            }
                            stackedUsers[user.percentage].push(user);
                        });

                        let userBadges = Object.keys(stackedUsers).map(percentile => {
                            return stackedUsers[percentile].map((user, index) => {
                                let topOffset = index * -20;
                                return `
                                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index}; position: absolute;"
                                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                                        data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                                        <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                                        <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                            ${user.initials}
                                        </div>
                                    </span>
                                `;
                            }).join('');
                        }).join('');

                        // Display dynamic average score
                        let companyInfo = companyConscientiousnessToggle ? `
                            <div class="company firstUI displayNone">
                                <iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";

                        let departmentInfo = departmentConscientiousnessToggle ? `
                            <div class="department secondUI displayNone">
                                <iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";
                            
                        let html = `
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>${capitalizeFirstLetter(facetKey)}</p>
                                        ${companyInfo}
                                        ${departmentInfo}
                                    </div>
                                    <span>${facetDescriptions[facetKey]}</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                                        ${userBadges}
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += html;
                    });
                    
                toggleVisibility(); 
                enableTooltips();
            }


            function populate_Extraversion(data) {
                const traitConfig = {
                    traitName: "Extraversion",
                    traitSlugs: ["sociability", "crowd-enjoyment", "confidence", "energetic-lifestyle", "thrill-seeking", "optimism"],
                    containerId: "#id_30_Facets_Extraversion .main-content"
                };

                const { traitName, traitSlugs, containerId } = traitConfig;
                    const container = document.querySelector(containerId);
                    if (!container) return;

                    container.innerHTML = "";
                    const validatedData = filterValidUsers(data);
                    if (validatedData.length === 0) {
                        container.innerHTML = `<p>No data available for ${traitName}.</p>`;
                        return;
                    }

                    let facetUsers = {};
                    let facetDescriptions = {};

                    validatedData.forEach(user => {
                        if (!user || !user.oceanAllFacetsResult) return;

                        // ✅ Ensure oceanAllFacetsResult is treated as an object
                        const facets = Object.entries(user.oceanAllFacetsResult || {});

                        facets.forEach(([facetKey, facet]) => {
                            if (traitSlugs.includes(facet.slug)) {
                                if (!facetUsers[facetKey]) {
                                    facetUsers[facetKey] = [];
                                    facetDescriptions[facetKey] = facet.description;
                                }

                                facetUsers[facetKey].push({
                                    id: user.user_id,
                                    initials: generateUserInitials(user),
                                    fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim(),
                                    percentage: facet.percentage || 0,
                                    levelClass: getLevelClass(facet.level_description),
                                    backgroundColor: userColors[user.user_id] || "#000"
                                });
                            }
                        });
                    });

                    Object.keys(facetUsers).forEach(facetKey => {
                        if (!facetUsers[facetKey] || facetUsers[facetKey].length === 0) return;

                        facetUsers[facetKey].sort((a, b) => a.percentage - b.percentage);

                        let totalScore = facetUsers[facetKey].reduce((sum, user) => sum + user.percentage, 0);
                        let avgScore;

                        const companyExtraversionToggle = companyToggleExtraversion.checked;
                        const departmentExtraversionToggle = departmentToggleExtraversion.checked;

                        if (companyExtraversionToggle && responseData.companyAverage?.all_facets?.[facetKey]) {
                            avgScore = (responseData.companyAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else if (departmentExtraversionToggle && responseData.departmentAverage?.all_facets?.[facetKey] && !companyExtraversionToggle) {
                            avgScore = (responseData.departmentAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else {
                            avgScore = facetUsers[facetKey].length ? (totalScore / facetUsers[facetKey].length).toFixed(2) : "0.00";
                        }

                        let stackedUsers = {};
                        facetUsers[facetKey].forEach(user => {
                            if (!stackedUsers[user.percentage]) {
                                stackedUsers[user.percentage] = [];
                            }
                            stackedUsers[user.percentage].push(user);
                        });

                        let userBadges = Object.keys(stackedUsers).map(percentile => {
                            return stackedUsers[percentile].map((user, index) => {
                                let topOffset = index * -20;
                                return `
                                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index}; position: absolute;"
                                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                                        data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                                        <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                                        <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                            ${user.initials}
                                        </div>
                                    </span>
                                `;
                            }).join('');
                        }).join('');

                        // Display dynamic average score
                        let companyInfo = companyExtraversionToggle ? `
                            <div class="company firstUI displayNone">
                                <iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";

                        let departmentInfo = departmentExtraversionToggle ? `
                            <div class="department secondUI displayNone">
                                <iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";
                            
                        let html = `
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>${capitalizeFirstLetter(facetKey)}</p>
                                        ${companyInfo}
                                        ${departmentInfo}
                                    </div>
                                    <span>${facetDescriptions[facetKey]}</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                                        ${userBadges}
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += html;
                    });
                    
                toggleVisibility(); 
                enableTooltips();
            }


            function populate_Agreeableness(data) {
                const traitConfig = {
                    traitName: "Agreeableness",
                    traitSlugs: ["belief", "honesty", "helpfulness", "diplomacy", "humility", "compassion"],
                    containerId: "#id_30_Facets_Agreeableness .main-content"
                };

                const { traitName, traitSlugs, containerId } = traitConfig;
                    const container = document.querySelector(containerId);
                    if (!container) return;

                    container.innerHTML = "";
                    const validatedData = filterValidUsers(data);
                    if (validatedData.length === 0) {
                        container.innerHTML = `<p>No data available for ${traitName}.</p>`;
                        return;
                    }

                    let facetUsers = {};
                    let facetDescriptions = {};

                    validatedData.forEach(user => {
                        if (!user || !user.oceanAllFacetsResult) return;

                        // ✅ Ensure oceanAllFacetsResult is treated as an object
                        const facets = Object.entries(user.oceanAllFacetsResult || {});

                        facets.forEach(([facetKey, facet]) => {
                            if (traitSlugs.includes(facet.slug)) {
                                if (!facetUsers[facetKey]) {
                                    facetUsers[facetKey] = [];
                                    facetDescriptions[facetKey] = facet.description;
                                }

                                facetUsers[facetKey].push({
                                    id: user.user_id,
                                    initials: generateUserInitials(user),
                                    fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim(),
                                    percentage: facet.percentage || 0,
                                    levelClass: getLevelClass(facet.level_description),
                                    backgroundColor: userColors[user.user_id] || "#000"
                                });
                            }
                        });
                    });

                    Object.keys(facetUsers).forEach(facetKey => {
                        if (!facetUsers[facetKey] || facetUsers[facetKey].length === 0) return;

                        facetUsers[facetKey].sort((a, b) => a.percentage - b.percentage);

                        let totalScore = facetUsers[facetKey].reduce((sum, user) => sum + user.percentage, 0);
                        let avgScore;

                        const companyAgreeablenessToggle = companyToggleAgreeableness.checked;
                        const departmentAgreeablenessToggle = departmentToggleAgreeableness.checked;

                        if (companyAgreeablenessToggle && responseData.companyAverage?.all_facets?.[facetKey]) {
                            avgScore = (responseData.companyAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else if (departmentAgreeablenessToggle && responseData.departmentAverage?.all_facets?.[facetKey] && !companyAgreeablenessToggle) {
                            avgScore = (responseData.departmentAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else {
                            avgScore = facetUsers[facetKey].length ? (totalScore / facetUsers[facetKey].length).toFixed(2) : "0.00";
                        }

                        let stackedUsers = {};
                        facetUsers[facetKey].forEach(user => {
                            if (!stackedUsers[user.percentage]) {
                                stackedUsers[user.percentage] = [];
                            }
                            stackedUsers[user.percentage].push(user);
                        });

                        let userBadges = Object.keys(stackedUsers).map(percentile => {
                            return stackedUsers[percentile].map((user, index) => {
                                let topOffset = index * -20;
                                return `
                                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index}; position: absolute;"
                                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                                        data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                                        <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                                        <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                            ${user.initials}
                                        </div>
                                    </span>
                                `;
                            }).join('');
                        }).join('');

                        // Display dynamic average score
                        let companyInfo = companyAgreeablenessToggle ? `
                            <div class="company firstUI displayNone">
                                <iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";

                        let departmentInfo = departmentAgreeablenessToggle ? `
                            <div class="department secondUI displayNone">
                                <iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";
                            
                        let html = `
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>${capitalizeFirstLetter(facetKey)}</p>
                                        ${companyInfo}
                                        ${departmentInfo}
                                    </div>
                                    <span>${facetDescriptions[facetKey]}</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                                        ${userBadges}
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += html;
                    });
                    
                toggleVisibility(); 
                enableTooltips();
            }


            function populate_Emotional_Stability(data) {
                const traitConfig = {
                    traitName: "Emotional Stability",
                    traitSlugs: ["steadiness", "tolerance", "positivity", "social-sensitivity", "impulse-control", "stress-response"],
                    containerId: "#id_30_Facets_Emotional_Stability .main-content"
                };

                const { traitName, traitSlugs, containerId } = traitConfig;
                    const container = document.querySelector(containerId);
                    if (!container) return;

                    container.innerHTML = "";
                    const validatedData = filterValidUsers(data);
                    if (validatedData.length === 0) {
                        container.innerHTML = `<p>No data available for ${traitName}.</p>`;
                        return;
                    }

                    let facetUsers = {};
                    let facetDescriptions = {};

                    validatedData.forEach(user => {
                        if (!user || !user.oceanAllFacetsResult) return;

                        // ✅ Ensure oceanAllFacetsResult is treated as an object
                        const facets = Object.entries(user.oceanAllFacetsResult || {});

                        facets.forEach(([facetKey, facet]) => {
                            if (traitSlugs.includes(facet.slug)) {
                                if (!facetUsers[facetKey]) {
                                    facetUsers[facetKey] = [];
                                    facetDescriptions[facetKey] = facet.description;
                                }

                                facetUsers[facetKey].push({
                                    id: user.user_id,
                                    initials: generateUserInitials(user),
                                    fullName: `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim(),
                                    percentage: facet.percentage || 0,
                                    levelClass: getLevelClass(facet.level_description),
                                    backgroundColor: userColors[user.user_id] || "#000"
                                });
                            }
                        });
                    });

                    Object.keys(facetUsers).forEach(facetKey => {
                        if (!facetUsers[facetKey] || facetUsers[facetKey].length === 0) return;

                        facetUsers[facetKey].sort((a, b) => a.percentage - b.percentage);

                        let totalScore = facetUsers[facetKey].reduce((sum, user) => sum + user.percentage, 0);
                        let avgScore;

                        const companyEmotionalToggle = companyToggleEmotional.checked;
                        const departmentEmotionalToggle = departmentToggleEmotional.checked;

                        if (companyEmotionalToggle && responseData.companyAverage?.all_facets?.[facetKey]) {
                            avgScore = (responseData.companyAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else if (departmentEmotionalToggle && responseData.departmentAverage?.all_facets?.[facetKey] && !companyEmotionalToggle) {
                            avgScore = (responseData.departmentAverage.all_facets[facetKey] / 0.05).toFixed(2);
                        } else {
                            avgScore = facetUsers[facetKey].length ? (totalScore / facetUsers[facetKey].length).toFixed(2) : "0.00";
                        }

                        let stackedUsers = {};
                        facetUsers[facetKey].forEach(user => {
                            if (!stackedUsers[user.percentage]) {
                                stackedUsers[user.percentage] = [];
                            }
                            stackedUsers[user.percentage].push(user);
                        });

                        let userBadges = Object.keys(stackedUsers).map(percentile => {
                            return stackedUsers[percentile].map((user, index) => {
                                let topOffset = index * -20;
                                return `
                                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index}; position: absolute;"
                                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                                        data-bs-title='<span class="${user.levelClass}-text level-text">${user.percentage}th</span>
                                        <span class="level-score-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>
                                        <span class="level-score cog-level">SCORE: ${user.percentage}%</span>'>
                                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                                            ${user.initials}
                                        </div>
                                    </span>
                                `;
                            }).join('');
                        }).join('');

                        // Display dynamic average score
                        let companyInfo = companyEmotionalToggle ? `
                            <div class="company firstUI displayNone">
                                <iconify-icon icon="carbon:building" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";

                        let departmentInfo = departmentEmotionalToggle ? `
                            <div class="department secondUI displayNone">
                                <iconify-icon icon="entypo:flow-tree" width="20" class="icon" height="20"></iconify-icon>
                                <p>AVERAGE SCORE: ${avgScore}%</p>
                            </div>` : "";
                            
                        let html = `
                            <div class="inner-main">
                                <div class="inner-text">
                                    <div class="inner-text-heading">
                                        <p>${capitalizeFirstLetter(facetKey)}</p>
                                        ${companyInfo}
                                        ${departmentInfo}
                                    </div>
                                    <span>${facetDescriptions[facetKey]}</span>
                                </div>
                                <div class="position-relative">
                                    <div class="progress" style="position: relative;">
                                        <div class="progress-bar purple" style="width: 10%;"></div>
                                        <div class="progress-bar light-purple" style="width: 18%;"></div>
                                        <div class="progress-bar light-green" style="width: 44%;"></div>
                                        <div class="progress-bar teal" style="width: 18%;"></div>
                                        <div class="progress-bar teal-dark" style="width: 10%;"></div>
                                    </div>
                                    <div class="badge-container" style="position: absolute; top: -15px; width: 100%; height: 30px;">
                                        ${userBadges}
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += html;
                    });
                    
                toggleVisibility(); 
                enableTooltips();
            }




            // Populate RIASEC data

            function populateRIASEC(data) {
                const container = document.querySelector("#RIASEC .riasec-bottom");
                container.innerHTML = ""; // Clear existing content

                const validatedData = filterValidUsers(data);
                if (validatedData.length === 0) {
                    container.innerHTML = "<p>No data available for RIASEC.</p>";
                    return;
                }

                validatedData.forEach((user) => {
                    if (!user.user) {
                        console.warn("Skipping user due to missing user details:", user);
                        return;
                    }

                    const userId = user.user_id;
                    const riasecData = user.riasecTop3Result || {};
                    const assignedColor = userColors[userId] ||
                        "#000"; // Default to black if no color assigned

                    const html = `
                <div class="riasec-inner" id="riasec-user-${userId}">
                    <div class="riasec-left">${riasecData.string || "N/A"}</div>
                    <div class="cog-content">
                        <p>${riasecData.description || "N/A"}</p>
                        <div class="filtered">
                            <div class="states">
                                <div class="filter-selected" style="background-color: ${assignedColor};">
                                    ${user.user.first_name || "Unknown"} ${user.user.last_name || ""} - ${user.user.role_name || "N/A"}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            `;
                    container.innerHTML += html;
                });
            }



            function populateCognitiveAbility(data) {
                const container = document.querySelector("#Cognitive_Ability .main-content");
                if (!container) {
                    console.error("Cognitive Ability container not found.");
                    return;
                }

                container.innerHTML = ""; // Clear existing content

                const validatedData = filterValidUsers(data);
                if (validatedData.length === 0) {
                    container.innerHTML = "<p>No data available for Cognitive Ability.</p>";
                    return;
                }

                let cognitiveGroups = {};
                let cognitiveCategories = {
                    low: new Map(),
                    moderate: new Map(),
                    high: new Map()
                };

                validatedData.forEach((user) => {
                    if (!user.cognitiveDomainResult || Object.keys(user.cognitiveDomainResult).length ===
                        0) {
                        console.warn(`No cognitiveDomainResult for user ${user.user?.first_name}`);
                        return;
                    }

                    Object.values(user.cognitiveDomainResult).forEach((domain) => {
                        if (!domain.name || !domain.description) {
                            console.warn("Invalid domain data:", domain);
                            return;
                        }

                        if (!cognitiveGroups[domain.name]) {
                            cognitiveGroups[domain.name] = {
                                description: domain.description,
                                users: []
                            };
                        }

                        const userData = {
                            id: user.user_id,
                            initials: generateUserInitials(user),
                            fullName: `${user.user?.first_name} ${user.user?.last_name || ""}`
                                .trim(),
                            percentage: domain.percentage || 0,
                            levelClass: getLevelClass(domain.level_description),
                            backgroundColor: userColors[user.user_id] || "#000",
                            role: user.user?.role_name || "Unknown Role"
                        };

                        cognitiveGroups[domain.name].users.push(userData);

                        // Store unique users using Map
                        if (domain.level_description.toLowerCase() === "low") {
                            cognitiveCategories.low.set(userData.id, userData);
                        } else if (domain.level_description.toLowerCase() === "moderate") {
                            cognitiveCategories.moderate.set(userData.id, userData);
                        } else if (domain.level_description.toLowerCase() === "high") {
                            cognitiveCategories.high.set(userData.id, userData);
                        }
                    });
                });

                Object.keys(cognitiveGroups).forEach((ability) => {
                    let group = cognitiveGroups[ability];

                    group.users.sort((a, b) => a.percentage - b.percentage);

                    // Calculate total and average scores for the current ability
                    let totalScore = group.users.reduce((sum, user) => sum + user.percentage, 0);
                    let avgScore = group.users.length ? (totalScore / group.users.length).toFixed(2) : 0;

                    // Group users by percentile for stacking
                    let stackedUsers = {};
                    group.users.forEach(user => {
                        if (!stackedUsers[user.percentage]) {
                            stackedUsers[user.percentage] = [];
                        }
                        stackedUsers[user.percentage].push(user);
                    });

                    let userBadges = Object.keys(stackedUsers).map(percentile => {
                        let stackedIcons = stackedUsers[percentile].map((user, index) => {
                            let topOffset = index *
                                20; // Adjust stacking distance between icons

                            return `
                    <span class="circle stacked-user" style="left: ${percentile}%; top: ${topOffset}px; background-color: ${user.backgroundColor}; z-index: ${50 - index};"
                        data-user-id="${user.id}" data-bs-toggle="tooltip" data-bs-html="true" 
                        data-bs-title='<span class="cog-level-${user.levelClass} cog-level">${user.levelClass.toUpperCase()}</span>'>
                        <div class="user-icon" title="${user.fullName}" style="background-color: ${user.backgroundColor};">
                            ${user.initials}
                        </div>
                    </span>
                `;
                        }).join('');

                        return stackedIcons;
                    }).join('');


                    let html = `
                    <div class="inner-main">
                        <div class="inner-text">
                             <p>${ability}</p>
                            <span>${group.description}</span>
                        </div>
                        <div class="position-relative">
                            <div class="progress">
                                <div class="progress-bar light-yellow" style="width: 33.33%;"></div>
                                <div class="progress-bar light-green" style="width: 33.33%;"></div>
                                <div class="progress-bar teal" style="width: 33.33%;"></div>
                            </div>
                            <div class="d-flex justify-content-center position-absolute w-100" style="top: -6px;">
                                ${userBadges}
                            </div>
                        </div>
                    </div>
                `;
                    container.innerHTML += html;
                });

                // Ensure we only render the section if there's at least one user in a category
                if (cognitiveCategories.low.size > 0 || cognitiveCategories.moderate.size > 0 || cognitiveCategories
                    .high.size > 0) {
                    let summaryHtml = `
                        <div class="cognitive-bottom">
                            <p>Candidates’ Overall Cognitive Ability</p>
                            <div class="cognitive-main">
                    `;

                    if (cognitiveCategories.low.size > 0) {
                        summaryHtml += generateCognitiveCategoryHTML("Low", "#FFC31F", Array.from(
                            cognitiveCategories.low.values()));
                    }

                    if (cognitiveCategories.moderate.size > 0) {
                        summaryHtml += `<hr style="margin: 15px 0px;">`;
                        summaryHtml += generateCognitiveCategoryHTML("Moderate", "#AA91F4", Array.from(
                            cognitiveCategories.moderate.values()));
                    }

                    if (cognitiveCategories.high.size > 0) {
                        summaryHtml += `<hr style="margin: 15px 0px;">`;
                        summaryHtml += generateCognitiveCategoryHTML("High", "#0C6464", Array.from(
                            cognitiveCategories.high.values()));
                    }

                    summaryHtml += `</div></div>`;
                    container.innerHTML += summaryHtml;
                }

                enableTooltips();
            }

            function generateCognitiveCategoryHTML(level, color, users) {
                if (users.length === 0) return ""; // Skip empty categories

                let description = "";
                if (level === "Low") {
                    description =
                        "The individual exhibits a developing cognitive ability. They may face challenges in tackling medium to difficult questions, but with structured support, practice, and exposure, they have the potential to improve.";
                } else if (level === "Moderate") {
                    description =
                        "The individual embodies a moderate level of cognitive ability. While they may face occasional challenges with complex scenarios, they demonstrate a steady potential for growth with practice and training.";
                } else if (level === "High") {
                    description =
                        "The individual possesses a strong cognitive ability. Their performance across varying difficulty levels reflects a solid grasp of concepts, strong analytical skills, and effective decision-making.";
                }

                // Ensure unique users by checking user ID
                let uniqueUsers = [];
                let seenUserIds = new Set();

                users.forEach(user => {
                    if (!seenUserIds.has(user.id)) {
                        seenUserIds.add(user.id);
                        uniqueUsers.push(user);
                    }
                });

                // If no users remain after removing duplicates, return an empty section
                if (uniqueUsers.length === 0) return "";

                return `
                    <div class="cog-inner">
                        <div class="cog-left">${level}</div>
                        <div class="cog-content">
                            <p style="margin-bottom: 15px;">${description}</p>
                            <div class="filtered">
                                ${uniqueUsers.map(user => 
                                    `<div class="states">
                                                        <div class="filter-selected" style="background-color: ${user.backgroundColor};">
                                                            ${user.initials} - ${user.role || "Unknown Role"}
                                                        </div>
                                                    </div>`
                                ).join('')}
                            </div>
                        </div>
                    </div>
                `;
            }

            // Enable Bootstrap Tooltips
            function enableTooltips() {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach((tooltipTriggerEl) => {
                    new bootstrap.Tooltip(tooltipTriggerEl, {
                        html: true,
                    });
                });
            }

            // **Main Filter Function**
            // function applyFilters(filterType) {
            //     console.log(`Applying filters for: ${filterType}`);

            //     const selectedAssessmentResults = getSelectedAssessmentResults();
            //     const selectedCandidates = getSelectedCandidates();

            //     console.log("Selected Assessment Results:", selectedAssessmentResults);
            //     console.log("Selected Candidates:", selectedCandidates);

            //     if (!responseData.users || responseData.users.length === 0) {
            //         console.log("No user data available.");
            //         return;
            //     }
            //     console.log("All Users:", responseData);
            //     const filteredData = responseData.users.filter(user => {
            //         const userFullName = `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim();
            //         let matchesAssessment = selectedAssessmentResults.size === 0;
            //         let matchesCandidate = selectedCandidates.size === 0 || selectedCandidates.has(userFullName);
            //         if (filterType === "OCEAN" && user.oceanDomainResult) {
            //             Object.values(user.oceanDomainResult.items || {}).forEach(domain => {
            //                 if (domain.level_description && selectedAssessmentResults.has(domain.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Openness" && user.oceanAllFacetsResult) {
            //             Object.values(user.oceanAllFacetsResult || {}).forEach(facet => {
            //                 if (facet.level_description && selectedAssessmentResults.has(facet.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Conscientiousness" && user.oceanAllFacetsResult) {
            //             Object.values(user.oceanAllFacetsResult || {}).forEach(facet => {
            //                 if (facet.level_description && selectedAssessmentResults.has(facet.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Extraversion" && user.oceanAllFacetsResult) {
            //             Object.values(user.oceanAllFacetsResult || {}).forEach(facet => {
            //                 if (facet.level_description && selectedAssessmentResults.has(facet.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Agreeableness" && user.oceanAllFacetsResult) {
            //             Object.values(user.oceanAllFacetsResult || {}).forEach(facet => {
            //                 if (facet.level_description && selectedAssessmentResults.has(facet.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Emotional Stability" && user.oceanAllFacetsResult) {
            //             Object.values(user.oceanAllFacetsResult || {}).forEach(facet => {
            //                 if (facet.level_description && selectedAssessmentResults.has(facet.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Cognitive Ability" && user.cognitiveDomainResult) {
            //             Object.values(user.cognitiveDomainResult || {}).forEach(domain => {
            //                 if (domain.level_description && selectedAssessmentResults.has(domain.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         return matchesAssessment && matchesCandidate;
            //     });

            //     console.log(`Filtered Users for ${filterType}:`, filteredData);

            //     // Apply filtered data to the specific section only
            //     if (filterType === "OCEAN") {
            //         populateOceanDomains(filteredData);
            //     } else if (filterType === "Openness") {
            //         populate_Openness_to_Experience(filteredData);
            //     } else if (filterType === "Conscientiousness") {
            //         populate_Conscientiousness(filteredData);
            //     } else if (filterType === "Extraversion") {
            //         populate_Extraversion(filteredData);
            //     } else if (filterType === "Agreeableness") {
            //         populate_Agreeableness(filteredData);
            //     } else if (filterType === "Emotional Stability") {
            //         populate_Emotional_Stability(filteredData);
            //     } else if (filterType === "Cognitive Ability") {
            //         populateCognitiveAbility(filteredData);
            //     }
            // }

            // function applyFilters(filterType) {
            //     console.log(`Applying filters for: ${filterType}`);

            //     const selectedAssessmentResults = getSelectedAssessmentResults();
            //     const selectedCandidates = getSelectedCandidates();

            //     console.log("Selected Assessment Results:", selectedAssessmentResults);
            //     console.log("Selected Candidates:", selectedCandidates);

            //     if (!responseData || (!responseData.users && Object.keys(responseData).length === 0)) {
            //         console.log("No user data available.");
            //         return;
            //     }

            //     console.log("All Users:", responseData);

            //     // Store indexed user results (e.g., responseData[0], responseData[1], etc.)
            //     let userResults = {};
            //     Object.keys(responseData).forEach(key => {
            //         if (!isNaN(key) && responseData[key].user_id) { // Check if key is numeric (indicating user data)
            //             userResults[responseData[key].user_id] = responseData[key];
            //         }
            //     });

            //     console.log("userResults", userResults)

            //     // Ensure responseData.users is an array (convert if necessary)
            //     let usersArray = [];
            //     if (Array.isArray(responseData.users)) {
            //         usersArray = responseData.users;
            //     } else if (typeof responseData.users === "object" && responseData.users !== null) {
            //         usersArray = Object.values(responseData.users);
            //     }

            //     // Merge responseData.users with indexed user results
            //     const combinedUsers = [...usersArray, ...Object.values(userResults)];
            //     console.log(combinedUsers);

            //     // Filter users based on selection criteria
            //     const filteredData = combinedUsers.filter(user => {
            //         const userFullName = `${user.user?.first_name || ''} ${user.user?.last_name || ''}`.trim();
            //         let matchesAssessment = selectedAssessmentResults.size === 0;
            //         // let matchesCandidate = selectedCandidates.size === 0 || selectedCandidates.has(userFullName);
            //         let matchesCandidate = selectedCandidates.size === 0 || selectedCandidates.has(user.user_id);

            //         console.log("Matches Candidates:", matchesCandidate, user.user_id, selectedCandidates);
            //         // Get additional data for this user if available
            //         const userExtraData = userResults[user.user_id] || {};
            //         console.log("userResults", userResults);
            //         console.log("userExtraData", userExtraData)
            //         if (filterType === "OCEAN" && userExtraData.oceanDomainResult) {
            //             console.log("userExtraData.oceanDomainResult", userExtraData.oceanDomainResult);
            //             Object.values(userExtraData.oceanDomainResult || {}).forEach(domain => {
            //                 if (domain.level_description && selectedAssessmentResults.has(domain.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Openness" && userExtraData.oceanAllFacetsResult) {
            //             Object.values(userExtraData.oceanAllFacetsResult || {}).forEach(facet => {
            //                 if (facet.level_description && selectedAssessmentResults.has(facet.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Conscientiousness" && userExtraData.oceanAllFacetsResult) {
            //             Object.values(userExtraData.oceanAllFacetsResult || {}).forEach(facet => {
            //                 if (facet.level_description && selectedAssessmentResults.has(facet.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Extraversion" && userExtraData.oceanAllFacetsResult) {
            //             Object.values(userExtraData.oceanAllFacetsResult || {}).forEach(facet => {
            //                 if (facet.level_description && selectedAssessmentResults.has(facet.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Agreeableness" && userExtraData.oceanAllFacetsResult) {
            //             Object.values(userExtraData.oceanAllFacetsResult || {}).forEach(facet => {
            //                 if (facet.level_description && selectedAssessmentResults.has(facet.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Emotional Stability" && userExtraData.oceanAllFacetsResult) {
            //             Object.values(userExtraData.oceanAllFacetsResult || {}).forEach(facet => {
            //                 if (facet.level_description && selectedAssessmentResults.has(facet.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }

            //         if (filterType === "Cognitive Ability" && userExtraData.cognitiveDomainResult) {
            //             Object.values(userExtraData.cognitiveDomainResult || {}).forEach(domain => {
            //                 if (domain.level_description && selectedAssessmentResults.has(domain.level_description.toLowerCase())) {
            //                     matchesAssessment = true;
            //                 }
            //             });
            //         }
            //         console.log("Matches Assessment:", matchesAssessment);
            //         console.log("Matches Candidate:", matchesCandidate);
            //         return matchesAssessment && matchesCandidate;

            //     });

            //     console.log(`Filtered Users for ${filterType}:`, filteredData);

            //     // Apply filtered data to the specific section only
            //     if (filterType === "OCEAN") {
            //         populateOceanDomains(filteredData);
            //     } else if (filterType === "Openness") {
            //         populate_Openness_to_Experience(filteredData);
            //     } else if (filterType === "Conscientiousness") {
            //         populate_Conscientiousness(filteredData);
            //     } else if (filterType === "Extraversion") {
            //         populate_Extraversion(filteredData);
            //     } else if (filterType === "Agreeableness") {
            //         populate_Agreeableness(filteredData);
            //     } else if (filterType === "Emotional Stability") {
            //         populate_Emotional_Stability(filteredData);
            //     } else if (filterType === "Cognitive Ability") {
            //         populateCognitiveAbility(filteredData);
            //     }
            // }

//             function applyFilters(filterType) {
//     console.log(`Applying filters for: ${filterType}`);

//     const selectedAssessmentResults = getSelectedAssessmentResults(); // e.g., 'moderate'
//     const selectedCandidates = getSelectedCandidates(); // e.g., '3599'

//     console.log("Selected Assessment Results:", selectedAssessmentResults);
//     console.log("Selected Candidates:", selectedCandidates);

//     if (!responseData || (!responseData.users && Object.keys(responseData).length === 0)) {
//         console.log("No user data available.");
//         return;
//     }

//     // Prepare user results from responseData
//     let userResults = {};
//     Object.keys(responseData).forEach(key => {
//         if (!isNaN(key) && responseData[key].user_id) {
//             userResults[responseData[key].user_id.toString()] = responseData[key];
//         }
//     });

//     // Extract users array from responseData.users
//     let usersArray = [];
//     if (Array.isArray(responseData.users)) {
//         usersArray = responseData.users;
//     } else if (typeof responseData.users === "object" && responseData.users !== null) {
//         usersArray = Object.values(responseData.users);
//     }

//     // Merge users and userResults
//     const combinedUsers = [...usersArray, ...Object.values(userResults)];

//     const filteredData = combinedUsers.reduce((acc, user) => {
//         const userId = user.user_id?.toString();
//         if (!userId) return acc;

//         const userExtraData = userResults[userId] || {};

//         let matchesAssessment = selectedAssessmentResults.size === 0;
//         let matchesCandidate = selectedCandidates.size === 0 || selectedCandidates.has(userId);

//         console.log("Matches Candidates:", matchesCandidate, userId, selectedCandidates);

//         // === Debug assessment issue ===
//         console.log("User Extra Data:", userExtraData);
//         console.log("OCEAN Domain Result:", userExtraData.oceanDomainResult);

//         // Match OCEAN domain
//         if (filterType === "OCEAN" && userExtraData.oceanDomainResult) {
//             Object.values(userExtraData.oceanDomainResult).forEach(domain => {
//                 const level = domain.level_description?.toLowerCase();
//                 console.log("Checking domain level:", level);
//                 if (level && selectedAssessmentResults.has(level)) {
//                     matchesAssessment = true;
//                 }
//             });
//         }

//         // Match OCEAN facets
//         if (userExtraData.oceanAllFacetsResult) {
//             const traitFacets = {
//                 Openness: [
//                     "daydreaming", "aesthetic-appreciation", "feeling-aware",
//                     "explorer", "innovation", "open-mindedness"
//                 ],
//                 Conscientiousness: [
//                     "self-confidence", "tidiness", "responsibility",
//                     "drive-to-achieve", "willpower", "careful-thinking"
//                 ],
//                 Extraversion: [
//                     "sociability", "crowd-enjoyment", "confidence",
//                     "energetic-lifestyle", "thrill-seeking", "optimism"
//                 ],
//                 Agreeableness: [
//                     "belief", "honesty", "helpfulness",
//                     "diplomacy", "humility", "compassion"
//                 ],
//                 "Emotional Stability": [
//                     "steadiness", "tolerance", "positivity",
//                     "social-sensitivity", "impulse-control", "stress-response"
//                 ]
//             };

//             const relevantSlugs = traitFacets[filterType] || [];

//             Object.values(userExtraData.oceanAllFacetsResult).forEach(facet => {
//                 const level = facet.level_description?.toLowerCase();
//                 const slug = facet.slug;
//                 if (level && relevantSlugs.includes(slug) && selectedAssessmentResults.has(level)) {
//                     matchesAssessment = true;
//                 }
//             });
//         }

//         // Match Cognitive Ability
//         if (filterType === "Cognitive Ability" && userExtraData.cognitiveDomainResult) {
//             Object.values(userExtraData.cognitiveDomainResult).forEach(domain => {
//                 const level = domain.level_description?.toLowerCase();
//                 if (level && selectedAssessmentResults.has(level)) {
//                     matchesAssessment = true;
//                 }
//             });
//         }

//         if (matchesAssessment && matchesCandidate) {
//             if (!userExtraData.user && user.user) {
//                 userExtraData.user = user.user;
//             }
//             userExtraData.user_id = userId;
//             acc.push(userExtraData);
//         }

//         return acc;
//     }, []);

//     console.log(`Filtered Users for ${filterType}:`, filteredData);

//     // Update the UI based on filter type
//     switch (filterType) {
//         case "OCEAN":
//             populateOceanDomains(filteredData);
//             break;
//         case "Openness":
//             populate_Openness_to_Experience(filteredData);
//             break;
//         case "Conscientiousness":
//             populate_Conscientiousness(filteredData);
//             break;
//         case "Extraversion":
//             populate_Extraversion(filteredData);
//             break;
//         case "Agreeableness":
//             populate_Agreeableness(filteredData);
//             break;
//         case "Emotional Stability":
//             populate_Emotional_Stability(filteredData);
//             break;
//         case "Cognitive Ability":
//             populateCognitiveAbility(filteredData);
//             break;
//     }
// }

function applyFilters(filterType) {
    console.log(`Applying filters for: ${filterType}`);

    const selectedAssessmentResults = getSelectedAssessmentResults(); // e.g., 'moderate'
    const selectedCandidates = getSelectedCandidates(); // e.g., '3599'

    console.log("Selected Assessment Results:", selectedAssessmentResults);
    console.log("Selected Candidates:", selectedCandidates);

    if (!responseData || (!responseData.users && Object.keys(responseData).length === 0)) {
        console.log("No user data available.");
        return;
    }

    // Step 1: Create lookup for user extra data
    const userResults = {};
    Object.keys(responseData).forEach(key => {
        if (!isNaN(key) && responseData[key].user_id) {
            userResults[responseData[key].user_id.toString()] = responseData[key];
        }
    });

    // Step 2: Get main user array from responseData.users
    const usersArray = Array.isArray(responseData.users)
        ? responseData.users
        : Object.values(responseData.users || {});

    // Step 3: Filter each user
    const filteredData = usersArray.reduce((acc, user) => {
        const userId = user.user_id?.toString() || user.id?.toString();
        if (!userId) return acc;

        const userExtraData = userResults[userId];
        if (!userExtraData) return acc; // Skip if no results

        let matchesAssessment = selectedAssessmentResults.size === 0;
        const matchesCandidate = selectedCandidates.size === 0 || selectedCandidates.has(userId);

        console.log("Checking user:", userId, "Matches Candidate:", matchesCandidate);

        // === OCEAN DOMAIN ===
        if (filterType === "OCEAN" && userExtraData.oceanDomainResult) {
            Object.values(userExtraData.oceanDomainResult).forEach(domain => {
                const level = domain.level_description?.toLowerCase();
                console.log("Checking domain level:", level);
                if (level && selectedAssessmentResults.has(level)) {
                    matchesAssessment = true;
                }
            });
        }

        // === OCEAN FACETS ===
        const traitFacets = @json(config('helpers.trait_facets'));

        if (
            traitFacets[filterType] &&
            userExtraData.oceanAllFacetsResult
        ) {
            Object.values(userExtraData.oceanAllFacetsResult).forEach(facet => {
                const slug = facet.slug;
                const level = facet.level_description?.toLowerCase();
                if (
                    slug &&
                    level &&
                    traitFacets[filterType].includes(slug) &&
                    selectedAssessmentResults.has(level)
                ) {
                    matchesAssessment = true;
                }
            });
        }

        // === Cognitive Ability ===
        if (filterType === "Cognitive Ability" && userExtraData.cognitiveDomainResult) {
            Object.values(userExtraData.cognitiveDomainResult).forEach(domain => {
                const level = domain.level_description?.toLowerCase();
                if (level && selectedAssessmentResults.has(level)) {
                    matchesAssessment = true;
                }
            });
        }

        // === Push if both match ===
        if (matchesAssessment && matchesCandidate) {
            if (!userExtraData.user && user.user) {
                userExtraData.user = user.user;
            }
            userExtraData.user_id = userId;
            acc.push(userExtraData);
        }

        return acc;
    }, []);

    console.log(`Filtered Users for ${filterType}:`, filteredData);

    // === UI Update ===
    switch (filterType) {
        case "OCEAN": populateOceanDomains(filteredData); break;
        case "Openness": populate_Openness_to_Experience(filteredData); break;
        case "Conscientiousness": populate_Conscientiousness(filteredData); break;
        case "Extraversion": populate_Extraversion(filteredData); break;
        case "Agreeableness": populate_Agreeableness(filteredData); break;
        case "Emotional Stability": populate_Emotional_Stability(filteredData); break;
        case "Cognitive Ability": populateCognitiveAbility(filteredData); break;
    }
}




            // **Event Listeners for Filter Buttons**
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('button-filter-apply') || e.target.classList.contains('button-filter-cancel')) {
                    const filterFooter = e.target.closest('.filter-footer'); // Ensure it finds the correct container
                    if (!filterFooter) {
                        console.error("Filter footer not found for button:", e.target);
                        return;
                    }

                    const filterType = filterFooter.getAttribute("data-type"); // Use getAttribute explicitly
                    if (!filterType) {
                        console.error("Filter type is undefined. Check 'data-filter-type' in HTML:", filterFooter);
                        return;
                    }

                    console.log(`Applying filters for: ${filterType}`);

                    if (e.target.classList.contains('button-filter-apply')) {
                        applyFilters(filterType);
                    }

                    if (e.target.classList.contains('button-filter-cancel')) {
                        document.querySelectorAll('.filter-item input, .candidateList input').forEach(input => input.checked = false);
                        applyFilters(filterType); // Reset only this filter type
                    }
                }
            });


            // **Modify filter footers to include the specific filter type**
            document.querySelectorAll(".filter-footer").forEach(footer => {
                footer.dataset.filterType = footer.closest(".filter-menu-item").dataset.filterType;
            });

            function handleToggleChange(event) {
                if (event.target === companyToggle) {
                    departmentToggle.checked = false;
                } else if (event.target === departmentToggle) {
                    companyToggle.checked = false;
                }
                populateOceanDomains(responseData);
            }

            function handleOpennessToggleChange(event) {
                if (event.target === companyToggleOpenness) {
                    departmentToggleOpenness.checked = false;
                } else if (event.target === departmentToggleOpenness) {
                    companyToggleOpenness.checked = false;
                }
                populate_Openness_to_Experience(responseData);
            }

            function handleConscientiousnessToggleChange(event) {
                if (event.target === companyToggleConscientiousness) {
                    departmentToggleConscientiousness.checked = false;
                } else if (event.target === departmentToggleConscientiousness) {
                    companyToggleConscientiousness.checked = false;
                }
                populate_Conscientiousness(responseData);
            }

            function handleExtraversionToggleChange(event) {
                if (event.target === companyToggleExtraversion) {
                    departmentToggleExtraversion.checked = false;
                } else if (event.target === departmentToggleExtraversion) {
                    companyToggleExtraversion.checked = false;
                }
                populate_Extraversion(responseData);
            }

            function handleAgreeablenessToggleChange(event) {
                if (event.target === companyToggleAgreeableness) {
                    departmentToggleAgreeableness.checked = false;
                } else if (event.target === departmentToggleAgreeableness) {
                    companyToggleAgreeableness.checked = false;
                }
                populate_Agreeableness(responseData);
            }

            function handleEmotionalToggleChange(event) {
                if (event.target === companyToggleEmotional) {
                    departmentToggleEmotional.checked = false;
                } else if (event.target === departmentToggleEmotional) {
                    companyToggleEmotional.checked = false;
                }
                populate_Emotional_Stability(responseData);
            }

            companyToggle.addEventListener("change", handleToggleChange);
            departmentToggle.addEventListener("change", handleToggleChange);
            companyToggleOpenness.addEventListener("change", handleOpennessToggleChange);
            departmentToggleOpenness.addEventListener("change", handleOpennessToggleChange);
            companyToggleConscientiousness.addEventListener("change", handleConscientiousnessToggleChange);
            departmentToggleConscientiousness.addEventListener("change", handleConscientiousnessToggleChange);
            companyToggleExtraversion.addEventListener("change", handleExtraversionToggleChange);
            departmentToggleExtraversion.addEventListener("change", handleExtraversionToggleChange);
            companyToggleAgreeableness.addEventListener("change", handleAgreeablenessToggleChange);
            departmentToggleAgreeableness.addEventListener("change", handleAgreeablenessToggleChange);
            companyToggleEmotional.addEventListener("change", handleEmotionalToggleChange);
            departmentToggleEmotional.addEventListener("change", handleEmotionalToggleChange);

            // Initial population of data
            populateOceanDomains(responseData);
            populate_Openness_to_Experience(responseData);
            populate_Conscientiousness(responseData);
            populate_Extraversion(responseData);
            populate_Agreeableness(responseData);
            populate_Emotional_Stability(responseData);
            populateRIASEC(responseData);
            populateCognitiveAbility(responseData);
        });
    </script>

    <script>
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-user-icon")) {
                const userId = e.target.getAttribute("data-user-id");

                // ✅ Remove user from DOM (Comparison section)
                document.getElementById(`user-${userId}`)?.remove();

                // ✅ Remove from responseData.users
                responseData.users = responseData.users.filter(user => user.user_id !== userId);

                // ✅ Remove from userColors
                delete userColors[userId];

                // ✅ Remove from progress bars and stacked icons
                document.querySelectorAll(`.circle[data-user-id="${userId}"]`).forEach(el => el.remove());

                // ✅ Remove from RIASEC and Cognitive UI
                document.getElementById(`riasec-user-${userId}`)?.remove();

                cognitiveCategories.low.delete(userId);
                cognitiveCategories.moderate.delete(userId);
                cognitiveCategories.high.delete(userId);

                // ✅ Re-populate the data after removing the user (Recalculate averages)
                populateOceanDomains(responseData.users);
                populateFactsOpenness(responseData.users);
                populateFactsConscientiousness(responseData.users);
                populateFactsExtraversion(responseData.users);
                populateFactsAgreeableness(responseData.users);
                populateFactsEmotionalStability(responseData.users);
                populateCognitiveAbility(responseData.users);

                console.log(`Removed user with ID: ${userId}`);
            }
        });
    </script>


@endsection
