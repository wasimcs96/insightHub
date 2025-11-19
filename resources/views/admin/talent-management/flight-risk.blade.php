@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
<style>
    .image-input-placeholder {
        background-image: url({{asset("admin/media/svg/files/blank-image.svg")}});
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url({{asset("admin/media/svg/files/blank-image-dark.svg")}});
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Flight Risk
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Dashboard </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->


                <!--begin::Item-->
                <li class="breadcrumb-item capitalize text-muted">
                    Talent Management </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item capitalize text-muted">
                    Flight Risk </li>

            </ul>
            <!--end::Breadcrumb-->
        </div>

        <form class="d-flex align-items-center overflow-auto" action="">

            <div class="bullet bg-secondary h-35px w-1px mx-6"></div>
            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block"> Select Department:</span>
            <!--end::Label-->

            <!--begin::Select-->
            <select class="form-select form-select-sm w-125px form-select-solid me-6" data-control="select2" data-placeholder=" Select Department" data-hide-search="true" name="department_id" id="department">
                <option value="" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">All</option>
                @foreach($department as $deprt)
                <option @if ($deprt->id == request('department_id') ) selected @endif value="{{ $deprt->id }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    {{ $deprt->name }}
                </option>
                @endforeach

            </select>
            <!--begin::Actions-->
            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-sm btn-icon btn-light-primary me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                    <iconify-icon icon="mingcute:filter-line" class="fa-2x"></iconify-icon>
                </button>

                <a href="/admin/flight-risk" class="btn btn-sm btn-icon btn-light me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset">
                    <iconify-icon icon="bx:reset" class="fa-2x"></iconify-icon>
                </a>
                {{-- <button class="btn btn-sm btn-icon btn-light-success " value="export" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Reset">
                        <iconify-icon icon="clarity:export-line" class="fa-2x"> </iconify-icon>
                    </button> --}}
            </div>
            {{--
            </form> --}}
            <!--end::Actions-->
        </form>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->

        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>

<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">


    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  ">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                   Flight Risk
                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Filter-->
                        {{-- <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span
                                    class="path2"></span></i> Filter
                        </button>
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Separator-->

                            <!--begin::Content-->
                            <div class="px-7 py-5" data-kt-user-table-filter="form">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-semibold">Role:</label>
                                    <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="role" data-hide-search="true">
                                        <option></option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Analyst">Analyst</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Support">Support</option>
                                        <option value="Trial">Trial</option>
                                    </select>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-semibold">Two Step
                                        Verification:</label>
                                    <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="two-step" data-hide-search="true">
                                        <option></option>
                                        <option value="Enabled">Enabled</option>
                                    </select>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset"
                                        class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                    <button type="submit" class="btn btn-primary fw-semibold px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Content-->
                        </div> --}}
                        <!--end::Menu 1-->
                        <!--end::Filter-->

                    </div>
                    <!--end::Toolbar-->

                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none"
                        data-kt-user-table-toolbar="selected">
                        <div class="fw-bold me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span> Selected
                        </div>

                        <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">
                            Delete Selected
                        </button>
                    </div>
                    <!--end::Group actions-->


                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <div class="row g-5 g-xl-8">
                    <div class="col-xl-6">
                        <!--begin::Charts Widget 2-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold fs-3 mb-1">By Department</span>

                                </h3>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Chart-->
                                <canvas id="riskLevelByTeamChart" height="250"></canvas>
                                <!--end::Chart-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Charts Widget 2-->
                    </div>

                    <div class="col-xl-6">
                        <!--begin::Charts Widget 2-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold fs-3 mb-1">By Position</span>

                                </h3>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Chart-->
                                <canvas id="riskLevelByPositionChart" height="250"></canvas>
                                <!--end::Chart-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Charts Widget 2-->
                    </div>


                </div>
                @if(isset($department_name))
                <h3>
                    Employees in {{ $department_name }}
                </h3>
                @endif
                {{-- begin::Table --}}
                <div id="table-section" class="card mt-5 mb-4">
                    <div class="card-body">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">User</th>
                                    <th class="min-w-100px">Role</th>
                                    <th class="min-w-100px">Company</th>
                                    <th class="min-w-100px">Department</th>
                                    <th class="min-w-100px">Position</th>
                                    <th class="min-w-100px">Flight Risk Level</th>
                                    <th class="min-w-100px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach($users as $user)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">

                                            <div class="symbol-label">
                                                @if(isset($user->profile_picture) &&
                                                File::exists(public_path($user->profile_picture)))
                                                <img src="{{ asset($user->profile_picture) }}" alt="{{$user->name ?? ''}}" class="w-100" />
                                                @else
                                                <img src="{{ asset('images/default-user.svg') }}" alt="{{$user->name ?? ''}}" class="w-100" />
                                                @endif
                                            </div>

                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="/admin/employee-details/{{$user->id}}" class="text-gray-800 text-hover-primary mb-1">{{$user->first_name ??
                                                ''}} {{

                                                $user->last_name ?? '' }}</a>
                                            <span>{{ $user->email ?? '' }}</span>
                                        </div>
                                        <!--begin::User details-->
                                    </td>
                                    <td>{{ $user->role && $user->role->caption == "Department role" ? 'HOD':'Employee'}}</td>
                                    <td>{{ $user->company->name ?? '' }}</td>
                                    <td>{{ $user->department->name ?? '' }}</td>
                                    <td>{{ $user->job_position->title ?? '' }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="text-gray-800 fw-bolder fs-6">{{ ucfirst($user->flight_risk_level ?? '') . ' Risk' }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/admin/employee-details/{{$user->id}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <iconify-icon icon="fluent:eye-20-regular" class="fa-1-5"></iconify-icon>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $users->appends(request()->query())->links() }}

            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

@endsection
@section('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script>
        function filterTablePosition(position) {
            var url = new URL(window.location.href);
            url.searchParams.set('position', position);
            url.hash = 'table-section'; // Add the hash to scroll to the table section
            window.location.href = url.toString();
        }
        var ctx = document.getElementById('riskLevelByPositionChart').getContext('2d');
        var riskLevelChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($resultsOfPosition->pluck('position_name')) !!},
                datasets: [{
                    label: 'Average Risk Level',
                    data: {!! json_encode($resultsOfPosition->pluck('average_risk_level')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    positionIds: {!! json_encode($resultsOfPosition->pluck('position_id')) !!}
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                    title: {
                        display: true,
                        text: 'Levels'
                    }
                }
                },
                plugins: {
                    legend: {
                        display: "{{ request('department_id') && request('department_id') > 1 ? 'true':'false' }}" == 'true' ? true:false
                    }
                },
                onClick: function(e, elements) {
                    if (elements.length > 0) {
                        var index = elements[0].index;
                        var position = this.data.datasets[0].positionIds[index];
                        filterTablePosition(position);
                    }
                }
            }
        });
    </script>

    <script>
        function filterTableDepartment(department) {
            var url = new URL(window.location.href);
            url.searchParams.set('department', department);
            url.hash = 'table-section'; // Add the hash to scroll to the table section
            window.location.href = url.toString();
        }
        var ctx = document.getElementById('riskLevelByTeamChart').getContext('2d');
        var riskLevelChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($resultsOfDepartment->pluck('department_name')) !!},
                datasets: [{
                    label: 'Average Risk Level',
                    data: {!! json_encode($resultsOfDepartment->pluck('average_risk_level')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: "{{ request('department_id') && request('department_id') > 1 ? 'true':'false' }}" == 'true' ? true:false
                    }
                },
                onClick: function(e, elements) {
                    if (elements.length > 0) {
                        var index = elements[0].index;
                        var department = this.data.labels[index];
                        filterTableDepartment(department);
                    }
                }
            }
        });
    </script>
@endsection
