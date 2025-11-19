@extends('avenger.layouts.app')

@section('title', 'Registration | ' . env('APP_NAME'))
@section('description',
    'Register with us to unlock exclusive benefits. Create your account quickly and securely to
    access personalized features. Join our community and start your journey today.')
@section('keywords',
    'register, sign up, create account, user registration, new account, account creation, registration
    form, join now, membership, registration process')

@section('styles')
    <!--begin::Page bg image-->
    <style>
        body {
            background-image: url('{{ asset('assets/media/auth/bg10.jpg') }}');
        }

        [data-bs-theme="dark"] body {
            background-image: url('{{ asset('assets/media/auth/bg10-dark.jpg') }}');
        }
    </style>
    <!--end::Page bg image-->


    <style>
        .sign-up-div {
            background-color: #F1F1F4;
            padding: 58px 0px;
            min-height: 78vh;
        }

        .sign-up-div .container {
            grid-template-columns: 49% 49%;
            gap: 26px;
            align-items: center;
        }

        .left-section h4 {
            color: #4B5675;
            font-size: 32.5px;
            line-height: 39px;
        }

        .left-section p {
            color: #4B5675;
            font-size: 16px;
            font-weight: 400;
            line-height: 25px;
        }

        .sign-up-div .right-section {
            padding: 48px;
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .sign-up-div .right-section h3 {
            color: #4B5675;
            font-size: 22.75px;
            line-height: 27.3px;
        }

        .sign-up-div .right-section p {
            color: #99A1B7;
            font-size: 16px;
            line-height: 24px;
            margin: 16px 0px;
        }

        .sign-up-div form label {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            margin-bottom: 4px;
        }

        .sign-up-div .right-section form p {
            color: #78829D;
            font-size: 14px;
            line-height: 20px;
        }

        .sign-up-div form input,
        .sign-up-div form select {
            height: 40px;
            padding: 0px 12px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background-color: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .sign-up-div .two-factor form input {
            height: auto;
            padding: 16px 12px;
            color: #99A1B7;
            text-align: center;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
        }
    </style>

@endsection

<!--begin::Authentication - Sign-in -->
@section('content')
    <div class="d-flex align-items-center justify-content-center sign-up-div">
        <div class="container d-grid">
            <div class="left-section">
                <a href="/">
                    <img alt="Logo" src="{{ asset('media/insightaccess.png') }}" class="logo-default responsive-logo "
                        style="height: 50px" />
                </a>
                <h4 class="fw-bold my-8 w-75">Discover Your Potential:<br>Empowering Careers Through Insightful Assessment
                </h4>
                <p class="m-0 fw-normal">
                    Unlock potential with our psychometric portal, guiding careers through insightful assessments.
                    Find your perfect job through our job portal, where opportunities meet aspirations.
                    We empower individuals to discover their strengths and align them with fulfilling careers.
                </p>
            </div>

            <div class="right-section">
                <h3 class="fw-bolder">Sign Up</h3>
                <p class="fw-normal">Welcome! Ready to take the next step in your career? <br>Register to continue your
                    journey!</p>
                <form novalidate="novalidate" id="kt_sign_up_form" data-kt-redirect-url="{{ route('register') }}"
                    action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <label>First Name</label>
                            <input type="text" class="form-control" placeholder="First Name" name="first_name"
                                value="{{ old('first_name') }}" autocomplete="first_name">
                            @error('first_name')
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="first_name" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name"
                                value="{{ old('last_name') }}" autocomplete="last_name">
                            @error('last_name')
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="last_name" data-validator="notEmpty">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" >
                        @error('email')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="email" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label>Select Country Code</label>
                        <select class="form-select" name="country_code">
                            <option value="" selected>Select Country Code</option>
                            <option value="+63">+63 Philippines</option>
                            <option value="+60">+60 Malaysia</option>
                        </select>
                        @error('country_code')
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            <div data-field="mobile" data-validator="notEmpty">
                                {{ $message }}
                            </div>
                        </div>
                    @enderror
                    </div>

                    <div class="mb-5">
                        <label>Mobile</label>
                        <input type="text" class="form-control" placeholder="Mobile (For ex. 289911914)" name="mobile_number"
                        value="{{ old('mobile_number') }}">
                        @error('mobile_number')
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            <div data-field="mobile" data-validator="notEmpty">
                                {{ $message }}
                            </div>
                        </div>
                    @enderror

                    </div>

                    <div class="mb-5">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <small class="text-muted">Use 8+ characters with a mix of letters, numbers & symbols for a
                            secured password.</small>
                            @error('password')
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <div data-field="password" data-validator="notEmpty">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                    </div>

                    <button type="submit" class="custom-btn  btn-orange-fill cursor-pointer w-100">Sign Up</button>

                    <p class="custom-btn fw-bold mt-5 mb-0">
                        Already have an account? <a href="/login" class="text-decoration-none fw-bold"
                            style="color: #F7941C;">Log in</a>
                    </p>
                </form>
            </div>

            <div class="two-factor right-section d-none">
                <h3 class="fw-bolder">Two-Factor Verification</h3>
                <p class="fw-normal mb-0">Welcome! Ready to take the next step in your career? <br>Register to continue your
                    journey!</p>
                <p class="fw-bolder mt-0 mb-5">ericahmarie@yopmail.com</p>
                <form>
                    <div class="d-flex justify-content-center gap-3 mb-5">
                        <input type="text" class="otp-input form-control" maxlength="1" pattern="[0-9]" required>
                        <input type="text" class="otp-input form-control" maxlength="1" pattern="[0-9]" required>
                        <input type="text" class="otp-input form-control" maxlength="1" pattern="[0-9]" required>
                        <input type="text" class="otp-input form-control" maxlength="1" pattern="[0-9]" required>
                        <input type="text" class="otp-input form-control" maxlength="1" pattern="[0-9]" required>
                        <input type="text" class="otp-input form-control" maxlength="1" pattern="[0-9]" required>
                    </div>
                    <button type="submit" class="custom-btn  btn-orange-fill cursor-pointer w-100">Submit</button>
                </form>

                <p class="custom-btn fw-bold mt-5 mb-0">
                    Didn’t get the code? <a href="#" class="text-decoration-none fw-bold"
                        style="color: #F7941C;">Resend</a>
                </p>
            </div>
        </div>
    </div>

@endsection
<!--end::Authentication - Sign-in-->
