<!-- begin::Assessment Chart Section -->
<style>
    .bg-white {
        border-radius: 8px;
        background: #F1F1F4;
        border: 1px solid #F1F1F4;
        box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
    }

    .progress-circle {
        position: absolute;
        top: -31%;
        border: 5px solid #fff;
        width: 25px;
        height: 25px;
        border-radius: 50px;
        box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
    }

    .progress-circle.yellow-round {
        left: 15%;
    }

    .progress-circle.green-round {
        left: 47%;
    }


    .progress-circle.blue-round {
        left: 80%;
    }
</style>
<div class="d-flex mb-9 gap-7 gap-4">
    <!-- begin:chart1 (Personality & Motivation) -->
    <div class="card col p-4">
        <h3 class="card-title d-flex justify-content-between mt-4 fs-4">
            Personality & Motivation
        </h3>
        <div class="card-toolbar">
        </div>
        <div class="card-body my-15 p-0">
            <div class="circle @if ($user->is_personality_motivation_completed == 1) circle-completed  @else circle-incompleted @endif">
                @if ($user->is_personality_motivation_completed == 1)
                    <span class="text-center">Completed</span>
                @else
                    <a href="#" class="text-center text-primary fw-medium">Not Completed</a>
                @endif
            </div>
        </div>
    </div>
    <!-- end:chart 1 (Personality & Motivation) -->

    <!-- begin:chart 2 (Work Interest) -->
    <div class="card col p-4">
        <h3 class="card-title d-flex justify-content-between mt-5 m-1 fs-4">
            Work Interest
        </h3>
        <div class="card-toolbar">
        </div>
        <div class="card-body my-15 p-0">
            <div class="circle @if ($user->is_work_interest_completed == 1) circle-completed  @else circle-incompleted @endif">
                @if ($user->is_work_interest_completed == 1)
                    <span class="text-center">Completed</span>
                @else
                    <a href="#" class="text-center text-primary fw-medium">Not Completed</a>
                @endif
            </div>
        </div>
    </div>
    <!-- end:chart 2 (Work Interest) -->

    <!-- begin:chart 3 (Cognitive Ability) -->
    <div class="card col p-4">
        <h3 class="card-title d-flex justify-content-between mt-4 fs-4">
            Cognitive Ability
        </h3>
        <div class="card-toolbar">
        </div>
        <div class="card-body my-15 p-0">
            <div class="circle   @if ($user->is_cognitive_ability_completed == 1) circle-completed  @else circle-incompleted @endif ">

                @if ($user->is_cognitive_ability_completed == 1)
                    <span class="text-center">Completed</span>
                @else
                    <a href="#" class="text-center text-primary fw-medium">Not Completed</a>
                @endif
            </div>
        </div>
    </div>
    <!-- end:chart 3 (Cognitive Ability) -->
</div>
@if (
    $user->is_personality_motivation_completed == 1 &&
        $user->is_work_interest_completed == 1 &&
        $user->is_cognitive_ability_completed == 1 &&
        $isUserResultExists)
    <div class="h-full">
        <!--begin::Col 1 -->

        <div class="d-flex mb-9 gap-7 card p-9 gap-4 flex-row align-items-center" style="color: #5B5B5B">
            <div class="col-5 d-flex gap-15 align-items-center">
                {{-- <svg width="132" height="131" viewBox="0 0 132 131" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="Overall match rate (Medium)">
                        <ellipse id="Ellipse 7" cx="65.9995" cy="65.5005" rx="66"
                            ry="65.5" fill="#FFEBB4" />
                        <ellipse id="Ellipse 10" cx="66.0949" cy="64.1676" rx="54.6667"
                            ry="54.6468" fill="#FFE18F" />
                        <path id="Moderate"
                            d="M32.9446 55.5492H35.363L38.6016 63.454H38.7294L41.9681 55.5492H44.3864V66.4583H42.4901V58.9636H42.3889L39.374 66.4263H37.9571L34.9422 58.9476H34.841V66.4583H32.9446V55.5492ZM50.0221 66.6181C49.2231 66.6181 48.5306 66.4423 47.9446 66.0907C47.3587 65.7391 46.9042 65.2473 46.581 64.6152C46.2614 63.9831 46.1016 63.2445 46.1016 62.3993C46.1016 61.5541 46.2614 60.8137 46.581 60.1781C46.9042 59.5424 47.3587 59.0488 47.9446 58.6972C48.5306 58.3457 49.2231 58.1699 50.0221 58.1699C50.8211 58.1699 51.5135 58.3457 52.0995 58.6972C52.6854 59.0488 53.1382 59.5424 53.4578 60.1781C53.7809 60.8137 53.9425 61.5541 53.9425 62.3993C53.9425 63.2445 53.7809 63.9831 53.4578 64.6152C53.1382 65.2473 52.6854 65.7391 52.0995 66.0907C51.5135 66.4423 50.8211 66.6181 50.0221 66.6181ZM50.0327 65.0733C50.466 65.0733 50.8282 64.9543 51.1194 64.7164C51.4106 64.4749 51.6272 64.1518 51.7692 63.747C51.9148 63.3421 51.9876 62.8911 51.9876 62.394C51.9876 61.8933 51.9148 61.4405 51.7692 61.0357C51.6272 60.6273 51.4106 60.3024 51.1194 60.0609C50.8282 59.8194 50.466 59.6987 50.0327 59.6987C49.5888 59.6987 49.2195 59.8194 48.9248 60.0609C48.6336 60.3024 48.4152 60.6273 48.2696 61.0357C48.1275 61.4405 48.0565 61.8933 48.0565 62.394C48.0565 62.8911 48.1275 63.3421 48.2696 63.747C48.4152 64.1518 48.6336 64.4749 48.9248 64.7164C49.2195 64.9543 49.5888 65.0733 50.0327 65.0733ZM58.6154 66.6021C57.9726 66.6021 57.3973 66.4369 56.8895 66.1067C56.3817 65.7764 55.9804 65.297 55.6857 64.6685C55.3909 64.0399 55.2436 63.2764 55.2436 62.378C55.2436 61.4689 55.3927 60.7019 55.691 60.0769C55.9929 59.4483 56.3995 58.9742 56.9108 58.6546C57.4222 58.3315 57.9921 58.1699 58.6207 58.1699C59.1001 58.1699 59.4943 58.2516 59.8032 58.4149C60.1122 58.5747 60.3572 58.7683 60.5383 58.9955C60.7194 59.2193 60.8597 59.4306 60.9591 59.6294H61.039V55.5492H62.9726V66.4583H61.0763V65.1692H60.9591C60.8597 65.3681 60.7159 65.5793 60.5277 65.8031C60.3394 66.0232 60.0909 66.2114 59.7819 66.3677C59.473 66.5239 59.0841 66.6021 58.6154 66.6021ZM59.1534 65.02C59.5617 65.02 59.9098 64.91 60.1974 64.6898C60.485 64.4661 60.7034 64.1553 60.8526 63.7576C61.0017 63.3599 61.0763 62.8965 61.0763 62.3673C61.0763 61.8382 61.0017 61.3784 60.8526 60.9877C60.707 60.5971 60.4904 60.2935 60.2027 60.0769C59.9186 59.8602 59.5688 59.7519 59.1534 59.7519C58.7237 59.7519 58.365 59.8638 58.0774 60.0875C57.7897 60.3112 57.5731 60.6202 57.4275 61.0144C57.2819 61.4085 57.2091 61.8595 57.2091 62.3673C57.2091 62.8787 57.2819 63.335 57.4275 63.7363C57.5767 64.134 57.7951 64.4483 58.0827 64.6791C58.3739 64.9064 58.7308 65.02 59.1534 65.02ZM68.6495 66.6181C67.8292 66.6181 67.1208 66.4476 66.5242 66.1067C65.9312 65.7622 65.4748 65.2757 65.1552 64.6472C64.8356 64.0151 64.6758 63.2711 64.6758 62.4153C64.6758 61.5737 64.8356 60.835 65.1552 60.1994C65.4784 59.5602 65.9294 59.063 66.5082 58.7079C67.087 58.3492 67.7671 58.1699 68.5483 58.1699C69.0526 58.1699 69.5285 58.2516 69.9759 58.4149C70.4269 58.5747 70.8246 58.8233 71.1691 59.1607C71.5171 59.498 71.7905 59.9277 71.9894 60.4497C72.1883 60.9682 72.2877 61.5861 72.2877 62.3034V62.8947H65.5814V61.595H70.4393C70.4358 61.2257 70.3559 60.8972 70.1996 60.6095C70.0434 60.3183 69.825 60.0893 69.5444 59.9224C69.2674 59.7555 68.9443 59.672 68.575 59.672C68.1808 59.672 67.8346 59.7679 67.5363 59.9597C67.238 60.1479 67.0054 60.3965 66.8385 60.7054C66.6751 61.0108 66.5917 61.3464 66.5881 61.7122V62.8467C66.5881 63.3226 66.6751 63.731 66.8491 64.0719C67.0231 64.4092 67.2664 64.6685 67.5789 64.8496C67.8914 65.0271 68.2571 65.1159 68.6762 65.1159C68.9567 65.1159 69.2106 65.0769 69.4379 64.9987C69.6652 64.9171 69.8623 64.7981 70.0292 64.6418C70.1961 64.4856 70.3221 64.2921 70.4074 64.0612L72.2078 64.2636C72.0941 64.7395 71.8775 65.155 71.5579 65.5101C71.2419 65.8617 70.837 66.1351 70.3434 66.3304C69.8498 66.5222 69.2852 66.6181 68.6495 66.6181ZM73.919 66.4583V58.2764H75.7887V59.6401H75.8739C76.023 59.1678 76.2787 58.8038 76.6409 58.5481C77.0067 58.2889 77.424 58.1592 77.8927 58.1592C77.9992 58.1592 78.1182 58.1646 78.2496 58.1752C78.3845 58.1823 78.4964 58.1948 78.5852 58.2125V59.9863C78.5035 59.9579 78.3739 59.933 78.1963 59.9117C78.0223 59.8869 77.8536 59.8744 77.6903 59.8744C77.3387 59.8744 77.0227 59.9508 76.7421 60.1035C76.4652 60.2526 76.2468 60.4604 76.087 60.7267C75.9272 60.9931 75.8473 61.3002 75.8473 61.6482V66.4583H73.919ZM82.0742 66.6234C81.5557 66.6234 81.0887 66.5311 80.6733 66.3464C80.2613 66.1582 79.9346 65.8812 79.6931 65.5154C79.4552 65.1497 79.3362 64.6987 79.3362 64.1624C79.3362 63.7008 79.4215 63.319 79.5919 63.0172C79.7624 62.7154 79.995 62.4739 80.2897 62.2928C80.5845 62.1117 80.9165 61.9749 81.2858 61.8826C81.6587 61.7867 82.044 61.7175 82.4417 61.6749C82.9211 61.6252 83.31 61.5808 83.6083 61.5417C83.9066 61.4991 84.1232 61.4352 84.2581 61.3499C84.3966 61.2612 84.4659 61.1244 84.4659 60.9398V60.9078C84.4659 60.5065 84.3469 60.1958 84.109 59.9757C83.871 59.7555 83.5284 59.6454 83.0809 59.6454C82.6086 59.6454 82.234 59.7484 81.957 59.9543C81.6835 60.1603 81.4989 60.4036 81.403 60.6841L79.6026 60.4284C79.7446 59.9313 79.979 59.5158 80.3057 59.182C80.6324 58.8446 81.0319 58.5925 81.5042 58.4256C81.9765 58.2551 82.4985 58.1699 83.0703 58.1699C83.4644 58.1699 83.8568 58.2161 84.2475 58.3084C84.6381 58.4007 84.995 58.5534 85.3181 58.7665C85.6413 58.976 85.9005 59.2619 86.0958 59.6241C86.2947 59.9863 86.3941 60.4391 86.3941 60.9824V66.4583H84.5404V65.3343H84.4765C84.3593 65.5616 84.1942 65.7747 83.9811 65.9735C83.7716 66.1688 83.5071 66.3269 83.1875 66.4476C82.8714 66.5648 82.5003 66.6234 82.0742 66.6234ZM82.5749 65.2065C82.962 65.2065 83.2975 65.1301 83.5816 64.9774C83.8657 64.8212 84.0841 64.6152 84.2368 64.3595C84.3931 64.1038 84.4712 63.8251 84.4712 63.5232V62.5591C84.4108 62.6088 84.3078 62.655 84.1622 62.6976C84.0202 62.7402 83.8604 62.7775 83.6828 62.8095C83.5053 62.8414 83.3295 62.8698 83.1555 62.8947C82.9815 62.9195 82.8306 62.9409 82.7027 62.9586C82.4151 62.9977 82.1576 63.0616 81.9304 63.1504C81.7031 63.2391 81.5237 63.3634 81.3924 63.5232C81.261 63.6795 81.1953 63.8819 81.1953 64.1305C81.1953 64.4856 81.3249 64.7537 81.5841 64.9348C81.8434 65.1159 82.1736 65.2065 82.5749 65.2065ZM92.4186 58.2764V59.7679H87.7152V58.2764H92.4186ZM88.8764 56.3162H90.8046V63.9973C90.8046 64.2565 90.8437 64.4554 90.9218 64.5939C91.0035 64.7288 91.11 64.8212 91.2414 64.8709C91.3728 64.9206 91.5184 64.9455 91.6782 64.9455C91.799 64.9455 91.909 64.9366 92.0085 64.9188C92.1115 64.9011 92.1896 64.8851 92.2429 64.8709L92.5678 66.3784C92.4648 66.4139 92.3174 66.4529 92.1257 66.4955C91.9375 66.5382 91.7066 66.563 91.4332 66.5701C90.9502 66.5843 90.5152 66.5115 90.1282 66.3517C89.7411 66.1884 89.4339 65.9362 89.2066 65.5953C88.9829 65.2544 88.8728 64.8283 88.8764 64.3169V56.3162ZM97.5656 66.6181C96.7453 66.6181 96.0368 66.4476 95.4402 66.1067C94.8472 65.7622 94.3908 65.2757 94.0712 64.6472C93.7516 64.0151 93.5918 63.2711 93.5918 62.4153C93.5918 61.5737 93.7516 60.835 94.0712 60.1994C94.3944 59.5602 94.8454 59.063 95.4242 58.7079C96.0031 58.3492 96.6831 58.1699 97.4644 58.1699C97.9686 58.1699 98.4445 58.2516 98.8919 58.4149C99.3429 58.5747 99.7406 58.8233 100.085 59.1607C100.433 59.498 100.707 59.9277 100.905 60.4497C101.104 60.9682 101.204 61.5861 101.204 62.3034V62.8947H94.4974V61.595H99.3553C99.3518 61.2257 99.2719 60.8972 99.1156 60.6095C98.9594 60.3183 98.741 60.0893 98.4604 59.9224C98.1835 59.7555 97.8603 59.672 97.491 59.672C97.0968 59.672 96.7506 59.7679 96.4523 59.9597C96.154 60.1479 95.9214 60.3965 95.7545 60.7054C95.5911 61.0108 95.5077 61.3464 95.5041 61.7122V62.8467C95.5041 63.3226 95.5911 63.731 95.7651 64.0719C95.9391 64.4092 96.1824 64.6685 96.4949 64.8496C96.8074 65.0271 97.1732 65.1159 97.5922 65.1159C97.8727 65.1159 98.1266 65.0769 98.3539 64.9987C98.5812 64.9171 98.7783 64.7981 98.9452 64.6418C99.1121 64.4856 99.2381 64.2921 99.3234 64.0612L101.124 64.2636C101.01 64.7395 100.794 65.155 100.474 65.5101C100.158 65.8617 99.7531 66.1351 99.2595 66.3304C98.7658 66.5222 98.2012 66.6181 97.5656 66.6181Z"
                            fill="#F7941C" />
                    </g>
                </svg> --}}
                @php
                    // Fetch the current level and label dynamically
                    $current_level = $behaviorFitRateResult['soft-skill-score']['level'] ?? 0;
                    $level_label = config('helpers.behavior_fit_rate_levels')[$current_level] ?? 'N/A';

                    // Define fill colors for each level
                    $fill_colors = [
                        0 => '#E0E0E0', // Gray for "Data Not Available"
                        1 => '#FFCCCC', // Light Red for "Very Low"
                        2 => '#fe9791', // Red for "Low"
                        3 => '#FFd68c', // Yellow for "Moderate"
                        4 => '#91dda1', // Light Green for "High"
                        5 => '#91dda1', // Green for "Very High"
                    ];
 
                    $fill_outer_colors = [
                        0 => '#E0E0E0', // Gray for "Data Not Available"
                        1 => '#feb9b4', // Light Red for "Very Low"
                        2 => '#feb9b4', // Red for "Low"
                        3 => '#ffe7af', // Yellow for "Moderate"
                        4 => '#b4e8bf', // Light Green for "High"
                        5 => '#b4e8bf', // Green for "Very High"
                    ];
 
                    $fill_level_colors = [
                        0 => '#000000', // black for "Data Not Available"
                        1 => '#ef382f', // Light Red for "Very Low"
                        2 => '#ef382f', // Red for "Low"
                        3 => '#f5872c', // Yellow for "Moderate"
                        4 => '#227735', // Light Green for "High"
                        5 => '#227735', // Green for "Very High"
                    ];

                    // Determine the color for the current level
                    $current_fill_color = $fill_colors[$current_level] ?? '#FFFFFF';
                    $current_fill_text = $fill_level_colors[$current_level] ?? '#FFFFFF';
                    $current_outer_color = $fill_outer_colors[$current_level] ?? '#FFFFFF';
                @endphp

                <svg width="132" height="131" viewBox="0 0 132 131" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="Overall match rate ({{ $level_label }})">
                        <!-- Background Ellipse -->
                        <ellipse id="Ellipse 7" cx="65.9995" cy="65.5005" rx="66" ry="65.5"
                            fill="{{ $current_outer_color }}" />
                        <!-- Dynamic Ellipse -->
                        <ellipse id="Ellipse 10" cx="66.0949" cy="64.1676" rx="54.6667" ry="54.6468"
                            fill="{{ $current_fill_color }}" />
                        <!-- Level Text -->
                        <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" font-family="Arial"
                            font-size="18px" font-weight="600" fill="{{ $current_fill_text }}">
                            {{ $level_label }}
                        </text>
                    </g>
                </svg>


                <div class="col">
                    <p class="fs-2 fw-medium lh-base m-0">Behavioral Fit Rate:</p>
                    <p class="fs-5 fw-medium lh-base m-0"
                        style="font-size: 32px !important; color: {{ config('helpers.employee_detail_level_class_bfr')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }};">
                        {{ config('helpers.behavior_fit_rate_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}
                    </p>
                </div>
            </div>

            <div class="col d-flex flex-column gap-4">
                <div class="second-container gap-9">
                    <p class="m-0">Personality Type:</br>
                        {{ $personalityTypeResult['name'] ?? '' }}
                    </p>
                    <div>
                        <p class="m-0">Growth Potential:</p>
                        <div style="display:flex; align-items: center; gap: 5px;">
                            <iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}"></iconify-icon>
                            <p class="m-0">
                                {{ config('helpers.growth_potential_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="second-container gap-9">
                    <div>
                        <p class="m-0">Workplace Alignment Forecast:</p>
                        <div style="display:flex; align-items: center; gap:5px;">
                            <iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}"></iconify-icon>
                            <p class="m-0">
                                {{ config('helpers.organizational_fit_forecast_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }} Risk
                            </p>
                        </div>
                    </div>
                    <div>
                        <p class="m-0">Flight Risk:</p>
                        <div style="display:flex; align-items: center; gap: 5px;">
                            <iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$flightRiskResult['flight-risk']['level'] ?? 0] }}"></iconify-icon>
                            <p class="m-0">
                                {{ config('helpers.flight_risk_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }} Risk
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="d-flex mb-9 gap-7">
            <div class="w-100">
                <!--begin::Engage widget 1-->
                <div class="card psych-inner" dir="ltr">
                    <div class="top-head-view d-flex justify-content-between align-items-base"
                        style="margin-bottom: 45px;">
                        <!--begin::Title-->
                        <div>
                            <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">Allstar Values
                            </h3>
                            <p class="fs-5 fw-bold lh-base m-0">Expected Value: <span style="color: #FF5D5D;">Individual
                                    Contributor</span>
                            </p>
                        </div>
                    </div>
                    <!--end::Title-->
                    <div class="skill-table">
                        <div class="left-table">
                            <div class="table-top-content">
                                <div class="left-table-head">
                                    <p>Celebrate All Individuals<span style="color: #FF5D5D;"> 100% </span>
                                    <p
                                        class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading">
                                        <span>
                                            HIGHLY ALIGNED</span>
                                    </p>
                                    <p>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: 100%; background: #FF5D5D;" class="line line-orange dark-orange">
                                    </div>
                                    <div class="svg-round-icon" style="right: 0;">
                                        <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                    </div>
                                </div>
                                <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                    style="
                                        margin-top: 20px;
                                    ">
                                    <span
                                        style="background: #FFE4F2;
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
                                    culture that celebrates diversity, strengthens creativity, innovation and
                                    collaboration.
                                </p>
                            </div>
                        </div>
                        <div class="line-bottom"></div>
                        <div class="left-table">
                            <div class="table-top-content">
                                <div class="left-table-head">
                                    <p>Safety #1<span style="color: #FF5D5D;"> 98% </span>
                                    <p
                                        class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading">
                                        <span>
                                            HIGHLY ALIGNED</span>
                                    </p>
                                    <p>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: 98%; background: #FF5D5D;"
                                        class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon" style="right: 1%;">
                                        <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                    </div>
                                </div>
                                <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                    style="
                                        margin-top: 20px;
                                    ">
                                    <span
                                        style="background: #FFE4F2;
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
                                </p>
                            </div>
                        </div>
                        <div class="line-bottom"></div>
                        <div class="left-table">
                            <div class="table-top-content">
                                <div class="left-table-head">
                                    <p>Be Transparent<span style="color: #FF5D5D;"> 91% </span>
                                    <p
                                        class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading">
                                        <span>
                                            HIGHLY ALIGNED</span>
                                    </p>
                                    <p>
                                </div>
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
                                        style="background: #FFE4F2;
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
                                </p>
                            </div>
                        </div>
                        <div class="line-bottom"></div>
                        <div class="left-table">
                            <div class="table-top-content">
                                <div class="left-table-head">
                                    <p>Keep it simple!<span style="color: #FF5D5D;"> 87% </span>
                                    <p
                                        class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading">
                                        <span>
                                            HIGHLY ALIGNED</span>
                                    </p>
                                    <p>
                                </div>
                                <div class="line line-grey">
                                    <div style="width: 87%; background: #FF5D5D;"
                                        class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon" style="right: 11%;">
                                        <img src="{{ asset('admin/media/pdf/RoundIconRed.svg') }}" />
                                    </div>
                                </div>
                                <p class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading"
                                    style="
                                        margin-top: 20px;
                                    ">
                                    <span
                                        style="background: #FFE4F2;
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
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Engage widget 1-->
            </div>
            <!--end::Col 1-->

            <!--begin::Col 2-->
            <div class="w-100">
                <!--begin::Chart widget 5-->
                <div class="card psych-inner">
                    <!--begin::Header-->
                    <h3 class="fs-2 fw-bolder lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Academy's
                        Learning</br>
                        Interventions
                    </h3>
                    <div class="tweleve-inner" style="
                    margin-bottom: 30px;
                ">
                        <p class="tweleve-desc"
                            style="
                        font-size: 18px;
                        margin-bottom: 5px;
                    ">
                            <iconify-icon icon="octicon:light-bulb-16" style="color:#FF5D5D;"></iconify-icon> DEI
                        </p>
                        <p class="table-desc"
                            style="
                        font-size: 14px; line-height: normal;
                        ">
                            a comprehensive training program focused
                            on diversity, equity, and inclusion (DEI) in
                            the workplace.
                        </p>
                    </div>
                    <div class="tweleve-inner" style="
                    margin-bottom: 30px;
                ">
                        <p class="tweleve-desc"
                            style="
                        font-size: 18px;
                        margin-bottom: 5px;
                    ">
                            <iconify-icon icon="octicon:light-bulb-16" style="color:#FF5D5D;"></iconify-icon>
                            Effective
                            Communication
                        </p>
                        <p class="table-desc"
                            style="
                        font-size: 14px; line-height: normal;
                        ">
                            Provide practical exercises and role-plays
                            to help non-executive employees practice
                            simplifying complex information.
                        </p>
                    </div>
                    <div class="tweleve-inner">
                        <p class="tweleve-desc"
                            style="
                        font-size: 18px;
                        margin-bottom: 5px;
                    ">
                            <iconify-icon icon="octicon:light-bulb-16" style="color:#FF5D5D;"></iconify-icon>
                            Effective Communication
                        </p>
                        <p class="table-desc"
                            style="
                        font-size: 14px; line-height: normal;
                        ">
                            Topics such as active listening, clarity in
                            communication, and expressing opinions
                            transparently.
                        </p>
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
            </div>
            <!--end::Body-->
        </div> --}}


        @if ($user->is_personality_motivation_completed == 1 && $isUserResultExists)
            <div class="d-flex mb-9 gap-7">
                <div class="w-100">
                    <!--begin::Engage widget 1-->
                    <div class="card psych-inner" dir="ltr">
                        <div class="top-head-view d-flex justify-content-between align-items-base"
                            style="margin-bottom: 45px;">
                            <!--begin::Title-->
                            <div>
                                <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">OCEAN Domains
                                </h3>
                                <p class="fs-5 fw-bold lh-base m-0">Response Consistency Index: <span
                                        style="color: {{ config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level'] ?? 0] }};">{{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }}</span>
                                </p>
                            </div>
                            <div>
                                <p class="fs-6 fw-normal lh-base m-0 cursor-pointer" style="color: #F7941C"
                                    data-bs-toggle="modal" data-bs-target="#facetsModal">View all 30
                                    facets</p>

                            </div>
                        </div>
                        <!--end::Title-->
                        <div class="skill-table">
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Openness<span>
                                                    {{ $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">
                                            {{-- {{ $oceanDomainDescriptors->where('slug', 'openness-to-experience')->first()->analysis ?? ' ' }} --}}
                                            Imaginative, curious, open-minded, and willing to try new things. They tend
                                            to have a wide range of interests and a vivid imagination.
                                        </p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: {{ $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%;"
                                            class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon"
                                            style="right: {{ 100 - 2 - $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p
                                        class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }} right-top-heading">
                                        {{ $oceanDomainResult['openness-to-experience']['percentage_with_label'] ?? 0 }}<span>
                                            {{ config('helpers.ocean_levels')[$oceanDomainResult['openness-to-experience']['level'] ?? 0] }}</span>
                                    </p>
                                    <p class="table-desc">
                                        {{ $oceanDomainResult['openness-to-experience']['description'] ?? 0 }}</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Conscientiousness<span>
                                                    {{ $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 }}%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">
                                            {{-- {{ $oceanDomainDescriptors->where('slug', 'high-self-control')->first()->analysis ?? ' ' }} --}}
                                            Organized, dependable, and have a strong sense of duty. They are
                                            goal-oriented, disciplined, and prefer planned rather than spontaneous
                                            behavior.
                                        </p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: {{ $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 }}%;"
                                            class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon"
                                            style="right: {{ 100 - 2 - $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 }}%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p
                                        class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['conscientiousness']['level'] ?? 0] }} right-top-heading">
                                        {{ $oceanDomainResult['conscientiousness']['percentage_with_label'] ?? 0 }}<span>
                                            {{ config('helpers.ocean_levels')[$oceanDomainResult['conscientiousness']['level'] ?? 0] }}</span>
                                    </p>
                                    <p class="table-desc">
                                        {{ $oceanDomainResult['conscientiousness']['description'] ?? 0 }}</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Extroversion<span>
                                                    {{ $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">
                                            {{-- {{ $oceanDomainDescriptors->where('slug', 'extraversion')->first()->analysis ?? ' ' }} --}}
                                            Sociable, energetic, talkative, appeard to enjoy being around others. They
                                            are often perceived as outgoing and enthusiastic.
                                        </p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: {{ $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%;"
                                            class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon"
                                            style="right: {{ 100 - 2 - $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p
                                        class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['extraversion']['level'] ?? 0] }} right-top-heading">
                                        {{ $oceanDomainResult['extraversion']['percentage_with_label'] ?? 0 }}<span>
                                            {{ config('helpers.ocean_levels')[$oceanDomainResult['extraversion']['level'] ?? 0] }}</span>
                                    </p>
                                    <p class="table-desc">{{ $oceanDomainResult['extraversion']['description'] ?? 0 }}
                                    </p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Agreeableness<span>
                                                    {{ $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">
                                            {{-- {{ $oceanDomainDescriptors->where('slug', 'agreeableness')->first()->analysis ?? ' ' }} --}}
                                            Friendly, compassionate, cooperative, and eager to help others. They are
                                            often seen as trustworthy and good-natured.
                                        </p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: {{ $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%;"
                                            class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon"
                                            style="right: {{ 100 - 2 - $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p
                                        class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['agreeableness']['level'] ?? 0] }} right-top-heading">
                                        {{ $oceanDomainResult['agreeableness']['percentage_with_label'] ?? 0 }}<span>
                                            {{ config('helpers.ocean_levels')[$oceanDomainResult['agreeableness']['level'] ?? 0] }}</span>
                                    </p>
                                    <p class="table-desc">
                                        {{ $oceanDomainResult['agreeableness']['description'] ?? 0 }}</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div> 
                            <div class="inner-table">
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>Emotional Stability<span>
                                                    {{ $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">
                                            {{-- {{ $oceanDomainDescriptors->where('slug', 'low-anxiety')->first()->analysis ?? ' ' }} --}}
                                            Calm, emotionally stable, and less likely to experience negative
                                                emotions.They maintain a steady, calm demeanor, handling challenges with
                                                ease and are less affected by stress.
                                        </p>
                                    </div>
                                    <div class="line line-grey">
                                        <div style="width: {{ $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%;"
                                            class="line line-orange dark-orange"></div>
                                        <div class="svg-round-icon"
                                            style="right: {{ 100 - 2 - $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%;">
                                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="right-table">
                                    <p
                                        class="{{ config('helpers.other_class_based_on_levels')[$oceanDomainResult['emotional-stability']['level'] ?? 0] }} right-top-heading">
                                        {{ $oceanDomainResult['emotional-stability']['percentage_with_label'] ?? 0 }}<span>
                                            {{ config('helpers.ocean_levels')[$oceanDomainResult['emotional-stability']['level'] ?? 0] }}</span>
                                    </p>
                                    <p class="table-desc">
                                        {{ $oceanDomainResult['emotional-stability']['description'] ?? 0 }}</p>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                            <div class="tweleve-inner">
                                <p class="tweleve-desc"><iconify-icon icon="octicon:light-bulb-16"
                                        style="color:#F7941C; font-size:14px; "></iconify-icon> OCEAN Summary
                                </p>
                                <p class="table-desc" style="font-size: 14px; line-height: normal;">
                                   {{ $oceanSummary ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col 1-->

                <!--begin::Col 2-->
                <div class="w-100">
                    <!--begin::Chart widget 5-->
                    <div class="card psych-inner">
                        <!--begin::Header-->
                        <h3 class="fs-2 fw-bolder lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Learning Style
                        </h3>
                        <p class="fs-6 fw-normal lh-base d-flex gap-2" style="margin-bottom: 45px;"><svg
                                xmlns="http://www.w3.org/2000/svg" width="77" height="17" viewBox="0 0 77 17"
                                fill="none">
                                <rect width="77" height="17" fill="#FFF6EA" />
                                <line x1="1" x2="1" y2="17" stroke="#FFBD6F"
                                    stroke-width="2" />
                            </svg> Employee's Learning Style</p>
                        <div class="psych-bar d-flex flex-column gap-9">
                            <div class="left-table">
                                @if ($learningStyle['visual_kinesthetic_score'] > 3.75)
                                    <div class="orange-bg">
                                @endif
                                <p class="left-table-head">Visual & Kinesthetic<span>
                                        {{ $learningStyle['visual_kinesthetic_percentage'] ?? 0 }}%</span></p>
                                <p class="table-desc">
                                    {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'visual-kinesthetic')->first()->analysis ?? ' ' }}
                                </p>
                                @if ($learningStyle['visual_kinesthetic_score'] > 3.75)
                            </div>
        @endif
        <div class="line line-grey">
            <div style="width: {{ $learningStyle['visual_kinesthetic_percentage'] ?? 0 }}%;"
                class="line line-orange dark-orange"></div>
            <div class="svg-round-icon"
                style="right: {{ 100 - 2 - $learningStyle['visual_kinesthetic_percentage'] }}%; ">
                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
            </div>
        </div>
    </div>
    <div class="line-bottom"></div>
    <div class="left-table">
        @if ($learningStyle['aural_score'] > 3.75)
            <div class="orange-bg">
        @endif
        <p class="left-table-head">AURAL<span> {{ $learningStyle['aural_percentage'] ?? 0 }}%</span></p>
        <p class="table-desc">
            {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'aural')->first()->analysis ?? ' ' }}
        </p>
        @if ($learningStyle['aural_score'] > 3.75)
    </div>
@endif
<div class="line line-grey">
    <div style="width: {{ $learningStyle['aural_percentage'] ?? 0 }}%;" class="line line-orange dark-orange">
    </div>
    <div class="svg-round-icon" style="right: {{ 100 - 2 - $learningStyle['aural_percentage'] }}%;">
        <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
    </div>
</div>
</div>
<div class="line-bottom"></div>

<div class="left-table">
    @if ($learningStyle['reading_writing_score'] > 3.75)
        <div class="orange-bg">
    @endif
    <p class="left-table-head">Reading & Writing<span>
            {{ $learningStyle['reading_writing_percentage'] ?? 0 }}%</span></p>
    <p class="table-desc">
        {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'reading-writing')->first()->analysis ?? ' ' }}
    </p>
    @if ($learningStyle['reading_writing_score'] > 3.75)
</div>
@endif
<div class="line line-grey">
    <div style="width: {{ $learningStyle['reading_writing_percentage'] ?? 0 }}%;"
        class="line line-orange dark-orange"></div>
    <div class="svg-round-icon" style="right: {{ 100 - 2 - $learningStyle['reading_writing_percentage'] }}%;">
        <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
    </div>
</div>
</div>

<div class="line-bottom"></div>
<div class="tweleve-inner">
    <p class="tweleve-desc"><iconify-icon icon="octicon:light-bulb-16"
            style="color:#F7941C; font-size:14px; "></iconify-icon> Learning Style
        Summary</p>
    <p class="table-desc">
        @foreach ($learningStyle['learning_style_preference'] as $key => $learning_style_preference)
            {{ $learning_style_preference['learning_style_preference_summary'] ?? '' }} <br>
        @endforeach
    </p>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
</div>
<!--end::Body-->
</div>
<!--end::Chart widget 5-->
</div>
{{--
 <div class="mb-9 bg-white psych-inner">
    <div class="skill-div">
        <p class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Skills
            Alignment: Critical Core Skills</p>

    </div>
    <div class="skill-table">
        @foreach ($jobCcsResult as $name => $result)
            <div class="inner-table">
                <div class="left-table">
                    <div class="table-top-content">
                        <div class="left-table-head">
                            <p>{{ $result['name'] ?? '' }}<span> {{ $result['score'] ?? 0 }}%</span>
                            <p>
                            <p class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }}">
                                <span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span>
                            </p>
                        </div>
                        <p class="table-desc">
                            {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}</p>
                    </div>
                    <div class="line line-grey">
                        <div style="width: {{ $result['score'] ?? 0 }}%;" class="line line-orange dark-orange">
                        </div>
                        <div class="svg-round-icon" style="right: {{ 100 - 2 - $result['score'] }}%; ">
                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                        </div>
                    </div>
                </div>
                <div class="right-table">
                 <p class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }}">{{ $result['percentage'] ?? 0}}th <span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span></p>
                    <p class="{{ config('helpers.ccs_class_based_on_levels')[$result['required_level'] ?? 0] }}">
                        Generic Skills Requirement
                        <span>{{ config('helpers.ccs_levels')[$result['required_level'] ?? 0] }}</span>
                    </p>
                    <p class="cyan"><span>ALIGNED</span></p> 
                    <p class="table-desc">
                        {{ $result['description'] ?? '' }}
                    </p>
                </div>
            </div>
            <div class="line-bottom"></div>
        @endforeach
    </div>
</div> --}}

<div class="mb-9 bg-white psych-inner">
    <div class="skill-div">
        <p class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Critical Core Skills</p>

    </div>
    <div class="skill-table">

        <div class="inner-table" style="grid-template-columns: 48.7% 48.7%">
            <?php $i = 1; ?>
            @foreach ($ccsResult as $name => $result)
                <div class="left-table">
                    <div class="table-top-content">
                        <div class="left-table-head">
                            <p>{{ $result['name'] ?? '' }}<span> {{ $result['score'] ?? 0 }}%</span>
                            <p>
                        </div>
                        <p class="table-desc">
                            {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}</p>
                    </div>
                    <div class="line line-grey" style="margin-bottom: 15px">
                        <div style="width:  {{ $result['score'] ?? 0 }}%;" class="line line-orange dark-orange">
                        </div>
                        <div class="svg-round-icon" style="right:  {{ 100 - 2 - $result['score'] }}%;">
                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                        </div>
                    </div>
                    <div class="left-table-head" style="margin-top: 10px">
                        <p class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }}" style="text-transform: lowercase;">
                            {{ $result['percentage_with_label'] }}
                        </p>

                        <p class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }}">
                            <span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span>
                        </p>
                    </div>
                    <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                </div>
                @if ($i % 2 == 0)
                    <div class="line-bottom" style ="width: 120%;"></div>
                    <div class="line-bottom"></div>
                @endif
                <?php $i = $i + 1; ?>
            @endforeach

        </div>
    </div>
</div>
@endif
<!--end::Col-->
   

<div class="d-flex mb-9 gap-7">
    <div class="w-100">
        <!--begin::Engage widget 1-->
        <div class="card psych-inner h-100">
            <!--begin::Header-->
            <div class="psych-bar d-flex flex-column gap-9">
                <div class="work-right-inner">
                    <p class="work-right-head">Personality Type</p>
                    <p style="color: #5B5B5B !important; font-size: 24px; fw-medium">
                        {{ $personalityTypeResult['name'] ?? '' }}</p>
                    <div class="side-line-orange" style="width: 380px">
                        <p class="table-desc"> 
                            {!! str_replace(';', ';<br>', $personalityTypeResult['description'] ?? '') !!}
                        </p>
                    </div>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
        </div>
        <!--end::Engage widget 1-->
    </div>
    <!--end::Col 1-->

    <!--begin::Col 2-->
    <div class="w-100">
        <!--begin::Chart widget 5-->
        <div class="card psych-inner h-100">
            <!--begin::Header-->
            <div class="psych-bar d-flex flex-column gap-9">
                <div class="work-right-inner">
                    <p class="work-right-head">Growth Potential</p>
                    <div style="display:flex; align-items: baseline; gap:5px;">
                        <iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}" style="margin-top: 10px;"></iconify-icon>
                        <p style="color: #5B5B5B !important; font-size: 24px; fw-medium">
                            {{ config('helpers.growth_potential_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}
                        </p>
                    </div>
                    <div class="side-line-orange" style="width: 380px">
                        <p class="table-desc">
                            {!! $growthPotentialResult['growth-potential']['description'] ?? '' !!}
                        </p>

                    </div>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Chart widget 5-->
</div>
<div class="d-flex mb-9 gap-7">
    <div class="w-100">
        <!--begin::Engage widget 1-->
        <div class="card psych-inner h-100">
            <!--begin::Header-->
            <div class="psych-bar d-flex flex-column gap-9">
                <div class="work-right-inner">
                    <p class="work-right-head">Workplace Alignment Forecast</p>
                    <div style="display:flex; align-items: baseline; gap:5px;">
                        <iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}" style="margin-top: 10px;"></iconify-icon>
                                                
                        <p style="color: #5B5B5B !important; font-size: 24px; fw-medium">
                            {{ config('helpers.organizational_fit_forecast_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}
                            Risk</p>
                    </div>
                    <div class="side-line-orange" style="width: 380px">
                        <p class="table-desc">
                            {!! $organizationalFitForecastResult['organizational-fit-forecast']['description'] ?? '' !!}
                        </p>
                    </div>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
        </div>
        <!--end::Engage widget 1-->
    </div>
    <!--end::Col 1-->

    <!--begin::Col 2-->
    <div class="w-100">
        <!--begin::Chart widget 5-->
        <div class="card psych-inner h-100">
            <!--begin::Header-->
            <div class="psych-bar d-flex flex-column gap-9">
                <div class="work-right-inner">
                    <p class="work-right-head">Flight Risk</p>
                    <div style="display:flex; align-items: baseline; gap:5px;">
                        <iconify-icon 
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$flightRiskResult['flight-risk']['level'] ?? 0] }}" style="margin-top: 10px;"></iconify-icon>
                        <p style="color: #5B5B5B !important; font-size: 24px; fw-medium">
                            {{ config('helpers.flight_risk_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }} Risk
                        </p>
                    </div>
                    <div class="side-line-orange" style="width: 380px">
                        <p class="table-desc">{!! $flightRiskResult['flight-risk']['description'] ?? '' !!}</p>
                    </div>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Chart widget 5-->
</div>

<!--begin::Col 1 -->
@if ($user->is_work_interest_completed == 1 && $isUserResultExists)
    <!--begin::Col 1 -->
    <h1>RIASEC Test</h1>
    <div class="d-flex flex-column flex-md-row mb-9 gap-5 justify-content-center" style="margin-top: 30px;">
        <div class="col-xl-6 pr-3 pl-0">
            <!--begin::Engage widget 1-->
            <div class="card psych-inner" dir="ltr">
                <!--begin::Title-->
            <!-- Title Row -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- Left: Work Interest Heading -->
                    <div>
                    <h3 class="fs-2 fw-bold lh-base m-0 mb-2" style="color: #5B5B5B;">Work Interest</h3>
                    <div class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="77" height="17" viewBox="0 0 77 17" fill="none">
                            <rect width="77" height="17" fill="#FFF6EA" />
                            <line x1="1" x2="1" y2="17" stroke="#FFBD6F" stroke-width="2" />
                        </svg>
                    <p class="work-right-head m-0" style="font-size: 12px;">Job Position's Top 3 RIASEC</p>
                        </div>
                    </div>

                    <div>    <!-- Right: Job's Top 3 RIASEC Heading -->
                    <p class="work-right-head m-0 mb-3">Job's Top 3 RIASEC:</p>
                        <p class="work-orange m-0">{{ $riasecTop3Result['job_top_3_riasec'] ?? '' }}</p>
                    </div>

                </div>
                
                
                <div class="psych-bar d-flex flex-column gap-9">
                    
                    @foreach ($riasecDomainResult as $slug => $result)
                        <div class="left-table">
                            @if (in_array($result['code'], $riasecTop3Result['job_top_3_riasec_array']))
                                <div class="orange-bg">
                            @endif
                            <p class="left-table-head">{{ $result['name'] ?? '' }}<span>
                                    {{ $result['score'] ?? 0 }}%</span></p>
                            <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                            @if (in_array($result['code'], $riasecTop3Result['job_top_3_riasec_array']))
                                </div>
                            @endif
                                <div class="line line-grey">
                                    <div style="width: {{ $result['score'] }}%;" class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon" style="right: {{ 100 - 2 - $result['score'] }}%;">
                                        <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                    </div>
                                </div>
                        </div>
                    <div class="line-bottom"></div>
                    @endforeach
                </div>
            </div>
            <!--end::Engage widget 1-->
        </div>
        <!--end::Col 1-->

        <!--begin::Col 2-->
        <div class="col-xl-6 pl-3">
            <!--begin::Chart widget 5-->
            <div class="card psych-inner">
                <!--begin::Header-->
                <div class="psych-bar d-flex flex-column gap-9">
                    <div class="work-right-inner">
                        <p class="work-right-head">Employee's Top 3 RIASEC:</p>
                        <p class="work-orange">{{ $riasecTop3Result['string'] ?? '' }}</p>
                        <p class="table-desc">
                            {{ $riasecTop3Result['description'] ?? '' }}
                        </p>
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Chart widget 5-->
    </div>
    <!--end::Col-->
@endif

<div class="d-flex mb-9 gap-7">
    <div class="w-100">
        <!--begin::Engage widget 1-->
        <div class="card psych-inner" dir="ltr">
            <div class="top-head-view d-flex justify-content-between align-items-base" style="margin-bottom: 45px;">
                <!--begin::Title-->
                <div>
                    <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">Overall
                        Cognitive Ability
                    </h3>
                    <p class="fw-medium lh-base m-0 {{ config('helpers.cognitive_ability_circle_class')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }}"
                        style = "font-size: 24px; background: none !important;">
                        {{ config('helpers.cognitive_ability_levels')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }}
                    </p>
                </div>
            </div>
            <!--end::Title-->
            <div class="skill-table">
                <div>
                    <div class="left-table">
                        <div class="table-top-content">
                            <div class="left-table-head">
                                <p>Quantitative Knowledge </p>
                            </div>
                            {{-- <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                        try new things. They tend to have a wide range of interests and a
                                        vivid imagination.</p> --}}
                        </div>
                        <div class="progress-container">
                            <div class="progress-fill">
                                <div class="progress-segment segment-yellow"></div>
                                <div class="progress-segment segment-orange"></div>
                                <div class="progress-segment segment-blue"></div>
                            </div>
                            <div class="progress-circle {{ config('helpers.cognitive_ability_circle_class')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }}" {{-- style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }}, -50%);" --}}>
                                {{-- <img src="{{ asset('admin/media/pdf/ProgressCircle.svg') }}"
                                    alt="Progress Circle" /> --}}
                            </div>
                        </div>
                        <p
                            class="">
                            <span class="fw-bold fs-6 p-0 pr-2"
                                style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                            </span>
                            <span class="badge-custom {{ config('helpers.cognitive_ability_levels_class')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }}">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }}</span>
                        </p>
                        <p class="table-desc">
                            {{ $cognitiveDomainResult['quantitative-knowledge']['description'] ?? 0 }}
                        </p>
                    </div>
                </div>
                <div class="line-bottom"></div>
                <div>
                    <div class="left-table">
                        <div class="table-top-content">
                            <div class="left-table-head">
                                <p>Comprehensive Knowledge </p>
                            </div>
                            {{-- <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                        try new things. They tend to have a wide range of interests and a
                                        vivid imagination.</p> --}}
                        </div>
                        <div class="progress-container">
                            <div class="progress-fill">
                                <div class="progress-segment segment-yellow"></div>
                                <div class="progress-segment segment-orange"></div>
                                <div class="progress-segment segment-blue"></div>
                            </div>
                            <div class="progress-circle {{ config('helpers.cognitive_ability_circle_class')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }}" {{-- style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }}, -50%);" --}}>
                                {{-- <img src="{{ asset('admin/media/pdf/ProgressCircle.svg') }}"
                                    alt="Progress Circle" /> --}}
                            </div>
                        </div>
                        <p
                            class="">
                            <span class="fw-bold fs-6 p-0 pr-2"
                                style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                            </span>
                            <span class="badge-custom {{ config('helpers.cognitive_ability_levels_class')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }}" >{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }}</span>
                        </p>
                        <p class="table-desc">
                            {{ $cognitiveDomainResult['comprehension-knowledge']['description'] ?? 0 }}
                        </p>
                    </div>
                </div>
                <div class="line-bottom"></div>
                <div>
                    <div class="left-table">
                        <div class="table-top-content">
                            <div class="left-table-head">
                                <p>Visual Reasoning </p>
                            </div>
                            {{-- <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                        try new things. They tend to have a wide range of interests and a
                                        vivid imagination.</p> --}}
                        </div>
                        <div class="progress-container">
                            <div class="progress-fill">
                                <div class="progress-segment segment-yellow"></div>
                                <div class="progress-segment segment-orange"></div>
                                <div class="progress-segment segment-blue"></div>
                            </div>
                            <div class="progress-circle {{ config('helpers.cognitive_ability_circle_class')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }}" {{-- style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }}, -50%);" --}}>
                                {{-- <img src="{{ asset('admin/media/pdf/ProgressCircle.svg') }}"
                                    alt="Progress Circle" /> --}}
                            </div>
                        </div>
                        <p
                            class="">
                            <span class="fw-bold fs-6 p-0 pr-2"
                                style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                            </span>
                            <span class="badge-custom {{ config('helpers.cognitive_ability_levels_class')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }}">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }}</span>
                        </p>
                        <p class="table-desc">
                            {{ $cognitiveDomainResult['visual-reasoning']['description'] ?? 0 }}
                        </p>
                    </div>
                </div>
                <div class="line-bottom"></div>
                <div>
                    <div class="left-table">
                        <div class="table-top-content">
                            <div class="left-table-head">
                                <p>Fluid Reasoning </p>
                            </div>
                            {{-- <p class="table-desc">Imaginative, curious, open-minded, and willing to
                                        try new things. They tend to have a wide range of interests and a
                                        vivid imagination.</p> --}}
                        </div>
                        <div class="progress-container">
                            <div class="progress-fill">
                                <div class="progress-segment segment-yellow"></div>
                                <div class="progress-segment segment-orange"></div>
                                <div class="progress-segment segment-blue"></div>
                            </div>
                            <div class="progress-circle {{ config('helpers.cognitive_ability_circle_class')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }}" {{-- style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }}, -50%);" --}}>
                                {{-- <img src="{{ asset('admin/media/pdf/ProgressCircle.svg') }}"
                                    alt="Progress Circle" /> --}}
                            </div>
                        </div>
                        <p
                            class="">
                            <span class="fw-bold fs-6 p-0 pr-2"
                                style="background: none; color: #000 !important; text-transform: capitalize;">Level:
                            </span>
                            <span class="badge-custom {{ config('helpers.cognitive_ability_levels_class')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }}">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }}</span>
                        </p>
                        <p class="table-desc">
                            {{ $cognitiveDomainResult['fluid-reasoning']['description'] ?? 0 }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Engage widget 1-->
    </div>
    <!--end::Col 1-->

    <!--begin::Col 2-->
    <div class="w-100">
        <!--begin::Chart widget 5-->
        <div class="card psych-inner">
            <!--begin::Header-->
            <h3 class="fs-2 fw-medium lh-base" style="color: #5B5B5B;">
                Results:
            </h3>

            <div class="chart-container" id="cognitiveChart">
                {{-- <svg width="270.501px" height="270.501px" viewBox="0 0 36 36" class="circular-chart">
                            <!-- Full Circle (Background) -->
                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#F0F0F0" stroke-width="3"></circle>
                        
                            <!-- Missed Answers (Non Attempted) -->
                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#BBA7F6" stroke-width="3"
                                stroke-dasharray="{{ $totalNonAttemptedForCognitive * 2 }} 100"
                                stroke-dashoffset="{{ 100 - ($totalNonAttemptedForCognitive * 2) }}"></circle>
                        
                            <!-- Wrong Answers -->
                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#FFDC92" stroke-width="3"
                                stroke-dasharray="{{ $totalWrongForCognitive * 2 }} 100"
                                stroke-dashoffset="{{ 100 - ($totalWrongForCognitive * 2 + $totalNonAttemptedForCognitive * 2) }}"></circle>
                        
                            <!-- Correct Answers -->
                            <circle cx="18" cy="18" r="15.915" fill="none" stroke="#8CE3E3" stroke-width="3"
                                stroke-dasharray="{{ $totalCorrectForCognitive * 2 }} 100"
                                stroke-dashoffset="{{ 100 - ($totalCorrectForCognitive * 2 + $totalWrongForCognitive * 2 + $totalNonAttemptedForCognitive * 2) }}"></circle>
                        </svg>
                        
                        <div class="chart-label correct-label">
                            {{ $totalCorrectForCognitive * 2 }}% <br />CORRECT ANSWERS
                        </div>
                        <div class="chart-label wrong-label">
                            {{ $totalWrongForCognitive * 2 }}% <br />WRONG ANSWERS
                        </div>
                        <div class="chart-label missed-label">
                            {{ $totalNonAttemptedForCognitive * 2 }}% <br />MISSED QUESTIONS
                        </div> --}}


            </div>


            {{-- <div class="circle-second-div">
                        <p><span class="correct"></span>Correct Answers</p>
                        <p><span class="wrong"></span>Wrong Answers</p>
                        <p><span class="missed"></span>Wrong Answers</p>
                    </div> --}}
            <!--end::Header-->

            <!--begin::Body-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Chart widget 5-->
</div>
<!--end::Col-->

{{-- 30 Facets Modal Modal Start --}}
<div class="modal bg-body fade" tabindex="-1" id="facetsModal">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h3 class="modal-titlefs-2 fw-medium" style="color: #5B5B5B">OCEAN Personality Test: 30 Facets</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">

                    <iconify-icon icon="line-md:close" class=" fs-2x"></iconify-icon>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_content" class="app-content  flex-column-fluid ">
                        <div id="kt_app_content_container" class="container-xxl">
                            <div class="d-flex mb-9 gap-7">
                                <div class="w-100">
                                    <!--begin::Engage widget 1-->
                                    <div class="card psych-inner h-100 justify-content-start" dir="ltr">
                                        <div style="margin-bottom: 45px;">
                                            <!--begin::Title-->
                                            <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">Openness to
                                                Experience
                                            </h3>
                                            {{-- <p class="fs-5 fw-bold lh-base m-0">Response Consistency Index: <span style="color: #2AA443">Consistent</span></p> --}}
                                        </div>
                                        <!--end::Title-->
                                        <div class="skill-table">
                                            @foreach ($oceanAllFacetsResult->whereIn('slug', ['daydreaming', 'aesthetic-appreciation', 'feeling-aware', 'explorer', 'innovation', 'open-mindedness']) as $name => $result)
                                                <div class="inner-table">
                                                    <div class="left-table">
                                                        <div class="table-top-content">
                                                            <div class="left-table-head">
                                                                <p>{{ $result['name'] ?? '' }}<span>
                                                                        {{ $result['score_percentage'] ?? 0 ?? 0 }}%</span>
                                                                <p>
                                                            </div>
                                                            <p class="table-desc">
                                                                {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                            </p>
                                                        </div>
                                                        <div class="line line-grey">
                                                            <div style="width: {{ $result['score_percentage'] ?? 0 ?? 0 }}%;"
                                                                class="line line-orange dark-orange"></div>
                                                            <div class="svg-round-icon"
                                                                style="right: {{ 100 - 2 - $result['score_percentage'] ?? 0 }}%;">
                                                                <img
                                                                    src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="right-table">
                                                        <p
                                                            class="{{ config('helpers.other_class_based_on_levels')[$result['level'] ?? 0] }}">
                                                            {{ $result['percentage_with_label'] ?? 0 }}
                                                            <span>{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                                        </p>
                                                        <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                                    </div>
                                                </div>
                                                <div class="line-bottom"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Engage widget 1-->
                                </div>
                                <!--end::Col 1-->

                                <!--begin::Col 2-->
                                <div class="w-100">
                                    <!--begin::Chart widget 5-->
                                    <div class="card psych-inner h-100 justify-content-start" dir="ltr">
                                        <div style="margin-bottom: 45px;">
                                            <!--begin::Title-->
                                            <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">
                                                Conscientiousness
                                            </h3>
                                            {{-- <p class="fs-5 fw-bold lh-base m-0">Response Consistency Index: <span style="color: #2AA443">Consistent</span></p> --}}
                                        </div>
                                        <!--end::Title-->
                                        <div class="skill-table">
                                            @foreach ($oceanAllFacetsResult->whereIn('slug', ['self-confidence', 'tidiness', 'responsibility', 'drive-to-achieve', 'willpower', 'careful-thinking']) as $name => $result)
                                                <div class="inner-table">
                                                    <div class="left-table">
                                                        <div class="table-top-content">
                                                            <div class="left-table-head">
                                                                <p>{{ $result['name'] ?? '' }}<span>
                                                                        {{ $result['score_percentage'] ?? 0 ?? 0 }}%</span>
                                                                <p>
                                                            </div>
                                                            <p class="table-desc">
                                                                {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                            </p>
                                                        </div>
                                                        <div class="line line-grey">
                                                            <div style="width: {{ $result['score_percentage'] ?? 0 ?? 0 }}%;"
                                                                class="line line-orange dark-orange"></div>
                                                            <div class="svg-round-icon"
                                                                style="right: {{ 100 - 2 - $result['score_percentage'] ?? 0 }}%;">
                                                                <img
                                                                    src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="right-table">
                                                        <p
                                                            class="{{ config('helpers.other_class_based_on_levels')[$result['level'] ?? 0] }}">
                                                            {{ $result['percentage_with_label'] ?? 0 }}
                                                            <span>{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                                        </p>
                                                        <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                                    </div>
                                                </div>
                                                <div class="line-bottom"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Chart widget 5-->
                            </div>
                        </div>
                        <div id="kt_app_content_container" class="container-xxl">
                            <div class="d-flex mb-9 gap-7">
                                <div class="w-100">
                                    <!--begin::Engage widget 1-->
                                    <div class="card psych-inner h-100 justify-content-start" dir="ltr">
                                        <div style="margin-bottom: 45px;">
                                            <!--begin::Title-->
                                            <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">
                                                Extroversion
                                            </h3>
                                            {{-- <p class="fs-5 fw-bold lh-base m-0">Response Consistency Index: <span style="color: #2AA443">Consistent</span></p> --}}
                                        </div>
                                        <!--end::Title-->
                                        <div class="skill-table">
                                            @foreach ($oceanAllFacetsResult->whereIn('slug', ['sociability', 'crowd-enjoyment', 'confidence', 'energetic-lifestyle', 'thrill-seeking', 'optimism']) as $name => $result)
                                                <div class="inner-table">
                                                    <div class="left-table">
                                                        <div class="table-top-content">
                                                            <div class="left-table-head">
                                                                <p>{{ $result['name'] ?? '' }}<span>
                                                                        {{ $result['score_percentage'] ?? 0 ?? 0 }}%</span>
                                                                <p>
                                                            </div>
                                                            <p class="table-desc">
                                                                {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                            </p>
                                                        </div>
                                                        <div class="line line-grey">
                                                            <div style="width: {{ $result['score_percentage'] ?? 0 ?? 0 }}%;"
                                                                class="line line-orange dark-orange"></div>
                                                            <div class="svg-round-icon"
                                                                style="right: {{ 100 - 2 - $result['score_percentage'] ?? 0 }}%;">
                                                                <img
                                                                    src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="right-table">
                                                        <p
                                                            class="{{ config('helpers.other_class_based_on_levels')[$result['level'] ?? 0] }}">
                                                            {{ $result['percentage_with_label'] ?? 0 }}
                                                            <span>{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                                        </p>
                                                        <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                                    </div>
                                                </div>
                                                <div class="line-bottom"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Engage widget 1-->
                                </div>
                                <!--end::Col 1-->

                                <!--begin::Col 2-->
                                <div class="w-100">
                                    <!--begin::Chart widget 5-->
                                    <div class="card psych-inner h-100 justify-content-start" dir="ltr">
                                        <div style="margin-bottom: 45px;">
                                            <!--begin::Title-->
                                            <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">
                                                Agreeableness
                                            </h3>
                                            {{-- <p class="fs-5 fw-bold lh-base m-0">Response Consistency Index: <span style="color: #2AA443">Consistent</span></p> --}}
                                        </div>
                                        <!--end::Title-->
                                        <div class="skill-table">
                                            @foreach ($oceanAllFacetsResult->whereIn('slug', ['belief', 'honesty', 'helpfulness', 'diplomacy', 'humility', 'compassion']) as $name => $result)
                                                <div class="inner-table">
                                                    <div class="left-table">
                                                        <div class="table-top-content">
                                                            <div class="left-table-head">
                                                                <p>{{ $result['name'] ?? '' }}<span>
                                                                        {{ $result['score_percentage'] ?? 0 ?? 0 }}%</span>
                                                                <p>
                                                            </div>
                                                            <p class="table-desc">
                                                                {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                            </p>
                                                        </div>
                                                        <div class="line line-grey">
                                                            <div style="width: {{ $result['score_percentage'] ?? 0 ?? 0 }}%;"
                                                                class="line line-orange dark-orange"></div>
                                                            <div class="svg-round-icon"
                                                                style="right: {{ 100 - 2 - $result['score_percentage'] ?? 0 }}%;">
                                                                <img
                                                                    src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="right-table">
                                                        <p
                                                            class="{{ config('helpers.other_class_based_on_levels')[$result['level'] ?? 0] }}">
                                                            {{ $result['percentage_with_label'] ?? 0 }}
                                                            <span>{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                                        </p>
                                                        <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                                    </div>
                                                </div>
                                                <div class="line-bottom"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Chart widget 5-->
                            </div>
                        </div>
                        <div id="kt_app_content_container" class="container-xxl">
                            <div class="d-flex mb-9 gap-7">
                                <div class="w-100">
                                    <!--begin::Engage widget 1-->
                                    <div class="card psych-inner h-100 justify-content-start" dir="ltr">
                                        <div style="margin-bottom: 45px;">
                                            <!--begin::Title-->
                                            <h3 class="fs-2 fw-medium lh-base m-0" style="color: #5B5B5B;">Emotional
                                                Stability
                                            </h3>
                                            {{-- <p class="fs-5 fw-bold lh-base m-0">Response Consistency Index: <span style="color: #2AA443">Consistent</span></p> --}}
                                        </div>
                                        <!--end::Title-->
                                        <div class="skill-table">
                                            @foreach ($oceanAllFacetsResult->whereIn('slug', ['steadiness', 'tolerance', 'positivity', 'social-sensitivity', 'impulse-control', 'stress-response']) as $name => $result)
                                                <div class="inner-table">
                                                    <div class="left-table">
                                                        <div class="table-top-content">
                                                            <div class="left-table-head">
                                                                <p>{{ $result['name'] ?? '' }}<span>
                                                                        {{ $result['score_percentage'] ?? 0 ?? 0 }}%</span>
                                                                <p>
                                                            </div>
                                                            <p class="table-desc">
                                                                {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                            </p>
                                                        </div>
                                                        <div class="line line-grey">
                                                            <div style="width: {{ $result['score_percentage'] ?? 0 ?? 0 }}%;"
                                                                class="line line-orange dark-orange"></div>
                                                            <div class="svg-round-icon"
                                                                style="right: {{ 100 - 2 - $result['score_percentage'] ?? 0 }}%;">
                                                                <img
                                                                    src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="right-table">
                                                        <p
                                                            class="{{ config('helpers.other_class_based_on_levels')[$result['level'] ?? 0] }}">
                                                            {{ $result['percentage_with_label'] ?? 0 }}
                                                            <span>{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                                        </p>
                                                        <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                                    </div>
                                                </div>
                                                <div class="line-bottom"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Engage widget 1-->
                                </div>

                                <div class="w-100">
                                </div>
                                <!--end::Col 1-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- 30 Facets Modal Modal End --}}


</div>
@else
<div class="d-flex">
    <div class="col-xl-12">
        <div class="card psych-inner">
            <h6 class="text-center">
                Details will be available once assessments are completed by the user.
            </h6>
        </div>
    </div>
</div>
@endif
