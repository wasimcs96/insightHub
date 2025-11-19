<div class="modal-body">
    <div class="custom-popup-body text-center m-auto">
        <iconify-icon icon="jam:alert" width="70" height="70" style="color: #F8BB86;"></iconify-icon>
        <h4>Edit Technical Skill?</h4>
        <p>Choose how you'd like to apply the changes to this technical skill.</p>
        <form>
            <div class="d-flex align-items-center justify-content-center gap-4 mb-5">
                
                <label class="manually-radio w-100">
                    <input type="radio" name="jdOption" value="duplicate">
                    <div class="d-flex flex-column gap-3 manually-modal-inner">
                        <p class="m-0 text-left fw-bold" style="text-align: left;">Create New   </p>
                        <div class="line"></div>
                        <p class="m-0 text-left" style="text-align: left;">Customise and create as new company technical skill and  save it into the Company Technical Skills Library.

                        </p>
                    </div>
                </label>

                <label class="manually-radio w-100">
                    <input type="radio" name="jdOption" value="overwrite">
                    <div class="d-flex flex-column gap-3 manually-modal-inner">
                        <p class="m-0 text-left fw-bold" style="text-align: left;">Overwrite Localised
                            Technical
                            Skill</p>
                        <div class="line"></div>
                        <p class="m-0 text-left" style="text-align: left;">Replace the existing skill in the Company Technical Skill Library with the updated version. This will affect all <b>{{ $jobLevelCount ?? '' }} JDs</b> currently linked to it.</p>
                    </div>
                </label>
            </div>
        </form>
    </div>
    <div class="modal-footer justify-content-center p-0 border-0">
        <button type="button" class="fs-6 grey-outline-popup flex-grow-0 px-14"
            data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="text-center fs-6 disable-grey-popup orange-fill-popup flex-grow-0 px-14"data-modal-submit disabled
            id="disabledProceedBtn">Proceed</button>
    </div>
</div>


