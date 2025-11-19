{{-- Job-Centric Assessment Filter Section --}}
<div class="filter-block" data-key="assessment" data-type="Assessment">
    <div class="mb-2">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fs-6 fw-medium filter-title">
                Job-Centric Assessment Filter
                <span class="filter-count text-muted">(0)</span>
            </h6>
            <button type="button" class="btn p-0 section-clear" aria-label="Clear assessment filters">
                <iconify-icon icon="material-symbols:clear" width="16" height="16"></iconify-icon>
            </button>
        </div>
    </div>

    {{-- Selected Assessment Filters (Tags) --}}
    <div class="selected-filters mb-3" data-tags="assessment" aria-live="polite">
        {{-- Dynamic filter tags will be inserted here by JavaScript --}}
    </div>

    {{-- Assessment Type Dropdown --}}
    <div class="mb-3">
        <label for="assessmentType" class="form-label small text-muted">Assessment Results Type</label>
        <select 
            id="assessmentType" 
            class="form-select form-select-sm" 
            data-dropdown="type"
            aria-label="Select Assessment Results Type"
        >
            <option value="">Select Assessment Results Type</option>
            {{-- Options will be populated by JavaScript --}}
        </select>
    </div>

    {{-- Results Level Dropdown --}}
    <div class="mb-3">
        <label for="resultsLevel" class="form-label small text-muted">Results Level</label>
        <select 
            id="resultsLevel" 
            class="form-select form-select-sm" 
            data-dropdown="level"
            aria-label="Select Results Level"
        >
            <option value="">Select Results Level</option>
            {{-- Options will be populated by JavaScript --}}
        </select>
    </div>

    {{-- Add Filter Button --}}
    <div class="d-grid">
        <button 
            type="button" 
            class="btn btn-primary btn-sm" 
            data-action="add-filter"
            disabled
            aria-label="Add assessment filter"
        >
            <iconify-icon icon="material-symbols:add" width="16" height="16" class="me-1"></iconify-icon>
            Add Filter
        </button>
    </div>

    {{-- Help Text --}}
    <div class="mt-2">
        <small class="text-muted">
            <iconify-icon icon="material-symbols:info-outline" width="14" height="14"></iconify-icon>
            Maximum 3 assessment filters allowed
        </small>
    </div>
</div>

<style>
.filter-tag {
    display: inline-flex;
    align-items: center;
    background-color: #e3f2fd;
    border: 1px solid #2196f3;
    border-radius: 16px;
    padding: 4px 8px;
    margin: 2px;
    font-size: 12px;
    color: #1565c0;
}

.filter-tag .tag-icon {
    margin-right: 4px;
    font-size: 10px;
}

.filter-tag .remove-tag {
    background: none;
    border: none;
    color: #1565c0;
    cursor: pointer;
    padding: 0;
    margin-left: 6px;
    font-size: 14px;
    font-weight: bold;
    line-height: 1;
}

.filter-tag .remove-tag:hover {
    color: #0d47a1;
}

.btn:disabled,
.btn.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
