@extends('auth.layouts.app')

@section('styles')
    <style>
        .onboarding-container {
            display: flex;
            justify-content: center;
        }

        .onboarding-card {
            width: 100%;
            max-width: 1264px;
            padding: 48px;
            border-radius: 8px;
            border: 1px solid #ECF0F3;
            background: #FFF;
            margin-top: 36px;
            height: fit-content;
        }

        .onboarding-header {
            height: 74px !important;
            box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.03) !important;

        }

        .onboarding-logo {
            height: 40px;
        }

        .onboarding-title {
            color: #2E2F38;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin-bottom: 24px;
            text-align: center;
        }

        .steps-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 30px;
        }

        .step-card {
            transition: all 0.3s ease;
            display: flex;
            padding: 48px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 16px;
            flex: 1 0 0;
            align-self: stretch;
            border-radius: 8px;
            border: 1px dashed #C8CFD9;
            height: fit-content;
        }

        .step-card.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f9f9f9;
        }

        .step-card:not(.disabled):hover {
            border-color: #F7941C;
        }

        .step-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step-icon svg {
            width: 40px;
            height: 40px;
            color: #78829D;
        }

        .step-number {
            color: #99A1B7;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            margin-bottom: 4px;
            text-align: center;
        }

        .step-title {
            color: #2E2F38;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
            margin-bottom: 4px;
            text-align: center;
        }

        .step-description {
            color: #727790;
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .step-button {
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            display: flex;
            height: 48px;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            border-radius: 4px;
            background: #fff;
            font-size: 16px;
            font-weight: 500;
            line-height: 24px;
            border: 1px solid #F7941C;
            color: #F7941C;
        }

        .step-button:hover, .step-button.completed {
            background: #F7941C;
            color: #fff;
            border: 1px solid #F7941C;
        }

        .step-button.disabled {
            background: #DDE2E8;
            border: 1px solid #C8CFD9;
            color: #99A1B7;
            cursor: not-allowed;
            pointer-events: none;
        }

        .footer-text {
            color: #99A1B7;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            height: 55px;
            align-items: center;
            background: #fff;
        }

        .step-card.completed {
            border: solid 1px #29BE49;
        }

        .icon-grey {
            display: flex;
            width: 48px;
            height: 48px;
            padding: 12px;
            justify-content: center;
            align-items: center;
            border-radius: 100px;
            background-color: #F5F7F8;
            color: #99A1B7;
            margin: auto;
        }

        .icon-grey.green {
            background-color: #F1FCF2;
            color: #19622A;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar onboarding-header">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div>
                <img src="{{ asset('images/insight-access-logo.png') }}" alt="InsightAccess" class="onboarding-logo"
                    onerror="this.style.display='none'">
            </div>
        </div>
    </div>
    <div class="onboarding-container h-100">
        <div class="onboarding-card">
            {{-- <iconify-icon icon="lucide:layout" class="icon-grey" width="20" height="20"></iconify-icon> --}}
            <div class="icon-grey">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <path
                        d="M7.41667 20.75V7.41667M0.75 7.41667H20.75M2.97222 0.75H18.5278C19.7551 0.75 20.75 1.74492 20.75 2.97222V18.5278C20.75 19.7551 19.7551 20.75 18.5278 20.75H2.97222C1.74492 20.75 0.75 19.7551 0.75 18.5278V2.97222C0.75 1.74492 1.74492 0.75 2.97222 0.75Z"
                        stroke="#99A1B7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <h1 class="onboarding-title">Begin Your InsightHub Journey</h1>
            <div class="steps-container">
                <!-- Step 1: Add Your Personal Details -->
                <div class="step-card {{ $step_1_completed ? 'completed' : '' }}">
                    @if ($step_1_completed)
                        <div class="icon-grey green mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="18" viewBox="0 0 24 18"
                                fill="none">
                                <path
                                    d="M22.7734 0.0126953C23.0894 0.00775424 23.3704 0.12827 23.6172 0.375C23.864 0.621845 23.9872 0.904535 23.9873 1.22363C23.9873 1.54315 23.8641 1.8263 23.6172 2.07324L9.07617 16.6396C8.78831 16.9271 8.45324 17.0702 8.07031 17.0703C7.68718 17.0703 7.35146 16.9272 7.06348 16.6396L0.362305 9.93848C0.126025 9.70193 0.00956277 9.42138 0.0126953 9.09668C0.0156062 8.77225 0.139796 8.48618 0.386719 8.23926C0.633628 7.9924 0.917135 7.87012 1.23633 7.87012C1.5555 7.87021 1.83822 7.99271 2.08496 8.23926L8.06055 14.2402L8.07031 14.249L21.9443 0.375C22.1808 0.138381 22.457 0.0177221 22.7734 0.0126953Z"
                                    fill="#19622A" stroke="#19622A" stroke-width="0.025" />
                            </svg>
                        </div>
                    @else
                        <div class="icon-grey mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22"
                                fill="none">
                                <path
                                    d="M16.3056 20.75V2.97222C16.3056 2.38285 16.0714 1.81762 15.6547 1.40087C15.2379 0.984126 14.6727 0.75 14.0833 0.75H9.63889C9.04952 0.75 8.48429 0.984126 8.06754 1.40087C7.65079 1.81762 7.41667 2.38285 7.41667 2.97222V20.75M2.97222 5.19444H20.75C21.9773 5.19444 22.9722 6.18937 22.9722 7.41667V18.5278C22.9722 19.7551 21.9773 20.75 20.75 20.75H2.97222C1.74492 20.75 0.75 19.7551 0.75 18.5278V7.41667C0.75 6.18937 1.74492 5.19444 2.97222 5.19444Z"
                                    stroke="#99A1B7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    @endif
                    <div>
                        <div class="step-number">STEP 1</div>
                        <h3 class="step-title">Add Your Personal Details</h3>
                        <p class="step-description mb-0">
                            @if ($step_1_completed)
                                Success! Personal information has been set up. You can manage it anytime under Your Profile.
                            @else
                                Fill in your personal information to complete your employee profile and ensure accurate
                                company
                                records.
                            @endif
                        </p>
                    </div>
                    @if ($step_1_completed)
                        <a href="{{ route('employee.about.me') }}" class="step-button completed">
                            Edit Your Personal Details

                        </a>
                    @else
                        <a href="{{ route('employee.about.me') }}" class="step-button">
                            Add Your Personal Details
                        </a>
                    @endif
                </div>

                <!-- Step 2: Take Your Psychometric Assessment -->
                <div class="step-card {{ $step_2_completed ? 'completed' : ($step_1_completed ? '' : 'disabled') }}">
                    @if ($step_2_completed)
                        <div class="completed-badge">
                            <div class="icon-grey green mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="18" viewBox="0 0 24 18"
                                    fill="none">
                                    <path
                                        d="M22.7734 0.0126953C23.0894 0.00775424 23.3704 0.12827 23.6172 0.375C23.864 0.621845 23.9872 0.904535 23.9873 1.22363C23.9873 1.54315 23.8641 1.8263 23.6172 2.07324L9.07617 16.6396C8.78831 16.9271 8.45324 17.0702 8.07031 17.0703C7.68718 17.0703 7.35146 16.9272 7.06348 16.6396L0.362305 9.93848C0.126025 9.70193 0.00956277 9.42138 0.0126953 9.09668C0.0156062 8.77225 0.139796 8.48618 0.386719 8.23926C0.633628 7.9924 0.917135 7.87012 1.23633 7.87012C1.5555 7.87021 1.83822 7.99271 2.08496 8.23926L8.06055 14.2402L8.07031 14.249L21.9443 0.375C22.1808 0.138381 22.457 0.0177221 22.7734 0.0126953Z"
                                        fill="#19622A" stroke="#19622A" stroke-width="0.025" />
                                </svg>
                            </div>
                            Completed
                        </div>
                    @endif
                    <div class="icon-grey mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="30" viewBox="0 0 24 30"
                            fill="none">
                            <path
                                d="M14.75 0.75H3.55C2.80739 0.75 2.0952 1.045 1.5701 1.5701C1.045 2.0952 0.75 2.80739 0.75 3.55V25.95C0.75 26.6926 1.045 27.4048 1.5701 27.9299C2.0952 28.455 2.80739 28.75 3.55 28.75H20.35C21.0926 28.75 21.8048 28.455 22.3299 27.9299C22.855 27.4048 23.15 26.6926 23.15 25.95V9.15M14.75 0.75L23.15 9.15M14.75 0.75V9.15H23.15M17.55 21.75H6.35M17.55 16.15H6.35M9.15 10.55H6.35"
                                stroke="#99A1B7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <div class="step-number">STEP 2</div>
                        <h3 class="step-title">Take Your Psychometric Assessment</h3>
                        <p class="step-description mb-0">
                            Complete this assessment to help us understand your strengths, preferences, and work style.
                        </p>
                    </div>
                    @if ($step_2_completed)
                        <button class="step-button completed mb-0">
                            Assessment Completed
                            <svg class="checkmark-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </button>
                    @elseif($step_1_completed)
                        <a href="/dashboard" class="step-button">
                            Take Assessment
                        </a>
                    @else
                        <button class="step-button disabled">
                            Complete Step 1 to Unlock
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="footer-text container-xxl app-container">
            <span>© {{ date('Y') }} CXS Analytics</span><span>Version: 2.0.1.4</span>
        </div>
    </div>
@endsection
