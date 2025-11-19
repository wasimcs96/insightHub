@props([
    'cachedTechnicalSkills' => [],
    'containerId' => 'skills-container',
])

<div class="card  shadow-sm mb-4">
    <div class="card-header d-flex" style="justify-content: space-between !important;">
        <h3 class="card-title"> Technical Skills <iconify-icon
                icon="material-symbols:info-outline-rounded" data-bs-toggle="tooltip"
                class="mx-2 info-tooltip" data-bs-placement="top" data-bs-html="true"
                data-bs-title='<div class="custom-tooltip"><span><span class="dot dot-sky"></span> Master Skill</span><span><span class="dot dot-yellow"></span> Company Skill</span><br/><span><span class="dot dot-green"></span> Sector</span><span><span class="dot dot-purple"></span> Category</span></div>'
                width="20" height="20" style="color: #5F6368;"></iconify-icon></h3>
        <div class="d-flex gap-3">
            <button type="button" class="ts-button outline-orange d-flex gap-3" id="viewChangesBtn">
                <iconify-icon icon="iconamoon:eye" width="16" height="16"></iconify-icon>
                View Changes
            </button>

            <div class="ts-button grey-outline d-flex gap-3">
                <div class="custom-toggle-comparison">
                    <input type="checkbox" id="comparisonToggle" class="toggle-input-comparison">
                    <label for="comparisonToggle" class="toggle-slider-comparison"></label>
                </div>
                <span class="toggle-label">Show Changes</span>
            </div>
        </div>
    </div>
    <div class="card-body  py-5">
        <input type="hidden" id="technicalSkillsJson" name="technicalSkillsJson" value="">
        <div id="{{ $containerId }}"></div>
        <button type="button" id="add_new_skill" class="add-function mt-5" style="background:#F7941C"><iconify-icon icon="stash:plus-solid" style="font-size: 20px"></iconify-icon> Add New Skill</button>
        <div id="techvalidationmessage" class="mt-3" style="color: red; display: none;">At least One Technical Skill is required.</div>
    </div>
</div>
@push('scripts')

<script>
    (function(){
        // Component-scoped JS for technical skills
        const cachedTechnicalSkills = @json($cachedTechnicalSkills ?? []);

    // Expose a single global object to avoid collisions
    window.TSComponent = window.TSComponent || {};

    // Data store for technical skills on the page
    window.TSComponent.technicalSkillsData = window.TSComponent.technicalSkillsData || {};

    // Make a global alias used elsewhere in the page (legacy handlers expect window.technicalSkillsData)
    window.technicalSkillsData = window.TSComponent.technicalSkillsData;

        function esc(s = '') {
            return String(s)
                .replace(/&/g, '&amp;').replace(/</g, '&lt;')
                .replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
        }

        function cleanLabel(text) {
            if (!text) return '';
            let str = String(text || '');
            let pattern = /\([^()]*-.*?\)/g;
            while (pattern.test(str)) {
                str = str.replace(pattern, '');
            }
            return str.trim();
        }

        // Use global initializeTooltips if available (keeps tooltip logic centralized)
        function initializeTooltips() {
            if (typeof window.initializeTooltips === 'function') return window.initializeTooltips();
            // fallback (minimal) - avoid throwing
            const els = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            els.forEach(function(el) {
                if (el.hasAttribute('title')) el.removeAttribute('title');
                try { if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) new bootstrap.Tooltip(el, { delay: { show: 0, hide: 100 } }); } catch (e) {}
            });
        }

        function initSkillSelect2(skillIndex) {
            const selectEl = $(`#skill\\[${skillIndex}\\]`);
            // Reusable markup generator for Select2 results (preserves badges & tooltips)
            function renderSkillMarkup(data) {
                if (data.loading) return data.text;
                const name = cleanLabel(data.text);
                const skillType = data.skill_type || '';
                const category = data.category || '';
                const sector = data.sector || '';
                const isNewSkill = data.text && data.text.includes('(New Skill)');

                return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(name) || ''}">
                    ${esc(name)}
                    ${isNewSkill ? '<span class="badge bg-warning text-dark ms-2">New</span>' : ''}
                </span>
                <div class="d-flex gap-2">
                    ${skillType 
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
            }

            selectEl.select2({
                ajax: {
                    url: '{{ route('admin.technical-skill.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: params => ({ q: params.term, page: params.page || 1 }),
                    processResults: (data) => ({ results: data.results, pagination: { more: data.pagination.more } }),
                    cache: true
                },
                language: { noResults: () => 'No matches found' },
                templateResult: renderSkillMarkup,
                templateSelection: renderSkillMarkup,
                placeholder: 'Search for a skill', minimumInputLength: 1, width: 'resolve'
            });

            selectEl.on('select2:open select2:select', function() { try { initializeTooltips(); } catch(e){} });
            selectEl.on('change', function() {
                const $this = $(this); const selectedId = $this.val();
                const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
                const idx = idMatch ? idMatch[1] : null; if (!idx) return;
                if (!selectedId) { $(`#technicalSkillsHidden\\[${idx}\\]`).val(''); $(`#selectTechLevelButton${idx}`).prop('disabled', true); return; }
                TechSkillChanged(idx, selectedId, $this);
            });
        }

        // Reusable addTechnicalSkill (keeps data + builds DOM)
        function addTechnicalSkill(index, skill = null, allSkills = []) {
            if (!skill) return;
            const skillData = {
                c_id: skill?.c_id || null, skill_id: skill?.id || null, id: skill?.id || null,
                code: skill?.code || null, sector_id: skill?.sector_id || null, sector_name: skill?.sector_name || '',
                sub_sector_id: skill?.sub_sector_id || null, sub_sector_name: skill?.sub_sector_name || '',
                name: skill?.name || '', description: skill?.description || '', preferred_level: skill?.preferred_level || '',
                is_custom: skill?.is_custom ?? 0, category_id: skill?.category_id ?? '', category_name: skill?.category_name ?? ''
            };

            const levelsFound = [];
            Object.keys(skill).forEach(key => {
                const match = key.match(/^level_(\d+)_description$/);
                if (match) {
                    const level = match[1];
                    levelsFound.push(level);
                    skillData[`level_${level}_description`] = skill[`level_${level}_description`];
                    skillData[`level_${level}_knowledge`] = Array.isArray(skill[`level_${level}_knowledge`]) ? skill[`level_${level}_knowledge`] : String(skill[`level_${level}_knowledge`] || '').split(';');
                    skillData[`level_${level}_ability`] = Array.isArray(skill[`level_${level}_ability`]) ? skill[`level_${level}_ability`] : String(skill[`level_${level}_ability`] || '').split(';');
                }
            });

            // store
            window.TSComponent.technicalSkillsData[index] = skillData;
            // Keep legacy global alias in sync
            window.technicalSkillsData = window.TSComponent.technicalSkillsData;

            let hiddenInputs = '';
            Object.keys(skillData).forEach((key) => {
                if (Array.isArray(skillData[key])) {
                    (skillData[key] || []).forEach((value, i) => { hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}][${i}]" value="${value}">`; });
                } else {
                    hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}]" value="${skillData[key]}">`;
                }
            });

            const skillHtml = `
        <div class="technical-skill row mb-8" id="skill-${index}">
            ${hiddenInputs}
            <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
                        <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                    </button>
                </div>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${index}">
                        <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                    </button>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <select id="skill[${index}]" name="technicalSkills[${index}][id]" class="form-control select-skill text-truncate w-100" data-index="${index}">
                        <option value="${skill?.id}" selected>${skill?.name}</option>
                    </select>
                </div>
                <input type="hidden" id="technicalSkillsHidden[${index}]" name="technicalSkills[${index}][name]" value="${skill?.name || ''}">
                <div class="flex-shrink-0">
                    <button type="button" id="selectTechLevelButton${index}" class="btn-view edit-level-btn" data-bs-toggle="modal" data-bs-target="#techskillmodal" onclick="technicalpopulateModal(${index})">Level ${skill?.preferred_level || ''}</button>
                </div>
            </div>
        </div>`;

            const container = document.getElementById('{{ $containerId }}');
            if (container) container.insertAdjacentHTML('beforeend', skillHtml);

            // initialize select2 for this row
            try { initSkillSelect2(index); } catch(e) {}

            // set level button disabled state
            try { $(`#selectTechLevelButton${index}`).prop('disabled', !(skill?.preferred_level)); } catch(e) {}

            // Sync hidden JSON field used by forms
            try { $('#technicalSkillsJson').val(JSON.stringify(window.TSComponent.technicalSkillsData)); } catch(e) {}
        }

        // TechSkillChanged and restore flow (simplified)
        function TechSkillChanged(index, skillId, selectEl = null) {
            showOverlay && typeof showOverlay === 'function' && showOverlay();
            $.ajax({ url: '/admin/get-techskill-levels/' + skillId, type: 'GET', success: function(response) {
                const skill = response[0]; if (!skill) { hideOverlay && hideOverlay(); return; }

                function isDuplicate(skillA, skillB) {
                    return ((cleanLabel(skillA.name)||'').toLowerCase().trim() === (cleanLabel(skillB.name)||'').toLowerCase().trim() && (skillA.category_name||'').toLowerCase().trim() === (skillB.category_name||'').toLowerCase().trim() && (skillA.sector_name||'').toLowerCase().trim() === (skillB.sector_name||'').toLowerCase().trim());
                }

                // duplicate check across existing active technicalSkillsData (ignore same index)
                let duplicate = null;
                for (let k in window.TSComponent.technicalSkillsData) {
                    if (String(k) === String(index)) continue;
                    if (isDuplicate(window.TSComponent.technicalSkillsData[k], skill)) { duplicate = window.TSComponent.technicalSkillsData[k]; break; }
                }
                if (duplicate) { hideOverlay && hideOverlay(); alert('This skill is already selected. Please choose another.'); if (selectEl) { selectEl.val('').trigger('change.select2'); $(`#technicalSkillsHidden\\[${index}\\]`).val(''); $(`#selectTechLevelButton${index}`).prop('disabled', true); } return; }

                // check removed rows for match to restore
                const removedRows = Array.from(document.querySelectorAll('.removed-skill'));
                let matchingRemovedRow = null;
                for (const row of removedRows) {
                    const idInput = row.querySelector('input[name*="[id]"]');
                    const nameInput = row.querySelector('input[name*="[name]"]');
                    if (idInput && String(idInput.value) === String(skill.id)) { matchingRemovedRow = row; break; }
                    if (!matchingRemovedRow && nameInput && cleanLabel(String(nameInput.value||'')).toLowerCase() === cleanLabel(String(skill.name||'')).toLowerCase()) { matchingRemovedRow = row; break; }
                }

                if (matchingRemovedRow) {
                    let confirmed = false;
                    ModalManager.open({ module: 'jobs', key: 'technical_skill_comparison_restore', data: { skillName: skill.name || 'this skill', skillData: skill }, onSubmit(modalEl) {
                        confirmed = true;
                        // Reconstruct skill from hidden inputs inside removed row
                        const inputs = matchingRemovedRow.querySelectorAll('input');
                        const restored = {};
                        inputs.forEach(inp => {
                            const name = inp.getAttribute('name') || ''; const val = inp.value;
                            const tokens = name.match(/\[([^\]]+)\]/g) || []; if (tokens.length === 0) return;
                            const cleaned = tokens.map(t => t.replace(/^[\[]|[\]]$/g, ''));
                            let keyToken = cleaned.find(t => isNaN(Number(t))); if (!keyToken) keyToken = cleaned[cleaned.length-1];
                            const last = cleaned[cleaned.length-1]; if (!isNaN(Number(last))) { restored[keyToken] = restored[keyToken] || []; restored[keyToken][Number(last)] = val; } else { restored[keyToken] = val; }
                        });
                        const restoredSkill = { id: restored.id || restored.skill_id || skill.id, skill_id: restored.skill_id || restored.id || skill.id, name: restored.name || restored.skill || skill.name || '', preferred_level: restored.preferred_level || skill.preferred_level || '', is_custom: restored.is_custom ?? skill.is_custom ?? 0 };
                        const newActiveIndex = document.querySelectorAll('.technical-skill:not(.removed-skill)').length;
                        matchingRemovedRow.remove();
                        addTechnicalSkill(newActiveIndex, restoredSkill, []);
                        if (selectEl) { selectEl.val('').trigger('change.select2'); $(`#technicalSkillsHidden\\[${index}\\]`).val(''); $(`#selectTechLevelButton${index}`).prop('disabled', true); }
                        const bsModal = bootstrap.Modal.getInstance(modalEl); if (bsModal) bsModal.hide();
                    }, onShown(modal) { const skillNameEl = modal.querySelector('.skill-name-display'); if (skillNameEl) skillNameEl.textContent = skill.name || 'this skill'; } }, true);

                    setTimeout(() => { if (!confirmed) { if (selectEl) { selectEl.val('').trigger('change.select2'); $(`#technicalSkillsHidden\\[${index}\\]`).val(''); $(`#selectTechLevelButton${index}`).prop('disabled', true); } } }, 6000);
                    return;
                }

                // not duplicate and not restored -> save data
                if (selectEl) { const selectedText = selectEl.find('option:selected').text(); $(`#technicalSkillsHidden\\[${index}\\]`).val(selectedText); $(`#selectTechLevelButton${index}`).prop('disabled', false); }

                window.TSComponent.technicalSkillsData[index] = { c_id: skill.c_id||null, skill_id: skill.id||null, code: skill.code||null, sector_id: skill.sector_id||null, sector_name: skill.sector_name||'', sub_sector_id: skill.sub_sector_id||null, sub_sector_name: skill.sub_sector_name||'', name: skill.name||'', description: skill.description||'', preferred_level: skill.preferred_level||'', is_custom: skill.is_custom??'', category_id: skill.category_id??'', category_name: skill.category_name??'' };

                // keep legacy alias and hidden field in sync so existing handlers (remove/edit/modal) work unchanged
                window.technicalSkillsData = window.TSComponent.technicalSkillsData;
                try { $('#technicalSkillsJson').val(JSON.stringify(window.TSComponent.technicalSkillsData)); } catch(e) {}

                Object.keys(skill).forEach(key => { const match = key.match(/^level_(\d+)_description$/); if (match) { const level = match[1]; window.TSComponent.technicalSkillsData[index][`level_${level}_description`] = skill[`level_${level}_description`]; window.TSComponent.technicalSkillsData[index][`level_${level}_knowledge`] = Array.isArray(skill[`level_${level}_knowledge`]) ? skill[`level_${level}_knowledge`] : String(skill[`level_${level}_knowledge`] || '').split(';'); window.TSComponent.technicalSkillsData[index][`level_${level}_ability`] = Array.isArray(skill[`level_${level}_ability`]) ? skill[`level_${level}_ability`] : (skill[`level_${level}_ability`] || '').split(';'); } });

                $(`#selectTechLevelButton${index}`).html(`Select Level`);
                $(`#technicalSkillsHiddenCustom\\[${index}\\]`).val(skill.is_custom);
                $(`#selectTechLevelButton${index}`).attr('onclick', `technicalpopulateModal(${index})`);
                $('#technicalSkillsJson').val(JSON.stringify(window.TSComponent.technicalSkillsData));
                hideOverlay && hideOverlay();
            }, error: function() { hideOverlay && hideOverlay(); } });
        }

        // Expose on window for modal calls
        window.addTechnicalSkill = addTechnicalSkill;
        window.TechSkillChanged = TechSkillChanged;

        // Initialize: if cachedTechnicalSkills exist, render them
        document.addEventListener('DOMContentLoaded', function(){
            initializeTooltips();
            const initial = cachedTechnicalSkills || [];
            initial.forEach((sk, idx) => { addTechnicalSkill(Object.keys(window.TSComponent.technicalSkillsData).length, sk, initial); });

            // Wire add button
            $('#add_new_skill').on('click', function(){ const newIndex = document.querySelectorAll('#{{ $containerId }} .technical-skill').length; addTechnicalSkill(newIndex, { id: '', name: '' }, []); });
        });
    })();
</script>
@endpush