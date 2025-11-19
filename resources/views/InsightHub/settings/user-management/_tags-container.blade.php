<div class="d-flex justify-content-between align-items-center mb-5 tags-container">
    {{-- Business Unit tags --}}
    @foreach($selectedFilters['business_unit'] ?? [] as $buId)
        @if(isset($businessUnits[$buId]))
            <div class="tag">
                {{ $businessUnits[$buId] }}
                <iconify-icon icon="material-symbols:close-rounded" width="18" height="18"></iconify-icon>
            </div>
        @endif
    @endforeach
    {{-- Division tags --}}
    @foreach($selectedFilters['division'] ?? [] as $divId)
        @if(isset($divisions[$divId]))
            <div class="tag">
                {{ $divisions[$divId] }}
                <iconify-icon icon="material-symbols:close-rounded" width="18" height="18"></iconify-icon>
            </div>
        @endif
    @endforeach
    {{-- Department tags --}}
    @foreach($selectedFilters['department'] ?? [] as $deptId)
        @if(isset($departments[$deptId]))
            <div class="tag">
                {{ $departments[$deptId] }}
                <iconify-icon icon="material-symbols:close-rounded" width="18" height="18"></iconify-icon>
            </div>
        @endif
    @endforeach
    {{-- Job Position tags --}}
    @if(!empty($selectedFilters['job_position']))
        @php
            $jobPositionIds = is_array($selectedFilters['job_position']) ? $selectedFilters['job_position'] : [$selectedFilters['job_position']];
        @endphp
        @foreach($jobPositionIds as $jpId)
            @if(isset($jobPositions[$jpId]))
                <div class="tag">
                    {{ $jobPositions[$jpId] }}
                    <iconify-icon icon="material-symbols:close-rounded" width="18" height="18"></iconify-icon>
                </div>
            @endif
        @endforeach
    @endif
    {{-- Onboarding Status tag --}}
    @if(!empty($selectedFilters['onboarding_status']))
        <div class="tag">
            {{ is_array($selectedFilters['onboarding_status']) 
                ? implode(', ', $selectedFilters['onboarding_status']) 
                : $selectedFilters['onboarding_status'] }}
            <iconify-icon icon="material-symbols:close-rounded" width="18" height="18"></iconify-icon>
        </div>
    @endif
</div>