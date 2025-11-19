<style>
    .donut-1 .kpi-circular-progress {
            background: conic-gradient(#F7941C 0% 100%,
                    /* 100% progress (2.68/3.00) */
                    #DBDFE9 89% 100%
                    /* Remaining segment */
                );
        }
</style>

<div class="h-full performance" role="tabpanel">
    <!--begin::Col 1 -->
    <div class="card mb-12 psych-inner mt-4" style="color: #5B5B5B; padding: 45px 40px;">
        <div class="kpi-top-head d-flex justify-content-between align-items-center" style="margin-bottom: 45px;">
            <p class="top-heading">Historical Data</p>
            <div class="kpi-side-dropdown-btn gap-2">
                <iconify-icon icon="uil:calender" class="kpi-calender"></iconify-icon>
                <select class="form-select kp-select" id="yearSelect" data-placeholder="All Years">
                    <option value="">
                        All Years
                    </option>
                    <option value="2024">Year 2024</option>
                    <option value="2023">Year 2023</option>
                    <option value="2022">Year 2022</option>
                    {{-- <option value="2021">Year 2021</option> --}}
                </select>
            </div>
        </div>
        <div id="chart"></div>
    </div>
    <div class="mb-9">
        <div class="kpi-top-head d-flex justify-content-between align-items-center mb-4" style="color: #5B5B5B;">
            <p class="m-0"></p>
            
        </div>
        {{-- <div class="card psych-inner">
            <div class="kpi-first">
                <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">KPI Ratings (70% Weightage)
                </p>
                <div class="kpi-inner d-grid gap-14 align-items-start">
                    <div class="donut-1">
                        <div class="kpi-circular-progress">
                            <div class="kpi-circle-content">
                                <h3 class="m-0">2.66/3.00</h3>
                                <p class="m-0">Total Weighted</br>Ratings</p>
                            </div>
                        </div>
                    </div>
                    <div class="table-first">
                        <p class="kpi-table-head">Objectives: Increase Training Effectiveness
                            (Weightage: 20%)</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>KPI</th>
                                    <th>Rating</th>
                                    <th>Manager Evaluation</th>
                                    <th>Base Target</th>
                                    <th>Stretch Target</th>
                                    <th>Result</th>
                                    <th>Employee Comments</th>
                                    <th>Objective Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Increase Training Effectiveness</td>
                                    <td>2</td>
                                    <td>Demonstrated improvement in trainee performance post-training. Better alignment with organizational goals could enhance outcomes.</td>
                                    <td>75% post-training assessment score</td>
                                    <td>85% post-training assessment score</td>
                                    <td>80% stretch target achieved</td>
                                    <td>I aim to to introduce more practical assessments and collaborate with managers to ensure training directly impacts job performance.</td>
                                    <td><b>18.6%</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="kpi-table-head mt-8">Objectives: Improve Training Program Delivery
                             (Weightage: 30%)</p>
                            <table>
                                <thead>
                                    <tr>
                                        <th>KPI</th>
                                        <th>Rating</th>
                                        <th>Manager Evaluation</th>
                                        <th>Base Target</th>
                                        <th>Stretch Target</th>
                                        <th>Result</th>
                                        <th>Employee Comments</th>
                                        <th>Objective Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Improve Training Program Delivery</td>
                                        <td>3</td>
                                        <td>Demonstrated significant improvements in training delivery, achieving high trainee satisfaction. However, additional customization could enhance impact.</td>
                                        <td>90% training attendance rate</td>
                                        <td>95% training attendance rate</td>
                                        <td>90% stretch target achieved</td>
                                        <td>Plan to incorporate feedback from participants to fine-tune content and align with their professional growth objectives.</td>
                                        <td><b>27.4%</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        <p class="kpi-table-head mt-8">Objectives: Enhance Training Module Design
                            (Weightage: 30%)</p>
                            <table>
                                <thead>
                                    <tr>
                                        <th>KPI</th>
                                        <th>Rating</th>
                                        <th>Manager Evaluation</th>
                                        <th>Base Target</th>
                                        <th>Stretch Target</th>
                                        <th>Result</th>
                                        <th>Employee Comments</th>
                                        <th>Objective Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Enhance Training Module Design</td>
                                        <td>3</td>
                                        <td>Created innovative and engaging training modules, receiving positive feedback. Further optimization for diverse audiences is recommended.</td>
                                        <td>3 new modules designed annually</td>
                                        <td>5 new modules designed</td>
                                        <td>100% stretch target achieved</td>
                                        <td>Focus will be on creating bilingual modules to cater to multilingual teams and expanding training materials for practical application.</td>
                                        <td><b>28%</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        <p class="kpi-table-head mt-8">Objectives: Promote Training Adoption Across Departments
                            (Weightage: 20%)</p>
                            <table>
                                <thead>
                                    <tr>
                                        <th>KPI</th>
                                        <th>Rating</th>
                                        <th>Manager Evaluation</th>
                                        <th>Base Target</th>
                                        <th>Stretch Target</th>
                                        <th>Result</th>
                                        <th>Employee Comments</th>
                                        <th>Objective Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Promote Training Adoption Across Departments</td>
                                        <td>2</td>
                                        <td>Successfully promoted training participation across departments, achieving a notable increase in cross-department engagement.</td>
                                        <td>10% increase in participation rate</td>
                                        <td>15% increase in participation rate</td>
                                        <td>85% stretch target achieved</td>
                                        <td>I plan to engage department heads more effectively and showcase training benefits through case studies and testimonials.</td>
                                        <td><b>14.7%</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        <p class="sd-table-bot-total mb-0">Total Stretch Target Achieved:
                            <span>88.7%</span>
                        </p> 
                    </div>
                </div>
            </div>
            <div class="line-bottom mb-14 mt-14"></div>
            <div class="kpi-second">
                <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">Skill Development Ratings
                    (30% Weightage)</p>
                <div class="kpi-inner d-grid gap-14 align-items-start">
                    <div class="donut-2">
                        <div class="kpi-circular-progress">
                            <div class="kpi-circle-content">
                                <h3 class="m-0">2.93/3.00</h3>
                                <p class="m-0">Total Points</p>
                            </div>
                        </div>
                    </div>
                    <div class="table-first">
                        <table>
                            <thead>
                                <tr>
                                    <th style="
                                    width: 33%;
                                ">Technical Skill (15%)</th>
                                    <th style="
                                    width: 6%;
                                ">Rating</th>
                                    <th style="
                                    width: 8%;
                                ">Minimal Level</th>
                                    <th style="
                                    width: 6%;
                                ">Gap</th>
                                    <th style="
                                    width: 14%;
                                ">Employee Planning</th>
                                    <th>Manager Evaluation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Conduct and Behaviour Management</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Data Collection and Preparation</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Data Management</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Employee Communication Management</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Employee Relationship Management</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Health and Wellness Prograamme Management</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Human Resource Analytics and Insights</td>
                                    <td>0</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Human Resource Policies and Legislation Framework Management</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Human Resource Practices Implementation</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Human Resource Systems Management</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                
                                <tr>
                                    <td>Job Analysis and Evaluation</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Operational Excellence</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Organisational Event Management </td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="sd-table-bot mb-0">Total Technical Skills Rating: <span>96.97%</span>
                        </p>
                        <table class="mt-14">
                            <thead>
                                <tr>
                                    <th style="
                                    width: 33%;
                                ">Soft Skill (15%)</th>
                                    <th style="
                                    width: 6%;
                                ">Rating</th>
                                    <th style="
                                    width: 8%;
                                ">Minimal Level</th>
                                    <th style="
                                    width: 6%;
                                ">Gap</th>
                                    <th style="
                                    width: 14%;
                                ">Employee Planning</th>
                                    <th>Manager Evaluation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Communication</td>
                                    <td>3</td>
                                    <td>3</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Digital Fluency</td>
                                    <td>0</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Problem Solving</td>
                                    <td>3</td>
                                    <td>3</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Collaboration</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>Creative Thinking</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="sd-table-bot mb-0">Total Soft Skills Rating: <span>97.6%</span>
                        </p>
                        <p class="sd-table-bot-total mb-0">Total Skills Rating: <span>98.49%</span></p>
                    </div>
                </div>
            </div>
            <div class="line-bottom mb-14 mt-14"></div>
            <div class="kpi-third">
                <p class="fw-medium fs-3 m-0 mb-14" style="color: #5B5B5B">Performance Ratings</p>
                <div class="kpi-inner d-grid gap-14 align-items-start">
                    <div class="donut-1">
                        <div class="semi-circle-progress">
                            <div class="kpi-circle-content"
                                style="
                            top: 24%;
                        ">
                                <h3 class="m-0">Level 3</h3>
                                <p class="m-0">Performance Rating</p>
                            </div>
                        </div>
                    </div>
                    <div class="kp-table-third">
                        <table>
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th
                                        style="
                                text-align: right;
                            ">
                                        Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>KPI Rating</td>
                                    <td
                                        style="
                                text-align: right;
                            ">
                                        <p class="m-0">(KPI Rating raw score) <span>88.7%</span>
                                        </p>
                                        <p class="m-0 mt-1"><b>(70% Weightage) <span>62.09%</span></b>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Skills Development Rating</td>
                                    <td
                                        style="
                                text-align: right;
                            ">
                                        <p class="m-0">(Technical Skills raw score)
                                            <span>96.97%</span>
                                        </p>
                                        <p class="m-0 mt-1">(Soft Skills raw score) <span>97.6%</span>
                                        </p>
                                        <p class="m-0 mt-1"><b>(30% Weightage) <span>29.55%</p>
                                        </b></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="sd-table-bot mb-0">Total Performance Points: <span>2.76/3.00</span>
                        <p class="sd-table-bot-total mb-0">
                            Total Performance Score: <span>92.1%</span></p> 
                    </div>
                </div>
            </div>

        </div> --}}
    </div>
</div>
