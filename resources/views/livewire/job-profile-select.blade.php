<div class="custom-dropdown-select mt-5" id="custom-dropdown-select">
    <label for="track" class="fw-semibold fs-6 mb-2">Job Position</label>
    <div class="custom-dropdown-select">
        <div class="dropdown">
            {{-- {{ dd($jobProfiles) }} --}}
            <div class="dropdown-btn form-select {{ empty($jobProfiles) ? 'disabled' : '' }}">
                <span class="selected-title" style="overflow-wrap: anywhere;">Select Job Position</span>
            </div>
            <div class="dropdown-list">
                <div class="dropdown-items-container">
                    <!-- Static Items go here -->
                    {{-- {{ dd($selectedJobProfile) }} --}}
                    @foreach ($jobProfiles as $profile)
                        <div class="dropdown-item {{ $profile->id == $selectedJobProfile ? 'active' : '' }}" selected="{{ $profile->id == $selectedJobProfile ? 'true' : '' }}" data-desc="{{ $profile->description }}" data-value="{{ $profile->id }}" data-name="{{ $profile->name ?? '' }}" data-islocalized="{{ $profile->job_exist ?? '' }}">
                            <span>{{ $profile->name ?? '' }}</span>
                            @if ($profile->status == 1)
                                <span class="pill approved">Approved</span>
                            @elseif($profile->status == 2)
                                <span class="pill pending">Pending</span>
                            {{-- @else
                                <span class="pill pending">Pending</span> --}}
                            @endif
                            @if ($profile->job_exist == 1)
                                <span class="pill localised">Localised</span>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="add-job-btn">
                    <button type="button" class="btn-add-job-profile" id=btn-add-job-profile>
                        <iconify-icon icon="ic:round-plus" width="16" height="16"></iconify-icon> Add Job
                        Position
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
