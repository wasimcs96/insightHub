

<div class="custom-dropdown-select" id="custom-dropdown-select">
    <label for="track">Job Position</label>
<div class="custom-dropdown-select">
    <div class="dropdown">
        <div class="dropdown-btn form-select">
            <span class="selected-title">Select Job Position</span>
        </div>
        <div class="dropdown-list">
            <div class="dropdown-items-container">
                <!-- Static Items go here -->
                @if(isset($data))
                @foreach($data as $value)
                <div class="dropdown-item" data-value="{{ $value->id }}">
                    <span>{{ $value->name ?? '' }}</span>
                </div>
                @endforeach
                @endif

            </div>
            <div class="add-job-btn">
                <button type="button" class="btn-add-job-profile">
                    <iconify-icon icon="ic:round-plus" width="16" height="16"></iconify-icon> Add Job Position
                </button>
            </div>
        </div>
    </div>
</div>
  </div>