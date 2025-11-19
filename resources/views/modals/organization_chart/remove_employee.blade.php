<div class="modal-body d-flex flex-column gap-3 p-4">
                        <div class="modal-content-p">
                            <p class="mb-2">Employee Information:</p>
                            <p class="m-0"><b>Employee Name: {{ $name }} </b></p>
                            <p class="m-0"><b>Job Position: {{ $title }} </b></p>
                            <p class="m-0"><b>Department: {{ $department }} </b></p>
                        </div>

                        <div class="form-group">
                            <label>Reason for Removal</label>
                            <input type="text" class="form-control" id="reasonForRemoveEmplyee" placeholder="Reason for Removal">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center border-0 pt-0">
                        <button type="button" class="cancel-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="orange-fill" data-modal-submit>Remove Employee</button>
                    </div>