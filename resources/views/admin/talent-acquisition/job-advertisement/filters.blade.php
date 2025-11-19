<div class="offcanvas offcanvas-end field-setting-sidebar" tabindex="-1" id="filtersSidebar"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-medium d-flex gap-3 align-items-center" id="offcanvasRightLabel">
            Filters <span class="cursor-pointer" id="clearAllFilters1">Clear filters</span>
        </h5>
        <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="offcanvas" aria-label="Close">
            <img src="/admin/media/svg/shapes/cancel.svg" alt="cancel">
        </button>
    </div>
    <div class="offcanvas-body">
        <form id="filterForm">
            {{-- Selected Filters --}}
            <div class="filter-group">
                <h6 class="form-check-label fw-bold mb-7 fs-4 fw-bolder d-flex align-items-center justify-content-between">
                    Selected <span class="cursor-pointer" id="clearAllFilters2">Clear all</span>
                </h6>
                <div id="selectedFiltersContainer"></div>
            </div>

            <div class="line-grey"></div>

            {{-- Filters Loaded via AJAX --}}
            <div id="filtersContainer"></div>

            <div class="line-grey"></div>

            {{-- Apply Filters Button --}}
            <div class="filter-content d-flex justify-content-between gap-5">
                <button type="button" class="btn-outline fw-bold" id="clearAllFilters3">Clear All</button>
                <button type="button" class="btn-apply fw-bold" id="applyFilters" data-bs-dismiss="offcanvas" aria-label="Close">Apply Filters</button>
            </div>
        </form>
    </div>
</div>

{{-- Loading Indicator --}}
<div id="loading" style="display: none; text-align: center;">
    <p>Loading...</p>
</div>

{{-- Results Section --}}
<div id="resultContainer"></div>

