@extends('admin.layout.app')

@section('title', 'Sections')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 ">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack ">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Sections
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize text-muted">Sections</li>
            </ul>
        </div>

        <form action="{{ route('department_sections.index') }}" method="GET" class="d-flex align-items-center col-lg-8 justify-content-end">
            <div class="row w-100 align-items-center">
                <div class="col-md-3">
                    <select name="division_id" id="division_id" class="form-control">
                        <option value="">All Divisions</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                {{ $division->head_of_division }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="department_id" id="department_id" class="form-control">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->head_of_department }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="name" class="form-control" placeholder="Search by Name" value="{{ request('name') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('department_sections.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid ">
    <div id="kt_app_content_container" class="app-container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h2 class="capitalize"> Sections List</h2>
                </div>

                <div class="card-toolbar">
                    @if(count($sections) > 0)
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <a href="{{ route('department_sections.create') }}" class="btn btn-primary mb-3"><iconify-icon icon="charm:plus"></iconify-icon> Create Section</a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card-body py-4">
                @if(!$sections || count($sections) == 0)
                <div class="d-flex justify-content-center text-center" data-kt-user-table-toolbar="base">
                    <a href="{{ route('department_sections.create') }}" class="btn btn-primary mb-3"><iconify-icon icon="charm:plus"></iconify-icon> Click to add Section</a>
                </div>
                @else
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_sections">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $section)
                            <tr>
                                <td>{{ $loop->iteration + ($sections->currentPage() - 1) * $sections->perPage() }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->department->head_of_department }}</td>
                                <td>{{ ucfirst($section->status) }}</td>
                                <td>
                                    <a href="{{ route('department_sections.edit', $section) }}" class="btn btn-primary"><iconify-icon icon="heroicons-outline:pencil-alt" class="fa-1-5"></iconify-icon></a>
                                    <form action="{{ route('department_sections.destroy', $section) }}" id="form-{{ $section->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" custom1="{{ $section->id }}" class="btn btn-danger show_confirm"><iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $sections->appends(request()->query())->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('#division_id').change(function() {
            var divisionId = $(this).val();
            if (divisionId) {
                $.ajax({
                    url: '/admin/get-departments/' + divisionId,
                    type: 'GET',
                    success: function(response) {
                        $('#department_id').empty();
                        $('#department_id').append('<option value="">All Departments</option>');
                        $.each(response, function(key, value) {
                            $('#department_id').append('<option value="' + value.id + '">' + value.head_of_department + '</option>');
                        });

                        if ($('#department_id').val()) {
                            $('#department_id').trigger('change');
                        }
                    }
                });
            } else {
                $('#department_id').empty();
                $('#department_id').append('<option value="">All Departments</option>');
            }
        });

        $('.show_confirm').click(function(event) {
            var form = $('#form-'+ $(this).attr('custom1'));
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this section?`,
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
    });

    // Trigger change event to populate departments if division is already selected
    if ($('#division_id').val()) {
        $('#division_id').trigger('change');
    }
</script>
@endsection
