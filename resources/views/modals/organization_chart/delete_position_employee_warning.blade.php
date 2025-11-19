<div class="modal-header">
    <h1 class="modal-title fs-5" id="deletePositionNameLabel">Delete Position - {{ $title }}</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body d-flex flex-column gap-3 p-4">
    <div class="modal-content-p">
        <p class="mb-2">This job position, <b>{{ $title }}</b> cannot be deleted
            because it is currently assigned to 1 <b>employee(s)</b>. To proceed, you must first
            reassign or remove these employees from this position.</p>
        <p class="m-0">For assistance, please contact your administrator.</p>
    </div>
</div>
<div class="modal-footer justify-content-center border-0 pt-0">
    <button type="button" class="orange-fill" data-bs-dismiss="modal">Close</button>
</div>