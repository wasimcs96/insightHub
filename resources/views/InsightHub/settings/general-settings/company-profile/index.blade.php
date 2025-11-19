@extends('insighthub.layout.app')

@section('title', 'Company Profile')

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
            padding: 24px 24px 0px 24px;
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

        .field-label {
            color: #727790;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 21.5px;
        }

        .field-value {
            color: #2E2F38;
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
            margin-bottom: 44px;
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
        }

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
            border: none;
        }

      .feedback-message {
    display: flex;
    border-radius: 8px;
    border: 1px solid #BBECC5;
    background: #DDF5E2;
    color: #1E4620;
    padding: 16px 24px;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.feedback-message.fade-out {
    opacity: 0;
    transform: translateY(-10px);
}


        .feedback-message p {
            color: #19622A;
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
        }

        .feedback-message .icon {
            color: #727790;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Company Profile
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
                </ul>
            </div>
        </div>
    </div>

   <div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

   @if (session('success'))
    <div id="feedbackMessage" class="feedback-message d-flex justify-content-between align-items-center mt-3 mb-3">
        <p class="text-center fw-medium m-0">
            <strong>Success!</strong> {{ session('success') }}
        </p>
        <button type="button" class="btn border-0 bg-transparent p-0" id="closeIcon" aria-label="Close" style="font-size: 18px;">
            &times;
        </button>
    </div>
@endif



    </div>
</div>


    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            @include('insighthub.settings.index')

            <!-- ✅ Tab Content -->
            <div class="tab-content">

                <!-- ✅ Company Profile -->
                <div class="tab-pane fade show active" id="company" role="tabpanel">
                    <div class="settings-card">
                        <div class="settings-card-header d-flex justify-content-between align-items-center">
                            <h4 class="m-0 top-heading">Company Information</h4>
                            <a href="{{route('company-profile.edit')}}"><button class="custom-btn orange-fill">Edit</button></a>
                        </div>

                       <div class="d-flex align-items-start gap-4">
    <div class="d-flex align-items-center gap-7 w-100 logo-text-section">

        <div class="logo-upload-box">
            @if(!empty($company) && $company->company_logo)
                {{-- ✅ Show actual uploaded logo --}}
                <img 
                    src="{{ asset('storage/' . $company->company_logo) }}" 
                    alt="Company Logo" 
                    width="70" 
                    height="70" 
                    class="rounded-circle object-fit-cover">
            @else
                {{-- ❌ Fallback: camera icon --}}
                <iconify-icon icon="bxs:camera" width="70" height="70"></iconify-icon>
            @endif
        </div>

        <div class="d-flex flex-column">
            <h4 class="mb-5">Company Logo</h4>
            <p class="custom-text-muted m-0">Update your company logo. (PNG, JPG, up to 5MB)</p>
        </div>
    </div>
</div>


                       <div class="row">
    <div class="col-md-6">
        <div>
            <div class="field-label">Company Name</div>
            <div class="field-value">{{ $company->company_name ?? '-' }}</div>
        </div>

      @if($company)
    <div class="field-value">
        <div class="field-label">Date Established</div>
        {{ $company->date_established ? \Carbon\Carbon::parse($company->date_established)->format('d/m/Y') : '-' }}
    </div>
@else
    <div class="field-value">-</div>
@endif

        <div>
            <div class="field-label">Company Size</div>
            <div class="field-value">{{ $company->company_size ?? '-' }}</div>
        </div>

        <div>
            <div class="field-label">Company Contact Number</div>
            <div class="field-value">{{ $company->company_contact_number ?? '-' }}</div>
        </div>

      <div>
    <div class="field-label">Company Website</div>
    <div class="field-value">
        @if($company?->company_website)
            <a href="{{ $company->company_website }}" target="_blank">{{ $company->company_website }}</a>
        @else
            -
        @endif
    </div>
</div>


        <div>
            <div class="field-label">Sub Sector</div>
            <div class="field-value">{{ $company->sub_sector ?? '-' }}</div>
        </div>
    </div>

    <div class="col-md-6">
        <div>
            <div class="field-label">Business Registration Number</div>
            <div class="field-value">{{ $company->business_registration_number ?? '-' }}</div>
        </div>

        <div>
            <div class="field-label">Country</div>
            <div class="field-value">{{ $company->country ?? '-' }}</div>
        </div>

        <div>
            <div class="field-label">Number of Employees</div>
            <div class="field-value">{{ $company->number_of_employees ?? '-' }}</div>
        </div>

        <div>
            <div class="field-label">Company Email</div>
            <div class="field-value">{{ $company->company_email ?? '-' }}</div>
        </div>

        <div>
            <div class="field-label">Industry/Sector</div>
            <div class="field-value">{{ $company->industry_sector ?? '-' }}</div>
        </div>

        <div>
            <div class="field-label">Company Address</div>
            <div class="field-value">{{ $company->company_address ?? '-' }}</div>
        </div>
    </div>
</div>

                    </div>
                </div>

                <!-- ✅ Company Values -->
                <div class="tab-pane fade" id="values" role="tabpanel">
                    <div class="settings-card">
                        <h4>Company Values</h4>
                        <p class="custom-text-muted">Add value details, mission, vision etc...</p>
                    </div>
                </div>

                <!-- ✅ Organization Structure -->
                <div class="tab-pane fade" id="structure" role="tabpanel">
                    <div class="settings-card">
                        <h4>Organization Structure</h4>
                        <p class="custom-text-muted">Employee departments, hierarchy, onboarding processes...</p>
                    </div>
                </div>

                <!-- ✅ Email Templates -->
                <div class="tab-pane fade" id="email" role="tabpanel">
                    <div class="settings-card">
                        <h4>Email Templates</h4>
                        <p class="custom-text-muted">Setup onboarding and notification templates...</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const closeIcon = document.getElementById('closeIcon');
    const feedbackMessage = document.getElementById('feedbackMessage');

    if (closeIcon && feedbackMessage) {
        closeIcon.addEventListener('click', function () {
            feedbackMessage.classList.add('fade-out');
            setTimeout(() => {
                feedbackMessage.remove();
            }, 300);
        });

        // Optional: Auto-hide after 5 seconds
        setTimeout(() => {
            if (feedbackMessage) {
                feedbackMessage.classList.add('fade-out');
                setTimeout(() => feedbackMessage.remove(), 300);
            }
        }, 5000);
    }
});
</script>


@endsection
