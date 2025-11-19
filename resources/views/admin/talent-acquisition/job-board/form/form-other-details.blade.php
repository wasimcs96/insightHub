<style>
    .resume-accordion-body h4 {
        color: #071437;
        font-size: 12px;
        font-weight: 500;
        line-height: 20px;
    }
    .resume-accordion-body p {
        color: #78829D !important;
        font-size: 12px !important;
        font-weight: 500 !important;
        line-height: 20px !important;
    }
</style>

<div class="" id="other-details" aria-labelledby="other-details-tab" tabindex="0">
    <div class="top-content">
        <h3>Other Details</h3>
        <p>Provide additional job details, including company overview, compensation, and benefits, to complete
            your job advertisement.</p>
    </div>
    <form method="POST" action="{{ ($draftMode || $editMode) ? route('admin.talent-acquisition.job-board.update-job-other-details') : route('admin.talent-acquisition.job-board.create-job-other-details') }}" id="otherDetailsForm" onsubmit="submitForm(event)">
        <input type="hidden" name="jobOpeningId" id="jobOpeningId" value="{{ $jobOpeningId }}">
        <input type="hidden" name="application_document_id" value="{{ $applicationDocumentId ?? '' }}">
        <input type="hidden" name="selected_radio" id="selected_radio">
        <input type="hidden" name="selected_child_radio" id="selected_child_radio">
        @if (($draftMode || $editMode))
            <input type="hidden" name="jobOpeningId" value="{{ $jobOpeningId }}">
        @endif
        <input type="hidden" name="editMode" value="{{ $editMode ? 'true' : 'false' }}">
        <input type="hidden" name="draftMode" value="{{ $draftMode ? 'true' : 'false' }}">
        <div class="row g-3">
            <div class="col-md-12 mt-5">
                <label class="form-label">Company Overview <span class="optional">-optional</span></label>
                <select class="form-select" name="company_overview_id" style="max-width: 440px">
                    <option value="0">Select Company Overview</option>
                    @foreach ($companyOverviews as $overview)
                        @php
                            $description = strip_tags($overview->description);
                            // Ensure space after .!? if "Powered by" follows
                            $description = preg_replace('/([.!?])/i', '$1 $2', $description);
                        @endphp
                        <option value="{{ $overview->id }}" {{ ($draftMode || $editMode) && $jobOpeningData->company_overview_id == $overview->id ? 'selected' : '' }}>
                            {{ $overview->name ?? '' }} 
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mt-5">
                <label class="form-label">Compensation & Benefits <span class="optional">-optional</span></label>
                <select class="form-select" name="company_benefit_id">
                    <option value="0">Select Compensation & Benefits</option>
                    @foreach ($companyBenefits as $benefit)
                        @php
                            $description = strip_tags($benefit->description);
                            // Ensure space after .!? if "Powered by" follows
                            $description = preg_replace('/([.!?])/i', '$1 $2', $description);
                        @endphp
                        <option value="{{ $benefit->id }}" {{ ($draftMode || $editMode) && $jobOpeningData->company_benefit_id == $benefit->id ? 'selected' : '' }}>
                            {{ $benefit->name ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>
                {{-- Default Entry Row Start --}}
                    <div class="col-md-12 mt-5">
                        <label class="form-label">Application Document(s)</label>
                        <div class="resume-accordion-body">
                            <div class="mb-2 document-card position-relative">
                                {{-- <input type="hidden" name="document_name_default" value="Resume">
                                <input type="hidden" name="document_required_default" value="1">
                                <input type="hidden" name="file_types_default[]" value=".pdf">
                                <input type="hidden" name="file_types_default[]" value=".doc"> --}}
                                
                                <h4 class="mb-2">Document Name</h4>
                                <p class="mb-0">Resume</p>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Required for applicants to submit?</h4>
                                        <p class="mb-0">Yes</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-2">File Type</h4>
                                        <p class="mb-0">
                                            PDF (.pdf), Word Documents (.doc, .docx)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="resume-accordion-body">
                            <div class="mb-2 document-card position-relative">
                                
                                
                                <h4 class="mb-2">Document Name</h4>
                                <p class="mb-0">Cover letter</p>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Required for applicants to submit?</h4>
                                        <p class="mb-0">No</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-2">File Type</h4>
                                        <p class="mb-0">
                                            PDF (.pdf), Word Documents (.doc, .docx)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                {{-- Default Entry Row End --}}
                <div id="documentContainer">
                    <!-- Pre-fill with existing documents in edit mode, excluding Resume -->
                    @if (($draftMode || $editMode) && $jobApplicationDocument->isNotEmpty())
                        @foreach ($jobApplicationDocument->where('name', '!=', 'Resume') as $index => $document)
                        @php
                            $selectedTypes = collect(json_decode($document->type, true))->filter()->toArray();
                        @endphp
                            <div class="document-card position-relative" id="set{{ $index + 1 }}">
                                <span class="close-btn position-absolute top-0 end-0 p-2" style="cursor: pointer;" onclick="removeSet({{ $index + 1 }})">&times;</span>
                                <label class="form-label">Document Name</label>
                                <input type="text" name="document_name_{{ $index + 1 }}" class="form-control col-md-6" value="{{ $document->name }}" placeholder="Enter Document Name">
                                <div class="mt-3 d-flex gap-3 align-items-center">
                                    <input type="hidden" name="document_required_{{ $index + 1 }}" value="0">
                                    <input type="checkbox" name="document_required_{{ $index + 1 }}" value="1" {{ $document->is_required ? 'checked' : '' }}>
                                    <label class="form-label required-label">This document is required for applicants to submit</label>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <input class="h-auto parent" type="radio" name="parent_{{ $index + 1 }}" id="parent1_set{{ $index + 1 }}" value="website-link" {{ $document->type === 'website-link' ? 'checked' : '' }} onclick="handleRadioClick({{ $index + 1 }}, 'parent1')">
                                        <label class="form-label m-0">Website Link</label>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center mt-3">
                                        <input class="h-auto parent" type="radio" name="parent_{{ $index + 1 }}" id="parent2_set{{ $index + 1 }}" value="parent2" {{ $document->type !== 'website-link' ? 'checked' : '' }} onclick="handleRadioClick({{ $index + 1 }}, 'parent2')">
                                        <label class="form-label m-0">File Type</label>
                                    </div>
                                    <div class="mt-2 ms-3" id="childOptions_set{{ $index + 1 }}">
                                        <div class="d-flex gap-2 align-items-center mt-1">
                                          
                                            <input class="h-auto child" type="checkbox" name="child_{{ $index + 1 }}[]" id="child1_set{{ $index + 1 }}" value=".pdf" {{ in_array('.pdf', $selectedTypes) ? 'checked' : '' }}>
                                            <label class="form-label m-0">PDF (.pdf)</label>
                                        </div>
                                        <div class="d-flex gap-2 align-items-center mt-2">
                                            <input class="h-auto child" type="checkbox" name="child_{{ $index + 1 }}[]" id="child2_set{{ $index + 1 }}" value=".doc" {{ in_array('.doc', $selectedTypes) ? 'checked' : '' }}>
                                            <label class="form-label m-0">Word Documents (.doc, .docx)</label>
                                        </div>
                                        <div class="d-flex gap-2 align-items-center mt-2">
                                            <input class="h-auto child" type="checkbox" name="child_{{ $index + 1 }}[]" id="child3_set{{ $index + 1 }}" value=".png"  {{ in_array('.png', $selectedTypes) ? 'checked' : '' }}>
                                            <label class="form-label m-0">PNG (.png)</label>
                                        </div>
                                        <div class="d-flex gap-2 align-items-center mt-2">
                                            <input class="h-auto child" type="checkbox" name="child_{{ $index + 1 }}[]" id="child4_set{{ $index + 1 }}" value=".jpg" {{ in_array('.jpg', $selectedTypes) ? 'checked' : '' }}>
                                            <label class="form-label m-0">JPG (.jpg, .jpeg)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <button type="button" class="btn btn-outline d-flex gap-3 align-items-center" style="border-color: #F7941C; color:#F7941C;" onclick="addNewSet()">
                    <iconify-icon icon="ic:round-plus" width="24" height="24"></iconify-icon> Add Another Field
                </button>
            </div>
        </div>
        <div class="filter-content mt-6 display submit-button">
            <div class="d-flex justify-content-between">
                <div class="d-flex gap-2 ml-auto ">
                    @if($editMode)
                        <button class="btn btn-outline" type="button" onclick="cancelEdit()">Cancel</button>
                    @else
                        <button class="btn btn-outline" type="button" onclick="saveDraft('otherDetailsForm')">Save Draft</button>
                    @endif        
                    <button class="btn btn-apply d-flex align-items-center gap-2" type="submit">                        
                        {{ (request()->has('fromPrevious') && $editMode) ? 'Next: Hiring Workflow' : ($editMode ? 'Confirm Edit' : 'Next: Hiring Workflow') }}
                        <iconify-icon icon="tabler:arrow-right" width="16" height="16"></iconify-icon>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>