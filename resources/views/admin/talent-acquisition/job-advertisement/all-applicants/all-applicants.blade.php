<section class="bg-white w-100 applicants-main-div">
    <div class="d-flex justify-content-between" style="height: 40px;">
        <h4 class="m-0">All Applicants</h4>
       
        <button id="rejectCandidateBtn"  class="btn-reject-candidate gap-3 align-items-center disabled" disabled>
            <iconify-icon icon="solar:user-cross-broken" width="16" height="16"></iconify-icon>
            Reject Applicant
        </button>
        {{-- <button id="rejectCandidateBtn" class="btn-reject-candidate-selected gap-3 align-items-center" data-bs-toggle="modal" data-bs-target="#modal-reject">
            <iconify-icon icon="solar:user-cross-broken" width="16" height="16"></iconify-icon>
            Reject Candidate
        </button> --}}
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="input-group d-flex gap-5">
            <div class="px-4 h-2 search-container d-flex align-items-center">
                <span class="border-0 bg-transparent p-0 me-2 d-flex">
                    <iconify-icon icon="mingcute:search-line" width="16" height="16"
                        style="color: #99A1B7"></iconify-icon>
                </span>
                <input type="text" id="searchInput" class="border-0 shadow-none p-0" placeholder="Search Applicant">
            </div>
            <button class="border-0 filter-button" data-bs-toggle="offcanvas" data-bs-target="#filtersSidebar"
                aria-controls="offcanvasRight">
                <img src="{{ asset('/admin/media/svg/files/filter.svg') }}" alt="filter-icon" />
                Filters & Sort <span class="filterCount"></span>
            </button>
            <button class="border-0 field-setting" data-bs-toggle="offcanvas" data-bs-target="#fieldSetting"
                aria-controls="offcanvasRight">
                <iconify-icon icon="lucide:server" width="16" height="16"></iconify-icon>
                Field Setting
            </button>
        </div>
        <div class="tabs-div">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="applied-tab" data-bs-toggle="pill" data-bs-target="#applied"
                        type="button" role="tab" aria-controls="applied" aria-selected="true">Applied</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="withdraw-tab" data-bs-toggle="pill" data-bs-target="#withdraw"
                        type="button" role="tab" aria-controls="withdraw" aria-selected="false">Withdraw</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rejected-tab" data-bs-toggle="pill" data-bs-target="#rejected"
                        type="button" role="tab" aria-controls="rejected" aria-selected="false">Rejected</button>
                </li>
            </ul>
        </div>
    </div>

    <div class="d-flex align-items-center gap-4"><p class="m-0 fw-medium fs-6" id="candidate-count" style="color: #252F4A;">0 Applicant(s) found</p>
    </div>
    <div class="d-flex align-items-center gap-4">
        <button id="show-selected" class="btn btn-primary">Show Selected</button>
        <button id="show-all" class="btn btn-secondary">Show All Data</button>
        <p id="selected-count" class="m-0 fw-medium fs-6" style="color: #252F4A;">0 selected</p>
    </div>
    <div class="tab-content" id="pills-tabContent">
        
            @include('admin.talent-acquisition.job-advertisement.all-applicants.applied')
        
    </div>

</section>

<script>
    // Global selected rows array
    window.selectedRows = [];

    // Enable/disable Send and Reject buttons
    function updateActionButtons() {
        const sendBtn = $('#sendAssessmentLink');
        const rejectBtn1 = $('#rejectCandidateBtnHPApplied');
        const rejectBtn2 = $('#rejectCandidateBtn'); // From another file

        const buttons = [sendBtn, rejectBtn1, rejectBtn2];

        if (selectedRows.length > 0) {
            buttons.forEach(btn => {
                btn.prop('disabled', false).removeClass('disabled');
            });

            sendBtn.css({
                backgroundColor: '#F7941C',
                color: '#fff',
                border: 'none'
            });

            [rejectBtn1, rejectBtn2].forEach(btn => {
                btn.css({
                    border: '1px solid #F04438',
                    backgroundColor: '#fff',
                    color: '#F04438'
                });
            });
        } else {
            buttons.forEach(btn => {
                btn.prop('disabled', true).addClass('disabled').css({
                    backgroundColor: '',
                    color: '',
                    border: ''
                });
            });
        }
    }

    // Checkbox selection logic
    $(document).on('change', '.select-row, #select-all', function () {
        selectedRows = [];

        if ($(this).attr('id') === 'select-all') {
            const isChecked = $(this).prop('checked');
            $('.select-row').each(function () {
                $(this).prop('checked', isChecked);
                const rowId = $(this).data('id');
                if (isChecked && !selectedRows.includes(rowId)) {
                    selectedRows.push(rowId);
                }
            });
        } else {
            $('.select-row:checked').each(function () {
                const rowId = $(this).data('id');
                selectedRows.push(rowId);
            });
        }

        updateActionButtons();
    });

    // On page load, update button states
    $(document).ready(function () {
        updateActionButtons();
    });
</script>

