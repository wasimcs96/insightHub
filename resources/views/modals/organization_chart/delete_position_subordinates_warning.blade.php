<div class="modal-header">
    <h1 class="modal-title fs-5" id="deletePositionheadCountLabel">Delete Position - {{ $title }}</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body d-flex flex-column gap-3 p-4">
    <div class="modal-content-p">
        <p class="mb-2">This job position, {{ $title }} cannot be deleted
            because it is the only available headcount for this role and has subordinates assigned
            to it.</p>
        <p class="mb-2">To maintain the organizational structure, this position must remain in
            the org chart.</p>
        <p class="m-0"> If you need assistance, please contact your administrator.</p>
    </div>
</div>
<div class="modal-footer justify-content-center border-0 pt-0">
    <button type="button" class="orange-fill" data-bs-dismiss="modal">Close</button>
</div>