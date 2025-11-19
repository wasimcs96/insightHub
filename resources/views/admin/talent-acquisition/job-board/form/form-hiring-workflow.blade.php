<div class="" id="hiring-workflow" aria-labelledby="hiring-workflow-tab" tabindex="0">
    <div class="top-content">
        <h3>Hiring Workflow</h3>
        <p>Edit Job Advertisement</p>
    </div>
    <form method="POST" action="{{ ($draftMode || $editMode) ? route('admin.talent-acquisition.job-board.update-hiring-workflow') : route('admin.talent-acquisition.job-board.create-hiring-workflow') }}" id="hiringWorkflowForm" onsubmit="submitFormHiringWorkflow(event)">
        <input type="hidden" name="jobOpeningId" id="jobOpeningId" value="{{ $jobOpeningId }}">
        <input type="hidden" name="editMode" value="{{ $editMode ? 'true' : 'false' }}">
        <input type="hidden" name="jobId" id="jobId" value="{{ $jobsData->id }}">
        <input type="hidden" name="draftMode" value="{{ $draftMode ? 'true' : 'false' }}">
        <div class="row g-3">
            <div class="col-md-12" id="hiringWorkflow">
                <h5 class="mb-5">Suitability Rate</h5>
                <p class="mb-3" style="font-size: 12px; color: #4B5675;">Please select the criteria to calculate the suitability rate:</p>

                <div class="row">
                    <label class="col-3"><strong>Criteria</strong></label>
                    <label class="col"><strong>Weightage (%)</strong></label>
                </div>
                @foreach (config('helpers.suitability_criteria') as $key => $criteria)
                    @php
                        $criterion =($draftMode || $editMode) ? $suitabilityRate->where('criteria_name', $criteria)->first() : null;
                        $checked = ($draftMode || $editMode) && $criterion ? 'checked' : '';
                        $weightage =($draftMode || $editMode) && $criterion ? $criterion->weightage : 0;
                    @endphp
                    <div class="p-3 border rounded mb-2 d-flex align-items-center gap-3 input-grey" style="height: 61px;">
                        <input type="checkbox" name="criteria[{{ $key }}][checked]" {{ $checked }}>
                        <label class="form-check-label text-muted" style="width: 155px;">{{ $criteria }}</label>
                        <input type="number" name="criteria[{{ $key }}][weightage]" style="width: 90px;" value="{{ $weightage }}" min="0" max="100" {{ $checked ? '' : 'disabled' }}>
                    </div>
                @endforeach                            
            </div>
            <div class="d-flex workflow-bottom">
                <p class="font-bolder fs-6 m-0">Total</p>
                <div class="m-0" style="display: flex; align-items: center;">
                    <h5><span class="green" id="totalWeightage">0</span>/ 100%</h5>
                    <span id="weightageMessage" style="font-weight: bold; margin-left: 10px; color: red;"></span>
                </div>
            </div>
            <p class="red-bottom-text m-0 font-medium">Please ensure the total weightage adds up to exactly 100%</p>
        </div>
        <div class="filter-content mt-6 display submit-button">
            <div class="d-flex justify-content-between">
                <div class="d-flex gap-2 ml-auto ">
                    @if($editMode)
                        <button class="btn btn-outline" type="button" onclick="cancelEdit()">Cancel</button>
                    @else
                        <button class="btn btn-outline" type="button" onclick="saveDraft('hiringWorkflowForm')">Save Draft</button>
                    @endif
                    <button id="submitButton" class="btn btn-apply d-flex align-items-center gap-2" type="submit" disabled>
                        {{ (request()->has('fromPrevious') && $editMode) ? 'Next: Review Details' : ($editMode ? 'Confirm Edit' : 'Next: Review Details') }}
                        <iconify-icon icon="tabler:arrow-right" width="16" height="16"></iconify-icon>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>


<script>

    async function submitFormHiringWorkflow(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const totalWeightage = calculateTotalWeightage();

        if (totalWeightage !== 100) {
            if (totalWeightage > 100) {
                alert('The total weightage cannot exceed 100%');
            } else if (totalWeightage < 100) {
                alert('The total weightage must be 100%');
            }
            return; 
        }

        const data = {};
        formData.forEach((value, key) => {
            if (key.startsWith('criteria')) {
                const [criteriaKey, nestedKey] = key.match(/\[(.*?)\]/g).map(match => match.slice(1, -1));
                if (!data.criteria) data.criteria = {};
                if (!data.criteria[criteriaKey]) data.criteria[criteriaKey] = {};

                if (nestedKey === 'checked') {
                    data.criteria[criteriaKey][nestedKey] = value === 'on'; 
                } else if (nestedKey === 'weightage') {
                    data.criteria[criteriaKey][nestedKey] = parseInt(value, 10); 
                } else {
                    data.criteria[criteriaKey][nestedKey] = value;
                }
            } else {
                data[key] = value;
            }
        });

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: JSON.stringify(data), 
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json', 
                },
            });

            const responseData = await response.json();

            if (responseData.success) {
                if (responseData.jobOpeningId) {
                    const editMode = formData.get('editMode') === 'true';
                    const draftMode = formData.get('draftMode') === 'true';
                    const jobId = formData.get('jobId');

                    const currentUrl = new URL(window.location.href);
                    const searchParams = currentUrl.searchParams;

                    const hasEditTrue = searchParams.get('edit') === 'true';
                    const hadReuseTrue = searchParams.get('reuse') === 'true';
                    const hadCreatetrue = searchParams.get('create') === 'true';

                    if (hadReuseTrue){
                        window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement?step=7&jobId=${jobId}&jobOpeningId=${data.jobOpeningId}&reuse=true`;
                    } else if (draftMode || hadCreatetrue){
                        window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement?step=7&jobId=${jobId}&jobOpeningId=${data.jobOpeningId}&create=true`;
                    }
                    else if ((editMode)) {
                        window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement?step=7&jobId=${jobId}&jobOpeningId=${data.jobOpeningId}&edit=true`;
                    } else {
                        const urlParams = new URLSearchParams(window.location.search);
                        let currentStep = parseInt(urlParams.get('step'));
                        let jobId = parseInt(urlParams.get('jobId'));

                        if (isNaN(currentStep)) {
                            currentStep = 1;
                        }

                        const nextStep = currentStep + 1;
                        window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement?step=${nextStep}&jobId=${jobId}&jobOpeningId=${responseData.jobOpeningId}&create=true`;
                    }
                }
            } else {
                alert('Please fill in the required fields');
            }
        } catch (error) {
            alert('An error occurred while saving data.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#hiringWorkflow input[type="checkbox"]').forEach((checkbox) => {
            checkbox.addEventListener('change', function () {
                updateInputState(checkbox); 
            });
            // Initialize the state based on the fetched data
            updateInputState(checkbox);
        });

        document.querySelectorAll('#hiringWorkflow input[type="number"]').forEach(input => {
            input.addEventListener('input', function () {
                calculateTotalWeightage();
            });
        });

        calculateTotalWeightage();
    });

    function updateInputState(checkbox) {
        const parentDiv = checkbox.closest('div'); 
        const inputBox = parentDiv.querySelector('input[type="number"]'); 

        if (checkbox.checked) {
            parentDiv.classList.remove('input-grey');
            parentDiv.querySelector('label').classList.remove('text-muted');
            if (inputBox) {
                inputBox.style.display = 'block'; 
                inputBox.disabled = false; 
            }
        } else {
            parentDiv.classList.add('input-grey');
            parentDiv.querySelector('label').classList.add('text-muted');
            if (inputBox) {
                inputBox.style.display = 'none'; 
                inputBox.disabled = true;
            }
        }
        calculateTotalWeightage();
    }

    function calculateTotalWeightage() {
        const weightageInputs = document.querySelectorAll('input[type="number"][name^="criteria"]');
        let total = 0;

        weightageInputs.forEach(input => {
            if (!input.disabled && input.value) {
                total += parseInt(input.value, 10);
            }
        });

        const totalWeightageElement = document.getElementById('totalWeightage');
        totalWeightageElement.textContent = total;

        if (total > 100 || total < 100) {
            totalWeightageElement.classList.add('text-danger');
        } else {
            totalWeightageElement.classList.remove('text-danger');
        }

        const weightageMessage = document.getElementById('weightageMessage');
        if (total > 100) {
            weightageMessage.textContent = "Weightage total is more than 100%";
            weightageMessage.style.color = "red";
        } else if (total < 100) {
            weightageMessage.textContent = "Weightage total is less than 100%";
            weightageMessage.style.color = "red";
        } else {
            weightageMessage.textContent = ""; 
        }

        const submitButton = document.getElementById('submitButton');
        if (total === 100) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }

        return total; 
    }
    
</script>