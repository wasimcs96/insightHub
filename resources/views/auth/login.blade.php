
  @extends('auth.layouts.app')
  @section('styles')
  <style>
    .terms-container {
        display: flex;
        align-items: center;
    }

    .terms-container input[type="checkbox"] {
        margin-right: 8px;
        width: 16px;
        height: 16px;
        accent-color: #F7941C;
    }

    .terms-container label {
        color: #000;
        line-height: 1.5;
    }

    .terms-container .terms-link {
        color: #000;
        text-decoration: underline;
        font-weight: bold;
        cursor: pointer;
        text-underline-offset: 5px;
    }

    .terms-container .terms-link:hover {
        text-decoration: none;
    }

    .modal-footer {
        justify-content: center;
        gap: 8px;
        padding: 16px 0px;
    }

    .modal-header {
        display: block;
        padding: 30px 26px 20px 26px;
    }

    .modal-title {
        color: #071437;
        font-size: 32.5px;
        font-style: normal;
        font-weight: 700;
        line-height: 39px;
    }

    .modal-header,
    .modal-footer {
        border: none;
    }

    .terms-use {
        height: 50vh;
        overflow: scroll;
        padding-bottom: 30px;
    }

    .terms-use h3 {
        color: #071437;
        font-size: 16.25px;
        font-style: normal;
        font-weight: 700;
        line-height: 19.5px;
        border-bottom: 1px solid #DBDFE9;
        padding: 12px 0px;
        margin-bottom: 16px;
    }

    .terms-use h4 {
        color: #071437;
        font-size: 14px;
        font-style: normal;
        font-weight: 600;
        line-height: 20px;
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

    .modal-body {
        padding: 0px 20px;
    }

    .modal-footer .btn-decline {
        background-color: #fff !important;
        border: 1px solid #F7941C !important;
        color: #F7941C !important;
    }

    .modal-footer .btn-secondary {
        border: 1px solid #99A1B7 !important;
    }

    .modal-footer .btn-decline:hover {
        color: #F7941C !important;
    }

    .modal-footer .btn {
        padding: 8px 16px !important;
    }
</style>
@endsection
  
  <!--begin::Authentication - Two-factor -->
  @section('content')
  <div class="d-flex flex-column flex-lg-row flex-column-fluid">
      <!--begin::Body-->
      <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1" style="width: 100%;">
          <!--begin::Form-->
          <div class="d-flex flex-center flex-column flex-lg-row-fluid">
              <!--begin::Wrapper-->
              <div class="w-100 p-10">

                   @php
                        use Illuminate\Support\Facades\Storage;
                        
                        use App\Models\MasterGeneralSetting;

                        $logo = MasterGeneralSetting::where('name', 'logo')->first();
                        $logoPath = $logo?->value;
                    @endphp
                   @if ($logoPath && Storage::disk('public')->exists($logoPath))
                        <a href="#" class="d-flex justify-content-center mb-5 mb-lg-10">
                            <img class="h-50px h-lg-70px" src="{{ asset('storage/' . $logoPath) }}" alt="Logo">
                        </a>
                    @endif
                    
                  <a href="#" class="d-flex justify-content-center mb-5 mb-lg-5">
                      <img alt="Logo" src="{{ asset('media/insightaccess.png') }}" class="h-40px h-lg-50px" />
                  </a>
                  <!--begin::Form-->
                  <form class="form w-100" action="{{ route('login') }}" method="post">
                      @csrf
                      <!--begin::Heading-->
                      <div class="text-center mb-11">
                          <!--begin::Subtitle-->
                          <div class="text-gray-500 fw-semibold fs-6">
                              Transform Your Talent - Start Now
                          </div>
                          <!--end::Subtitle--->
                      </div>
                      <!--begin::Heading-->
  
                      <!--begin::Input group-->
                      <div class="fv-row mb-8">
                          <!--begin::Email-->
                          <input type="email" name="email" placeholder="Email" autocomplete="off"
                              class="form-control bg-transparent @error('email') is-invalid @enderror"
                              value="{{ old('email') }}" required />
                          @error('email')
                              <div class="invalid-feedback text-red-500">
                                  {{ $message }}
                              </div>
                          @enderror
                          <!--end::Email-->
                      </div>
  
                      <div class="fv-row mb-3">
                          <!--begin::Password-->
                          <input type="password" placeholder="Password" name="password" autocomplete="off"
                              class="form-control bg-transparent @error('password') is-invalid @enderror" />
                          @error('password')
                              <div class="invalid-feedback text-red-500">
                                  {{ $message }}
                              </div>
                          @enderror
                          <!--end::Password-->
                      </div>
  
                      <!--end::Input group-->
                       <!-- reCAPTCHA Widget -->
                          <div>
                              {!! NoCaptcha::display() !!}
                          </div>
  
                          @if ($errors->has('g-recaptcha-response'))
                              <div style="color: red;">
                                  <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                              </div>
                          @endif

                          <div class="terms-container mb-8 mt-5">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">
                                I have read, understood, and agree to the
                                <a href="#" class="terms-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Terms of Use & Privacy Notice
                                </a>.
                            </label>
                            <p id="termsError" style="color: red; display: none;">You must agree to the Terms of Use & Privacy Notice.</p>
                        </div>


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title" id="exampleModalLabel">Terms of Use & Privacy Notice</h1>
                                        <div class="modal-time-update">
                                            <iconify-icon icon="mingcute:time-line" width="16" height="16" style="color: #F7941C;"></iconify-icon>
                                            Last Updated: 13 December 2024
                                        </div>
                                    </div>
                                    <div class="modal-body" id="modalBody" style="max-height: 400px; overflow-y: auto;">
                                        <div class="terms-use">
                                            <h3>TERMS OF USE</h3>
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
                                            <h3 style="margin-top: 30px">PRIVACY NOTICE</h3>
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
                                            <h4>INFORMATION WE COLLECT</h4>
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
                                            <h4>HOW WE USE THE INFORMATION WE COLLECT</h4>
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
                                            <h4>USE OF AUTOMATED DATA COLLECTION METHODS</h4>
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
                                            <h4>LEGITIMATE INTERESTS</h4>
                                            <p>The Data Controller may process your personal data for legitimate business
                                                purposes, such as improving our services, preventing fraud, enhancing
                                                security, understanding site usage, direct marketing, and evaluating the
                                                effectiveness of promotional campaigns. You have the right to object to such
                                                processing, and we will consider your rights whenever we process data for
                                                legitimate interests.</p>
                                            <h4>DATA PROCESSING AND SECURITY</h4>
                                            <p>We process personal data for only as long as necessary to fulfill the
                                                purposes described above, consistent with our data retention policies and
                                                applicable laws. We maintain administrative, technical, and physical
                                                safeguards to protect personal data against unauthorized access, alteration,
                                                disclosure, or misuse. Security measures may include encryption of data in
                                                transit, strong user authentication, and network monitoring solutions.</p>
                                            <h4>DATA RETENTION</h4>
                                            <p style="margin: 0">We retain personal data as long as needed for the purposes
                                                for which it was collected or as required by law. Criteria for determining
                                                retention periods include:</p>
                                            <ul>
                                                <li>Legal, regulatory, or contractual requirements</li>
                                                <li>Necessity for business operations and provision of services</li>
                                                <li>Legitimate interests of the Data Controller (as described above)</li>
                                            </ul>
                                            <h4>INFORMATION WE SHARE</h4>
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
                                            <h4>DATA TRANSFERS</h4>
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
                                            <h4 id="contactUsSection">HOW TO CONTACT US</h4>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-decline" data-bs-dismiss="modal">Decline</button>
                                        <button type="button" class="btn btn-secondary" id="agreeDisabled" disabled>Agree</button>
                                        <button type="button" class="btn btn-secondary" id="agreeButton" style="display: none" onclick="agreeToTerms()">Agree</button>
                                    </div>
                                                                      
                                </div>
                            </div>
                        </div>
  
  
                      <!--begin::Wrapper-->
                      <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                          <div></div>
                          <!--begin::Link-->
                          @if (Route::has('password.request'))
                              <a class="link-primary" href="{{ route('password.request') }}">
                                  {{ __('Forgot Your Password?') }}
                              </a>
                          @endif
                          <!--end::Link-->
                      </div>
                      <!--end::Wrapper-->
  
                      <!--begin::Submit button-->
                      <div class="d-grid mb-10">
                          <button type="submit" class="btn btn-primary" style="background-color: #F7941C;">
                              <!--begin::Indicator label-->
                              <span class="indicator-label">
                                  Sign In
                              </span>
                              <!--end::Indicator label-->
                              <!--begin::Indicator progress-->
                              <span class="indicator-progress">
                                  Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                              </span>
                              <!--end::Indicator progress-->
                          </button>
                      </div>
                      <!--end::Submit button-->
  
                      <!--begin::Sign up-->
                      <div class="text-gray-500 text-center fw-semibold fs-6">
                          Not a Member yet?
                          <a href="/register" class="link-primary">
                              Sign up
                          </a>
                      </div>
                      <!--end::Sign up-->
                  </form>
                  <!--end::Form-->
                  <!--begin::Footer Notice-->
                  <div class="text-gray-500 fw-semibold fs-11 mt-10 text-center">
                    @php
                
                    $year = MasterGeneralSetting::where('name', 'year')->first();
                @endphp
                
                <span>
                    Copyright © 2017-{{ $year ? $year->value : date('Y') }} CXS Analytics Sdn. Bhd. All Rights Reserved.
                </span>
                
                      <br />
                      <span>No part of this website may be reproduced, distributed, or transmitted in any form or by any means, including photocopying, recording, or other electronic or mechanical methods, without the prior written permission of the owner.</span>
                      <br>
 
 
                        <br>
                        <br>
                       
 
 
                        <span class="text-dark fw-bolder text-center">Terms of Use </span>
                        <br>
 
 
                        By accessing and using this website, you accept and agree to be bound by the terms and provisions of this agreement. Additionally, when using specific services of this website, you shall be subject to any posted guidelines or rules applicable to such services which may be posted and modified at any time. All such guidelines or rules are hereby incorporated by reference into the Terms of Use.
 
                       
 
                        Your participation in this site will constitute acceptance of this agreement. If you do not agree to abide by the above, please do not use this site.
                  </div>
                  <!--end::Footer Notice-->
              </div>
              <!--end::Wrapper-->
          </div>
          <!--end::Form-->
      </div>
      <!--end::Body-->
  
      <!--begin::Aside-->
      <div class="d-none d-lg-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
          style="background-image: url({{ asset('media/login-bg.png') }})">
          <!--begin::Content-->
          <div class="d-flex flex-column py-7 py-lg-15 px-5 px-md-15 w-100">
              <!--begin::Title-->
              <h1 class="fs-2qx fw-bolder text-left mb-7" style="color:#F7941C;">
                  Discover Your Potential:<br> Empowering Careers Through Insightful Assessment
              </h1>
              <!--end::Title-->
          </div>
          <!--end::Content-->
      </div>
      <!--end::Aside-->
  </div>
  <!--end::Authentication - Sign-in-->
  @endsection
  <!--end::Authentication - Two-factor -->
  
  @section('scripts')
  {!! NoCaptcha::renderJs() !!}
  
  <script>
      document.getElementById("loginForm").addEventListener("submit", function (event) {
          var termsCheckbox = document.getElementById("terms");
          var termsError = document.getElementById("termsError");
      
          if (!termsCheckbox.checked) {
              event.preventDefault(); // Prevent form submission
              termsError.style.display = "block"; // Show error message
          } else {
              termsError.style.display = "none"; // Hide error message
          }
      });
  </script>
  
  <script>
      document.addEventListener("DOMContentLoaded", function () {
          const modalBody = document.getElementById("modalBody");
          const agreeButton = document.getElementById("agreeButton");
          const agreeDisabled = document.getElementById("agreeDisabled");
          const contactSection = document.getElementById("contactUsSection");
      
          // Function to enable and show the Agree button
          function enableAgreeButton(entries) {
              entries.forEach(entry => {
                  if (entry.isIntersecting) {
                      agreeButton.removeAttribute("disabled"); // Enable button
                      agreeButton.classList.remove("btn-secondary");
                      agreeButton.classList.add("btn-primary"); // Highlight it
                      agreeButton.style.display = "block"; // Show the button
                      agreeDisabled.style.display = "none"; // Hide the disabled button
                  }
              });
          }
      
          // Initialize Intersection Observer
          const observer = new IntersectionObserver(enableAgreeButton, {
              root: modalBody,
              threshold: 0.5, // Triggers when at least 50% of the section is visible
          });
      
          // Observe the "HOW TO CONTACT US" section
          observer.observe(contactSection);
      });
      
      // Function to handle clicking "Agree"
      function agreeToTerms() {
          document.getElementById("terms").checked = true;
      
          // Close the modal
          const modalElement = document.getElementById("exampleModal");
          const modalInstance = bootstrap.Modal.getInstance(modalElement);
          if (modalInstance) {
              modalInstance.hide();
          }
      }
      </script>
      
  
  @endsection
  