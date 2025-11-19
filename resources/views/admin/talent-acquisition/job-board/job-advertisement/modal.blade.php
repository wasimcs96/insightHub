<div class="modal fade" id="ModifyApplicationDate" tabindex="-1" aria-labelledby="ModifyApplicationDateLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body pt-5">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="float: right;">
                    <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
                </button>
                <p class="fw-medium fs-4 text-center mt-5" style="color: #4B5675;">Modify the Application Period Dates<br /> for <span class="fw-bold" id="jobTitle"></span><br /> Advertisement:</p>
                <p class="m-0 text-center" style="color: #4B5675;">Adjust the start and Expiry Dates for accepting applications for the <span class="fw-bold" id="jobTitleDescription"></span> position</p>
                <div class="mt-4">
                    <div class="d-flex align-items-center gap-1">
                        <div class="input-group">
                            <input type="text" id="startDate" class="form-control date-input bg-white border-end-0" placeholder="Start Date">
                            <span class="input-group-text bg-white"><iconify-icon icon="uil:calender" width="16" height="16"></iconify-icon></span>
                        </div>
                        <span> - </span>
                        <div class="input-group">
                            <input type="text" id="endDate" class="form-control date-input bg-white border-end-0" placeholder="End Date">
                            <span class="input-group-text bg-white"><iconify-icon icon="uil:calender" width="16" height="16"></iconify-icon></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-apply" id="setApplicationPeriodBtn" style="background: #F24130;">Set Application Period</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="AddToExpiry" tabindex="-1" aria-labelledby="AddToExpiryLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0 pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="float: right;">
                    <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
                </button>
                <iconify-icon icon="ep:warning" width="70" height="70" class="my-5" style="color: #F8BB86;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">
                    Are You Sure You Want to Set the Advertisement to Expired?
                </p>
                <p class="m-0 text-center" style="color: #4B5675;">
                    The expiry date hasn’t passed yet. Changing the status for <span class="fw-bold" id="jobTitleToExpire"></span> position to 'Expired' means the public will no longer be able to view your job posting.
                </p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">No, cancel</button>
                    <button class="btn btn-apply" id="setToExpiredBtn">
                        Yes, set to ‘Expired’
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0 pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="
                float: right;
            ">
                    <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
                </button>
                <iconify-icon icon="ep:warning" width="70" height="70" class="my-5" style="color: #FF6355;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">
                    Are You Sure You Want to Delete this Advertisement?
                </p>
                <p class="text-center" style="color: #4B5675;">
                    Deleting the advertisement for <span class="fw-bold" id="jobTitleToDelete"></span> 
                    will not remove any hired employees. However:
                </p>
                <ul class="text-left">
                    <li>This job posting will be immediately removed from public view.</li>
                    <li>All associated records, details, and data will be permanently deleted.</li>
                    <li>Reports for this advertisement will no longer be available.</li>
                </ul>
                <p class="fw-bolder text-center m-0">Once deleted, this action cannot be undone.</p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-apply delete-confirm" style="background: #F24130;">
                        Permanently Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ExtendExpiryDate" tabindex="-1" aria-labelledby="ExtendExpiryDateLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body pt-0">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="float: right;">
                    <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
                </button>
                <p class="fw-medium fs-4 text-center mt-11" style="color: #4B5675;">Extend Expiry Date
                    <br /> for <span class="fw-bold" id="jobTitleToExtend"></span><br /> Advertisement:
                </p>
                <p class="m-0 text-center" style="color: #4B5675;">Adjust expiry Dates for accepting applications for
                    the <span class="fw-bold" id="jobTitleToExtendDesc"></span> position</p>
                <div class="mt-4">
                    <div class="d-flex align-items-center">
                        <div class="input-group m-auto" style="width: fit-content;">
                            <input type="text" id="endDateExpire" class="form-control date-input bg-white border-end-0" placeholder="End Date">
                            <span class="input-group-text bg-white endDateExpire"><iconify-icon icon="uil:calender" width="16" height="16"></iconify-icon></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-apply" id="extendExpiryBtn">
                        Set Expiry Date
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="LaunchAdvertisement" tabindex="-1" aria-labelledby="LaunchAdvertisementLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0 pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="float: right;">
                    <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
                </button>
                <iconify-icon icon="ep:warning" width="70" height="70" class="my-5 text-center" style="color: #F8BB86;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">
                    Are You Sure You Want to Launch this Advertisement Now?
                </p>
                <p class="m-0 text-center" style="color: #4B5675;">
                    This will immediately publish the advertisement of <span id="jobTitleToLaunch" class="fw-bold"></span> and make it visible to candidates.
                </p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">No, keep it</button>
                    <button class="btn btn-apply" id="launchJobBtn">
                        Yes, launch now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="DeleteDraftModal" tabindex="-1" aria-labelledby="DeleteDraftModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0  pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                        style="float: right;">
                    <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
                </button>
                <iconify-icon icon="ep:warning" width="70" height="70" class="my-5" style="color: #FF6355;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">Are You Sure You Want to Delete
                    this Draft?</p>
                <p class="text-center" style="color: #4B5675;">You are about to delete the draft advertisement for the
                    <span class="fw-bold" id="jobTitleToDelete"></span> position. This action is irreversible, and
                    all records will be permanently removed from the system.
                </p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-apply" style="background: #F24130;" id="deleteDraftBtn">Delete Draft</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ReuseJobAdvertisement" tabindex="-1" aria-labelledby="ReuseJobAdvertisementLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <input type="hidden" id="jobId" name="jobId">
    <input type="hidden" id="jobOpeningId" name="jobOpeningId">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <button type="button" class="p-0 border-0 bg-white ms-auto" data-bs-dismiss="modal" aria-label="Close"><img
                src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            <div class="modal-header py-6">
                <h1 class="modal-title text-center" id="ReuseJobAdvertisementLabel">Choose Application Period Dates for <b>Advance Crewing Supervisor</b> Advertisement:</h1>
            </div>
            <div class="modal-body pb-0 pt-3">
                <p class="m-0 text-center">Choose the start and Expiry Dates for accepting applications for the <b>Advance Crewing Supervisor</b> position</p>
                <div class="mt-4 px-5 py-3 rounded" style="background-color: #F1F1F4;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="date" id="startDateReuse" name="startDateReuse" class="form-control date-input bg-white border-end-0" required
                                value="{{ date('Y-m-d') }}"
                                min="{{ date('Y-m-d') }}">
                                <span class="input-group-text bg-white">
                                    <iconify-icon icon="uil:calender" width="16" height="16"></iconify-icon>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="date" id="endDateReuse" name="endDateReuse" class="form-control date-input bg-white border-end-0" required
                                    value="{{ date('Y-m-d', strtotime('+7 days')) }}"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                <span class="input-group-text bg-white">
                                    <iconify-icon icon="uil:calender" width="16" height="16"></iconify-icon>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-apply" id="reviewDetailsButton" onclick="handleReviewDetails()">
                        Review Details
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteDraftModal = document.getElementById('DeleteDraftModal');
        var jobIdToDelete;

        deleteDraftModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; 
            jobIdToDelete = button.getAttribute('data-job-id'); 
            var jobTitle = button.closest('tr').querySelector('td').innerText; 

            
            var modalTitle = deleteDraftModal.querySelector('#jobTitleToDelete');
            modalTitle.textContent = jobTitle;
        });

        document.getElementById('deleteDraftBtn').addEventListener('click', function() {
            if (jobIdToDelete) {
                fetch(`/admin/talent-acquisition/job-board/job-openings/${jobIdToDelete}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`job-row-${jobIdToDelete}`).remove();
                        var modal = bootstrap.Modal.getInstance(deleteDraftModal);
                        modal.hide();
                    } else {
                        alert('Failed to delete the job draft.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const today = new Date().toISOString().split('T')[0];

        const startDateReusePicker = flatpickr("#startDateReuse", {
            dateFormat: "Y-m-d",
            defaultDate: document.getElementById("startDateReuse").value || today, 
            minDate: today, 
            disableMobile: true, 
            onChange: function(selectedDates, dateStr) {
                const endDateReusePicker = flatpickr("#endDateReuse");
                endDateReusePicker.set("minDate", new Date(selectedDates[0].getTime() + 86400000)); 
            }
        });

        const endDateReusePicker = flatpickr("#endDateReuse", {
            dateFormat: "Y-m-d",
            defaultDate: document.getElementById("endDate").value || new Date(new Date().getTime() + 7 * 86400000).toISOString().split('T')[0], // Default to 7 days from today
            minDate: new Date(new Date().getTime() + 86400000).toISOString().split('T')[0], 
            disableMobile: true, 
        });
    });

    function handleReviewDetails() {
        const startDate = document.getElementById('startDateReuse').value;
        const endDate = document.getElementById('endDateReuse').value;
        const jobId = window.jobId;
        const jobOpeningId = window.jobOpeningId;

        fetch('/admin/talent-acquisition/job-board/reuse-advertisement', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            },
            body: JSON.stringify({
                jobId: jobId,
                jobOpeningId: jobOpeningId,
                startDate: startDate,
                endDate: endDate
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement?step=7&jobId=${jobId}&jobOpeningId=${data.newJobOpeningId}&reuse=true`;
            } else {
                alert('Failed to reuse advertisement');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please check the console for details.');
        });
    }
    
</script>