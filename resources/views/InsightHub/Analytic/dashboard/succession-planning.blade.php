<div class="page-header mb-15">
    <div class="d-flex align-items-center gap-3">
        <h4 class="top-heading m-0">Succession Planning Dashboard</h4>
        <span class="custom-badge purple">Subsidiary 1</span>
    </div>
    <p class="custom-text-muted m-0">Comprehensive insights into future leadership readiness and role
        coverage</p>
</div>
<div class="page-header mb-5 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
        <h4 class="top-sub-heading m-0">Division-Based Succession Overview</h4>
    </div>
    <div class="filter-group">
        <label for="Division/Subsidiary" class="filter-label">Division/Subsidiary</label>
        <select id="Division/Subsidiary" class="form-select">
            <option>Company-wide</option>
            <option>Company-wide 2</option>
            <option>Company-wide 3</option>
            <option>Company-wide 4</option>
            <option>Company-wide 4</option>
        </select>
    </div>
</div>
<div class="row gap-2">
    <div class="col-md-8">
        <div class="dashboard-card p-8">
            <div class="w-100">
                <div class="succession-section">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="table-heading mb-0">Succession Coverage by Division</h6>
                        <div class="custom-btn-group" id="customTabs" role="tablist">
                            <button class="active border-0" data-target="#tab-all" role="tab">All
                                Job Positions</button>
                            <button class="border-0" data-target="#tab-critical" role="tab">Critical
                                Roles</button>
                        </div>
                    </div>

                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="tab-all" role="tabpanel">
                            <div class="d-flex mt-3 gap-4">
                                <div class="d-flex align-items-center gap-3 fs-4">
                                    <span class="custom-round orange rounded-0"></span>Total Job
                                    Positions
                                </div>
                                <div class="d-flex align-items-center gap-3 fs-4">
                                    <span class="custom-round orange-primary rounded-0"></span>Positions
                                    With Succession
                                </div>
                            </div>
                            <div id="successionBarChart"></div>
                        </div>

                        <div class="tab-pane" id="tab-critical" role="tabpanel">
                            <div class="d-flex mt-3 gap-4">
                                <div class="d-flex align-items-center gap-3 fs-4">
                                    <span class="custom-round orange rounded-0"></span>Critical Role
                                    Positions
                                </div>
                                <div class="d-flex align-items-center gap-3 fs-4">
                                    <span class="custom-round orange-primary rounded-0"></span>Critical
                                    Roles With Succession
                                </div>
                            </div>
                            <div id="criticalBarChart">[Critical Roles Chart Here]</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col">
        <div class="dashboard-card h-100 justify-content-start">
            <h5 class="table-heading mb-12">Succession Setup</h5>
            <div class="center-label">
                <h2>78%</h2>
                <p>Successor Set</p>
            </div>
            <div class="chart-wrapper mb-3 mx-auto">
                <div id="successionChart"></div>
            </div>
            <div class="mt-6 gap-4">
                <div class="d-flex align-items-center gap-5 fs-4"><span class="custom-round teal fs-4"></span><span
                        class="w-50">Critical Job
                        Position</span> <span class="custom-text-muted">43%</span>
                </div>
                <div class="d-flex align-items-center gap-5 fs-4 mt-4"><span
                        class="custom-round teal-light"></span><span class="w-50">Non-Critical Job
                        Position</span> <span class="custom-text-muted">35%</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="my-5">
    <div class="dashboard-card p-8">
        <div class="w-100">
            <div class="d-flex align-items-center justify-content-between mb-11">
                <div class="d-flex gap-5 align-items-center">
                    <h5 class="table-heading m-0">Pending Assignment of Successors to Vacancies</h5>
                    <a class="view-all cursor-pointer">View All</a>
                </div>
                <ul class="custom-btn-group nav nav-tabs nav-pills" id="nav-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">All
                            Vacancies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Critical
                            Vacancies</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="table-container tab-pane fade show active" id="nav-home" role="tabpanel"
                    aria-labelledby="nav-home-tab" tabindex="0">
                    <table class="vacancies-table table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Divisions</th>
                                <th>Total Vacancies</th>
                                <th>Ready Successors</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sales</td>
                                <td>32</td>
                                <td>18</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Customer Service</td>
                                <td>28</td>
                                <td>12</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Marketing</td>
                                <td>25</td>
                                <td>16</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Business Development</td>
                                <td>18</td>
                                <td>13</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Research & Development (R&amp;D)</td>
                                <td>17</td>
                                <td>9</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Human Resources (HR)</td>
                                <td>13</td>
                                <td>6</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Finance</td>
                                <td>9</td>
                                <td>4</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Legal & Compliance</td>
                                <td>6</td>
                                <td>4</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Procurement & Supply Chain</td>
                                <td>5</td>
                                <td>2</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Information Technology (IT)</td>
                                <td>4</td>
                                <td>1</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                    tabindex="0">
                    <table class="vacancies-table table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Divisions</th>
                                <th>Total Vacancies</th>
                                <th>Ready Successors</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sales</td>
                                <td>32</td>
                                <td>18</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Customer Service</td>
                                <td>28</td>
                                <td>12</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Marketing</td>
                                <td>25</td>
                                <td>16</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Business Development</td>
                                <td>18</td>
                                <td>13</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Research & Development (R&amp;D)</td>
                                <td>17</td>
                                <td>9</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Human Resources (HR)</td>
                                <td>13</td>
                                <td>6</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Finance</td>
                                <td>9</td>
                                <td>4</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Legal & Compliance</td>
                                <td>6</td>
                                <td>4</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Procurement & Supply Chain</td>
                                <td>5</td>
                                <td>2</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                            <tr>
                                <td>Information Technology (IT)</td>
                                <td>4</td>
                                <td>1</td>
                                <td><span class="assign-btn">Assign Successor</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-15">
    <h4 class="top-sub-heading mb-5">Division-Based Succession Overview</h4>

    <div class="table-responsive">
        <table class="table succession-table table-bordered align-middle">
            <thead>
                <tr>
                    <th class="col-division">Divisions</th>
                    <th class="col-readiness">Readiness<br>(Average)</th>
                    <th class="col-performance">Performance<br>(Average)</th>
                    <th class="bg-custom-red">
                        <div class="d-flex align-items-center gap-1 justify-content-center">
                            <iconify-icon icon="mingcute:warning-line" width="14"
                                height="14"></iconify-icon>Q1
                        </div>
                    </th>
                    <th class="bg-custom-dark-orange">
                        <div class="d-flex align-items-center gap-1 justify-content-center">
                            <iconify-icon icon="mingcute:warning-line" width="14"
                                height="14"></iconify-icon>Q2
                        </div>
                    </th>
                    <th class="bg-warning">
                        <div class="d-flex align-items-center gap-1 justify-content-center">
                            <iconify-icon icon="mingcute:warning-line" width="14"
                                height="14"></iconify-icon>Q3
                        </div>
                    </th>
                    <th class="bg-custom-dark-orange">
                        <div class="d-flex align-items-center gap-1 justify-content-center">
                            <iconify-icon icon="mingcute:warning-line" width="14"
                                height="14"></iconify-icon>Q4
                        </div>
                    </th>
                    <th class="bg-warning">
                        <div class="d-flex align-items-center gap-1 justify-content-center">
                            <iconify-icon icon="mingcute:warning-line" width="14"
                                height="14"></iconify-icon>Q5
                        </div>
                    </th>
                    <th class="bg-custom-green">
                        <div class="d-flex align-items-center gap-1 justify-content-center">
                            <iconify-icon icon="mingcute:warning-line" width="14"
                                height="14"></iconify-icon>Q6
                        </div>
                    </th>
                    <th class="bg-warning">
                        <div class="d-flex align-items-center gap-1 justify-content-center">
                            <iconify-icon icon="mingcute:warning-line" width="14"
                                height="14"></iconify-icon>Q7
                        </div>
                    </th>
                    <th class="bg-custom-green">
                        <div class="d-flex align-items-center gap-1 justify-content-center">
                            <iconify-icon icon="mingcute:warning-line" width="14"
                                height="14"></iconify-icon>Q8
                        </div>
                    </th>
                    <th class="bg-custom-teal">
                        <div class="d-flex align-items-center gap-1 justify-content-center">
                            <iconify-icon icon="mingcute:warning-line" width="14"
                                height="14"></iconify-icon>Q9
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Finance</td>
                    <td class="bg-custom-green">85.7%</td>
                    <td class="bg-custom-green">78.3%</td>
                    <td>3.5%</td>
                    <td>7.2%</td>
                    <td>8.8%</td>
                    <td>9.1%</td>
                    <td>14.3%</td>
                    <td>22.4%</td>
                    <td>12.6%</td>
                    <td>11.7%</td>
                    <td>10.4%</td>
                </tr>

                <tr>
                    <td>Operations</td>
                    <td class="bg-custom-green">76.2%</td>
                    <td class="bg-custom-teal">94.7%</td>
                    <td>6.4%</td>
                    <td>2.9%</td>
                    <td>8.5%</td>
                    <td>25.6%</td>
                    <td>18.9%</td>
                    <td>13.3%</td>
                    <td>7.7%</td>
                    <td>1.1%</td>
                    <td>15.6%</td>
                </tr>

                <tr>
                    <td>Human Resources</td>
                    <td class="bg-custom-teal">92%</td>
                    <td class="bg-custom-teal">92.5%</td>
                    <td>4.6%</td>
                    <td>5.7%</td>
                    <td>9.9%</td>
                    <td>16.7%</td>
                    <td>26.0%</td>
                    <td>14.1%</td>
                    <td>12.3%</td>
                    <td>8.2%</td>
                    <td>2.5%</td>
                </tr>

                <tr>
                    <td>Technology & Innovation</td>
                    <td class="bg-custom-green">77.6%</td>
                    <td class="bg-custom-green">86.3%</td>
                    <td>3.8%</td>
                    <td>7.1%</td>
                    <td>11.9%</td>
                    <td>17.3%</td>
                    <td>23.5%</td>
                    <td>15.2%</td>
                    <td>13.6%</td>
                    <td>6.2%</td>
                    <td>1.4%</td>
                </tr>

                <tr>
                    <td>Sales & Marketing</td>
                    <td class="bg-warning">62.4%</td>
                    <td class="bg-warning">64.8%</td>
                    <td>2.2%</td>
                    <td>6.9%</td>
                    <td>9.6%</td>
                    <td>12.1%</td>
                    <td>26.0%</td>
                    <td>18.2%</td>
                    <td>10.7%</td>
                    <td>8.8%</td>
                    <td>5.5%</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
