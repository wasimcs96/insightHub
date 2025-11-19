<div class="modal fade" tabindex="-1" id="contract-issue">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Select Contract Template</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <iconify-icon icon="radix-icons:cross-1" class="ki-cross fs-1"></iconify-icon>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.contract.template.select') }}" id="templateform" method="post">
                    @csrf
                    <input type="hidden" name="application_id" class="form-control bg-transparent"
                        id="offerLetterapplication_id" value="" required />

                    @php $templates = App\Models\ContractTemplate::get();@endphp

                    <div class="fv-row mb-8">
                        <label class="form-label mb-3">Select Contract Template</label>
                        <select class="form-control" name="template_id">
                            @foreach ($templates as $template)
                                <option value="{{ $template->id ?? '' }}">{{ $template->name ?? '' }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="description_error"></div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('templateform').submit();">Create Contract</button>
            </div>
        </div>
    </div>
</div>
{{--  Offer Template end --}}
