<div class="page-header mb-15">
                        <div class="d-flex align-items-center gap-3">
                            <h4 class="top-heading m-0">Survey Management Dashboard</h4>
                            <span class="custom-badge purple">Subsidiary 1</span>
                        </div>
                        <p class="custom-text-muted m-0">Monitor survey performance and participation across all
                            departments
                        </p>
                    </div>
                    <div class="row gap-2">
                        <div class="col-md-8">
                            <div class="dashboard-card p-8">
                                <div class="w-100">
                                    <div class="succession-section">
                                        <div class="d-flex justify-content-between align-items-center mb-8">
                                            <h6 class="table-heading mb-0">Response Trend Over Time</h6>
                                            <ul class="custom-btn-group nav nav-tabs nav-pills" id="nav-tab-two"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="all-responses-tab" data-bs-toggle="tab"
                                                        data-bs-target="#all-responses" type="button" role="tab"
                                                        aria-controls="all-responses" aria-selected="true">
                                                        All Responses
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" id="Internal-tab" data-bs-toggle="tab"
                                                        data-bs-target="#Internal" type="button" role="tab"
                                                        aria-controls="Internal" aria-selected="false">
                                                        Internal
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" id="External-tab" data-bs-toggle="tab"
                                                        data-bs-target="#External" type="button" role="tab"
                                                        aria-controls="External" aria-selected="false">
                                                        External
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-content mt-3" id="nav-tabContent">
                                            <div class="table-container tab-pane fade show active" id="all-responses"
                                                role="tabpanel" aria-labelledby="all-responses-tab" tabindex="0">
                                                <div class="d-flex justify-content-between align-items-center mb-8">
                                                    <div class="filter-group">
                                                        <label for="Time Range" class="filter-label">Time Range</label>
                                                        <select id="Time Range" class="form-select">
                                                            <option>7 Days</option>
                                                            <option>2 Week</option>
                                                            <option>Month</option>
                                                        </select>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 fs-4">
                                                        <span
                                                            class="custom-round orange-primary rounded-0"></span>Responses
                                                    </div>
                                                </div>
                                                <div id="AllResponses"></div>
                                            </div>

                                            <div class="tab-pane fade" id="Internal" role="tabpanel"
                                                aria-labelledby="Internal-tab" tabindex="0">
                                                <div class="d-flex justify-content-between align-items-center mb-8">
                                                    <div class="filter-group">
                                                        <label for="Time Range" class="filter-label">Time Range</label>
                                                        <select id="Time Range" class="form-select">
                                                            <option>7 Days</option>
                                                            <option>2 Week</option>
                                                            <option>Month</option>
                                                        </select>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 fs-4">
                                                        <span
                                                            class="custom-round orange-primary rounded-0"></span>Responses
                                                    </div>
                                                </div>
                                                <div id="AllResponses"></div>
                                            </div>
                                            <div class="tab-pane fade" id="External" role="tabpanel"
                                                aria-labelledby="External-tab" tabindex="0">
                                                <div class="d-flex justify-content-between align-items-center mb-8">
                                                    <div class="filter-group">
                                                        <label for="Time Range" class="filter-label">Time Range</label>
                                                        <select id="Time Range" class="form-select">
                                                            <option>7 Days</option>
                                                            <option>2 Week</option>
                                                            <option>Month</option>
                                                        </select>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-3 fs-4">
                                                        <span
                                                            class="custom-round orange-primary rounded-0"></span>Responses
                                                    </div>
                                                </div>
                                                <div id="AllResponses"></div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="dashboard-card h-100 justify-content-start">
                                <h5 class="table-heading mb-12">Response Rate</h5>
                                <div class="center-label response">
                                    <h2>65%</h2>
                                    <p>Response Rate</p>
                                </div>
                                <div class="chart-wrapper mb-12 d-flex align-items-center justify-content-center">
                                    <div id="responseRateChart"></div>
                                    <div class="gap-4">
                                        <div class="d-flex align-items-center gap-5 fs-4"><span
                                                class="custom-round bg-custom-Purple fs-4"></span><span
                                                class="w-50">Internal</span>
                                            <span class="custom-text-muted">40%</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-5 fs-4 mt-4"><span
                                                class="custom-round bg-custom-teal"></span><span
                                                class="w-50">External</span> <span class="custom-text-muted">25%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-wrapper d-flex w-100 align-items-center mb-8">
                                    <div class="w-50">
                                        <p class="text-custom">Internal</p>
                                    </div>
                                    <div class="w-50">
                                        <p class="text-custom">External</p>
                                    </div>
                                </div>
                                <div class="chart-wrapper d-flex w-100 align-items-center justify-content-between">
                                    <div class="w-50">
                                        <div class="center-label response-internal">
                                            <h2>65%</h2>
                                            <p>Response Rate</p>
                                        </div>
                                        <div id="internalResponseRateChart"></div>
                                    </div>
                                    <div class="w-50">
                                        <div class="center-label response-external">
                                            <h2>65%</h2>
                                            <p>Response Rate</p>
                                        </div>
                                        <div id="externalResponseRateChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-5">
                        <div class="dashboard-card p-8">
                            <div class="w-100">
                                <div class="d-flex align-items-center justify-content-between mb-11">
                                    <h5 class="table-heading m-0">Active Surveys
                                    </h5>
                                    <a class="view-all cursor-pointer">View All</a>

                                </div>
                                <table class="vacancies-table table table-bordered align-middle">
                                    <thead>
                                        <tr>
                                            <th>Survey Title</th>
                                            <th>Response Rate</th>
                                            <th>BSC Metric</th>
                                            <th>Expiry Date</th>
                                            <th>Days Left</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Sales</td>
                                            <td>56%</td>
                                            <td><span class="custom-tag tag-green">Customer Satisfaction Score</span></td>
                                            <td>13 Oct, 2025</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-2"><span
                                                        class="sign-warning"><iconify-icon icon="ep:warning"
                                                            width="12" height="12"
                                                            class="red"></iconify-icon></span>3 days left</div>
                                            </td>
                                            <td><span class="assign-btn">Extend Expiry</span></td>
                                        </tr>

                                        <tr>
                                            <td>Customer Service</td>
                                            <td>78%</td>
                                            <td><span class="custom-tag tag-grey">Not Linked</span></td>
                                            <td>20 Oct, 2025</td>
                                            <td><span class="days orange">12 days left</span></td>
                                            <td><span class="assign-btn">Extend Expiry</span></td>
                                        </tr>

                                        <tr>
                                            <td>Marketing</td>
                                            <td>34%</td>
                                            <td><span class="custom-tag tag-green">Revenue Growth Rate</span></td>
                                            <td>30 Oct, 2025</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-2"><span
                                                        class="sign-warning"><iconify-icon icon="ep:warning"
                                                            width="12" height="12"
                                                            class="yellow"></iconify-icon></span>14 days left</div>
                                            </td>
                                            <td><span class="assign-btn">Extend Expiry</span></td>
                                        </tr>

                                        <tr>
                                            <td>Business Development</td>
                                            <td>67%</td>
                                            <td><span class="custom-tag tag-grey">Not Linked</span></td>
                                            <td>15 Nov, 2025</td>
                                            <td><span class="days normal">27 days left</span></td>
                                            <td><span class="assign-btn">View Live Results</span></td>
                                        </tr>

                                        <tr>
                                            <td>Research & Development (R&amp;D)</td>
                                            <td>45%</td>
                                            <td><span class="custom-tag tag-grey">Not Linked</span></td>
                                            <td>25 Nov, 2025</td>
                                            <td><span class="days normal">34 days left</span></td>
                                            <td><span class="assign-btn">View Live Results</span></td>
                                        </tr>

                                        <tr>
                                            <td>Human Resources (HR)</td>
                                            <td>67%</td>
                                            <td><span class="custom-tag tag-green">On-Time Delivery Rate</span></td>
                                            <td>28 Nov, 2025</td>
                                            <td><span class="days normal">67 days left</span></td>
                                            <td><span class="assign-btn">View Live Results</span></td>
                                        </tr>

                                        <tr>
                                            <td>Finance</td>
                                            <td>34%</td>
                                            <td><span class="custom-tag tag-green">Employee Turnover Rate</span></td>
                                            <td>30 Dec, 2025</td>
                                            <td><span class="days normal">89 days left</span></td>
                                            <td><span class="assign-btn">View Live Results</span></td>
                                        </tr>

                                        <tr>
                                            <td>Legal & Compliance</td>
                                            <td>26%</td>
                                            <td><span class="custom-tag tag-grey">Not Linked</span></td>
                                            <td>3 Jan, 2026</td>
                                            <td><span class="days normal">120 days left</span></td>
                                            <td><span class="assign-btn">View Live Results</span></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="row gap-3 justify-content-center">
                        <div class="col">
                            <div class="dashboard-card p-6">
                                <h5 class="table-heading mb-11">Participation Overview by Group
                                </h5>
                                <div class="w-100 custom-border-bottom">
                                    <div class="metric-row mb-3">
                                        <span class="metric-value fs-5">External Testers</span>
                                        <span class="metric-count">Member Count: 567</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                                        <span class="custom-tag tag-grey m-0">Employee Engagement Survey</span>
                                        <span class="custom-tag tag-grey m-0">Onboarding Experience Survey</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-custom-dark-orange" style="width: 83%;"></div>
                                        </div>
                                        <p class="custom-text-muted m-0">83%</p>
                                    </div>
                                </div>
                                <div class="w-100 custom-border-bottom">
                                    <div class="metric-row mb-3">
                                        <span class="metric-value fs-5">New Hires Q3</span>
                                        <span class="metric-count">Member Count: 567</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                                        <span class="custom-tag tag-grey m-0">Employee Engagement Survey</span>
                                        <span class="custom-tag tag-grey m-0">Event Feedback Survey</span>
                                        <span class="custom-tag tag-grey m-0">Leadership Feedback Survey</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-custom-dark-orange" style="width: 75%;"></div>
                                        </div>
                                        <p class="custom-text-muted m-0">75%</p>
                                    </div>
                                </div>
                                <div class="w-100 custom-border-bottom">
                                    <div class="metric-row mb-3">
                                        <span class="metric-value fs-5">Project Phoenix Team</span>
                                        <span class="metric-count">Member Count: 567</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                                        <span class="custom-tag tag-grey m-0">Employee Engagement Survey</span>
                                        <span class="custom-tag tag-grey m-0">Event Feedback Survey</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-custom-dark-orange" style="width: 65%;"></div>
                                        </div>
                                        <p class="custom-text-muted m-0">65%</p>
                                    </div>
                                </div>
                                <div class="w-100 custom-border-bottom">
                                    <div class="metric-row mb-3">
                                        <span class="metric-value fs-5">Group A</span>
                                        <span class="metric-count">Member Count: 567</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                                        <span class="custom-tag tag-grey m-0">Event Feedback Survey</span>
                                        <span class="custom-tag tag-grey m-0">Leadership Feedback Survey</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-custom-dark-orange" style="width: 48%;"></div>
                                        </div>
                                        <p class="custom-text-muted m-0">48%</p>
                                    </div>
                                </div>
                                <div class="w-100 custom-border-bottom mb-0">
                                    <div class="metric-row mb-3">
                                        <span class="metric-value fs-5">Human Resources</span>
                                        <span class="metric-count">Member Count: 567</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                                        <span class="custom-tag tag-grey m-0">Event Feedback Survey</span>
                                        <span class="custom-tag tag-grey m-0">Leadership Feedback Survey</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-custom-dark-orange" style="width: 34%;"></div>
                                        </div>
                                        <p class="custom-text-muted m-0">34%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="dashboard-card p-6">
                                <h5 class="table-heading mb-11">Participation Overview by Department
                                </h5>
                                <div class="w-100 custom-border-bottom">
                                    <div class="metric-row mb-3">
                                        <span class="metric-value fs-5">Human Resources (HR)</span>
                                        <span class="metric-count">Headcount: 567</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                                        <span class="custom-tag tag-grey m-0">Employee Engagement Survey</span>
                                        <span class="custom-tag tag-grey m-0">Onboarding Experience Survey</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-custom-orange" style="width: 83%;"></div>
                                        </div>
                                        <p class="custom-text-muted m-0">83%</p>
                                    </div>
                                </div>
                                <div class="w-100 custom-border-bottom">
                                    <div class="metric-row mb-3">
                                        <span class="metric-value fs-5">Marketing</span>
                                        <span class="metric-count">Headcount: 567</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                                        <span class="custom-tag tag-grey m-0">Employee Engagement Survey</span>
                                        <span class="custom-tag tag-grey m-0">Event Feedback Survey</span>
                                        <span class="custom-tag tag-grey m-0">Leadership Feedback Survey</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-custom-orange" style="width: 75%;"></div>
                                        </div>
                                        <p class="custom-text-muted m-0">75%</p>
                                    </div>
                                </div>
                                <div class="w-100 custom-border-bottom">
                                    <div class="metric-row mb-3">
                                        <span class="metric-value fs-5">Finance</span>
                                        <span class="metric-count">Headcount: 567</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                                        <span class="custom-tag tag-grey m-0">Employee Engagement Survey</span>
                                        <span class="custom-tag tag-grey m-0">Event Feedback Survey</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-custom-orange" style="width: 65%;"></div>
                                        </div>
                                        <p class="custom-text-muted m-0">65%</p>
                                    </div>
                                </div>
                                <div class="w-100 custom-border-bottom">
                                    <div class="metric-row mb-3">
                                        <span class="metric-value fs-5">Information Technology (IT)</span>
                                        <span class="metric-count">Headcount: 567</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                                        <span class="custom-tag tag-grey m-0">Event Feedback Survey</span>
                                        <span class="custom-tag tag-grey m-0">Leadership Feedback Survey</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-custom-orange" style="width: 48%;"></div>
                                        </div>
                                        <p class="custom-text-muted m-0">48%</p>
                                    </div>
                                </div>
                                <div class="w-100 custom-border-bottom mb-0">
                                    <div class="metric-row mb-3">
                                        <span class="metric-value fs-5">Research and Development (R&D)</span>
                                        <span class="metric-count">Headcount: 567</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                                        <span class="custom-tag tag-grey m-0">Event Feedback Survey</span>
                                        <span class="custom-tag tag-grey m-0">Leadership Feedback Survey</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-custom-orange" style="width: 34%;"></div>
                                        </div>
                                        <p class="custom-text-muted m-0">34%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>