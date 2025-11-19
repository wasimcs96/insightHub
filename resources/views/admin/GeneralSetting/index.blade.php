@extends('admin.layout.app')
@section('title', 'General Settings')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    General Settings
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">
                            Admin </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        General Settings </li>
                </ul>
            </div>
        </div>
    </div>
     <form action="{{ route('general_setting.updateMultiple') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-10">
                <div class="card-body row">

                    @php
                        use Illuminate\Support\Facades\Storage;
                        $faviconPath = $favicon?->value;
                        $logoPath = $logo?->value;
                    @endphp

                    <!-- FAVICON SECTION -->
                    <div class="mb-5 col-lg-6">
                        <label class="form-label fw-bold">Favicon</label>
                        <div class="input-group">
                            <span class="input-group-text upload-trigger-favicon" style="cursor: pointer;">
                                <iconify-icon icon="mdi:upload" width="20" height="20"></iconify-icon>
                            </span>
                            <input type="text" id="favicon-preview" class="form-control"
                                value="{{ $faviconPath && Storage::disk('public')->exists($faviconPath) ? asset('storage/' . $faviconPath) : '' }}"
                                readonly>
                            <input type="file" id="favicon-input" name="favicon_image" class="d-none" accept="image/*">
                        </div>

                        @if ($faviconPath && Storage::disk('public')->exists($faviconPath))
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $faviconPath) }}" alt="Favicon" style="max-width: 40px;">
                            </div>
                        @endif
                    </div>

                    <!-- LOGO SECTION -->
                    <div class="mb-5 col-lg-6">
                        <label class="form-label fw-bold">Logo</label>
                        <div class="input-group">
                            <span class="input-group-text upload-trigger-logo" style="cursor: pointer;">
                                <iconify-icon icon="mdi:upload" width="20" height="20"></iconify-icon>
                            </span>
                            <input type="text" id="logo-preview" class="form-control"
                                value="{{ $logoPath && Storage::disk('public')->exists($logoPath) ? asset('storage/' . $logoPath) : '' }}"
                                readonly>
                            <input type="file" id="logo-input" name="logo_image" class="d-none" accept="image/*">
                        </div>

                        @if ($logoPath && Storage::disk('public')->exists($logoPath))
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo" style="max-width: 40px;">
                            </div>
                        @endif
                    </div>



                    <!-- Year input -->
                    <div class="mb-5 col-lg-6">
                        <label class="form-label fw-bold">Year</label>
                        <div class="input-group">
                            <input type="text" name="year" class="form-control"
                                value="{{ $year ? $year->value : date('Y') }}" placeholder="Enter year (e.g., 2025)">
                        </div>
                    </div>

                    <!-- Version input -->
                    <div class="mb-5 col-lg-6">
                        <label class="form-label fw-bold">Version</label>
                        <div class="input-group">
                            <input type="text" name="version" class="form-control"
                                value="{{ $version ? $version->value : '1.0.0' }}"
                                placeholder="Enter version (e.g., 2.0.0)">
                        </div>
                    </div>



                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelector('.upload-trigger-logo').addEventListener('click', () => {
            document.getElementById('logo-input').click();
        });

        document.getElementById('logo-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('logo-preview').value = file.name;
            }
        });

        document.querySelector('.upload-trigger-favicon').addEventListener('click', () => {
            document.getElementById('favicon-input').click();
        });

        document.getElementById('favicon-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('favicon-preview').value = file.name;
            }
        });
    </script>
@endsection
