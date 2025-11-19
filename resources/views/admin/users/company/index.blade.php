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
                Company
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
                    Company</li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
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
                    <h2 class="capitalize"> Company List</h2>
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

                        <!--begin::Export-->
                        {{-- <button type="button" class="btn btn-light-primary me-3 d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_export_users">
                            <iconify-icon icon="uil:import" class="fa-1-5"></iconify-icon> Import
                        </button> --}}
                        <!--end::Export-->

                        <!--begin::Add user-->
                        <a href="/admin/company/user/create/" class="btn btn-primary d-flex align-items-center">
                            <iconify-icon icon="charm:plus"></iconify-icon>
                             Add Company
                        </a>
                        <!--end::Add user-->
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
                            <th class="min-w-125px">Company</th>
                            {{-- <th class="min-w-100px">Address</th> --}}
                            {{-- @if($type == 'employee' || $type == 'department')

                            <th class="min-w-100px">Company</th>
                            @endif --}}
                            {{-- @if($type == 'employee')
                            <th class="min-w-100px">Department</th>
                            <th class="min-w-100px">Position</th>
                            @endif --}}
                            {{-- <th class="min-w-100px">Age</th>
                            <th class="min-w-100px">City</th> --}}
                            {{-- @if($type == 'employee' )

                            <th class="min-w-100px">Ocean</th>
                            <th class="min-w-100px">RIASEC</th>
                            <th class="min-w-100px">Cognitive</th>
                            @endif --}}
                            <th class="text-center min-w-100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach($users as $user)

                        <tr>
                            {{-- <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                </div>
                            </td> --}}
                            <td class="d-flex align-items-center">
                                <!--begin:: Avatar -->
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="/admin/company/user/{{$user->id}}/edit">
                                        <div class="symbol-label">
                                            {{-- {{ dd(asset($user->profile_picture)) }} --}}
                                            @if(isset($user->profile_picture) && File::exists(public_path($user->profile_picture)))
                                            <img src="{{ asset($user->profile_picture) }}" alt="{{$user->name ?? ''}}"
                                                class="w-100"  onerror="this.src='{{asset('images/default-user.svg')  }}'"/>
                                            @else
                                            <img src="{{ asset('images/default-user.svg') }}"  onerror="this.src='{{asset('images/default-user.svg')  }}'" alt="{{$user->name ?? ''}}"
                                                class="w-100" />
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::User details-->
                                <div class="d-flex flex-column">
                                    <a href="/admin/company/user/{{$user->id}}/edit"
                                        class="text-gray-800 text-hover-primary mb-1">{{$user->first_name ?? ''}} {{
                                        $user->last_name ?? '' }}</a>
                                    <span>{{ $user->email ?? '' }}</span>
                                </div>
                                <!--begin::User details-->
                            </td>
                            {{-- {{ dd($user->company) }} --}}

                            {{-- <td>{{ $user->address }} </td> --}}
                            {{-- @if($type == 'employee' || $type == 'department')

                            <td>{{ $user->company->name ?? '' }} </td>
                            @endif --}}
                            {{-- @if($type == 'employee' )

                            <td>{{ $user->department->name ?? '' }} </td>

                            <td>{{ $user->job_position->title ?? '' }} </td>
                            @endif

                            <td> {{ $user->age ?? 'N/A' }} </td>

                            <td>
                                {{ $user->city ?? 'N/A' }}
                            </td>
                            @if($type == 'employee' )
                            <td>
                                <div class="badge badge-success fw-bold">
                                    Yes
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-success fw-bold">
                                    Yes
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-success fw-bold">
                                    Yes
                                </div>
                            </td>
                            @endif --}}

                            <td class="text-center">

                                <a href="/admin/company/user/{{$user->id}}/edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <iconify-icon icon="heroicons-outline:pencil-alt" class="fa-1-5"></iconify-icon>
                                </a>

                                {{-- <a href="#" data-kt-users-table-filter="delete_row" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                    <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                </a> --}}
                                <a href="/admin/company/user/{{$user->id}}/delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                    <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end::Table-->
                {{ $users->links() }}

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
                <div class="btn btn-icon btn-close btn-sm btn-active-icon-primary"
                data-bs-dismiss="modal">
                <iconify-icon icon="clarity:close-line" class="fa-1-5"></iconify-icon>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body mt-0 mx-5 mx-xl-15 my-7 pt-3 scroll-y">

                <div class="align-items-center d-flex justify-content-between mb-20" ><h2>Download Sample File:</h2> <a href="{{asset('admin/users.xlsx')}}" download target="_blank" class="btn btn-primary">Download</a> </div>
                <!--begin::Form-->
                <form id="kt_modal_export_users_form" class="form" action="/admin/user/import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">Select CSV File:</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input  type="file" name="file"
                             class="fw-bold form-control">

                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->



                    <!--begin::Actions-->
                    <div class="text-center">
                        <a type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Discard
                        </a>

                        <button type="submit" class="btn btn-primary"
                            data-kt-users-modal-action="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span
                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
@endsection
