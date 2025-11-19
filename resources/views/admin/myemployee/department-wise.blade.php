@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
    <style>
        .image-input-placeholder {
            background-image: url({{ asset('admin/media/svg/files/blank-image.svg') }});
        }

        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url({{ asset('admin/media/svg/files/blank-image-dark.svg') }});
        }
    </style>
    
    
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
                <h1
                    class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ $department->name ?? '' }} Employees List
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
                        {{ $department->name ?? '' }} Employees List </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Action group-->
            <!--begin::Toolbar end-->
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
                                    <label class="form-label fw-semibold">Select Department:</label>
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid me-6" data-control="select2"
                                        data-placeholder="Select Department" data-hide-search="true" name="department_id"
                                        id="department_id">
                                        <option selected="selected" value=""
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Select Department</option>
                                        @foreach ($departments as $val1)
                                            <option value="{{ $val1->id }}"
                                                class="py-1 inline-block font-Inter font-normal text-sm text-slate-600"
                                                {{ request('department_id') == $val1->id ? 'selected' : '' }}>
                                                {{ $val1->name ?? '' }}</option>
                                        @endforeach

                                    </select>
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



            <!--end::Toolbar end-->
            <!--end::Action group-->
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
                        <h2 class="capitalize"> {{ $department->name ?? ' ' }} Employees List</h2>
                    </div>
                    <!--begin::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--begin::Filter-->
                            

                            {{-- <button type="button" class="btn btn-light-primary me-3 d-flex align-items-center"
                                id="export-button">
                                <iconify-icon icon="clarity:export-line" class="fa-1x"></iconify-icon> Export
                            </button> --}}
                            <!--end::Export-->



                            <!--begin::Export-->
                            <button type="button" class="btn btn-light-primary me-3 d-flex align-items-center" id="export-button">
                                <iconify-icon icon="clarity:export-line" class="fa-1-5"></iconify-icon> Export
                            </button>
                            <!--end::Export-->
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
                <div class="card-body py-4" style="overflow-x: scroll;">

                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                {{-- <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                </div>
                            </th> --}}
                            <th class="min-w-100px" data-sort="sno">Sno </th>
                            <th class="min-w-125px" data-sort="user">User </th>
                            <th class="min-w-125px" data-sort="job_title">Job Title </th>
                            <th class="min-w-100px" data-sort="jimr">JMR (Job Match Rate)</th>
                            <th class="min-w-100px" data-sort="tpmr">SSMR (Soft Skill Match Rate)</th>
                            <th class="min-w-100px" data-sort="ctr">CTR (Cognitive Test Result)</th>
                            <th class="min-w-100px" data-sort="gp">GP (Growth Potential)</th>
                            <th class="min-w-100px" data-sort="ppr">PPR (Predictive Performance Rate)</th>
                            <th class="min-w-100px" data-sort="fr">FR (Flight Risk)</th>
                            <th class="min-w-100px" data-sort="off">WAF (Workplace Alignment Forecast)</th>
                            <th class="min-w-100px" data-sort="tar">TAR (Technical Assessment Result)</th>
                            <th class="min-w-100px sortable" data-sort="omr" data-order="asc">
                                OMR (Overall Match Rate)
                                <span class="sort-icon">&uarr;</span> <!-- Up arrow for ascending order -->
                            </th>
                            
                            <th class="text-center min-w-100px">Actions</th>

                            
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            {{-- {{ dd($users) }} --}}
                                @foreach ($users as $key => $user)
                                <tr>
                                    {{-- <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                        </td> --}}
                                    <td> {{ $key + 1 }} </td>
                                    <td class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            {{-- <a href="/admin/employee-details/{{ $user->id }}"> --}}
                                                <a href="#">
                                                <div class="symbol-label">
                                                    @if (isset($user->profile_picture) && File::exists(public_path($user->profile_picture)))
                                                        <img src="{{ asset($user->profile_picture) }}"
                                                            alt="{{ $user->name ?? '' }}" class="w-100" />
                                                    @else
                                                        <img src="{{ asset('images/default-user.svg') }}"
                                                            alt="{{ $user->name ?? '' }}" class="w-100" />
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary mb-1">{{$user->name ?? ''}}</a>
                                            <span>{{ $user->email ?? '' }}</span>
                                        </div>
                                        <!--begin::User details-->
                                    </td>
                                    <td> {{ $user->title ?? '' }} </td>
                                    <td>@if($user->riasec_job_match_rate >= 70) 
                                        High
                                    @elseif ($user->riasec_job_match_rate <= 40)
                                        Low
                                    @else
                                        Moderate                           
                                    @endif</td>
                                    
                                    <td>{{ $user->talent_pillar_match_rate ?? 0 }}</td>

                                    <td>{{ $user->getCognitiveLevel($user->id) ?? " Level: 2 (Medium)" }} </td>
                                    
                                    <td> {{ $user->getGrowthPotentialLevel($user->id) ?? 'Average' }} </td>

                                    <td>
                                       {{ $user->getPerformancePredictiveScore($user->id) ?? 0 }}
                                    </td>
                                    <td>
                                        {{ $user->flight_risk_percentage ?? 0 }}
                                    </td>
                                    <td>
                                        {{ ucFirst($user->organizational_fit_forecast) ?? "Low" }} Risk
                                    </td>
                                    <td>
                                        {{ $user->tech_skill_score ?? 0 }}
                                    </td>

                                    <td>{{ $user->match_rate ?? 0 }} </td>
                                    
                                    <td class="text-center">

                                        {{-- <a href="/admin/myemployee/send/email/"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">

                                            <iconify-icon icon="mdi:email-sent-outline" class="fa-1-5"></iconify-icon>
                                        </a> --}}

                                        <a href="/admin/employee-details/{{ $user->id }}"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                                            <iconify-icon icon="fluent:eye-20-regular" class="fa-1-5"></iconify-icon>
                                        </a>
                                        {{-- 

                                        <a href="/admin/myemployee/{{ $user->id }}/edit"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                                            <iconify-icon icon="heroicons-outline:pencil-alt"
                                                class="fa-1-5"></iconify-icon>
                                        </a>

                                        <a href="/admin/myemployee/{{ $user->id }}/delete"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm mb-2">
                                            <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                        </a> --}}

                                    </td>
                                </tr>
                                @endforeach
                         
                        </tbody>
                    </table>
                    <!--end::Table-->
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
    <script src="{{ asset('admin/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

    <script>
        document.getElementById('export-button').addEventListener('click', function() {
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.table_to_sheet(document.getElementById('kt_table_users'));
            XLSX.utils.book_append_sheet(wb, ws, "Users");

            // Create a binary string and create a download link
            XLSX.writeFile(wb, "users_list.xlsx");
        });
    </script>
    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('kt_table_users');
    const headers = table.querySelectorAll('.sortable');

    headers.forEach(header => {
        header.addEventListener('click', function () {
            const order = header.getAttribute('data-order');
            const column = header.getAttribute('data-sort');
            const newOrder = order === 'asc' ? 'desc' : 'asc';

            sortTableByColumn(table, column, newOrder);

            // Update the header to reflect the new sort order
            headers.forEach(h => h.removeAttribute('data-order'));
            header.setAttribute('data-order', newOrder);

            // Update the sort icon
            const icon = header.querySelector('.sort-icon');
            if (newOrder === 'asc') {
                icon.innerHTML = '&uarr;'; // Up arrow
            } else {
                icon.innerHTML = '&darr;'; // Down arrow
            }
        });
    });

    function sortTableByColumn(table, column, order) {
        const rows = Array.from(table.querySelectorAll('tbody > tr'));

        rows.sort((a, b) => {
            const aColText = a.querySelector(`td:nth-child(${getColumnIndex(column)})`).textContent.trim();
            const bColText = b.querySelector(`td:nth-child(${getColumnIndex(column)})`).textContent.trim();

            if (order === 'asc') {
                return aColText.localeCompare(bColText, undefined, { numeric: true });
            } else {
                return bColText.localeCompare(aColText, undefined, { numeric: true });
            }
        });

        rows.forEach(row => table.querySelector('tbody').appendChild(row));
    }

    function getColumnIndex(column) {
        switch (column) {
            case 'omr':
                return 12; // Adjust this number to match the position of the OMR column
            // Add more cases here for other columns if needed
            default:
                return 1;
        }
    }
});


    </script>

@endsection
