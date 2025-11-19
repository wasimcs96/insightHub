@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
<style>
    .image-input-placeholder {
        background-image: url({{ asset("admin/media/svg/files/blank-image.svg") }});
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url({{ asset("admin/media/svg/files/blank-image-dark.svg") }});
    }
</style>
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
               Chart Lists
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize text-muted">
                   Chart Lists
                </li>
            </ul>
        </div>
        <form action="{{ route('admin.organizational.structure.list') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <select name="division_id" class="form-control">
                        <option value="">All Divisions</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                 {{ $division->head_of_division }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Search by Department Name" value="{{ request('name') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.organizational.structure.list') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h2 class="capitalize">Department List</h2>
                </div>
            </div>
            <div class="card-body py-4">
                @if(!$departments || count($departments) == 0)
                <div class="d-flex justify-content-center text-center" data-kt-user-table-toolbar="base">
                    <a href="/admin/mydepartment/create/" class="btn btn-primary d-flex align-items-center">
                        <iconify-icon icon="charm:plus"></iconify-icon>
                        Click To Add Department
                    </a> 
                </div>
                @else
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Department Title</th>
                            <th class="min-w-100px">Division</th>
                            <th class="text-center min-w-100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach($departments as $department)
                        <tr>
                            <td class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <a class="text-gray-800 text-hover-primary mb-1">{{ $department->name ?? '' }}</a>
                                </div>
                            </td>
                            <td>
                               {{$department->division->head_of_division ?? ''}}
                            </td>
                            <td class="text-center">
                                <a href="/admin/organizational-structure-data?department_id={{ $department->id }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="fa-solid fa-eye" id="eye-icon"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $departments->links() }}
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Export Users</h2>
                <div class="btn btn-icon btn-close btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <iconify-icon icon="clarity:close-line" class="fa-1-5"></iconify-icon>
                </div>
            </div>
            <div class="modal-body mt-0 mx-5 mx-xl-15 my-7 pt-3 scroll-y">
                <div class="align-items-center d-flex justify-content-between mb-20"><h2>Download Sample File:</h2> <a href="{{ asset('admin/users.xlsx') }}" download target="_blank" class="btn btn-primary">Download</a></div>
                <form id="kt_modal_export_users_form" class="form" action="/admin/user/import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="fv-row mb-10">
                        <label class="fs-6 fw-semibold form-label mb-2">Select CSV File:</label>
                        <input type="file" name="file" class="fw-bold form-control">
                    </div>
                    <div class="text-center">
                        <a type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</a>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('admin/js/custom/apps/user-management/users/list/table.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $('#form-'+ $(this).attr('custom1'));
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this department?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

    $(document).ready(function() {
        $('.status-toggle').change(function() {
            var departmentId = $(this).data('id');
            var status = $(this).is(':checked') ? '1' : '0';
            $.ajax({
                url: '/admin/mydepartment/' + departmentId + '/status',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('Successfully Updated', 'Status');
                    } else {
                        alert('Failed to update status.');
                    }
                }
            });
        });
    });
</script>
@endsection
