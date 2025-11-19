@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
<style>

</style>
@endsection
@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
    
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
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
                    Growth Potential </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->
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

                        
                            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Select Department:</span>            

                <!--begin::Select-->
                <select class="form-select form-select-solid me-6" data-control="select2" data-placeholder="Select Department" data-hide-search="true" name="department" id="department">
                    <option selected="selected" value="" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Select Department</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600" {{
                            request('department')==$department->id ? 'selected' : '' }}>{{ $department->head_of_department
                            ?? '' }}</option>
                    @endforeach

                </select>



            
                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2"> Select Level:</span>
                <!--end::Label-->

                <!--begin::Select-->
                <select class="form-select form-select-solid me-6" data-control="select2" data-placeholder=" Select Level" data-hide-search="true" name="level" id="level">

                    <option value="" selected="selected" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Select Level
                    </option>

                    <option @if (request('level')=='1' ) selected @endif value="1" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Level 1
                    </option>

                    <option @if (request('level')=='2' ) selected @endif value="2" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Level 2
                    </option>

                    <option @if (request('level')=='3' ) selected @endif value="2" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Level 3
                    </option>

                    <option @if (request('level')=='3' ) selected @endif value="2" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Level 4
                    </option>

                </select>



                
                {{-- <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2"> Select Potential:</span>
                <!--end::Label-->

                <!--begin::Select-->
                <select class="form-select form-select-solid me-6" data-control="select2" data-placeholder=" Select Potential" data-hide-search="true" name="potential" id="potential">

                    <option value="" selected="selected" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Select Potential
                    </option>

                    <option @if (request('potential')=='1' ) selected @endif value="1" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        High Potential
                    </option>

                    <option @if (request('potential')=='2' ) selected @endif value="2" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Average Potential
                    </option>


                </select> --}}



                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Age:</span>
                <!--end::Label-->
                @php
                $employees = \App\Models\User::where('is_personality_motivation_completed', 1)
                ->where('is_work_interest_completed', 1)
                ->where('is_cognitive_ability_completed', 1)
                ->get();
                @endphp
                <!--begin::Select-->
                {{-- <form action="d-flex align-items-center overflow-auto"> --}}
                <select class="form-select form-select-solid me-6" data-control="select2" data-placeholder="Select Age" data-hide-search="true" name="age" id="age">
                    <option selected="Selected" value="" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Select Age</option>
                    <option @if (request('age')=='15_20' ) selected @endif value="15_20" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        15 - 20 Years
                    </option>
                    <option @if (request('age')=='21_25' ) selected @endif value="21_25" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        21 - 25 Years</option>
                    <option @if (request('age')=='26_30' ) selected @endif value="26_30" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        26 - 30 Years</option>
                    <option @if (request('age')=='31_35' ) selected @endif value="31_35" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        31 - 35 Years</option>
                    <option @if (request('age')=='36_40' ) selected @endif value="36_40" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        36 - 40 Years</option>
                    <option @if (request('age')=='40_100' ) selected @endif value="40_100" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        40 + Years</option>
                </select>
                <!--end::Select-->
                <!--begin::Separartor-->
            
                <!--end::Separartor-->
                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Gender:</span>
                <!--end::Label-->

                <!--begin::Select-->
                <select class="form-select form-select-solid me-6" data-control="select2" data-placeholder="Select Gender" data-hide-search="true" name="gender" id="gender">
                    <option selected="selected" value="" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Select Gender</option>
                    <option @if (request('gender')=='0' ) selected @endif value="0" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Male
                    </option>
                    <option @if (request('gender')==1) selected @endif value="1" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Female</option>
                </select>
                <!--end::Select-->
                <!--begin::Label-->
                <!--begin::Separartor-->

                <!--end::Separartor-->
                @php
                $education_levels = \App\Models\MasterEducationLevel::all();
                @endphp
                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Education Level:</span>
                <!--end::Label-->

                <!--begin::Select-->
                <select class="form-select form-select-solid me-6" data-control="select2" data-placeholder="Select Education Level" data-hide-search="true" name="education_level" id="education_level">
                    <option selected="selected" value="" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Select Education Level</option>
                    @foreach($education_levels as $education_level)
                    <option value="{{ $education_level->id }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600" {{
                            request('education_level')==$education_level->id ? 'selected' : '' }}>{{ $education_level->name
                            ?? '' }}</option>
                    @endforeach

                </select>

                
                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Work Experience:</span>
                <!--end::Label-->

                <!--begin::Select-->
                <select class="form-select form-select-solid me-6" data-control="select2" data-placeholder=" Select Work Experience" data-hide-search="true" name="work_experience" id="work_experience">
                    <option value="" selected="selected" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Select Work Experience
                    </option>
                    <option @if (request('work_experience')=='0_3' ) selected @endif value="0_3" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        0 - 3 Years</option>

                    <option @if (request('work_experience')=='3_5' ) selected @endif value="3_5" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        3 - 5 Years
                    </option>
                    <option @if (request('work_experience')=='5_100' ) selected @endif value="5_100" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        5 + Years
                    </option>

                </select>


                        

                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end py-2">
                                    <a href="/admin/growth-potential" class="btn btn-sm btn-light btn-active-light-primary me-2"
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
                    Growth Potential Data
                    
                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <div class="d-flex mb-4" style="float: right;">
                            <button id="reset-filters" class="btn btn-light btn-active-light-primary">All Growth Potentials</button>
                        </div>

                    </div>
                    <!--end::Toolbar-->

                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
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
                                    <span class="card-label fw-bold fs-3 mb-1">Growth Potentials</span>

                                </h3>


                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Chart-->
                                <div id="top_skills" style="height: 350px"></div>
                                <!--end::Chart-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Charts Widget 2-->
                    </div>

                    <div class="col-xl-6">

                        <div class="card">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-6">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    Top 5 Growth Potential Individuals​
                                </div>
                                <!--begin::Card title-->
                            </div>


                            <div class="card-body py-4">

                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                    <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">


                                            <th class="min-w-125px">User</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                        @foreach($top5users as $top5user)


                                        <tr>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="/admin/employee-details/{{$top5user->id}}">
                                                        <div class="symbol-label">
                                                            @if(isset($top5user->profile_picture) &&
                                                            File::exists(public_path($top5user->profile_picture)))
                                                            <img src="{{ asset($top5user->profile_picture) }}" alt="{{$top5user->name ?? ''}}" class="w-100" />
                                                            @else
                                                            <img src="{{ asset('images/default-user.svg') }}" alt="{{$top5user->name ?? ''}}" class="w-100" />
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="/admin/employee-details/{{$top5user->id}}" class="text-gray-800 text-hover-primary mb-1">{{$top5user->first_name
                                                        ?? ''}} {{
                                                        $top5user->last_name ?? '' }}</a>
                                                    <span>{{ $top5user->email ?? '' }}</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>



                                            <td>{{ $top5user->gp_potential ?? '' }} </td>


                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>




                <!--begin::Table-->
                <div id="table-section" class="card mt-5 mb-4">
                    <div class="card-body">

                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">


                                    <th class="min-w-125px">User</th>
                                    <th class="min-w-100px">Role</th>
                                    @if($type == 'employee' || $type == 'department')

                                    <th class="min-w-100px">Company</th>
                                    @endif
                                    @if($type == 'employee')
                                    <th class="min-w-100px">Department</th>
                                    <th class="min-w-100px">Position</th>
                                    @endif
                                    <th class="min-w-100px">Growth Potential</th>

                                    <th class="text-center min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach($users as $user)

                                <tr>
                                    {{-- <td>#{{ $user->rank ?? '' }} </td> --}}
                                    {{-- <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td> --}}
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


                                    <td>{{ $user->role && $user->role->caption == "Department role" ? 'HOD':'Employee'
                                        }} </td>
                                    @if($type == 'employee' || $type == 'department')

                                    <td>{{ $user->company->name ?? '' }} </td>
                                    @endif
                                    @if($type == 'employee' )

                                    <td>{{ $user->department->name ?? '' }} </td>

                                    <td>{{ $user->job_position->title ?? '' }} </td>
                                    @endif
                                    <td>{{ $user->gp_potential ?? '' }} </td>

                                    <td class="text-center">

                                        <a href="/admin/employee-details/{{$user->id}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 ">
                                            <iconify-icon icon="fluent:eye-20-regular" class="fa-1-5"></iconify-icon>
                                        </a>


                                        {{-- <a href="/admin/user/edit/{{$type}}/{{$user->id}}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <iconify-icon icon="heroicons-outline:pencil-alt" class="fa-1-5">
                                        </iconify-icon>
                                        </a> --}}

                                        {{-- <a href="#" data-kt-users-table-filter="delete_row"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                            <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                        </a> --}}
                                        {{-- <a href="/admin/user/delete/{{$type}}/{{$user->id}}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
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


<!--begin::Modal - Adjust Balance-->
<div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Export Users</h2>
                <!--end::Modal title-->

                <!--begin::Close-->
                <div class="btn btn-icon btn-close btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <iconify-icon icon="clarity:close-line" class="fa-1-5"></iconify-icon>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body mt-0 mx-5 mx-xl-15 my-7 pt-3 scroll-y">

                <div class="align-items-center d-flex justify-content-between mb-20">
                    <h2>Download Sample File:</h2> <a href="{{asset('admin/users.xlsx')}}" download target="_blank" class="btn btn-primary">Download</a>
                </div>
                <!--begin::Form-->
                <form id="kt_modal_export_users_form" class="form" action="/admin/user/import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">Select CSV File:</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input type="file" name="file" class="fw-bold form-control">

                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->



                    <!--begin::Actions-->
                    <div class="text-center">
                        <a type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Discard
                        </a>

                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Card-->


@endsection
@section('scripts')
<script src="{{asset('admin/js/custom/apps/user-management/users/list/table.js')}}"></script>
<script>
    function filterTable(category) {
        var url = new URL(window.location.href);
        url.searchParams.set('category', category);
        url.hash = 'table-section'; // Add the hash to scroll to the table section
        window.location.href = url.toString();
    }
    
    var options = {
        series: [{
            data: @json($performanceData)
        }],
        chart: {
            type: 'bar',
            height: 380,
            events: {
                dataPointSelection: function(event, chartContext, config) {
                    var selectedCategory = config.w.globals.labels[config.dataPointIndex];
                    filterTable(selectedCategory);
                }
            }
        },
        plotOptions: {
            bar: {
                barHeight: '100%',
                distributed: true,
                horizontal: true,
                dataLabels: {
                    position: 'bottom'
                },
            }
        },
        dataLabels: {
            enabled: true,
            textAnchor: 'start',
            style: {
                colors: ['#fff']
            },
            formatter: function(val, opt) {
                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
            },
            offsetX: 0,
            dropShadow: {
                enabled: true
            }
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        xaxis: {
            categories: @json($performanceLabels),
        },
        yaxis: {
            labels: {
                show: false
            }
        },
        title: {
            align: 'center',
            floating: true
        },
        subtitle: {
            align: 'center'
        },
        tooltip: {
            theme: 'dark',
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function() {
                        return ''
                    }
                }
            }
        }
    };
    
    var chart = new ApexCharts(document.querySelector("#top_skills"), options);
    chart.render();
    </script>
    
    <script>
        document.getElementById('reset-filters').addEventListener('click', function() {
            var url = new URL(window.location.href);
            // Remove all search parameters
            url.search = '';
            // Remove the hash to avoid scrolling to the table section
            url.hash = '';
            window.location.href = url.toString();
        });
        </script>
@endsection
