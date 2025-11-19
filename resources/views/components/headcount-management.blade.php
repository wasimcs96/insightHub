<div class="card card-bordered shadow-sm mb-4" id="headcount-card">
    <div class="card-header">
        <h3 class="card-title">Headcount Management (<span id="headcount-count">1</span>)</h3>
    </div>

    <div class="card-body" id="headcount-container">
        {{-- Auto-generated Headcount Row --}}
        {{-- <div class="row headcount-item mb-3 align-items-center" data-index="0" data-default="true">
            <div class="col-lg-2">
                <label class="form-label">Headcount Number</label>
                <span class="form-control-plaintext">1</span>
            </div>
            <div class="col-lg-3">
                <label class="form-label">Headcount ID <span data-bs-toggle="tooltip" title="A unique, system-generated identifier assigned to each headcount within the organization.">
           <iconify-icon icon="weui:info-outlined" width="16" height="16" style="color: #5F6368; margin-bottom: -3px;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="A unique, system-generated identifier assigned to each headcount within the organization."></iconify-icon>
          </span></label>
                <input type="text" class="form-control" name="headcounts[0][id]" placeholder="Enter a position code."
                    required disabled />
            </div>
            <div class="col-lg-3">
                <label class="form-label">Employee</label>
                <input type="text" class="form-control" name="headcounts[0][employee]"
                    placeholder="Enter a position code." required disabled />
            </div>
            <div class="col-lg-3">
                <label class="form-label">Superior Headcount ID <span data-bs-toggle="tooltip" title="A unique system-generated identifier of a headcount’s direct superior.">
           <iconify-icon icon="weui:info-outlined" width="16" height="16" style="color: #5F6368; margin-bottom: -3px;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title=" A unique system-generated identifier of a headcount’s direct superior."></iconify-icon>
          </span></label>
                <input type="text" class="form-control" name="headcounts[0][superior]"
                    placeholder="Enter a position code." required disabled />
            </div>
            <div class="col-lg-1 d-flex align-items-end justify-content-end">
                <button type="button" class="btn remove-headcount bg-white" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Auto-generated headcount. Remove the JD to delete it." disabled>
                    <iconify-icon icon="mi:delete" width="24" height="24" style="color: #F7941C"></iconify-icon>
                </button>
            </div>
        </div> --}}
    </div>

    <div class="card-footer pt-2">
        <button type="button" class="btn btn-primary" id="add-headcount-btn">
            + Add Headcount
        </button>
    </div>
</div>


@push('scripts')
<script>
        $(document).ready(function() {

            var superiorHeadcounts = [];
            var superiorHeadcountNames = [];


            function updateSuperiorSelects(previousSelection = []) {

                    previousSelection = previousSelection || [];

                    if (previousSelection.length > 0) {
                        document.querySelectorAll('.headcount-item').forEach((row, idx) => {
                            const sel = row.querySelector('select[name="headcounts['+idx+'][superior]"]');
                            if (!sel) return;
                            const prev = previousSelection[idx] ?? '';
                            let html = '<option value="">Select Superior Headcount ID</option>';
                            superiorHeadcounts.forEach(code => {
                            if (code !== codes[idx]) {
                                html += `<option value="${code}" ${previousSelection[idx] == code ? 'selected':''}>${superiorHeadcountNames[code]} (${code})</option>`;
                            }
                            });
                            sel.innerHTML = html;
                            if (superiorHeadcounts.includes(prev)) sel.value = prev;
                        });
                    } else {
                    
                        document.querySelectorAll('.headcount-item').forEach((row, idx) => {
                            const sel = row.querySelector('select[name="headcounts['+idx+'][superior]"]');
                            if (!sel) return;
                            const prev = sel.value;
                            let html = '<option value="">Select Superior Headcount ID</option>';
                            superiorHeadcounts.forEach(code => {
                            if (code !== codes[idx]) {
                                html += `<option value="${code}">${superiorHeadcountNames[code]} (${code})</option>`;
                            }
                            });
                            sel.innerHTML = html;
                            if (superiorHeadcounts.includes(prev)) sel.value = prev;
                        });
                        
                    }
                    
            }

        

        

            $(document).ready(function () {

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

                let codes = [];

                // … your debounce + AJAX code to populate `codes` …

                // ←―――――――――――――――――――――――――――――――――→
                // Insert the missing function here:
                

                function initSuperiorSelect(level) {
                    $('#superior').select2({
                        placeholder: 'Select Superior Job Position',
                        minimumInputLength: 1,
                        allowClear: true,
                        ajax: {
                            url: '/admin/ajax/get-superior-jobs',
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term      // search text
                                    // level: level         // selected level value
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: data
                                };
                            },
                            cache: true
                        }
                    });
                }

                $('#superior')
                .on('select2:select', function(e) {
                    const jobId = e.params.data.id;
                    loadSuperiorHeadcounts(jobId);
                    loadAllowedLevels();
                    
                    
                    showSuperiorWarning(
                        e.params.data.department_id != "{{ $cachedData['job_family'] }}"
                    );                    
                })
                .on('select2:clear', function() {
                    // empty out the Superior‐Headcount dropdowns
                    superiorHeadcounts = [];
                    updateSuperiorSelects();
                    showSuperiorWarning(false);
                });

                // 3) Your AJAX loader from earlier:
                function loadSuperiorHeadcounts(jobId) {
                    showOverlay();
                    fetch(`/admin/ajax/job-headcounts/${jobId}`)
                        .then(r => r.json())
                        .then(json => {
                            superiorHeadcounts = Array.isArray(json.headcount_codes)
                                ? json.headcount_codes
                                : [];
                            superiorHeadcountNames = json.headcount_names;

                            updateSuperiorSelects(); 
                            console.log(superiorHeadcounts, 'superiorHeadcounts');
                            console.log(superiorHeadcountNames, json.headcount_names);
                            hideOverlay();
                        })
                        .catch(console.error);
                }


                function loadAllowedLevels() {

                    console.log('loadAllowedLevels');
                    
                    const superiorSelect  = $('#superior');
                    const isTopCheckbox   = $('#is_top_position');
                    const levelSelect     = $('#level-job');

                    const data = {
                    is_top:     isTopCheckbox.prop('checked'),
                    superior_id: superiorSelect.val()
                    };

                    $.getJSON('/admin/ajax/allowed-levels', data, levels => {
                    levelSelect
                        .empty()
                        .append('<option value="">Select Position Level</option>')
                        .prop('disabled', levels.length === 0);

                    levels.forEach(l => {
                        levelSelect.append(`<option value="${l.value}">${l.text}</option>`);
                    });
                    
                    // Re-apply previous selection if any:
                    const old = levelSelect.data('old') || '';
                    if (old) levelSelect.val(old);
                    });
                }



                // Example: initialize based on a default level or dropdown
                let currentLevel = $('#level-job').val() || 1;
                initSuperiorSelect(currentLevel);

                // Optional: reinitialize when level changes
                $('#level-job').on('change', function () {
                    currentLevel = $(this).val();
                    // $('#superior').val(null).trigger('change');     // Clear previous selection
                    // $('#superior').select2('destroy');              // Destroy current
                    // initSuperiorSelect(currentLevel);                 // Reinit with new level
                });

                // document.addEventListener('DOMContentLoaded', function () {
                    const topPositionCheckbox = document.getElementById('is_top_position');
                    const $superiorSelect = $('#superior');

                    function toggleSuperiorField() {
                        const isDisabled = topPositionCheckbox?.checked;

                        if (isDisabled) {
                            $('#is_top_position').prop('checked', false);
                            $('#is_top_position').trigger('change');
                            // showModalDynamic('set_top_position');
                            ModalManager.open({
                                module: 'jobs',
                                key: "{{ $isTopExists == true ? 'set_top_position_existing' : 'set_top_position' }}",
                                data: { job_id: 4870,
                                    job_title: "{{ $isTopExists == true ? $topJobTitle : '-' }}",
                                    level: 1,
                                    superior: 0,
                                    is_top_position: "1",
                                    type:"{{ $isTopExists == false ? 1 : 0 }}"
                                },
                                onSubmit(modalEl) {
                                    // handle submission logic here
                                    // const form = modalEl.querySelector('form');
                                    // if (form) form.submit(); // or AJAX post
                                    const bsModal = bootstrap.Modal.getInstance(modalEl);
                                            if (bsModal) bsModal.hide();

                                    ModalManager.open({
                                        module: 'jobs',
                                        key: "clear_existing_input",
                                        data: { job_id: 4870,
                                            job_title: "{{ $isTopExists == true ? $topJobTitle : '-' }}",
                                            level: 1,
                                            superior: 0,
                                            is_top_position: "1",
                                            type:"{{ $isTopExists == false ? 1 : 0 }}"
                                        },
                                        onSubmit(modalEl1) {

                                            showOverlay();
                                            $('#is_top_position').prop('checked', true);
                                            $('#is_top_position').trigger('change');
                                            const bsModal = bootstrap.Modal.getInstance(modalEl1);
                                            if (bsModal) bsModal.hide();
                                            if ($superiorSelect.hasClass("select2-hidden-accessible")) {
                                                $superiorSelect.select2('destroy');
                                                $superiorSelect.val(null).trigger('change'); // Clear previous selection
                                                renderHeadcountRows();
                                            }

                                            // Enable/disable the native select
                                            $superiorSelect.prop('disabled', isDisabled);

                                            // Set required only if not disabled
                                            $superiorSelect.prop('required', !isDisabled);

                                            // Reinitialize Select2
                                            initSuperiorSelect(currentLevel);

                                            loadAllowedLevels();

                                            setTimeout(() => {
                                                hideOverlay();
                                            }, 1000);
                                            

                                        }    
                                    })
                                },
                                onShown(modalEl) {
                                    const checkbox = modalEl.querySelector('.modal-body input[type="checkbox"]');
                                    const confirmBtn = modalEl.querySelector('[data-modal-submit]');

                                    // Ensure button starts disabled
                                    confirmBtn.disabled = true;

                                    // Toggle enable/disable on checkbox change
                                    checkbox.addEventListener('change', () => {
                                        confirmBtn.disabled = !checkbox.checked;
                                    });
                                    
                                }
                            });
                            

                        }else{
                            if ($superiorSelect.hasClass("select2-hidden-accessible")) {
                                $superiorSelect.select2('destroy');
                                $superiorSelect.val(null).trigger('change'); // Clear previous selection
                            }

                            // Enable/disable the native select
                            $superiorSelect.prop('disabled', isDisabled);

                            // Set required only if not disabled
                            $superiorSelect.prop('required', !isDisabled);

                            // Reinitialize Select2
                            initSuperiorSelect(currentLevel);

                            renderHeadcountRows();
                            loadAllowedLevels();

                        }
                        
                        // Destroy existing Select2
                    }

                    // Initial check on page load
                    toggleSuperiorField();

                    // Rebind when checkbox changes
                    topPositionCheckbox?.addEventListener('change', toggleSuperiorField);

                // });
            });





            // Your existing codes[] array
            let codes = [];
        
            // AbortController & debounce for position_code AJAX
            let debounceTimer, abortController = new AbortController();
            const debounceDelay = 400;
        
            // Shortcut to grab elements
            const positionInput    = document.getElementById('job_profile_id');
            const draftIdInput     = document.getElementById('job_draft_id');
            const addBtn           = document.getElementById('add-headcount-btn');
            var topToggle        = document.getElementById('is_top_position');
            const container        = document.getElementById('headcount-container');
            const countBadge       = document.getElementById('headcount-count');
            const jobProfileInput = document.getElementById('job_profile_id'); // Using the fixed input id


            const jobProfileId = jobProfileInput.value.trim();
                const jobDraftId = draftIdInput.value;
                if (jobProfileId) {
                    fetchHeadcountCodes(jobProfileId, jobDraftId);
                }

                // Fetch Headcount Codes based on job_profile_id and job_draft_id
                function fetchHeadcountCodes(jobProfileId, jobDraftId) {
                    showOverlay();

                    fetch(
                        `/admin/ajax/generate-headcounts-code?job_profile_id=${encodeURIComponent(jobProfileId)}&job_draft_id=${encodeURIComponent(jobDraftId)}`,
                        { signal: abortController.signal }
                    )
                    .then(r => r.json())
                    .then(data => {
                        if (Array.isArray(data.headcount_codes)) {
                            codes = data.headcount_codes;
                        } else {
                            codes = [];
                        }
                        if (data.job_draft_id) draftIdInput.value = data.job_draft_id;
                        renderHeadcountRows();
                        hideOverlay();
                    })
                    .catch(err => {
                        if (err.name !== 'AbortError') console.error(err);
                    });
                }

        
            // Whenever the “top position” toggle changes, re-render
            topToggle?.addEventListener('change', () => {
            // disable/enable the add button
            addBtn.disabled = topToggle.checked;
            // re-render rows (will clamp to 1 and show static superior)
            // renderHeadcountRows();
            });
        
            // Debounced AJAX on position_code input
            positionInput.addEventListener('input', function () {
                showOverlay();
                const positionCode = this.value.trim();
                const jobDraftId   = draftIdInput.value;
            
                clearTimeout(debounceTimer);
                abortController.abort();
                abortController = new AbortController();
            
                debounceTimer = setTimeout(() => {
                    if (!positionCode) {
                    codes = [];
                    renderHeadcountRows();
                    return;
                    }
            
                    fetch(
                    `/admin/ajax/generate-headcounts-code`
                        + `?position_code=${encodeURIComponent(positionCode)}`
                        + `&job_draft_id=${encodeURIComponent(jobDraftId)}`,
                    { signal: abortController.signal }
                    )
                    .then(r => r.json())
                    .then(data => {
                        if (Array.isArray(data.headcount_codes)) {
                            codes = data.headcount_codes;
                        } else {
                            codes = [];
                        }
                        // keep the draft id up to date
                        if (data.job_draft_id) draftIdInput.value = data.job_draft_id;
                        renderHeadcountRows();
                        hideOverlay();
                    })
                    .catch(err => {
                    if (err.name !== 'AbortError') console.error(err);
                    });
                }, debounceDelay);
                
            });
        
            // Add‐headcount button
            addBtn.addEventListener('click', () => {
                if (!codes.length) {
                    alert("Please enter a Position Code first.");
                    return;
                }
                // never allow extra rows in top mode
                if (topToggle.checked) return;
            
                // Compute next sequence from last code
                const last = codes[codes.length - 1];
                const parts = last.split('-');
                let seq = parseInt(parts.pop(), 10) + 1;
                seq = String(seq).padStart(2, '0');
                const nextCode = [...parts, seq].join('-');
            
                codes.push(nextCode);
                renderHeadcountRows();
            });
        
            // Delegate remove‐row clicks
            document.addEventListener('click', e => {
                const btn = e.target.closest('.remove-headcount');
                if (!btn) return;
                const row = btn.closest('.headcount-item');
                if (row.dataset.default === "true") {
                    alert("This row cannot be removed. Delete the JD to remove it.");
                    return;
                }
                // remove from codes[]
                const idx = [...document.querySelectorAll('.headcount-item')].indexOf(row);
                codes.splice(idx, 1);
                row.remove();
                renderHeadcountRows();
            });
        
            function generateSuperiorOptions(selectedValue) {
                if (!Array.isArray(superiorHeadcounts)) return '';

                return superiorHeadcounts.map(option => {
                    const selected = option.id === selectedValue ? 'selected' : '';
                    return `<option value="${option.id}" ${selected}>${option.id}</option>`;
                }).join('');
            }

            // Render function
            function renderHeadcountRows() {
                console.log(superiorHeadcounts, 'superiorHeadcounts');
                    
                const isTop = topToggle?.checked;
                const previousSelections = [];
                const existingRows = container.querySelectorAll('.headcount-item');
                existingRows.forEach((row, idx) => {
                    const select = row.querySelector('select[name^="headcounts"]');
                    if (select) previousSelections[idx] = select.value;
                });

                console.log('previousSelections', previousSelections);
                console.log('codes',codes);
                
                



                container.innerHTML = `
  <div class="table-responsive" style="border-radius: 8px; border: 1px solid #DBDFE9;">
    <table class="table align-middle mb-0" id="headcount-table">
      <thead style="background: #FFF;">
        <tr>
          <th>Headcount Number</th>
          <th>
            Headcount ID
            <span data-bs-toggle="tooltip"
                data-bs-placement="top"
                data-bs-title="A unique, system-generated identifier assigned to each headcount within the organization.">
              <iconify-icon icon="weui:info-outlined"
                width="16"
                height="16"
                style="color: #5F6368; margin-bottom: -3px;">
              </iconify-icon>
            </span>
          </th>
          <th>Employee</th>
          <th style="width: 350px;">
            Superior Headcount ID
            <span data-bs-toggle="tooltip"
                data-bs-placement="top"
                data-bs-title="A unique system-generated identifier of a headcount’s direct superior.">
              <iconify-icon icon="weui:info-outlined"
                width="16"
                height="16"
                style="color: #F7941C; background-color: #fff !important; border-color: #fff !important; margin-bottom: -3px;"
                >
              </iconify-icon>
            </span>
          </th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="headcount-tbody"></tbody>
    </table>
  </div>
`;

const tooltipTriggers = container.querySelectorAll('[data-bs-toggle="tooltip"]');
tooltipTriggers.forEach(el => new bootstrap.Tooltip(el));



            
                // clamp to 1 row if top, otherwise at least 1 or codes.length
                const count = isTop ? 1 : Math.max(codes.length, 1);
            
                for (let i = 0; i < count; i++) {
                    const code   = codes[i] || 'Please enter a Position Code first.';
                    const isFirst= (i === 0);
            
                    document.querySelector('#headcount-tbody').insertAdjacentHTML('beforeend', `
  <tr class="headcount-item" data-default="${isFirst}" data-index="${i}">
      <td>
          <span class="form-control-plaintext headcount-number">${i + 1}</span>
      </td>
      <td>
          <input type="text" class="bg-white border-0" name="headcounts[${i}][id]" value="${code}" readonly />
      </td>
      <td>
          <input type="text" class="bg-white border-0" name="headcounts[${i}][employee]" value="Vacant" readonly />
      </td>
      <td>
          ${
            isTop
              ? `<span class="form-control-plaintext">This role is at the top of the org chart.</span>`
              : `<select class="form-select" name="headcounts[${i}][superior]" required>
                    <option value="">Select Superior Headcount ID</option>
                </select>`
          }
      </td>
      <td>
          <button type="button"
                  class="btn btn-${isFirst ? 'bg-white' : 'bg-white'} remove-headcount"
                  ${isFirst ? 'disabled' : ''} style="border: none !important; background: white !important;">
              <iconify-icon icon="mi:delete" width="24" height="24" style="color: #F7941C"></iconify-icon>
          </button>
      </td>
  </tr>
`);

                }
            
                // update count badge
                countBadge.textContent = count;
            
                // ensure add-button reflects top state
                addBtn.disabled = topToggle?.checked;
                updateSuperiorSelects(previousSelections);
            }
        
            // on‐load: initial render
            renderHeadcountRows();
        });
</script>

@endpush
