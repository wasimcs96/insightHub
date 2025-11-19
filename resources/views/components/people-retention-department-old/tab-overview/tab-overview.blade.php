<style>
    .positive {
    background: #E6F7E6;  /* Light green background */
    color: green;         /* Green text */
}

.negative {
    background: #FFC1BB;  /* Light red background */
    color: red;           /* Red text */
}
</style>

<div class="tab-content over-view-content active">
    <div class="top-overview">
        <div class="overview-title">
            <h2>Overview</h2>
            {{-- <div class="calendar-filter" id="reportrange">
                <i class="fa fa-calendar"></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i>
            </div> --}}
        </div>
        <div class="overview-data">
            <div class="total-employee-data">
                <p>Total Employee</p>
                <div class="total-employee-value">
                    <div class="value">
                        <h1>{{ $totalEmployee }}</h1>
                    </div>
                </div>
            </div>
            <div class="total-employee-data">
                <p>Active Job Ads</p>
                <div class="total-employee-value">
                    <div class="value">
                        <h1>{{ $activeJobAds }}</h1>
                    </div>
                </div>
            </div>
            <div class="total-employee-data">
                <p>Recent Hired</p>
                <div class="total-employee-value">
                    <div class="value">
                        <h1>{{$newHiresCount}}</h1>
                    </div>
                    <div class="percentage-value {{ $percentageChange >= 0 ? 'positive' : 'negative' }}">
                        <i class="fa-solid fa-arrow-trend-{{ $percentageChange >= 0 ? 'up' : 'down' }}"></i>
                        <p>{{ abs($formattedPercentage) }}%</p> <!-- `abs()` removes negative sign -->
                    </div>
                </div>
            </div>
            <div class="total-employee-data">
                <p>Flight Risk</p>
                <div class="total-employee-value">
                    @php
                        $bfrLevel = 'unknown';
                        if ($averagePercentage >= 98) {
                            $bfrLevel = 'very_high';
                        } elseif ($averagePercentage >= 84) {
                            $bfrLevel = 'high';
                        } elseif ($averagePercentage >= 16) {
                            $bfrLevel = 'moderate';
                        } elseif ($averagePercentage >= 2) {
                            $bfrLevel = 'low';
                        } else {
                            $bfrLevel = 'very_low';
                        }
                        
                        $bfrLabels = [
                            'very_high' => 'Very High',
                            'high' => 'High',
                            'moderate' => 'Moderate',
                            'low' => 'Low',
                            'very_low' => 'Very Low',
                        ];

                        $bfrLabel = $bfrLabels[$bfrLevel] ?? 'Unknown';
                    @endphp
                    <div class="value">
                        <h2>{{ $bfrLabel }}</h2>
                    </div>
                    {{-- <div class="percentage-value">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        <p>2%</p>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="overview-chart">
            <div class="bar-gender">
                <h1>Age And Gender</h1>
                <div id="age-chart"></div>
            </div>
            <div class="location-data">
                <h1>Location</h1>
                <div class="city-list" style="overflow-y: scroll; height:255px;">
                    @foreach ($cityCounts as $city)
                        <div class="city-item">
                            <span class="location">{{ empty(trim($city->city)) ? 'Other' : $city->city }}</span>                            
                            <div class="city-info">
                                <span class="total-user-location-value">{{ $city->count }}</span>
                                <i class="bi bi-person fs-2"></i>
                            </div>
                        </div>
                    @endforeach    
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-overview">
        <div class="department-structure">
            <h1>Department Structure</h1>
            <div id="department-chart"></div>
        </div>
        <div class="position-employment-data">
            <div class="top-employment-data">
                <div id="position-level">
                    <div class="position-level-top-bar">
                        <h2>Position Level</h2>
                        <a href="{{ route('admin.saved.jobdescriptions', ['org_department' => $id]) }}">View Details</a>
                    </div>
                    <svg id="chart" width="500" height="300"></svg>
                </div>
                <div class="employment-status">
                    <h2>Employment Status</h2>
                    <div id="employment-status-chart"></div>
                </div>
            </div>
            <div class="bottom-employment-data">
                <div class="employment-status">
                    <h2>Assessment Completion Status</h2>
                    <div id="assessment-completion-status-chart"></div>
                </div>
                {{-- <div class="talent-status">
                    <h2>Talent Insight</h2>
                    <div id="talent-insight-chart"></div>
                </div> --}}
            </div>
        </div>
    </div>
</div>