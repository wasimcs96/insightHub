@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('styles')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #eaeaea;
            margin: 0;
            padding: 20px;
        }

        .dashboard {
            display: flex;
            justify-content: space-between;
            max-width: 100%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .summary-section {
            display: flex;
            flex-direction: column;
            width: 20%;
        }

        .summary-item {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 4px;
        }

        .summary-item h2 {
            margin: 0;
            font-size: 36px;
        }

        .summary-item p {
            margin: 10px 0 0;
            font-size: 18px;
        }

        .charts-section {
            display: flex;
            flex-direction: column;
            width: 50%;
        }

        .chart-item {
            background-color: #f9f9f9;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 4px;
            text-align: center;
        }

        .chart-placeholder {
            width: 100%;
            height: 150px;
            background-color: #eaeaea;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }

        .funnel-section {
            width: 20%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .funnel-placeholder {
            width: 100%;
            height: 350px;
            background-color: #eaeaea;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }

            .summary-section,
            .charts-section,
            .funnel-section {
                width: 100%;
            }

            .chart-placeholder,
            .funnel-placeholder {
                height: 250px;
            }
        }

        .funnel {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 25px;
            /* Adjusted gap */
        }

        .stage {
            width: 100%;
            position: relative;
            text-align: center;
        }

        .stage-content {
            background-color: #f7941d;
            padding: 15px 20px;
            /* Adjusted padding */
            border-radius: 8px;
            color: #ffffff;
            font-weight: bold;
            font-size: 1.5rem;
            /* Base font size for funnel */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            transition: transform 0.3s;
            /* Add a slight transform on hover */
        }

        .stage-content:hover {
            transform: translateY(-5px);
        }

        .funnel-number {
            font-size: 2rem;
            /* Adjusted for better readability */
            display: block;
        }

        .tabs-container {
            display: flex;
            border: 2px solid #F7941D;
            border-radius: 5px;
            overflow: hidden;
        }

        .two-container {
            display: flex;
            gap: 10px;
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

        @media (max-width: 768px) {
            .funnel {
                gap: 15px;
            }

            .stage-content {
                padding: 10px 15px;
            }

            .funnel-number {
                font-size: 1.25rem;
            }
        }
    </style>
@endsection

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Analytical Dashboard
                </h1>

                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Admin</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Analytical Dashboard</li>
                </ul>
            </div>

            {{-- <div>
            <a class="btn btn-secondary" href="/admin/dashboard">Demographic</a>
            <a class="btn btn-secondary" href="/admin/analytical/dashboard">Analytical</a>
        </div> --}}
            <div class="two-container">
                <div class="tabs-container" style="width: 330px;">
                    <a class="tab-button  {{ Request::segment(2) == 'dashboard' ? 'active' : '' }} "
                        href="/admin/dashboard">Demographic</a>
                    <a class="tab-button {{ Request::segment(2) == 'analytical' ? 'active' : '' }}"
                        href="/admin/analytical/dashboard">Analytical</a>
                    <a class="tab-button" href="/admin/skill-gap/dashboard">Skills Gap</a>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <iconify-icon icon="mingcute:filter-line" class="fa-1x"></iconify-icon>
                            Filter
                        </a>

                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true">
                            <div class="px-7 py-5">
                                <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                            </div>

                            <div class="separator border-gray-200"></div>

                            <div class="px-7 py-5">
                                <form action="{{ url('/admin/analytical/dashboard') }}" method="GET">
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold">Report:</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <div>
                                            <select class="form-select form-select-solid" data-close-on-select="false"
                                                data-placeholder="Select option" name="report" data-allow-clear="true">

                                                <option selected="Selected"
                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                    Select Report</option>
                                                <option value="talent_acquisition"
                                                    @if (request('report') == 'talent_acquisition') selected @endif
                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                    Talent Acquisition
                                                </option>
                                                <option value="talent_management"
                                                    @if (request('report') == 'talent_management') selected @endif
                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                    Talent Management</option>
                                                <option value="talent_development"
                                                    @if (request('report') == 'talent_development') selected @endif
                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                    Talent Development</option>
                                                <option value="performance_management"
                                                    @if (request('report') == 'performance_management') selected @endif
                                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                                    Performance Management</option>

                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>

                                    <div class="mb-10">
                                        <label class="form-label fw-semibold">Department:</label>
                                        <div>
                                            <select class="form-select form-select-solid" name="department">
                                                <option value="" {{ $departmentId ? '' : 'selected' }}>All Departments
                                                </option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ $departmentId == $department->id ? 'selected' : '' }}>
                                                        {{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ url('/admin/analytical/dashboard') }}"
                                            class="btn btn-sm btn-light me-2">Reset</a>
                                        <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container">
            <div class="dashboard">
                <div class="summary-section">
                    <div class="summary-item" style="background-color: #f7941d;">
                        <h2>{{ $aggregatedData['total_number_of_applications'] ?? 0 }}</h2>
                        <p>No. of Applications</p>
                    </div>
                    <div class="summary-item" style="background-color: #f7941d;">
                        <h2>{{ $aggregatedData['total_number_of_job_opening'] ?? 0 }}</h2>
                        <p>No. of Open Positions</p>
                    </div>
                    <div class="summary-item" style="background-color: #f7941d;">
                        <h2>{{ $aggregatedData['average_time_to_fill'] ?? '0 Days' }}</h2>
                        <p>Avg Time to Fill</p>
                    </div>
                </div>

                <div class="charts-section">
                    <div class="chart-item">
                        <div class="card-header border-0 pt-2 pb-2">
                            <h3 class="card-title">
                                Applicants by Subs/Dept
                            </h3>
                        </div>
                        <div id="application">
                            <!-- Chart will render here -->
                        </div>
                    </div>
                    <div class="chart-item">
                        <div class="card-header border-0 pt-2 pb-2">
                            <h3 class="card-title">
                                Open Position by Subs/Dept
                            </h3>
                        </div>
                        <div id="open_position">
                            <!-- Chart will render here -->
                        </div>
                    </div>
                    <div class="chart-item">
                        <div class="card-header border-0 pt-2 pb-2">
                            <h3 class="card-title">
                                Avg Time to Fill
                            </h3>
                        </div>
                        <div id="avgtime">
                            <!-- Chart will render here -->
                        </div>
                    </div>
                </div>

                <div class="funnel">
                    @foreach ([
            ['label' => 'Applicants', 'count' => $jobOpeningStatusWiseCounts[0] ?? 0, 'width' => '100%', 'font_size' => '1.5rem'],
            ['label' => 'Pending', 'count' => $jobOpeningStatusWiseCounts[1] ?? 0, 'width' => '92%', 'font_size' => '1.4rem'],
            ['label' => 'Assessment Pending', 'count' => $jobOpeningStatusWiseCounts[2] ?? 0, 'width' => '84%', 'font_size' => '1.3rem'],
            ['label' => 'Assessment Completed', 'count' => $jobOpeningStatusWiseCounts[3] ?? 0, 'width' => '76%', 'font_size' => '1.2rem'],
            ['label' => 'Shortlisted', 'count' => $jobOpeningStatusWiseCounts[4] ?? 0, 'width' => '68%', 'font_size' => '1.1rem'],
            ['label' => 'Interview Scheduled', 'count' => $jobOpeningStatusWiseCounts[5] ?? 0, 'width' => '60%', 'font_size' => '1rem'],
            ['label' => 'Interview Completed', 'count' => $jobOpeningStatusWiseCounts[6] ?? 0, 'width' => '52%', 'font_size' => '0.9rem'],
            ['label' => 'Contract Issued', 'count' => $jobOpeningStatusWiseCounts[7] ?? 0, 'width' => '44%', 'font_size' => '0.8rem'],
            ['label' => 'Hired', 'count' => $jobOpeningStatusWiseCounts[8] ?? 0, 'width' => '36%', 'font_size' => '0.8rem'],
        ] as $stage)
                        <div class="stage" style="width: {{ $stage['width'] }};">
                            <div class="stage-content"
                                style="font-size: {{ $stage['font_size'] }}; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                <h2 class="funnel-number">{{ $stage['count'] }}</h2>
                                <br>{{ $stage['label'] }}
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            {{-- <div class="card mt-5">
            <div class="card-header border-0 pt-2 pb-2">
                <h3 class="card-title">
                    Position Opening
                </h3>
            </div>
            <div class="card-body" id="open_position_hired">
                <!-- Chart will render here -->
            </div>
        </div> --}}
        </div>
    </div>
    <!--end::Content-->
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>

    <script>
        var applicantsByDeptOptions = {
            series: [{
                name: 'Total Applicants',
                data: @json(array_values($applicantsByDept))
            }],
            chart: {
                type: 'bar',
                height: 840
            },
            grid: {
                padding: {
                    bottom: 280 // ✅ Add this!
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: @json(array_keys($applicantsByDept)),
                labels: {
                    rotate: -85,
                    offsetY: 10
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " applicants";
                    }
                }
            }
        };

        var openPositionByDeptOptions = {
            series: [{
                name: 'Open Positions',
                data: @json(array_values($openPositionByDept))
            }],
            chart: {
                type: 'bar',
                height: 840
            },
            grid: {
                padding: {
                    bottom: 280 // ✅ Add this!
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: @json(array_keys($openPositionByDept)),
                labels: {
                    rotate: -85,
                    offsetY: 10
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " positions";
                    }
                }
            }
        };

        var avgTimeToFillByDeptOptions = {
            series: [{
                name: 'Average Time (Days)',
                data: @json(array_values($avgTimeToFillByDept))
            }],
            chart: {
                type: 'bar',
                height: 840
            },
            grid: {
                padding: {
                    bottom: 280 // ✅ Add this!
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: @json(array_keys($avgTimeToFillByDept)),
                labels: {
                    rotate: -85,
                    offsetY: 10
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " days";
                    }
                }
            }
        };

        var positionOpeningOptions = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Total Positions',
                data: [ /* Add your data */ ]
            }, {
                name: 'No. of Open Positions',
                data: [ /* Add your data */ ]
            }, {
                name: 'No. of Assigned Positions',
                data: [ /* Add your data */ ]
            }],
            xaxis: {
                categories: ['Business Analyst', 'Front End Dev', 'Back End Dev', 'Accountant', 'SOC Analyst']
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " positions"
                    }
                }
            }
        };

        var applicantsByDeptChart = new ApexCharts(document.querySelector("#application"), applicantsByDeptOptions);
        var openPositionByDeptChart = new ApexCharts(document.querySelector("#open_position"), openPositionByDeptOptions);
        var avgTimeToFillByDeptChart = new ApexCharts(document.querySelector("#avgtime"), avgTimeToFillByDeptOptions);
        var positionOpeningChart = new ApexCharts(document.querySelector("#open_position_hired"), positionOpeningOptions);

        applicantsByDeptChart.render();
        openPositionByDeptChart.render();
        avgTimeToFillByDeptChart.render();
        positionOpeningChart.render();
    </script>
@endsection
