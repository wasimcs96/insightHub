@extends('avenger.layouts.app')

@section('title', 'Accessibility Atatement')
@section('styles')
    <style>
        .terms-use,
        .terms-use-header {
            background: #fff;
            padding: 24px;
        }

        .terms-use {
            border-radius: 0px 0px 8px 8px;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
        }

        .terms-use-header {
            border-radius: 8px 8px 0px 0px;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid #F1F1F4;
            margin-top: 64px;
        }

        .terms-use h3 {
            color: #071437;
            font-size: 16.25px;
            font-style: normal;
            font-weight: 700;
            line-height: 19.5px;
            padding: 12px 0px;
            margin-bottom: 16px;
        }

        .terms-use h4 {
            color: #071437;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: 20px;
            margin-top: 20px;
            margin-bottom: 0;
        }

        .modal-time-update {
            color: #4B5675;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
            display: flex;
            gap: 4px;
            margin-top: 8px;
        }

        .link {
            color: black;
            text-decoration: underline;
        }

        [data-kt-app-header-fixed=true][data-kt-app-toolbar-fixed=true] .app-toolbar {
            position: absolute;
            top: 63px;
        }
    </style>
@endsection
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1
                    class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Accessibility Statement
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">
                            Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Accessibility Statement</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="terms-use-header">
                <h2>Accessibility Statement</h2>
                <div class="modal-time-update"><iconify-icon icon="mingcute:time-line" width="16" height="16"
                        style="color: #F7941C;"></iconify-icon>Last
                    Updated: 13 December 2024</div>
            </div>
            <div class="terms-use">
                <p>CXS Analytics Sdn Bhd is committed to accessibility, diversity, and inclusion. We believe in ensuring
                    that all content and functionality available on the InsightAccess platform are accessible to everyone,
                    regardless of disabilities.</p>
                <p>We follow the Web Content Accessibility Guidelines (WCAG) 2.1, developed by the World Wide Web Consortium
                    <a href="https://www.w3.org/" target="_blank" class="link"><b>(W3C)</b></a>. WCAG 2.1 is a recognized
                    global standard for web accessibility. Our goal is to meet or exceed
                    Level A and Level AA success criteria to provide an inclusive online experience for all users.
                </p>
                <p>Each time you use the Site, the then-current version of these Terms of Use
                    will govern your use. Accordingly, when you use the Site, you should check
                    the date of these Terms of Use and review any changes since the last
                    version.</p>
                <p>If you experience any difficulty accessing any part of our platform, or if you would like to share
                    feedback on how we can improve website accessibility related to our jobs, tools, content, or features,
                    please contact us:</p>
                <h4>Contact Information</h4>
                <p>CXS Analytics Sdn Bhd<br />A-37-7&8 Menara UOA Bangsar<br />5 Jalan Bangsar
                    Utama 1, 59000 Kuala Lumpur<br />Attn: Data Protection Officer<br />Email:
                    data.prvc@cxsanalytics.com</p>
                <p>CXS Analytics Sdn Bhd is committed to addressing accessibility issues and improving the usability of our
                    platform to ensure a positive experience for all visitors.</p>
            </div>
        </div>
    </div>
@endsection
