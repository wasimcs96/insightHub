@extends('admin.layout.app')

@push('styles')
    <style>
        .app-wrapper {
            margin-top: 74px !important;
        }
    </style>
@endpush

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h2 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Change Log
                </h2>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary">Org Chart</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.job-openings.index') }}" class="text-muted text-hover-primary">
                            Change Log
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl w-100 mt-17">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h2 class="capitalize">Change Log - Org Chart</h2>
                    </div>
                </div>
                @livewire('generic.dynamic-table', [
                    'model' => $model,
                    'columns' => ['change_type', 'details', 'change_by', 'reason', 'source', 'created_at'],
                    'filters' => [
                        ['column' => 'change_type', 'operator' => '!=', 'value' => '']
                    ],
                    'stickyColumns' => ['change_type'],
                    'searchableColumns' => ['details', 'change_by', 'change_type', 'reason'],
                    'headerDisplay' => [
                        // 'change_type' => fn($columnName) => "<i>{$columnName}</i>", // callbacks are also supported
                        'created_at' => 'Date & time',
                    ],
                    'dataDisplay' => [
                        'details' => function ($value, $model) {
                            $details = explode(' ', $value);
                            $action = array_shift($details);
                            $rest = implode(' ', $details);
                            return "<b>{$action}</b> {$rest}";
                        },
                        'created_at' => fn($value, $model) => $value->format('d M Y, h:i A'),
                    ],
                    'toolbarComponents' => ['org-chart-filter-off-canvas'],
                    'exportable' => ['csv'],
                    'selectEnabled' => true,
                ])
            </div>
        </div>
    </div>
@endsection
