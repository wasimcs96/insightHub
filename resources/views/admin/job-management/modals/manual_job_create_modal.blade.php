<div class="modal fade" id="CreateJDManually" tabindex="-1"
    aria-labelledby="CreateJDManuallyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="custom-popup-body modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                <div class="text-center m-auto">
                   <iconify-icon icon="ep:warning" width="70" height="70" class="mb-2"
        style="color: #F8BB86;"></iconify-icon>
                    <h4 class="mb-0 modal-custom-heading">How would you like to create <br> your JD Manually?</h4>
                    <p class="para">Please choose one of the following methods:</p>
                    <form>
                        <div class="d-flex align-items-center justify-content-center gap-4 mb-5">
                            <label class="manually-radio w-100">
                                <input type="radio" name="jdOption" value="custom" id="customJD">
                                <div class="d-flex flex-column gap-3 manually-modal-inner">
                                    <p class="m-0 text-left fw-bold">Custom JD</p>
                                    <div class="line"></div>
                                    <p class="m-0 text-left">Start from a blank page and build
                                        the job description manually</p>
                                </div>
                            </label>
                            <label class="manually-radio w-100">
                                <input type="radio" name="jdOption" value="master" id="masterJD">
                                <div class="d-flex flex-column gap-3 manually-modal-inner">
                                    <p class="m-0 text-left fw-bold">Based on Master JD</p>
                                    <div class="line"></div>
                                    <p class="m-0 text-left">Use an existing job description as
                                        a template from Master JD</p>
                                </div>
                            </label>
                            <label class="manually-radio w-100">
                                <input type="radio" name="jdOption" value="company" id="companyJD">
                                <div class="d-flex flex-column gap-3 manually-modal-inner">
                                    <p class="m-0 text-left fw-bold">Based on Company JD</p>
                                    <div class="line"></div>
                                    <p class="m-0 text-left">Use an existing job description
                                        previously created by your organization</p>
                                </div>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="fs-6 grey-outline-popup flex-grow-0 px-14"
                    data-bs-dismiss="modal">Cancel</button>

                <button type="button" id="proceedBtn"
                    class="text-center fs-6 orange-fill-popup popup-proceed-button flex-grow-0 px-14" disabled>Proceed</button>
            </div>

        </div>
    </div>
</div>