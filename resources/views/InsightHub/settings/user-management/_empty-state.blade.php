<div class="empty-state">
    <div class="settings-card">
        <div class="empty-icon mb-5">
            <iconify-icon icon="mage:file-2" width="20" height="20"></iconify-icon>
        </div>
        <h5 class="m-0">No {{ $type ?? 'Employee' }} Yet</h5>
        <p class="custom-text-muted mx-auto mb-5" style="max-width: 500px;">
            There are currently no {{ strtolower($type ?? 'employee') }}s in the system.
        </p>
        <div class="d-flex gap-5 align-items-center justify-content-center">
            <button class="custom-btn orange-fill" data-bs-toggle="modal" data-bs-target="#BulkUpload">
                <span class="me-2 d-flex align-items-center">
                    <iconify-icon icon="material-symbols:upload" width="20" height="20"></iconify-icon>
                </span> Bulk Upload
            </button>
            <p class="custom-text-muted m-0">or</p>
            <button class="custom-btn orange-outline">
                <span class="me-2 d-flex align-items-center">
                    <iconify-icon icon="ic:round-plus" width="20" height="20"></iconify-icon>
                </span> Add User
            </button>
        </div>
    </div>
</div>