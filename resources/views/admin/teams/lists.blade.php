@extends('admin.layout.app')

@section('title', 'Position')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Teams
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">
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
                    Teams </li>
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
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl ">




        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Teams</span>

                    {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                </h3>
                <div class="card-toolbar">
                    <a href="/admin/teams/create" class="align-items-center btn btn-light-primary btn-sm d-flex">
                        <iconify-icon icon="icon-park-outline:user-positioning"></iconify-icon> New Team
                    </a>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                {{-- <th class="ps-4 min-w-325px rounded-start">#</th> --}}
                                <th class="min-w-125px text-center">Title</th>
                                <th class="min-w-200px text-center">Department</th>
                                {{-- <th class="min-w-200px text-center">Company</th> --}}
                                {{-- <th class="min-w-200px text-center">Created Date</th> --}}
                                <th class="min-w-200px text-center rounded-end">Action</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            @foreach($teams as $team)

                            <tr>
                                {{-- <td>
                                    <span class="text-gray-900 text-left fw-bold text-hover-primary d-block mb-1 fs-6">{{ $position->id ?? ''}}</span>

                                </td> --}}

                                <td>
                                    <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $team->name ?? ''}}</span>

                                </td>
                                <td>
                                    <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $team->department->name ?? '' }}</span>
                                </td>

                                {{-- <td>
                                    <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $team->company->name ?? '' }}</span>
                                </td> --}}
                                {{-- <td>
                                    <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">
                                        {{ \Carbon\Carbon::parse($team->created_at)->format('j M Y') }}
                                    </span>
                                </td> --}}

                                <td class="text-center">

                                    {{-- @can('admin_positions_edit') --}}
                                    <a href="/admin/teams/{{ $team->id }}/edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <iconify-icon icon="heroicons-outline:pencil-alt" class="fa-1-5"></iconify-icon>
                                    </a>
                                      {{-- @endcan --}}

                                    {{-- @if($position->canDelete())
                                    @can('admin_roles_delete') --}}
                                    <a href="/admin/teams/{{ $team->id}}/delete" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                    </a>
                                    {{-- @endcan
                                    @endif --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->

                </div>


                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>




        <!--begin::Modals-->


        <!--end::Modals-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection

@section('scripts')
@endsection
