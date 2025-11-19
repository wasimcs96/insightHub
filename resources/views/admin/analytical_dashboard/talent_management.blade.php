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
      height: 150px; /* Adjust height as needed */
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
      height: 350px; /* Adjust height as needed */
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

      .summary-section, .charts-section, .funnel-section {
          width: 100%;
      }

      .chart-placeholder, .funnel-placeholder {
          height: 250px; /* Adjust height for smaller screens */
      }
  }
  </style>
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Talent Management Dashboard
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    Talent Management Dashboard
                </li>
            </ul>
        </div>
        <div>
            <a class="btn btn-secondary" href="/admin/dashboard">Demographic</a>
            <a class="btn btn-secondary" @if(request()->is('admin/talent-management/dashboard')) style="background-color: #f7941d; color:white;" @endif href="/admin/analytical/dashboard">Analytical</a>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="m-0">
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <iconify-icon icon="mingcute:filter-line" class="fa-1x"></iconify-icon> Filter
                </a>
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_65e95fe68ac03">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5">
                        <form action="">
                            <div class="mb-10">
                                <label class="form-label fw-semibold">Report:</label>
                                <div>
                                    <select class="form-select form-select-solid" data-close-on-select="false"
                                        data-placeholder="Select option" name="report" data-allow-clear="true">
  
                                        <option selected="Selected"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Select Report</option>
                                        <option value="talent_acquisition" @if(request('report') == 'talent_acquisition') selected @endif class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Talent Acquisition
                                        </option>
                                        <option value="talent_management" @if(request('report') == 'talent_management') selected @endif class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                          Talent Management</option>
                                        <option value="talent_development" @if(request('report') == 'talent_development') selected @endif class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Talent Development</option>
                                        <option value="performance_management" @if(request('report') == 'performance_management') selected @endif class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Performance Management</option>
  
                                    </select>
                                   </div>
                            </div>
                            <div class="mb-10">
                                <label class="form-label fw-semibold">Department:</label>
                                <div>
                                    <select class="form-select form-select-solid" data-close-on-select="false" data-placeholder="Select option" name="department" data-allow-clear="true">
                                        <option selected="Selected" value="" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Select Department
                                        </option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->id }}" @if($departmentId == $department->id) selected @endif>
                                            {{ $department->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="/admin/dashboard" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</a>
                                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid" style="padding-top: 0px;">
    <div id="kt_app_content_container" class="app-container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <h3 class="card-title text-gray-800 fw-bold">Average Age by Department</h3>
                    </div>
                    <div class="card-body p-0" id="average_age"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <h3 class="card-title text-gray-800 fw-bold">Gender</h3>
                    </div>
                    <div class="card-body p-0 d-flex m-auto" id="gender"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <h3 class="card-title text-gray-800 fw-bold">Employee Education</h3>
                    </div>
                    <div class="card-body p-0" id="education_department"></div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <h3 class="card-title text-gray-800 fw-bold">Average OCEAN Score</h3>
                    </div>
                    <div class="card-body p-0" id="avg_ocean"></div>
                </div>
            </div>
            {{-- <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <h3 class="card-title text-gray-800 fw-bold">Top 3 RIASEC Scores by Department</h3>
                    </div>
                    <div class="card-body p-0 d-flex m-auto" id="riasec"></div>
                </div>
            </div> --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <h3 class="card-title text-gray-800 fw-bold">Flight Risk Levels</h3>
                    </div>
                    <div class="card-body p-0" id="flight_risk"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <h3 class="card-title text-gray-800 fw-bold">Organization Fit Levels</h3>
                    </div>
                    <div class="card-body p-0 d-flex m-auto" id="org_fit_factor"></div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            {{-- <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <h3 class="card-title text-gray-800 fw-bold">Growth Potential Levels by Department</h3>
                    </div>
                    <div class="card-body p-0" id="growth_level"></div>
                </div>
            </div> --}}
            {{-- <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <h3 class="card-title text-gray-800 fw-bold">Organization Fit Levels</h3>
                    </div>
                    <div class="card-body p-0 d-flex m-auto" id="org_fit_factor"></div>
                </div>
            </div> --}}
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <h3 class="card-title text-gray-800 fw-bold">Average Technical Score Across Departments</h3>
                    </div>
                    <div class="card-body p-0" id="tech_score"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>

<script>
    var averageAgeData = @json($averageAgeByDept);
    var categories = Object.keys(averageAgeData);
    var data = Object.values(averageAgeData);

    var options = {
        series: [{
            name: 'Average Age',
            data: data
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: categories,
        },
        yaxis: {
            title: {
                text: 'Average Age'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " years"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#average_age"), options);
    chart.render();
</script>

<script>
    var genderData = @json($genderByDept);
    var maleCount = genderData[0] || 0;
    var femaleCount = genderData[1] || 0;
    var notFilledCount = genderData[2] || 0;

    var options = {
        series: [maleCount, femaleCount, notFilledCount],
        chart: {
            width: 400,
            height: 350,
            type: 'donut',
        },
        labels: ['Male', 'Female', 'Not Filled Yet'],
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            floating: false,
            offsetY: 10
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#gender"), options);
    chart.render();
</script>

<script>
    var educationData = @json($educationByDept);
    var categories = Object.keys(educationData);
    var data = Object.values(educationData);

    var options = {
        series: [{
            name: 'Education Levels',
            data: data
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: false,
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        dataLabels: {
            enabled: false
        },
        plotOptions: {
            bar: {
                horizontal: false
            }
        },
        xaxis: {
            categories: categories
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left'
        }
    };

    var chart = new ApexCharts(document.querySelector("#education_department"), options);
    chart.render();
</script>

<script>
    var oceanData = @json($averageOceanScoreByDept);
    var categories = Object.keys(oceanData);
    var data = Object.values(oceanData);

    var options = {
        series: [{
            name: 'OCEAN Score',
            data: data
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: false,
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        dataLabels: {
            enabled: false
        },
        plotOptions: {
            bar: {
                horizontal: false
            }
        },
        xaxis: {
            categories: categories
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'left'
        }
    };

    var chart = new ApexCharts(document.querySelector("#avg_ocean"), options);
    chart.render();
</script>

<script>
    var riasecData = @json($riasecScoresByDept);
    var categories = Object.keys(riasecData);
    var data = Object.values(riasecData);

    var options = {
        series: [{
            name: 'RIASEC Scores',
            data: data
        }],
        chart: {
            type: 'bar',
            height: 400,
            stacked: true,
            toolbar: {
                show: true
            },
            zoom: {
                enabled: true
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 10,
                dataLabels: {
                    total: {
                        enabled: true,
                        style: {
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            }
        },
        xaxis: {
            categories: categories
        },
        legend: {
            position: 'bottom'
        },
        fill: {
            opacity: 1
        }
    };

    var chart = new ApexCharts(document.querySelector("#riasec"), options);
    chart.render();
</script>

<script>
    var flightRiskData = @json($flightRiskByDept);
    var categories = Object.keys(flightRiskData);
    var data = Object.values(flightRiskData);

    var options = {
        series: [{
            name: 'Flight Risk',
            data: data
        }],
        chart: {
            type: 'bar',
            height: 400,
            stacked: true,
            toolbar: {
                show: true
            },
            zoom: {
                enabled: true
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 10,
                dataLabels: {
                    total: {
                        enabled: true,
                        style: {
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            }
        },
        xaxis: {
            categories: categories
        },
        legend: {
            position: 'bottom'
        },
        fill: {
            opacity: 1
        }
    };

    var chart = new ApexCharts(document.querySelector("#flight_risk"), options);
    chart.render();
</script>

<script>
    var orgFitData = @json($orgFitByDept);
    var categories = Object.keys(orgFitData);
    var data = Object.values(orgFitData);

    var options = {
        chart: {
            type: 'bar',
            height: 400,
            width: 400,
            stacked: true
        },
        series: [{
            name: 'Organization Fit',
            data: data
        }],
        xaxis: {
            categories: categories,
            labels: {
                formatter: function(val) {
                    var kpi = {
                        'Customer Support': '30%',
                        'Engineering': '60%',
                        'HR': '80%',
                        'Marketing': '50%',
                        'Sales': '40%'
                    };
                    return val;
                }
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
            },
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center'
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Employees"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#org_fit_factor"), options);
    chart.render();
</script>

<script>
    var techScoreData = @json($averageTechScoreByDept);
    var categories = Object.keys(techScoreData);
    var data = Object.values(techScoreData);

    var options = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Average Technical Score',
            data: data
        }],
        xaxis: {
            categories: categories
        },
        yaxis: {
            max: 100,
            title: {
                text: 'Average Technical Score (1-100)'
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
            enabled: false
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " points"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#tech_score"), options);
    chart.render();
</script>

@endsection
