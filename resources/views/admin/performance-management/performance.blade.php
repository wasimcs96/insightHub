@extends('admin.layout.app')

@section('title', 'Roles')

@section('styles')
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

  <!--begin::Toolbar container-->
  <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
      <!--begin::Title-->
      <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
        Performance
      </h1>
      <!--end::Title-->


      <!--begin::Breadcrumb-->
      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
          <a href="/admin/dashboard" class="text-muted text-hover-primary">
            Performance </a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
          <span class="bullet bg-gray-500 w-5px h-2px"></span>
        </li>
        <!--end::Item-->

        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
          Performance Review </li>
        <!--end::Item-->

      </ul>
      <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->

    <!--end::Actions-->
  </div>
  <!--end::Toolbar container-->
</div>
<div id="kt_app_content" class="app-content  flex-column-fluid ">
  <!--begin::Content container-->
  <div id="kt_app_content_container" class="app-container  container-xxl ">
    <!--begin::Navbar-->
    <div class="card card-xl-stretch mb-xl-8">
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label fw-bold fs-1 mb-1">Performance Review</span>

        </h3>
      </div>
      <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
          <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade show active" id="kt_stats_widget_16_tab_1">
              <!--begin::Table container-->
              <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                  <!-- Table head -->
                  <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                      <th class="min-w-125px">Sr No</th>
                      <th class="min-w-125px">Objective</th>
                      <th class="min-w-125px">Weightage</th>
                      <th class="min-w-125px">KPI</th>
                      <th class="min-w-125px">Base Target</th>
                      <th class="min-w-125px">Stretch Target</th>
                      <th class="min-w-125px">Achivment</th>
                      <th class="min-w-125px">Self Rating</th>
                    </tr>
                  </thead>
                  <!-- Table body -->
                  <tbody class="text-gray-600 fw-semibold" id="tableBody">
                    @foreach($performanceManagement->details as $key => $performance)
                    <tr>
                      <td class="text-start pe-1  3">{{ $key + 1 }}</td>
                      <td class="text-start pe-13">{{ $performance->object }}</td>
                      <td class="text-start pe-13">{{ $performance->weightage }}%</td>
                      <td class="text-start pe-13">{{ $performance->kpi }}</td>
                      <td class="text-start pe-13">{{ $performance->base_target }}</td>
                      <td class="text-start pe-16">{{ $performance->stretch_target }}</td>
                      <td class="text-start pe-16">
                        <input type="text" name="acivment">
                      </td>
                      <td class="text-start pe-16">
                        <input type="text" name="self_rating">
                      </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <!--end::Table-->
              </div>
              <!--end::Table container-->
            </div>
          </div>
        </div>
        <!--end::Info-->
      </div>
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label fw-bold fs-1 mb-1">Technical SKills</span>

        </h3>
      </div>
      <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
          <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade show active" id="kt_stats_widget_16_tab_1">
              <!--begin::Table container-->
              <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                  <!-- Table head -->
                  <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                      <th class="min-w-125px">Sr No</th>
                      <th class="min-w-125px">Objective</th>
                      <th class="min-w-125px">Weightage</th>
                      <th class="min-w-125px">KPI</th>
                      <th class="min-w-125px">Base Target</th>
                      <th class="min-w-125px">Stretch Target</th>
                      <th class="min-w-125px">Achivment</th>
                      <th class="min-w-125px">Self Rating</th>
                    </tr>
                  </thead>
                  <!-- Table body -->
                  <tbody class="text-gray-600 fw-semibold" id="tableBody">
                    @foreach($performanceManagement->details as $key => $performance)
                    <tr>
                      <td class="text-start pe-1  3">{{ $key + 1 }}</td>
                      <td class="text-start pe-13">{{ $performance->object }}</td>
                      <td class="text-start pe-13">{{ $performance->weightage }}%</td>
                      <td class="text-start pe-13">{{ $performance->kpi }}</td>
                      <td class="text-start pe-13">{{ $performance->base_target }}</td>
                      <td class="text-start pe-16">{{ $performance->stretch_target }}</td>
                      <td class="text-start pe-16">
                        <input type="text" name="acivment">
                      </td>
                      <td class="text-start pe-16">
                        <input type="text" name="self_rating">
                      </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <!--end::Table-->
              </div>
              <!--end::Table container-->
            </div>
          </div>
        </div>
        <!--end::Info-->
      </div>
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label fw-bold fs-1 mb-1">Soft SKills</span>

        </h3>
      </div>
      <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
          <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade show active" id="kt_stats_widget_16_tab_1">
              <!--begin::Table container-->
              <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                  <!-- Table head -->
                  <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                      <th class="min-w-125px">Sr No</th>
                      <th class="min-w-125px">Objective</th>
                      <th class="min-w-125px">Weightage</th>
                      <th class="min-w-125px">KPI</th>
                      <th class="min-w-125px">Base Target</th>
                      <th class="min-w-125px">Stretch Target</th>
                      <th class="min-w-125px">Achivment</th>
                      <th class="min-w-125px">Self Rating</th>
                    </tr>
                  </thead>
                  <!-- Table body -->
                  <tbody class="text-gray-600 fw-semibold" id="tableBody">
                    @foreach($performanceManagement->details as $key => $performance)
                    <tr>
                      <td class="text-start pe-1  3">{{ $key + 1 }}</td>
                      <td class="text-start pe-13">{{ $performance->object }}</td>
                      <td class="text-start pe-13">{{ $performance->weightage }}%</td>
                      <td class="text-start pe-13">{{ $performance->kpi }}</td>
                      <td class="text-start pe-13">{{ $performance->base_target }}</td>
                      <td class="text-start pe-16">{{ $performance->stretch_target }}</td>
                      <td class="text-start pe-16">
                        <input type="text" name="acivment">
                      </td>
                      <td class="text-start pe-16">
                        <input type="text" name="self_rating">
                      </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <!--end::Table-->
              </div>
              <!--end::Table container-->
            </div>
          </div>
        </div>
        <!--end::Info-->
      </div>
    </div>
  </div>
</div>

@endsection