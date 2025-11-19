@if($results->isEmpty())
    <tr>
        <td colspan="11" class="text-center"> <h2>Data not available</h2> </td>
    </tr>
@else
    @foreach ($results as $result)
        <tr>
            <td>
                <input type="checkbox" class="user-checkbox" 
                       data-id="{{ $result->id }}" 
                       data-name="{{ $result->name }}"
                       @if(in_array($result->id, is_array(request('user_ids')) ? request('user_ids') : explode(',', request('user_ids', '')))) checked @endif>
            </td>
            
            <td>
                <div class="employee-info">
                    {{-- <img src="{{ asset($result->profile_picture ?? '') }}"
                    onerror="this.src='{{ asset('images/default-user.svg') }}'"
                    alt="image" /> --}}
                    <img src="{{ asset($result->profile_picture ?? 'images/default-user.svg') }}" alt="">
                    <div class="profile-name">
                        <p class="employee-name">{{ $result->name ?? '' }}</p>
                        <p class="employee-role">{{ $result->position_title ?? '' }}</p>
                        @if($result->is_high_potential)
                            <span class="high">Bookmarked</span>
                        @endif
                    </div>
                    <a href="#" data-kt-menu-trigger="click"
                        data-kt-menu-placement="auto">
                        <iconify-icon icon="entypo:dots-three-vertical"></iconify-icon>
                    </a>

                    <div class="menu menu-sub menu-sub-dropdown mt-7 p-3 text-left drop-content" 
                        data-kt-menu="true" id="kt_menu_65e95fe68ac03">
                        <a class="m-0 px-4 py-2" target="_blank" href="{{ route('admin.employee.details', ['id' => $result->id]) }}">View Profile</a>
                        <a class="m-0 px-4 py-2" href="{{ route('admin.talent-insight.tag_high_potential', ['employee_id' => $result->id]) }}?department_id={{ request('department_id') }}&position_level={{ request('position_level') }}&user_ids={{ is_array(request('user_ids')) ? implode(',', request('user_ids')) : request('user_ids') }}">
                            @if($result->is_high_potential == 1)
                                Remove Bookmark
                            @else
                                Bookmark Employee
                            @endif
                        </a>
                    </div>
                </div>
            </td>
            @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                <td><span class="{{ config('helpers.talent_insight_positive_levels_class')[$result->omr_level ?? 0] }}">{{ config('helpers.overall_match_rate_levels')[$result->omr_level ?? 0] }}</span></td> 
                <td><span class="{{ config('helpers.talent_insight_positive_levels_class')[$result->ta_level ?? 0] }}">{{ config('helpers.technical_assessment_levels')[$result->ta_level ?? 0] }}</span></td>
            @endif
            {{-- <td><span class="{{ config('helpers.talent_insight_positive_3_levels_class')[$result->bfr_level ?? 0] }}">{{ config('helpers.cognitive_ability_levels')[$result->bfr_level ?? 0] }}</span></td> --}}
            <td><span class="{{ config('helpers.talent_insight_positive_levels_class')[$result->bfr_level ?? 0] }}">{{ config('helpers.behavior_fit_rate_levels')[$result->bfr_level ?? 0] }}</span></td>
            <td><span class="{{ config('helpers.talent_insight_positive_levels_class')[$result->tsmr_level ?? 0] }}">{{ config('helpers.behavior_fit_rate_levels')[$result->tsmr_level ?? 0] }}</span></td>
            <td><span class="{{ config('helpers.talent_insight_positive_levels_class')[$result->ssmr_level ?? 0] }}">{{ config('helpers.talent_pillar_match_rate_levels')[$result->ssmr_level ?? 0] }}</span></td>
            <td><span class="{{ config('helpers.talent_insight_positive_levels_class')[$result->jmr_level ?? 0] }}">{{ config('helpers.job_match_rate_levels')[$result->jmr_level ?? 0] }}</span></td>
            <td><span class="{{ config('helpers.talent_insight_positive_3_levels_class')[$result->cat_level ?? 0] }}">{{ config('helpers.cognitive_ability_levels')[$result->cat_level ?? 0] }}</span></td>
            <td><span class="{{ config('helpers.talent_insight_positive_levels_class')[$result->lp_level ?? 0] }}">{{ config('helpers.growth_potential_levels')[$result->lp_level ?? 0] }}</span></td>
            <td><span class="{{ config('helpers.talent_insight_positive_levels_class')[$result->gp_level ?? 0] }}">{{ config('helpers.growth_potential_levels')[$result->gp_level ?? 0] }}</span></td>
            <td><span class="{{ config('helpers.talent_insight_positive_3_levels_class_rci')[$result->rci_level ?? -1] }}">{{ config('helpers.rci_levels')[$result->rci_level ?? -1] }}</span></td>
            <td><span class="{{ config('helpers.talent_insight_negative_levels_class')[$result->fr_level ?? 0] }}">{{ config('helpers.flight_risk_levels')[$result->fr_level ?? 0] }}</span></td>
            <td><span class="{{ config('helpers.talent_insight_negative_levels_class')[$result->waf_level ?? 0] }}">{{ config('helpers.organizational_fit_forecast_levels')[$result->waf_level ?? 0] }}</span></td>
        </tr>
    @endforeach
@endif
