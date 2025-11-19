@extends('insighthub.layout.app')

@section('title', 'Change Password')
@section('styles')
    <style>
        .form-control:focus {
            border-color: #BD2618;
        }

        .form-control.is-invalid {
            border-color: #BD2618;
        }

        .form-control.is-invalid:focus {
            border-color: #BD2618;
        }

        .invalid-feedback {
            display: block;
            color: #BD2618;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .invalid-feedback i {
            margin-right: 0.25rem;
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

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
            border: none;
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

        .company-form .form-label {
            margin-bottom: 8px;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 600;
        }

        .company-form label {
            font-weight: 600;
            color: #333;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">

        {{-- Breadcrumb --}}
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                        Edit Account
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item">
                            <a href="/admin/dashboard" class="text-muted text-hover-primary">Account Management</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">Change Password</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Card --}}
        <div id="kt_app_content" class="app-content flex-column-fluid p-0">
            <div id="kt_app_content_container" class="container-xxl app-container">
                <div class="settings-card">
                    <div class="settings-card-header d-flex justify-content-between align-items-center">
                        <h4 class="m-0 top-heading">Change Password</h4>
                    </div>
                    <form method="POST" action="{{ route('account.changePassword.update') }}">
                        @csrf

                        <div class="company-form mt-6">
                            <div class="row g-8">
                                {{-- Current Password --}}
                                <div class="col-md-6">
                                    <label for="current_password" class="form-label">Current Password<span
                                            class="text-danger">*</span></label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-control custom-input @error('current_password') is-invalid @enderror"
                                        placeholder="Enter Current Password" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- New Password --}}
                                <div class="col-md-6">
                                    <label for="password" class="form-label">New Password<span
                                            class="text-danger">*</span></label>
                                    <input type="password" id="password" name="password"
                                        class="form-control custom-input @error('password') is-invalid @enderror"
                                        placeholder="Enter New Password" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        {{-- Buttons --}}

                </div>
                <div class="d-flex align-items-center gap-3 justify-content-end mt-8">
                    <a href="{{ route('account.index') }}" class="custom-btn grey-outline">Cancel</a>
                    <button type="submit" class="custom-btn orange-fill">Update</button>
                </div>
                </form>

            </div>
        </div>
    </div>

@endsection
