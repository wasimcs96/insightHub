@extends('insighthub.layout.app')

@section('title', 'Manage Your Account Information')
@section('styles')
    <style>
        .feedback-message.fade-out {
            opacity: 0;
            transform: translateY(-10px);
        }

        .feedback-message {
            display: flex;
            border-radius: 8px;
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            padding: 24px;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .feedback-message p {
            color: #19622A;
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
        }

        .feedback-message .icon {
            color: #727790;
            cursor: pointer;
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

        .custom-btn.orange-outline {
            background: #fff;
            color: #F7941C;
            border: 1px solid #F7941C;
        }

        .settings-card {
            padding: 24px;
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

        .top-heading {
            color: #2E2F38;
            font-size: 24px;
            font-weight: 600;
        }

        .field-label {
            color: #727790;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .field-value {
            color: #2E2F38;
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
            margin-bottom: 36px;
        }
    </style>

@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">

            {{-- Success Message --}}
            @if (session('success'))
                <div id="feedbackMessage"
                    class="feedback-message d-flex justify-content-between align-items-center mt-3 mb-5">
                    <p class="text-center fw-medium m-0">
                        <strong>Success!</strong> {{ session('success') }}
                    </p>
                    <button type="button" class="btn border-0 bg-transparent p-0" id="closeIcon" aria-label="Close"
                        style="font-size: 18px;">
                        <iconify-icon icon="iconamoon:close" width="20" height="20"></iconify-icon>
                    </button>
                </div>
            @endif

            <div class="settings-card">
                <div class="settings-card-header d-flex justify-content-between align-items-center">
                    <h4 class="m-0 top-heading">Manage Your Account Information</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('account.edit') }}"><button class="custom-btn orange-outline">Edit</button></a>
                        <a href="{{ route('account.changePassword') }}"><button class="custom-btn orange-outline">Change
                                Password</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <div class="field-label">First Name</div>
                       <div class="field-value">{{ $user->first_name ?? '-' }}</div>
                    </div>

                    <div class="col-md-6">

                        <div class="field-label">Last Name</div>
                       <div class="field-value">{{ $user->last_name ?? '-' }}</div>
                    </div>

                    <div class="col-md-6">

                        <div class="field-label">Email</div>
                       <div class="field-value">{{ $user->email ?? '-' }}</div>
                    </div>

                    <div class="col-md-6">

                        <div class="field-label">Mobile No.</div>
                       <div class="field-value">{{ $user->mobile_number ?? '-' }}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeIcon = document.getElementById('closeIcon');
            const feedbackMessage = document.getElementById('feedbackMessage');

            if (closeIcon && feedbackMessage) {
                closeIcon.addEventListener('click', function() {
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
