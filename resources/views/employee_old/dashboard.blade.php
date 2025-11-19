@extends('employee.layout.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .row>* {
        flex-shrink: 0;
        width: 100%;
        max-width: 100%;
        padding-right: calc(var(--bs-gutter-x)*0.5);
        padding-left: calc(var(--bs-gutter-x)*0.5);
        margin-top: var(--bs-gutter-y);
    }

    .col {
        flex: 1 0;
    }

    .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(var(--bs-gutter-y)*-1);
        margin-right: calc(var(--bs-gutter-x)*-0.5);
        margin-left: calc(var(--bs-gutter-x)*-0.5);
    }

    .row {
        margin-left: 0 !important;
        padding: 0;
    }

    .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        flex-wrap: wrap;
        flex-shrink: 0;
        width: 100%;
        max-width: 100%;
    }

    .row {
        display: flex;
    }

    body {
        margin: 0;
        font-family: var(--bs-body-font-family);
        font-size: var(--bs-body-font-size);
        font-weight: var(--bs-body-font-weight);
        line-height: var(--bs-body-line-height);
        color: var(--bs-body-color);
        text-align: var(--bs-body-text-align);
        background-color: var(--bs-body-bg);
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent;
    }

    html {
        height: 100%;
    }

    :root {
        --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        --bs-body-font-family: var(--bs-font-sans-serif);
        --bs-body-font-size: 1rem;
        --bs-body-font-weight: 400;
        --bs-body-line-height: 1.5;
        --bs-body-color: #212529;
        --bs-body-bg: #fff;
        --bs-border-radius-xxl: 2rem;
        --bs-border-radius-2xl: var(--bs-border-radius-xxl);
    }

    @media (prefers-reduced-motion: no-preference) {
        :root {
            scroll-behavior: smooth;
        }
    }

    :root {
        --toastify-color-info: #3498db;
        --toastify-color-success: #07bc0c;
        --toastify-color-warning: #f1c40f;
        --toastify-color-error: #e74c3c;
        --toastify-icon-color-info: var(--toastify-color-info);
        --toastify-icon-color-success: var(--toastify-color-success);
        --toastify-icon-color-warning: var(--toastify-color-warning);
        --toastify-icon-color-error: var(--toastify-color-error);
        --toastify-color-progress-info: var(--toastify-color-info);
        --toastify-color-progress-success: var(--toastify-color-success);
        --toastify-color-progress-warning: var(--toastify-color-warning);
        --toastify-color-progress-error: var(--toastify-color-error);
    }

    :root {
        --PhoneInput-color--focus: #03b2cb;
        --PhoneInputCountrySelect-marginRight: 0.35em;
        --PhoneInputCountrySelectArrow-marginLeft: var(--PhoneInputCountrySelect-marginRight);
        --PhoneInputCountrySelectArrow-color--focus: var(--PhoneInput-color--focus);
        --PhoneInputCountryFlag-borderColor--focus: var(--PhoneInput-color--focus);
    }

    .kVRoJR {
        background: rgb(255, 255, 255);
        /* box-shadow: rgba(13, 10, 44, 0.08) 0px 2px 6px; */
        border-radius: 20px;
        padding: 20px;
        overflow: hidden;
    }

    *,
    :after,
    :before {
        box-sizing: border-box;
    }

    :-webkit-scrollbar {
        width: 0;
        background: transparent;
    }

    .cpYWJO {
        border-bottom: 1px solid rgb(229, 229, 239);
        margin-bottom: 15px;
    }

    .slide-wrapper {
        position: relative;
    }

    .d-flex {
        display: flex !important;
    }

    .justify-content-between {
        justify-content: space-between !important;
    }

    .align-items-center {
        align-items: center !important;
    }

    .pb-2 {
        padding-bottom: .5rem !important;
    }

    .chBOqA {
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        flex-direction: row;
    }

    label {
        display: inline-block;
    }

    label {

        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 22px;
        margin: 5px 0 15px 10px;
    }

    .kjEWrW {

        font-style: normal;
        font-weight: 500;
        font-size: 14px;
        line-height: 19px;
        color: #1F5476;
        display: block;
        float: left;
        width: auto;
        padding: 10px 0px;
        cursor: pointer;
    }

    .iOwoMK {
        cursor: default !important;
    }

    .css-exkjcx {
        border-radius: 12px;
        box-sizing: content-box;
        display: inline-block;
        position: relative;
        cursor: pointer;
        touch-action: none;
        color: rgb(25, 118, 210);
        -webkit-tap-highlight-color: transparent;
        height: 4px;
        width: 100%;
        padding: 13px 0px;
    }

    .koVAaC {
        cursor: default !important;
    }

    .cNqbNx {
        font-style: normal;
        font-weight: 700;
        font-size: 18px;
        line-height: 24px;
        color: rgb(30, 27, 57);
    }

    .css-b04pc9 {
        display: block;
        position: absolute;
        border-radius: inherit;
        background-color: currentcolor;
        opacity: 0.38;
        width: 100%;
        height: inherit;
        top: 50%;
        transform: translateY(-50%);
    }

    .iOwoMK .MuiSlider-rail {
        background: rgb(250, 250, 250);
        border: 0.2px solid rgb(255, 255, 255);
        box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 1px, rgba(0, 0, 0, 0.18) 0px 1px 1px inset;
        border-radius: 7px;
    }

    .css-1t2bqnt {
        display: block;
        position: absolute;
        border-radius: inherit;
        border: 1px solid currentcolor;
        background-color: currentcolor;
        transition: left 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, width 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, bottom 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, height 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        height: inherit;
        top: 50%;
        transform: translateY(-50%);
    }

    .iOwoMK .MuiSlider-track {
        background: rgb(84, 130, 53);
        border: 0.2px solid rgb(255, 255, 255);
        box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 1px, rgba(0, 0, 0, 0.18) 0px 1px 1px inset;
        border-radius: 7px;
    }

    .css-1s3fy7y {
        position: absolute;
        width: 20px;
        height: 20px;
        box-sizing: border-box;
        border-radius: 50%;
        outline: 0px;
        background-color: currentcolor;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        transition: box-shadow 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, left 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, bottom 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .iOwoMK .MuiSlider-thumb {
        color: rgb(84, 130, 53);
        box-shadow: rgba(180, 104, 141, 0.9) 0px 5px 16px;
    }

    .css-1s3fy7y:before {
        position: absolute;
        content: "";
        border-radius: inherit;
        width: 100%;
        height: 100%;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 1px -2px, rgba(0, 0, 0, 0.14) 0px 2px 2px 0px, rgba(0, 0, 0, 0.12) 0px 1px 5px 0px;
    }

    .css-1s3fy7y:after {
        position: absolute;
        content: "";
        border-radius: 50%;
        width: 42px;
        height: 42px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .css-1s3fy7y:hover {
        box-shadow: rgba(25, 118, 210, 0.16) 0px 0px 0px 8px;
    }

    .iOwoMK .MuiSlider-thumb:hover {
        box-shadow: rgba(180, 104, 141, 0.9) 0px 5px 16px;
        cursor: default !important;
    }

    .koVAaC .MuiSlider-rail {
        background: rgb(250, 250, 250);
        border: 0.2px solid rgb(255, 255, 255);
        box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 1px, rgba(0, 0, 0, 0.18) 0px 1px 1px inset;
        border-radius: 7px;
    }

    .koVAaC .MuiSlider-track {
        background: rgb(255, 152, 0);
        border: 0.2px solid rgb(255, 255, 255);
        box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 1px, rgba(0, 0, 0, 0.18) 0px 1px 1px inset;
        border-radius: 7px;
    }

    .koVAaC .MuiSlider-thumb {
        color: rgb(255, 152, 0);
        box-shadow: rgba(180, 104, 141, 0.9) 0px 5px 16px;
    }

    .koVAaC .MuiSlider-thumb:hover {
        box-shadow: rgba(180, 104, 141, 0.9) 0px 5px 16px;
        cursor: default !important;
    }

    .koVAaC .MuiSlider-thumb.Mui-focusVisible,
    .koVAaC .MuiSlider-thumb:hover {
        box-shadow: rgba(180, 104, 141, 0.9) 0px 5px 16px;
        cursor: default !important;
    }

    .iOwoMK .MuiSlider-thumb.Mui-focusVisible,
    .iOwoMK .MuiSlider-thumb:hover {
        box-shadow: rgba(180, 104, 141, 0.9) 0px 5px 16px;
        cursor: default !important;
    }

    input {
        margin: 0;
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }

    .css-1b90qqk {
        z-index: 1;
        white-space: nowrap;
        font-family: Roboto, Helvetica, Arial, sans-serif;
        font-weight: 500;
        font-size: 0.875rem;
        line-height: 1.43;
        letter-spacing: 0.01071em;
        transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        transform: translateY(-100%) scale(0);
        position: absolute;
        background-color: rgb(117, 117, 117);
        border-radius: 2px;
        color: rgb(255, 255, 255);
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding: 0.25rem 0.75rem;
        top: -10px;
        transform-origin: center bottom;
    }

    .iOwoMK .MuiSlider-valueLabel {
        background: rgb(208, 76, 141);
    }

    .css-1b90qqk:before {
        position: absolute;
        content: "";
        width: 8px;
        height: 8px;
        transform: translate(-50%, 50%) rotate(45deg);
        background-color: inherit;
        bottom: 0px;
        left: 50%;
    }

    .koVAaC .MuiSlider-valueLabel {
        background: rgb(208, 76, 141);
    }


    /* These were inline style tags. Uses id+class to override almost everything */
    #style-nmg2v.style-nmg2v {
        left: 0%;
        width: 75%;
    }

    #style-rzweM.style-rzweM {
        left: 75%;
    }

    #style-vso2F.style-vso2F {
        border: 0px;
        clip: rect(0px, 0px, 0px, 0px);
        height: 100%;
        margin: -1px;
        overflow: hidden;
        padding: 0px;
        position: absolute;
        white-space: nowrap;
        width: 100%;
        direction: ltr;
    }

    #style-NR2lU.style-NR2lU {
        left: 0%;
        width: 52%;
    }

    #style-qRW3o.style-qRW3o {
        left: 52%;
    }

    #style-trZLR.style-trZLR {
        border: 0px;
        clip: rect(0px, 0px, 0px, 0px);
        height: 100%;
        margin: -1px;
        overflow: hidden;
        padding: 0px;
        position: absolute;
        white-space: nowrap;
        width: 100%;
        direction: ltr;
    }

    #style-j1bYT.style-j1bYT {
        left: 0%;
        width: 57%;
    }

    #style-7NGx7.style-7NGx7 {
        left: 57%;
    }

    #style-2qJO7.style-2qJO7 {
        border: 0px;
        clip: rect(0px, 0px, 0px, 0px);
        height: 100%;
        margin: -1px;
        overflow: hidden;
        padding: 0px;
        position: absolute;
        white-space: nowrap;
        width: 100%;
        direction: ltr;
    }

    #style-qjq4j.style-qjq4j {
        left: 0%;
        width: 52%;
    }

    #style-ByYp8.style-ByYp8 {
        left: 52%;
    }

    #style-jxLts.style-jxLts {
        border: 0px;
        clip: rect(0px, 0px, 0px, 0px);
        height: 100%;
        margin: -1px;
        overflow: hidden;
        padding: 0px;
        position: absolute;
        white-space: nowrap;
        width: 100%;
        direction: ltr;
    }

    #style-PLKoS.style-PLKoS {
        left: 0%;
        width: 58%;
    }

    #style-grtvj.style-grtvj {
        left: 58%;
    }

    #style-dpcSO.style-dpcSO {
        border: 0px;
        clip: rect(0px, 0px, 0px, 0px);
        height: 100%;
        margin: -1px;
        overflow: hidden;
        padding: 0px;
        position: absolute;
        white-space: nowrap;
        width: 100%;
        direction: ltr;
    }

    #style-ZO5hX.style-ZO5hX {
        left: 0%;
        width: 68%;
    }

    #style-UPheo.style-UPheo {
        left: 68%;
    }

    #style-maPV9.style-maPV9 {
        border: 0px;
        clip: rect(0px, 0px, 0px, 0px);
        height: 100%;
        margin: -1px;
        overflow: hidden;
        padding: 0px;
        position: absolute;
        white-space: nowrap;
        width: 100%;
        direction: ltr;
    }

    #style-CEi5B.style-CEi5B {
        left: 0%;
        width: 55%;
    }

    #style-ME1Vl.style-ME1Vl {
        left: 55%;
    }

    #style-iG6Tw.style-iG6Tw {
        border: 0px;
        clip: rect(0px, 0px, 0px, 0px);
        height: 100%;
        margin: -1px;
        overflow: hidden;
        padding: 0px;
        position: absolute;
        white-space: nowrap;
        width: 100%;
        direction: ltr;
    }

    #style-e77To.style-e77To {
        left: 0%;
        width: 75%;
    }

    #style-Ob2x5.style-Ob2x5 {
        left: 75%;
    }

    #style-xftps.style-xftps {
        border: 0px;
        clip: rect(0px, 0px, 0px, 0px);
        height: 100%;
        margin: -1px;
        overflow: hidden;
        padding: 0px;
        position: absolute;
        white-space: nowrap;
        width: 100%;
        direction: ltr;
    }
</style>
<style>
    .container {
        width: 80%;
        max-width: 780px;
        margin: 20px auto;
    }
    .slider-legend_cognitive{
    width: 11%;
    text-align: center;
    font-size: 11px;
    border-radius: 28px;
    padding: 0px;
    color: white;
}

    .slider-container {
        display: flex;
        align-items: center;
        /* margin: 17px 0px; */
    }

    .slider-label {
        width: 20%;
        text-align: center;
        font-size: 14px;
    }

    .slider-track {
        width: 80%;
        position: relative;
        height: 30px;
        background: #f1f1f1;
        border-radius: 32px;
        margin: 26px 1%;
        max-width: 523px;
    }

    .slider-bar {
        position: absolute;
        top: 50%;
        left: 10%;
        right: 10%;
        height: 4px;
        background: #aaa;
        transform: translateY(-50%);
    }

    .slider-indicator {
        position: absolute;
        top: -20px;
        background: #fff;
        color: #333;
        padding: 2px 5px;
        font-size: 12px;
        border-bottom-right-radius: 50px;
        border-bottom-left-radius: 53px;
        border: 1px solid #aaa;
    }

    .emp_a,
    .emp_b {
        position: absolute;
        top: 1px;
        width: auto;
        height: auto;
        background-color: #005daf;
        border-radius: 50%;
        font-size: smaller;
        color: white;
        padding: 4px 7px;
        /* border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-top: 10px solid #00f; */
    }

    .emp_a {
        background-color: #0245A3;
        padding: 15px;
    }

    .emp_b {
        background-color: #1AB93B;

    }

    .slider-legend{
        width: 11%;
        text-align: center;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .slider-label {
            font-size: 12px;
        }

        .slider-indicator {
            font-size: 10px;
        }

        .emp_a,
        .emp_b {
            position: absolute;
            top: 1px;
            width: auto;
            height: auto;
            background-color: #005daf;
            border-radius: 50%;
            font-size: smaller;
            color: white;
            padding: 14px 14px;
        }

        .emp_a {
            background-color: #0245A3;

        }

        .emp_b {
            background-color: #1AB93B;

        }
        .slider-legend{
            width: 11%;
            text-align: center;
            font-size: 14px;
        }
    }
</style>
<div class="content-wrapper transition-all duration-150 xl:ltr:ml-[248px] xl:rtl:mr-[248px]" id="content_wrapper">
    <div class="page-content">
        <div id="content_layout">




            <!-- BEGIN: Breadcrumb -->
            <div class="mb-5">
                <ul class="m-0 p-0 list-none">
                    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                        <a href="/dashboard">
                            <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                            <iconify-icon icon="heroicons-outline:chevron-right"
                                class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                        </a>
                    </li>
                    <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                        Employee
                        <iconify-icon icon="heroicons-outline:chevron-right"
                            class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
                    </li>
                    <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                        Dashboard</li>
                </ul>
            </div>
            <!-- END: BreadCrumb -->
            <div class="space-y-6">
                <div class="card p-6">
                    <div
                        class="grid xl:grid-cols-4 lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-5 place-content-center">
                        <div class="flex space-x-4 h-full items-center rtl:space-x-reverse">
                            <div class="flex-none">
                                <div class="h-20 w-20 rounded-full">
                                    {{-- {{ dd(auth()->user()->profile_picture) }} --}}
                                    @if (auth()->user()->profile_picture)
                                    <img src="{{ asset(auth()->user()->profile_picture) }}" onerror="this.src='{{ asset('admin/media/avatars/default-avatar.png') }}'" style="border-radius: 50%; border: 3px solid #ce9e20; " alt=""
                                    class="w-full h-full">
                                    @else
                                    <img src="{{ asset('admin/media/avatars/default-avatar.png') }}" alt=""
                                        class="w-full h-full">
                                        @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-xl font-medium mb-2">
                                    <span class="block font-light" id="greeting"></span>
                                    <span class="block">{{auth()->user()->name }}</span>
                                </h4>
                                <p class="text-sm dark:text-slate-300">Welcome to Chrome</p>
                            </div>
                        </div>

                        <!-- BEGIN: Group Chart3 -->

                        <a  data-tippy-content="Click to View"
                        data-tippy-theme="dark"
                            class="toolTip onTop bg-info-500 rounded-md p-4 bg-opacity-[0.15] dark:bg-opacity-50 text-center" style="
                          background: #CE9E20;" @if(auth()->user()->is_personality_motivation_completed == 1)
                            href="/quiz/five-factor/results"
                            @else
                            href="/quiz/five-factor/intro"
                            @endif >
                            <div class="bg-slate-50 dark:bg-slate-900 rounded p-4">
                                <div
                                    class="dark:text-slate-400 font-medium mb-1 text-[15px] text-left text-slate-600 text-sm">
                                    Personality & Motivation
                                </div>
                                {{-- <div class="text-slate-900 dark:text-white text-lg font-medium">
                                    $34,564
                                </div> --}}
                                <div class="ml-auto ">
                                    <div class="flex-1">
                                        <div class="flex justify-between text-sm font-normal dark:text-slate-300 mb-3">
                                            <span>Progress</span>
                                            <span
                                                class="font-normal">@if(auth()->user()->is_personality_motivation_completed
                                                == 1)
                                                100%
                                                @else
                                                0%
                                                @endif

                                            </span>
                                        </div>
                                        <div class="w-full bg-slate-200 h-2 rounded-xl overflow-hidden">
                                            @if(auth()->user()->is_personality_motivation_completed == 1)
                                            <div class="progress-bar  bg-info-500 h-full rounded-xl"
                                                style="width: 10%;  background: #CE9E20;"></div>
                                            @else
                                            <div class="progress-bar2  bg-info-500 h-full rounded-xl"
                                                style="width: 100%;  background: #CE9E20;"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a data-tippy-content="Click to View"
                        data-tippy-theme="dark"
                            class="toolTip onTop bg-warning-500 rounded-md p-4 bg-opacity-[0.15] dark:bg-opacity-50 text-center"
                            style=" background: #1AB93B;" @if(auth()->user()->is_work_interest_completed == 1)
                            href="/quiz/interest-riasec/results"
                            @else
                            href="/quiz/interest-riasec/intro"
                            @endif
                            >
                            <div class="bg-slate-50 dark:bg-slate-900 rounded p-4">
                                <div
                                    class="dark:text-slate-400 font-medium mb-1 text-[15px] text-left text-slate-600 text-sm">
                                    Work Interest
                                </div>

                                <div class="ml-auto ">
                                    <div class="flex-1">
                                        <div class="flex justify-between text-sm font-normal dark:text-slate-300 mb-3">
                                            <span>Progress</span>
                                            <span class="font-normal">@if(auth()->user()->is_work_interest_completed ==
                                                1)
                                                100%
                                                @else
                                                0%
                                                @endif

                                            </span>
                                        </div>
                                        <div class="w-full bg-slate-200 h-2 rounded-xl overflow-hidden">
                                            @if(auth()->user()->is_work_interest_completed == 1)
                                            <div class="progress-bar  bg-info-500 h-full rounded-xl"
                                                style="width: 10%;  background: #1AB93B;"></div>
                                            @else
                                            <div class="progress-bar2  bg-info-500 h-full rounded-xl"
                                                style="width: 100%;  background: #1AB93B;"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a data-tippy-content="Click to View"
                        data-tippy-theme="dark"
                            class="toolTip onTop bg-primary-500 rounded-md p-4 bg-opacity-[0.15] dark:bg-opacity-50 text-center"
                            style=" background: #1F5476;" @if(auth()->user()->is_cognitive_ability_completed == 1)
                            href="/quiz/cognitive-ability/results"
                            @else
                            href="/quiz/cognitive-ability/intro"
                            @endif>
                            <div class="bg-slate-50 dark:bg-slate-900 rounded p-4">
                                <div
                                    class="dark:text-slate-400 font-medium mb-1 text-[15px] text-left text-slate-600 text-sm">
                                    Cognitive Ability
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">

                                </div>
                                <div class="ml-auto ">
                                    <div class="flex-1">
                                        <div class="flex justify-between text-sm font-normal dark:text-slate-300 mb-3">
                                            <span>Progress</span>
                                            <span class="font-normal">@if(auth()->user()->is_cognitive_ability_completed
                                                == 1)
                                                100%
                                                @else
                                                0%
                                                @endif

                                            </span>
                                        </div>
                                        <div class="w-full bg-slate-200 h-2 rounded-xl overflow-hidden">
                                            @if(auth()->user()->is_cognitive_ability_completed == 1)
                                            <div class="progress-bar  bg-info-500 h-full rounded-xl"
                                                style="width: 10%; background: #1F5476;"></div>
                                            @else
                                            <div class="progress-bar2  bg-info-500 h-full rounded-xl"
                                                style="width: 100%; background: #1F5476;"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>


                        <!-- END: Group Chart3 -->
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6">

                    <div class="lg:col-span-12 col-span-12">
                        <div class="card h-full">
                            <header class="card-header">
                                <h4 class="card-title">Summary of Assessment Results</h4>
                            </header>
                            <div class="card-body p-6">
                                <div class="grid grid-cols-12 gap-6">

                                    <div class="lg:col-span-6 col-span-12">
                                        <div class="card h-full shadow-base2">
                                            <header class="card-header">
                                                <h4 class="card-title">Personality & Motivation</h4>
                                            </header>
                                            <div class="card-body p-6">
                                                @if(auth()->user()->is_personality_motivation_completed
                                                == 1)

                                                {{-- <div id="chart"></div> --}}
                                                    <div class="">
                                                        <div class="slider-container">
                                                            <div class="slider-label">Pragmatism</div>
                                                            <div class="slider-track">
                                                                <div class="emp_a" @if(isset($oceanSelfResult['Openness to Experience'])&&($oceanSelfResult['Openness to Experience'] / 5)*100 == 100) style="left: 93%;"@else
                                                                    style="left: {{ ($oceanSelfResult['Openness to Experience'] / 5)*100 ?? 0 }}%;"@endif></div>
                                                            </div>
                                                            <div class="slider-label">Openness</div>
                                                        </div>
                                                        <div class="slider-container">
                                                            <div class="slider-label">Low Self Control</div>
                                                            <div class="slider-track">
                                                                <div class="emp_a" @if(isset($oceanSelfResult['Conscientiousness'])&&($oceanSelfResult['Conscientiousness'] / 5)*100 == 100) style="left: 93%;"@else
                                                                style="left: {{ ($oceanSelfResult['Conscientiousness']/ 5)*100 ?? 0 }}%;"@endif></div>

                                                            </div>
                                                            <div class="slider-label">High Self Control</div>
                                                        </div>
                                                        <div class="slider-container">
                                                            <div class="slider-label">Introversion</div>
                                                            <div class="slider-track">
                                                                <div class="emp_a" @if(isset($oceanSelfResult['Extraversion'])&&($oceanSelfResult['Extraversion'] / 5)*100 == 100) style="left: 93%;"@else
                                                                style="left: {{($oceanSelfResult['Extraversion'] / 5)*100 ?? 0 }}%;"@endif></div>
                                                            </div>
                                                            <div class="slider-label">Extraversion</div>
                                                        </div>
                                                        <div class="slider-container">
                                                            <div class="slider-label">Independence</div>
                                                            <div class="slider-track">
                                                                <div class="emp_a" @if(isset($oceanSelfResult['Agreeableness'])&&($oceanSelfResult['Agreeableness'] / 5)*100 == 100) style="left: 93%;"@else
                                                                style="left: {{ ($oceanSelfResult['Agreeableness'] / 5)*100 ?? 0 }}%;"@endif></div>

                                                            </div>
                                                            <div class="slider-label">Agreebleness</div>
                                                        </div>
                                                        <div class="slider-container">
                                                            <div class="slider-label">High Anxiety</div>
                                                            <div class="slider-track">
                                                                <div class="emp_a" @if(isset($oceanSelfResult['Emotional Stability'])&&($oceanSelfResult['Emotional Stability'] / 5)*100 == 100) style="left: 93%;"@else
                                                                style="left: {{ ($oceanSelfResult['Emotional Stability'] / 5)*100 ?? 0 }}%;"@endif></div>
                                                            </div>
                                                            <div class="slider-label">Low Anxiety</div>
                                                        </div>
                                                    </div>


                                                <div>
                                                 {{-- <a data-bs-toggle="modal" data-bs-target="#large_modal" class="mb-3 btn btn-success  bg_secondary_green float-right toolTip onTop "  data-tippy-content="View More" data-tippy-theme="dark" style="padding: 6px 10px;padding-bottom: 0px;"><iconify-icon icon="ant-design:fund-view-outlined" class="text-2xl"></iconify-icon></a> --}}
                                                </div>
                                                @else
                                                <div class="container text-center bg_secondary_green p-5" style="
                                                border-radius: 16px;">
                                                    <iconify-icon icon="wpf:statistics" class="text-[2.23rem]"></iconify-icon>
                                                    <h4>Data Not Available </h4>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="lg:col-span-6 col-span-12">
                                        <div class="card h-full shadow-base2">
                                            <header class="card-header">
                                                <h4 class="card-title">Work Interest</h4>
                                            </header>
                                            <div class="card-body p-6">
                                                @if(auth()->user()->is_work_interest_completed
                                                == 1)
                                                {{-- <div id="riasec"
                                                    class="align-items-center col-lg-3 d-flex justify-content-center">
                                                </div> --}}

                                                <div class="">

                                                    <div class="slider-container">
                                                        <div class="slider-label">Realistic</div>


                                                        <div class="slider-track">
                                                            <div class="d-flex justify-between" style="top: -28px; position: relative;">
                                                            <div class="slider-legend" style="
                                                            background: #ff4639f7;
                                                            border-radius: 28px;
                                                            padding: 0px;
                                                            color: white;
                                                        ">Low</div>
                                                            <div class="slider-legend" style="
                                                            background: #279d27;
                                                            border-radius: 28px;
                                                            color: white;
                                                        ">High</div>
                                                            </div>
                                                            <div class="emp_a" @if(isset($workInterestResult['Realistic'])&&($workInterestResult['Realistic']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workInterestResult['Realistic'] ?? 0 }}%;"@endif></div>

                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label">Investigative</div>
                                                        <div class="slider-track">
                                                            <div class="d-flex justify-between" style="top: -28px; position: relative;">
                                                                {{-- <div class="slider-legend" style="
                                                                background: #ff4639f7;
                                                                border-radius: 28px;
                                                                padding: 0px;
                                                                color: white;
                                                            ">Low</div>
                                                                <div class="slider-legend" style="
                                                                background: #279d27;
                                                                border-radius: 28px;
                                                                color: white;
                                                            ">High</div> --}}
                                                                </div>
                                                            <div class="emp_a" @if(isset($workInterestResult['Investigative'])&&($workInterestResult['Investigative']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workInterestResult['Investigative'] ?? 0 }}%;"@endif></div>

                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label">Artistic</div>
                                                        <div class="slider-track">
                                                            <div class="d-flex justify-between" style="top: -28px; position: relative;">
                                                                {{-- <div class="slider-legend" style="
                                                                background: #ff4639f7;
                                                                border-radius: 28px;
                                                                padding: 0px;
                                                                color: white;
                                                            ">Low</div>
                                                                <div class="slider-legend" style="
                                                                background: #279d27;
                                                                border-radius: 28px;
                                                                color: white;
                                                            ">High</div> --}}
                                                                </div>
                                                            <div class="emp_a" @if(isset($workInterestResult['Artistic'])&&($workInterestResult['Artistic']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workInterestResult['Artistic'] ?? 0 }}%;"@endif></div>

                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label">Social</div>
                                                        <div class="slider-track">
                                                            <div class="d-flex justify-between" style="top: -28px; position: relative;">
                                                                {{-- <div class="slider-legend" style="
                                                                background: #ff4639f7;
                                                                border-radius: 28px;
                                                                padding: 0px;
                                                                color: white;
                                                            ">Low</div>
                                                                <div class="slider-legend" style="
                                                                background: #279d27;
                                                                border-radius: 28px;
                                                                color: white;
                                                            ">High</div> --}}
                                                                </div>
                                                            <div class="emp_a" @if(isset($workInterestResult['Social'])&&($workInterestResult['Social']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workInterestResult['Social'] ?? 0 }}%;"@endif></div>

                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label">Enterprising</div>
                                                        <div class="slider-track">
                                                            <div class="d-flex justify-between" style="top: -28px; position: relative;">
                                                                {{-- <div class="slider-legend" style="
                                                                background: #ff4639f7;
                                                                border-radius: 28px;
                                                                padding: 0px;
                                                                color: white;
                                                            ">Low</div>
                                                                <div class="slider-legend" style="
                                                                background: #279d27;
                                                                border-radius: 28px;
                                                                color: white;
                                                            ">High</div> --}}
                                                                </div>
                                                            <div class="emp_a" @if(isset($workInterestResult['Enterprising'])&&($workInterestResult['Enterprising']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workInterestResult['Enterprising'] ?? 0 }}%;"@endif></div>

                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label">Conventional</div>
                                                        <div class="slider-track">
                                                            <div class="d-flex justify-between" style="top: -28px; position: relative;">
                                                                {{-- <div class="slider-legend" style="
                                                                background: #ff4639f7;
                                                                border-radius: 28px;
                                                                padding: 0px;
                                                                color: white;
                                                            ">Low</div>
                                                                <div class="slider-legend" style="
                                                                background: #279d27;
                                                                border-radius: 28px;
                                                                color: white;
                                                            ">High</div> --}}
                                                                </div>
                                                            <div class="emp_a" @if(isset($workInterestResult['Conventional'])&&($workInterestResult['Conventional']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workInterestResult['Conventional'] ?? 0 }}%;"@endif></div>

                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                </div>
                                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                                    <div class="accordion-item">
                                                      <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                        <button class="accordion-button nav-link block font-medium font-Inter text-sm leading-tight capitalize rounded-md  py-3 focus:outline-none focus:ring-0 color-black active" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                           Top 3 RIASEC - {{ $workInterestResult['top_3_riasec'] ?? '' }}
                                                        </button>
                                                      </h2>
                                                      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body">
                                                            {{ $workInterestResult['top_3_riasec_description'] ?? '' }}
                                                        </div>
                                                      </div>
                                                    </div>


                                                  </div>
                                                @else
                                                <div class="container text-center bg_secondary_green p-5" style="
                                                border-radius: 16px;">
                                                    <iconify-icon icon="wpf:statistics" class="text-[2.23rem]"></iconify-icon>
                                                    <h4>Data Not Available </h4>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="lg:col-span-6 col-span-12">
                                        <div class="card h-full shadow-base2">
                                            <header class="card-header">
                                                <h4 class="card-title">Talent Pillars</h4>

                                            </header>
                                            <div class="card-body p-6">
                                                {{-- {{ dd($workCompetencyResult) }} --}}
                                                @if(auth()->user()->is_personality_motivation_completed
                                                == 1)
                                                <div class="">
                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#criticalThinkingAccordion">Critical Thinking <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($workCompetencyResult['Critical Thinking'])&&($workCompetencyResult['Critical Thinking']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workCompetencyResult['Critical Thinking'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="criticalThinkingAccordion" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body  font13 text-slate-600">

                                                            Skilled in breaking down complex issues, using expertise well, and communicating effectively, especially in writing.
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#creativityAccordion">Creativity<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($workCompetencyResult['Creativity'])&&($workCompetencyResult['Creativity']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workCompetencyResult['Creativity'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="creativityAccordion" class="accordion-collapse collapse   font13 text-slate-600" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body  font13 text-slate-600">
                                                            Excels in generating new ideas, embraces learning, and drives change with creative and strategic thinking.
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#communicationAccordion">Communication<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($workCompetencyResult['Communication'])&&($workCompetencyResult['Communication']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workCompetencyResult['Communication'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="communicationAccordion" class="accordion-collapse collapse  color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body  font13 text-slate-600">
                                                            Strong in networking and influencing, communicates confidently and relates well to others.
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#leadershipAccordion">Leadership<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($workCompetencyResult['Leadership'])&&($workCompetencyResult['Leadership']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workCompetencyResult['Leadership'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="leadershipAccordion" class="accordion-collapse collapse  color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body  font13 text-slate-600">
                                                            Demonstrates strong leadership, proactively takes charge, and assumes responsibility.
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#teamworkAccordion">Teamwork<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($workCompetencyResult['Teamwork'])&&($workCompetencyResult['Teamwork']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workCompetencyResult['Teamwork'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="teamworkAccordion" class="accordion-collapse collapse  color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body  font13 text-slate-600">
                                                            Prioritizes team and client needs, works well with others, and aligns personal values with the organization.
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#adaptabilityAccordion">Adaptability<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($workCompetencyResult['Adaptability'])&&($workCompetencyResult['Adaptability']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workCompetencyResult['Adaptability'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="adaptabilityAccordion" class="accordion-collapse collapse  color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body  font13 text-slate-600">
                                                            Adapts to change, handles stress effectively, and recovers quickly from setbacks.
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#systematicPlanningAccordion">Systematic Planning<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($workCompetencyResult['Systematic Planning'])&&($workCompetencyResult['Systematic Planning']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workCompetencyResult['Systematic Planning'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="systematicPlanningAccordion" class="accordion-collapse collapse  color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body  font13 text-slate-600">
                                                            Plans and organizes work systematically, follows procedures, and focuses on providing quality service.
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#achievementOreientationAccordion">Achievement Orientation<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($workCompetencyResult['Achievement Orientation'])&&($workCompetencyResult['Achievement Orientation']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $workCompetencyResult['Achievement Orientation'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="achievementOreientationAccordion" class="accordion-collapse collapse  color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body  font13 text-slate-600">
                                                            Targets results, aligns work closely with outcomes, understands business essentials, and seeks personal growth and career development opportunities.
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="container text-center bg_secondary_green p-5" style="
                                                border-radius: 16px;">
                                                    <iconify-icon icon="wpf:statistics" class="text-[2.23rem]"></iconify-icon>
                                                    <h4>Data Not Available </h4>
                                                </div>
                                                @endif


                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        $level = 'Low';
                                        if($totalMarksForCognitive > 24) {
                                            $level = 'High';
                                        }
                                        elseif ($totalMarksForCognitive > 15 && $totalMarksForCognitive <= 24) {
                                            $level = 'Medium';
                                        } else {
                                            $level = 'Low';
                                        }
                                    @endphp

                                    <div class="lg:col-span-6 col-span-12">
                                        <div class="card h-full shadow-base2">
                                            <header class="card-header">
                                                <h4 class="card-title">Cognitive Ability</h4>
                                            </header>

                                            <div class="card-body p-6">
                                                @if(auth()->user()->is_cognitive_ability_completed
                                                == 1)
                                                <div id="donut"
                                                    class="align-items-center col-lg-3 d-flex justify-content-center" style="min-height: 267.3px;display: flex;align-items: center;justify-content: center;">
                                                </div>
                                                <div class="col-lg-5" style="align-items: center;display: flex;flex-direction: column;margin: auto;">
                                                    <h1 class="pricing-card-title text-3xl">
                                                        {{-- {{ ($totalCorrectForCognitive / 50)*100 }}%
                                                        <small class="text-body-secondary fw-light"> Correct
                                                           ({{$totalCorrectForCognitive}} / 50)
                                                        </small> --}}

                                                        {{$level ?? 'Low'}}
                                                    </h1>

                                                  </div>
                                                  <div class="mt-4">
                                                    <div class="slider-container">
                                                        <div class="slider-label">Quantitative Knowledge</div>
                                                        <div class="slider-track">
                                                            <div class="d-flex justify-between" style="top: -28px; position: relative;">
                                                                <div class="slider-legend_cognitive" style="
                                                                background: #ff4639f7;

                                                            ">L0</div>
                                                                <div class="slider-legend_cognitive" style="
                                                                background: #f3e95ff7;

                                                            ">L1</div>
                                                             <div class="slider-legend_cognitive" style="
                                                             background: #d3c611;

                                                         ">L2</div>
                                                                <div class="slider-legend_cognitive" style="
                                                                background: #279d27;

                                                            ">L3</div>
                                                                </div>
                                                            <div class="emp_a" @if(isset($cognitiveEmployeeAResult['Quantitative Knowledge'])&&($cognitiveEmployeeAResult['Quantitative Knowledge'] / 3) == 1) style="left: 93%;"@else
                                                                style="left: {{ ($cognitiveEmployeeAResult['Quantitative Knowledge'] / 3)*100 ?? 0 }}%;"@endif></div>


                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label">Comprehensive Knowledge</div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($cognitiveEmployeeAResult['Comprehension Knowledge'])&&($cognitiveEmployeeAResult['Comprehension Knowledge'] / 3) == 1) style="left: 93%;"@else
                                                                style="left: {{ ($cognitiveEmployeeAResult['Comprehension Knowledge'] / 3)*100 ?? 0 }}%;"@endif></div>
                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label">Visual Reasoning</div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($cognitiveEmployeeAResult['Visual Reasoning'])&&($cognitiveEmployeeAResult['Visual Reasoning'] / 3) == 1) style="left: 93%;"@else
                                                                style="left: {{ ($cognitiveEmployeeAResult['Visual Reasoning'] / 3)*100 ?? 0 }}%;"@endif></div>
                                                            </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                    <div class="slider-container">
                                                        <div class="slider-label">Fluid Reasoning</div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($cognitiveEmployeeAResult['Fluid Reasoning'])&&($cognitiveEmployeeAResult['Fluid Reasoning'] / 3) == 1) style="left: 93%;"@else
                                                                style="left: {{ ($cognitiveEmployeeAResult['Fluid Reasoning'] / 3)*100 ?? 0 }}%;"@endif></div>
                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                </div>

                                                @else
                                                <div class="container text-center bg_secondary_green p-5" style="
                                                border-radius: 16px;">
                                                    <iconify-icon icon="wpf:statistics" class="text-[2.23rem]"></iconify-icon>
                                                    <h4>Data Not Available </h4>
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    {{-- Learning & Development Plan  --}}
                                    @php
                                        $learningStyle = [];
                                        $learningStyle['Visual'] = 0;
                                        $learningStyle['Aural'] = 0;
                                        $learningStyle['Reading & Writing'] = 0;
                                        $learningStyle['Kinesthetic'] = 0;

                                        $learningStyle['Visual'] = (max($oceanSelfResult['Openness to Experience'],$oceanSelfResult['Agreeableness'])/5)*100;
                                        $learningStyle['Aural'] = ($oceanSelfResult['Extraversion'])/5*100 ?? 0;
                                        $learningStyle['Reading & Writing'] = ($oceanSelfResult['Conscientiousness'])/5*100 ?? 0;
                                        $learningStyle['Kinesthetic'] = (max($oceanSelfResult['Openness to Experience'],$oceanSelfResult['Agreeableness'])/5)*100;

                                    @endphp
                                    <div class="lg:col-span-6 col-span-12">
                                        <div class="card h-full shadow-base2">
                                            <header class="card-header">
                                                <h4 class="card-title">Learning & Development Plan</h4>

                                            </header>
                                            <div class="card-body p-6">
                                                {{-- {{ dd($workCompetencyResult) }} --}}
                                                @if(auth()->user()->is_personality_motivation_completed == 1)
                                                <div class="">
                                                    <h6 class="mt-5">Learning Style</h6>

                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#visualAccordion">Visual <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($learningStyle['Visual'])&&($learningStyle['Visual']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $learningStyle['Visual'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="visualAccordion" class="accordion-collapse collapse  color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body font13 text-slate-600">
                                                            Visual learners learn best by seeing.
                                                            Example: Graphic displays such as charts, diagrams, illustrations, handouts, and videos are all helpful learning tools for visual learners.
                                                          </div>
                                                        </div>
                                                    </div>


                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#auralAccordion">Aural <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($learningStyle['Aural'])&& ($learningStyle['Aural']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $learningStyle['Aural'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="auralAccordion" class="accordion-collapse collapse  color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body font13 text-slate-600">
                                                            Aural (or auditory) learners learn best by hearing information.They tend to get a great deal out of lectures and are good at remembering things they are told.
                                                            Example: Things like audio books and podcasts helpful for learning new things.
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#readingWritingAccordion">Reading & Writing <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($learningStyle['Reading & Writing'])&& ($learningStyle['Reading & Writing']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $learningStyle['Reading & Writing'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="readingWritingAccordion" class="accordion-collapse collapse  color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body font13 text-slate-600">
                                                            Take in information that is displayed as words and text.
                                                            Example: Writing down information in order to help you learn and remember it(making lists, reading textbooks, taking notes)
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer" data-bs-toggle="collapse" data-bs-target="#kinestheticAccordion">Kinesthetic <span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a" @if(isset($learningStyle['Kinesthetic'])&& ($learningStyle['Kinesthetic']) == 100) style="left: 93%;"@else
                                                                style="left: {{ $learningStyle['Kinesthetic'] ?? 0 }}%;"@endif></div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="kinestheticAccordion" class="accordion-collapse collapse  color-black" aria-labelledby="panelsStayOpen-headingOne">
                                                          <div class="accordion-body font13 text-slate-600">
                                                            Also called tactile learners learn best by touching and doing.
                                                            Example: Hands-on experience is important for kinesthetic learners.(Movement, experiments, hands-on activities)
                                                          </div>
                                                        </div>
                                                    </div>

                                                    @if ($learningAndDevelopmentPlanResults->count() > 0)
                                                        <h6 class="mt-5">Opportunity For Growth</h6>
                                                        @foreach($learningAndDevelopmentPlanResults as $key => $learningAndDevelopmentPlanResult)
                                                            <div class="grid grid-cols-12 gap-6">
                                                                <div class="lg:col-span-3 col-span-3 mt-5">
                                                                    <b> {{ $learningAndDevelopmentPlanResult->talent_pillar ?? '' }}: </b>
                                                                </div>
                                                                <div class="lg:col-span-9 col-span-9 mt-5">
                                                                     {{ $learningAndDevelopmentPlanResult->growth_opportunities_for_low_scorers ?? '' }} <br>
                                                                      <p class="mt-5"> <b> Workplace Actionable Recommendation: </b> </p> <br>
                                                                      1. {{ $learningAndDevelopmentPlanResult->war_1 ?? '' }} <br>
                                                                      2. {{ $learningAndDevelopmentPlanResult->war_2 ?? '' }} <br>
                                                                      3. {{ $learningAndDevelopmentPlanResult->war_3 ?? '' }} <br>

                                                                      <p class="mt-5"> <b> Course/Workshop Recommendation: </b> </p> <br>
                                                                      1. {{ $learningAndDevelopmentPlanResult->cwr_1 ?? '' }} <br>
                                                                      2. {{ $learningAndDevelopmentPlanResult->cwr_2 ?? '' }} <br>
                                                                      3. {{ $learningAndDevelopmentPlanResult->cwr_3 ?? '' }} <br>

                                                                      <p class="mt-5"> <b> Measure of Gap Closure Success: </b> </p> <br>
                                                                      1. {{ $learningAndDevelopmentPlanResult->ksf_1_description ?? '' }} <br>
                                                                      2. {{ $learningAndDevelopmentPlanResult->ksf_2_description ?? '' }} <br>
                                                                      3. {{ $learningAndDevelopmentPlanResult->ksf_3_description ?? '' }} <br>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    @endif
                                                </div>
                                                @else
                                                <div class="container text-center bg_secondary_green p-5" style="
                                                border-radius: 16px;">
                                                    <iconify-icon icon="wpf:statistics" class="text-[2.23rem]"></iconify-icon>
                                                    <h4>Data Not Available </h4>
                                                </div>
                                                @endif


                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    function greetMorningOrEvening() {
    var currentTime = new Date();
    var currentHour = currentTime.getHours();

    if (currentHour >= 0 && currentHour < 12) {
        // return "Good morning!";
        document.getElementById('greeting').textContent = "Good Morning!";
    } else if (currentHour >= 12 && currentHour < 18) {
        // return "Good afternoon!";
        document.getElementById('greeting').textContent = "Good Afternoon!";
    } else {
        return "Good evening!";
        document.getElementById('greeting').textContent = "Good Evening!";
    }
}

console.log(greetMorningOrEvening());
</script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>

<script>
    var options = {
    chart: {
    type: 'donut',
    width: 400, // Set the width of the chart
    height: 300, // Set the height of the chart
    },
    series: [{{$totalCorrectForCognitive}}, {{ $totalWrongForCognitive }}, {{ $totalNonAttemptedForCognitive }}],
    labels: ['Correct', 'Wrong', 'Missed'],
    colors: ['#1AB93B', '#CE9E20', '#1F5476'],
    xaxis: {
    categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
    },

    legend: {
        position: 'bottom', // Set the position of the legend to 'bottom'
        },
    }

    var chart = new ApexCharts(document.querySelector("#donut"), options);

    chart.render();
</script>

<script>
    var options = {
        annotations: {},
        chart: {
            animations: {
                enabled: false,
                easing: "swing"
            },
            background: "#fff",
            foreColor: "#373D3F",
            fontFamily: "Roboto",
            height: 300,
            id: "4MmUr",
            stackOnlyBar: true,
            toolbar: {
                show: false
            },
            type: "bar",
            width: 600
        },
        plotOptions: {
            bar: {
                columnWidth: "40%",
                borderRadiusApplication: "end",
                borderRadiusWhenStacked: "last",
                hideZeroBarsWhenGrouped: false,
                isDumbbell: false,
                isFunnel: false,
                isFunnel3d: true,
                dataLabels: {
                    total: {
                        enabled: false,
                        offsetX: 0,
                        offsetY: 0,
                        style: {
                            color: "#373d3f",
                            fontSize: "12px",
                            fontWeight: 600
                        }
                    }
                }
            },
            bubble: {
                zScaling: true
            },
            treemap: {
                borderRadius: 4,
                dataLabels: {
                    format: "scale"
                }
            },
            radialBar: {
                hollow: {
                    background: "#fff"
                },
                dataLabels: {
                    name: {},
                    value: {},
                    total: {}
                },
                barLabels: {
                    enabled: false,
                    margin: 5,
                    useSeriesColors: true,
                    fontWeight: 600,
                    fontSize: "16px"
                }
            },
            pie: {
                donut: {
                    labels: {
                        name: {},
                        value: {},
                        total: {}
                    }
                }
            }
        },
        colors: [
            "#CE9E20",
            "#1F5476",
            "#81D4FA",
            "#fd6a6a",
            "#546E7A",
            "#CE9E20",
            "#1F5476",
            "#81D4FA",
            "#fd6a6a",
            "#546E7A"
        ],
        dataLabels: {
            offsetY: -4,
            style: {
                fontWeight: 700
            },
            dropShadow: {
                blur: 0
            }
        },
        grid: {
            padding: {
                right: 25,
                left: 15
            }
        },
        legend: {
            position: "top",
            fontSize: 14,
            offsetX: -16,
            offsetY: 0,
            markers: {
                shape: "square",
                size: 8
            },
            itemMargin: {
                vertical: 12
            }
        },
        series: [
            {
                name: "Self",
                data: [
                    { x: "O", y: {{$oceanSelfResult['Openness to Experience']}} },
                    { x: "C", y: {{$oceanSelfResult['Conscientiousness']}} },
                    { x: "E", y: {{$oceanSelfResult['Extraversion']}} },
                    { x: "A", y: {{$oceanSelfResult['Agreeableness']}} },
                    { x: "N", y: {{$oceanSelfResult['Emotional Stability']}} }
                ],
                zIndex: 0
            },
            {
                name: "All",
                data: [
                    { x: "O", y: {{$oceanOverallResult['Openness to Experience']}} },
                    { x: "C", y: {{$oceanOverallResult['Conscientiousness']}} },
                    { x: "E", y: {{$oceanOverallResult['Extraversion']}} },
                    { x: "A", y: {{$oceanOverallResult['Agreeableness']}} },
                    { x: "N", y: {{$oceanOverallResult['Emotional Stability']}} }
                ],
                zIndex: 1
            }
        ],
        stroke: {
            fill: {
                type: "solid",
                opacity: 0.85,
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    shadeIntensity: 0.5,
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 100],
                    colorStops: []
                }
            }
        },
        tooltip: {
            shared: false,
            hideEmptySeries: false,
            intersect: true
        },
        xaxis: {
            labels: {
                trim: true,
                style: {}
            },
            group: {
                groups: [],
                style: {
                    colors: [],
                    fontSize: "12px",
                    fontWeight: 400,
                    cssClass: ""
                }
            },
            tickPlacement: "between",
            title: {
                style: {
                    fontWeight: 700
                }
            },
            tooltip: {
                enabled: false
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: [null, null, null, null, null]
                }
            }
        },
        theme: {
            palette: "palette4"
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>

<script>
    var options = {
        annotations: {},
        chart: {
            animations: {
                enabled: false,
                easing: "swing"
            },
            background: "#fff",
            foreColor: "#373D3F",
            fontFamily: "Roboto",
            height: 250,
            id: "4MmUr",
            stackOnlyBar: true,
            toolbar: {
                show: false
            },
            type: "bar",
            width: 400
        },
        plotOptions: {
            bar: {
                columnWidth: "40%",
                borderRadiusApplication: "end",
                borderRadiusWhenStacked: "last",
                hideZeroBarsWhenGrouped: false,
                isDumbbell: false,
                isFunnel: false,
                isFunnel3d: true,
                dataLabels: {
                    total: {
                        enabled: false,
                        offsetX: 0,
                        offsetY: 0,
                        style: {
                            color: "#373d3f",
                            fontSize: "12px",
                            fontWeight: 600
                        }
                    }
                }
            },
            bubble: {
                zScaling: true
            },
            treemap: {
                borderRadius: 4,
                dataLabels: {
                    format: "scale"
                }
            },
            radialBar: {
                hollow: {
                    background: "#fff"
                },
                dataLabels: {
                    name: {},
                    value: {},
                    total: {}
                },
                barLabels: {
                    enabled: false,
                    margin: 5,
                    useSeriesColors: true,
                    fontWeight: 600,
                    fontSize: "16px"
                }
            },
            pie: {
                donut: {
                    labels: {
                        name: {},
                        value: {},
                        total: {}
                    }
                }
            }
        },
        colors: [
            "#1AB93B",
            "#FFC6A2",
            "#81D4FA",
            "#fd6a6a",
            "#546E7A",
            "#1AB93B",
            "#FFC6A2",
            "#81D4FA",
            "#fd6a6a",
            "#546E7A"
        ],
        dataLabels: {
            offsetY: -4,
            style: {
                fontWeight: 700
            },
            dropShadow: {
                blur: 0
            }
        },
        grid: {
            padding: {
                right: 25,
                left: 15
            }
        },
        legend: {
            position: "top",
            fontSize: 14,
            offsetX: -16,
            offsetY: 0,
            markers: {
                shape: "square",
                size: 8
            },
            itemMargin: {
                vertical: 12
            }
        },
        series: [
            {

                data: [
                    { x: "R", y: {{$workInterestResult['Realistic'] ?? 0}} },
                    { x: "I", y: {{$workInterestResult['Investigative'] ?? 0}} },
                    { x: "A", y: {{$workInterestResult['Artistic'] ?? 0}} },
                    { x: "S", y: {{$workInterestResult['Social'] ?? 0}} },
                    { x: "E", y: {{$workInterestResult['Enterprising'] ?? 0}} },
                    { x: "C", y: {{$workInterestResult['Conventional'] ?? 0}} }

                ],
                zIndex: 0
            },

        ],
        stroke: {
            fill: {
                type: "solid",
                opacity: 0.85,
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    shadeIntensity: 0.5,
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 100],
                    colorStops: []
                }
            }
        },
        tooltip: {
            shared: false,
            hideEmptySeries: false,
            intersect: true
        },
        xaxis: {
            labels: {
                trim: true,
                style: {}
            },
            group: {
                groups: [],
                style: {
                    colors: [],
                    fontSize: "12px",
                    fontWeight: 400,
                    cssClass: ""
                }
            },
            tickPlacement: "between",
            title: {
                style: {
                    fontWeight: 700
                }
            },
            tooltip: {
                enabled: false
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: [null, null, null, null, null]
                }
            }
        },
        theme: {
            palette: "palette4"
        }
    };

    var chart = new ApexCharts(document.querySelector("#riasec"), options);
    chart.render();
</script>

@endsection
