@extends('admin.layout.app')

@section('title', 'Divisions')
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
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack container-xxl">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
               Companies/Divisions
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Home </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item capitalize text-muted">
                   Organization Structure</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item capitalize text-muted">
                   Companies/Divisions</li>
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
    <div id="kt_app_content_container" class="app-container container-xxl ">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="capitalize"> Company/Division List</h2>
                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">


                        <!--begin::Add user-->
                        {{-- @if(count($divisions) > 0)
                        <a href="/admin/division/create/" class="btn btn-primary d-flex align-items-center">
                            <iconify-icon icon="charm:plus"></iconify-icon>
                             Add Company/Division
                        </a>
                        @endif --}}
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

                {{-- @if(!$divisions || count($divisions) == 0)
                <div class="d-flex justify-content-center text-center" data-kt-user-table-toolbar="base">
                    <a href="/admin/division/create/" class="btn btn-primary d-flex align-items-center">
                        <iconify-icon icon="charm:plus"></iconify-icon>
                        Click To Add Company/Division
                    </a>
                </div>
                @else --}}
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Company/Division Title</th>
                            <th class="min-w-125px">Business Unit</th>
                            <th class="min-w-100px">Company</th>
                            {{-- <th class="text-center min-w-100px">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach($divisions as $division)
                        <tr>
                            <td class="">
                                <div class="d-flex flex-column">
                                    <a class="text-gray-800 text-hover-primary mb-1">{{$division->head_of_division ?? ''}}</a>
                                </div>
                            </td>
                            <td>{{ $division->business_unit->name ?? '' }} </td>
                            <td>{{ $division->tenant->name ?? '' }} </td>
                            {{-- <td class="text-center">
                                <a href="/admin/division/{{$division->id}}/edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <iconify-icon icon="heroicons-outline:pencil-alt" class="fa-1-5"></iconify-icon>
                                </a>
                                <form action="{{ route('admin.division.delete', $division->id) }}" id="form-{{ $division->id }}" class="btn btn-icon " method="POST">
                                    @csrf
                                    @method('DELETE')
                                <button type="button" custom1="{{ $division->id }}" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm show_confirm">
                                    <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                </button>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end::Table-->
                {{ $divisions->links() }}
                {{-- @endif --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $('#form-'+ $(this).attr('custom1'));
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this division?`
                , text: "If you delete this, it will be gone forever."
                , icon: "warning"
                , buttons: true
                , dangerMode: true
            , })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

</script>
<script>
    $(document).ready(function() {
        $('.status-toggle').change(function() {
            var divisionId = $(this).data('id');
            var status = $(this).is(':checked') ? '1' : '0';
            $.ajax({
                url: '/admin/division/' + divisionId + '/status',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        $('#flexSwitchCheckChecked_' + divisionId).next('label').text(status.charAt(0).toUpperCase() + status.slice(1));
                        toastr.success('Successfully Updated','Status')
                    } else {
                        alert('Failed to update status.');
                    }
                }
            });
        });
    });
</script>
@endsection
