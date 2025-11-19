@extends('avenger.layouts.app')

@section('title', 'OTP | ' . env('APP_NAME'))
@section('description', 'Verify your identity securely with our OTP (One-Time Password) page. Safely authenticate your
    account and gain access to your account or complete transactions with confidence.')
@section('keywords', 'OTP, One-Time Password, authentication code, verification code, secure login, account security,
    two-factor authentication, OTP page, code verification')

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

<!--begin::Authentication - Two-factor -->
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

            <div class="two-factor right-section">
                <h3 class="fw-bolder">Two-Factor Verification</h3>
                <p class="fw-normal mb-0">Welcome! Ready to take the next step in your career? <br>Register to continue your
                    journey!</p>
                <p class="fw-bolder mt-0 mb-5">{{ session('email') }}</p>
                <form  data-kt-redirect-url="{{ route('auth.otp.verify') }}" action="{{ route('auth.otp.verify') }}"
                method="POST" id="kt_sing_in_two_factor_form">
                    @csrf
                    <input type="text" name="email" value="{{ session('email') }}" hidden>

                    <div class="d-flex justify-content-center gap-3 mb-5">
                        <input type="text" class="otp-input form-control" name="code_1" maxlength="1" pattern="[0-9]" required  data-inputmask="'mask': '9', 'placeholder': ''"
                        maxlength="1" value="">
                        <input type="text" class="otp-input form-control" name="code_2" maxlength="1" pattern="[0-9]" required  data-inputmask="'mask': '9', 'placeholder': ''"
                        maxlength="1" value="">
                        <input type="text" class="otp-input form-control" name="code_3" maxlength="1" pattern="[0-9]" required  data-inputmask="'mask': '9', 'placeholder': ''"
                        maxlength="1" value="">
                        <input type="text" class="otp-input form-control" name="code_4" maxlength="1" pattern="[0-9]" required  data-inputmask="'mask': '9', 'placeholder': ''"
                        maxlength="1" value="">
                        <input type="text" class="otp-input form-control" name="code_5" maxlength="1" pattern="[0-9]" required  data-inputmask="'mask': '9', 'placeholder': ''"
                        maxlength="1" value="">
                        <input type="text" class="otp-input form-control" name="code_6" maxlength="1" pattern="[0-9]" required  data-inputmask="'mask': '9', 'placeholder': ''"
                        maxlength="1" value="">
                    </div>
                    @if (session('error'))
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div data-field="last_name" data-validator="notEmpty">
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif
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
<!--end::Authentication - Two-factor-->
@section('scripts')
    {{-- <script src="{{ asset('assets/js/custom/authentication/sign-in/two-factor.js') }}"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all input elements
            const inputs = document.querySelectorAll('input[type="text"][name^="code_"]');

            // Loop through each input element
            inputs.forEach((input, index) => {
                // Add an input event listener to each input
                input.addEventListener('input', function() {
                    // Check if the input's value length matches its maxlength
                    if (input.value.length === parseInt(input.maxLength, 10)) {
                        // If it's not the last input, move focus to the next one
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    }
                });
            });

            // Select the first input field for the OTP
            const firstInput = document.querySelector('input[name="code_1"]');

            // Listen for paste events on the first input field
            firstInput.addEventListener('paste', function(event) {
                // Prevent the default paste action
                event.preventDefault();

                // Get the text content from the clipboard
                const paste = (event.clipboardData || window.clipboardData).getData('text');

                // Split the pasted text into individual characters
                const digits = paste.split('');

                // Select all input fields
                const inputs = document.querySelectorAll('input[type="text"][name^="code_"]');

                // Fill each input field with the corresponding digit
                inputs.forEach((input, index) => {
                    if (index < digits.length) {
                        input.value = digits[index];
                        // Trigger change event if necessary
                        input.dispatchEvent(new Event('change'));
                    }
                });
            });

        });
    </script>

@endsection
