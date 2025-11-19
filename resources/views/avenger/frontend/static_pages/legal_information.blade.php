@extends('avenger.layouts.app')

@section('title', 'Legal Information')
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

        .sidebar {
            padding: 24px 0px;
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
        }

        .sidebar .nav-link.active {
            border-right: 4px solid #F7941C;
            background: #FAFAFB;
            color: #071437;
            font-weight: 500;
        }

        .accordion-item {
            border: none;
            border-bottom: 1px solid #F1F1F4;
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
            margin-right: 24px;
            background: #F7941C;
            font-size: 25px;
            color: #fff;
            padding: 2px 4px 5px 4px;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;

        }



        .accordion-button {
            box-shadow: none !important;
            background-color: #fff !important;
            border-radius: 0px !important;
            padding: 20px 24px;
        }

        .accordion-button[aria-expanded="true"] {
            background-color: #FFF6EA !important;
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
        }

        .accordion-body {
            padding: 0px 0px 20px 73px;
            background: #FFF6EA;
        }

        .link-a a {
            color: black;
            text-decoration: underline;
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
                    Legal Information
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item link-a text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Legal Information</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Terms of Use</li>
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

            <div class="d-flex align-items-start" style="margin-top: 34px;">
                <div class="flex-column sidebar bg-white" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <p>Legal Information</p>
                    <button class="nav-link active" id="v-pills-terms-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-terms" type="button" role="tab" aria-controls="v-pills-terms"
                        aria-selected="true">Terms of Use</button>
                    <button class="nav-link" id="v-pills-privacy-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-privacy" type="button" role="tab" aria-controls="v-pills-privacy"
                        aria-selected="false">Privacy Notice</button>
                    <button class="nav-link" id="v-pills-cookie-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cookie"
                        type="button" role="tab" aria-controls="v-pills-cookie" aria-selected="false">Cookie
                        Notice</button>
                    <button class="nav-link" id="v-pills-statement-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-statement" type="button" role="tab" aria-controls="v-pills-statement"
                        aria-selected="false">Accessibility Statement</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-terms" role="tabpanel"
                        aria-labelledby="v-pills-terms-tab" tabindex="0">
                        <div>
                            <div class="terms-use-header">
                                <h2>Terms of Use</h2>
                                <div class="modal-time-update"><iconify-icon icon="mingcute:time-line" width="16"
                                        height="16" style="color: #F7941C;"></iconify-icon>Last
                                    Updated: 13 December 2024</div>
                            </div>
                            <div class="terms-use">
                                <p>Welcome to the InsightAccess website (“Site”), owned and operated by CXS
                                    Analytics Sdn Bhd. Throughout these Terms of Use, “InsightAccess,” “we,”
                                    “us,” and “our” refer to CXS Analytics Sdn Bhd and its affiliates, along
                                    with their directors, officers, employees, agents, independent contractors,
                                    and representatives. Your use of this Site is subject to the following terms
                                    and conditions (“Terms of Use”), which you affirmatively accept by using the
                                    Site. Please read these Terms of Use carefully and ensure that you
                                    understand them before you use the Site.</p>
                                <p>We reserve the right to modify the contents of the Site at any time,
                                    including the features, availability, or operation of the Site, these Terms
                                    of Use, and/or any policy or notice posted on the Site. You agree to monitor
                                    the Site for any changes, and your continued use of the Site following the
                                    posting of any changes signifies your understanding of and agreement to such
                                    changes.<br />These Terms of Use limit the liability of InsightAccess and
                                    other persons and contain other important provisions. Please review them
                                    carefully.</p>
                                <p>Each time you use the Site, the then-current version of these Terms of Use
                                    will govern your use. Accordingly, when you use the Site, you should check
                                    the date of these Terms of Use and review any changes since the last
                                    version.</p>
                                <h4>ABILITY TO ACCEPT TERMS OF USE</h4>
                                <p>Each time you use the Site, you signify your agreement, and the agreement of
                                    all persons you represent, without limitation or qualification, to be bound
                                    by these Terms of Use. You represent and warrant that you have the legal
                                    authority to agree to and accept these Terms of Use on behalf of yourself
                                    and all persons you represent. If you do not agree with each provision of
                                    these Terms of Use, or you are not authorized to agree to and accept these
                                    Terms of Use, you may not use the Site. By using the Site, you affirm that
                                    you are over the age of legal majority, can form legally binding agreements
                                    under applicable law, and are fully able and competent to enter into these
                                    Terms of Use and comply with them. Persons using the Site must comply with
                                    all applicable laws. InsightAccess may, in its discretion, refuse permission
                                    to access and use the Site.</p>
                                <h4>ACCURACY, COMPLETENESS, AND TIMELINESS OF INFORMATION</h4>
                                <p>The information and features on the Site do not constitute binding offers of
                                    employment. InsightAccess does not represent or warrant that job
                                    opportunities depicted or mentioned on the Site are currently available.
                                    Likewise, because content may be provided by Site users rather than
                                    InsightAccess, we cannot guarantee that the information and content
                                    presented is entirely accurate, complete, timely, or authentic. Although
                                    InsightAccess makes reasonable efforts to ensure that all information
                                    included on the Site is correct, accuracy and integrity cannot be
                                    guaranteed. InsightAccess does not assume any responsibility or obligation
                                    for the accuracy, completeness, timeliness, or authenticity of information
                                    included on the Site. We are under no obligation to post, forward, transmit,
                                    distribute, or otherwise provide any information and/or material available
                                    from the Site.</p>
                                <p>Regardless of any information presented on the Site, InsightAccess reserves
                                    the right, without prior notice, to discontinue services, remove or alter
                                    content, or retract positions at any time without incurring any obligations.
                                    The Site should not be relied upon or used as the sole basis for making
                                    significant decisions without consulting primary or more accurate, complete,
                                    or timely sources of information.</p>
                                <h4>OWNERSHIP AND PERMITTED USES OF THE SITE</h4>
                                <p>Copyright © [2024] CXS Analytics Sdn Bhd. Except as otherwise noted, all
                                    content included on the Site, such as text, design, graphics, logos, icons,
                                    images, audio clips, downloads, interfaces, code, and software, and all
                                    intellectual property held by CXS Analytics Sdn Bhd, is protected by
                                    applicable copyright, trademark, and other laws.</p>
                                <p>The Site integrates certain components of the “Skills Framework,” the
                                    copyright of which is owned by SkillsFuture Singapore, a Singapore
                                    government agency. Your use of any materials derived from the Skills
                                    Framework is subject to these Terms of Use and any additional terms required
                                    by SkillsFuture Singapore. Except as expressly permitted, you may not copy,
                                    modify, reproduce, republish, upload, post, transmit, distribute, or create
                                    derivative works of the Skills Framework or other third-party content made
                                    available through the Site without the prior written consent of the
                                    respective copyright owner.</p>
                                <p>The copying, downloading, and/or printing of information and/or material from
                                    the Site for personal and noncommercial use is permitted provided that you
                                    do not modify or delete any copyright, trademark, or other proprietary
                                    notices. Any other use—including modification, distribution, transmission,
                                    performance, broadcast, publication, licensing, reverse engineering,
                                    transfer, sale, or creation of derivative works—is expressly prohibited
                                    without prior written consent from InsightAccess and/or the relevant
                                    third-party rights holder.</p>
                                <p>Improper use of the Site or its content, including attempts to damage or
                                    interfere with the Site’s proper functioning or to intercept any system,
                                    data, or personal information, is strictly prohibited. Users may not
                                    interrupt or attempt to interrupt the Site’s operation in any way.
                                    InsightAccess reserves the right, in its sole discretion, to terminate
                                    access to the Site at any time without notice. Termination does not waive or
                                    affect any right or relief to which InsightAccess may be entitled at law or
                                    in equity.</p>
                                <p>Users are responsible for any information and/or material submitted via the
                                    Site, including its legality, reliability, appropriateness, originality, and
                                    copyright. Content that is false, fraudulent, defamatory, obscene, abusive,
                                    illegal, or otherwise objectionable; encourages criminal offenses; violates
                                    the rights of any party; or contains harmful code (such as viruses) is
                                    strictly prohibited. Users may not impersonate another person, provide false
                                    information, or upload commercial content.</p>
                                <h4>SITE COMMUNICATIONS</h4>
                                <p>The Site may be a portal to, or contain links to, websites operated by CXS
                                    Analytics Sdn Bhd and its affiliates (“Affiliates”), which may have
                                    different terms of use or privacy notices. Your dealings with Affiliates and
                                    use of their websites are at your own risk, and you shall not make any claim
                                    against InsightAccess or CXS Analytics Sdn Bhd arising out of those matters.
                                    If you use the Site to initiate communication regarding staffing or other
                                    needs, the information you submit may be disclosed to and processed by
                                    InsightAccess, CXS Analytics Sdn Bhd, and/or Affiliates. All communications
                                    you submit must be true, accurate, and complete. If you provide incorrect or
                                    incomplete information, you and any persons you represent are liable for any
                                    resulting loss or damages.</p>
                                <p style="margin: 0">You authorize InsightAccess to:</p>
                                <ol>
                                    <li>Accept communications received from you via the Site or email as if
                                        those communications had been given directly in writing and signed by
                                        you.</li>
                                    <li>Disclose your communications to CXS Analytics Sdn Bhd, its Affiliates,
                                        and any authorized InsightAccess representatives.</li>
                                    <li>Respond to your communications via Internet, email, or other
                                        communications methods.</li>
                                </ol>
                                <p>Communications sent to InsightAccess through the Site or email are not
                                    effective unless processed by the responsible representative. InsightAccess
                                    may refuse to process or may reverse the processing of any communications at
                                    its discretion without notice or liability if those communications cannot be
                                    processed, violate these Terms of Use, conflict with other instructions, or
                                    if an operational failure occurs.</p>
                                <p>Any information submitted to InsightAccess, CXS Analytics Sdn Bhd, or
                                    Affiliates via the Site becomes the property of CXS Analytics Sdn Bhd and
                                    may be used for any purpose, unless otherwise required by law or stated in
                                    the applicable privacy policies. E-mail may not be secure and may be
                                    intercepted by third parties. Do not send confidential or urgent materials
                                    via e-mail.</p>
                                <h4>NO ADVICE</h4>
                                <p>The Site is not intended as comprehensive or detailed advice on legal,
                                    financial, tax, or other professional matters. You should seek qualified
                                    professional advice before relying on information provided on or through the
                                    Site.</p>
                                <h4>DISCLAIMERS</h4>
                                <p>USE OF THE SITE IS AT YOUR SOLE RISK. THE SITE IS PROVIDED ON AN “AS IS” AND
                                    “AS AVAILABLE” BASIS WITHOUT WARRANTIES OF ANY KIND, WHETHER EXPRESS OR
                                    IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF
                                    MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, OR
                                    ACCURACY. INSIGHTACCESS AND CXS ANALYTICS SDN BHD DO NOT WARRANT THAT THE
                                    SITE WILL BE UNINTERRUPTED, ERROR-FREE, SECURE, OR VIRUS-FREE, OR THAT
                                    INFORMATION WILL BE ACCURATE OR TIMELY. DOWNLOADING ANY CONTENT IS AT YOUR
                                    SOLE RISK AND YOU ARE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER
                                    SYSTEM OR LOSS OF DATA.</p>
                                <h4>LIMITATION OF LIABILITY</h4>
                                <p>NEITHER INSIGHTACCESS, CXS ANALYTICS SDN BHD, NOR THEIR AFFILIATES SHALL BE
                                    LIABLE FOR ANY DIRECT, INDIRECT, PUNITIVE, INCIDENTAL, SPECIAL,
                                    CONSEQUENTIAL, OR OTHER DAMAGES ARISING OUT OF OR RELATED TO THE USE OF THE
                                    SITE, THE INABILITY TO USE THE SITE, OR ANY INFORMATION, PRODUCTS, OR
                                    SERVICES OBTAINED THROUGH THE SITE. USERS AGREE THAT ANY CAUSE OF ACTION
                                    MUST COMMENCE WITHIN SIX (6) MONTHS AFTER THE CAUSE OF ACTION ACCRUES OR IS
                                    PERMANENTLY BARRED.</p>
                                <h4>INDEMNIFICATION</h4>
                                <p>You agree to indemnify, defend, and hold harmless InsightAccess, CXS
                                    Analytics Sdn Bhd, and their Affiliates, officers, directors, employees,
                                    agents, licensors, service providers, subcontractors, and suppliers from any
                                    claim, liability, loss, damage, or expense arising from your use of the
                                    Site, including violations of these Terms of Use. If you cause a technical
                                    disruption, you are responsible for all losses, liabilities, damages, and
                                    expenses resulting from that disruption.</p>
                                <h4>TRADEMARK INFORMATION</h4>
                                <p>“InsightAccess,” the InsightAccess logo, and other marks displayed on the
                                    Site are trademarks of CXS Analytics Sdn Bhd. Other product and company
                                    names and logos may be trademarks of their respective owners. Nothing on the
                                    Site should be construed as granting any license or right to use any
                                    trademarks without prior written permission of the owner.</p>
                                <h4>PERSONAL INFORMATION / PRIVACY</h4>
                                <p>InsightAccess collects, uses, and discloses information regarding your use of
                                    the Site and your personal information in accordance with the Privacy
                                    Notice, which is posted on the Site. The Privacy Notice may be updated from
                                    time to time. By using the Site, you consent to the collection, use, and
                                    disclosure of your personal information in accordance with the Privacy
                                    Notice as it then reads.</p>
                                <h4>LINKS TO OTHER SITES</h4>
                                <p>The Site may contain links to other sites that are independent of
                                    InsightAccess and CXS Analytics Sdn Bhd. These links are provided for
                                    convenience only. InsightAccess does not endorse or control these other
                                    sites and is not responsible for their content, privacy practices, or terms
                                    of use. Your use of such sites is at your own risk.</p>
                                <h4>LINKING, FRAMING, MIRRORING, SCRAPING, AND DATA-MINING</h4>
                                <p>Links to the Site without the express written permission of InsightAccess are
                                    strictly prohibited. Framing, mirroring, scraping, or data mining the Site
                                    or its content in any form is strictly prohibited.</p>
                                <h4>JURISDICTION</h4>
                                <p>This Site is controlled and operated by CXS Analytics Sdn Bhd from its
                                    offices in Malaysia. While the Site may be accessible from other
                                    jurisdictions, accessing the Site from any territory where its content is
                                    illegal is prohibited. By using the Site, you agree that the laws of
                                    Malaysia govern these Terms of Use and any use of the Site. Any disputes
                                    arising under these Terms of Use shall be subject to the exclusive
                                    jurisdiction of the courts located in Malaysia.</p>
                                <p>If arbitration or any alternative dispute resolution mechanism is preferred,
                                    the parties agree that any controversy or claim arising out of these Terms
                                    of Use shall be settled by arbitration in accordance with a mutually agreed
                                    upon arbitration process, and judgment on the award may be entered in any
                                    court with jurisdiction. Notwithstanding the foregoing, you or CXS Analytics
                                    Sdn Bhd may seek injunctive relief from a court of competent jurisdiction
                                    prior to or during the arbitration.</p>
                                <h4>COMPLAINTS</h4>
                                <p>Please report any violations of these Terms of Use to [Insert Contact Email].
                                    CXS Analytics Sdn Bhd will investigate and may cooperate with law
                                    enforcement if criminal activity is suspected.</p>
                                <h4>VIOLATION AND WAIVER</h4>
                                <p>Any violations of these Terms of Use may result in legal or equitable
                                    remedies. If we fail to enforce any right or provision, that does not
                                    constitute a waiver of such right or provision.<br />If any part of these
                                    Terms of Use is deemed invalid, the remainder shall be enforceable, and the
                                    court shall give effect to the parties’ intentions as reflected in any
                                    invalid or unenforceable provision.</p>
                                <h4>BY USING THIS SITE, YOU CONSENT TO THE REAL-TIME COLLECTION, STORAGE, USE,
                                    AND SHARING OF INFORMATION ON YOUR DEVICE OR PROVIDED BY YOU (SUCH AS MOUSE
                                    MOVEMENTS AND CLICKS) BY CXS ANALYTICS SDN BHD AND/OR ITS THIRD-PARTY
                                    PROVIDERS.</h4>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-privacy" role="tabpanel" aria-labelledby="v-pills-privacy-tab"
                        tabindex="0">
                        <div>
                            <div class="terms-use-header">
                                <h2>Privacy Notice</h2>
                                <div class="modal-time-update"><iconify-icon icon="mingcute:time-line" width="16"
                                        height="16" style="color: #F7941C;"></iconify-icon>Last
                                    Updated: 13 December 2024</div>
                            </div>
                            <div class="terms-use">
                                <p>This CXS Analytics Sdn Bhd Global Privacy Notice (“Privacy Notice”) provides
                                    a framework of understanding about the personal data that is collected by
                                    CXS Analytics Sdn Bhd and its subsidiaries and affiliates (each separately
                                    and/or jointly called the "Data Controller"). Personal data collected by the
                                    Data Controller will be processed and protected in accordance with the terms
                                    of this Privacy Notice.</p>
                                <p style="margin: 0">This Privacy Notice applies to:</p>
                                <ol>
                                    <li>Our job candidates and individuals who receive our career services;</li>
                                    <li>Our associates, meaning individuals we source, place on assignment with
                                        one of our clients, or to whom we provide outplacement or career
                                        transition services;</li>
                                    <li>Users of our websites and applications related to our InsightAccess
                                        platform (“Sites”); and</li>
                                    <li>Representatives of our business partners, clients, and vendors.</li>
                                </ol>
                                <p>This Privacy Notice does not apply to individuals employed directly by CXS
                                    Analytics Sdn Bhd in its headquarters or other offices, who may be covered
                                    by separate policies.<br />This Privacy Notice describes the types of
                                    personal data we collect, how we use and protect that data, how long we
                                    store it, with whom we share it, and the rights that individuals can
                                    exercise regarding our use of their personal data. It also describes how you
                                    can contact us about our privacy practices and exercise your rights. Our
                                    practices conform to applicable laws and regulations in Malaysia, including
                                    the Personal Data Protection Act 2010 (PDPA).</p>
                                <div class="accordion custom-accordion pb-9 pt-3" id="customAccordion">
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseOne" aria-expanded="false"
                                                aria-controls="CollapseOne">
                                                <span class="icon">+</span>
                                                INFORMATION WE COLLECT
                                            </button>
                                        </h4>
                                        <div id="CollapseOne" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p style="margin: 0;">We collect personal data about you in various ways,
                                                    such
                                                    as through our Sites, social media channels, at events, via phone or
                                                    fax,
                                                    through job applications and in-person recruitment, and in connection
                                                    with
                                                    our interactions with clients and vendors. The personal data we may
                                                    collect
                                                    (as permitted under local law) includes:</p>
                                                <ul>
                                                    <li>Contact information (e.g., name, postal address, email address,
                                                        telephone number)</li>
                                                    <li>Username and password when you register on our Sites</li>
                                                    <li>Information you provide about friends or others you would like us to
                                                        contact (upon confirming their consent)</li>
                                                    <li>Other information you may provide to us (e.g., via surveys or
                                                        “Contact
                                                        Us” forms)</li>
                                                </ul>
                                                <p style="margin: 0;">If you are an associate or job candidate, or apply
                                                    for a
                                                    position, we may also collect:</p>
                                                <ul>
                                                    <li>Employment and education history</li>
                                                    <li>Language proficiencies and work-related skills</li>
                                                    <li>Government-issued identification numbers (e.g., NRIC)</li>
                                                    <li>Date of birth and gender</li>
                                                    <li>Bank account information</li>
                                                    <li>Citizenship and work authorization status</li>
                                                    <li>Benefits and tax-related information</li>
                                                    <li>Information provided by references</li>
                                                    <li>Information contained in your resume or CV and details about your
                                                        career
                                                        interests and qualifications</li>
                                                </ul>
                                                <p style="margin: 0;">Where required by applicable law and with your
                                                    explicit
                                                    consent, we may collect:</p>
                                                <ul>
                                                    <li>Disabilities and health-related information</li>
                                                    <li>Results of drug tests, criminal or other background checks</li>
                                                </ul>
                                                <p>We may also collect information about other individuals (e.g., emergency
                                                    contacts) you provide to us, acknowledging that you have obtained their
                                                    consent to do so.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseTwo" aria-expanded="false"
                                                aria-controls="CollapseTwo">
                                                <span class="icon">+</span>
                                                HOW WE USE THE INFORMATION WE COLLECT
                                            </button>
                                        </h4>
                                        <div id="CollapseTwo" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p style="margin: 0;">The Data Controller may use the personal data (as
                                                    permitted under local law) for the following purposes:</p>
                                                <ul>
                                                    <li>Providing workforce solutions and connecting individuals to
                                                        employment
                                                        opportunities</li>
                                                    <li>Creating and managing online accounts</li>
                                                    <li>Processing payments</li>
                                                    <li>Managing business partner, client, and vendor relationships</li>
                                                    <li>Sending promotional materials, job alerts, and other communications
                                                        (where permitted by law)</li>
                                                    <li>Administering participation in events, promotions, programs, offers,
                                                        surveys, contests, and market research (where permitted by law)</li>
                                                    <li>Responding to inquiries and claims</li>
                                                    <li>Operating, evaluating, and improving our business, including data
                                                        analytics, communications management, and internal functions such as
                                                        accounting and auditing</li>
                                                    <li>Protecting against, identifying, and preventing fraud and other
                                                        unlawful
                                                        activities</li>
                                                    <li>Complying with and enforcing applicable legal requirements,
                                                        contractual
                                                        obligations, and our policies</li>
                                                </ul>
                                                <p style="margin: 0;">If you are an associate or job candidate, these
                                                    purposes
                                                    include:</p>
                                                <ul>
                                                    <li>Providing job placement, outplacement, and career transition
                                                        services
                                                    </li>
                                                    <li>Offering HR services such as payroll, benefits administration,
                                                        performance management, and training</li>
                                                    <li>Assessing your qualifications for positions</li>
                                                    <li>Performing data analytics related to workforce trends, skill sets,
                                                        and
                                                        employment opportunities</li>
                                                </ul>
                                                <p>We may also use your information for other purposes disclosed to you at
                                                    the
                                                    time of collection or with your consent.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseThree" aria-expanded="false"
                                                aria-controls="CollapseThree">
                                                <span class="icon">+</span>
                                                USE OF AUTOMATED DATA COLLECTION METHODS
                                            </button>
                                        </h4>
                                        <div id="CollapseThree" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p>When you visit our Sites, we may collect information by automated means
                                                    using
                                                    technologies such as cookies, web beacons, and server logs. This may
                                                    include
                                                    IP addresses, browser characteristics, device IDs, operating systems,
                                                    language preferences, referring URLs, actions on our Sites, and times of
                                                    visits. We use these automated means to:</p>
                                                <ul>
                                                    <li>Customize user experiences on our Sites</li>
                                                    <li>Deliver content tailored to user interests</li>
                                                    <li>Manage and improve our Sites and business operations</li>
                                                </ul>
                                                <p>Your browser settings may allow you to limit or disable certain cookies.
                                                    However, some features of our Sites may not function without them.</p>
                                                <p>Third-party analytics services may also use automated means to collect
                                                    data
                                                    regarding your use of our Sites, subject to their privacy policies. CXS
                                                    Analytics Sdn Bhd is not responsible for these third-party practices.
                                                    Where
                                                    required by law, we will seek your consent before using cookies or
                                                    similar
                                                    technologies.</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseTen" aria-expanded="false"
                                                aria-controls="CollapseTen">
                                                <span class="icon">+</span>
                                                LEGITIMATE INTERESTS
                                            </button>
                                        </h4>
                                        <div id="CollapseTen" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p>The Data Controller may process your personal data for legitimate
                                                    business
                                                    purposes, such as improving our services, preventing fraud, enhancing
                                                    security, understanding site usage, direct marketing, and evaluating the
                                                    effectiveness of promotional campaigns. You have the right to object to
                                                    such
                                                    processing, and we will consider your rights whenever we process data
                                                    for
                                                    legitimate interests.</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseFour" aria-expanded="false"
                                                aria-controls="CollapseFour">
                                                <span class="icon">+</span>
                                                DATA PROCESSING AND SECURITY
                                            </button>
                                        </h4>
                                        <div id="CollapseFour" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p>We process personal data for only as long as necessary to fulfill the
                                                    purposes described above, consistent with our data retention policies
                                                    and
                                                    applicable laws. We maintain administrative, technical, and physical
                                                    safeguards to protect personal data against unauthorized access,
                                                    alteration,
                                                    disclosure, or misuse. Security measures may include encryption of data
                                                    in
                                                    transit, strong user authentication, and network monitoring solutions.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseFive" aria-expanded="false"
                                                aria-controls="CollapseFive">
                                                <span class="icon">+</span>
                                                DATA RETENTION
                                            </button>
                                        </h4>
                                        <div id="CollapseFive" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p style="margin: 0">We retain personal data as long as needed for the
                                                    purposes
                                                    for which it was collected or as required by law. Criteria for
                                                    determining
                                                    retention periods include:</p>
                                                <ul>
                                                    <li>Legal, regulatory, or contractual requirements</li>
                                                    <li>Necessity for business operations and provision of services</li>
                                                    <li>Legitimate interests of the Data Controller (as described above)
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseSix" aria-expanded="false"
                                                aria-controls="CollapseSix">
                                                <span class="icon">+</span>
                                                INFORMATION WE SHARE
                                            </button>
                                        </h4>
                                        <div id="CollapseSix" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p style="margin: 0">We do not disclose personal data except as described
                                                    in
                                                    this Privacy Notice or as permitted by law. We may share personal data
                                                    with:
                                                </p>
                                                <ul>
                                                    <li>Vendors performing services on our behalf (under instructions and
                                                        for
                                                        authorized purposes)</li>
                                                    <li>Our subsidiaries and affiliates</li>
                                                    <li>Clients (if you are a job candidate) to evaluate and consider
                                                        employment
                                                        opportunities</li>
                                                    <li>Business partners, placement consultants, and subcontractors to
                                                        assist
                                                        in finding work opportunities</li>
                                                </ul>
                                                <p style="margin: 0">We may also disclose personal data:</p>
                                                <ul>
                                                    <li>To comply with legal obligations or requests by authorities</li>
                                                    <li>To prevent physical harm or financial loss, or investigate suspected
                                                        illegal activity</li>
                                                    <li>In connection with a sale or transfer of our business or assets
                                                        (including reorganizations, dissolutions, or liquidations)</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseSeven" aria-expanded="false"
                                                aria-controls="CollapseSeven">
                                                <span class="icon">+</span>
                                                DATA TRANSFERS
                                            </button>
                                        </h4>
                                        <div id="CollapseSeven" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p>Your personal data may be transferred outside of Malaysia, subject to
                                                    appropriate safeguards and in compliance with applicable laws. By
                                                    providing
                                                    personal data, you consent to these transfers and processing in
                                                    accordance
                                                    with this Privacy Notice.</p>
                                                <h4>YOUR RIGHTS</h4>
                                                <p style="margin: 0">Subject to applicable local law (including the PDPA),
                                                    you
                                                    may have the right to:</p>
                                                <ul>
                                                    <li>Access the personal data we hold about you</li>
                                                    <li>Request correction of inaccurate or incomplete data</li>
                                                    <li>Request erasure of your data</li>
                                                    <li>Request restrictions on data processing</li>
                                                    <li>Object to data processing for specific reasons</li>
                                                    <li>Withdraw consent previously given</li>
                                                </ul>
                                                <p>To exercise these rights, please contact us using the contact information
                                                    provided below. Please note that withdrawing consent or objecting to
                                                    certain
                                                    processing activities may affect our ability to provide certain services
                                                    to
                                                    you.</p>
                                                <h4>UPDATES TO OUR PRIVACY NOTICE</h4>
                                                <p>We may update this Privacy Notice periodically to reflect changes in our
                                                    practices and legal requirements. For significant changes, we will post
                                                    a
                                                    prominent notice on our Sites indicating when it was most recently
                                                    updated.
                                                </p>
                                                <h4>HOW TO CONTACT US</h4>
                                                <p>If you have any questions or comments about this Privacy Notice, or if
                                                    you
                                                    would like to exercise your rights, please contact:</p>
                                                <p>CXS Analytics Sdn Bhd<br />A-37-7&8 Menara UOA Bangsar<br />5 Jalan
                                                    Bangsar
                                                    Utama 1, 59000 Kuala Lumpur<br />Attn: Data Protection
                                                    Officer<br />Email:
                                                    data.prvc@cxsanalytics.com</p>
                                                <p>If you are located in Malaysia and have further questions, you may
                                                    contact
                                                    the Data Protection Officer at the above address or email for assistance
                                                    in
                                                    exercising your rights under the PDPA.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseEight" aria-expanded="false"
                                                aria-controls="CollapseEight">
                                                <span class="icon">+</span>
                                                YOUR RIGHTS
                                            </button>
                                        </h4>
                                        <div id="CollapseEight" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p style="margin: 0">Subject to applicable local law (including the PDPA),
                                                    you
                                                    may have the right to:</p>
                                                <ul>
                                                    <li>Access the personal data we hold about you</li>
                                                    <li>Request correction of inaccurate or incomplete data</li>
                                                    <li>Request erasure of your data</li>
                                                    <li>Request restrictions on data processing</li>
                                                    <li>Object to data processing for specific reasons</li>
                                                    <li>Withdraw consent previously given</li>
                                                </ul>
                                                <p>To exercise these rights, please contact us using the contact information
                                                    provided below. Please note that withdrawing consent or objecting to
                                                    certain
                                                    processing activities may affect our ability to provide certain services
                                                    to
                                                    you.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#CollapseNine" aria-expanded="false"
                                                aria-controls="CollapseNine">
                                                <span class="icon">+</span>
                                                UPDATES TO OUR PRIVACY NOTICE
                                            </button>
                                        </h4>
                                        <div id="CollapseNine" class="accordion-collapse collapse"
                                            data-bs-parent="#customAccordion">
                                            <div class="accordion-body">
                                                <p>We may update this Privacy Notice periodically to reflect changes in our
                                                    practices and legal requirements. For significant changes, we will post
                                                    a
                                                    prominent notice on our Sites indicating when it was most recently
                                                    updated.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4>HOW TO CONTACT US</h4>
                                <p>If you have any questions or comments about this Privacy Notice, or if you
                                    would like to exercise your rights, please contact:</p>
                                <p>CXS Analytics Sdn Bhd<br />A-37-7&8 Menara UOA Bangsar<br />5 Jalan Bangsar
                                    Utama 1, 59000 Kuala Lumpur<br />Attn: Data Protection Officer<br />Email:
                                    data.prvc@cxsanalytics.com</p>
                                <p>If you are located in Malaysia and have further questions, you may contact
                                    the Data Protection Officer at the above address or email for assistance in
                                    exercising your rights under the PDPA.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-cookie" role="tabpanel" aria-labelledby="v-pills-cookie-tab"
                        tabindex="0">
                        <div>
                            <div class="terms-use-header">
                                <h2>Cookie Notice</h2>
                                <div class="modal-time-update"><iconify-icon icon="mingcute:time-line" width="16"
                                        height="16" style="color: #F7941C;"></iconify-icon>Last
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
                    <div class="tab-pane fade" id="v-pills-statement" role="tabpanel"
                        aria-labelledby="v-pills-statement-tab" tabindex="0">
                        <div>
                            <div class="terms-use-header">
                                <h2>Accessibility Statement</h2>
                                <div class="modal-time-update"><iconify-icon icon="mingcute:time-line" width="16"
                                        height="16" style="color: #F7941C;"></iconify-icon>Last
                                    Updated: 13 December 2024</div>
                            </div>
                            <div class="terms-use link-a">
                                <p>CXS Analytics Sdn Bhd is committed to accessibility, diversity, and inclusion. We believe
                                    in ensuring
                                    that all content and functionality available on the InsightAccess platform are
                                    accessible to everyone,
                                    regardless of disabilities.</p>
                                <p>We follow the Web Content Accessibility Guidelines (WCAG) 2.1, developed by the World
                                    Wide Web Consortium
                                    <a href="https://www.w3.org/" target="_blank"><b>(W3C)</b></a>. WCAG 2.1 is a
                                    recognized global standard for web accessibility. Our goal is to meet or exceed
                                    Level A and Level AA success criteria to provide an inclusive online experience for all
                                    users.
                                </p>
                                <p>Each time you use the Site, the then-current version of these Terms of Use
                                    will govern your use. Accordingly, when you use the Site, you should check
                                    the date of these Terms of Use and review any changes since the last
                                    version.</p>
                                <p>If you experience any difficulty accessing any part of our platform, or if you would like
                                    to share
                                    feedback on how we can improve website accessibility related to our jobs, tools,
                                    content, or features,
                                    please contact us:</p>
                                <h4>Contact Information</h4>
                                <p>CXS Analytics Sdn Bhd<br />A-37-7&8 Menara UOA Bangsar<br />5 Jalan Bangsar
                                    Utama 1, 59000 Kuala Lumpur<br />Attn: Data Protection Officer<br />Email:
                                    data.prvc@cxsanalytics.com</p>
                                <p>CXS Analytics Sdn Bhd is committed to addressing accessibility issues and improving the
                                    usability of our
                                    platform to ensure a positive experience for all visitors.</p>
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
        // Listen for the tab change event
        const breadcrumbLast = document.getElementById("breadcrumb-last");
        const profileTab = document.getElementById("v-pills-privacy-tab");

        // Add event listener for tab shown
        document.getElementById("v-pills-tab").addEventListener("shown.bs.tab", function(event) {
            const breadcrumbLast = document.getElementById("breadcrumb-last");

            switch (event.target.id) {
                case "v-pills-terms-tab":
                    breadcrumbLast.textContent = "Terms of Use";
                    break;
                case "v-pills-privacy-tab":
                    breadcrumbLast.textContent = "Privacy Notice";
                    break;
                case "v-pills-cookie-tab":
                    breadcrumbLast.textContent = "Cookie Notice";
                    break;
                case "v-pills-statement-tab":
                    breadcrumbLast.textContent = "Accessibility Statement";
                    break;
                default:
                    breadcrumbLast.textContent = "Terms of Use"; // Default or fallback
                    break;
            }
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
