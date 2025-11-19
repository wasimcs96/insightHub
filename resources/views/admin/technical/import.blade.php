{{-- @extends('admin.layout.app')
@section('content')


<form action="{{ route('technicalAss.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".xlsx,.xls" required>
    <button type="submit" class="btn btn-primary">Import Questions</button>
</form>
@endsection --}}
@extends('admin.layout.app')

@section('title', 'Import Technical Question')

@section('styles')
{{-- Uncomment if needed --}}
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Technical Assessment Import
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
                    <a href="/admin/technical/assessment/index" class="capitalize text-muted text-hover-primary">
                        My Assessment
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{ !empty($user) ? 'Edit Survey' : 'Import Assessment' }}
                </li>
            </ul>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a href="{{ route('technicalAss.index') }}" class="btn btn-primary d-flex align-items-center">
                    <iconify-icon icon="weui:back-filled"></iconify-icon>
                    Back To List
                </a>
            </div>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body">
            <a href="{{ route('technicalAss.downloadTemplate') }}" class="btn btn-primary mb-3">Download Template</a>

                <form class="form" action="{{ route('technicalAss.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    
                      <legend class="">Import Technical Question</legend>
                   
                      <div class="mb-3">
                        {{-- <label for="file" class="form-label">File</label> --}}
                        <input type="file" id="" name="file" accept=".xlsx,.xls" class="form-control" placeholder="">
                      </div>
                   
                      <div class="d-flex justify-content-between align-items-center mt-3 mt-5">
                        <button type="submit" class="btn btn-sm btn-primary mb-3">{{ trans('Import Question') }}</button>
                    </div>

                    
                  </form>
            </div>
        </div>
    </div>
</div>


@endsection

{{-- <form class="form" action="{{ route('technicalAss.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-7">
        <div class="col-lg-6">
            <div class="col-lg-3">
                <label for="file">{{ trans('File') }}</label>
                <input type="file" name="file" accept=".xlsx,.xls" required>
            </div>
    </div>
</div>



    <div class="d-flex justify-content-between align-items-center mt-3">
        <button type="submit" class="btn btn-sm btn-primary mb-3">{{ trans('Import Question') }}</button>
    </div>
</form> --}}