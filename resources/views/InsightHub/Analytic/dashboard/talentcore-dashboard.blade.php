    <div class="page-header mb-15">
        <div class="d-flex align-items-center gap-3">
            <h4 class="top-heading m-0">TalentCore Dashboard</h4>
            <span class="custom-badge purple">Subsidiary 1</span>
        </div>
        <p class="custom-text-muted m-0">Track employee assessment completion, monitor job ad activity, and
            review total job positions.</p>
    </div>
    <div class="d-grid gap-8" style="grid-template-columns: repeat(4, 23.4%);">
        <div class="d-flex flex-column gap-8">
            <div class="dashboard-card">
                <h2>2063</h2>
                <p class="d-flex align-items-center gap-3"><iconify-icon icon="lucide:user" width="16" height="16"
                        class="icon-color"></iconify-icon> Total Headcount</p>
            </div>
            <div class="dashboard-card">
                <h2>16</h2>
                <p class="d-flex align-items-center gap-3"><iconify-icon icon="quill:warning" width="16"
                        height="16" class="icon-color"></iconify-icon> Critical Job Positions</p>
            </div>
        </div>

        <div class="d-flex flex-column gap-8">
            <div class="dashboard-card" style="height: 107px;">
                <h2>120</h2>
                <p class="d-flex align-items-center gap-3"><iconify-icon icon="mdi:building" width="16"
                        height="16" class="icon-color"></iconify-icon> Total Business Units</p>
            </div>
            <div class="dashboard-card" style="height: 107px;">
                <h2>12</h2>
                <p class="d-flex align-items-center gap-3"><iconify-icon icon="mdi:building" width="16"
                        height="16" class="icon-color"></iconify-icon> Total Companies/Divisions</p>
            </div>
            <div class="dashboard-card" style="height: 107px;">
                <h2>12</h2>
                <p class="d-flex align-items-center gap-3"><iconify-icon icon="mdi:building" width="16"
                        height="16" class="icon-color"></iconify-icon> Total Departments</p>
            </div>
        </div>
        <div class="dashboard-card">
            <div id="genderChart"></div>
            <div class="chart-title extra-margin">Gender</div>
            <div class="d-flex justify-content-between mt-7 w-75 mx-auto">
                <div class="d-flex align-items-center gap-3"><span class="custom-round red"></span>Male
                </div>
                <div class="d-flex align-items-center gap-3"><span class="custom-round yellow"></span>Female
                </div>
            </div>
        </div>
        <div class="dashboard-card">
            <div id="ageChart"></div>
            <div class="chart-title extra-margin">Age</div>
            <div class="d-flex justify-content-between w-75 mx-auto">
                <div>
                    <div class="d-flex align-items-center gap-3"><span class="custom-round cyan"></span>21 -
                        24
                    </div>
                    <div class="d-flex align-items-center gap-3"><span class="custom-round purple"></span>30
                        -
                        34</div>
                    <div class="d-flex align-items-center gap-3"><span class="custom-round yellow"></span>40+
                    </div>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-3"><span class="custom-round green"></span>25 -
                        29</div>
                    <div class="d-flex align-items-center gap-3"><span class="custom-round red"></span>35
                        - 39
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row gap-8 justify-content-center">
            <div class="col p-0">
                <div class="dashboard-card">
                    <h6 class="chart-title mb-8">JD Approval Status</h6>
                    <div class="progress-container">
                        <div class="progress-segment" style="width: 75%; background-color: #54CF6E;">
                        </div>
                        <div class="progress-segment" style="width: 25%; background-color: #FF6355;">
                        </div>
                    </div>
                    <div class="d-flex mt-3 gap-3">
                        <div class="d-flex align-items-center gap-3"><span
                                class="custom-round green-approved"></span>75% Approved</div>
                        <div class="d-flex align-items-center gap-3"><span class="custom-round red"></span>25%
                            Pending</div>
                    </div>
                </div>
            </div>
            <div class="col p-0">
                <div class="dashboard-card">
                    <h6 class="chart-title mb-8">Assessment Completion Status</h6>
                    <div class="progress-container">
                        <div class="progress-segment" style="width: 75%; background-color: #54CF6E;">
                        </div>
                        <div class="progress-segment" style="width: 25%; background-color: #FF6355;">
                        </div>
                    </div>
                    <div class="d-flex mt-3 gap-3">
                        <div class="d-flex align-items-center gap-3"><span
                                class="custom-round green-approved"></span>75% Approved</div>
                        <div class="d-flex align-items-center gap-3"><span class="custom-round red"></span>25%
                            Pending</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-card">
        <div class="d-flex align-items-center justify-content-between mb-8 w-100">
            <h6 class="chart-title m-0">JD Approval Status</h6>
            <div class="d-flex gap-3">
                <div class="d-flex align-items-center gap-3"><span class="custom-round yellow"></span>Total
                    Job Vacancies</div>
                <div class="d-flex align-items-center gap-3"><span class="custom-round blue"></span>Total
                    Jod
                    Ads Created</div>
            </div>
        </div>
        <div id="JobVacanciesvsJobAdsCreatedChart"></div>
    </div>
    <div class="dashboard-card my-5">
        <div class="mb-8">
            <h6 class="chart-title m-0">Total Job Positions</h6>
        </div>
        <div id="TotalJobPositionsChart"></div>
    </div>
