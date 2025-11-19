@extends('insighthub.layout.app')

@section('title', 'Company Profile - Edit')

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

        .logo-text-section {
            padding: 16px 0px 40px 0px;
            border-bottom: 1px solid #ECF0F3;
            margin-bottom: 24px;
        }

        .logo-upload-box {
            width: 110px;
            padding: 16px 8px;
            height: 110px;
            border-radius: 9999px;
            background: lightgray 50% / cover no-repeat;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            color: #2E2F38;
        }

        .custom-btn {
            display: flex;
            height: 48px;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            line-height: 20px;
            width: fit-content;
        }

        .custom-btn.grey-outline {
            background: #fff;
            color: #727790;
            border: 1px solid #858BA6;
        }

        .custom-btn.black-outline {
            background: #fff;
            color: #2E2F38;
            border: 1px solid #C8CFD9;
        }

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
            border: none;
        }

        .company-form label {
            font-weight: 600;
            color: #333;
        }

        .custom-input {
            display: flex;
            height: 48px;
            padding: 14px 16px;
            align-items: center;
            align-self: stretch;
            color: #2E2F38;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: 21px;
            border-radius: 4px;
            border: 1px solid #C8CFD9;
            background: #FFF;
        }

        .custom-input:focus {
            background: #fff;
            border-color: #666;
            box-shadow: none;
        }

        .company-form .form-label {
            margin-bottom: 8px;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 600;
        }

    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Edit Company Information
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
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Company Profile</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Edit Company Information</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="settings-card">
                <div class="settings-card-header d-flex justify-content-between align-items-center">
                    <h4 class="m-0 top-heading">Edit Company Information</h4>
                </div>

          <form action="{{ route('company-profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="d-flex align-items-start gap-4">
        <div class="d-flex align-items-center gap-7 w-100 logo-text-section">
            <div class="logo-upload-box">
                @if(!empty($company) && $company->company_logo)
                    <img src="{{ asset('storage/' . $company->company_logo) }}" width="70" height="70" alt="Company Logo" class="rounded-circle object-fit-cover">
                @else
                    <iconify-icon icon="bxs:camera" width="70" height="70"></iconify-icon>
                @endif
            </div>
            <div class="d-flex flex-column">
                <h4 class="m-0">Company Logo</h4>
                <p class="custom-text-muted m-0 my-5">Update your company logo. (PNG, JPG, up to 5MB)</p>
                <input type="file" name="company_logo" class="form-control custom-input">
            </div>
        </div>
    </div>

    <div class="company-form mt-6">
        <div class="row g-8">
            <div class="col-md-6">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" value="{{ old('company_name', $company->company_name ?? '') }}" class="form-control custom-input" disabled>
            </div>

            <div class="col-md-6">
                <label class="form-label">Business Registration Number</label>
                <input type="text" name="business_registration_number" value="{{ old('business_registration_number', $company->business_registration_number ?? '') }}" class="form-control custom-input">
            </div>

            <div class="col-md-6">
                <label class="form-label">Date Established</label>
                <input type="date" name="date_established" value="{{ old('date_established', $company->date_established ?? '') }}" class="form-control custom-input">
            </div>

            <div class="col-md-6">
                <label class="form-label">Country</label>
                <input type="text" name="country" value="{{ old('country', $company->country ?? '') }}" class="form-control custom-input" disabled>
            </div>

            <div class="col-md-6">
                <label class="form-label">Company Size</label>
                <input type="text" name="company_size" value="{{ old('company_size', $company->company_size ?? '') }}" class="form-control custom-input">
            </div>

            <div class="col-md-6">
                <label class="form-label">Number of Employees</label>
                <input type="number" name="number_of_employees" value="{{ old('number_of_employees', $company->number_of_employees ?? '') }}" class="form-control custom-input">
            </div>

            <div class="col-md-6">
                <label class="form-label">Company Contact Number</label>
                <input type="text" name="company_contact_number" value="{{ old('company_contact_number', $company->company_contact_number ?? '') }}" class="form-control custom-input" disabled>
            </div>

            <div class="col-md-6">
                <label class="form-label">Company Email</label>
                <input type="email" name="company_email" value="{{ old('company_email', $company->company_email ?? '') }}" class="form-control custom-input" disabled>
            </div>

            <div class="col-md-6">
                <label class="form-label">Company Website</label>
                <input type="text" name="company_website" value="{{ old('company_website', $company->company_website ?? '') }}" class="form-control custom-input">
            </div>

            <div class="col-md-6">
                <label class="form-label">Industry/Sector</label>
                <input type="text" name="industry_sector" value="{{ old('industry_sector', $company->industry_sector ?? '') }}" class="form-control custom-input" disabled>
            </div>

            <div class="col-md-6">
                <label class="form-label">Sub Sector</label>
                <input type="text" name="sub_sector" value="{{ old('sub_sector', $company->sub_sector ?? '') }}" class="form-control custom-input">
            </div>

            <div class="col-md-6">
                <label class="form-label">Company Address</label>
                <input type="text" name="company_address" value="{{ old('company_address', $company->company_address ?? '') }}" class="form-control custom-input">
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 justify-content-end mt-8">
        <a href="{{ url()->previous() }}" class="custom-btn grey-outline">Cancel</a>
        <button type="submit" class="custom-btn orange-fill">Update</button>
    </div>
</form>

        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Wait for DOM to load
        document.addEventListener('DOMContentLoaded', function() {
            const confirmBtn = document.querySelector('.feedback.feedback-msg');
            const feedbackMsg = document.getElementById('feedbackMessage');
            const closeIcon = document.getElementById('closeIcon');

            confirmBtn.addEventListener('click', function() {
                feedbackMsg.style.display = 'flex'; // Make it visible with flex for alignment
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            closeIcon.addEventListener('click', function() {
                feedbackMsg.style.display = 'none'; // Hide it
            });
        });
    </script>
@endsection
