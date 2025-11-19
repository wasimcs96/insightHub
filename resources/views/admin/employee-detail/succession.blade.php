    <style>
        .table-container {
            overflow-x: auto;
            overflow-y: auto;
            height: auto;
            padding-bottom: 5%;
        }
        /* Table styling */
        .custom-table,
        .custom-table-2 {
            width:max-content;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .custom-table thead th,
        .custom-table-2 thead th {
            padding: 16px;
            color: #4B5675;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            border-bottom: 1px solid #DBDFE9;
        }

        .custom-table tr th:nth-child(3),
        .custom-table tbody td:nth-child(3) {
            background: #FFF5DA;
        }

        .custom-table-2 th:nth-child(4),
        .custom-table-2 td:nth-child(4),
        .custom-table-2 th:nth-child(6),
        .custom-table-2 td:nth-child(6) {
            background: #FAFAFB;
        }

        .custom-table th:nth-child(5),
        .custom-table td:nth-child(5),
        .custom-table th:nth-child(7),
        .custom-table td:nth-child(7),
        .custom-table th:nth-child(9),
        .custom-table td:nth-child(9),
        .custom-table th:nth-child(11),
        .custom-table td:nth-child(11) {
            background: #FAFAFB;
        }

        .employee-head {
            display: grid;
            grid-template-columns: 76% 10%;
        }

        .employee-head p,
        .top-row p {
            margin: 0;
        }

        .top-row {
            display: flex;
            gap: 24px;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            height: 90px;
        }

        .custom-table tbody td,
        .custom-table-2 tbody td {
            text-align: center;
            padding: 16px;
            font-size: 0.9rem;
            vertical-align: middle;
            border-bottom: 1px solid #DBDFE9;
        }

        .employee-info {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .employee-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .employee-info .employee-name {
            color: #071437;
            font-size: 14px;
            font-weight: 600;
            line-height: normal;
            margin: 0;
            text-align: left;
        }

        .employee-info .employee-role {
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            margin: 0;
            text-align: left;
            margin-bottom: 5px;
        }

        .table-status {
            border-radius: 15px;
            padding: 4px 12px;
            width: max-content;
        }

        .high {
            background-color: #DDF5E2;
            color: #196329;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .moderate {
            background-color: #FFEBB4;
            color: #EB8100;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .low {
            background-color: #ffcdd2;
            color: #d32f2f;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .high-risk {
            background-color: #FFE0DD;
            color: #AA2D22;
            border-radius: 15px;
            padding: 4px 12px;
        }

    </style>
     
     
     {{-- <!--begin::Panel 4-->
     <div class="h-full" role="tabpanel">
        <!--begin::Col 1 -->
        <div class="succession-head"><iconify-icon icon="material-symbols:table-chart-view-outline"
                class="success-chart"></iconify-icon>
            <p>Succession Plan</p>
        </div>
        <div class="d-flex mb-4 gap-4 mt-4">
            <div class="card col p-0 card-orange">
                <div class="success-inner p-4 d-grid gap-3">
                    <div class="success-top d-flex justify-content-between align-items-center">
                        <div class="s-top-left d-flex align-items-center gap-1">
                            <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                            <p class="m-0 fs-4 fw-medium">1</p>
                        </div>
                        <div class="s-top-right">
                            <span class="s-yellow-right">65% Match</span>
                        </div>
                    </div>
                    <div class="s-head-content">
                        <div class="d-flex gap-2 align-items-center s-head-span">
                            <h5 class="m-0">Turnaround Coordinator</h5>
                            <span class="s-current">Current</span>
                        </div>
                        <p class="mb-0 mt-2">The Turnaround Coordinator at AirAsia is responsible for
                            ensuring the smooth and
                            efficient management of flight operations during turnaround processes. This role
                            involves coordinating with relevant stakeholders such as airlines, airport
                            agencies, and authorities to resolve any operational issues. The coordinator
                            ensures all flight planning activities align with Standard Operating Procedures
                            (SOPs) and established standards. They oversee safety and security protocols,
                            performing checks and investigations into breaches. Additionally, the role
                            requires strong leadership, as the coordinator mentors team members, resolves
                            conflicts, and maintains high communication standards to foster positive
                            relationships with both internal and external parties. The position requires a
                            solid understanding of flight watching systems and the ability to manage
                            operations across varying shifts.
                        </p>
                    </div>
                    <div class="s-skill-requirement">
                        <p class="m-0 fw-medium">Skill requirement</p>
                    </div>
                    <div class="s-green-text d-flex align-items-center">
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
    color: #218336;
">
                            <p class="m-0">Communication</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
    color: #218336;
">
                            <p class="m-0">Customer Orientation</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
    color: #218336;
">
                            <p class="m-0">Decision Making</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
    color: #218336;
">
                            <p class="m-0">Problem Solving</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-yellow-btn d-flex gap-3 align-items-center">
                            <p class="m-0">Accident and Incident Response Management</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-more-skill-btn">
                            + 10 more skills
                        </div>
                    </div>
                </div>
                <a href="https://airasia.theinsightaccess.com/admin/saved-jobdescriptions?search=ro&org_department=4&saved_job=1&selected_job=4696" class="s-more-info-btn">
                   More info <iconify-icon icon="iconamoon:arrow-right-2" class="s-info-btn"></iconify-icon>
               </a>
            </div>

            <div class="card col p-0 card-cyan">
                <div class="success-inner p-4 d-grid gap-3">
                    <div class="success-top d-flex justify-content-between align-items-center">
                        <div class="s-top-left d-flex align-items-center gap-1">
                            <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                            <p class="m-0 fs-4 fw-medium">1</p>
                        </div>
                        <div class="s-top-right">
                            <span class="s-green-right">93% Match</span>
                        </div>
                    </div>
                    <div class="s-head-content">
                        <div class="d-flex gap-2 align-items-center s-head-span">
                            <h5 class="m-0">Rostering Planner</h5>
                            <span class="s-career-goal">Next Career Goal</span>
                        </div>
                        <p class="mb-0 mt-2">The Rostering Planner at AirAsia is responsible for managing
                            and optimizing crew rosters to ensure efficient deployment and compliance with
                            regulatory and operational requirements. This role involves monitoring flight
                            operations, including aircraft performance, movements, and operating conditions,
                            and adjusting crew schedules as needed to address irregularities. The Rostering
                            Planner collaborates with internal teams and stakeholders to recover disrupted
                            flight schedules and ensures adherence to safety and security standards. Working
                            in a shift-based environment, the Rostering Planner demonstrates strong resource
                            management skills and excels in preparing and managing schedules. Effective
                            communication and interpersonal skills are essential to work collaboratively
                            with team members, pilots, and stakeholders. The ideal candidate is
                            detail-oriented, adaptable, and maintains high performance and alertness during
                            flight watch periods.
                        </p>
                    </div>
                    <div class="s-skill-requirement">
                        <p class="m-0 fw-medium">Skill requirement</p>
                    </div>
                    <div class="s-green-text d-flex align-items-center">
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Collaboration</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Communication</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Airline Operations Management</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-yellow-btn d-flex gap-3 align-items-center">
                            <p class="m-0">Change Management</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-yellow-btn d-flex gap-3 align-items-center">
                            <p class="m-0">Data Analytics</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-more-skill-btn">
                            + 10 more skills
                        </div>
                    </div>
                </div>
                <a href="https://airasia.theinsightaccess.com/admin/saved-jobdescriptions?search=ro&org_department=4&saved_job=1&selected_job=4696" class="s-more-info-btn">
                   More info <iconify-icon icon="iconamoon:arrow-right-2" class="s-info-btn"></iconify-icon>
               </a>
            </div>

            <div class="card col p-0 card-orange">
                <div class="success-inner p-4 d-grid gap-3">
                    <div class="success-top d-flex justify-content-between align-items-center">
                        <div class="s-top-left d-flex align-items-center gap-1">
                            <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                            <p class="m-0 fs-4 fw-medium">2</p>
                        </div>
                        <div class="s-top-right">
                            <span class="s-yellow-right">63% Match</span>
                            <a href="#" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <iconify-icon icon="ph:dots-three-outline-vertical-bold" width="16" height="16"></iconify-icon></a>
                            <div class="menu menu-sub menu-sub-dropdown p-3 text-left drop-content"
                                data-kt-menu="true" id="kt_menu_65e95fe68ac03">
                                <p class="m-0 px-4 py-2 cursor-pointer" id="tagSuccessor">Tag as successor</p>
                                <p class="m-0 px-4 py-2 cursor-pointer" id="removeSuccessor" style="display: none">Remove as successor</p>
                            </div>
                        </div>
                    </div>
                    <div class="s-head-content">
                        <div class="d-flex gap-2 align-items-center s-head-span">
                            <h5 class="m-0">Rostering Planning Supervisor</h5>
                            <iconify-icon icon="ri:arrow-up-circle-line"
                                style="color: #78829D; font-size: 24px;" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="Successor"></iconify-icon>
                        </div>
                        <p class="mb-0 mt-2">The Rostering Planning Supervisor at AirAsia is a leadership
                            role responsible for coordinating crew scheduling and overseeing critical
                            operational functions to ensure seamless flight operations. This role involves
                            managing crew rosters, tracking flight crew hours, and implementing changes to
                            operations while ensuring compliance with safety and security standards. The
                            Rostering Planning Supervisor performs impact analyses of external issues,
                            investigates causes and cost implications of irregular operations, and develops
                            strategies to address disruptions. As a supervisor, this role includes coaching
                            team members, creating on-the-job training plans, and fostering a
                            high-performance culture. Operating in a shift-based environment, the Rostering
                            Planning Supervisor demonstrates exceptional organizational skills, remains calm
                            under pressure, and effectively handles complex operational challenges.
                        </p>
                    </div>
                    <div class="s-skill-requirement">
                        <p class="m-0 fw-medium">Skill requirement</p>
                    </div>
                    <div class="s-green-text d-flex align-items-center">
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Collaboration</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Communication</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Digital Fluency</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Learning Agility</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-yellow-btn d-flex gap-3 align-items-center">
                            <p class="m-0">Flight Performance Data Calculation</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-more-skill-btn">
                            + 10 more skills
                        </div>
                    </div>
                </div>
                <a href="https://airasia.theinsightaccess.com/admin/saved-jobdescriptions?search=ro&org_department=4&saved_job=1&selected_job=4696" class="s-more-info-btn">
                   More info <iconify-icon icon="iconamoon:arrow-right-2" class="s-info-btn"></iconify-icon>
               </a>
            </div>
        </div>
        <div class="d-flex mb-4 gap-4">
            <div class="card col p-0 card-orange">
                <div class="success-inner p-4 d-grid gap-3">
                    <div class="success-top d-flex justify-content-between align-items-center">
                        <div class="s-top-left d-flex align-items-center gap-1">
                            <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                            <p class="m-0 fs-4 fw-medium">3</p>
                        </div>
                        <div class="s-top-right">
                            <span class="s-yellow-right">63% Match</span>
                            {{-- <iconify-icon icon="ph:dots-three-outline-vertical-bold" width="16" height="16"></iconify-icon> --}}
                        {{-- </div>
                    </div>
                    <div class="s-head-content">
                        <div class="d-flex gap-2 align-items-center s-head-span">
                            <h5 class="m-0">Manager Rostering & Advanced Crewing</h5>
                        </div>
                        <p class="mb-0 mt-2">The Manager, Rostering & Advanced Crewing at AirAsia is a
                            pivotal leadership role responsible for planning, directing, and coordinating
                            crew scheduling and advanced crewing operations to ensure optimal efficiency,
                            safety, and compliance. This role involves managing rostering systems,
                            overseeing the administration of crew-related activities within the Operations
                            Control Center (OCC), and developing strategies to enhance crew operations.
                            During irregular operations, the Manager activates emergency response plans,
                            communicates contingency measures to stakeholders, and ensures timely recovery
                            of schedules. The role requires identifying safety and security risks and
                            implementing mitigation strategies. Additionally, the Manager oversees team
                            assessment and selection, fosters partnerships with stakeholders, and builds
                            collaborative relationships with internal and external partners, including
                            airport agencies and regulatory authorities. The ideal candidate demonstrates
                            exceptional leadership, negotiation, and problem-solving skills. They are a
                            strategic thinker, capable of maintaining composure under pressure, and adept at
                            devising solutions to address complex operational challenges.
                        </p>
                    </div>
                    <div class="s-skill-requirement">
                        <p class="m-0 fw-medium">Skill requirement</p>
                    </div>
                    <div class="s-green-text d-flex align-items-center">
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Decision Making</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Global Perspective</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Problem Solving</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-yellow-btn d-flex gap-3 align-items-center">
                            <p class="m-0">Collaboration</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-yellow-btn d-flex gap-3 align-items-center">
                            <p class="m-0">Aircraft Performance Management</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>5
                            </p>
                        </div>
                        <div class="s-more-skill-btn">
                            + 10 more skills
                        </div>
                    </div>
                </div>
                <a href="https://airasia.theinsightaccess.com/admin/saved-jobdescriptions?search=ro&org_department=4&saved_job=1&selected_job=4696" class="s-more-info-btn">
                   More info <iconify-icon icon="iconamoon:arrow-right-2" class="s-info-btn"></iconify-icon>
               </a>
            </div>

            <div class="card col p-0 card-pink">
                <div class="success-inner p-4 d-grid gap-3">
                    <div class="success-top d-flex justify-content-between align-items-center">
                        <div class="s-top-left d-flex align-items-center gap-1">
                            <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                            <p class="m-0 fs-4 fw-medium">4</p>
                        </div>
                        <div class="s-top-right">
                            <span class="s-pink-right">32% Match</span>
                            {{-- <iconify-icon icon="ph:dots-three-outline-vertical-bold" width="16" height="16"></iconify-icon> --}}
                        {{-- </div>
                    </div>
                    <div class="s-head-content">
                        <div class="d-flex gap-2 align-items-center s-head-span">
                            <h5 class="m-0">Group Head of Network Management Center</h5>
                        </div>
                        <p class="mb-0 mt-2">The Group Head of Network Management Center at AirAsia is a
                            senior leadership position responsible for the strategic oversight and alignment
                            of flight control operations across the organization. This role ensures that
                            AirAsia's flight operations adhere to the highest standards of safety,
                            efficiency, and customer satisfaction. The role involves establishing and
                            endorsing policies, response models for irregular operations, and ensuring
                            seamless coordination with internal and external stakeholders during such
                            events. As a key leader, the Group Head drives the development of safety and
                            security programs, defines organizational standards, and leads initiatives for
                            succession planning, capability development, and employee engagement. By
                            building strong international networks and professional relationships, the Group
                            Head plays a vital role in promoting AirAsia’s reputation globally. Exceptional
                            leadership, situational awareness, and attention to detail are essential for
                            this role. The Group Head leverages negotiation skills and problem-solving
                            expertise to create innovative services that enhance stakeholder and customer
                            satisfaction while fostering a high-performance organizational culture.
                        </p>
                    </div>
                    <div class="s-skill-requirement">
                        <p class="m-0 fw-medium">Skill requirement</p>
                    </div>
                    <div class="s-green-text d-flex align-items-center">
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Collaboration</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Collaboration</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>2
                            </p>
                        </div>
                        <div class="s-yellow-btn d-flex gap-3 align-items-center">
                            <p class="m-0">Customer Orientation</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>1
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
                        color: #218336;
                    ">
                            <p class="m-0">Problem Solving</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>1
                            </p>
                        </div>
                        <div class="s-yellow-btn d-flex gap-3 align-items-center">
                            <p class="m-0">Global Perspective</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-more-skill-btn">
                            + 10 more skills
                        </div>
                    </div>
                </div>
                <a href="https://airasia.theinsightaccess.com/admin/saved-jobdescriptions?search=ro&org_department=4&saved_job=1&selected_job=4696" class="s-more-info-btn">
                   More info <iconify-icon icon="iconamoon:arrow-right-2" class="s-info-btn"></iconify-icon>
               </a>
            </div>

            <div class="col p-0">
            </div>
        </div>
    </div>--}}  
    <!--end::Panel 4--> 

        <!--begin::Panel summary-->
        <div class="h-full" role="tabpanel">
            <!--begin::Col 1 -->
            <div class="succession-head" style="margin-top: 30px;">
                <p>Summary</p>
            </div>
            <div class="d-flex mb-4 gap-4 mt-4">
                <div class="table-container">
                    <table class="custom-table-2">
                        <thead>
                            <tr>
                                {{-- <th></th>
                                {{-- <th>
                                    <div class="employee-head">
                                        <p>Employee</p><iconify-icon icon="ri:arrow-down-s-line"
                                            class="info"></iconify-icon>
                                    </div>
                                </th> --}} 
                                <th>
                                    <div class="top-row">
                                        <p></p>
                                        <p>Succession Readiness</p><iconify-icon icon="ri:arrow-down-s-line"
                                            class="info"></iconify-icon>
                                    </div>
                                </th>
                                <th>
                                    <div class="top-row">
                                        <p></p>
                                        <p>Tenure</p>
                                        <p></p>
                                    </div>
                                </th>
    
                                <th>
                                    <div class="top-row">
                                        <p></p>
                                        <p>Job Skill Alignment (%)</p><iconify-icon icon="ri:arrow-down-s-line"
                                            class="info"></iconify-icon>
                                    </div>
                                </th>
                                <th>
                                    <div class="top-row">
                                        <p></p>
                                        <p>Future Role Alignment (%)</p><iconify-icon icon="ri:arrow-down-s-line"
                                            class="info"></iconify-icon>
                                    </div>
                                </th>
                                <th>
                                    <div class="top-row">
                                        <p></p>
                                        <p>Performance Rating</p><iconify-icon icon="ri:arrow-down-s-line"
                                            class="info"></iconify-icon>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                {{-- <td>
                                    <input type="checkbox">
                                </td> --}}
                                {{-- <td>
                                    <div class="employee-info">
                                        {{-- <iconify-icon icon="mingcute:round-fill" class="profile"></iconify-icon> --}}
                                        {{-- <div class="profile-name">
                                            {{-- <p class="employee-name">Kavitha Rajendran</p> 
                                            <p class="employee-role">Turnaround Coordinator</p>
                                            <p class="high table-status">High Potential</p>
                                        </div> --}}
                                        {{-- <a href="#" data-kt-menu-trigger="click"
                                            data-kt-menu-placement="bottom-end">
                                            <iconify-icon icon="entypo:dots-three-vertical"></iconify-icon>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown p-3 text-left drop-content"
                                            data-kt-menu="true" id="kt_menu_65e95fe68ac03">
                                            <a class="m-0 px-4 py-2"
                                                href="{{ route('admin.employee.details', ['id' => 3583]) }}">View
                                                Profile</a>
                                            {{-- <p class="m-0 px-4 py-2">Tag as High Potential</p> 
                                        </div> --}}
                                    {{-- </div>
                                </td> --}} 
                                <td><span class="high table-status">YES</span></td>
                                <td><span class="table-status">3 years</span></td>
                                <td><span class="high table-status">92.1%</span></td>
                                <td><span class="moderate table-status">97%</span></td>
                                <td><span class="table-status">2.76</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
        <!--end::Panel summary--> 
    
    <!--begin::Panel 4-->
     <div class="h-full" role="tabpanel">
        <!--begin::Col 1 -->
        <div class="succession-head"><iconify-icon icon="material-symbols:table-chart-view-outline"
                class="success-chart"></iconify-icon>
            <p>Succession Plan</p>
        </div>
        <div class="d-flex mb-4 gap-4 mt-4" style="max-width: 50%; align-items:center;">
            <div class="card col p-0 card-orange">
                <div class="success-inner p-4 d-grid gap-3">
                    <div class="success-top d-flex justify-content-between align-items-center">
                        <div class="s-top-left d-flex align-items-center gap-1">
                            <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                            <p class="m-0 fs-4 fw-medium">7</p>
                        </div>
                        <div class="s-top-right">
                            <span class="s-green-right">97% Match</span>
                        </div>
                    </div>
                    <div class="s-head-content">
                        <div class="d-flex gap-2 align-items-center s-head-span">
                            <h5 class="m-0">Senior Manager - People Operations & Services</h5>
                            <span class="s-career-goal" style="">Next Career Goal</span>
                        </div>
                        <p class="mb-0 mt-2">Senior Manager – People Operations and Services is the head of the People Operations and Services Department and Timekeeping group of the entire domestic projects of the organization including managing lead on the corporate events and employee engagement activities of the company.Senior Manager for HR People Operations primarily focuses on the practical, day-to-day activities that support the HR department’s functioning and the organization’s workforce. An influential and decisive leader who is able to communicate his vision clearly and address issues swiftly and effectively. Motivates and mentors others at the workplace, and is highly skilled in engaging and negotiating with stakeholders.
                        </p>
                    </div>
                    <div class="s-skill-requirement">
                        <p class="m-0 fw-medium">Skill requirement</p>
                    </div>
                    <div class="s-green-text d-flex align-items-center">
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
    color: #218336;
">
                            <p class="m-0">Collaboration</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
    color: #218336;
">
                            <p class="m-0">Communication</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
    color: #218336;">
                            <p class="m-0">Decision Making</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-green-btn d-flex gap-3 align-items-center" style="
    color: #218336;
">
                            <p class="m-0">Problem Solving</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-yellow-btn d-flex gap-3 align-items-center">
                            <p class="m-0">Developing People</p>
                            <p class="m-0 d-flex align-items-center"><iconify-icon
                                    icon="material-symbols:star" class="star"></iconify-icon>3
                            </p>
                        </div>
                        <div class="s-more-skill-btn">
                            + 10 more skills
                        </div>
                    </div>
                </div>
                <a href="https://uat-eei.theinsightaccess.com/admin/jobdescriptions?org_department=224&saved_job=1&selected_job=4783" 
                class="s-more-info-btn">
                   More info <iconify-icon icon="iconamoon:arrow-right-2" class="s-info-btn"></iconify-icon>
               </a>
            </div>
        </div>
    </div> 
    <!--end::Panel 4--> 

