@if (($user->is_personality_motivation_completed == 1) && ($user->is_work_interest_completed == 1) && ($user->is_cognitive_ability_completed == 1) && ($isUserResultExists == 1))  
    @if (in_array(env('DB_DATABASE'), ['jgs_olefins_dev', 'jgs_olefins_prod']))
        <div class="d-flex mb-9 card">
            <div class="col-xl-12 p-0">
                <!--begin::Engage widget 1-->
                <div class="psych-inner" dir="ltr">
                    <div class="top-head-view d-flex justify-content-between align-items-base"
                        style="margin-bottom: 45px;">
                        <!--begin::Title-->
                        <div>
                            <h3 class="fw-medium lh-base m-0" style="color: #5B5B5B; font-size: 28px;">JG Summit
                                Values
                            </h3>
                            <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                    style="background: #B2ECEC !important;
                                        color: #108585; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">INTERMEDIATE</span>
                            </p>
                        </div>
                    </div>
                    <div class="skill-table">
                        <div class="all-star">
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Stewardship Mindset <span style="color: #0C52A1;"> 100% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            We are fully responsible for the resources entrusted to us, be they financial, environmental, and people. We make sure that they are managed well and cared for, all with sustainability at the forefront.
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 100%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: -1%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIconBlue.svg') }}" />
                                            </div>
                                        </div>
                                        <p class="purple right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            99th
                                            <span
                                                style="background: #E1D8FB !important;;
                                                color: #7F66CA !important;">
                                                ADVANCED</span>
                                        </p>
                                        <p class="table-desc">
                                            The employee <b>embodies a strong stewardship mindset, acting as a strategic leader</b> in managing and preserving organizational resources. They champion sustainability and accountability across teams and functions, guiding others to make thoughtful, future-oriented decisions. They integrate responsible resource management into planning, influence policies that drive sustainable outcomes, and serve as a role model for ethical and visionary stewardship.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Entrepreneurial Mindset <span style="color: #0C52A1;"> 65% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="orange right-top-heading">
                                                <span style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                    NEEDS DEVELOPMENT</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            We strive for growth with a resilient, passionate and agile mindset with focus on living out our purpose to provide our customers with better choices.
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 65%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 34%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIconBlue.svg') }}" />
                                            </div>
                                        </div>
                                        <p class="spring right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            48th
                                            <span
                                                style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                DEVELOPMENT STAGE</span>
                                        </p>
                                        <p class="table-desc">
                                            The employee <b>is in the process of developing an awareness of what it means to think and act with an entrepreneurial mindset.</b> They are learning to approach challenges with curiosity and show interest in understanding customer needs. While they may still rely on structure and support, they demonstrate early signs of resilience and openness to trying new approaches. With encouragement, they begin to connect their work to the organization’s broader purpose and growth goals.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="line-bottom"></div>
                        <div class="all-star">
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Malasakit <span style="color: #0C52A1;"> 80% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="cyan right-top-heading">
                                                <span>
                                                    ALIGNED</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            We act with Malasakit, or genuine care and concern for each other and
                                            the company, as we deliver on our promise of quality and superior value,
                                            meaningfully giving back to the community we work in and ultimately
                                            having a lasting impact on the nation.
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 80%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 19%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIconBlue.svg') }}" />
                                            </div>
                                        </div>
                                        <p class="success-green spring right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            84th
                                            <span
                                                style="background: #B2ECEC !important;
                                        color: #108585 !important;">
                                                INTERMEDIATE</span>
                                        </p> 
                                        <p class="table-desc">
                                            The employee <b>consistently acts with Malasakit by showing empathy, collaboration, and ownership</b>. They actively support teammates, take pride in delivering high-quality outcomes, and often go beyond their job description to help others or the organization. They engage in community efforts and model respect, responsibility, and a strong sense of shared purpose. Their care positively influences team morale, service quality, and connection to broader societal goals.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Integrity <span style="color: #0C52A1;"> 80% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="orange right-top-heading">
                                                <span style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                    NEEDS DEVELOPMENT</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            We will act with honor in all our undertakings and with all our stakeholders, upholding the principle of always doing the right thing because it is the right thing to do, even when no one else is watching.
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 80%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 19%;">
                                                <img src="{{ asset('admin/media/pdf/RoundIconBlue.svg') }}" />
                                            </div>
                                        </div>
                                        <p class="spring success-green right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            62nd
                                            <span
                                                style="background: #BBECC5 !important;
                                        color: #218336 !important;">
                                                Basic</span>
                                        </p>
                                        <p class="table-desc">
                                            The employee <b>demonstrates emerging ethical awareness by generally acting with honesty and respect toward others. They aim to meet expectations and are learning to make principled decisions independently</b>. While they may still be influenced by external validation, they show a growing commitment to doing what is right, even in less visible situations. They are becoming more reliable in upholding trust and fairness.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif (in_array(env('DB_DATABASE'), ['aboitiz_food_dev', 'aboitiz_food_prod']))
        <div class="d-flex mb-9 card">
            <div class="col-xl-12 p-0">
                <!--begin::Engage widget 1-->
                <div class="psych-inner" dir="ltr">
                    <div class="top-head-view d-flex justify-content-between align-items-base"
                        style="margin-bottom: 45px;">
                        <!--begin::Title-->
                        <div>
                            <h3 class="fw-medium lh-base m-0" style="color: #5B5B5B; font-size: 28px;">Aboitiz Group Values
                            </h3>
                            <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                    style="background: #B2ECEC !important;
                                        color: #108585; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">INTERMEDIATE</span>
                            </p>
                        </div>
                    </div>
                    <div class="skill-table">
                        <div class="all-star">
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Integrity <span style="color: #465F3F;"> 100% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            We believe in integrity. We deliver on what we promise, practice fair processes, are accountable for our actions and their consequences.
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 100%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: -1%;">
                                                <div class="svg-round"></div>
                                            </div>
                                        </div>
                                        <p class="purple right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            99th
                                            <span
                                                style="background: #E1D8FB !important;;
                                                color: #7F66CA !important;">
                                                ADVANCED</span>
                                        </p>
                                        <p class="table-desc">
                                            The employees <b>embodies integrity in all aspects of their work</b>. They not only meet commitments and practice fairness consistently but also influence and inspire others to do the same. They proactively uphold transparency and ensure ethical standards are integrated into team or organizational culture. When challenges arise, they model accountability, take ownership of outcomes, and make principled decisions even under pressure. Their trustworthiness and moral leadership make them a role model within the organization.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Teamwork <span style="color: #465F3F;"> 65% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="orange right-top-heading">
                                                <span style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                    NEEDS DEVELOPMENT</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            We draw on our collective strength as a team, co-creating exponential growth through synergy, speed, and innovation
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 65%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 33%;">
                                                <div class="svg-round"></div>
                                            </div>
                                        </div>
                                        <p class="spring right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            48th
                                            <span
                                                style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                DEVELOPMENT STAGE</span>
                                        </p>
                                        <p class="table-desc">
                                            The employee is <b>in the process of learning on how to engage effectively in a team setting</b>. They are beginning to understand the value of collective contribution and are open to collaborating but may still operate independently at times. With guidance, they are developing interpersonal communication and learning how their role fits into the broader team purpose. They are gradually becoming more receptive to shared decision-making and diverse viewpoints.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="line-bottom"></div>
                        <div class="all-star">
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Innovation <span style="color: #465F3F;"> 80% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="cyan right-top-heading">
                                                <span>
                                                    ALIGNED</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            It belongs to those who are innovatively bold, curious, customer-centric, and courageous. 
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 80%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 18%;">
                                                <div class="svg-round"></div>
                                            </div>
                                        </div>
                                        <p class="success-green spring right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            84th
                                            <span
                                                style="background: #B2ECEC !important;
                                        color: #108585 !important;">
                                                INTERMEDIATE</span>
                                        </p> 
                                        <p class="table-desc">
                                            The employee <b>consistently generates ideas that align with customer needs and business goals</b>. They show boldness in experimenting with new methods, learn from failures, and actively collaborate to innovate. Their approach is both creative and pragmatic, and they can balance risk-taking with customer value creation. They are becoming a reliable contributor to innovation efforts.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Responsibility <span style="color: #465F3F;"> 80% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="orange right-top-heading">
                                                <span style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                    NEEDS DEVELOPMENT</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            The future depends on our continually evolving approach and commitment to the sustainability of people, planet, and prosperity.
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 80%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 18%;">
                                                <div class="svg-round"></div>
                                            </div>
                                        </div>
                                        <p class="spring success-green right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            62nd
                                            <span
                                                style="background: #BBECC5 !important;
                                        color: #218336 !important;">
                                                Basic</span>
                                        </p>
                                        <p class="table-desc">
                                            The employee <b>shows an effort to follows established procedures</b> and demonstrates accountability in their work. They take ownership of tasks and ensure personal responsibilities are fulfilled in a way that supports team and organizational objectives. There is an emerging sense of how their actions influence people and operational efficiency, with occasional consideration for sustainability.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="d-flex mb-9 card">
            <div class="col-xl-12 p-0">
                <!--begin::Engage widget 1-->
                <div class="psych-inner" dir="ltr">
                    <div class="top-head-view d-flex justify-content-between align-items-base"
                        style="margin-bottom: 45px;">
                        <!--begin::Title-->
                        <div>
                            <h3 class="fw-medium lh-base m-0" style="color: #5B5B5B; font-size: 28px;">
                                {{ env('APP_NAME') }} Values
                            </h3>
                            <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                    style="background: #B2ECEC !important;
                                        color: #108585; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">INTERMEDIATE</span>
                            </p>
                        </div>
                    </div>
                    <div class="skill-table">
                        <div class="all-star">
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Commitment <span style="color: #465F3F;"> 100% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            To always represent the spirit of the company.
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 100%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: -1%;">
                                                <div class="svg-round"></div>
                                            </div>
                                        </div>
                                        <p class="purple right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            99th
                                            <span
                                                style="background: #E1D8FB !important;;
                                                color: #7F66CA !important;">
                                                ADVANCED</span>
                                        </p>
                                        <p class="table-desc">

                                            The employee <b>consistently demonstrates integrity and dedication to the company’s mission</b>. They honor commitments with reliability and fairness, while inspiring others through their actions. They actively foster transparency and embed ethical standards within the team and wider organization. In times of challenge, they remain accountable, take ownership of results, and make principled decisions under pressure. Their dependability, resilience, and moral leadership position them as a trusted role model who represents the true spirit of the company.                                        
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Excellence <span style="color: #465F3F;"> 65% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="orange right-top-heading">
                                                <span style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                    NEEDS DEVELOPMENT</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            We always strive for outstanding results that make us stand out from the rest and be preferred by our clients.
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 65%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 33%;">
                                                <div class="svg-round"></div>
                                            </div>
                                        </div>
                                        <p class="spring right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            48th
                                            <span
                                                style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                DEVELOPMENT STAGE</span>
                                        </p>
                                        <p class="table-desc">
                                            The employee is still <b>developing the skills and mindset required to consistently deliver high-quality outcomes</b>. While they demonstrate effort and willingness to improve, their work may at times fall short of the standards expected for client satisfaction. They are learning to recognize the importance of attention to detail, consistency, and continuous improvement. With guidance and feedback, they are beginning to adopt best practices, refine their problem-solving skills, and understand how their contributions impact team performance and client experience.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="line-bottom"></div>
                        <div class="all-star">
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Integrity <span style="color: #465F3F;"> 80% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="cyan right-top-heading">
                                                <span>
                                                    ALIGNED</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            The Company and its workers keep their word and commitments, and are confident that relationships with our clients, suppliers, and workers are long-term relationships. 
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 80%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 18%;">
                                                <div class="svg-round"></div>
                                            </div>
                                        </div>
                                        <p class="success-green spring right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            84th
                                            <span
                                                style="background: #B2ECEC !important;
                                        color: #108585 !important;">
                                                INTERMEDIATE</span>
                                        </p> 
                                        <p class="table-desc">
                                            The employee <b>demonstrates reliability by following through on their commitments and maintaining consistency in their actions</b>. They communicate openly and honestly, ensuring that expectations are clear with colleagues, clients, and partners. While they generally uphold fairness and transparency, they are still developing the ability to navigate complex situations where integrity may be tested. They are becoming a dependable contributor who supports trust-based, long-term relationships and is learning to consistently model integrity in more challenging circumstances.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>RESPECT <span style="color: #465F3F;"> 80% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="orange right-top-heading">
                                                <span style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                    NEEDS DEVELOPMENT</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            We accept and recognize others as our equals, we promote caring for people and treating them well, and we stand out for having a special understanding between the company and its workers.
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 80%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 18%;">
                                                <div class="svg-round"></div>
                                            </div>
                                        </div>
                                        <p class="spring success-green right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            62nd
                                            <span
                                                style="background: #BBECC5 !important;
                                        color: #218336 !important;">
                                                Basic</span>
                                        </p>
                                        <p class="table-desc">
                                            The employee is <b>beginning to show awareness of the importance of treating others with courtesy and consideration</b>. They generally interact politely but may not yet consistently recognize or value different perspectives. At this stage, they are developing the ability to listen actively, show empathy, and acknowledge colleagues as equals. With guidance, they are learning how respectful behaviors contribute to stronger teamwork, a supportive workplace, and positive relationships across the company.
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="line-bottom"></div>
                        <div class="all-star">
                            <div>
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Safety <span style="color: #465F3F;"> 62% </span>
                                                {{-- <p
                                                class="purple right-top-heading">
                                                <span>
                                                    HIGHLY ALIGNED</span>
                                            </p> --}}
                                            <p class="orange right-top-heading">
                                                <span style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                    NEEDS DEVELOPMENT</span>
                                            </p>
                                            <p>
                                        </div>
                                        <p class="table-desc" style="min-height: 18px;">
                                            An accident can never be justified. Therefore, people’s safety is more important than any other circumstantial target.
                                        </p>
                                        <div class="line line-grey">
                                            <div style="width: 80%; background: #14A028;"
                                                class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: 18%;">
                                                <div class="svg-round"></div>
                                            </div>
                                        </div>
                                        <p class="success-green spring right-top-heading"
                                            style="
                                                margin-top: 20px;
                                            ">
                                            44th
                                            <span
                                                style="background: #FFEBB4 !important;;
                                                color: #F7941C !important;">
                                                DEVELOPMENT STAGE</span>
                                        </p> 
                                        <p class="table-desc">
                                            The employee is <b>beginning to recognize the importance of safety as a priority over operational targets</b>. They are learning to follow established safety procedures and are becoming more aware of how their actions affect the well-being of themselves and others. While they may still require reminders or guidance, they show willingness to adopt safe practices and demonstrate increasing caution in their daily tasks.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@else
    <div class="empty-state" style="background: #FCFCFC;">
                <p>
                    Details will be available once assessments are completed by the user.
                </p>
    </div>
@endif
