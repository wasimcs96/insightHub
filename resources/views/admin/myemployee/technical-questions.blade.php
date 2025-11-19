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
                    PM & CM List
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
                        PM & CM List </li>
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
                    {{-- <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <iconify-icon icon="mingcute:filter-line" class="fa-1x"></iconify-icon>
                        Filter
                    </a> --}}
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
                        <div class="px-7 py-5"
                            style="overflow-y: scroll;height: 500px;">
                            <!--begin::Input group-->
                            <form id="filter-form" method="GET">

                                {{-- <input type="hidden" name="export" value="0" id="export-input">
                                <input type="hidden" name="is_assessment" value="{{ request('is_assessment') }}"
                                    id="export-input"> --}}
                                    
                                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Search
                                    By Name:</span>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="name" class="form-control mb-3 mb-lg-0 "
                                    value="{{ request('name') }}" placeholder="Name">

                                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Search
                                    By Email:</span>
                                <input type="text" name="email" class="form-control mb-3 mb-lg-0"
                                    placeholder="Search by Email" value="{{ request('email') }}">
                               
                            </form>
                            <!--end::Actions-->
                        </div>
                        <div class="px-7 py-5">
                            <div class="d-flex justify-content-end py-2">
                                <a href="/admin/myemployee" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true">Reset</a>

                                <button type="button" onclick="document.getElementById('filter-form').submit();" class="btn btn-sm btn-primary"
                                    data-kt-menu-dismiss="true">Apply</button>


                            </div>
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
                        <h2 class="capitalize">Technical Questions</h2>
                    </div>
                    <!--begin::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--begin::Filter-->

                        </div>
                        <!--end::Toolbar-->


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
                                <th class="min-w-125px">Job</th>
                                <th class="min-w-125px">Title</th>
                                <th class="min-w-100px">Option 1</th>
                                <th class="min-w-100px">Option 2</th>
                                <th class="min-w-100px">Option 3</th>
                                <th class="min-w-100px">Option 4</th>
                                <th class="min-w-100px">Correct Option</th>
                                <th class="min-w-100px">Score</th>
                                <th class="min-w-100px">Level</th>
                               
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            {{-- {{ dd($users) }} --}}
                                @foreach ($technical_questions as $technical_question)
                                <tr>
                                    <td>
                                        {{ $technical_question->job->title ?? '' }}
                                    </td>
                                   
                                    <td>
                                        {{ $technical_question->title ?? 0 }}
                                    </td>

                                    <td>
                                        {{ $technical_question->option_1 ?? "" }}
                                    </td>
                                    
                                    <td>
                                        {{ $technical_question->option_2 ?? "" }}
                                    </td>

                                    <td>
                                        {{ $technical_question->option_3 ?? "" }}
                                    </td>

                                    <td>
                                        {{ $technical_question->option_4 ?? "" }}
                                    </td>

                                    <td>
                                        {{ $technical_question->correct_answer ?? "" }}
                                    </td>

                                    <td>
                                        {{ $technical_question->score ?? "" }}
                                    </td>

                                    <td>
                                        {{ $technical_question->level ?? "" }}
                                    </td>
                                </tr>
                                @endforeach
                         
                        </tbody>
                    </table>
                    <!--end::Table-->
                    {{ $technical_questions->appends(request()->query())->links() }}

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
    <script>
        document.getElementById('export-button').addEventListener('click', function() {
            document.getElementById('export-input').value = 1;
            document.getElementById('filter-form').submit();
        });
    </script>
    <script>
        document.getElementById('dynamic_percentage_form').addEventListener('submit', function(event) {
            var technicalPercentage = parseFloat(document.getElementById('technical_percentage').value);
            var softSkillPercentage = parseFloat(document.getElementById('soft_skill_percentage').value);

            if (technicalPercentage + softSkillPercentage !== 100) {
                alert('Technical Percentage and Soft Skill Percentage must sum up to 100%.');
                event.preventDefault();
            }
        });

    </script>

@endsection
