
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-medium" id="EditJDPositionLabel">
                        Edit JD - <span id="jobTitle">{{ $title }}</span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-4" id="modalDescription">
                        Editing this job description, <strong>{{ $title }}</strong> will impact 
                        <strong> <span id="employeeCount">0</span> employee</strong> currently assigned to it. 
                        Any changes made will be reflected in their records and may affect role alignment, skill matching, and internal processes.<br><br>
                        Additionally, any subordinates under this role will also be affected. Any changes made will be 
                        reflected in their records and may affect role alignment, skill matching, and internal processes.<br><br>
                        Please review your edits carefully before proceeding.
                    </p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="understandCheckbox">
                        <label for="understandCheckbox">
                            I understand that modifying this JD will affect assigned employees.
                        </label>
                    </div>
                    <div class="d-flex justify-content-center align-items-center gap-4 mt-5">
                        <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                        {{-- <button id="confirmEditBtn" class="btn btn-apply text-white d-flex align-items-center gap-2"
                            style="background: #F7941C;" disabled>
                            Confirm & Proceed 
                            <span id="infoIconWrapper" style="cursor: pointer;">
                                <iconify-icon icon="material-symbols:info-outline-rounded" width="16" height="16"></iconify-icon>
                            </span>
                        </button> --}}

                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <button id="confirmEditBtn" class="btn btn-apply text-white d-flex align-items-center gap-2"
                                style="background: #F7941C;" disabled data-modal-submit>
                                Confirm & Proceed
                            </button>

                            <!-- Icon outside the disabled button -->
                            {{-- <span id="infoIconWrapper" style="cursor: pointer;" title="Please acknowledge the impact by checking the box above to proceed.">
                                <iconify-icon icon="material-symbols:info-outline-rounded" width="18" height="18"></iconify-icon>
                            </span> --}}
                        </div>

                        {{-- <div id="editTooltip" 
                            style="display:none; position:absolute; background:#fff3cd; border:1px solid #f5c2c7; padding:10px; border-radius:5px; color:#664d03; z-index:9999;">
                            Please acknowledge the impact by checking the box above to proceed.
                        </div> --}}


                    </div>
                </div>
   