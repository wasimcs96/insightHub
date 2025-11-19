@extends('admin.layout.app')

@section('title', 'Create Leave')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                Create Claim
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('allowance.index') }}" class="text-muted text-hover-primary">Claim</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body">
                <form action="{{route('allowance.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Name Field -->
                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Name</label>
                            <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Enter Claim Name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Maximum Amount</label>
                            <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Enter Maximum Amount For Claim" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Employee</label>
                            <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Enter Name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
