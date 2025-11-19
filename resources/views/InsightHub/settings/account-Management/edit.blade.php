@extends('insighthub.layout.app')

@section('title', 'Edit Account')
@section('styles')
    <style>
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
                        <li class="breadcrumb-item text-muted">Edit Account</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Card --}}
        <div id="kt_app_content" class="app-content flex-column-fluid p-0">
            <div id="kt_app_content_container" class="container-xxl app-container">
                <div class="settings-card">
                    <div class="settings-card-header d-flex justify-content-between align-items-center">
                        <h4 class="m-0 top-heading">Edit Account</h4>
                    </div>
                    <form method="POST" action="{{ route('account.update') }}">
                        @csrf
                        <div class="company-form mt-6">
                            <div class="row g-8">
                                {{-- First Name --}}
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="first_name" name="first_name"
                                        class="form-control custom-input @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name', $user->first_name) }}" placeholder="Jane" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Last Name --}}
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="last_name" name="last_name"
                                        class="form-control custom-input @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name', $user->last_name) }}" placeholder="Doe" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- Email --}}
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email"
                                        class="form-control custom-input @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" placeholder="admin.eei@insightaccess.com"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Mobile --}}
                                <div class="col-md-6">
                                    <label for="mobile_no" class="form-label">Mobile No.<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="mobile_no" name="mobile_no"
                                        class="form-control custom-input @error('mobile_no') is-invalid @enderror"
                                        value="{{ old('mobile_no', $user->mobile_number) }}" placeholder="+1-555-987-6543"
                                        required>
                                    @error('mobile_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>
                {{-- Buttons --}}
                <div class="d-flex align-items-center gap-3 justify-content-end mt-8">
                    <a href="{{ route('account.index') }}" class="custom-btn grey-outline">Cancel</a>
                    <button type="submit" class="custom-btn orange-fill">Update</button>
                </div>
                </form>
            </div>
        </div>
    @endsection
