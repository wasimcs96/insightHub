<input type="hidden" name="hc_codes" id="hc_codes_input">
<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h3 class="card-title">
            Headcount Management (<span
                id="headcount-count">{{ count(old('headcounts', $job->headcounts->pluck('headcount_code')->toArray())) ?: 1 }}</span>)
        </h3>
    </div>

    <div class="card-body p-0" id="headcount-container">
        @php
            $hc_list = old(
                'headcounts',
                $job->headcounts
                    ->sortBy('headcount_code')
                    ->map(
                        fn($h) => [
                            'id' => $h->headcount_code,
                            'superior' => optional($h->parent)->headcount_code,
                            'children_count' => $h->children()->count() ?? 0,
                            'employee' => $h->user ? $h->user->name : 'Vacant',
                        ],
                    )
                    ->toArray(),
            );
            // dd($hc_list);
        @endphp

        <div class="table-responsive" style="border-radius: 8px; border: 1px solid #DBDFE9;">
            <table class="table align-middle mb-0" id="headcount-table">
                <thead style="background: #FFF;">
                    <tr>
                        <th>Headcount Number</th>
                        <th>
                            Headcount ID
                            <span>
                                <iconify-icon icon="weui:info-outlined" width="16" height="16"
                                    style="color: #5F6368; margin-bottom: -3px;" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="A unique, system-generated identifier assigned to each headcount within the organization."></iconify-icon>
                            </span>
                        </th>
                        <th>Employee</th>
                        <th style="width: 350px;">
                            Superior Headcount ID
                            <span>
                                <iconify-icon icon="weui:info-outlined" width="16" height="16"
                                    style="color: #5F6368; margin-bottom: -3px;" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title=" A unique system-generated identifier of a headcount’s direct superior."></iconify-icon>
                            </span>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody id="headcount-tbody">
                    @foreach ($hc_list as $i => $hc)
                        @php
                            $isButtonDisabled = $i === 0 || (isset($hc['children_count']) && $hc['children_count'] > 0) ? $hc['children_count']: 0;

                            if (count($hc_list) == 1) {
                                $isButtonDisabled = true;
                            }

                            if ($hc['employee'] != 'Vacant') {
                                $isButtonDisabled = true; // Disable button if employee is assigned
                            }
                        @endphp
                        <tr class="headcount-item" hcCode="{{ $hc['id'] }}" data-default="{{ $i === 0 ? 'true' : 'false' }}">
                            <td>
                                <span class="bg-white border-0 headcount-number">{{ $i + 1 }}</span>
                            </td>
                            <td>
                                <input type="text" class="bg-white border-0" name="headcounts[{{ $i }}][id]" value="{{ $hc['id'] }}" readonly>
                                <input type="hidden" class="bg-white border-0" name="headcounts[{{ $i }}][children_count]" value="0" readonly>
                            </td>
                            <td>
                                <input type="text" class="bg-white border-0" name="headcounts[{{ $i }}][employee]" value="{{ $hc['employee'] }}" readonly>
                            </td>
                            
                            <td style="width: 350px;">
                                <select class="form-select superior-hc-select"
                                    changedHeadcount="{{ $hc['id'] }}"
                                    name="headcounts[{{ $i }}][superior]"
                                    superiorCode="{{ $hc['superior'] }}" {{ $job->is_top == 1 ? 'disabled' : '' }}>
                                    <option value="">Select Superior</option>
                                    
                                    @foreach ($superiorHeadcounts ?? [] as $sup)
                                        @if ($sup->headcount_code !== $hc['id'])
                                            {{-- prevent self-selection --}}
                                            <option value="{{ $sup->headcount_code }}"
                                                {{ $sup->headcount_code == $hc['superior'] ? 'selected' : '' }}>
                                                {{ $sup->user ? $sup->user->name : 'Vacant' }} ({{ $sup->headcount_code }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="text-danger validation-message superiorValidationMessage" style="display: none;">
                                    Superior Headcount is required
                                </div>
                            </td>
                            <td>
                                <button type="button"
                                    class="btn btn-bg-white {{ $isButtonDisabled ? 'disabled-custom' : 'remove-headcount' }}"
                                    style="background-color: #fff !important; border-color: #fff !important;"
                                    @if($isButtonDisabled)
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-title="Delete allowed only if vacant, no subordinates, and multiple headcounts exist."
                                    @endif
                                >
                                    <iconify-icon icon="mi:delete" width="24" height="24" style="color: #F7941C;"></iconify-icon>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer border-0 pt-0">
        <button type="button" class="btn btn-primary" id="add-headcount-btn"
            {{ $job->is_top == 1 ? 'disabled' : '' }}>
            + Add Headcount
        </button>
    </div>
</div>

@push('scripts')
    <script>
        // ==================== Business Unit > Division > Department ====================
        const hcCodeArray = [];

        // ==================== Headcount Management Script ====================
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('headcount-container');
            const countBadge = document.getElementById('headcount-count');
            const superiorSelect = document.getElementById('superior');
            let superiorCodes = @json($superiorHeadcountCodes); // Initialize with backend data
            let superiorNames = @json($superiorNames); // Initialize with backend data
            let headcountIndex = container.querySelectorAll('.headcount-item').length || 1;
            console.log(headcountIndex, "========");

            let maxSequence = Math.max(
                0,
                ...Array.from(container.querySelectorAll('input[name$="[id]"]'))
                .map(input => {
                    const parts = input.value.split('-');
                    return parseInt(parts.at(-1)); // Extract the sequence number
                }).filter(n => !isNaN(n))
            ) + 1;

            const jobId = '{{ $job->id }}';
            const positionCode = "{{ strtoupper(preg_replace('/[^A-Z0-9]/', '', $job->position_code)) }}"; // Set the job's position code dynamically here.

            // Update superior headcount codes based on job selection
            $(superiorSelect).on('change', function() {
                const jobId = this.value;
                const selects = container.querySelectorAll('.superior-hc-select');
                if (!jobId) {
                    selects.forEach(s => {
                        s.innerHTML = '<option value="">Select Superior</option>';
                        s.disabled = true;
                    });
                    return;
                }
                $.getJSON(`/admin/ajax/job-headcounts/${jobId}`, data => {
                    const codes = data.headcount_codes || [];
                    const names = data.headcount_names || [];
                    superiorCodes = codes;
                    superiorNames = names;
                    selects.forEach(s => {
                        const current = s.value || s.getAttribute('superiorCode');
                        let html = '<option value="">Select Superior Headcount ID</option>';
                        codes.forEach(c => {
                            html +=
                                `<option value="${c}"${c === current ? ' selected' : ''}>${names[c] || 'Vacant'} (${c})</option>`;
                        });
                        s.innerHTML = html;
                        s.disabled = false;
                    });
                });
            });

            // Renumber headcount rows and fix input/select names
            function renumberHeadcounts() {
                const rows = container.querySelectorAll('.headcount-item');
                countBadge.textContent = rows.length;
                
                rows.forEach((row, idx) => {
                    row.querySelector('.headcount-number').textContent = idx + 1;
                    row.querySelectorAll('input, select').forEach(el => {
                        const suffix = el.name.replace(/^headcounts\[\d+\]/, '');
                        el.name = `headcounts[${idx}]${suffix}`;
                    });
                    
                    // Update delete button state based on conditions
                    const deleteBtn = row.querySelector('.remove-headcount, .disabled-custom');
                    const employeeInput = row.querySelector('input[name*="[employee]"]');
                    const isEmployeeAssigned = employeeInput && employeeInput.value !== 'Vacant';
                    const isOnlyRow = rows.length === 1;
                    
                    // Determine if button should be disabled - only when it's the last remaining row or employee is assigned
                    const shouldDisable = isEmployeeAssigned || isOnlyRow;
                    
                    if (deleteBtn) {
                        if (shouldDisable) {
                            deleteBtn.className = 'btn btn-bg-white disabled-custom';
                            deleteBtn.disabled = true;
                            
                            // Update tooltip message
                            let tooltipMessage = '';
                            if (isOnlyRow) {
                                tooltipMessage = 'Cannot delete the last remaining headcount. At least one headcount must exist.';
                            } else if (isEmployeeAssigned) {
                                tooltipMessage = 'Delete allowed only if vacant, no subordinates, and multiple headcounts exist.';
                            }
                            
                            deleteBtn.setAttribute('data-bs-title', tooltipMessage);
                        } else {
                            deleteBtn.className = 'btn btn-bg-white remove-headcount';
                            deleteBtn.disabled = false;
                            deleteBtn.setAttribute('data-bs-title', '');
                        }
                    }
                });
            }

            function getNextHeadcountCodeFromList(allCodes, referenceCode) {
                if (!Array.isArray(allCodes) || typeof referenceCode !== 'string') {
                    throw new Error("Invalid parameters");
                }

                const parts = referenceCode.split('-');
                if (parts.length !== 3) {
                    throw new Error("Reference code must follow the format PREFIX-ID-SEQ (e.g. RV-4891-03)");
                }

                const [prefix, jobId, initialSeqRaw] = parts;
                const base = `${prefix}-${jobId}-`;
                const initialSeq = parseInt(initialSeqRaw, 10);

                // Find all existing codes for this prefix-jobId
                const matchingCodes = allCodes.filter(code => code.startsWith(base));

                // Extract all sequence numbers and find max
                const seqs = matchingCodes.map(code => parseInt(code.split('-')[2], 10)).filter(n => !isNaN(n));
                const maxExisting = seqs.length > 0 ? Math.max(...seqs) : initialSeq - 1;

                const nextSeq = String(maxExisting + 1).padStart(2, '0');
                console.log(`Next sequence for ${referenceCode} is ${nextSeq}`);
                
                return `${prefix}-${jobId}-${nextSeq}`;
            }

            let abortController;
            var usedPositionCodes =[];

            // Add new headcount row
            document.getElementById('add-headcount-btn').addEventListener('click', async () => {

                if (abortController) {
                            abortController.abort();
                        }

                        abortController = new AbortController();

                var jobId="{{ $job->id }}";        
                const response = await fetch(`/admin/ajax/generate-headcounts-code-using-job?job_id=${jobId}`,{ signal: abortController.signal });
                            const data = await response.json();
                            console.log(data.headcount_codes);
                            

                            // let codes = Array.isArray(data.headcount_codes) ? data.headcount_codes : [];
                            // console.log(usedPositionCodes, codes);
                            const nextCode = await getNextHeadcountCodeFromList(usedPositionCodes, data.headcount_codes);


                const idx = headcountIndex++;
                const seq = (maxSequence++).toString().padStart(2, '0');
                const code = nextCode;
                usedPositionCodes.push(code);

                console.log(superiorNames);
                console.log(superiorCodes, "========");
                
                const rowHTML = `
                                    <tr class="headcount-item" hcCode="${code}" data-default="false">
                                        <td>
                                            <span class="bg-white border-0 headcount-number">${idx + 1}</span>
                                        </td>
                                        <td>
                                            <input type="text" class="bg-white border-0" name="headcounts[${idx}][id]" value="${code}" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="bg-white border-0" name="headcounts[${idx}][employee]" value="Vacant" readonly>
                                        </td>
                                        <td style="width: 350px;">
                                            <select class="form-select superior-hc-select" name="headcounts[${idx}][superior]">
                                                <option value="">Select Superior</option>
                                                ${superiorCodes.map(val => `<option value="${val}">${superiorNames[val] || 'Vacant'} (${val})</option>`).join('')}
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-bg-white remove-headcount" style="background-color: #fff !important; border-color: #fff !important;" aria-label="Delete Headcount">
                                            <iconify-icon icon="mi:delete" width="24" height="24" style="color: #F7941C;"></iconify-icon>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                document.getElementById('headcount-tbody').insertAdjacentHTML('beforeend', rowHTML);
                // updateHeadcountNumbers(); // Re-numbering if needed.
                renumberHeadcounts();

                toggleChange({
                    key: 'add_new_headcount',
                    title: "{{ $job->title }}",
                    detailHtml: `Add Headcount`,
                    description: `Add Headcount`,
                    old_value: '',
                    new_value: code,
                    job_title: "{{ $job->title }}",
                    structualChange: true
                });
                // loadDeleteFunction(); // Rebind delete buttons after adding new row
            });

            // function loadDeleteFunction() {
            //     document.querySelectorAll('.remove-headcount').forEach(btn => {
            //         btn.addEventListener('click', e => {

            //             const btn = e.target.closest('.remove-headcount');
            //                     if (!btn) return;
            //                     const row = btn.closest('.headcount-item');
            //                     const hcCode = row.getAttribute('hcCode');
            //             ModalManager.open({
            //                 module: 'jobs',
            //                 key: 'remove_headcount_confirmation',
            //                 data: {
            //                 "code": hcCode,
            //                 "job_title": "{{ $job->title }}"
            //                 },
            //                 onSubmit(modalEl) {
                                
            //                     if (hcCode) {
            //                         hcCodeArray.push(hcCode);
            //                     }
            //                     if (row.dataset.default === 'true') return;
            //                     row.remove();
            //                     renumberHeadcounts();
            //                     console.log(hcCodeArray, "========");
                                
            //                     document.getElementById('hc_codes_input').value = JSON.stringify(hcCodeArray);
            //                     toggleChange({
            //                         key: 'remove_headcount',
            //                         title: '{{ $job->title }}',
            //                         detailHtml: `Remove Headcount`,
            //                         description: `Remove Headcount`,
            //                         old_value: 'dddd',
            //                         new_value: 'ddddd',
            //                         job_title: "{{ $job->title }}",
            //                         structualChange: true
            //                     });
            //                     const modal = bootstrap.Modal.getInstance(modalEl);
            //                     if (modal) modal.hide();
            //                 },
            //                 onClose: (modal) => {
                               
            //                 }
            //             });
                        
                        

            //         })
            //     });
            // }

            // loadDeleteFunction();

            document.addEventListener('click', function (e) {
                const btn = e.target.closest('.remove-headcount');
                if (!btn) return; // Only proceed if the clicked element or its parent has the class

                // Check if button is disabled
                if (btn.disabled || btn.classList.contains('disabled-custom')) {
                    e.preventDefault();
                    return false;
                }

                const row = btn.closest('.headcount-item');
                const allRows = container.querySelectorAll('.headcount-item');
                
                // Additional check: prevent deletion if only one row remains
                if (allRows.length <= 1) {
                    e.preventDefault();
                    alert('Cannot delete the last remaining headcount. At least one headcount must exist.');
                    return false;
                }

                const hcCode = row.getAttribute('hcCode');

                ModalManager.open({
                    module: 'jobs',
                    key: 'remove_headcount_confirmation',
                    data: {
                        "code": hcCode,
                        "job_title": "{{ $job->title }}"
                    },
                    onSubmit(modalEl) {
                        console.log("======");
                        
                        if (hcCode) {
                            hcCodeArray.push(hcCode);
                        }
                        // if (row.dataset.default === 'true') return;
                        row.remove();
                        renumberHeadcounts();
                        console.log(hcCodeArray, "========");

                        document.getElementById('hc_codes_input').value = JSON.stringify(hcCodeArray);
                        console.log(hcCodeArray, "========3");
                        toggleChange({
                            key: 'remove_headcount',
                            title: '{{ $job->title }}',
                            detailHtml: `Remove Headcount`,
                            description: `Remove Headcount`,
                            old_value: 'dddd',
                            new_value: 'ddddd',
                            job_title: "{{ $job->title }}",
                            structualChange: true
                        });
                        console.log("======2");
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();
                    },
                    onClose: (modal) => {
                        // Nothing here for now
                    }
                });
            });

            

            // container.addEventListener('click', e => {

            //     var e = e || window.event;
            //     ModalManager.open({
            //                 module: 'jobs',
            //                 key:    'remove_headcount',
            //                 data: {
            //                             "old_value": '1',
            //                             "new_value": '0',

            // container.addEventListener('click', e => {

            //     var e = e || window.event;
            //     ModalManager.open({
            //                 module: 'jobs',
            //                 key:    'remove_headcount',
            //                 data: {
            //                             "old_value": '1',
            //                             "new_value": '0',
            //                             "job_title": "{{ $job->title }}",
            //                         },
            //                 onSubmit(modalEl) {
            //                     const btn = e.target.closest('.remove-headcount');
            //                     if (!btn) return;
            //                     const row = btn.closest('.headcount-item');
            //                     const hcCode = row.getAttribute('hcCode');
            //                     if (hcCode) {
            //                     hcCodeArray.push(hcCode);
            //                     }
            //                     if (row.dataset.default === 'true') return;
            //                     row.remove();
            //                     renumberHeadcounts();
            //                     const modal = bootstrap.Modal.getInstance(modalEl);
            //                     if (modal) modal.hide();
            //                     console.log(hcCodeArray, "========");
            //                     document.getElementById('hc_codes_input').value = JSON.stringify(hcCodeArray);

            //                 }
            //     });

            // });

            renumberHeadcounts();
            if (superiorSelect && !superiorSelect?.value) {
                container.querySelectorAll('.superior-hc-select').forEach(s => s.disabled = true);
            }

            let previousSuperiorValue = $('#superior').val(); // store initial value
            const previousSuperiorText = $('#superior option:selected').text()
            // ==================== Superior Job Position (Select2) ====================
            $(function() {
                const currentLevel = "{{ $job->level }}";
                const $superior = $('#superior');
                const currentJobId = "{{ $job->id }}";

                $superior.select2({
                    placeholder: 'Select Superior',
                    allowClear: true,
                    minimumInputLength: 1,
                    ajax: {
                        url: '/admin/ajax/get-superior-jobs',
                        dataType: 'json',
                        delay: 250,
                        data: params => ({
                            q: params.term,
                            level: currentLevel,
                            job_id: currentJobId
                        }),
                        processResults: data => ({
                            results: data
                        }),
                        cache: true
                    }
                });


            });

            $('.superior-hc-select').on('change', function() {

                var headCountId = '1';
                if ($(this).attr('changedHeadcount')) {
                    headCountId = $(this).attr('changedHeadcount');
                }
                
                const keyToFind = 'change_superior_confirmation';

                // Using `find()` to check if the key exists
                const result = pendingChanges.find(item => item.key === keyToFind);

                console.log(result,"===================");
                

                if (result) {
                    console.log('Key found:', result);  // If the key is found
                } else {
                    toggleChange({
                        key: 'change_superior_headcount',
                        title: job_position,
                        detailHtml: `Superior Headcount ID`,
                        description: `Superior Headcount ID`,
                        old_value: '0',
                        new_value: headCountId,
                        job_title: job_position,
                        structualChange: true
                    });
                }
                
                

            });



        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {

            window.IS_EDIT = true;
            window.IS_TOP = {{ $job->is_top ? 'true' : 'false' }};
            window.EDIT_JOB_ID = "{{ $job->id }}";
            window.EDIT_JOB_LEVEL = "{{ $job->level }}";
            window.EDIT_SUP_ID = "{{ old('superior', $job->superior_id) }}";

        })



        document.addEventListener('DOMContentLoaded', () => {
            let previousSuperiorValue = $('#superior').val(); // store initial value
            let previousSuperiorText = $('#superior option:selected').text()
            const isEdit = window.IS_EDIT;
            const isTopEdit = window.IS_TOP;
            const editLevel = Number(window.EDIT_JOB_LEVEL);
            const editSupId = window.EDIT_SUP_ID || null;

            const superiorSelect = document.getElementById('superior');
            const levelSelect = document.getElementById('level-job');

            /**
             * Fetch allowed levels for **edit** or **create**.
             */
            function fetchAllowedLevels(isTop = false, supId = null) {
                const params = {
                    job_id: isEdit ? window.EDIT_JOB_ID : '',
                    is_top: isTop,
                    superior_id: supId
                };

                $.getJSON('/admin/ajax/allowed-levels', params, levels => {
                    levelSelect.innerHTML = '<option value="">Select Position Level</option>';
                    levels.forEach(l => {
                        const sel = (l.value == String(editLevel)) ? ' selected' : '';
                        levelSelect.insertAdjacentHTML(
                            'beforeend',
                            `<option value="${l.value}"${sel}>${l.text}</option>`
                        );
                    });
                    levelSelect.disabled = levels.length === 0;
                });
            }

            function showSuperiorWarning(show = false) {
                    const superiorWarning = document.getElementById('superior-warning');
                    if (show) { // Replace 'condition' with your actual condition
                        superiorWarning.classList.remove('d-none'); // Show the warning
                        superiorWarning.classList.add('d-flex'); // Add flex class
                    } else {
                        superiorWarning.classList.add('d-none'); // Hide the warning
                        superiorWarning.classList.remove('d-flex'); // Remove flex class
                        
                    }
                }

            /**
             * Initialization logic:
             * - If editing a Top-job → ignore events, fetch levels ≥ current.
             * - Else if editing non-top → bind superior change and fetch for stored sup.
             * - Else (create) → bind both checkbox & superior.
             */
            if (isEdit && isTopEdit) {
                // Top-job edit: show only levels ≥ editLevel
                fetchAllowedLevels(true, null);
            } else if (isEdit) {
                // Non-top edit: watch superior select
                // superiorSelect.addEventListener('change', () => {
                //   fetchAllowedLevels(false, superiorSelect.value);
                // });

                $('#superior').on('select2:opening', function(e) {
                    // Save the current value *before* opening
                    previousSuperiorValue = $(this).val();
                });
                $('#superior')
                    .on('select2:select', function(e) {
                        e.preventDefault(); // prevent selection for now

                        console.log(e.params.data, 'selected data');
                        
                        const selectedElement = this;
                        const newSelectedValue = $(this).val();
                        let text1 = $('#superior option:selected').text()

                        ModalManager.open({
                            module: 'jobs',
                            key: 'change_superior',
                            data: {

                            },
                            onSubmit(modalEl) {
                                // finally let the form go through
                                $(selectedElement).val(newSelectedValue).trigger('change');
                                previousSuperiorValue = newSelectedValue; // update previous value
                                fetchAllowedLevels(false, newSelectedValue);
                                showSuperiorWarning(
                                    e.params.data.department_id != "{{ $job->department_id }}"
                                );
                                const bsModal = bootstrap.Modal.getInstance(modalEl);
                                if (bsModal) bsModal.hide();

                                
                                previousSuperiorText = previousSuperiorText.split(' (')[0];
                                text1 = text1.split(' (')[0];

                                toggleChange({
                                    key: 'change_superior_confirmation',
                                    title: "{{ $job->title }}",
                                    detailHtml: `Superior Job Position`,
                                    description: `Superior Job Position`,
                                    old_value: previousSuperiorText,
                                    new_value: text1,
                                    job_title: "{{ $job->title }}",
                                    structualChange: true
                                });
                            },
                            onClose: (modal) => {
                                $(selectedElement).val(previousSuperiorValue).trigger('change');
                            }
                        });

                    })
                    .on('select2:clear', function() {
                        // empty out the Superior‐Headcount dropdowns
                        fetchAllowedLevels(false, null);
                        showSuperiorWarning(false);
                    });

                // Initial load for stored superior
                fetchAllowedLevels(false, editSupId);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {


            // document.getElementById('job_profile').addEventListener('keyup', function(event) {
            //     var text1 = this.value.trim();
            //     toggleChange({
            //         key: 'job_position_title',
            //         title: 'Update Job Position Title?',
            //         detailHtml: `Job Position Title`,
            //         description: `Job Position Title`,
            //         old_value: "{{ $job->title }}",
            //         new_value: text1,
            //         job_title: "{{ $job->title }}",
            //         structualChange: false
            //     });
            // });
             window.addEventListener('DOMContentLoaded', function () {
                const jobTitleInput = document.getElementById('job_profile');
                if (jobTitleInput) {
                    originalState.title = jobTitleInput.value.trim() || '';
                }
            });

            document.getElementById('job_profile').addEventListener('keyup', function(event) {
                const newTitle = this.value.trim();

                // Always remove old 'job_position_title' entry
                pendingChanges = pendingChanges.filter(c => c.key !== 'job_position_title');

                // Do not log if newTitle is empty or same as original
                if (!newTitle || newTitle === originalState.title) {
                    console.log('Change cleared or reverted to original — no pending change.');
                    return;
                }

                // Log new change
                toggleChange({
                    key: 'job_position_title',
                    title: 'Update Job Position Title?',
                    detailHtml: `Job Position Title`,
                    description: `Job Position Title`,
                    old_value: originalState.title,
                    new_value: newTitle,
                    job_title: originalState.title, // fallback to original job title
                    structualChange: false
                });

                console.log('Pending Changes:', pendingChanges);
            });



            document.getElementById('is_critical_position').addEventListener('change', function(event) {

                console.log('Checkbox changed:', this.checked,"{{ $job->is_critical }}");

                // console.log('Checkbox value:', "{{ $job->title }}");
                var text1 = document.getElementById('job_profile').value.trim();
                
                if (this.checked) {
                    toggleChange({
                        key: 'is_critical_position',
                        title: "{{ $job->title }}",
                        detailHtml: `Critical Job Position`,
                        description: `Critical Job Position`,
                        old_value: "{{ $job->is_critical }}",
                        new_value: this.checked,
                        job_title: text1,
                        structualChange: false
                    });
                } else {
                    console.log('Checkbox is unchecked');
                }
            });



        })

    </script>
@endpush
