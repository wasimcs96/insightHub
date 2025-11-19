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
  <style>
    .funnel {
        width: 20%;
      margin: 0 auto;
    }

    .stage {
      position: relative;
      width: 100%;
      margin: 0 auto;
      text-align: center;
      color: white;
    }

    /* .stage:before,
    .stage:after {
      content: "";
      position: absolute;
      bottom: -30px;
      border: 15px solid transparent;
      z-index: 1;
    }

    .stage:before {
      left: 50%;
      border-left-width: 30px;
      border-right-width: 30px;
      border-bottom-color: white;
      transform: translateX(-50%);
    }

    .stage:after {
      left: 50%;
      border-left-width: 30px;
      border-right-width: 30px;
      transform: translateX(-50%);
      z-index: -1;
    } */

    .stage div {
        background-color: #f7941d;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .applicants,
    .qualified {
      width: 120%;
      left: -10%;
      position: relative;
    }

    .interviewed {
      width: 80%;
    }

    .offered {
      width: 48%;
    }

    .offered:after,
    .offered:before {
      display: none;
    }

    .offered div {
      margin-bottom: 30px;
    }

    /* .stage:last-child div {
      padding: 10px 20px;
      background-color: transparent;
      color: black;
    } */

    .funnel-number {
      font-weight: bold;
    }
    .placed {
    width: 35%;
}
  </style>
@endsection
@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Talent Management Dashboard
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Admin </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    Talent Management Dashboard
                </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>

        <div>
            <a class="btn btn-secondary" href="/admin/dashboard">Demographic</a>
            <a class="btn btn-secondary" @if(request()->is('admin/talent-management/dashboard'))style="background-color: #f7941d; color:white;" @endif href="/admin/analytical/dashboard">Analytical</a>

        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="m-0">
                <!--begin::Menu toggle-->
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end">
                    <iconify-icon icon="mingcute:filter-line" class="fa-1x"></iconify-icon>
                    Filter
                </a>
                <!--end::Menu toggle-->



                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                    id="kt_menu_65e95fe68ac03">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Menu separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Menu separator-->


                    <!--begin::Form-->
                    <div class="px-7 py-5">
                        <!--begin::Input group-->
                        <form action="">

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
                                        <option class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Talent Acquisition
                                        </option>
                                        <option class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                           Talent Management</option>
                                        <option class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Talent Development</option>
                                        <option class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Performance Management</option>

                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Department:</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <div>
                                    <select class="form-select form-select-solid" data-close-on-select="false"
                                        data-placeholder="Select option" name="department" data-allow-clear="true">

                                        <option selected="Selected" value=""
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Select Department</option>

                                        <option @if (request('gender')=='0' ) selected @endif value="0"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Human Resources
                                        </option>
                                        <option @if (request('gender')==1) selected @endif value="1"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Finance Management</option>
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>

                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <a href="/admin/dashboard" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true">Reset</a>

                                <button type="submit" class="btn btn-sm btn-primary"
                                    data-kt-menu-dismiss="true">Apply</button>
                            </div>
                        </form>
                        <!--end::Actions-->
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Menu 1-->
            </div>
            <!--end::Filter menu-->


            <!--begin::Secondary button-->
            <!--end::Secondary button-->

            <!--begin::Primary button-->
            {{-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                data-bs-target="#kt_modal_create_app">
                Create </a> --}}
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>






<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid " style="padding-top: 0px;">


    <!--begin::Content container-->
      <!--begin::Content container-->
      <div id="kt_app_content_container" class="app-container  ">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold">Average Age by Department</h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0" id="average_age">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold">Gender </h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0 d-flex m-auto" id="gender">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold">Employee Education by Department </h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0" id="education_department">
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold">Average OCEAN Score by Department</h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0" id="avg_ocean">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold">Top 3 RIASEC Scores by Department </h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0 d-flex m-auto" id="riasec">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold">Flight Risk Levels by Department</h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0" id="flight_risk">
                    </div>
                </div>
            </div>

        </div>


        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold">Growth Potential Levels by Department</h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0" id="growth_level">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold">Organization Fit Level per Department</h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0 d-flex m-auto" id="org_fit_factor">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold"> KPI Achievement VS. Average C score of their OCEAN Result</h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0" id="kpi_c_score">
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold">KPI Achievement vs. Organization Fit Levels</h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0" id="kpi_off">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold">KPI Achievement vs. Raise Match Rate</h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0 d-flex m-auto" id="kpi_raisec">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header position-relative py-0 border-bottom-1">
                        <!--begin::Card title-->
                        <h3 class="card-title text-gray-800 fw-bold"> Average Technical Score Across Departments</h3>
                        <!--end::Card title-->

                    </div>
                    <div class="card-body p-0" id="tech_score">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->



@endsection

@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
<script src="{{ asset('admin/js/widgets.bundle.js')}}"></script>

<script>
    var options = {
      series: [{
        name: 'Department',
        data: [44, 55, 57, 56,43]
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
        categories: ['HR', 'Finance', 'Marketing', 'Sales', 'Engineering'],
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
            return  val + " Average Age"
          }
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#average_age"), options);
    chart.render();
  </script>

<script>
    var options = {
      series: [44, 55],
      chart: {
        width: 400,
        height: 350,
        type: 'donut',
      },
      plotOptions: {
        pie: {
          startAngle: -90,
          endAngle: 270
        }
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'gradient',
      },
      labels: ['Male', 'Female'],
      legend: {
        position: 'bottom',
        horizontalAlign: 'center', // Aligns the legend items horizontally at the center
        floating: false, // Ensures that the legend is not floating
        offsetY: 10 // Adjusts the vertical offset of the legend from the bottom
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
      var options = {
          series: [
          {
            name: 'Diploma',
            group: 'HR',
            data: [440, 550, 410, 500]
          },
          {
            name: 'Degree',
            group: 'Tech',
            data: [380, 350, 405, 350]
          },
          {
            name: 'Masters',
            group: 'Finance',
            data: [130, 360, 200, 300]
          },
          {
            name: 'PhD',
            group: 'Finance',
            data: [130, 460, 200, 800]
          },

        ],
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
        //   formatter: (val) => {
        //     return val / 1000 + 'K'
        //   }
        enabled: false
        },
        plotOptions: {
          bar: {
            horizontal: false
          }
        },
        xaxis: {
          categories: [
            'HR',
            'Tech',
            'Finance',
            'Sales',

          ]
        },
        fill: {
          opacity: 1
        },

        yaxis: {
          labels: {
            formatter: (val) => {
              return val
            }
          }
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
    var options = {
        series: [
        {
          name: 'Agreeableness',
          group: 'HR',
          data: [440, 550, 410, 500]
        },
        {
          name: 'Conscientiousness',
          group: 'Tech',
          data: [380, 350, 405, 350]
        },
        {
          name: 'Extraversion',
          group: 'Finance',
          data: [130, 360, 200, 300]
        },
        {
          name: 'Neuroticism',
          group: 'Finance',
          data: [130, 460, 200, 800]
        },
        {
          name: 'Openness',
          group: 'Finance',
          data: [130, 460, 200, 800]
        },

      ],
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
      //   formatter: (val) => {
      //     return val / 1000 + 'K'
      //   }
      enabled: false
      },
      plotOptions: {
        bar: {
          horizontal: false
        }
      },
      xaxis: {
        categories: [
            'HR',
            'Tech',
            'Finance',
            'Sales',



        ]
      },
      fill: {
        opacity: 1
      },

      yaxis: {
        labels: {
          formatter: (val) => {
            return val
          }
        }
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
    var options = {
      series: [{
        name: 'Artistic',
        data: [44, 55, 41, 67, 22, 43]
      }, {
        name: 'Investigative',
        data: [13, 23, 20, 8, 13, 27]
      }, {
        name: 'Realistic',
        data: [11, 17, 15, 15, 21, 14]
      }],
      chart: {
        type: 'bar',
        height: 400,
        width:400,
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
        },
      },
      xaxis: {
        categories: ['Customer', 'HR', 'Technical', 'Engineering', 'HR', 'Marketing']
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
    var options = {
      series: [{
        name: 'Low',
        data: [44, 55, 41, 67, 22, 43]
      }, {
        name: 'Moderate',
        data: [13, 23, 20, 8, 13, 27]
      }, {
        name: 'High',
        data: [11, 17, 15, 15, 21, 14]
      }],
      chart: {
        type: 'bar',
        height: 400,
        width:400,
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
              },

            }
          }
        },
      },
      colors: ['#1565c0', '#ffeb3b', '#f44336'],
      xaxis: {
        categories: ['Customer', 'HR', 'Technical', 'Engineering', 'HR', 'Marketing']
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
    var options = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Customer Support',
            data: [10, 15, 25, 0, 5]
        }, {
            name: 'Engineering',
            data: [15, 10, 0, 25, 20]
        }, {
            name: 'HR',
            data: [20, 15, 10, 5, 0]
        }, {
            name: 'Marketing',
            data: [0, 20, 10, 30, 25]
        }, {
            name: 'Sales',
            data: [25, 0, 15, 5, 10]
        }],
        xaxis: {
            categories: [20, 40, 60, 80, 100]
        },
        yaxis: {
            title: {
                text: 'Number of Employees'
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
        legend: {
            position: 'bottom',
            horizontalAlign: 'left'
        }
    };

    var chart = new ApexCharts(document.querySelector("#growth_level"), options);
    chart.render();
</script>

<script>
    var options = {
        chart: {
            type: 'bar',
            height: 400,
            width:400,
            stacked: true
        },
        series: [{
            name: 'Low Fit',
            data: [5, 3, 7, 2, 4]
        }, {
            name: 'Moderate Fit',
            data: [10, 12, 5, 15, 8]
        }, {
            name: 'High Fit',
            data: [20, 20, 23, 18, 23]
        }],
        xaxis: {
            categories: ['Customer Support', 'Engineering', 'HR', 'Marketing', 'Sales'],
            labels: {
                formatter: function(val) {
                    // This can be replaced with an actual function that fetches KPI data
                    var kpi = {
                        'Customer Support': '30%',
                        'Engineering': '60%',
                        'HR': '80%',
                        'Marketing': '50%',
                        'Sales': '40%'
                    };
                    return val + " (KPI: " + kpi[val] + ")";
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
    var options = {
        chart: {
            height: 350,
            type: 'bar'
        },
        series: [{
            name: 'KPI Achievement (%)',
            type: 'bar',
            data: [80, 70, 55, 60]
        }, {
            name: 'Average C Score',
            type: 'line',
            data: [3, 2.5, 2, 2.8]
        }],
        stroke: {
            width: [0, 4]
        },

        labels: ['Customer Support', 'Engineering', 'HR', 'Sales'],
        yaxis: [{
            title: {
                text: 'KPI Achievement (%)',
            },

        }, {
            opposite: true,
            title: {
                text: 'Average C Score'
            }
        }],
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(2);
                    }
                    return y;
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#kpi_c_score"), options);
    chart.render();
</script>
<script>
    var options = {
        chart: {
            type: 'bar',
            height: 400,
            width: 400,
            stacked: true
        },
        series: [{
            name: 'High Organizational Fit',
            data: [120, 140, 160, 180,150]
        }, {
            name: 'Moderate Organizational Fit',
            data: [80, 100, 120, 140,135]
        }, {
            name: 'Low Organizational Fit',
            data: [40, 60, 80, 100,130]
        }],
        xaxis: {
            categories: ['Customer Support', 'Engineering', 'HR', 'Marketing', 'Sales']
        },
        yaxis: {
            title: {
                text: 'KPI Achievement Rate (%)'
            },
            // min: 0,
            // max: 200
        },
        // plotOptions: {
        //     bar: {
        //         // horizontal: false,
        //         // barHeight: '75%',
        //     },
        // },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center'
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + "%"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#kpi_off"), options);
    chart.render();
</script>

<script>
    var options = {
        chart: {
            type: 'bar',
            height: 400,
            width: 400,

            stacked: true
        },
        series: [{
            name: 'High Match Rate',
            data: [120, 140, 160, 180]
        }, {
            name: 'Moderate Match Rate',
            data: [80, 100, 120, 140]
        }, {
            name: 'Low Match Rate',
            data: [40, 60, 80, 100]
        }],
        xaxis: {
            categories: ['Customer Support', 'Engineering', 'HR', 'Marketing']
        },
        yaxis: {
            title: {
                text: 'KPI Achievement Rate (%)'
            },

        },

        legend: {
            position: 'bottom',
            horizontalAlign: 'center'
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + "%"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#kpi_raisec"), options);
    chart.render();
</script>

<script>
    var options = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Average Technical Score',
            data: [75, 80, 85, 70,75] // Adjust these values based on your actual data
        }],
        xaxis: {
            categories: ['Customer Support', 'Engineering', 'HR', 'Marketing', 'Sales']
        },
        yaxis: {
            max: 100, // Since the score is out of 100
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
