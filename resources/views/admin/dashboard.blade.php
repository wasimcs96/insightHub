@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('styles')
    <style>
        .dashboard {
            display: flex;
            flex-direction: column;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-row {
            display: flex;
            padding: 20px;
            justify-content: space-between;
            gap: 15px;
        }

        .dashboard-widget {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 10px;
            flex: 1;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            min-height: 200px;
        }

        .dashboard-widget.compact {
            flex: 0 0 16%;
            min-height: 150px;
        }

        .dashboard-widget.small {
            flex: 0 0 22%;
        }

        .headcount .number {
            font-size: 36px;
            font-weight: bold;
            color: #007bff;
        }

        .headcount .label {
            font-size: 14px;
            color: #666;
        }

        .chart-container {
            height: 250px;
            margin-top: 20px;
        }

        .tabs-container {
            display: flex;
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

        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        @media (max-width: 768px) {
            .dashboard-row {
                flex-direction: column;
            }
            .dashboard-widget {
                flex: none;
            }
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Dashboard</li>
                </ul>
            </div>

            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @if(auth()->user()->role_id != 13)
                <div class="tabs-container" style="width: 330px;">
                    <a class="tab-button {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"
                        href="/admin/dashboard">Demographic</a>
                    <a class="tab-button" href="/admin/analytical/dashboard">Analytical</a>
                    <a class="tab-button" href="/admin/skill-gap/dashboard">Skills Gap</a>
                </div>
                @endif

                <!-- Optimized Filter Menu -->
                <div class="m-0">
                    <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <iconify-icon icon="mingcute:filter-line" class="fa-1x"></iconify-icon>
                        Filter
                    </a>

                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                        </div>
                        <div class="separator border-gray-200"></div>

                        <div class="px-7 py-5">
                            <form action="" method="GET" id="filterForm">
                                <div class="mb-10">
                                    <label class="form-label fw-semibold">Age:</label>
                                    <select class="form-select form-select-solid" name="age">
                                        <option value="">Select Age</option>
                                        <option value="15_20" {{ request('age') == '15_20' ? 'selected' : '' }}>15 - 20 Years</option>
                                        <option value="21_25" {{ request('age') == '21_25' ? 'selected' : '' }}>21 - 25 Years</option>
                                        <option value="26_30" {{ request('age') == '26_30' ? 'selected' : '' }}>26 - 30 Years</option>
                                        <option value="31_35" {{ request('age') == '31_35' ? 'selected' : '' }}>31 - 35 Years</option>
                                        <option value="36_40" {{ request('age') == '36_40' ? 'selected' : '' }}>36 - 40 Years</option>
                                        <option value="40_100" {{ request('age') == '40_100' ? 'selected' : '' }}>40 + Years</option>
                                    </select>
                                </div>

                                <div class="mb-10">
                                    <label class="form-label fw-semibold">Gender:</label>
                                    <select class="form-select form-select-solid" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>Male</option>
                                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>

                                <div class="mb-10">
                                    <label class="form-label fw-semibold">Department:</label>
                                    <select class="form-select form-select-solid" name="department_id">
                                        <option value="">Select Department</option>
                                        @foreach ($departmentsMain as $dept)
                                            <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>
                                                {{ $dept->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="/admin/dashboard" class="btn btn-sm btn-light me-2">Reset</a>
                                    <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container">
            <div class="dashboard">
                <!-- First Row: Main Stats -->
                <div class="dashboard-row">
                    <div class="dashboard-widget" style="width: 22%;">
                        <div class="headcount">
                            <div class="number" id="totalRegisteredUsers"><span class="change float-end"></span>
                            </div>

                            <div class="label">Total HeadCount</div>

                        </div>
                        <div id="head_count" class="d-flex justify-content-center mt-xxl-10 overflow-hidden">
                            <!-- Placeholder for Age Bar Chart -->
                        </div>
                    </div>
                    <div style="width:16% !important">
                        <div class="col-lg-12 card card-body mb-7">
                            <!--begin::Items-->
                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-30px me-5 mb-8" style="margin-top: 14px;">
                                    <span class="symbol-label">
                                        <iconify-icon icon="mdi:human-male" class="fa-5x"></iconify-icon>
                                    </span>
                                </div>
                                <!--end::Symbol-->

                                <!--begin::Stats-->
                                <div class="m-0">
                                    <!--begin::Number-->
                                    <span
                                        class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1" id="totalMaleUsers"></span>
                                    <!--end::Number-->

                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-6">Male</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Items-->
                        </div>
                        <div class="col-lg-12 card card-body mt-20">
                            <!--begin::Items-->
                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-30px me-5 mb-8" style="margin-top: 14px;">
                                    <span class="symbol-label">
                                        <iconify-icon icon="mdi:human-female" class="fa-5x"></iconify-icon>
                                    </span>
                                </div>
                                <!--end::Symbol-->

                                <!--begin::Stats-->
                                <div class="m-0">
                                    <!--begin::Number-->
                                    <span
                                        class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1" id="totalFemaleUsers"></span>
                                    <!--end::Number-->

                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-6">Female</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Items-->
                        </div>
                    </div>

                    {{-- <div class="dashboard-widget small">
                        <div class="headcount">
                            <div class="number" id="totalRegisteredUsers"></div>
                            <div class="label">Total HeadCount</div>
                        </div>
                        <div id="head_count" class="chart-container"></div>
                    </div>

                    <div style="width:16% !important">
                        <div class="col-lg-12 card card-body mb-7">
                            <!--begin::Items-->
                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                <!--begin::Symbol and Stats-->
                                <div class="d-flex align-items-center">
                                    <!-- Symbol -->
                                    <div class="symbol symbol-30px me-5 mb-8" style="margin-top: 14px;">
                                        <span class="symbol-label">
                                            <iconify-icon icon="mdi:human-male" class="fa-5x"></iconify-icon>
                                        </span>
                                    </div>
                                    <!-- Stats -->
                                    <div class="m-0">
                                        <!-- Number -->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1" id="totalMaleUsers"></span>
                                        <!-- Description -->
                                        <span class="text-gray-500 fw-semibold fs-6">Male</span>
                                    </div>
                                </div>
                                <!--end::Symbol and Stats-->
                            </div>
                            <!--end::Items-->
                        </div>
                    
                        <div class="col-lg-12 card card-body mt-10">
                            <!--begin::Items-->
                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                <!--begin::Symbol and Stats-->
                                <div class="d-flex align-items-center">
                                    <!-- Symbol -->
                                    <div class="symbol symbol-30px me-5 mb-8" style="margin-top: 14px;">
                                        <span class="symbol-label">
                                            <iconify-icon icon="mdi:human-female" class="fa-5x"></iconify-icon>
                                        </span>
                                    </div>
                                    <!-- Stats -->
                                    <div class="m-0">
                                        <!-- Number -->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1" id="totalFemaleUsers"></span>
                                        <!-- Description -->
                                        <span class="text-gray-500 fw-semibold fs-6">Female</span>
                                    </div>
                                </div>
                                <!--end::Symbol and Stats-->
                            </div>
                            <!--end::Items-->
                        </div>
                    </div> --}}
                    

                    {{-- <div style="width:16% !important">
                        <div class="col-lg-12 card card-body mb-7">
                            <!--begin::Items-->
                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-30px me-5 mb-8" style="margin-top: 14px;">
                                    <span class="symbol-label">
                                        <iconify-icon icon="mdi:human-male" class="fa-5x"></iconify-icon>
                                    </span>
                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1" id="totalMaleUsers"></span>

                                </div>
                                <!--end::Symbol-->
                    
                                <!--begin::Stats-->
                                <div class="m-0">
                                    <!--begin::Number-->
                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1" id="totalMaleUsers"></span>
                                    <!--end::Number-->
                    
                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-6">Male</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Items-->
                        </div>
                    
                        <div class="col-lg-12 card card-body mt-10">
                            <!--begin::Items-->
                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-30px me-5 mb-8" style="margin-top: 14px;">
                                    <span class="symbol-label">
                                        <iconify-icon icon="mdi:human-female" class="fa-5x"></iconify-icon>
                                    </span>
                                </div>
                                <!--end::Symbol-->
                    
                                <!--begin::Stats-->
                                <div class="m-0">
                                    <!--begin::Number-->
                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1" id="totalFemaleUsers"></span>
                                    <!--end::Number-->
                    
                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-6">Female</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Items-->
                        </div>
                    </div> --}}
                    
                    {{-- <div class="dashboard-widget compact">
                        <div class="card-body">
                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                <div class="symbol symbol-30px mb-8">
                                    <iconify-icon icon="mdi:human-male" class="fa-3x"></iconify-icon>
                                </div>
                                <div class="m-0">
                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 mb-1" id="totalMaleUsers">1188</span>
                                    <span class="text-gray-500 fw-semibold fs-6">Male</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-3">
                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                <div class="symbol symbol-30px mb-8">
                                    <iconify-icon icon="mdi:human-female" class="fa-3x"></iconify-icon>
                                </div>
                                <div class="m-0">
                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 mb-1" id="totalFemaleUsers">424</span>
                                    <span class="text-gray-500 fw-semibold fs-6">Female</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    <div class="dashboard-widget tenure">
                        <div class="card-header border-0 pt-2 pb-2">
                            <h3 class="card-title">
                                <span class="card-label fw-bold fs-3 mb-1">Tenure</span>
                            </h3>
                        </div>
                        <div id="tenure" class="chart-container"></div>
                    </div>

                    <div class="dashboard-widget">
                        <div class="card-header border-0 pt-2 pb-2">
                            <h3 class="card-title">
                                <span class="card-label fw-bold fs-3 mb-1">Age</span>
                            </h3>
                        </div>
                        <div id="age" class="chart-container"></div>
                    </div>
                </div>

                <!-- Second Row: Detailed Charts -->
                <div class="dashboard-row pt-0">
                    <div class="dashboard-widget" style="flex: 0 0 39%;">
                        <div class="card-header border-0 pt-2 pb-2">
                            <h3 class="card-title">
                                <span class="card-label fw-bold fs-3 mb-1">City</span>
                            </h3>
                        </div>
                        <div id="treemap" class="chart-container"></div>
                    </div>

                    <div class="dashboard-widget">
                        <div class="card-header border-0 pt-2 pb-2">
                            <h3 class="card-title">
                                <span class="card-label fw-bold fs-3 mb-1">Position</span>
                            </h3>
                        </div>
                        <div id="position" class="chart-container"></div>
                    </div>

                    @if (!request('department_id'))
                    <div class="dashboard-widget">
                        <div class="card-header border-0 pt-2 pb-2">
                            <h3 class="card-title">
                                <span class="card-label fw-bold fs-3 mb-1">Department</span>
                            </h3>
                        </div>
                        <div id="department" class="chart-container"></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            loadAllCharts();
    
            // Re-render charts on filter submit
            document.getElementById("filterForm").addEventListener("submit", function(e){
                e.preventDefault();
                loadAllCharts(new FormData(this));
            });
        });
    
       
        const charts = {};
    
        function loadAllCharts(filters = null) {
            
            renderChart('headcount', '#head_count', filters);
            renderChart('tenure', '#tenure', filters);
            renderChart('age', '#age', filters);
            renderChart('city', '#treemap', filters);
            renderChart('position', '#position', filters);
            @if (!request('department_id'))
            renderChart('department', '#department', filters);
            @endif
            
        }
    
        function renderChart(type, selector, filters) {
            let url = "{{ url('/admin/dashboard/chart-data') }}/" + type;
            if (filters) {
                url += '?' + new URLSearchParams([...filters]).toString();
            }
            showOverlay();
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    let options = {};
    
                    switch (type) {
                        case 'headcount':
                            options = {
                                    chart: {
                                        width: 340, // Set width to 340
                                        type: 'donut',
                                        events: {
                                            click: function(chart, w, config) {
                                                // Static mapping for the labels
                                                var data = {
                                                    'Assessment Completed': 1,
                                                    'Assessment Not Completed': 2
                                                };
                                                var clickedAssessment = config.globals.labels[config.dataPointIndex]; // Get the clicked label
                                                if (clickedAssessment != undefined) {
                                                    // Redirect based on the clicked label
                                                    window.location.href = '/admin/myemployee?is_assessment=' + (data[clickedAssessment]);
                                                }
                                            }
                                        }
                                    },
                                    plotOptions: {
                                        pie: {
                                            startAngle: -90, // Set the start angle for the donut chart
                                            endAngle: 270 // Set the end angle for the donut chart
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false // Disable data labels
                                    },
                                    fill: {
                                        type: 'gradient' // Add gradient fill
                                    },
                                    series: data.assessmentGivenUsers, // Use the provided data for the series
                                    labels: ['Assessment Completed', 'Assessment Not Completed'], // Labels for the donut chart
                                    colors: ['#f7941d', '#000000'], // Colors for the chart segments
                                    legend: {
                                        position: 'bottom', // Position the legend at the bottom
                                        formatter: function(val, opts) {
                                            // Format the legend to show the value alongside the series count
                                            return val + " - " + opts.w.globals.series[opts.seriesIndex];
                                        }
                                    },
                                    responsive: [{
                                        breakpoint: 480, // For screens with width less than 480px
                                        options: {
                                            chart: {
                                                width: 200 // Adjust the width for smaller screens
                                            }
                                        }
                                    }]
                                };

                            // update totals
                            $("#totalRegisteredUsers").html(data.registeredUsersCount);
                            $("#totalMaleUsers").html(data.maleUsers);
                            $("#totalFemaleUsers").html(data.femaleUsers);
                            break;
    
                            case 'tenure':
                                 options = {
                                    series: [{
                                        data: data.values, // Use the data values from the previous chart
                                    }],
                                    chart: {
                                        height: 350, // Set height to 350
                                        type: 'bar',
                                        toolbar: {
                                            tools: {
                                                download: false // Disable download button
                                            }
                                        },
                                        events: {
                                            click: function(chart, w, config) {
                                                // Static mapping for the tenure levels
                                                var staticKeys = {
                                                    "< 1 year": "1_g",
                                                    "> 8 year": "8_g"
                                                };
                                                var clickedCity = config.globals.labels[config.dataPointIndex]; // Get the label of the clicked bar
                                                if (clickedCity != undefined) {
                                                    window.location.href = '/admin/myemployee?duration=' + staticKeys[clickedCity]; // Redirect based on clicked label
                                                }
                                            }
                                        }
                                    },
                                    plotOptions: {
                                        bar: {
                                            columnWidth: '45%', // Adjust width of each bar
                                            distributed: true, // Distribute bars evenly
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false // Disable data labels
                                    },
                                    legend: {
                                        show: false // Hide legend
                                    },
                                    xaxis: {
                                        categories: data.keys, // Use the keys from the previous data for categories
                                        labels: {
                                            style: {
                                                fontSize: '12px' // Set label font size
                                            }
                                        }
                                    }
                                };
                                break;


                        case 'age':
                             options = {
                                series: [{
                                    data: data.values // Use the existing data values
                                }],
                                chart: {
                                    height: 350, // Set height to 350
                                    type: 'bar',
                                    toolbar: {
                                        tools: {
                                            download: false // Disable download button
                                        }
                                    },
                                    events: {
                                        click: function(chart, w, config) {
                                            // Static mapping for age groups
                                            var staticData = {
                                                "15 to 20": "15_20",
                                                "21 to 25": "21_25",
                                                "26 to 30": "26_30",
                                                "31 to 35": "31_35",
                                                "36 to 39": "36_39",
                                                "40+": "40_150"
                                            };
                                            var clickedCity = config.globals.labels[config.dataPointIndex]; // Get the clicked age group
                                            if (clickedCity != undefined) {
                                                // Redirect based on the selected age group
                                                window.location.href = '/admin/myemployee?age=' + staticData[clickedCity];
                                            }
                                        }
                                    }
                                },
                                plotOptions: {
                                    bar: {
                                        columnWidth: '45%', // Adjust the width of each bar
                                        distributed: true, // Distribute bars evenly
                                    }
                                },
                                dataLabels: {
                                    enabled: false // Disable data labels
                                },
                                legend: {
                                    show: false // Hide legend
                                },
                                xaxis: {
                                    categories: [
                                        '15 to 20',
                                        '21 to 25',
                                        '26 to 30',
                                        '31 to 35',
                                        '36 to 41',
                                        '40+',
                                    ], // Categories based on the age groups
                                    labels: {
                                        style: {
                                            fontSize: '12px' // Set font size for labels
                                        }
                                    }
                                }
                            };
                            break;


    
                        case 'city':
                            // Build [{ x: 'City', y: count }, ...] from your key→value JSON
                            const seriesData = Object.entries(data).map(([city, count]) => ({ x: city, y: count }));

                            options = {
                                series: [{
                                    data: seriesData, // Use the dynamically generated series data
                                }],
                                chart: {
                                    type: 'bar',
                                    height: 380, // Set height to 380
                                    toolbar: {
                                        tools: {
                                            download: false // Disable download button
                                        }
                                    },
                                    events: {
                                        click: function(chart, w, config) {
                                            // Get the clicked city
                                            var clickedCity = config.globals.labels[config.dataPointIndex];
                                            if (clickedCity != undefined && clickedCity != "Other") {
                                                // Redirect based on the clicked city
                                                window.location.href = '/admin/myemployee?city=' + clickedCity;
                                            }
                                        }
                                    }
                                },
                                plotOptions: {
                                    bar: {
                                        barHeight: '100%', // Set bar height to 100%
                                        distributed: true, // Distribute bars evenly
                                        horizontal: true, // Make the bars horizontal
                                        dataLabels: {
                                            position: 'bottom' // Set label position to bottom
                                        },
                                    }
                                },
                                colors: [
                                    '#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', 
                                    '#f9a3a4', '#90ee7e', '#f48024', '#69d2e7'
                                ], // Set custom colors for bars
                                dataLabels: {
                                    enabled: true, // Enable data labels
                                    textAnchor: 'start', // Set text anchor to start
                                    style: {
                                        colors: ['#fff'] // Set label color to white
                                    },
                                    formatter: function(val, opt) {
                                        return opt.w.globals.labels[opt.dataPointIndex] + ": " + val; // Format the label to show city and count
                                    },
                                    offsetX: 0,
                                    dropShadow: {
                                        enabled: true // Enable drop shadow for data labels
                                    }
                                },
                                stroke: {
                                    width: 1,
                                    colors: ['#fff'] // Set stroke color to white for bar borders
                                },
                                yaxis: {
                                    labels: {
                                        show: false // Hide y-axis labels
                                    }
                                },
                                tooltip: {
                                    theme: 'dark', // Set dark theme for tooltips
                                    x: {
                                        show: false // Hide x-axis in tooltip
                                    },
                                    y: {
                                        title: {
                                            formatter: function() {
                                                return ''; // Remove title from tooltip
                                            }
                                        }
                                    }
                                }
                            };
                            break;


                        case 'position':
                            options = {
                                series: [{
                                    data: Object.values(data) // Use the values from the previous data
                                }],
                                chart: {
                                    height: 350, // Increased height from 250 to 350
                                    type: 'bar',
                                    toolbar: {
                                        tools: {
                                            download: false // Disables download tool
                                        }
                                    },
                                    events: {
                                        dataPointSelection: function(event, chartContext, config) {
                                            var index = config.dataPointIndex; // Get index of clicked bar
                                            var clickedLevel = Object.keys(data)[index]; // Get the corresponding key (level) from data
                                            console.log(clickedLevel);
                                            // Redirect using the selected level
                                            window.location.href = '/admin/myemployee?level=' + clickedLevel;
                                        }
                                    }
                                },
                                plotOptions: {
                                    bar: {
                                        borderRadius: 10,
                                        dataLabels: {
                                            position: 'top', // Display data labels at the top of bars
                                        },
                                    }
                                },
                                dataLabels: {
                                    enabled: true,
                                    formatter: function(val) {
                                        return val; // Show value as label
                                    },
                                    offsetY: -20,
                                    style: {
                                        fontSize: '12px',
                                        colors: ["#304758"]
                                    }
                                },
                                xaxis: {
                                    categories: Object.keys(data).map((key) => `Level ${key}`), // Use keys from data and format as "Level X"
                                    position: 'bottom',
                                    axisBorder: {
                                        show: false
                                    },
                                    axisTicks: {
                                        show: false
                                    },
                                    crosshairs: {
                                        fill: {
                                            type: 'gradient',
                                            gradient: {
                                                colorFrom: '#D8E3F0',
                                                colorTo: '#BED1E6',
                                                stops: [0, 100],
                                                opacityFrom: 0.4,
                                                opacityTo: 0.5,
                                            }
                                        }
                                    },
                                    tooltip: {
                                        enabled: false,
                                    }
                                },
                                yaxis: {
                                    axisBorder: {
                                        show: false
                                    },
                                    axisTicks: {
                                        show: false,
                                    },
                                    labels: {
                                        show: true,
                                        formatter: function(val) {
                                            return val; // Show value on y-axis labels
                                        }
                                    }
                                }
                            };
                            break;

                            
                        // case 'position':
                        //     const positionSeriesData = Object.entries(data).map(([level, count]) => ({
                        //         x: `Level ${level}`,
                        //         y: count
                        //     }));

                        //     options = {
                        //         series: [{ data: positionSeriesData }],
                        //         chart: { type: 'bar', height: 350, 
                        //             toolbar: {
                        //                         tools: {
                        //                             download: false
                        //                         }
                        //                     }, },
                        //         plotOptions: {
                        //             bar: {
                        //                 horizontal: true,
                        //                 distributed: true,
                        //                 dataLabels: { position: 'center' }
                        //             }
                        //         },
                        //         dataLabels: {
                        //             enabled: true,
                        //             formatter: function (val, opts) {
                        //                 const point = opts.w.config.series[opts.seriesIndex].data[opts.dataPointIndex];
                        //                 return `${point.y}`;  // always shows Level X: Value
                        //             },
                        //             style: {
                        //                 colors: ['#fff'],
                        //                 fontWeight: 'bold'
                        //             }
                        //         },
                        //         // hide axis labels so only the in-bar labels show
                        //         xaxis: { labels: { show: true }, axisTicks: { show: false }, axisBorder: { show: false } },
                        //         yaxis: { labels: { show: false } },
                        //         legend: { show: true },  // optional
                        //         colors: [
                        //             '#38BDF8', '#475569', '#F43F5E', '#10B981',
                        //             '#A78BFA', '#0EA5E9', '#F59E0B', '#EC4899',
                        //             '#22C55E', '#EAB308', '#3B82F6'
                        //         ],
                        //         tooltip: {
                        //                 y: {
                        //                     title: {
                        //                         formatter: () => '' 
                        //                     }
                        //                 }
                        //             }
                        //     };
                        //     break;


                        // case 'department':
                        //     // Build [{ x: 'Department Name', y: count }, ...] from your key→value JSON
                        //     const departmentSeriesData = Object.entries(data).map(([dept, count]) => ({
                        //         x: dept,
                        //         y: count
                        //     }));

                        //     options = {
                        //         series: [{ data: departmentSeriesData }],
                        //         chart: { type: 'bar', height: 350,
                        //             toolbar: {
                        //                         tools: {
                        //                             download: false
                        //                         }
                        //                     },
                        //          },
                        //         plotOptions: {
                        //             bar: {
                        //                 horizontal: true,
                        //                 distributed: true,
                        //                 dataLabels: { position: 'center' }
                        //             }
                        //         },
                        //         dataLabels: {
                        //             enabled: true,
                        //             formatter: function (val, opts) {
                        //                 const point = opts.w.config.series[opts.seriesIndex].data[opts.dataPointIndex];
                        //                 return `${point.y}`;  // show only the number inside bars
                        //             },
                        //             style: {
                        //                 colors: ['#fff'],
                        //                 fontWeight: 'bold'
                        //             }
                        //         },
                        //         // hide axis labels so only the in-bar labels show
                        //         xaxis: { labels: { show: true }, axisTicks: { show: false }, axisBorder: { show: false } },
                        //         yaxis: { labels: { show: false } },
                        //         legend: { show: true }, // optional
                        //         colors: [
                        //             '#38BDF8', '#475569', '#F43F5E', '#10B981',
                        //             '#A78BFA', '#0EA5E9', '#F59E0B', '#EC4899',
                        //             '#22C55E', '#EAB308', '#3B82F6'
                        //         ],
                        //         tooltip: {
                        //                 y: {
                        //                     title: {
                        //                         formatter: () => '' 
                        //                     }
                        //                 }
                        //             }
                        //     };
                        //     break;


                        case 'department':
                            options = {
                                series: [{
                                    data: Object.values(data), // Use the values from the original data object
                                }],
                                chart: {
                                    height: 350, // Set height to 350
                                    type: 'bar',
                                    toolbar: {
                                        tools: {
                                            download: false // Disable the download tool
                                        }
                                    },
                                    events: {
                                        click: function(event, chartContext, config) {
                                            // Get the clicked department name
                                            var clickedDepartment = config.globals.labels[config.dataPointIndex];
                                            // Redirect to the employee page with the department name
                                            window.location.href = '/admin/myemployee?department_name=' + clickedDepartment;
                                        }
                                    }
                                },
                                plotOptions: {
                                    bar: {
                                        borderRadius: 10, // Set border radius for bars
                                        dataLabels: {
                                            position: 'top' // Position data labels at the top
                                        }
                                    }
                                },
                                dataLabels: {
                                    enabled: true, // Enable data labels
                                    formatter: function(val) {
                                        return val; // Display the value as the label
                                    },
                                    offsetY: -20, // Adjust the position of the labels
                                    style: {
                                        fontSize: '12px', // Set label font size
                                        colors: ["#304758"] // Set label color
                                    }
                                },
                                xaxis: {
                                    categories: Object.keys(data), // Use the keys from the original data object for categories
                                    position: 'bottom', // Position the x-axis at the bottom
                                    axisBorder: {
                                        show: false // Hide the axis border
                                    },
                                    axisTicks: {
                                        show: false // Hide the axis ticks
                                    },
                                    crosshairs: {
                                        fill: {
                                            type: 'gradient',
                                            gradient: {
                                                colorFrom: '#D8E3F0',
                                                colorTo: '#BED1E6',
                                                stops: [0, 100],
                                                opacityFrom: 0.4,
                                                opacityTo: 0.5,
                                            }
                                        }
                                    },
                                    tooltip: {
                                        enabled: false, // Disable tooltips on the x-axis
                                    }
                                },
                                yaxis: {
                                    axisBorder: {
                                        show: false // Hide the y-axis border
                                    },
                                    axisTicks: {
                                        show: false, // Hide the y-axis ticks
                                    },
                                    labels: {
                                        show: false, // Hide the y-axis labels
                                        formatter: function(val) {
                                            return val; // Return the value (not used since labels are hidden)
                                        }
                                    }
                                }
                            };
                            break;

                    }
                    
                    // if chart already exists, just update it
                    if (charts[type]) {
                        charts[type].updateOptions(options, true, true);
                    } else {
                        charts[type] = new ApexCharts(document.querySelector(selector), options);
                        charts[type].render();
                    }
                    hideOverlay();
                });

        }
    </script>
    
@endsection
