<div class="employee-contract w-100">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-medium m-0">Email Template</h4>
        <a class="custom-button btn-apply d-flex align-items-center" href="{{ route('admin.talent-acquisition.template-settings.email-template.create') }}">
            <iconify-icon icon="qlementine-icons:plus-16" width="16" height="16"></iconify-icon> Create Email Template
        </a>
    </div>
    <div class="custom-table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Created on</th>
                        <th scope="col">Last Edited on</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emailTemplates as $template )
                    <tr>
                        <td>{{ $template->title }}</td>
                        <td>{{ $template->created_at->format('d M Y') }}</td>
                            <td>{{ $template->updated_at->format('d M Y') }}</td>
                        <td class="text-center"><button class="action-icon btn action-btn p-0 border-0 bg-transparent"
                                href="#" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                <iconify-icon icon="ph:dots-three-outline-vertical-bold" width="16"
                                    height="16"></iconify-icon>
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown p-3 text-left drop-content" data-kt-menu="true"
                                id="kt_menu_65e95fe68ac03" style="width: 180px;">
                                <div>
                                    <ul class="list-unstyled mb-0">
                                        {{-- <li data-bs-toggle="modal" data-bs-target="#CreateJobAdvertisement"><a
                                                href="admin.talent-acquisition.template-settings.email-template.edit"
                                                class="d-block p-4 text-dark text-decoration-none text-left">Edit</a>
                                        </li> --}}
                                        <li><a class="dropdown-item d-block p-4 text-dark text-decoration-none text-left" href="{{ route('admin.talent-acquisition.template-settings.email-template.edit', $template->id) }}">Edit</a></li>
                                        {{-- <li data-bs-toggle="modal" data-bs-target="#ReuseAdvertisement"><a
                                                href="#"
                                                class="d-block p-4 text-dark text-decoration-none text-left">Rename</a>
                                        </li> --}}
                                        {{-- <li><a class="d-block p-4 text-dark text-decoration-none text-left" href="#" data-bs-toggle="modal" data-bs-target="#DuplicateEmailTemplate" data-id="{{ $template->id }}">Duplicate</a></li> --}}
                                        <li><a class="d-block p-4 text-dark text-decoration-none text-left"  href="{{ route('admin.talent-acquisition.template-settings.email-template.duplicate', $template->id) }}">Duplicate</a></li>
                                        {{-- <li data-bs-toggle="modal" data-bs-target="#DeleteEmailTemplate"><a
                                                href="admin.talent-acquisition.template-settings.email-template.delete"
                                                class="d-block p-4 text-decoration-none text-left"
                                                style="color: #F24130;">Delete</a></li> --}}

                                        {{-- <li><a class="dropdown-item text-danger d-block p-4 text-decoration-none text-left" href="#" data-bs-toggle="modal" data-bs-target="#DeleteEmailTemplate" data-id="{{ $template->id }}">Delete</a></li> --}}
                                    </ul>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="DeleteEmailTemplate" tabindex="-1"
    aria-labelledby="DeleteEmailTemplateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0  pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                    style="
                float: right;
            "><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" d="M12 8.465L18.965 1.5l.177.177l.152.228a10.1 10.1 0 0 0 2.8 2.801l.23.153l.176.177L15.536 12l6.964 6.965l-.177.176l-.228.153a10.1 10.1 0 0 0-2.801 2.8l-.153.23l-.176.176L12 15.536L5.036 22.5l-.177-.177l-.153-.228a10.1 10.1 0 0 0-2.8-2.801l-.23-.153l-.176-.176L8.465 12L1.5 5.036l.177-.177l.229-.153a10.1 10.1 0 0 0 2.8-2.8l.153-.23l.177-.176z"></path></svg></button>
                <iconify-icon icon="ep:warning" width="70" height="70" class="my-3"
                    style="color: #FF6355;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">Are You Sure You Want to <br> Delete this Email Template?
                </p>
                <p class="text-center" style="color: #4B5675;">Deleting this email template is permanent and cannot <br> be undone. Are you sure you want to proceed?</p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">No, cancel</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                    <button class="btn btn-apply confirmDelete"
                        style="background: #F24130; color: #fff;">
                        Yes, delete it
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- /* ==========================
   Duplicate Modal (HTML)
   ========================== */ --}}
{{-- <div class="modal fade" id="DuplicateEmailTemplate" tabindex="-1" aria-labelledby="DuplicateEmailTemplateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0 pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="float: right;">
                    <iconify-icon icon="guidance:remove-x-cross" width="25" height="25"></iconify-icon>
                </button>
                <iconify-icon icon="ph:copy-bold" width="70" height="70" class="my-3" style="color: #4B5675;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">
                    Duplicate Email Template
                </p>
                <p class="text-center" style="color: #4B5675;">
                    Are you sure you want to create a duplicate of this email template?
                </p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">No, cancel</button>
                    <form id="duplicateEmailTemplateForm" method="POST" action="">
                        @csrf
                        <button class="btn btn-apply confirmDuplicate" type="submit" style="background: #F7941C; color: #fff;">
                            Yes, Duplicate it
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Delete Modal
        var deleteModal = document.getElementById("DeleteEmailTemplate");
        deleteModal.addEventListener("show.bs.modal", function (event) {
            var button = event.relatedTarget;
            var itemId = button.getAttribute("data-id");
            var form = document.getElementById("deleteForm");
            form.action = "/admin/talent-acquisition/template-settings/email-template/delete/" + itemId;
        });

        // Duplicate Modal
        //     var duplicateEmailTemplateModal = document.getElementById("DuplicateEmailTemplate");
        //     duplicateEmailTemplateModal.addEventListener("show.bs.modal", function (event) {
        //     var button = event.relatedTarget;
        //     var itemId = button.getAttribute("data-id");
        //     var form = document.getElementById("duplicateEmailTemplateForm");
        //     form.action = "/admin/talent-acquisition/template-settings/email-template/duplicate/" + itemId;
        // });
    });
</script>

@endsection