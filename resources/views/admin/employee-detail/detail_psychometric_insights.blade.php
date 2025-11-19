        @if (in_array(env('DB_DATABASE'), ['airasia_dev', 'airasia_uat', 'airasia_prod', 'temp_jgs_olefins','temp_aboitiz_food']))
            <h4 class="main-top-heading">Summary of AirAsia Psychometric Insights</h4>
            <div class="d-flex mb-9 card">
                <div class="col-xl-12 p-0">
                    <!--begin::Engage widget 1-->
                    <div class="psych-inner" dir="ltr">
                        <div class="top-head-view d-flex justify-content-between align-items-base"
                            style="margin-bottom: 45px;">
                            <!--begin::Title-->
                            <div>
                                <h3 class="fw-medium lh-base m-0" style="color: #5B5B5B; font-size: 28px;">Allstar Values
                                </h3>
                                <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                        style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                        Contributor</span>
                                </p>
                            </div>
                        </div>
                        <!--end::Title-->
                        <div class="skill-table mb-14">
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Dare to Dream <span style="color: #F00;">{{ $allStarResult['dare-to-dream']['score'] / 0.05 }}% </span>
                                                    {{-- <p
                                                    class="purple right-top-heading">
                                                    <span>
                                                        HIGHLY ALIGNED</span>
                                                </p> --}}
                                                <p class=" right-top-heading">
                                                    <span class="badge-custom {{ config('helpers.all_star_job_alignment')[$allStarResult['dare-to-dream']['level']]['class'] }}">  {{ config('helpers.all_star_job_alignment')[$allStarResult['dare-to-dream']['level']]['title'] }}   
                                                    </span>
                                                </p>
                                                <p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $allStarResult['dare-to-dream']['score'] / 0.05 }}%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 -  $allStarResult['dare-to-dream']['score'] / 0.05 }}%; border: none;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            {!! $allStarResult['dare-to-dream']['level_description'] ?? '' !!}
                                            <!-- <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                setting the tone on how everyone can contribute, create a platform for
                                                everyone to play their part: think like an entrepreneur, take smart
                                                risks
                                                and seek opportunities in everything. Empower your team to dream big.
                                            </p>
                                            </br>
                                            <p class="table-desc"><b>Ambitious Go-Getter</b></br>
                                                Improves the performance of the team he/she is leading by making
                                                changes to the system/workflow drive efficiency. Sets goals and
                                                motivates the team to achieve it.
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="all-star-div">
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc"
                                            style="font-size: 12px;margin-bottom: 8px; color:#FF5D5D;">
                                            Why is it important?
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                            We're dream makers. The AirAsia story is an industry legend - our founders
                                            dared
                                            to dream and achieved the impossible. So what makes an Allstar? Having the
                                            vision, courage and tenacity to go for your dreams.
                                        </p>
                                    </div>
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc" style="font-size: 12px;margin-bottom: 8px;">
                                            <iconify-icon icon="octicon:light-bulb-16"
                                                style="color:#FF5D5D;"></iconify-icon>
                                            Cross Functional Projects
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                            bring together employees from various functions within a departments to work
                                            collaboratively on a shared objective. This collaboration breaks down silos
                                            and
                                            encourages synergy by harnessing the collective capabilities of different
                                            teams.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>All for One, One for All <span style="color: #FF0000;">
                                                        {{ $allStarResult['all-for-one-one-for-all']['score'] / 0.05 }}% </span>
                                                </p>
                                                <p class=" right-top-heading">
                                                    <span class="badge-custom {{ config('helpers.all_star_job_alignment')[$allStarResult['all-for-one-one-for-all']['level']]['class'] }}">  {{ config('helpers.all_star_job_alignment')[$allStarResult['all-for-one-one-for-all']['level']]['title'] }}   
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $allStarResult['all-for-one-one-for-all']['score'] / 0.05 }}%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 -  $allStarResult['all-for-one-one-for-all']['score'] / 0.05 }}%; border: none;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            {!! $allStarResult['all-for-one-one-for-all']['level_description'] ?? '' !!}
                                            <!-- <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                            margin-top: 20px;
                                        ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                keeping up to date with what’s going on through our internal
                                                communication platforms and being actively involved in activities at
                                                your location, function and the whole group. Let’s be supportive of each
                                                other and help in whichever way we can.


                                            </p>
                                            </br>
                                            <p class="table-desc"><b>Committed Teamplayer</b></br>
                                                Works collaboratively with the team, helps others and is involved with
                                                the departmental initiatives.
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="all-star-div">
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc"
                                            style="font-size: 12px;margin-bottom: 8px; color:#FF5D5D;">
                                            Why is it important?
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                            All for One, One for All is about teamwork, sharing success, and using our
                                            size
                                            to our advantage. When we succeed, we succeed as ONE. When we win awards, we
                                            win
                                            and celebrate as ONE. We don't compete with each other; we collaborate to
                                            win as
                                            ONE. Every role is important, and we all contribute to the company's
                                            success.
                                            Even though we have multiple lines of business, we are ONE.
                                        </p>
                                    </div>
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc" style="font-size: 12px;margin-bottom: 8px;">
                                            <iconify-icon icon="octicon:light-bulb-16"
                                                style="color:#FF5D5D;"></iconify-icon>
                                            Cross Functional Projects
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                            To build relationships and encouraging collaborations with other
                                            departments/teams
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="line-bottom"></div>
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Make a Difference <span style="color: #FF0000;">
                                                        {{ $allStarResult['make-a-difference']['score'] / 0.05 }}% </span>
                                                </p>        
                                                <p class=" right-top-heading">
                                                    <span class="badge-custom {{ config('helpers.all_star_job_alignment')[$allStarResult['make-a-difference']['level']]['class'] }}  ">  {{ config('helpers.all_star_job_alignment')[$allStarResult['make-a-difference']['level']]['title'] }}   
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $allStarResult['make-a-difference']['score'] / 0.05 }}%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 -  $allStarResult['make-a-difference']['score'] / 0.05 }}%; border: none;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            {!! $allStarResult['make-a-difference']['level_description'] ?? '' !!}
                                            <!-- <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                            margin-top: 20px;
                                        ">
                                                <span
                                                    style="background: #FFE4F1 !important;
                                            color: #BF3273 !important;">
                                                    Leadership / Senior Management</span>
                                            </p>
                                            <p class="table-desc">
                                                Creating a space for the team to “Make their own difference”. Offer
                                                resources, training, and mentorship programs to help Allstars further
                                                develop their strengths and overcome weaknesses. Encourage a culture of
                                                continuous learning and improvement to empower individuals to “Make a
                                                difference”
                                            </p>
                                            </br>
                                            <p class="table-desc"><b>Courage</b></br>
                                                Set the tone for the department's growth and empower your direct reports
                                                to
                                                foster an environment that embraces making a difference in their own
                                                way.
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="all-star-div">
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc"
                                            style="font-size: 12px;margin-bottom: 8px; color:#FF5D5D;">
                                            Why is it important?
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                            Making a difference requires us to take charge of our ideas and ensure that
                                            we
                                            are making a lasting impact in all that we do. If there are gaps, close
                                            them; if
                                            there are problems, fix them; if there are existing ideas, improve
                                            them!<br /><br />
                                            That’s the essence of being an Allstar. Things move very fast! Ideas,
                                            strategies, and plans can change suddenly. We need to respond to this
                                            positively
                                            and resiliently to ensure we continue to meet the needs and expectations of
                                            our
                                            guests and each other.<br /><br />A business has to evolve and the people
                                            are
                                            the drivers for change. How the company adapts and deals with change is
                                            critical.<br /><br />
                                        </p>
                                    </div>
                                    <!-- <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc" style="font-size: 12px;margin-bottom: 8px;">
                                            <iconify-icon icon="octicon:light-bulb-16"
                                                style="color:#FF5D5D;"></iconify-icon>
                                            Cross Functional Projects
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                        </p>
                                    </div> -->
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Have Empathy & Respect <span style="color: #FF0000;">
                                                        {{ $allStarResult['have-empathy-and-respect']['score'] / 0.05 }}%
                                                    </span>
                                                </p>        
                                                <p class=" right-top-heading">
                                                    <span class="badge-custom {{ config('helpers.all_star_job_alignment')[$allStarResult['have-empathy-and-respect']['level']]['class'] }}">  {{ config('helpers.all_star_job_alignment')[$allStarResult['have-empathy-and-respect']['level']]['title'] }}   
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $allStarResult['have-empathy-and-respect']['score'] / 0.05 }}%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 -  $allStarResult['have-empathy-and-respect']['score'] / 0.05 }}%; border: none;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            {!! $allStarResult['have-empathy-and-respect']['level_description'] ?? '' !!}
                                            <!-- <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                            margin-top: 20px;
                                        ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                            color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                leading by example and creating a supportive and inclusive work
                                                environment. It involves understanding the needs and concerns of team
                                                members, providing constructive feedback, and empowering them to
                                                succeed.
                                            </p>
                                            </br>
                                            <p class="table-desc"><b>Warmth</b></br>
                                                Treats every team member with respect for the work they do regardless
                                                of their position and provides support where needed.
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="all-star-div">
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc"
                                            style="font-size: 12px;margin-bottom: 8px; color:#FF5D5D;">
                                            Why is it important?
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                               Empathy and respect are fundamental values that contribute to a positive and
                                                harmonious work culture. By practising empathy and respect, we build strong
                                                relationships based on trust and mutual understanding which creates an
                                                environment where people feel valued, supported, and motivated to do their
                                                best.
                                                This not only enhances collaboration and teamwork but also promotes
                                                creativity,
                                                innovation, and overall well-being in the workplace
                                        </p>
                                    </div>
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc" style="font-size: 12px;margin-bottom: 8px;">
                                            <iconify-icon icon="octicon:light-bulb-16"
                                                style="color:#FF5D5D;"></iconify-icon>
                                            Cross Functional Projects
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                        Topics such as active listening, clarity in communication, and expressing
                                        opinions transparently.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="skill-table mb-14 content-placeholder" style="display: none;">
                            <div class="line-bottom"></div>
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                    <p>Celebrate All Individuals <span style="color: #FF0000;">
                                                            {{ $allStarResult['celebrate-all-individuals']['score'] / 0.05 }}%
                                                        </span>
                                                    </p>        
                                                    <p class=" right-top-heading">
                                                        <span class="badge-custom {{ config('helpers.all_star_job_alignment')[$allStarResult['celebrate-all-individuals']['level']]['class'] }}">  {{ config('helpers.all_star_job_alignment')[$allStarResult['celebrate-all-individuals']['level']]['title'] }}   
                                                        </span>
                                                    </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $allStarResult['celebrate-all-individuals']['score'] / 0.05 }}%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange">
                                                </div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 -  $allStarResult['celebrate-all-individuals']['score'] / 0.05 }}%; border: none;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            {!! $allStarResult['celebrate-all-individuals']['level_description'] ?? '' !!}
                                            <!-- <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE4F1 !important;
                                                    color: #BF3273 !important;">
                                                    Leadership / Senior Management</span>
                                            </p>
                                            <p class="table-desc">
                                                creating platforms and initiatives to highlight the successes of
                                                individuals regardless of back grounds, departments, positions or ranks.
                                                Lead by example to nurture the culture of celebrating Allstars who
                                                thrive and contribute to our collective success.
                                            </p>
                                            </br>
                                            <p class="table-desc"><b>Thoughtfulness</b></br>
                                                Contribute to the overall value by ensuring Allstars are treated fairly
                                                within the function and listen to all feedback/suggestions. Leads a work
                                                culture that celebrates diversity, strengthens creativity, innovation
                                                and
                                                collaboration.
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="all-star-div">
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc"
                                            style="font-size: 12px;margin-bottom: 8px; color:#FF5D5D;">
                                            Why is it important?
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                        It promotes a culture of inclusivity, appreciation, and belonging. It
                                                fosters a
                                                sense of unity among team members, regardless of their differences. By
                                                recognising and celebrating the unique strengths and accomplishments of each
                                                Allstar, including their uniqueness and diversity, we inspire motivation,
                                                boost
                                                morale, and cultivate a positive work culture. Additionally, celebrating
                                                diversity and inclusivity enhances creativity, innovation, and collaboration
                                                within the organisation.
                                        </p>
                                    </div>
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc" style="font-size: 12px;margin-bottom: 8px;">
                                            <iconify-icon icon="octicon:light-bulb-16"
                                                style="color:#FF5D5D;"></iconify-icon>
                                            DEI
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                        a comprehensive training program focused on diversity, equity, and inclusion
                                        (DEI) in the workplace.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Safety #1 <span style="color: #FF0000;">
                                                        {{ $allStarResult['safety-1']['score'] / 0.05 }}% </span>
                                                </p>        
                                                <p class=" right-top-heading">
                                                    <span class="badge-custom {{ config('helpers.all_star_job_alignment')[$allStarResult['safety-1']['level']]['class'] }}">  {{ config('helpers.all_star_job_alignment')[$allStarResult['safety-1']['level']]['title'] }}   
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $allStarResult['safety-1']['score'] / 0.05 }}%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 -  $allStarResult['safety-1']['score'] / 0.05 }}%; border: none;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            {!! $allStarResult['safety-1']['level_description'] ?? '' !!}
                                            <!-- <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE4F1 !important;
                                                    color: #BF3273 !important;">
                                                    Leadership / Senior Management</span>
                                            </p>
                                            <p class="table-desc">
                                                promoting awareness of the importance of communicating relevant
                                                safety information to all levels of the organisation (and with outside
                                                organisations).
                                            </p>
                                            </br>
                                            <p class="table-desc"><b>Safety #1</b></br>
                                                Keep abreast of the safety information in the industry and instill the
                                                safety mindset in people managers.
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="all-star-div">
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc"
                                            style="font-size: 12px;margin-bottom: 8px; color:#FF5D5D;">
                                            Why is it important?
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                        In our line of work, we hold significant responsibility as people trust us
                                                with
                                                their lives, well-being, and data protection. We take this responsibility
                                                seriously and uphold it with the highest integrity. As Allstars, we
                                                recognise
                                                our shared responsibility to effectively manage multiple tasks
                                                simultaneously.
                                                This ensures that business operations, workplace safety, and personal
                                                well-being
                                                are maintained at all times.
                                        </p>
                                    </div>
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc" style="font-size: 12px;margin-bottom: 8px;">
                                            <iconify-icon icon="octicon:light-bulb-16"
                                                style="color:#FF5D5D;"></iconify-icon>
                                                Effective Communication skills
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                        crucial for all to communicate safety-related information clearly and
                                                effectively. They should be able to articulate safety concerns, report
                                                incidents
                                                or near-misses, and communicate safety procedures to their colleagues.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="line-bottom"></div>
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Be Transparent <span style="color: #FF0000;">
                                                        {{ $allStarResult['be-transparent']['score'] / 0.05 }}% </span>
                                                </p>        
                                                <p class=" right-top-heading">
                                                    <span class="badge-custom {{ config('helpers.all_star_job_alignment')[$allStarResult['be-transparent']['level']]['class'] }}">  {{ config('helpers.all_star_job_alignment')[$allStarResult['be-transparent']['level']]['title'] }}   
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $allStarResult['be-transparent']['score'] / 0.05 }}%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 -  $allStarResult['be-transparent']['score'] / 0.05 }}%; border: none;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            {!! $allStarResult['be-transparent']['level_description'] ?? '' !!}
                                            <!-- <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE4F1 !important;
                                                    color: #BF3273 !important;">
                                                    Leadership / Senior Management</span>
                                            </p>
                                            <p class="table-desc">
                                                leading by example consistently. Be open and honest in communication
                                                and decision-making processes. This includes sharing relevant
                                                information with Allstars and stakeholders, explaining the rationale
                                                behind decisions, and seeking input and feedback.
                                            </p>
                                            </br>
                                            <p class="table-desc"><b>Authenticity</b></br>
                                                Lead by example by acting on values and consistently being open and
                                                honest on the decision making process on business direction change to
                                                help Allstars understand the objective of organisation and to provide
                                                Allstars with a sense of purpose.
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="all-star-div">
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc"
                                            style="font-size: 12px;margin-bottom: 8px; color:#FF5D5D;">
                                            Why is it important?
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                        Transparency is crucial because it builds trust and credibility. It ensures
                                                that
                                                everyone is well-informed and aligned with organisational goals and
                                                decisions.
                                                Transparency also encourages open dialogue, feedback, and collaboration,
                                                leading
                                                to better decision-making and problem-solving. Transparency builds
                                                accountability too, as it allows for clear attribution of responsibilities
                                                and
                                                outcomes.
                                        </p>
                                    </div>
                                    <!-- <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc" style="font-size: 12px;margin-bottom: 8px;">
                                            <iconify-icon icon="octicon:light-bulb-16"
                                                style="color:#FF5D5D;"></iconify-icon>
                                            Cross Functional Projects
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                        </p>
                                    </div> -->
                                </div>
                            </div>

                            <div class="line-bottom"></div>
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Keep it simple! <span style="color: #FF0000;">
                                                        {{ $allStarResult['keep-it-simple']['score'] / 0.05 }}% </span>
                                                </p>        
                                                <p class=" right-top-heading">
                                                    <span class="badge-custom {{ config('helpers.all_star_job_alignment')[$allStarResult['keep-it-simple']['level']]['class'] }}">  {{ config('helpers.all_star_job_alignment')[$allStarResult['keep-it-simple']['level']]['title'] }}   
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $allStarResult['keep-it-simple']['score'] / 0.05 }}%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 -  $allStarResult['keep-it-simple']['score'] / 0.05 }}%; border: none;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            {!! $allStarResult['keep-it-simple']['level_description'] ?? '' !!}
                                            <!-- <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE4F1 !important;
                                                    color: #BF3273 !important;">
                                                    Leadership / Senior Management</span>
                                            </p>
                                            <p class="table-desc">
                                                continuously reminding everyone to find ways to simplify processes and
                                                communication. Set clear goals, encourage and reward innovative
                                                thinking that eliminates unnecessary complexity, and foster a culture
                                                that values simplicity. If you see something that can be simplified,
                                                empower your team to go for the simpler solution. That’s it!.
                                            </p>
                                            </br>
                                            <p class="table-desc"><b>Straightforward</b></br>
                                                Visionary and relentless - Shifts paradigm, looks at things in a new way
                                                and actively challenges the status quo and is able to set a future plan
                                                for the department/business that revolves around simplicity &
                                                efficiency.
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="all-star-div">
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc"
                                            style="font-size: 12px;margin-bottom: 8px; color:#FF5D5D;">
                                            Why is it important?
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                        To become where we are today, fighting against Goliaths of the industry, our
                                                strongest weapons were our culture and the fact that we were agile. To stay
                                                agile, we need to keep things simple. When we simplify processes and
                                                communication, we minimise the risk of errors, delays, and
                                                misunderstandings. We
                                                promote clarity and effectiveness in our work. This saves time and resources
                                                while enhancing our productivity and performance. Need we say more?
                                        </p>
                                    </div>
                                    <div class="tweleve-inner p-6">
                                        <p class="tweleve-desc" style="font-size: 12px;margin-bottom: 8px;">
                                            <iconify-icon icon="octicon:light-bulb-16"
                                                style="color:#FF5D5D;"></iconify-icon>
                                                Effective Communication
                                        </p>
                                        <p class="table-desc" style="font-size: 10px; line-height: normal;">
                                        Provide practical exercises and role-plays to help non-executive candidates
                                        practice simplifying complex information.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="all-star-btn">View All Allstar Values</button>
                    </div>
                    <!--end::Engage widget 1-->
                </div>
            </div>
            <div class="d-flex mb-9 card">
                <div class="col-xl-12 p-0">
                    <!--begin::Engage widget 1-->
                    <div class="psych-inner" dir="ltr">
                        <div class="top-head-view d-flex justify-content-between align-items-base"
                            style="margin-bottom: 45px;">
                            <!--begin::Title-->
                            <div>
                                <h3 class="fw-medium lh-base m-0" style="color: #5B5B5B; font-size: 28px;">AirAsia
                                    Core Skills
                                </h3>
                                <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                        style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                        Contributor</span>
                                </p>
                            </div>
                        </div>
                        <div class="skill-table">
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>GenAi / Big Data <span style="color: #F00;"> 100% </span>
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
                                                Using smart tech and lots of data to solve problems and work better
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 100%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 0%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="purple right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                99th
                                                <span
                                                    style="background: #FFE4F1 !important;;
                                                    color: #BF3173 !important;">
                                                    Leadership / Senior Management</span>
                                            </p>
                                            <p class="table-desc">
                                                Champions digital innovation and data-driven decision-making at a
                                                strategic level. Establishes a vision for using GenAI and big data to
                                                create business value, improve service delivery, and future-proof the
                                                organization. Leaders/senior should actively engage in digital
                                                transformation workshops, invest in enterprise-level analytics
                                                platforms, and promote a data-first mindset across the organization.
                                                They should sponsor innovation initiatives, mentor managers on
                                                leveraging GenAI insights, and align digital capabilities with strategic
                                                goals to create measurable impact.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Service Orientation <span style="color: #F00;"> 85% </span>
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
                                                Always ready to help and give great service
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 85%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 13%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="cyan right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                94th
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Leads a service-focused team culture. Monitors service quality, resolves
                                                escalated issues, and coaches team members to exceed customer
                                                expectations consistently. Managers should implement service quality
                                                KPIs, conduct regular review meetings on customer feedback, and organize
                                                monthly service clinics to coach team members. They should model service
                                                excellence and create a recognition system for outstanding service
                                                behavior.
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
                                                <p>System Thinking <span style="color: #F00;"> 80% </span>
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
                                                Seeing how everything connects and works together
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 80%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 18%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="success-green spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                82nd
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Connects their tasks to broader organizational goals. Identifies
                                                patterns, dependencies, and potential impact across functions when
                                                solving problems. Encourage contributors to participate in
                                                cross-departmental meetings and improvement projects. Provide tools like
                                                process maps and root-cause analysis frameworks (e.g., Fishbone, 5 Whys)
                                                to guide systems-level thinking when tackling issues.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Resilience & Agility <span style="color: #F00;"> 80% </span>
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
                                                Staying strong & quick to adapt when things change
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 80%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 18%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring success-green right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                62nd
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Adjusts priorities and work strategies quickly when goals or conditions
                                                shift. Maintains focus, re-evaluates approaches, and supports teammates
                                                during change.Offer training in adaptive thinking and task
                                                reprioritization (e.g., Eisenhower Matrix). Assign contributors to
                                                project-based rotations or agile squads to build flexibility.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="main-top-heading mb-7">AirAsia Learning Agility</h4>
            <div class="d-flex mb-9 card">
                <div class="col-xl-12 p-0">
                    <!--begin::Engage widget 1-->
                    <div class="psych-inner" dir="ltr">
                        <div class="top-head-view d-flex justify-content-between align-items-base"
                            style="margin-bottom: 45px;">
                            <!--begin::Title-->
                            <div>
                                <h3 class="fw-medium lh-base m-0 d-flex align-items-center gap-4"
                                    style="color: #5B5B5B; font-size: 28px;">People
                                    Agility <span class="top-ranks-box cyan">85th</span>
                                </h3>
                                <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                        style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                        Contributor</span>
                                </p>
                            </div>
                        </div>
                        <div class="skill-table">
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Leads & Inspire <span style="color: #F00;"> 67% </span>
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
                                                Allstar leads and inspire others to embrace new situations,
                                                opportunities and challenges.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 67%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 32%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar shows some initiative and occasionally encourages others,
                                                particularly in familiar contexts or when prompted. While able to
                                                participate in team efforts, their leadership presence is still
                                                developing and situational. To grow, Allstar can start leading smaller
                                                projects, practice articulating ideas with clarity and motivation, and
                                                reflect on what has helped or hindered their leadership confidence in
                                                recent situations
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Feedback Receptive <span style="color: #F00;"> 81% </span>
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
                                                Allstar embraces positive and negative feedback for self-improvement.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 81%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 17%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar actively seeks out feedback from a range of sources, showing
                                                maturity in their self-awareness and responsiveness. They analyze trends
                                                over time, adjust their work habits, and use insights to inform future
                                                actions. At this level, Allstar should maintain a personal development
                                                log, regularly request feedback on specific projects or behaviors,
                                                compare external feedback with self-evaluations, and use the insights to
                                                take targeted steps in performance and communication improvements.
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
                                                <p>Team Enablement <span style="color: #F00;"> 52% </span>
                                                    {{-- <p
                                                    class="purple right-top-heading">
                                                    <span>
                                                        HIGHLY ALIGNED</span>
                                                </p> --}}
                                                <p class="orange right-top-heading">
                                                    <span>
                                                        NEEDS DEVELOPMENT</span>
                                                </p>
                                                <p>
                                            </div>
                                            <p class="table-desc" style="min-height: 18px;">
                                                Allstar takes specific actions to promote team effectiveness with the
                                                intent of enabling the team to function optimally.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 52%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 46%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFF0CF !important;;
                                                    color: #F7941C !important;">
                                                    NON-EXECUTIVE</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar begin to recognize the importance of team effectiveness but may
                                                still be developing the confidence or awareness to act on it. They may
                                                observe team dynamics passively and rely on others to resolve issues or
                                                coordinate efforts. At this stage, Allstar can take action by actively
                                                listening during meetings, offering assistance when teammates face
                                                challenges, and requesting clarity on team goals. Participating in basic
                                                collaboration workshops and volunteering to support team initiatives are
                                                key first steps toward active contribution.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Inclusive Engagement <span style="color: #F00;"> 73% </span>
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
                                                Allstar promotes relationship and build engagement with people at all
                                                levels of the organization.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 73%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 25%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar maintains positive relationships within their team and
                                                occasionally interacts with others outside their immediate group. They
                                                are polite and cooperative, showing a willingness to connect when
                                                opportunities arise but may not proactively seek them out. To progress,
                                                Allstar should take deliberate steps to build rapport across functions,
                                                such as scheduling regular one-on-one check-ins with colleagues from
                                                other departments, attending company-wide townhalls or social events,
                                                and following up with appreciation or support after collaborative
                                                efforts.
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
                                                <p>Motivational Climate <span style="color: #F00;"> 85% </span>
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
                                                Allstar creates a conducive climate in which people are motivated to do
                                                their best to help the organisation achieve its objectives.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 85%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 13%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar actively fosters an encouraging environment where people feel
                                                valued, supported, and connected to the purpose of their work. They
                                                celebrate team achievements, adapt to emotional dynamics, and help
                                                others overcome setbacks. To build further impact, Allstar can introduce
                                                team rituals (e.g., goal reviews, success reflections), encourage
                                                autonomy in task ownership, and provide developmental feedback that
                                                inspires growth.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex mb-9 card">
                <div class="col-xl-12 p-0">
                    <!--begin::Engage widget 1-->
                    <div class="psych-inner" dir="ltr">
                        <div class="top-head-view d-flex justify-content-between align-items-base"
                            style="margin-bottom: 45px;">
                            <!--begin::Title-->
                            <div>
                                <h3 class="fw-medium lh-base m-0 d-flex align-items-center gap-4"
                                    style="color: #5B5B5B; font-size: 28px;">Mental Agility <span
                                        class="top-ranks-box cyan">89th</span>
                                </h3>
                                <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                        style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                        Contributor</span>
                                </p>
                            </div>
                        </div>
                        <div class="skill-table">
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Strategic Judgment <span style="color: #F00;"> 89% </span>
                                                    {{-- <p
                                                    class="purple right-top-heading">
                                                    <span>
                                                        HIGHLY ALIGNED</span>
                                                </p> --}}
                                                <p class="purple right-top-heading">
                                                    <span>HIGHLY ALIGNED</span>
                                                </p>
                                                <p>
                                            </div>
                                            <p class="table-desc" style="min-height: 18px;">
                                                Allstar seeks clarity and rationale in complex situation and makes sound
                                                business decisions.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 89%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 9%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                            margin-top: 20px;
                                        ">
                                                <span
                                                    style="background: #FFE4F1 !important;
                                            color: #BF3273 !important;">
                                                    Leadership / Senior Management</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar excels at navigating complexity, synthesizing information from
                                                multiple sources, and making well-timed, high-impact business decisions.
                                                They anticipate downstream effects and proactively manage uncertainty
                                                while remaining calm and decisive. To sustain this level, Allstar should
                                                advise leadership on strategic options, lead scenario planning
                                                exercises, and embed critical thinking models into team processes
                                                ensuring others develop the same clarity and rationale when faced with
                                                ambiguity.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Learning Integration <span style="color: #F00;"> 73% </span>
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
                                                Allstar is able to retain and incorporate new information for continuous
                                                improvement in the workplace.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 73%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 25%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar consistently integrates new information into their work, using
                                                it to improve productivity, quality, and team outcomes. They actively
                                                look for learning opportunities in day-to-day experiences. To continue
                                                progressing, Allstar should lead team debriefs to extract lessons from
                                                projects, initiate cross-training with peers, and track key improvements
                                                driven by their own learning efforts, showcasing measurable impact from
                                                what they’ve absorbed.
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
                                                <p>Growth Mindset <span style="color: #F00;"> 75% </span>
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
                                                Allstar is optimistic that he/she can learn new information and value
                                                add to the organisation.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 75%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 23%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar consistently embraces new learning opportunities and believes in
                                                their capacity to adapt and contribute value through acquired knowledge.
                                                They are proactive in identifying areas for development and applying
                                                insights to enhance team performance. To strengthen this further,
                                                Allstar should lead knowledge-sharing sessions, mentor less experienced
                                                colleagues, and connect learning goals to broader organizational
                                                objectives.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Knowledge Catalyst <span style="color: #F00;"> 65% </span>
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
                                                Allstar is able to establish a culture of continuous learning across
                                                organizational boundaries and levels.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 65%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 33%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar consistently supports learning within their immediate team and
                                                encourages peers to pursue professional development. They occasionally
                                                organize sharing sessions or suggest resources that may benefit others.
                                                To expand impact, Allstar should start collaborating with other teams to
                                                co-host learning events, suggest learning themes aligned to business
                                                goals, and connect individuals with subject matter experts within the
                                                organization.
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
                                                <p>Self-Reflective Learning <span style="color: #F00;"> 68% </span>
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
                                                Allstar doesn't make an effort to learn and improve from mistakes.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 68%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 30%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar occasionally reflects on outcomes and learns from obvious
                                                mistakes, though the process may still be inconsistent or reactive. They
                                                are learning to pause after a challenge to analyze what went wrong and
                                                what could be improved. To strengthen this behavior, Allstar can adopt a
                                                post-action review routine after completing tasks or projects, seek
                                                constructive feedback from peers, and practice sharing “lessons learned”
                                                openly during team discussions.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex mb-9 card">
                <div class="col-xl-12 p-0">
                    <!--begin::Engage widget 1-->
                    <div class="psych-inner" dir="ltr">
                        <div class="top-head-view d-flex justify-content-between align-items-base"
                            style="margin-bottom: 45px;">
                            <!--begin::Title-->
                            <div>
                                <h3 class="fw-medium lh-base m-0 d-flex align-items-center gap-4"
                                    style="color: #5B5B5B; font-size: 28px;">Change Agility <span
                                        class="top-ranks-box success-green">78th</span>
                                </h3>
                                <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                        style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                        Contributor</span>
                                </p>
                            </div>
                        </div>
                        <div class="skill-table">
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Endurance & Advocacy <span style="color: #F00;"> 91% </span>
                                                    {{-- <p
                                                    class="purple right-top-heading">
                                                    <span>
                                                        HIGHLY ALIGNED</span>
                                                </p> --}}
                                                <p class="purple right-top-heading">
                                                    <span>HIGHLY ALIGNED</span>
                                                </p>
                                                <p>
                                            </div>
                                            <p class="table-desc" style="min-height: 18px;">
                                                Allstar is resilient and able to champion change programs by keeping
                                                focus on the desired end state.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 91%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 7%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                            margin-top: 20px;
                                        ">
                                                <span
                                                    style="background: #FFE4F1 !important;
                                            color: #BF3273 !important;">
                                                    Leadership / Senior Management</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar thrives in dynamic environments and is a visible champion for
                                                transformation. They inspire confidence in others by connecting the
                                                change vision to strategic outcomes, sustaining momentum even when
                                                obstacles arise. At this level, Allstar should spearhead enterprise-wide
                                                change programs, embed resilience-building practices into team rituals,
                                                and act as a coach for emerging change leaders across departments.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Openness to learning <span style="color: #F00;"> 81% </span>
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
                                                Allstar is reluctant to learn something new.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 81%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 17%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar proactively seeks learning opportunities and starts to take
                                                ownership of their development. They show curiosity about new
                                                approaches, integrate feedback effectively, and support others in small
                                                learning efforts. To develop further, Allstar can create a learning
                                                roadmap aligned with team or role goals, join cross-functional projects
                                                that stretch their skills, and participate in knowledge-sharing sessions
                                                to model a culture of development
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
                                                <p>Strategic Change Alignment <span style="color: #F00;"> 83% </span>
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
                                                Allstar aligns change initiatives to organisation's values, strategic
                                                intent, and practices.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 83%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 15%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar consistently considers organizational values and strategic goals
                                                when proposing or implementing change initiatives. They are capable of
                                                communicating this alignment clearly to peers and stakeholders. To
                                                progress further, Allstar should co-lead a departmental change
                                                initiative, contribute to aligning team KPIs with strategic goals, and
                                                participate in cross-functional planning sessions to strengthen
                                                alignment across functions.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Change Sustainment <span style="color: #F00;"> 68% </span>
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
                                                Allstar is able to implement strategies for renewing or deepening change
                                                efforts.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 68%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 30%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar makes efforts to support existing change programs and is open to
                                                minor course corrections when guided. They can contribute by flagging
                                                early signs of change fatigue and suggesting adjustments to
                                                communication or process flow. To grow, Allstar should take part in
                                                feedback loops, propose small-scale renewal activities (e.g., quick wins
                                                or recognitions), and collaborate with team leads to reinvigorate
                                                engagement when energy drops.
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
                                                <p>Organizational Transformation Leadership <span style="color: #F00;">
                                                        71% </span>
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
                                                Allstar introduces change initiatives that target improvement of
                                                significant organizational capabilities.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 71%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 27%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar supports change efforts that align with organizational
                                                improvements and can communicate the value of such changes when guided.
                                                They start to contribute ideas for improvement and collaborate on
                                                execution. To advance, Allstar should analyze department goals, identify
                                                bottlenecks, and propose changes that could impact broader performance.
                                                Managers can support by involving Allstar in change planning discussions
                                                and assigning ownership over specific implementation tasks.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex mb-9 card">
                <div class="col-xl-12 p-0">
                    <!--begin::Engage widget 1-->
                    <div class="psych-inner" dir="ltr">
                        <div class="top-head-view d-flex justify-content-between align-items-base"
                            style="margin-bottom: 45px;">
                            <!--begin::Title-->
                            <div>
                                <h3 class="fw-medium lh-base m-0 d-flex align-items-center gap-4"
                                    style="color: #5B5B5B; font-size: 28px;">Results Agility <span
                                        class="top-ranks-box success-green">78th</span>
                                </h3>
                                <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                        style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                        Contributor</span>
                                </p>
                            </div>
                        </div>
                        <div class="skill-table">
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Solution Effectiveness Execution <span style="color: #F00;"> 91%
                                                    </span>
                                                    {{-- <p
                                                    class="purple right-top-heading">
                                                    <span>
                                                        HIGHLY ALIGNED</span>
                                                </p> --}}
                                                <p class="purple right-top-heading">
                                                    <span>HIGHLY ALIGNED</span>
                                                </p>
                                                <p>
                                            </div>
                                            <p class="table-desc" style="min-height: 18px;">
                                                Allstar is able to develop and apply effective techniques/solutions to
                                                achieve expected results.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 91%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 7%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                                style="
                                            margin-top: 20px;
                                        ">
                                                <span
                                                    style="background: #FFE4F1 !important;
                                            color: #BF3273 !important;">
                                                    Leadership / Senior Management</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar is a strategic problem-solver who consistently delivers
                                                high-impact solutions across complex, ambiguous, or cross-departmental
                                                challenges. They translate strategic needs into scalable methods,
                                                optimize operational performance, and drive continuous improvement. At
                                                this level, Allstar can further amplify impact by creating reusable
                                                playbooks, contributing to innovation labs, and facilitating
                                                enterprise-wide solutioning initiatives
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Standards Setting <span style="color: #F00;"> 81% </span>
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
                                                Allstar shapes critical work standards and expectations, makes sound
                                                business decision when faced with complex and contradictory
                                                alternatives.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 81%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 17%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar actively sets and reinforces critical standards across key
                                                workstreams and navigates complex or conflicting decisions with logic,
                                                insight, and consideration of broader impacts. They assess risks,
                                                stakeholder needs, and long-term consequences to recommend or implement
                                                viable strategies. To continue developing, Allstar can facilitate
                                                decision-making frameworks (e.g., SWOT, decision trees), lead peer
                                                reviews to evaluate outcomes, and collaborate across departments to
                                                align expectations and execution.
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
                                                <p>Proactive Issue Resolution <span style="color: #F00;"> 83% </span>
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
                                                Allstar escalates unusual findings and develop multiple ways to address
                                                the issues.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 83%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 15%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar consistently surfaces unusual or high-risk findings early and
                                                evaluates issues from multiple angles. They present well-structured
                                                options to resolve challenges, outlining pros, cons, and dependencies
                                                for each. To further develop, Allstar can take ownership of
                                                issue-tracking dashboards, co-lead resolution working groups, and refine
                                                their communication to clearly articulate risk and urgency when
                                                escalating.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Performance Resilience <span style="color: #F00;"> 68% </span>
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
                                                Allstar continuously focus on achieving results even under tough
                                                circumstances.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 68%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 30%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar shows commitment to achieving tasks, even when minor challenges
                                                arise. They respond to pressure with some hesitation but are able to
                                                meet expectations with support or guidance. To advance, Allstar should
                                                track performance during tough periods, proactively seek help when
                                                overwhelmed, and gradually take on time-sensitive or high-pressure
                                                assignments. Setting SMART goals and practicing time-blocking can also
                                                enhance focus and execution.
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
                                                <p>Operational Change Leadership <span style="color: #F00;">
                                                        71% </span>
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
                                                Allstar leads specific changes in the system or in work methods to
                                                improve business performance.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 71%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 27%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar supports changes in operational methods and contributes to
                                                process improvements when guided. They begin to understand how workflow
                                                changes affect business outcomes and may suggest enhancements within
                                                their immediate scope. To advance, Allstar should map current vs. ideal
                                                workflows, propose updates backed by observations or data, and track
                                                performance before and after a change. Managers can involve Allstar in
                                                rollout planning and team feedback sessions.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="main-top-heading mb-7">AirAsia Leadership</h4>
            <h4 class="main-top-heading mb-7" style="font-size: 28px;">Lead Business</h4>
            <div class="d-flex mb-9 card">
                <div class="col-xl-12 p-0">
                    <!--begin::Engage widget 1-->
                    <div class="psych-inner" dir="ltr">
                        <div class="top-head-view d-flex justify-content-between align-items-base"
                            style="margin-bottom: 45px;">
                            <!--begin::Title-->
                            <div>
                                <h3 class="fw-medium lh-base m-0 d-flex align-items-center gap-4"
                                    style="color: #5B5B5B; font-size: 28px;">Leading Strategy <span
                                        class="top-ranks-box success-green">81st</span>
                                </h3>
                                <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                        style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                        Contributor</span>
                                </p>
                            </div>
                        </div>
                        <div class="skill-table">
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Transformer behaviors <span style="color: #F00;"> 65%
                                                    </span>
                                                    {{-- <p
                                                    class="purple right-top-heading">
                                                    <span>
                                                        HIGHLY ALIGNED</span>
                                                </p> --}}
                                                <p class="cyan right-top-heading">
                                                    <span>ALIGNED</span>
                                                </p>
                                                <p>
                                            </div>
                                            <p class="table-desc" style="min-height: 18px;">
                                                Transformer behaviors require that the leader frequently conceives new
                                                ways of generating business models that the organization has not tried.
                                                Skilled transformers produce ideas that are complementary to existing
                                                business, but they are also not afraid to devise strategies that disrupt
                                                the existing business before a competitor does.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 65%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 33%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar demonstrates a willingness to consider new ways of doing
                                                business and can contribute incremental ideas that align with current
                                                strategies. They may suggest enhancements to existing models or minor
                                                adaptations in response to customer feedback or market trends. To
                                                progress, Allstar should analyze business models in other industries,
                                                co-develop simple innovation experiments, and use frameworks like the
                                                Business Model Canvas to visualize new possibilities.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Operator behaviors <span style="color: #F00;"> 62% </span>
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
                                                Scanning the environment to take advantage of market opportunities to
                                                create additional profitability within the confines of existing
                                                strategy. Skillful operators anticipate these opportunities before any
                                                competitors do and have a very precise process for doing so
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 62%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 34%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar demonstrates growing awareness of market dynamics and
                                                occasionally surfaces ideas that align with the organization’s strategy.
                                                They recognize patterns in performance data, customer feedback, or
                                                competitor behavior and may suggest improvements to capitalize on these
                                                insights. To progress, Allstar should adopt a structured environmental
                                                scanning routine such as reviewing market trend reports or analyzing
                                                competitor product changes—and test their hypotheses through team
                                                discussions or small experiments.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="top-head-view d-flex justify-content-between align-items-base"
                                style="margin-bottom: 45px;">
                                <!--begin::Title-->
                                <div>
                                    <h3 class="fw-medium lh-base m-0 d-flex align-items-center gap-4"
                                        style="color: #5B5B5B; font-size: 28px;">Leading Execution <span
                                            class="top-ranks-box success-green">89th</span>
                                    </h3>
                                    <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                            style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                            Contributor</span>
                                    </p>
                                </div>
                            </div>
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Experimenter behavior <span style="color: #F00;"> 76% </span>
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
                                                Leader conceives a set of hypotheses related to new activities that
                                                might improve the performance of existing or future businesses, sets out
                                                to collect the right data to test these hypotheses, analyzes the data,
                                                and implements successful experiments at scale, or learns from failed
                                                experiments
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 76%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 22%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar systematically designs experiments with clear hypotheses,
                                                relevant metrics, and thoughtful data plans. They know how to structure
                                                pilots, extract learnings, and either scale successes or document key
                                                takeaways from failures. Their experimentation efforts contribute
                                                directly to business performance improvements. To advance, Allstar
                                                should take the lead in cross-functional innovation trials, establish
                                                feedback loops to refine assumptions quickly, and build libraries of
                                                validated approaches to share across teams.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Implementer Behavior <span style="color: #F00;"> 68% </span>
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
                                                Drawing up plans to ensure that strategic goals are met, converting
                                                these plans into detailed procedures for others to follow, creating
                                                budgets to support these goals and procedures, drawing up contingency
                                                plans, continuous monitoring of execution goals, and quickly rectifying
                                                any issues that might arise to ensure success.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 68%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 30%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar contributes to building and following structured plans aligned
                                                with strategic objectives. They support the development of procedures,
                                                identify potential execution gaps, and take initiative to monitor
                                                progress against milestones. To advance, Allstar should lead a small
                                                project end-to-end—drafting detailed procedures, building a simple
                                                budget, and establishing checkpoints for progress tracking.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="main-top-heading mb-7" style="font-size: 28px;">Lead People</h4>
            <div class="d-flex mb-9 card">
                <div class="col-xl-12 p-0">
                    <!--begin::Engage widget 1-->
                    <div class="psych-inner" dir="ltr">
                        <div class="top-head-view d-flex justify-content-between align-items-base"
                            style="margin-bottom: 45px;">
                            <!--begin::Title-->
                            <div>
                                <h3 class="fw-medium lh-base m-0 d-flex align-items-center gap-4"
                                    style="color: #5B5B5B; font-size: 28px;">Leading Stakeholders <span
                                        class="top-ranks-box success-green">67th</span>
                                </h3>
                                <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                        style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                        Contributor</span>
                                </p>
                            </div>
                        </div>
                        <div class="skill-table">
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Networker behavior <span style="color: #F00;"> 54%
                                                    </span>
                                                    {{-- <p
                                                    class="purple right-top-heading">
                                                    <span>
                                                        HIGHLY ALIGNED</span>
                                                </p> --}}
                                                <p class="orange right-top-heading">
                                                    <span>
                                                        NEEDS DEVELOPMENT</span>
                                                </p>
                                                <p>
                                            </div>
                                            <p class="table-desc" style="min-height: 18px;">
                                                Forming personal relationships based on mutual trust with several
                                                stakeholders inside and outside the organization, carefully
                                                understanding their needs, and thinking through different ways of
                                                meeting them. Skilled networkers will scrutinize the structure of the
                                                relationships to look for opportunities to introduce people to each
                                                other, or form coalitions, all in the service of creating social
                                                indebtedness that can be turned into influence
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 54%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 44%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFF0CF !important;;
                                                    color: #F7941C !important;">
                                                    NON-EXECUTIVE</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar is learning the value of stakeholder relationships but may
                                                interact transactionally or focus solely on immediate team members. They
                                                may hesitate to build connections beyond their function or overlook
                                                opportunities to engage others. At this stage, Allstar should start by
                                                observing how strong networkers engage across the organization, practice
                                                building rapport with peers in different departments, and attend
                                                cross-functional or industry events
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Administrator behavior <span style="color: #F00;"> 48% </span>
                                                    {{-- <p
                                                    class="purple right-top-heading">
                                                    <span>
                                                        HIGHLY ALIGNED</span>
                                                </p> --}}
                                                <p class="orange right-top-heading">
                                                    <span>
                                                        NEEDS DEVELOPMENT</span>
                                                </p>
                                                <p>
                                            </div>
                                            <p class="table-desc" style="min-height: 18px;">
                                                Identifying the needs of others, and then asserting control over
                                                resources wanted by others, with the intent of providing these resources
                                                in exchange for influence. Skilled administrators try to anticipate how
                                                formal power structure might change to develop contingency plans to
                                                ensure that their formal power stays intact despite organizational
                                                changes
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 48%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 50%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFF0CF !important;;
                                                    color: #F7941C !important;">
                                                    NON-EXECUTIVE</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar is learn to grasp how control over resources (e.g., information,
                                                time, access, or budget) influences power within an organization but may
                                                lack the strategic mindset to manage those resources deliberately. Their
                                                focus may lean toward fairness or efficiency rather than influence. At
                                                this stage, Allstar should develop political awareness by observing how
                                                decisions are made, understanding who holds key resources, and tracking
                                                how influence flows in their team or department.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="top-head-view d-flex justify-content-between align-items-base"
                                style="margin-bottom: 45px;">
                                <!--begin::Title-->
                                <div>
                                    <h3 class="fw-medium lh-base m-0 d-flex align-items-center gap-4"
                                        style="color: #5B5B5B; font-size: 28px;">Leading People <span
                                            class="top-ranks-box success-green">81st</span>
                                    </h3>
                                    <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                            style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                            Contributor</span>
                                    </p>
                                </div>
                            </div>
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Coaching behavior <span style="color: #F00;"> 65% </span>
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
                                                Which use precise line of questioning to allow subordinates to produce
                                                their own solutions
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 65%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 33%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>

                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FEEDE5 !important;
                                            color: #F36C08 !important;">
                                                    Individual Contributor</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar uses simple but effective coaching questions to support
                                                problem-solving, often helping team members clarify their thoughts or
                                                next steps. They are beginning to withhold advice to let others arrive
                                                at solutions, though they may still intervene when patience or
                                                confidence is low. To advance, Allstar should plan coaching
                                                conversations intentionally, preparing key questions that challenge
                                                assumptions or encourage ownership. Role-playing coaching scenarios and
                                                seeking feedback on their questioning style can strengthen their
                                                confidence and consistency.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Conductor Behavior <span style="color: #F00;"> 74% </span>
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
                                                Telling people what to do
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 74%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 26%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar confidently leads through instruction, coordinating multiple
                                                individuals or groups with precision. They provide direction that aligns
                                                with strategic objectives and adjust their level of control based on the
                                                task and capability of others. To continue growing, Allstar should lead
                                                high-stakes projects requiring synchronized execution, use briefing and
                                                debriefing sessions to reinforce team alignment, and document procedures
                                                that enable others to execute independently over time.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="main-top-heading mb-7" style="font-size: 28px;">Leading Self</h4>
            <div class="d-flex mb-9 card">
                <div class="col-xl-12 p-0">
                    <!--begin::Engage widget 1-->
                    <div class="psych-inner" dir="ltr">
                        <div class="top-head-view d-flex justify-content-between align-items-base"
                            style="margin-bottom: 45px;">
                            <!--begin::Title-->
                            <div>
                                <h3 class="fw-medium lh-base m-0 d-flex align-items-center gap-4"
                                    style="color: #5B5B5B; font-size: 28px;">Leading Self <span
                                        class="top-ranks-box success-green">93rd</span>
                                </h3>
                                <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span
                                        style="background: #FEEDE5 !important;
                                            color: #F36B0A; border-radius: 8px; padding: 2px 8.6px;     font-size: 11px; text-transform: uppercase;">Individual
                                        Contributor</span>
                                </p>
                            </div>
                        </div>
                        <div class="skill-table">
                            <div class="all-star">
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Regenerators <span style="color: #F00;"> 87% </span>
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
                                                Engage in a variety of practices that create deeper mindfulness, which
                                                can include mediation or talk therapy. They also engage in a set of
                                                practices that allow them to disconnect from the work environment,
                                                including hobbies or sports, that allow them to recenter quickly
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 87%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 11%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>

                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar consistently practices self-renewal techniques that enhance
                                                focus, resilience, and emotional regulation. They use strategies such as
                                                meditation, talk therapy, fitness routines, or deep creative outlets to
                                                reset and return to work with clarity. To grow further, Allstar should
                                                share their regenerative practices with peers, integrate them into team
                                                rituals (e.g., mindful openings, wellness check-ins), and adjust their
                                                work rhythms to protect high-performance recovery cycles.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>Explorers <span style="color: #F00;"> 82% </span>
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
                                                Constantly expose themselves to new experiences outside the domain of
                                                their expertise, their comfort zone, or people they know. They know how
                                                to spark creative anxiety that they will fail as leaders unless they
                                                constantly learn and grow.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: 82%; background: #FF5D5D;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: 16%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                                </div>
                                            </div>
                                            <p class="spring right-top-heading"
                                                style="
                                                    margin-top: 20px;
                                                ">
                                                <span
                                                    style="background: #FFE8E8 !important;;
                                                    color: #FF2E2E !important;">
                                                    Managers</span>
                                            </p>
                                            <p class="table-desc">
                                                Allstar regularly seeks out diverse environments and new stimuli to fuel
                                                personal and leadership development. They purposefully place themselves
                                                in discomfort zones—joining unconventional teams, exploring unfamiliar
                                                industries, or soliciting feedback that challenges their assumptions. To
                                                grow further, Allstar should design learning roadmaps that span
                                                personal, technical, and relational domains, host dialogue sessions with
                                                outsiders to bring in fresh perspectives, and mentor others in embracing
                                                discomfort as a growth tool.
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
