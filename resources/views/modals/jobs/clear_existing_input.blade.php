<style>

    .modal-body p, .modal-body ul {
margin-bottom: 24px;
    }

    .modal-body p, .modal-body li {
color: #071437;
    font-size: 14px;
    font-weight: 400;
    line-height: 22px;
    }

    .modal-body ul {
        padding-left: 15px;
    }
    .custom-bullet li {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-bullet .bullet {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        margin-right: 8px;
        background: #000;
    }

            .close-icon {
    position: absolute;
    right: 16px;
    top: 16px;
    color: #99A1B7;
    cursor: pointer;
}
</style>
<div class="modal-body text-center">
        <iconify-icon icon="ic:round-close" width="24" height="24" class="close-icon" data-bs-dismiss="modal"></iconify-icon>
    <iconify-icon icon="ep:warning" width="70" height="70" class="mb-2"
        style="color: #F8BB86;"></iconify-icon>
    <p class="fw-bolder fs-1 text-center w-75 m-auto" style="color: #071437;margin-bottom: 13px !important; line-height: normal;">
        Clear Existing Inputs?
    </p>
    <p class="text-center">
        You've entered details in the following sections:
    </p>
    <ul class="list-unstyled custom-bullet">
        <li><span class="bullet"></span>Superior Job Position</li>
        <li><span class="bullet"></span>Position Level</li>
        <li><span class="bullet"></span>Headcount Management</li>
    </ul>
    <p class="text-center">Since a <b>Top Position</b> does not require a <b>superior</b>, proceeding will <b>discard</b> the entered details. Please <b>reselect</b> an appropriate <b>Position Level</b> before continuing.</p>
    <div class="filter-content d-flex justify-content-center gap-2">
        <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-apply text-white" style="background: #F7941C;" data-modal-submit>
            Confirm
        </button>
    </div>
</div>