@extends('insighthub.layout.app')

@section('title', 'Email Template - View')

@section('styles')
    <style>
        .top-heading {
            color: #2E2F38;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }


        .custom-text-muted {
            color: #727790;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }


        .settings-card {
            padding: 24px;
            margin-top: 48px;
            border-radius: 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.03);
        }

        .settings-card-header {
            padding-bottom: 24px;
            margin-bottom: 24px;
            border-bottom: 1px solid #ECF0F3;
        }

        .section-label {
            color: #727790;
font-size: 14px;
font-weight: 600;
margin-bottom: 24px;
        }

        .section-text {
            color: #2E2F38;
font-size: 14px;
font-weight: 400;
line-height: 19px;
        }

    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Email Template
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">General Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Email Template</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">- View Email Template</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="settings-card">
                <div class="settings-card-header d-flex justify-content-between align-items-center">
                    <h4 class="m-0 top-heading">View Email Templates</h4>
                </div>


                <div class="row mb-10">
                <div class="col-md-6 mb-md-0 mb-3">
                    <label class="section-label">Module</label>
                    <p class="section-text">{{ $template->module ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="section-label">Email Action</label>
                    <p class="section-text">{{ $template->title ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="mb-10">
                <label class="section-label">Description</label>
                <p class="section-text">{{ $template->description ?? 'No description available.' }}</p>
            </div>

            <div class="mb-10">
                <label class="section-label">Subject Line</label>
                <p class="section-text">{{ $template->subject ?? 'No subject' }}</p>
            </div>

            <div class="mb-10">
                <label class="section-label">Email Content</label>
                <div class="section-text">{!! $template->email_content  !!}</div>
            </div>

            {{-- <div class="mb-10">
                <label class="section-label">Placeholders</label>
                @if(!empty($template->placeholders))
                    <ul>
                        @foreach(json_decode($template->placeholders, true) as $placeholder)
                            <li class="section-text">{{ $placeholder }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="section-text">No placeholders defined.</p>
                @endif
            </div> --}}

            <div class="mt-4 text-end text-muted">
                <small>Last updated on {{ optional($template->updated_at)->format('d M Y, h:i A') ?? 'N/A' }}</small>
            </div>
        </div>
    </div>
</div>

    @endsection

    @section('scripts')

    @endsection
