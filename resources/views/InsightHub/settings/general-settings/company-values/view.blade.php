@extends('insighthub.layout.app')

@section('title', 'Company Values - Add')

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

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }


        .tag {
            display: flex;
            padding: 2px 14px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #F7941C;
            background: #FFF8EB;
            color: #D5540A;
            font-size: 14px;
            font-weight: 600;
            height: 32px;
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
                Company Values
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
                <li class="breadcrumb-item text-muted">Company Values</li>
                <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                <li class="breadcrumb-item text-muted">- View Company Values</li>
            </ul>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid p-0">
    <div id="kt_app_content_container" class="container-xxl app-container">
        <div class="settings-card">
            <div class="settings-card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0 top-heading">View Company Value</h4>
                {{-- <a href="{{ route('admin.settings.company-values.index') }}" class="custom-btn black-outline">Back</a> --}}
            </div>

            <!-- Company Value Name -->
            <div class="mb-10">
                <h6 class="section-label">Company Value Name</h6>
                <p class="section-text" id="companyValueName">Loading...</p>
            </div>

            <!-- Description -->
            <div class="mb-10">
                <h6 class="section-label">Company Value Description</h6>
                <p class="section-text" id="companyValueDescription">Loading...</p>
            </div>

            <!-- Facets -->
            <div class="mb-10">
                <h6 class="section-label">Facets</h6>
                <div id="companyValueFacets" class="d-flex gap-2 flex-wrap"></div>
            </div>

            <!-- Developmental Stage Description -->
            <div class="mb-10">
                <h6 class="section-label">Developmental Stage Description</h6>
                <p class="section-text" id="developmentStageDesc">Loading...</p>
            </div>

            <!-- Basic Level Description -->
            <div class="mb-10">
                <h6 class="section-label">Basic Level Description</h6>
                <p class="section-text" id="basicLevelDesc">Loading...</p>
            </div>

            <!-- Intermediate Level Description -->
            <div class="mb-10">
                <h6 class="section-label">Intermediate Level Description</h6>
                <p class="section-text" id="intermediateLevelDesc">Loading...</p>
            </div>

            <!-- Advanced Level Description -->
            <div class="mb-5">
                <h6 class="section-label">Advanced Level Description</h6>
                <p class="section-text" id="advancedLevelDesc">Loading...</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    // Extract ID from URL (like /admin/settings/company-values/5/show)
    const pathParts = window.location.pathname.split('/');
    const id = pathParts[pathParts.length - 2]; // second to last segment before 'show'

    if (id) {
        $.ajax({
            url: `/insighthub/settings/company-values/${id}/show`,
            method: "GET",
            success: function (response) {
                const data = response.data;
                $('#companyValueName').text(data.company_value_name || '-');
                $('#companyValueDescription').text(data.company_value_description || '-');

                // Facets
                let facetsHtml = '';
                (data.facets || []).forEach(f => facetsHtml += `<span class="tag">${f}</span>`);
                $('#companyValueFacets').html(facetsHtml || '<span class="text-muted">No facets</span>');

                $('#developmentStageDesc').text(data.developmental_stage_description || '-');
                $('#basicLevelDesc').text(data.basic_level_description || '-');
                $('#intermediateLevelDesc').text(data.intermediate_level_description || '-');
                $('#advancedLevelDesc').text(data.advanced_level_description || '-');
            },
            error: function () {
                toastr.error("Failed to load company value details!");
            }
        });
    } else {
        toastr.error("Invalid Company Value ID in URL!");
    }
});
</script>
@endsection
