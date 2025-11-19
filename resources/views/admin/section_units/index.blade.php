@extends('admin.layout.app')
 
@section('title', 'Units')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
       
        <!-- Page Title (Left Side) -->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Units
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize text-muted">Units</li>
            </ul>
        </div>
 
        <!-- Filters (Right Side) -->
        <div class="card-toolbar d-flex align-items-center">
            <form action="{{ route('section_units.index') }}" method="GET" class="d-flex align-items-center">
                <div class="me-2">
                    <select name="division_id" id="division_id" class="form-control">
                        <option value="">All Divisions</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                {{ $division->head_of_division }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="me-2">
                    <select name="department_id" id="department_id" class="form-control">
                        <option value="">All Departments</option>
                    </select>
                </div>
                <div class="me-2">
                    <select name="department_section_id" id="department_section_id" class="form-control">
                        <option value="">All Sections</option>
                    </select>
                </div>
                <div class="me-2">
                    <input type="text" name="name" class="form-control" placeholder="Search by Name" value="{{ request('name') }}">
                </div>
                <div class="me-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('section_units.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>
</div>
 
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">
        <div class="card container">
            <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
                <div class="card-title">
                    <h2 class="capitalize">Units List</h2>
                </div>
                @if(count($units) > 0)
                <div class="card-toolbar">
                    <a href="{{ route('section_units.create') }}" class="btn btn-primary">
                        <iconify-icon icon="charm:plus"></iconify-icon> Create Unit
                    </a>
                </div>
                @endif
            </div>
 
            <div class="card-body py-4">
                @if(!$units || count($units) == 0)
                    <div class="d-flex justify-content-center text-center">
                        <a href="{{ route('section_units.create') }}" class="btn btn-primary mb-3">
                            <iconify-icon icon="charm:plus"></iconify-icon> Click to add Unit
                        </a>
                    </div>
                @else
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($units as $unit)
                                <tr>
                                    <td>{{ $loop->iteration + ($units->currentPage() - 1) * $units->perPage() }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>{{ $unit->department->head_of_department }}</td>
                                    <td>{{ $unit->departmentSection->name }}</td>
                                    <td>{{ ucfirst($unit->status) }}</td>
                                    <td>
                                        <a href="{{ route('section_units.edit', $unit) }}" class="btn btn-primary">
                                            <iconify-icon icon="heroicons-outline:pencil-alt"></iconify-icon>
                                        </a>
                                        <form action="{{ route('section_units.destroy', $unit) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger show_confirm">
                                                <iconify-icon icon="iconamoon:trash-light"></iconify-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
 
                    <div class="d-flex justify-content-center">
                        {{ $units->appends(request()->query())->links() }}
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
 
                        // Trigger department change event to populate sections if department is already selected
                        if ($('#department_id').val()) {
                            $('#department_id').trigger('change');
                        }
                    }
                });
            } else {
                $('#department_id').empty();
                $('#department_id').append('<option value="">All Departments</option>');
                $('#department_section_id').empty();
                $('#department_section_id').append('<option value="">All Sections</option>');
            }
        });
 
        $('#department_id').change(function() {
            var departmentId = $(this).val();
            if (departmentId) {
                $.ajax({
                    url: '/admin/get-sections/' + departmentId,
                    type: 'GET',
                    success: function(response) {
                        $('#department_section_id').empty();
                        $('#department_section_id').append('<option value="">All Sections</option>');
                        $.each(response, function(key, value) {
                            $('#department_section_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#department_section_id').empty();
                $('#department_section_id').append('<option value="">All Sections</option>');
            }
        });
 
        // Trigger change events to populate departments and sections if division and department are already selected
        if ($('#division_id').val()) {
            $('#division_id').trigger('change');
        }
    });
 
    $('.show_confirm').click(function(event) {
        var form = $('#form-'+ $(this).attr('custom1'));
        event.preventDefault();
        swal({
                title: Are you sure you want to delete this unit?,
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
</script>
@endsection