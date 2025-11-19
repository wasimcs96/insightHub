<section class="report-tab">
    <p class="text-first-head">Overview</p>
    <div class="d-flex align-items-center justify-content-between gap-5 mt-8">
        <div class="p-6 box">
            <p>Total Hires</p>
            <span>{{ $totalHires ?? 0 }}</span>
        </div>
        <div class="p-6 box">
            <p>Time To Fill</p>
            <div class="d-flex justify-content-between align-items-center"><span>{{ $timeToFill ?? 0 }} <span
                        style="
                color: #78829D;
                font-size: 12px;
                font-weight: 500;
                line-height: 16px;
            ">days</span></span>

                <!-- <div class="green-info d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-html="true" data-bs-title="<span class='text-muted'>Vs</span> 1 Oct 2024-31 Oct 2024">
                    <iconify-icon icon="stash:chart-trend-up" width="22" height="22"></iconify-icon> 2%
                </div> -->
            </div>
        </div>
        <div class="p-6 box">
            <p>Total Applications Received</p>
            <div class="d-flex justify-content-between align-items-center"><span>{{ $totalApplications ?? 0 }}</span>

                <!-- <div class="green-info d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-html="true" data-bs-title="<span class='text-muted'>Vs</span> 1 Oct 2024-31 Oct 2024">
                    <iconify-icon icon="stash:chart-trend-up" width="22" height="22"></iconify-icon> 2%
                </div> -->
            </div>
        </div>
        <div class="p-6 box">
            <p>Total Rejected Applicants</p>
            <div class="d-flex justify-content-between align-items-center">
                <span>{{ $totalRejectedApplicants ?? 0 }}</span>
                <!-- <div class="green-info d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-html="true" data-bs-title="<span class='text-muted'>Vs</span> 1 Oct 2024-31 Oct 2024">
                    <iconify-icon icon="stash:chart-trend-up" width="22" height="22"></iconify-icon> 2%
                </div> -->
            </div>
        </div>
        <div class="p-6 box">
            <p>Average Time to Fill</p>
            <div class="d-flex justify-content-between align-items-center"><span>{{ $averageTimeToFill ?? 0 }}<span
                        style="
                color: #78829D;
                font-size: 12px;
                font-weight: 500;
                line-height: 16px;
            ">days</span></span>
                <!-- <div class="green-info d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-html="true" data-bs-title="<span class='text-muted'>Vs</span> 1 Oct 2024-31 Oct 2024">
                    <iconify-icon icon="stash:chart-trend-up" width="22" height="22"></iconify-icon> 2%
                </div> -->
            </div>
        </div>

    </div>

    <div class="d-flex align-items-center justify-content-between gap-5 mt-8 mb-10">
        <div class="p-6 box">
            <p>Offer Acceptance Rate</p>
            <div class="d-flex justify-content-between align-items-center"><span>{{ $offerAcceptanceRate ?? 0 }}<span
                        style="
                color: #78829D;
                font-size: 12px;
                font-weight: 500;
                line-height: 16px;
            ">%</span></span>
                <!-- <div class="green-info d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-html="true" data-bs-title="<span class='text-muted'>Vs</span> 1 Oct 2024-31 Oct 2024">
                    <iconify-icon icon="stash:chart-trend-up" width="22" height="22"></iconify-icon> 2%
                </div> -->
            </div>
        </div>
        <div class="p-6 box">
            <p>Average Salary Offered</p>
            <div class="d-flex justify-content-between align-items-center"><span>{{ $averageSalaryOffered ?? 0 }} <span
                        style="
                color: #78829D;
                font-size: 12px;
                font-weight: 500;
                line-height: 16px;
            ">{{ $currencyShortName }}</span></span>
                <!-- <div class="green-info d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-html="true" data-bs-title="<span class='text-muted'>Vs</span> 1 Oct 2024-31 Oct 2024">
                    <iconify-icon icon="stash:chart-trend-up" width="22" height="22"></iconify-icon> 2%
                </div> -->
            </div>
        </div>
        <div class="p-6 box">
            <p>Average Expected Salary</p>
            <div class="d-flex justify-content-between align-items-center"><span>{{ $averageExpectedSalary ?? 0 }}<span
                        style="
                color: #78829D;
                font-size: 12px;
                font-weight: 500;
                line-height: 16px;
            ">{{ $currencyShortName }}</span></span>
                <!-- <div class="green-info d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-html="true" data-bs-title="<span class='text-muted'>Vs</span> 1 Oct 2024-31 Oct 2024">
                    <iconify-icon icon="stash:chart-trend-up" width="22" height="22"></iconify-icon> 2%
                </div> -->
            </div>
        </div>
    </div>

    <div class="box px-8 pt-6 pb-16 mb-10">
        <h4 class="text-first-head mb-19">Applicant Insight</h4>
        <div class="d-flex gap-7">
            <div class="d-flex flex-column gap-11 w-50">
                <div class="top-content">
                    <p class="mb-13">Country</p>
                    <div class="location-div">
                        @foreach ($countryApplications as $countryApplication)
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="m-0 name">{{ $countryApplication->name ?? '' }}</p>
                                <p class="m-0 number d-flex gap-3 align-items-center">
                                    {{ $countryApplication->total_applications ?? ' ' }} <span><iconify-icon
                                            icon="mdi:user-outline" width="18"
                                            height="18"></iconify-icon></span></p>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-11 w-50">
                <div class="top-content">
                    <p class="mb-13">Current Location</p>
                    <div class="location-div">
                        @foreach ($cityApplications as $cityApplication)
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="m-0 name">
                                    @if(!empty($cityApplication->country_name))
                                        {{ $cityApplication->country_name }},
                                    @endif
                                    {{ $cityApplication->city_name ?? '' }}
                                    
                                </p>
                                <p class="m-0 number d-flex gap-3 align-items-center">
                                    {{ $cityApplication->total_applications ?? ' ' }} <span><iconify-icon
                                            icon="mdi:user-outline" width="18" height="18"></iconify-icon></span>
                                </p>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            
        </div>
        <div class="line-bottom"></div>
        <div class="d-flex gap-7">
            <div class="d-flex flex-column gap-11 w-50">
                <div class="top-content">
                    <p class="mb-13">Work Authorisation</p>
                    <div class="d-flex gap-10 align-items-center">
                        <div id="chartWorkAuthorisation" style="height: 410px; width: 90%; margin-left: auto; margin-right: auto;"></div>
                        {{-- <div class="chart-levels chart-levels-position">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="teal"></span> Yes</p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">78%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="yellow"></span> No</p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">12%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-11 w-50">
                <div class="top-content">
                    <p class="mb-13">Work Experience</p>
                    <div class="location-div">
                        <div id="positionChart" style="position: relative; top: -20px; left: -10px; border: 0;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="line-bottom"></div>
        <div class="d-flex gap-7">
            <!-- <div class="d-flex flex-column gap-11 w-50">
                <div class="top-content">
                    <p class="mb-13">Education Level</p>
                    <div class="d-flex gap-10 align-items-center">
                        <div id="chartEducationLevel" style="position: relative; left: -20px;"></div>
                        <div class="chart-levels chart-levels-position">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="purple"></span> Bachelor’s
                                    Degree</p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">62%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="light-blue"></span> Associate
                                    Degree</p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">22%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="blue"></span> Master’s Degree
                                </p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">16%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="dark-purple"></span> Doctorate
                                    (Ph.D.)
                                </p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">10%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="d-flex flex-column gap-11 w-50">
                <div class="top-content">
                    <p class="mb-13">Education Level</p>
                    <div class="d-flex gap-10 align-items-center">
                        <!-- <div id="chartEducationLevel" style="position: relative; top: -20px; left: -29px; border: 0;"> -->
                        <div id="chartEducationLevel" style="height: 410px; width: 90%; margin-left: auto; margin-right: auto;"> <!-- Ensure the container has a defined height -->
                        </div>
                        {{-- <div class="chart-levels chart-levels-position" style="width: 260px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="dark-purple"></span> Ph.D.</p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">62%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="blue"></span> Master</p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">22%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="purple"></span> Bachelor</p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">16%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="diploma"></span> Diploma</p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">10%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="d-flex align-items-center mb-3"><span class="light-blue"></span> High School</p>
                                <p class="d-flex align-items-center mb-3 gap-1" style="color: #78829D;">10%
                                    <iconify-icon icon="mdi:user-outline" width="20"
                                        height="20"></iconify-icon>
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-11 w-50">
                <div class="top-content">
                    <p class="mb-13">Education Program</p>
                    <div class="location-div">
                        @foreach ($educationProgramCounts as $educationProgramCount)
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="m-0 name">{{ $educationProgramCount->education_program ?? '' }}</p>
                                <p class="m-0 number d-flex gap-3 align-items-center">
                                    {{ $educationProgramCount->total_applications ?? '' }} <span><iconify-icon
                                            icon="mdi:user-outline" width="18"
                                            height="18"></iconify-icon></span>
                                </p>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box px-8 pt-6 pb-16 mb-10">
        <h4 class="text-first-head mb-19">Recruitment Stages Funnel</h4>
        <div id="chart"></div>
    </div>
</section>
