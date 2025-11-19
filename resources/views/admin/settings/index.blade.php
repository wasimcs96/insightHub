@extends('admin.layout.app')

@section('title', 'Settings')

@section('styles')

    <style>
        .feedback-message {
            display: none;
            border-radius: 8px;
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            padding: 24px;
        }

        .feedback-message p {
            color: #071437;
            font-size: 13.975px;
            line-height: 16.77px;
        }

        .feedback-message .icon {
            color: #78829D;
        }

        .sidebar {
            padding: 24px 0px;
            border-right: 1px solid #F1F1F4;
        }

        .sidebar p {
            color: #4B5675;
            font-size: 10px;
            font-style: normal;
            font-weight: 500;
            line-height: 14px;
            padding-left: 16px;
            margin-bottom: 8px;
        }


        .sidebar .nav-link {
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            padding: 16px;
            width: 180px;
            text-align: left;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .sidebar .nav-link.active {
            border-right: 4px solid #F7941C;
            background: #FAFAFB;
            color: #071437;
            font-weight: 500;
        }

        .top-heading {
            color: #000;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            padding: 10px 0px;
        }

        .tab-content {
            padding: 32px;
            width: 100%;
        }

        .sub-heading {
            padding: 24px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            color: #071437;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
        }

        .inner-content {
            padding: 24px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .accordion-item {
            border: none;
            margin-bottom: 8px;
        }

        .custom-accordion .accordion-header {
            display: flex;
            align-items: center;
            font-weight: bold;
            cursor: pointer;
            border: none;
            outline: none;
            background: none;
        }

        .custom-accordion .accordion-header .icon {
            color: #000;
        }



        .accordion-button {
            box-shadow: none !important;
            background-color: #fff !important;
            border-radius: 0px !important;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #F1F1F4 !important;
        }

        .accordion-button[aria-expanded="true"] {
            background-color: #FFF6EA !important;
            border-radius: 8px 8px 0px 0px !important;
            border: none !important;
        }

        .accordion-button::after {
            display: none;
        }

        .accordion-button:not(.collapsed),
        .accordion-button.collapsed {
            color: #071437;
            font-size: 13.975px;
            font-style: normal;
            font-weight: 500;
            line-height: 16.77px;
            border-bottom: none !important;
        }

        .accordion-body {
            padding: 0px 0px 20px 78px;
            background: #FFF6EA;
            border-radius: 0px 0px 8px 8px !important;
        }

        .custom-btn button {
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            width: fit-content;
            float: right;
        }

        .custom-btn .orange-outline {
            background: #fff;
            color: #78829D;
            border-color: #99A1B7;
            margin-right: 8px;
        }

        .custom-btn .orange-fill {
            background: #F7941C;
            color: #fff;
        }

        .form-check-input:checked {
            background-color: #F7941C;
            border-color: #F7941C;
        }

        .form-check-input {
            border-radius: 2px !important;
            border: 2px solid #F7941C;
        }

        .app-content {
            padding-top: 10px;
        }

        .tooltip-inner {
            max-width: 290px;
            text-align: left;
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
                    Settings
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item link-a text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Privacy Preference Centre</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3 mb-3"
                style="display:none;">
                <p class="text-center fw-medium m-0"><b>Success!</b> Your preferences have been saved successfully.</p>
                <iconify-icon icon="iconamoon:close-bold" width="24" height="24" class="cursor-pointer"
                    id="closeIcon"></iconify-icon>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <h4 class="top-heading">Settings</h4>
            <div class="d-flex align-items-start bg-white">
                <div class="flex-column sidebar bg-white" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <p>CONFIGURATION</p>
                    <button class="nav-link active mb-5" id="v-pills-weightage-modification-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-weightage-modification" type="button" role="tab"
                        aria-controls="v-pills-weightage-modification" aria-selected="true"><span><iconify-icon
                                icon="bi:percent" width="16" height="16"></iconify-icon></span> Weightage
                        Modification</button>
                    <p>PROFILE</p>
                    <button class="nav-link" id="v-pills-company-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-company-profile" type="button" role="tab"
                        aria-controls="v-pills-company-profile" aria-selected="false"><span><iconify-icon
                                icon="si:briefcase-line" width="21" height="21"></iconify-icon></span>Company
                        Profile</button>
                    <button class="nav-link mb-5" id="v-pills-admin-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-admin-profile" type="button" role="tab"
                        aria-controls="v-pills-admin-profile" aria-selected="false"><span><iconify-icon icon="ep:user"
                                width="22" height="22"></iconify-icon></span>Admin Profile</button>
                    <p>GENERAL</p>
                    <button class="nav-link" id="v-pills-privacy-preference-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-privacy-preference" type="button" role="tab"
                        aria-controls="v-pills-privacy-preference" aria-selected="false"><span><iconify-icon
                                icon="solar:settings-linear" width="24" height="24"></iconify-icon></span>Privacy
                        Preference Centre</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-weightage-modification" role="tabpanel"
                        aria-labelledby="v-pills-weightage-modification-tab" tabindex="0">
                        <h4 class="top-heading">Weightage Modification</h4>
                    </div>
                    <div class="tab-pane fade show" id="v-pills-company-profile" role="tabpanel"
                        aria-labelledby="v-pills-company-profile-tab" tabindex="0">
                        <h4 class="top-heading">Company Profile</h4>
                    </div>
                    <div class="tab-pane fade show" id="v-pills-admin-profile" role="tabpanel"
                        aria-labelledby="v-pills-admin-profile-tab" tabindex="0">
                        <h4 class="top-heading">Admin Profile</h4>
                    </div>
                    <div class="tab-pane fade show" id="v-pills-privacy-preference" role="tabpanel"
                        aria-labelledby="v-pills-privacy-preference-tab" tabindex="0">
                        <h4 class="top-heading">Privacy Preference Centre</h4>
                        <p class="m-0 sub-heading">Cookie Settings</p>
                        <div class="inner-content">
                            <div class="d-flex flex-column gap-6">
                                <div class="accordion custom-accordion" id="customAccordion">
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseOne" aria-expanded="false"
                                                aria-controls="CollapseOne">
                                                <div class="d-flex gap-7 align-items-center">
                                                    <iconify-icon icon="material-symbols:check-rounded"
                                                        style="color: #F7941C;" width="24"
                                                        height="24"></iconify-icon>
                                                    <p class="m-0 d-flex align-items-center gap-2">Strictly Necessary
                                                        Cookies <span><iconify-icon
                                                                icon="material-symbols:info-outline-rounded"
                                                                style="color: #757575; margin-top: 3px;" width="16"
                                                                height="16" data-bs-toggle="tooltip"
                                                                data-bs-html="true"
                                                                data-bs-title="<p><b>Strictly Necessary Cookies</b> - These cookies are essential and cannot be disabled. They enable core functionalities such as page navigation and managing cookie preferences. Without these cookies, the website cannot function properly.</p>"></iconify-icon></span>
                                                    </p>
                                                </div>
                                                <span class="icon"><iconify-icon icon="line-md:chevron-down"
                                                        style="color: #757575;" width="24"
                                                        height="24"></iconify-icon></span>
                                            </button>
                                        </h4>
                                        <div id="CollapseOne" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p style="margin: 0;">Strictly Necessary Cookies</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseTwo" aria-expanded="false"
                                                aria-controls="CollapseTwo">
                                                <div class="d-flex gap-7 align-items-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>
                                                    <p class="m-0 d-flex align-items-center gap-2">Performance Cookies
                                                        <span><iconify-icon icon="material-symbols:info-outline-rounded"
                                                                style="color: #757575; margin-top: 3px;" width="16"
                                                                height="16"></iconify-icon></span>
                                                    </p>
                                                </div>
                                                <span class="icon"><iconify-icon icon="line-md:chevron-down"
                                                        width="24" height="24"></iconify-icon></span>
                                            </button>
                                        </h4>
                                        <div id="CollapseTwo" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-1" type="checkbox">
                                                    </div>
                                                    <div class="mb-6">
                                                        <p><b>_gat</b> <span>(12 months)</span></p>
                                                        <p class="m-0">This cookie is used by Google Analytics to
                                                            drastically reduce the rate of queries.</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-1" type="checkbox">
                                                    </div>
                                                    <div class="mb-6">
                                                        <p><b>_gat</b> <span>(12 months)</span></p>
                                                        <p class="m-0">This cookie is used by Google Analytics to
                                                            drastically reduce the rate of queries.</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-1" type="checkbox">
                                                    </div>
                                                    <div class="mb-6">
                                                        <p><b>_gat</b> <span>(12 months)</span></p>
                                                        <p class="m-0">This cookie is used by Google Analytics to
                                                            drastically reduce the rate of queries.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseThree" aria-expanded="false"
                                                aria-controls="CollapseThree">
                                                <div class="d-flex gap-7 align-items-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>
                                                    <p class="m-0 d-flex align-items-center gap-2">Functional Cookies
                                                        <span><iconify-icon icon="material-symbols:info-outline-rounded"
                                                                style="color: #757575; margin-top: 3px;" width="16"
                                                                height="16"></iconify-icon></span>
                                                    </p>
                                                </div>
                                                <span class="icon"><iconify-icon icon="line-md:chevron-down"
                                                        width="24" height="24"></iconify-icon></span>
                                            </button>
                                        </h4>
                                        <div id="CollapseThree" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-1" type="checkbox">
                                                    </div>
                                                    <div class="mb-6">
                                                        <p><b>_gat</b> <span>(12 months)</span></p>
                                                        <p class="m-0">This cookie is used by Google Analytics to
                                                            drastically reduce the rate of queries.</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-1" type="checkbox">
                                                    </div>
                                                    <div class="mb-6">
                                                        <p><b>_gat</b> <span>(12 months)</span></p>
                                                        <p class="m-0">This cookie is used by Google Analytics to
                                                            drastically reduce the rate of queries.</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-1" type="checkbox">
                                                    </div>
                                                    <div class="mb-6">
                                                        <p><b>_gat</b> <span>(12 months)</span></p>
                                                        <p class="m-0">This cookie is used by Google Analytics to
                                                            drastically reduce the rate of queries.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseFour" aria-expanded="false"
                                                aria-controls="CollapseFour">
                                                <div class="d-flex gap-7 align-items-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>
                                                    <p class="m-0 d-flex align-items-center gap-2">Targeting Cookies
                                                        <span><iconify-icon icon="material-symbols:info-outline-rounded"
                                                                style="color: #757575; margin-top: 3px;" width="16"
                                                                height="16"></iconify-icon></span>
                                                    </p>
                                                </div>
                                                <span class="icon"><iconify-icon icon="line-md:chevron-down"
                                                        width="24" height="24"></iconify-icon></span>
                                            </button>
                                        </h4>
                                        <div id="CollapseFour" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-1" type="checkbox">
                                                    </div>
                                                    <div class="mb-6">
                                                        <p><b>_gat</b> <span>(12 months)</span></p>
                                                        <p class="m-0">This cookie is used by Google Analytics to
                                                            drastically reduce the rate of queries.</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-1" type="checkbox">
                                                    </div>
                                                    <div class="mb-6">
                                                        <p><b>_gat</b> <span>(12 months)</span></p>
                                                        <p class="m-0">This cookie is used by Google Analytics to
                                                            drastically reduce the rate of queries.</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-1" type="checkbox">
                                                    </div>
                                                    <div class="mb-6">
                                                        <p><b>_gat</b> <span>(12 months)</span></p>
                                                        <p class="m-0">This cookie is used by Google Analytics to
                                                            drastically reduce the rate of queries.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-btn">
                                    <button type="button" class="orange-fill feedback feedback-msg">Save changes</button>
                                    <button type="button" class="orange-outline">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

    <script>
        // Wait for DOM to load
        document.addEventListener('DOMContentLoaded', function() {
            const confirmBtn = document.querySelector('.feedback.feedback-msg');
            const feedbackMsg = document.getElementById('feedbackMessage');
            const closeIcon = document.getElementById('closeIcon');

            confirmBtn.addEventListener('click', function() {
                feedbackMsg.style.display = 'flex'; // Make it visible with flex for alignment
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            closeIcon.addEventListener('click', function() {
                feedbackMsg.style.display = 'none'; // Hide it
            });
        });
    </script>

@endsection
