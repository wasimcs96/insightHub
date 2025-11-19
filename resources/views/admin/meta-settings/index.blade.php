@extends('admin.layout.app')

@section('title', 'PMS Setting')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                PMS Setting
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">PMS Setting</li>
            </ul>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container w-100">
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">PMS Settings</span>
                </h3>
            </div>

            <div class="card-body py-3">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-125px text-center">Setting Type</th>
                                <th class="min-w-125px text-center">Start Date</th>
                                <th class="min-w-125px text-center">Expiry Date</th>
                                <th class="min-w-125px text-center">Status</th>
                                <th class="min-w-125px text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $setting)
                            @php
                            $isRunning = $setting['end_date'] && \Carbon\Carbon::parse($setting['end_date'])->isFuture();
                            $status = $isRunning ? 'Running' : 'Expired';
                            @endphp
                            <tr>
                                <td class="text-center align-middle">{{ $setting['setting_name'] }}</td>
                                <td class="text-center align-middle">{{ $setting['start_date'] ? \Carbon\Carbon::parse($setting['start_date'])->format('Y-m-d') : 'N/A' }}</td>
                                <td class="text-center align-middle">
                                    <form action="/admin/meta-settings" method="POST">
                                        @csrf
                                        <input type="hidden" name="type" value="{{ $setting['setting_name'] }}">
                                        <input type="date" class="form-control expiry-date" name="expiry_date" value="{{ $setting['end_date'] ? \Carbon\Carbon::parse($setting['end_date'])->format('Y-m-d') : '' }}" min="{{ now()->format('Y-m-d') }}">
                                </td>
                                <td class="text-center align-middle">
                                    <select class="form-select form-select-sm" name="status">
                                        <option value="active" {{ $setting['status'] == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $setting['status'] == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </td>
                                <td class="text-center align-middle">
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                </td>
                                    </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
