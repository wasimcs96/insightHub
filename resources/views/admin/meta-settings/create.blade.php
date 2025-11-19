@extends('admin.layout.app')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1
                class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Settings Create
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Dashboard </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/mydepartment/department_sections" class="capitalize text-muted text-hover-primary">
                        PMS Settings
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    Create Section </li>
            </ul>
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content  flex-column-fluid ">
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Create Settings</span>
                </h3>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                      
                            <form action="{{ route('meta-settings.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="setting_name">Setting Type</label>
                                    <select name="setting_name" id="setting_name" class="form-control">
                                            <option value="manager_approval">Manager Approval</option>
                                            <option value="mid_year">Mid Year </option>
                                            <option value="end_year">End Year</option>
                                            <option value="planning">Planning</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Create Settings</button>
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
    // Set the minimum date for end_date input
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('end_date').setAttribute('min', today);
    });
</script>
@endsection