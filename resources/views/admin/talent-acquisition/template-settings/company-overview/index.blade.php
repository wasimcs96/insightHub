
<div class="employee-contract w-100">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-medium m-0">Company/Department Overview</h4>
        <a href="{{ route('admin.talent-acquisition.template-settings.company-overview.create') }}" class="custom-button btn-apply d-flex align-items-center">
            <iconify-icon icon="qlementine-icons:plus-16" width="16" height="16"></iconify-icon> Create Company/Department Overview
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
                    @foreach ($overviews as $overview)
                        <tr>
                            <td>{{ $overview->name }}</td>
                            <td>{{ $overview->created_at->format('d M Y') }}</td>
                            <td>{{ $overview->updated_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <button class="action-icon btn action-btn p-0 border-0 bg-transparent"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <iconify-icon icon="ph:dots-three-outline-vertical-bold" width="16" height="16"></iconify-icon>
                                </button>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.talent-acquisition.template-settings.company-overview.edit', $overview->id) }}">Edit</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#DuplicateCompanyOverview" data-id="{{ $overview->id }}">Duplicate</a></li>
                                    <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#DeleteCompanyOverview" data-id="{{ $overview->id }}">Delete</a></li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="DeleteCompanyOverview" tabindex="-1" aria-labelledby="DeleteCompanyOverviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0 pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="float: right;">
                    <!-- <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"> -->
                    
                    <iconify-icon icon="guidance:remove-x-cross" width="25" height="25"></iconify-icon>
                     
                </button>
                <iconify-icon icon="ep:warning" width="70" height="70" class="my-3" style="color: #FF6355;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">
                    Are You Sure You Want to Delete this Company/Department Overview?
                </p>
                <p class="text-center" style="color: #4B5675;">
                    Deleting this overview is permanent and cannot be undone. Are you sure you want to proceed?
                </p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">No, cancel</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-apply confirmDelete" style="background: #F24130; color: #fff;">
                            Yes, delete it
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DuplicateCompanyOverview" tabindex="-1" aria-labelledby="DuplicateCompanyOverviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0 pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="float: right;">
                    <!-- <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"> -->
                    <iconify-icon icon="guidance:remove-x-cross" width="25" height="25"></iconify-icon>
                </button>
                <iconify-icon icon="ph:copy-bold" width="70" height="70" class="my-3" style="color: #4B5675;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">
                    Duplicate Company/Department Overview
                </p>
                <p class="text-center" style="color: #4B5675;">
                    Are you sure you want to create a duplicate of this overview?
                </p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
               <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">No, cancel</button>
                    <form id="duplicateForm" method="POST" action="">
                        @csrf
                        <button class="btn btn-apply confirmDuplicate" type="submit" style="background: #F7941C; color: #fff;">
                            Yes, Duplicate it
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>


@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var deleteModal = document.getElementById("DeleteCompanyOverview");
        deleteModal.addEventListener("show.bs.modal", function (event) {
            var button = event.relatedTarget;
            var itemId = button.getAttribute("data-id");
            var form = document.getElementById("deleteForm");
            form.action = "/admin/talent-acquisition/template-settings/company-overview/delete/" + itemId;
        });

        // Duplicate Modal
        var duplicateModal = document.getElementById("DuplicateCompanyOverview");
        duplicateModal.addEventListener("show.bs.modal", function (event) {
            var button = event.relatedTarget;
            var itemId = button.getAttribute("data-id");
            var form = document.getElementById("duplicateForm");
            form.action = "/admin/talent-acquisition/template-settings/company-overview/duplicate/" + itemId;
        });
    });
</script>

@endsection
