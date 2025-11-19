<div class="modal fade" id="viewJobModel" tabindex="-1" aria-labelledby="viewJobModelLabel">
    <div class="modal-dialog modal-xl modal-dialog-centered view-job">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewJobModelLabel">Modal title</h1>
            </div> --}}

             <!-- Modal overlay inside the modal -->
             <div id="modal-overlay" class="d-none align-items-center justify-content-center" 
             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.7); z-index: 1050;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
            <div class="view-job-header bg-white d-flex justify-content-between">
                <div>
                    <p style="margin-bottom: 8px;">Job Title</p>
                    <h4>Software Engineer III, Full Stack</h4>
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center gap-1">
                            <iconify-icon icon="lucide:briefcase" width="16" height="16"
                                style="color:#99A1B7;"></iconify-icon>
                            <p class="m-0" id="employment_type">Full-time</p>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <iconify-icon icon="basil:location-outline" width="16" height="16"
                                style="color:#99A1B7;"></iconify-icon>
                            <p class="m-0" id="location">Johor, Malaysia</p>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <iconify-icon icon="mdi:clock-outline" width="16" height="16"
                                style="color:#99A1B7;"></iconify-icon>
                            <p class="m-0" id="created_at">Posted 24.10.2024</p>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close" style="opacity: 1;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="view-job-body d-flex">
                <div class="view-job-left-side">
                    <div class="mb-8">
                        <h5 class="mb-2">Job Details</h5>
                        <p>The Group Supervisor of Benefits Administration oversees the strategic planning,
                            implementation, and
                            administration of employee benefits programs within the organization. This role ensures that
                            benefits offerings are competitive, compliant with regulations, and aligned with
                            organizational
                            goals to support employee well-being and retention. Develop and execute strategic plans for
                            employee
                            benefits programs, including health insurance, retirement plans, wellness programs, and
                            other perks.
                            Supports the execution of benefits plans. Performs bench marking for the organization's
                            benefits
                            programs with comparable organizations. Collaborates with benefits partners and vendors for
                            claim
                            disbursements. He is also responsible for ensuring the benefits records in the systems are
                            accurate
                            and that regulatory guidelines are adhered to. He performs data analytics and shares
                            insights
                            reports with senior members of the team. Thrives in a team environment, and is comfortable
                            communicating with various stakeholders within and beyond the team. Possesses an analytical
                            mind and
                            is able to derive insights from data, leveraging them to address issues and derive solutions
                            to work
                            challenges. He/She is comfortable communicating with various stakeholders within and beyond
                            the
                            team.</p>
                    </div>
                    <div class="accordion pb-5" id="accordionExample">
                        <div class="accordion-item mb-5">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSoftSkills" aria-expanded="false"
                                    aria-controls="collapseSoftSkills">
                                    Job Skills
                                </button>
                            </h2>
                            <div id="collapseSoftSkills" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul>
                                      
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-5">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTechnicalSkills" aria-expanded="false"
                                    aria-controls="collapseTechnicalSkills">
                                    Job Technical Skills
                                </button>
                            </h2>
                            <div id="collapseTechnicalSkills" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-5">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseCriticalWorkFunctions" aria-expanded="false"
                                    aria-controls="collapseCriticalWorkFunctions">
                                    Job Critical Work Functions
                                </button>
                            </h2>
                            <div id="collapseCriticalWorkFunctions" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="view-job-sidebar">
                    <div class="box">
                        <h4 class="mb-3">Interested in this role?</h4>
                        <div class="d-flex gap-3">
                            <a class="btn btn-apply" href="" id="applynow">Apply Now</a>
                            <button class="btn btn-outline " id="shareButton" onclick="sharePage()"><iconify-icon
                                    icon="tabler:share" width="24" height="24"
                                    style="color: #78829D;"></iconify-icon></button>
                            <div class="btn-container">
                                <button class="btn btn-outline" id="copyButton"
                                    onclick="copyToClipboard()"><iconify-icon icon="lets-icons:copy" width="24"
                                        height="24" style="color: #78829D;"></iconify-icon></button>
                                <span class="tooltip">Copied to clipboard!</span>
                            </div>
                        </div>
                        <div class="box mt-5">
                            <h4 class="mb-3">Company Overview</h4>
                            <p class="m-0" id="company-overview">This is a community of innovators and
                                problem-solvers, united by a shared
                                passion for
                                meaningful impact. With collaborative workspaces, exciting projects, and employee-driven
                                initiatives, we foster a culture that celebrates curiosity and supports professional
                                growth.
                                Known
                                for our commitment to work-life balance, diversity, and sustainability, we empower team
                                members to
                                thrive both personally and professionally.</p>
                            <h4 class="mt-8 mb-3">Job Qualifications</h4>
                            <h5 class="mb-1">Education Level</h5>
                            <p class="mb-3" id="education-level">Bachelor</p>
                            <h5 class="mb-1">Education Program</h5>
                            <p class="mb-3" id="education-program">Bachelor of Elementary Education</p>
                            <h5 class="mb-1">Work Experience</h5>
                            <p class="mb0" id="work-experience">5 Years</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('style')
        <style>
            .view-job {
                padding: 80px 10px 120px 10px;
            }

            .view-job-header {
                padding: 24px 24px 24px 48px;
                border-radius: 8px 8px 0px 0px;
                border: 1px solid #F1F1F4;
                box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            }

            .view-job-header h4 {
                color: #071437;
                font-size: 22.75px;
                font-weight: 500;
                line-height: 27.3px;
                margin-bottom: 8px;
            }

            .view-job-header p {
                color: #99A1B7 !important;
                font-size: 13.975px !important;
                font-weight: 500 !important;
                line-height: 16.77px !important;
            }

            .view-job-body {
                padding: 48px;
                border-radius: 0px 0px 8px 8px;
                border-right: 1px solid #F1F1F4;
                border-bottom: 1px solid #F1F1F4;
                border-left: 1px solid#F1F1F4;
                background: #FFF;
                box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
                gap: 26px;
            }

            .view-job-sidebar {
                width: 36%;
            }

            .view-job-left-side {
                width: 62%;
            }

            .view-job-left-side h5 {
                color: #071437;
                font-size: 19.5px;
                font-weight: 500;
                line-height: 23.4px;
            }

            .view-job-left-side p {
                color: #4B5675 !important;
                font-size: 16px !important;
                font-weight: 400 !important;
                line-height: 25px !important;
            }

            .view-job-left-side .accordion-button,
            .view-job-left-side .accordion-item {
                padding: 16px;
                border-radius: 8px;
                font-size: 16.25px;
                font-weight: 500;
                border: 0;
                line-height: 19.5px;
            }

            .view-job-left-side .accordion-body {
                padding: 20px 0px 0px;
            }

            .view-job-left-side .accordion-body ul li {
                color: #4B5675;
                font-size: 14px;
                font-weight: 400;
                line-height: 20px;
            }

            .view-job-left-side .accordion-button {
                padding: 0px;
            }

            .view-job-left-side .accordion-item {
                border: 1px solid #DBDFE9;
            }

            .view-job-left-side .accordion-button:not(.collapsed) {
                color: #071437;
                box-shadow: none;
                background: none;
            }

            .view-job-sidebar .box {
                padding: 24px;
                border-radius: 8px;
                background: #FAFAFB;
            }

            .view-job-sidebar h4 {
                color: #071437;
                font-size: 16.25px;
                font-weight: 500;
                line-height: 19.5px;
            }

            .view-job-sidebar p {
                color: #4B5675 !important;
                font-size: 14px !important;
                font-weight: 400 !important;
                line-height: 22px !important;
            }

            .view-job-sidebar h5 {
                color: #4B5675;
                font-size: 14px;
                font-weight: 700;
                line-height: 22px;
            }

            .view-job-sidebar button {
                display: flex;
                padding: 14px 20px;
                justify-content: center;
                align-items: center;
                border-radius: 4px;
            }

            .view-job-sidebar .btn-apply {
                background: #F7941C;
                color: #FFF;
                font-size: 14px;
                font-weight: 600;
                line-height: 20px;
                flex: 1 0 0;
            }

            .view-job-sidebar .btn-outline {
                display: flex;
                width: 48px;
                height: 48px;
                justify-content: center;
                align-items: center;
                border: 1px solid #99A1B7 !important;
                background: #FFF;
            }

            /* Skeleton Loader Styles */
            .skeleton-loader {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
                justify-content: center;
            }

            .skeleton-card {
                width: 300px;
                padding: 15px;
                background-color: #f0f0f0;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .skeleton-title,
            .skeleton-date,
            .skeleton-location,
            .skeleton-text,
            .skeleton-btn {
                background-color: #ddd;
                border-radius: 4px;
                margin-bottom: 10px;
            }

            .skeleton-title {
                width: 80%;
                height: 20px;
            }

            .skeleton-meta {
                display: flex;
                justify-content: space-between;
            }

            .skeleton-date,
            .skeleton-location {
                width: 40%;
                height: 12px;
            }

            .skeleton-text {
                width: 100%;
                height: 50px;
            }

            .skeleton-btn {
                width: 45%;
                height: 36px;
            }

            .skeleton-btn:nth-child(2) {
                width: 45%;
            }

            .skeleton-loader .skeleton-card {
                animation: skeleton-loading 1.5s infinite ease-in-out;
            }

            @keyframes skeleton-loading {
                0% {
                    background-color: #f0f0f0;
                }

                50% {
                    background-color: #e0e0e0;
                }

                100% {
                    background-color: #f0f0f0;
                }
            }
            .btn-apply-disabled{
            background: #F1F1F4;
            color: #8b8b8b; 
            border: 1px solid #DBDFE9;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            flex: 1 0 0;
        }
        .btn-apply-disabled:hover{
            background: #F1F1F4;
            color: #8b8b8b; 
            border: 1px solid #DBDFE9;
        }
        .btn-apply-disabled:active{
            background: #F1F1F4 !important;
            color: #8b8b8b !important; 
            border: 1px solid #DBDFE9 !important;
        }
        </style>
        <style>
            .tooltip {
                visibility: hidden;
                background-color: black;
                color: #fff;
                text-align: center;
                border-radius: 5px;
                padding: 5px;
                position: absolute;
                z-index: 1;
                top: -35px;
                left: 50%;
                transform: translateX(-50%);
                opacity: 0;
                transition: opacity 0.3s;
            }

            .btn-container {
                position: relative;
                display: inline-block;
            }

            .btn-container.show-tooltip .tooltip {
                visibility: visible;
                opacity: 1;
            }
        </style>
    @endpush
    @push('script')
    
        <script>
            var employmentStatuses = @json(config('constants.EMPLOYMENT_STATUSES'));
            var authuser = @json(auth()->user() ? 1 : 0);
        </script>
    @endpush
