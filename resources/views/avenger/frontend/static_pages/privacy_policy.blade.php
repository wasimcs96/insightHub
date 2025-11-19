@extends('avenger.layouts.app')

@section('title', 'Privacy Policy')
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
                    Privacy Notice
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
                        Privacy Notice</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="terms-use-header">
                <h2>Privacy Notice</h2>
                <div class="modal-time-update"><iconify-icon icon="mingcute:time-line" width="16" height="16"
                        style="color: #F7941C;"></iconify-icon>Last
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
                                data-bs-target="#CollapseOne" aria-expanded="false" aria-controls="CollapseOne">
                                <span class="icon">+</span>
                                INFORMATION WE COLLECT
                            </button>
                        </h4>
                        <div id="CollapseOne" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                            <div class="accordion-body">
                                <p style="margin: 0;">We collect personal data about you in various ways, such
                                    as through our Sites, social media channels, at events, via phone or fax,
                                    through job applications and in-person recruitment, and in connection with
                                    our interactions with clients and vendors. The personal data we may collect
                                    (as permitted under local law) includes:</p>
                                <ul>
                                    <li>Contact information (e.g., name, postal address, email address,
                                        telephone number)</li>
                                    <li>Username and password when you register on our Sites</li>
                                    <li>Information you provide about friends or others you would like us to
                                        contact (upon confirming their consent)</li>
                                    <li>Other information you may provide to us (e.g., via surveys or “Contact
                                        Us” forms)</li>
                                </ul>
                                <p style="margin: 0;">If you are an associate or job candidate, or apply for a
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
                                    <li>Information contained in your resume or CV and details about your career
                                        interests and qualifications</li>
                                </ul>
                                <p style="margin: 0;">Where required by applicable law and with your explicit
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
                                data-bs-target="#CollapseTwo" aria-expanded="false" aria-controls="CollapseTwo">
                                <span class="icon">+</span>
                                HOW WE USE THE INFORMATION WE COLLECT
                            </button>
                        </h4>
                        <div id="CollapseTwo" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                            <div class="accordion-body">
                                <p style="margin: 0;">The Data Controller may use the personal data (as
                                    permitted under local law) for the following purposes:</p>
                                <ul>
                                    <li>Providing workforce solutions and connecting individuals to employment
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
                                    <li>Protecting against, identifying, and preventing fraud and other unlawful
                                        activities</li>
                                    <li>Complying with and enforcing applicable legal requirements, contractual
                                        obligations, and our policies</li>
                                </ul>
                                <p style="margin: 0;">If you are an associate or job candidate, these purposes
                                    include:</p>
                                <ul>
                                    <li>Providing job placement, outplacement, and career transition services
                                    </li>
                                    <li>Offering HR services such as payroll, benefits administration,
                                        performance management, and training</li>
                                    <li>Assessing your qualifications for positions</li>
                                    <li>Performing data analytics related to workforce trends, skill sets, and
                                        employment opportunities</li>
                                </ul>
                                <p>We may also use your information for other purposes disclosed to you at the
                                    time of collection or with your consent.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#CollapseThree" aria-expanded="false" aria-controls="CollapseThree">
                                <span class="icon">+</span>
                                USE OF AUTOMATED DATA COLLECTION METHODS
                            </button>
                        </h4>
                        <div id="CollapseThree" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                            <div class="accordion-body">
                                <p>When you visit our Sites, we may collect information by automated means using
                                    technologies such as cookies, web beacons, and server logs. This may include
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
                                <p>Third-party analytics services may also use automated means to collect data
                                    regarding your use of our Sites, subject to their privacy policies. CXS
                                    Analytics Sdn Bhd is not responsible for these third-party practices. Where
                                    required by law, we will seek your consent before using cookies or similar
                                    technologies.</p>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#CollapseTen" aria-expanded="false" aria-controls="CollapseTen">
                                <span class="icon">+</span>
                                LEGITIMATE INTERESTS
                            </button>
                        </h4>
                        <div id="CollapseTen" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                            <div class="accordion-body">
                                <p>The Data Controller may process your personal data for legitimate business
                                    purposes, such as improving our services, preventing fraud, enhancing
                                    security, understanding site usage, direct marketing, and evaluating the
                                    effectiveness of promotional campaigns. You have the right to object to such
                                    processing, and we will consider your rights whenever we process data for
                                    legitimate interests.</p>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#CollapseFour" aria-expanded="false" aria-controls="CollapseFour">
                                <span class="icon">+</span>
                                DATA PROCESSING AND SECURITY
                            </button>
                        </h4>
                        <div id="CollapseFour" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                            <div class="accordion-body">
                                <p>We process personal data for only as long as necessary to fulfill the
                                    purposes described above, consistent with our data retention policies and
                                    applicable laws. We maintain administrative, technical, and physical
                                    safeguards to protect personal data against unauthorized access, alteration,
                                    disclosure, or misuse. Security measures may include encryption of data in
                                    transit, strong user authentication, and network monitoring solutions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#CollapseFive" aria-expanded="false" aria-controls="CollapseFive">
                                <span class="icon">+</span>
                                DATA RETENTION
                            </button>
                        </h4>
                        <div id="CollapseFive" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                            <div class="accordion-body">
                                <p style="margin: 0">We retain personal data as long as needed for the purposes
                                    for which it was collected or as required by law. Criteria for determining
                                    retention periods include:</p>
                                <ul>
                                    <li>Legal, regulatory, or contractual requirements</li>
                                    <li>Necessity for business operations and provision of services</li>
                                    <li>Legitimate interests of the Data Controller (as described above)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#CollapseSix" aria-expanded="false" aria-controls="CollapseSix">
                                <span class="icon">+</span>
                                INFORMATION WE SHARE
                            </button>
                        </h4>
                        <div id="CollapseSix" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                            <div class="accordion-body">
                                <p style="margin: 0">We do not disclose personal data except as described in
                                    this Privacy Notice or as permitted by law. We may share personal data with:
                                </p>
                                <ul>
                                    <li>Vendors performing services on our behalf (under instructions and for
                                        authorized purposes)</li>
                                    <li>Our subsidiaries and affiliates</li>
                                    <li>Clients (if you are a job candidate) to evaluate and consider employment
                                        opportunities</li>
                                    <li>Business partners, placement consultants, and subcontractors to assist
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
                                data-bs-target="#CollapseSeven" aria-expanded="false" aria-controls="CollapseSeven">
                                <span class="icon">+</span>
                                DATA TRANSFERS
                            </button>
                        </h4>
                        <div id="CollapseSeven" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                            <div class="accordion-body">
                                <p>Your personal data may be transferred outside of Malaysia, subject to
                                    appropriate safeguards and in compliance with applicable laws. By providing
                                    personal data, you consent to these transfers and processing in accordance
                                    with this Privacy Notice.</p>
                                <h4>YOUR RIGHTS</h4>
                                <p style="margin: 0">Subject to applicable local law (including the PDPA), you
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
                                    provided below. Please note that withdrawing consent or objecting to certain
                                    processing activities may affect our ability to provide certain services to
                                    you.</p>
                                <h4>UPDATES TO OUR PRIVACY NOTICE</h4>
                                <p>We may update this Privacy Notice periodically to reflect changes in our
                                    practices and legal requirements. For significant changes, we will post a
                                    prominent notice on our Sites indicating when it was most recently updated.
                                </p>
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
                    <div class="accordion-item">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#CollapseEight" aria-expanded="false" aria-controls="CollapseEight">
                                <span class="icon">+</span>
                                YOUR RIGHTS
                            </button>
                        </h4>
                        <div id="CollapseEight" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                            <div class="accordion-body">
                                <p style="margin: 0">Subject to applicable local law (including the PDPA), you
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
                                    provided below. Please note that withdrawing consent or objecting to certain
                                    processing activities may affect our ability to provide certain services to
                                    you.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#CollapseNine" aria-expanded="false" aria-controls="CollapseNine">
                                <span class="icon">+</span>
                                UPDATES TO OUR PRIVACY NOTICE
                            </button>
                        </h4>
                        <div id="CollapseNine" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                            <div class="accordion-body">
                                <p>We may update this Privacy Notice periodically to reflect changes in our
                                    practices and legal requirements. For significant changes, we will post a
                                    prominent notice on our Sites indicating when it was most recently updated.
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

@endsection
