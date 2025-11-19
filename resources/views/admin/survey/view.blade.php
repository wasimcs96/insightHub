@extends('admin.layout.app')

@section('title', 'Survey Answers')
@section('styles')
<style>

    /* Custom CSS for better view */
    .card {
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f8f9fa;
        padding: 20px;
        border-bottom: 1px solid #e9ecef;
    }

    .card-title h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    .table {
        margin-top: 20px;
        border: 1px solid #dee2e6;
    }

    .table thead th {
        background-color: #f1f3f5;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .table tbody td {
        padding: 12px;
    }

    .page-title h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #495057;
    }

    .breadcrumb-item a {
        font-weight: 500;
        color: #6c757d;
    }

    .breadcrumb-item a:hover {
        color: #007bff;
    }
</style>
@endsection

@section('content')
@if (session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Survey Answers
            </h1>
            
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize text-muted">Survey</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize text-muted">Answers</li>
            </ul>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h2 class="capitalize">Survey Answers</h2>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <a href="{{ route('survey.index') }}" class="btn btn-primary d-flex align-items-center">
                            <iconify-icon icon="weui:back-filled"></iconify-icon>
                            Back
                        </a>
                    </div>
                </div>
            </div>
         
            <div class="card-body py-4">
                <table class="table align-middle table-row-dashed fs-6 gy-5 text-center" id="kt_table_answers">
                    <thead>
                        <tr class="text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-20px text-center">Question</th>
                            <th class="min-w-20px text-center">Answer</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach($userSurveyResults as $result)
                        <tr>
                            <td class="text-center">{{ $result->questions->question ?? '' }}</td>
                            <td class="text-center">{{ $result->answers->answer ?? '' }} {{ $result->answer ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
