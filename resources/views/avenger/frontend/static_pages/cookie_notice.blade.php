@extends('avenger.layouts.app')

@section('title', 'Cookie Notice')
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
            margin-top: 40px;
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
            margin-top: 10px;
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

        .cookie-setting {
            display: flex;
            width: 722px;
            padding: 16px;
            flex-direction: column;
            gap: 24px;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            margin: 36px auto;
        }

        .cookie-setting h5 {
            color: #071437;
            font-size: 16.25px;
            font-weight: 700;
            line-height: 19.5px;
        }

        .cookie-setting button {
            padding: 8px 16px;
            border-radius: 4px;
            border: 1.5px solid #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .cookie-setting .orange-outline {
            background: #fff;
            color: #F7941C;
        }

        .cookie-setting .orange-fill {
            background: #F7941C;
            color: #fff;
        }

        .cookie-setting .preferences-btn {
            color: #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            text-decoration-line: underline;
            text-decoration-style: solid;
        }

        .cookie-setting .main-content-div {
            border: 1px solid #DBDFE9;
            border-bottom: 0;
        }

        .cookie-setting .inner-content {
            padding: 16px;
            border-bottom: 1px solid #DBDFE9;
        }

        .cookie-setting .inner-content p {
            color: #1E1E1E;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
        }

        .cookie-setting .form-check-input:checked {
            background-color: #F7941C;
            border-color: #F7941C;
        }

        .feedback-message {
            display: none;
            border-radius: 8px;
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            padding: 24px;
            margin-top: 64px;
        }

        .feedback-message p {
            color: #071437;
            font-size: 13.975px;
            line-height: 16.77px;
        }

        .feedback-message .icon {
            color: #78829D;
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
                    Cookie Notice
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
                        Cookie Notice</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message"
                style="display:none;">
                <p class="text-center fw-medium m-0"><b>Success!</b> Your preferences have been saved successfully.</p>
                <iconify-icon icon="iconamoon:close-bold" width="24" height="24" class="cursor-pointer"
                    id="closeIcon"></iconify-icon>
            </div>
        </div>
    </div>


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="terms-use-header">
                <h2>Cookie Notice</h2>
                <div class="modal-time-update"><iconify-icon icon="mingcute:time-line" width="16" height="16"
                        style="color: #F7941C;"></iconify-icon>Last
                    Updated: 13 December 2024</div>
            </div>
            <div class="terms-use">
                <p>When you visit our sites (“Sites”), we may collect information by automated means, such
                    as cookies, web beacons, and web server logs. The information we may collect in this
                    manner includes: IP address, unique device identifier, browser characteristics, device
                    characteristics, operating system, language preferences, referring URLs, information on
                    actions taken on our Sites, dates and times of visits to our Sites, and other usage
                    statistics.</p>
                <h4>WHAT ARE COOKIES AND WEB BEACONS?</h4>
                <p>A "cookie" is a small text file that a website stores on a visitor's computer or other
                    internet-connected device, allowing the website to uniquely identify the visitor’s
                    browser and/or remember information, such as language preference or login details.</p>
                <p>A "web beacon" (also known as an internet tag or tracking pixel) links web pages to web
                    servers and their cookies. It is used to send information collected through cookies back
                    to a web server. Through these automated collection methods, we may obtain "clickstream
                    data," which is a log of the links and other content on which a visitor clicks while
                    browsing a website.</p>
                <h4>COOKIE LIST</h4>
                <p>To see a complete list of all cookies used on this website and their corresponding
                    categorizations, or to update your consent preferences at any time, please click <b
                        style="text-decoration:underline">Cookie
                        Settings</b> below.</p>
                <h4>COOKIE SETTINGS</h4>
                <p>“When you visit any website, it may store or retrieve information on your browser, mostly
                    in the form of cookies. This information might be about you, your preferences or your
                    device and is mostly used to make the site work as you expect it to. The information
                    does not usually directly identify you, but it can give you a more personalized web
                    experience. Because we respect your right to privacy, you can choose not to allow some
                    types of cookies. Click on the different category headings to find out more and change
                    our default settings. However, blocking some types of cookies may impact your experience
                    of the site and the services we are able to offer.”</p>
                @include('avenger.frontend.static_pages.cookie_setting')
                <h4>HOW WE COLLECT INFORMATION BY AUTOMATED MEANS</h4>
                <p>As you navigate through our Sites, a record of your actions may be collected and stored.
                    We may link certain data elements collected through automated means (such as your
                    browser information) with other information we have obtained about you to understand,
                    for example, whether you have opened an email we sent to you.</p>
                <p>To the extent required by applicable law, we will obtain your consent via our cookie
                    banner before collecting information using cookies or similar automated means. You may
                    also use our Privacy Preference Centre, accessed via the “Changing Your Preferences”
                    section of this Notice, to block all cookies that are not categorized as strictly
                    necessary if you change your mind. However, you may not be able to use all the features
                    of our Sites without cookies.</p>
                <p>Your browser may inform you how to be notified when you receive certain types of cookies
                    or how to restrict or disable certain types of cookies. Additionally, you may choose to
                    block cookies; however, blocking cookies may limit the functionality of our Sites. Our
                    Sites are not designed to respond to "do not track" signals from browsers.</p>
                <p>Providers of third-party apps, tools, widgets, and plug-ins on our Sites (such as social
                    media sharing tools) may also use automated means to collect information about your
                    interactions with these features. This information is collected directly by the
                    providers and is subject to their privacy policies or notices. Subject to applicable
                    law, CXS Analytics Sdn Bhd is not responsible for these third parties’ information
                    practices.</p>
                <h4>HOW WE USE THE INFORMATION WE COLLECT</h4>
                <p style="margin: 0;">We use information collected through cookies and similar automated
                    means to:</p>
                <ul>
                    <li>Customize our users’ experience on the Sites;</li>
                    <li>Deliver content tailored to our users’ interests and how they use the Sites; and
                    </li>
                    <li>Manage the Sites and other aspects of our business (e.g., optimization and
                        security).</li>
                </ul>
                <h4>CHANGING YOUR PREFERENCES</h4>
                <p>Cookies are categorized based on their purpose. Cookies that are strictly necessary do
                    not require your consent and can be placed on your device. For cookies not categorized
                    as strictly necessary, you can return to the “Cookie Settings” page at any time to
                    update your cookie preferences.</p>
                <h4>THIRD-PARTY COOKIES</h4>
                <p>We use third-party cookies on our Sites. Details of these third-party cookies and their
                    purposes are provided in the Cookie List mentioned above.</p>
                <h4>LINKS TO THIRD-PARTY SITES,APPS, AND SERVICES</h4>
                <p>For your convenience and information, our Sites may provide links to third-party sites,
                    apps, and services that may be operated by companies not affiliated with CXS Analytics
                    Sdn Bhd. These companies may have their own privacy notices or policies, which we
                    encourage you to review. CXS Analytics Sdn Bhd is not responsible for the privacy
                    practices of any non-CXS Analytics sites, apps, or services.</p>
                <h4>PROFILING AND INTEREST-BASED ADVERTISING</h4>
                <p>On our Sites, we may collect information about your online activities to provide
                    advertising about products and services tailored to your interests. We may also obtain
                    such information from third-party websites where our ads are served.</p>
                <p>You may see certain CXS Analytics ads on other websites because we engage third-party
                    advertising networks. Through such networks, we can target our messaging to users based
                    on demographics, interests, behaviors, and context. The ad networks may track your
                    online activities over time by collecting information through automated means, including
                    third-party cookies, web server logs, pixels, and web beacons. They use this information
                    to display advertisements tailored to your interests and previous activity. This
                    information also helps us measure the effectiveness of our marketing efforts.</p>
                <p style="margin: 0;">To learn how to opt out of interest-based advertising, please visit:
                </p>
                <ul>
                    <li>Digital Advertising Alliance: aboutads.info/choices/</li>
                    <li>Google Analytics: tools.google.com/dlpage/gaoptout</li>
                    <li>Adobe Analytics: adobe.com/privacy/analytics.html#1</li>
                </ul>
                <h4>UPDATES TO OUR COOKIE NOTICE</h4>
                <p>This Cookie Notice (including any addenda) is part of our overall Privacy Notice and may
                    be updated periodically to reflect changes in our privacy practices and legal
                    requirements. For significant changes, we will post a prominent notice on our Sites
                    indicating when it was most recently updated at the top of this Notice.</p>
                <h4>HOW TO CONTACT US</h4>
                <p>If you have any questions or comments about this Cookie Notice, or if you would like to
                    exercise your rights, please contact:</p>
                <p style="margin: 0;">CXS Analytics Sdn Bhd</p>
                <p style="margin: 0;">A-37-7&8 Menara UOA Bangsar</p>
                <p style="margin: 0;">5 Jalan Bangsar Utama 1, 59000 Kuala Lumpur</p>
                <p style="margin: 0;">Attn: Data Protection Officer</p>
                <p>Email: data.prvc@cxsanalytics.com</p>
                <p>If you are located in Malaysia, you may contact the Data Protection Officer as provided
                    above. If applicable, please visit our local privacy request page or contact our support
                    team for assistance.</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('click', function() {
                // Reset all icons to '+'
                document.querySelectorAll('.accordion-button').forEach(btn => {
                    const icon = btn.querySelector('.icon');
                    icon.textContent = '+';
                });

                // Update the clicked button's icon
                const icon = this.querySelector('.icon');
                if (this.classList.contains('collapsed')) {
                    icon.textContent = '+';
                } else {
                    icon.textContent = '-';
                }
            });
        });
    </script>

<script>
    // Wait for DOM to load
    document.addEventListener('DOMContentLoaded', function () {
        const confirmBtn = document.querySelector('.custom-btn.feedback-msg');
        const feedbackMsg = document.getElementById('feedbackMessage');
        const closeIcon = document.getElementById('closeIcon');

        confirmBtn.addEventListener('click', function () {
            feedbackMsg.style.display = 'flex'; // Make it visible with flex for alignment
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        closeIcon.addEventListener('click', function () {
            feedbackMsg.style.display = 'none'; // Hide it
        });
    });
</script>


@endsection
