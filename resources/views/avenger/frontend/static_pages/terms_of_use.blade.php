@extends('avenger.layouts.app')

@section('title', 'Terms of Use')
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
                    Terms of Use
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
                        Terms of Use</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="terms-use-header">
                <h2>Terms of Use</h2>
                <div class="modal-time-update"><iconify-icon icon="mingcute:time-line" width="16" height="16"
                        style="color: #F7941C;"></iconify-icon>Last
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
@endsection
