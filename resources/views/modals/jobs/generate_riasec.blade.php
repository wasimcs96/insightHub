<style>
     /* Persist orange border after selection */
     label.manually-radio.selected {
        border: 2px solid #f7941d !important;
        box-shadow: 0 1px 3px rgba(7, 20, 55, 0.08) !important;
    }
    /* Two-column layout for options */
    #dynamic-riasec-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        align-items: stretch;
    }
    .manually-radio {
        cursor: pointer;
        border: 2px solid #e6edf5; /* keep constant width to avoid shift */
        border-radius: 10px;
        padding: 18px;
        transition: none; /* remove animation */
        background: #fff;
    }

    .manually-radio:hover {
        border-color: #f7941d;
        box-shadow: 0 1px 3px rgba(7, 20, 55, 0.08);
    }

    .manually-radio input[type="radio"] {
        display: none;
    }

    .manually-radio input[type="radio"]:checked + .manually-modal-inner {
        background: #fff;
    }

    .manually-radio input[type="radio"]:checked {
        background: #f7941d;
    }

    .manually-modal-inner {
        transition: none; /* remove animation */
    }

    .line {
        height: 1px;
        background: #eef2f7;
        margin: 12px 0;
    }

    .jd-badge {
            padding: 4px 12px;
            border-radius: 80px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            width: fit-content;
            min-width: 100px;
    }

    .master-jd-badge {
        background: #E3F7FF;
            color: #1877A0;
    }

    .enter-jr-badge {
        background: #e8f5e8;
        color: #2d5a2d;
    }

    .heading {
        font-size: 24px;
        font-weight: 700;
        color: #f7941d;
    }

    .sub-heading {
        font-size: 14px;
        font-weight: 600;
        color: #f7941d;
        margin-bottom: 4px;
    }

    .para {
        font-size: 12px;
        color: #666;
        line-height: 1.4;
    }

    .custom-btn {
        background: #f7941d;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .custom-btn:hover:not(:disabled) {
        background: #e8850a;
    }

    .custom-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    .modal-content-riasec {
        gap: 12px;
    }

    /* Placeholder card for not available section */
    .placeholder-card {
        position: relative;
        background: #eef2f7;
        border-radius: 12px;
        min-height: 360px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3b4757;
        font-weight: 700;
        font-size: 20px;
    }
    .placeholder-card .jd-badge {
        position: absolute;
        top: 12px;
        right: 12px;
    }
    .manually-radio.disabled { pointer-events: none; }
    .manually-radio.disabled:hover { box-shadow: none; border-color: #e6edf5; }

    /* Ensure label behaves as a card */
    .manually-radio { display: block; }

    /* Ensure rule specificity wins over base/hover styles */
    label.manually-radio.selected { border-color: #f7941d !important; }
</style>

<div class="modal-header bg-orange p-7" style="background: #F7941C;">
                    <h1 class="modal-title fs-5 fw-medium text-white" id="generateRIASECJRLabel">Generate RIASEC For Job Position</h1>
                    <button type="button" data-bs-dismiss="modal" class="border-0 close-color" aria-label="Close"><iconify-icon icon="material-symbols:close-rounded" width="24" height="24"><template shadowrootmode="open"><style data-style="data-style">:host{display:inline-block;vertical-align:0}span,svg{display:block}</style><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275t.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275z"></path></svg></template></iconify-icon></button>
                </div>

<div class="modal-body">
    <form>
        <div id="dynamic-riasec-options" class="d-flex align-items-stretch justify-content-center gap-4">
            <!-- Dynamic content will be populated here via JavaScript -->
        </div>
    </form>
</div>

<div class="modal-footer">
    <button 
        type="button" 
        id="proceedBtn"
        class="custom-btn border-0 h-auto orange-fill-popup popup-proceed-button flex-grow-0 px-14"
        style="flex: none;" 
        disabled
        data-modal-submit>
        Select this RIASEC
    </button>
</div>
