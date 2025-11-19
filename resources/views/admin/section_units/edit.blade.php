@extends('admin.layout.app')

@section('title', 'Edit Unit')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1
                class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Edit Unit
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Home </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/section_units" class="capitalize text-muted text-hover-primary">
                        My Units
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    Edit Unit
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content  flex-column-fluid ">
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Edit Unit</span>
                </h3>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('section_units.update', $sectionUnit) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="department_id">Department</label>
                                    <select name="department_id" id="department_id" class="form-control">
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ $department->id == $sectionUnit->department_id ? 'selected' : '' }}>{{ $department->head_of_department }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="department_section_id">Section</label>
                                    <select name="department_section_id" id="department_section_id" class="form-control">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $sectionUnit->name }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active" {{ $sectionUnit->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $sectionUnit->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Update Unit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#department_id').change(function() {
            var departmentId = $(this).val();
            if (departmentId) {
                $.ajax({
                    url: '/admin/get-sections/' + departmentId,
                    type: 'GET',
                    success: function(response) {
                        $('#department_section_id').empty();
                        $('#department_section_id').append('<option value="">Select Section</option>');
                        $.each(response, function(key, value) {
                            $('#department_section_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        // Set the selected section if available
                        var selectedSection = "{{ $sectionUnit->department_section_id }}";
                        if (selectedSection) {
                            $('#department_section_id').val(selectedSection);
                        }
                    }
                });
            } else {
                $('#department_section_id').empty();
                $('#department_section_id').append('<option value="">Select Section</option>');
            }
        });

        // Trigger change event to populate sections if department is already selected
        if ($('#department_id').val()) {
            $('#department_id').trigger('change');
        }
    });
</script>
@endsection
