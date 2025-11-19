@extends('auth.layouts.app')
@section('styles')
<!--begin::Page bg image-->
<style> 
    body {
        background-image: url('{{ asset("assets/media/auth/bg10.jpg") }}');
    }

    [data-bs-theme="dark"] body {
        background-image: url('{{ asset("assets/media/auth/bg10-dark.jpg") }}');
    }
</style>
<!--end::Page bg image-->
@endsection

<!--begin::Authentication - Two-factor -->
@section('content')
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100"> 
                <!--begin::Image-->                  
                <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('media/insightaccess.png')}}" alt=""/>    
                <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('media/insightaccess.png')}}" alt=""/>                 
                <!--end::Image-->

                <!--begin::Title-->
                <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7"> 
                    Reset Your Password
                </h1>  
                <!--end::Title-->

                <!--begin::Text-->
                {{-- <div class="text-gray-600 fs-base text-center fw-semibold">
                    In this kind of post, <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a> 

                    introduces a person they’ve interviewed <br/> and provides some background information about 
                    
                    <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a> 
                    and their <br/> work following this is a transcript of the interview.  
                </div> --}}
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <!--begin::Wrapper-->
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">

                        <!--begin::Form-->
                        <form class="form w-100 mb-13" novalidate="novalidate"
                            data-kt-redirect-url="{{ route('password.change') }}" action="{{ route('password.change') }}" method="POST" id="kt_sing_in_two_factor_form">
                            @csrf
                            <!--begin::Icon-->
                            {{-- <div class="text-center mb-10">
                                <img alt="Logo" class="mh-125px"
                                    src="{{ asset('media/insightaccess.png')}}" />
                            </div> --}}
                            <!--end::Icon-->

                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 mb-3">
                                    Reset Password
                                </h1>
                                <!--end::Title-->

                                <!--begin::Sub-title-->
                                <div class="text-muted fw-semibold fs-5 mb-5">
                                    You have received the OTP on below email
                                </div>
                                <!--end::Sub-title-->
                                <!--begin::Mobile no-->
                                <div class="fw-bold text-gray-900 fs-3">{{ session('email') }}</div>
                                <!--end::Mobile no-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Section-->
                            <div class="mb-10"> 
                                
                                <!--begin::Input group--->
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input type="text" placeholder="Email" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" class="form-control bg-transparent" disabled/> 
                                        @error('email')
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                <div data-field="email" data-validator="notEmpty">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                        
                                    <!--end::Email-->
                                </div>
                                <!--begin::Input group--->
                                <div class="fv-row mb-8">
                                    <!--begin::Otp-->
                                    <input type="text" placeholder="Enter OTP" name="otp" value="{{ old('otp') }}" autocomplete="otp" class="form-control bg-transparent"/> 
                                        @error('otp')
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                <div data-field="otp" data-validator="notEmpty">
                                                    {{ $message }}
                                                </div>
                                            </div>
                                        @enderror
                                        
                                    <!--end::otp-->
                                </div>

                                <!--begin::Input group-->
                                <div class="fv-row mb-8" data-kt-password-meter="true">
                                    <!--begin::Wrapper-->
                                    <div class="mb-1">
                                        <!--begin::Input wrapper-->
                                        <div class="position-relative mb-3">
                                            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent"/>
                                                @error('password')
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        <div data-field="password" data-validator="notEmpty">
                                                            {{ $message }}
                                                        </div>
                                                    </div>
                                                @enderror
                                        </div>
                                        <!--end::Input wrapper-->

                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Input group--->

                                <!--end::Input group--->
                                <div class="fv-row mb-8">
                                    <!--begin::Repeat Password-->
                                    <input placeholder="Confirm Password" name="password_confirmation"
                                        type="password" autocomplete="off" class="form-control bg-transparent" />
                                    <!--end::Repeat Password-->
                                </div>
                            <!--end::Input group--->
                            </div>
                            <!--end::Section-->

                            <!--begin::Submit-->
                            <div class="d-flex flex-center">
                                <button type="submit" id="kt_sing_in_two_factor_submit"
                                    class="btn btn-lg btn-primary fw-bold">
                                    <span class="indicator-label">
                                        Submit
                                    </span>
                                    <span class="indicator-progress">
                                        Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                            <!--end::Submit-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Notice-->
                        {{-- <div class="text-center fw-semibold fs-5">
                            <span class="text-muted me-1">Didn’t get the code ?</span>

                            <a href="{{ route('auth.otp.resend') }}" class="link-primary fs-5 me-1">Resend</a>

                            <span class="text-muted me-1">or</span>

                            <a href="#" class="link-primary fs-5">Call Us</a>
                        </div> --}}
                        <!--end::Notice-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Footer-->
                    <div class="w-lg-500px d-flex flex-stack">

                        <!--begin::Links-->
                        {{-- <div class="d-flex fw-semibold text-primary fs-base gap-5">
                            <a href="../../../pages/team.html" target="_blank">Terms</a>

                            <a href="../../../pages/pricing/column.html" target="_blank">Plans</a>

                            <a href="../../../pages/contact.html" target="_blank">Contact Us</a>
                        </div> --}}
                        <!--end::Links-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Body-->
    </div>
@endsection
<!--end::Authentication - Two-factor-->
@section('scripts')
    
@endsection