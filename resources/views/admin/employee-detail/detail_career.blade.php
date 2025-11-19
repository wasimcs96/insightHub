   <style>
       .modal-dialog {
           max-width: 100vw;
           margin: 0;
       }

       .career-map-modal-header {
           display: grid;
           grid-template-columns: 33% 33% 33%;
           padding: 16px;
       }

       .bg-career-map-modal {
           background-color: #F5F5F5;
           padding: 0px;
       }

       .career-map-modal-header button {
           display: flex;
           align-items: center;
           border-radius: 80px;
           border: 1px solid #D9D9D9;
       }

       .career-map-modal-header .btn-close {
           margin-right: 0px;
           padding: 8px;
           width: 24px;
           height: 24px;
       }

       .career-map-modal-header h5 {
           text-align: center;
           color: #1E1E1E;
           font-size: 28px;
           font-style: normal;
           font-weight: 400;
           line-height: 36px;
           letter-spacing: 0px;
       }
   </style>

   <!--begin::Panel 5-->
   <div class="h-full " role="tabpanel">
       <!--begin::Col 1 -->
       <div class="succession-head">
           <p class="fw-bolder" style="font-size: 22.75px; line-height: 27.3px">Career Aspiration Goals
           </p>
       </div>
       <div class="card mb-9 p-10 d-grid gap-13 mt-4" style="color: #5B5B5B;">
           <div>
               <p class="fw-bold mb-3 fs-3">Short Term Goal:</p>
               <p class="mb-0 fs-4">Role Transition, Staff II- Officer in Charge_Timekeeping_HQ</p>
           </div>
           <div>
               <p class="fw-bold mb-3 fs-3">Long Term Goal:</p>
               <p class="mb-0 fs-4">Promotion, Senior Manager - People Operations & Services </p>
           </div>
           <div>
               <p class="fw-bold mb-3 fs-3">Desired-Future Roles:</p>
               <p class="mb-0 fs-4">Vice President - People Performance and Culture *pending approval*</p>
           </div>
           <div>
               <p class="fw-bold mb-3 fs-3">Cross-Departmental Roles:</p>
               <p class="mb-0 fs-4">No</p>
           </div>

       </div>
       <div class="career-path-head">
           <div class="succession-head"><iconify-icon icon="material-symbols:table-chart-view-outline"
                   class="success-chart"></iconify-icon>
               <p class="">Next Career Growth (Role Transition):</p>
               <div class="s-top-left d-flex align-items-center gap-1">
                   <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                   <p class="m-0 fs-4 fw-medium">3</p>
               </div>
               <p class="fw-bolder">HR Officer - People Operation & Services</p>
           </div>
           <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#careerMapModal">
               Career Map
               <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24"
                   style="margin-left: 8px;">
                   <path fill="white"
                       d="M4 20v-5h1v3.292l3.6-3.6l.708.708l-3.6 3.6H9v1zm11 0v-1h3.292l-3.6-3.6l.708-.708l3.6 3.6V15h1v5zM8.6 9.308L5 5.708V9H4V4h5v1H5.708l3.6 3.6zm6.8 0l-.708-.708l3.6-3.6H15V4h5v5h-1V5.708z" />
               </svg>
           </a>
       </div>
       <div class="modal fade" id="careerMapModal" tabindex="-1" aria-labelledby="careerMapModalLabel"
           aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header career-map-modal-header">
                       <div></div>
                       <h5 class="modal-title" id="careerMapModalLabel">Career Map Overview</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body bg-career-map-modal">
                       <!-- Embed or load the career map page here -->
                       <iframe src="{{ route('career_map') }}"
                           style="width: 100vw; height: 100vh; border: none;"></iframe>
                   </div>
               </div>
           </div>
       </div>
       <div class="d-flex mb-9 gap-4 mt-4">
           <div class="card col p-0 card-orange">
               <div class="success-inner p-4 d-grid gap-3">
                   <div class="success-top d-flex justify-content-between align-items-center">
                       <div class="s-top-left d-flex align-items-center gap-1">
                           <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                           <p class="m-0 fs-4 fw-medium">3</p>
                       </div>
                       {{-- <div class="s-top-right">
                           <span class="s-green-right">92.1% Match</span>
                       </div> --}}
                   </div>
                   <div class="s-head-content">
                       <div class="d-flex gap-2 align-items-center s-head-span">
                           <h5 class="m-0">HR Officer - People Operation & Services</h5>
                           <span class="s-current">Current</span>
                       </div>
                       <p class="mb-0 mt-2">Primary responsible for promoting a positive work environment and fostering strong relationships between employees and management. Plays the key role in resolving workplace conflicts, addressing employee concerns, and ensuring fair treatment and compliance with labor laws and regulations. Employee Relation Officer contributes to employee`s satisfaction, engagement, and retention, ultimately enhancing productivity and organizational success by maintaining a harmonious and productive workforce.
                       </p>
                   </div>
                   <div class="s-skill-requirement">
                       <p class="m-0 fw-medium">Skill requirement</p>
                   </div>
                   <div class="s-green-text d-flex align-items-center">
                       <div class="s-green-btn d-flex gap-3 align-items-center"
                           style="
                        color: #218336;
                    ">
                           <p class="m-0">Communication</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>1
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center"
                           style="
                        color: #218336;
                    ">
                           <p class="m-0">Collaboration</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>1
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center"
                           style="
                        color: #218336;
                    ">
                           <p class="m-0">Digital Fluency</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>1
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center"
                           style="
                        color: #218336;
                    ">
                           <p class="m-0">Problem Solving</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center" style="color: #218336;" >
                           <p class="m-0">Data Collection and Preparation</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center" style="color: #218336;">
                           <p class="m-0">Operational Excellence</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-yellow-btn d-flex gap-3 align-items-center">
                           <p class="m-0">Human Resource Analytics and Insights</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-yellow-btn d-flex gap-3 align-items-center">
                           <p class="m-0">Employee Communication Management</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-more-skill-btn">
                           + 10 more skills
                       </div>
                   </div>
               </div>
               <a href="https://uat-eei.theinsightaccess.com/admin/jobdescriptions?org_department=68&saved_job=1&selected_job=4750" class="s-more-info-btn">
                   More info <iconify-icon icon="iconamoon:arrow-right-2" class="s-info-btn"></iconify-icon>
               </a>
           </div>

           <div class="card col p-0 card-cyan">
               <div class="success-inner p-4 d-grid gap-3">
                   <div class="success-top d-flex justify-content-between align-items-center">
                       <div class="s-top-left d-flex align-items-center gap-1">
                           <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                           <p class="m-0 fs-4 fw-medium">3</p>
                       </div>
                       <div class="s-top-right">
                           <span class="s-green-right">96% Match</span>
                       </div>
                   </div>
                   <div class="s-head-content">
                       <div class="d-flex gap-2 align-items-center s-head-span">
                           <h5 class="m-0">Staff II- Officer in Charge_Timekeeping_HQ</h5>
                           <span class="s-career-goal">Next Career Goal</span>
                       </div>
                       <p class="mb-0 mt-2">Works under the supervision of the Senior Manager- People Operations and Services . Supervises, direct and take control of timekeeping activities such as: enforcement of procedures/restrictions on time records, hand punches, tardiness, and department''s document requirements. Ensure accuracy of their employee’s time entries as well as ensuring the time sheet sign offs are complete by the assigned deadlines. ensure that the company stays compliant with relevant policies and legal regulations.
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
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center" style="color: #218336;">
                           <p class="m-0">Communication</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center" style="color: #218336;">
                           <p class="m-0">Creative Thinking</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center" style="color: #218336;">
                           <p class="m-0">Problem Solving</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center" style="color: #218336;">
                           <p class="m-0">Transdisciplinary Thinking</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-yellow-btn d-flex gap-3 align-items-center">
                           <p class="m-0">Conduct and Behaviour Management</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>3
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center" style="color: #218336;">
                           <p class="m-0">Data Collection and Preparation</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>3
                           </p>
                       </div>
                       <div class="s-green-btn d-flex gap-3 align-items-center" style="color: #218336;">
                           <p class="m-0"> Employee Communication Management</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-yellow-btn d-flex gap-3 align-items-center">
                           <p class="m-0">Job Analysis and Evaluation</p>
                           <p class="m-0 d-flex align-items-center"><iconify-icon icon="material-symbols:star"
                                   class="star"></iconify-icon>2
                           </p>
                       </div>
                       <div class="s-more-skill-btn">
                           + 10 more skills
                       </div>
                   </div>
               </div>
               <a href="https://uat-eei.theinsightaccess.com/admin/jobdescriptions?org_department=68&saved_job=1&selected_job=4754" class="s-more-info-btn">
                   More info <iconify-icon icon="iconamoon:arrow-right-2" class="s-info-btn"></iconify-icon>
               </a>
           </div>
       </div>
       <div class="d-flex mb-9 gap-4 mt-4">
           <div class="card col-4 p-0" style="
            height: fit-content;
        ">
               <div class="success-inner p-9">
                   <div class="path-top-text"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                           viewBox="0 0 25 24" fill="none">
                           <g clip-path="url(#clip0_179_9661)">
                               <path
                                   d="M19.167 9L20.417 6.25L23.167 5L20.417 3.75L19.167 1L17.917 3.75L15.167 5L17.917 6.25L19.167 9Z"
                                   fill="#F7941C" />
                               <path
                                   d="M19.167 15L17.917 17.75L15.167 19L17.917 20.25L19.167 23L20.417 20.25L23.167 19L20.417 17.75L19.167 15Z"
                                   fill="#F7941C" />
                               <path
                                   d="M11.667 9.5L9.16699 4L6.66699 9.5L1.16699 12L6.66699 14.5L9.16699 20L11.667 14.5L17.167 12L11.667 9.5ZM10.157 12.99L9.16699 15.17L8.17699 12.99L5.99699 12L8.17699 11.01L9.16699 8.83L10.157 11.01L12.337 12L10.157 12.99Z"
                                   fill="#F7941C" />
                           </g>
                           <defs>
                               <clipPath id="clip0_179_9661">
                                   <rect width="24" height="24" fill="white"
                                       transform="translate(0.166992)" />
                               </clipPath>
                           </defs>
                       </svg>
                       <p class="m-0">Career Recommendation</p>
                   </div>
                   <p>To transition from a HR Officer - People Operation & Services to a Staff II- Officer in Charge_Timekeeping_HQ focus on enhancing
                       your
                       technical knowledge, leadership skills, and operational understanding. Gain
                       expertise in
                       regulatory compliance, develop strong communication abilities, and foster
                       collaboration
                       with various departments. Seek opportunities to lead projects and build a solid
                       network
                       within the industry.</p>
               </div>
           </div>

           <div class="card col p-0">
               <div class="success-inner p-9">
                   <div class="path-top-text mb-8"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                           height="24" viewBox="0 0 25 24" fill="none">
                           <g clip-path="url(#clip0_179_9661)">
                               <path
                                   d="M19.167 9L20.417 6.25L23.167 5L20.417 3.75L19.167 1L17.917 3.75L15.167 5L17.917 6.25L19.167 9Z"
                                   fill="#F7941C" />
                               <path
                                   d="M19.167 15L17.917 17.75L15.167 19L17.917 20.25L19.167 23L20.417 20.25L23.167 19L20.417 17.75L19.167 15Z"
                                   fill="#F7941C" />
                               <path
                                   d="M11.667 9.5L9.16699 4L6.66699 9.5L1.16699 12L6.66699 14.5L9.16699 20L11.667 14.5L17.167 12L11.667 9.5ZM10.157 12.99L9.16699 15.17L8.17699 12.99L5.99699 12L8.17699 11.01L9.16699 8.83L10.157 11.01L12.337 12L10.157 12.99Z"
                                   fill="#F7941C" />
                           </g>
                           <defs>
                               <clipPath id="clip0_179_9661">
                                   <rect width="24" height="24" fill="white"
                                       transform="translate(0.166992)" />
                               </clipPath>
                           </defs>
                       </svg>
                       <p class="m-0">Skills Gap Analysis for Staff II- Officer in Charge_Timekeeping_HQ</p>
                   </div>
                   <div class="d-grid gap-16">
                       <div>
                           <p class="fw-medium m-0 fs-4 mb-5">Soft Skill They Need:</p>
                           <div class="d-flex justify-content-between align-items-center">
                               <p class="m-0">Communication</p>
                               <div class="d-flex align-items-center gap-4">
                                   <div class="bar-career">
                                       <div class="bar" style="width: 100%"></div>
                                   </div>
                                   <span>100%</span>
                                   <p class="m-0 s-top-right"><span class="s-green-right"
                                           style="
                                            left: 0;
                                            background: #DDF5E2;
                                        padding: 4px 12px;
                                        font-size: 10px;
                                        font-weight: 600;
                                        width: 100px;
                                        text-align: center;
                                        color: #196329;
                                        text-transform: capitalize;
                                left: 0;
                                display: block;
                                        ">Completed</span>
                                   </p>
                               </div>
                           </div>
                           <div class="line-bottom mt-5"></div>
                           <div class="d-flex justify-content-between align-items-center pt-5">
                               <p class="m-0">Collaboration</p>
                               <div class="d-flex align-items-center gap-4">
                                   <div class="bar-career">
                                       <div class="bar" style="width: 100%"></div>
                                   </div>
                                   <span>100%</span>
                                   <p class="m-0 s-top-right"><span class="s-green-right"
                                           style="
                                            left: 0;
                                            background: #DDF5E2;
                                        padding: 4px 12px;
                                        font-size: 10px;
                                        font-weight: 600;
                                        width: 100px;
                                        text-align: center;
                                        color: #196329;
                                        text-transform: capitalize;
                                left: 0;
                                display: block;
                                        ">Completed</span>
                                   </p>
                               </div>
                           </div>
                       </div>
                       <div>
                           <p class="fw-medium m-0 fs-4 mb-5">Technical Skill They Need:</p>
                           <div class="d-flex justify-content-between align-items-center pb-5 pt-5">
                            <p class="m-0 fw-medium d-flex gap-2">Conduct and Behaviour Management <span
                                    class="m-0 d-flex align-items-center"><iconify-icon
                                        icon="material-symbols:star" class="star"></iconify-icon>3
                                </span></p>
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-flex align-items-center gap-3">

                                    <div class="bar-career">
                                        <div class="bar" style="width: 50%"></div>
                                    </div>
                                    <span>50%</span>
                                </div>

                                <p class="m-0 s-top-right"><span class="s-yellow-right"
                                        style="
                                     background: #FFF3E0;
                                     padding: 4px 12px;
                                     font-size: 10px;
                                     font-weight: 600;
                                     width: 100px;
                                     left: 0;
                                     text-align: center;
                                     letter-spacing: normal;
                                     text-transform: capitalize;
                                     left: 0;
                                     display: block;
                                     line-height: 14px;
                                 ">In
                                        Progress</span></p>
                            </div>

                        </div>
                           <div class="line-bottom"></div>
                           <div class="d-flex justify-content-between align-items-center pb-5 pt-5">
                               <p class="m-0 fw-medium d-flex gap-2">Human Resource Systems Management  <span
                                       class="m-0 d-flex align-items-center"><iconify-icon
                                           icon="material-symbols:star" class="star"></iconify-icon>3
                                   </span></p>
                               <div class="d-flex align-items-center gap-4">
                                   <div class="d-flex align-items-center gap-3">

                                       <div class="bar-career">
                                           <div class="bar" style="width: 75%"></div>
                                       </div>
                                       <span>75%</span>
                                   </div>

                                   <p class="m-0 s-top-right"><span class="s-yellow-right"
                                           style="
                                        background: #FFF3E0;
                                        padding: 4px 12px;
                                        font-size: 10px;
                                        font-weight: 600;
                                        width: 100px;
                                        left: 0;
                                        text-align: center;
                                        letter-spacing: normal;
                                        text-transform: capitalize;
                                        left: 0;
                                        display: block;
                                        line-height: 14px;
                                    ">In
                                           Progress</span></p>
                               </div>

                           </div>
                           <div class="line-bottom"></div>
                           <div class="d-flex justify-content-between align-items-center pt-5">
                               <p class="m-0 fw-medium d-flex gap-2"> Organisational Event Management<span class="m-0 d-flex align-items-center"><iconify-icon
                                           icon="material-symbols:star" class="star"></iconify-icon>3
                                   </span></p>

                               <div class="d-flex align-items-center gap-4">
                                   <div class="d-flex align-items-center gap-3">
                                       <div class="bar-career">
                                           <div class="bar" style="width: 0%"></div>
                                       </div><span>0%</span>
                                   </div>
                                   <p class="m-0 s-head-span"><span class="s-career-goal"
                                           style="
                                            left: 0;
                                            background: #E2F6F6;
                                        padding: 4px 12px;
                                        font-size: 10px;
                                        font-weight: 600;
                                        width: 100px;
                                        text-align: center;
                                        color: #0C6464;
                                        text-transform: capitalize;
                                left: 0;
                                display: block;
                                        ">Enrolled</span>
                                   </p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!--end::Panel 5-->
