<div class="modal fade" id="BulkUpload" tabindex="-1" aria-labelledby="BulkUploadLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 700px;">
        <div class="modal-content border-0 shadow-sm rounded-3">
            <form id="BulkUploadForm" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="BulkUploadLabel">Bulk Upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Step 1 -->
                    <div class="mb-4">
                        <p class="modal-step-text">Step 1: Download & Fill the Template</p>
                        <button type="button" class="custom-btn orange-fill m-auto mb-8 gap-2">
                            <iconify-icon icon="material-symbols:download-rounded" width="20"
                                height="20"></iconify-icon> Download Employee List Template
                        </button>
                    </div>

                    <!-- Step 2 -->
                    <div>
                        <p class="modal-step-text mb-2">Step 2: Upload your filled employee list template</p>
                        <p class="custom-text-muted" style="color: #2E2F38;">
                            Once you've added employee details, upload the completed file here.
                        </p>
                        <input type="file" id="fileInput" name="file" class="form-control" required>
                        <div id="fileError" class="invalid-feedback d-none">
                            <iconify-icon icon="fe:warning" width="12" height="12"></iconify-icon>
                            Upload failed. Please check the file and upload a new one.
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-end gap-2">
                    <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="submitBtn" class="custom-btn orange-fill" disabled>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>