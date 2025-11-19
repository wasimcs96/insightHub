  <script>
        function compareSkills(masterSkills, cachedSkills, currentFormSkills) {
            console.log('comparing skills', currentFormSkills);
            const masterMap = new Map(masterSkills.map(s => [s.id || s.c_id, s]));
            const currentMap = new Map(currentFormSkills.map(s => [s.id || s.c_id, s]));
            const results = [];
            console.log('mapped skillssssss', masterMap, currentMap);
            // Base: Master Technical Skills
            // 1. Check for removed skills (present in master but not in current form)
            masterMap.forEach((ms, key) => {
                console.log('keyyyyyyy', key)
                console.log('currentMap', currentMap)
                if (!currentMap.has(key)) {
                    results.push({
                        skill: ms,
                        status: 'removed'
                    });
                }
            });

            // 2. Check for level changes (present in both but with different levels)
            masterMap.forEach((ms, key) => {
                if (currentMap.has(key)) {
                    const currentSkill = currentMap.get(key);
                    const masterLevel = parseInt(ms.preferred_level) || 0;
                    const currentLevel = parseInt(currentSkill.preferred_level) || 0;

                    if (masterLevel !== currentLevel && masterLevel > 0 && currentLevel > 0) {
                        results.push({
                            skill: currentSkill,
                            masterSkill: ms,
                            status: 'level_changed',
                            masterLevel: masterLevel,
                            currentLevel: currentLevel
                        });
                    }
                }
            });

            // 3. Check for new skills (present in current form but not in master)
            currentMap.forEach((cs, key) => {
                if (!masterMap.has(key)) {
                    results.push({
                        skill: cs,
                        status: 'new'
                    });
                }
            });

            console.log('checking result', results)
            return results;
        }

        function getMergedCurrentSkills(cachedSkills, currentFormChanges) {
            const mergedSkills = [...(cachedSkills || [])];
            const cachedSkillsMap = new Map(mergedSkills.map((s, index) => [s.id || s.skillid, {
                skill: s,
                index
            }]));

            // Process current form technical skills
            Object.keys(technicalSkillsData).forEach(index => {
                const formSkill = technicalSkillsData[index];
                const skillElement = document.querySelector(`#skill-${index}`);

                // Skip if this is a removed skill row or doesn't exist
                if (!formSkill || !skillElement || skillElement.classList.contains('removed-skill')) {
                    return;
                }

                const selectElement = skillElement.querySelector('select[name*="[id]"]');
                const skillId = selectElement?.value;

                if (skillId) {
                    const currentSkillData = {
                        id: skillId,
                        skillid: skillId,
                        name: formSkill.name,
                        preferred_level: formSkill.preferred_level,
                        is_custom: formSkill.is_custom,
                        sector_name: formSkill.sector_name,
                        category_name: formSkill.category_name,
                        description: formSkill.description
                    };

                    if (cachedSkillsMap.has(skillId)) {
                        // Update existing skill in merged array
                        const cachedData = cachedSkillsMap.get(skillId);
                        mergedSkills[cachedData.index] = {
                            ...cachedData.skill,
                            ...currentSkillData
                        };
                    } else {
                        // Add new skill to merged array
                        mergedSkills.push(currentSkillData);
                    }
                }
            });

            // Remove skills that were deleted from the form
            const activeSkillIds = new Set();
            Object.keys(technicalSkillsData).forEach(index => {
                const skillElement = document.querySelector(`#skill-${index}`);
                if (skillElement && !skillElement.classList.contains('removed-skill')) {
                    const selectElement = skillElement.querySelector('select[name*="[id]"]');
                    if (selectElement?.value) {
                        activeSkillIds.add(selectElement.value);
                    }
                }
            });

            // Filter out skills that are no longer in the form
            return mergedSkills.filter(skill => activeSkillIds.has(skill.id || skill.skillid));
        }

        function getCurrentFormSkills() {
            const currentSkills = [];

            // Get all active technical skills from the current form state
            console.log('technical skill data', technicalSkillsData);
            Object.keys(technicalSkillsData).forEach(index => {
                const skillData = technicalSkillsData[index];
                const skillElement = document.querySelector(`#skill-${index}`);

                // Only include skills that exist in DOM and are not removed
                if (skillData && skillElement && !skillElement.classList.contains('removed-skill')) {
                    const selectElement = skillElement.querySelector('select[name*="[id]"]');

                    // Make sure the skill is actually selected and has a value
                    if (selectElement && selectElement.value) {

                        if (selectElement && selectElement.value) {
                            // Initialize the skill object
                            const skillObject = {
                                id: skillData.id || skillData.c_id,
                                c_id: skillData.c_id,
                                skillid: skillData.id || skillData.skill_id,
                                name: skillData.name,
                                preferred_level: skillData.preferred_level,
                                is_custom: skillData.is_custom,
                                sector_name: skillData.sector_name,
                                category_name: skillData.category_name,
                                description: skillData.description
                            };

                            // Loop through levels 1 to 6 dynamically
                            for (let i = 1; i <= 6; i++) {
                                skillObject[`level_${i}_description`] = skillData[`level_${i}_description`];
                                skillObject[`level_${i}_knowledge`] = skillData[`level_${i}_knowledge`];
                                skillObject[`level_${i}_ability`] = skillData[`level_${i}_ability`];
                            }

                            // Push the completed skill object into currentSkills array
                            currentSkills.push(skillObject);
                        }
                    }
                }
            });
            console.log('current form skills', currentSkills);
            return currentSkills;
        }


        function renderComparison(results) {
            // Reset previous comparison styling
            resetComparisonStyling();

            results.forEach(item => {
                const skillId = item.skill.id || item.skill.skillid || item.skill.c_id;
                console.log('renderComparison', skillId, item);

                if (item.status === 'removed') {
                    // Show removed skill row with red styling
                    addRemovedSkillRow(item.skill, skillId);
                }

                if (item.status === 'new') {
                    // Apply green styling for new skills
                    markSkillAsNew(skillId);
                }

                if (item.status === 'level_changed') {
                    // Show level change with yellow styling
                    console.log('level_changed', skillId, item);

                    updateLevelButtonForChange(item, skillId);
                }
            });
        }


        function addRemovedSkillRow(skill, skillId) {
            const removedIndex = `removed_${skillId}_${Date.now()}`;

            const skillData = {
                c_id: skill?.c_id || null,
                skill_id: skill?.id || skill?.skillid || null,
                id: skill?.id || skill?.skillid || null,
                code: skill?.code || null,
                sector_id: skill?.sector_id || null,
                sector_name: skill?.sector_name || '',
                sub_sector_id: skill?.sub_sector_id || null,
                sub_sector_name: skill?.sub_sector_name || '',
                name: skill?.name || '',
                description: skill?.description || '',
                preferred_level: skill?.preferred_level || '',
                is_custom: skill?.is_custom ?? 0,
                category_id: skill?.category_id ?? '',
                category_name: skill?.category_name ?? '',
            };

            // Add level data if available
            Object.keys(skill).forEach(key => {
                const match = key.match(/^level_(\d+)_description$/);
                if (match) {
                    const level = match[1];
                    skillData[`level_${level}_description`] = skill[`level_${level}_description`];
                    skillData[`level_${level}_knowledge`] = Array.isArray(skill[`level_${level}_knowledge`]) ?
                        skill[`level_${level}_knowledge`] :
                        String(skill[`level_${level}_knowledge`] || '').split(';');
                    skillData[`level_${level}_ability`] = Array.isArray(skill[`level_${level}_ability`]) ?
                        skill[`level_${level}_ability`] :
                        (skill[`level_${level}_ability`] || '').split(';');
                }
            });

            // Generate hidden inputs
            let hiddenInputs = '';
            Object.keys(skillData).forEach((key) => {
                if (Array.isArray(skillData[key])) {
                    (skillData[key] || []).forEach((value, i) => {
                        hiddenInputs +=
                            `<input type="hidden" name="removedSkills[${removedIndex}][${key}][${i}]" value="${value}">`;
                    });
                } else {
                    hiddenInputs +=
                        `<input type="hidden" name="removedSkills[${removedIndex}][${key}]" value="${skillData[key]}">`;
                }
            });

            // Determine skill type for badge
            const skillType = skillData.is_custom == 1 || skillData.is_custom == 2 ? 'Company Skill' : 'Master Skill';
            const skillTypeBadge = skillType === 'Master Skill' ?
                `<span class="badge-soft badge-master" data-bs-toggle="tooltip" title="${skillType || ''}">${skillType}</span>` :
                `<span class="badge-soft badge-company" data-bs-toggle="tooltip" title="${skillType || ''}">${skillType}</span>`;

            // Create sector and category badges
            const sectorBadge = skillData.sector_name ?
                `<span class="badge-soft badge-green" data-bs-toggle="tooltip" title="${skillData.sector_name || ''}">${skillData.sector_name}</span>` :
                '';
            const categoryBadge = skillData.category_name ?
                `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" title="${skillData.category_name || ''}">${skillData.category_name}</span>` :
                '';

            // Clean the skill name
            const cleanedSkillName = cleanLabel(skillData.name);

            // Create the skill HTML with proper badge display
            const skillHtml = `
            <div class="technical-skill row mb-8 removed-skill" id="skill-${removedIndex}" >
                ${hiddenInputs}
                <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
            
                    <!-- Delete Button -->
                    <div class="flex-shrink-0">
                        <button type="button" disabled class="btn btn-outline btn-outline-danger d-flex align-items-center justify-content-center remove-removed-skill" style="border: 1px solid #C8C8C8 !important; background-color: #FFF !important;" title="Permanently remove">
                            <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                        </button>
                    </div>

                    <!-- Edit Button (disabled for removed skills) -->
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center restore-skill" title="Restore this skill">
                            <iconify-icon icon="ix:restore"class="fa-1-5"></iconify-icon>
                        </button>
                    </div>

                    <!-- Select box with badges -->
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="form-control text-truncate w-100 d-flex justify-content-between align-items-center" 
                            style="background-color: #FFE0DD; color: #AA2D22; border-color: #AA2D22;">
                            <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" style="text-decoration: line-through !important;" title="${skillData.name || ''}">
                                ${cleanedSkillName}
                            </span>
                            <div class="d-flex gap-2 flex-shrink-0">
                                ${skillTypeBadge}
                                ${sectorBadge}
                                ${categoryBadge}
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Input -->
                    <input type="hidden" name="removedSkills[${removedIndex}][name]" value="${skillData.name}">

                    <!-- Level Button (disabled) -->
                    <div class="flex-shrink-0">
                        <button type="button" class="btn-view edit-level-btn" disabled 
                                style="background-color: #FFE0DD; color: #AA2D22; border-color: #AA2D22; text-decoration: line-through;">
                            Level ${skillData.preferred_level || ''}
                        </button>
                    </div>
                </div>
            </div>`;

            // Insert the removed skill at the top of the skills container
            const container = document.getElementById('skills-container');
            container.insertAdjacentHTML('afterbegin', skillHtml);

            // Initialize tooltips for the new badges (use safe initializer if available)
            try {
                if (typeof initializeTooltips === 'function') {
                    initializeTooltips();
                } else {
                    $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
                }
            } catch (e) {
                console.warn('tooltip init failed', e);
            }

            // Add event listeners for the new buttons
            const removedSkillElement = document.getElementById(`skill-${removedIndex}`);

            // Restore button functionality
            // removedSkillElement.querySelector('.restore-skill').addEventListener('click', function() {
            //     if (confirm('Do you want to restore this skill?')) {
            //         const newActiveIndex = document.querySelectorAll('.technical-skill:not(.removed-skill)').length;

            //         removedSkillElement.remove();

            //         // Add it back as an active skill
            //         addTechnicalSkill(newActiveIndex, skillData, []);

            //         // Update the comparison visual state
            //         setTimeout(() => {
            //             const newSkillElement = document.querySelector(`#skill-${newActiveIndex}`);
            //             if (newSkillElement) {
            //                 const selectContainer = newSkillElement.querySelector('.select2-container');
            //                 if (selectContainer) {
            //                     selectContainer.style.backgroundColor = '#BBECC5';
            //                     selectContainer.style.borderColor = '#218336';
            //                     selectContainer.style.borderWidth = '1px';
            //                 }
            //             }
            //         }, 100);
            //     }
            // });

            removedSkillElement.querySelector('.restore-skill').addEventListener('click', function() {
                ModalManager.open({
                    module: 'jobs',
                    key: 'technical_skill_comparison_restore',
                    data: {
                        skillName: skillData.name || 'this skill',
                        skillData: skillData
                    },
                    onSubmit(modalEl) {
                        // Restore the skill
                        const bsModal = bootstrap.Modal.getInstance(modalEl);
                        if (bsModal) bsModal.hide();
                        const newActiveIndex = document.querySelectorAll(
                            '.technical-skill:not(.removed-skill)').length;
                        removedSkillElement.remove();

                        // Add it back as an active skill
                        addTechnicalSkill(newActiveIndex, skillData, []);

                        // Update the comparison visual state
                        setTimeout(() => {
                            const newSkillElement = document.querySelector(
                                `#skill-${newActiveIndex}`);
                            if (newSkillElement) {
                                const selectContainer = newSkillElement.querySelector(
                                    '.select2-container');
                                if (selectContainer) {
                                    selectContainer.style.backgroundColor = '#BBECC5';
                                    selectContainer.style.borderColor = '#218336';
                                    selectContainer.style.borderWidth = '1px';
                                }
                            }
                        }, 100);


                    },
                    onShown: (modal) => {
                        // You can populate modal content here if needed
                        // For example, display the skill name being restored
                        const skillNameEl = modal.querySelector('.skill-name-display');
                        if (skillNameEl) {
                            skillNameEl.textContent = skillData.name || 'this skill';
                        }
                    }
                });
            });

            // Permanent delete button functionality
            removedSkillElement.querySelector('.remove-removed-skill').addEventListener('click', function() {
                if (confirm('Are you sure you want to permanently remove this skill from comparison?')) {
                    removedSkillElement.remove();
                }
            });
        }

        function resetComparisonStyling() {
            // Reset all select2 containers - target the actual select2 selection elements
            document.querySelectorAll('.select2-selection--single').forEach(selection => {
                selection.style.backgroundColor = '';
                selection.style.borderColor = '';
                selection.style.borderWidth = '';
            });

            // Also reset any select2-container styling
            document.querySelectorAll('.select2-container').forEach(container => {
                container.style.backgroundColor = '';
                container.style.borderColor = '';
                container.style.borderWidth = '';
            });

            // Reset all level buttons to default
            document.querySelectorAll('[id*="selectTechLevelButton"]').forEach(button => {
                button.style.backgroundColor = '';
                button.style.borderColor = '';
                button.style.color = '';
                button.classList.remove('level-changed');
                button.removeAttribute('data-bs-toggle');
                button.removeAttribute('title');
                $(button).tooltip('dispose');

                // Reset button text to original format
                const index = button.id.replace('selectTechLevelButton', '');
                const skillData = technicalSkillsData[index];
                if (skillData && skillData.preferred_level) {
                    button.textContent = `Level ${skillData.preferred_level}`;
                    button.innerHTML = `Level ${skillData.preferred_level}`;
                }
            });

            // Remove all removed skill rows
            document.querySelectorAll('.removed-skill').forEach(row => {
                row.remove();
            });

            // Reset any additional styling on technical skill rows
            document.querySelectorAll('.technical-skill:not(.removed-skill)').forEach(row => {
                row.style.backgroundColor = '';
                row.style.borderColor = '';
                row.style.border = '';
            });
        }

        function markSkillAsNew(skillId) {
            // Find and apply green styling to new skills
            Object.keys(technicalSkillsData).forEach(index => {
                const skillData = technicalSkillsData[index];
                const skillElement = document.querySelector(`#skill-${index}`);

                if (skillData && (skillData.id == skillId || skillData.skill_id == skillId) &&
                    skillElement && !skillElement.classList.contains('removed-skill')) {

                    // Target the actual select2 selection element
                    const select2Selection = skillElement.querySelector('.select2-selection--single');
                    if (select2Selection) {
                        select2Selection.style.backgroundColor = '#BBECC5';
                        select2Selection.style.borderColor = 'green';
                        select2Selection.style.borderWidth = '1px';
                        select2Selection.style.color = '#196329';
                    }
                }
            });
        }


        function updateLevelButtonForChange(item, skillId) {
            // Find the skill index in technicalSkillsData
            console.log('updateLevelButtonForChange', skillId, item);
            let skillIndex = null;

            Object.keys(technicalSkillsData).forEach(index => {
                console.log('updateLevelButtonForChangeindexxxx', index, technicalSkillsData);

                const skill = technicalSkillsData[index];
                console.log('skillll', skill);
                if (skill && (skill.id == skillId || skill.skill_id == skillId || skill.c_id == skillId)) {
                    skillIndex = index;
                }
            });
            console.log('ssssssssskillIndex', skillIndex);

            if (skillIndex !== null) {
                const levelButton = document.getElementById(`selectTechLevelButton${skillIndex}`);
                if (levelButton) {
                    // Update button content with styled levels + arrow icon
                    levelButton.innerHTML = `
                        <span style="text-decoration: line-through; color: #9ca3af;">
                            Level ${item.masterLevel}
                        </span>
                        <iconify-icon icon="mdi:arrow-right" style="margin: 0 6px; color: #F7941C;"></iconify-icon>
                        <span style="font-weight: 600; color: #F7941C;">
                            Level ${item.currentLevel}
                        </span>
                    `;

                    // Apply yellow styling
                    levelButton.style.backgroundColor = '#FFF5DA';
                    levelButton.style.borderColor = '#F7941C';
                    levelButton.style.color = '#F7941C';
                    levelButton.classList.add('level-changed');
                    levelButton.style.gap = "0";

                    // Add tooltip using data-bs-title to ensure type safety
                    levelButton.setAttribute('data-bs-toggle', 'tooltip');
                    levelButton.setAttribute('data-bs-placement', 'top');
                    levelButton.setAttribute('data-bs-title', `Master skill level: ${item.masterLevel}, Current level: ${item.currentLevel}`);
                    if (levelButton.hasAttribute('title')) levelButton.removeAttribute('title');
                    try {
                        if (typeof initializeTooltips === 'function') {
                            initializeTooltips();
                        } else {
                            $(levelButton).tooltip('dispose').tooltip();
                        }
                    } catch (e) {
                        console.warn('tooltip init failed', e);
                    }
                }
            }
        }





        // Dynamic comparison updates
        function setupDynamicComparison() {
            // Listen for skill changes if comparison is active
            document.addEventListener('change', function(e) {
                if (comparisonActive && e.target.matches('select[name*="technicalSkills"]')) {
                    // Delay to allow the change to process
                    setTimeout(() => {
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                            .masterTechnicalSkills.length > 0 ?
                            ajaxResponse.masterTechnicalSkills :
                            (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills :
                                []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse
                            .technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        renderComparison(comparison);
                        showComparisonSummary(comparison);
                    }, 100);
                }
            });

            // Listen for level changes
            $('#techskillmodal').on('hidden.bs.modal', function() {
                if (comparisonActive) {
                    setTimeout(() => {
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                            .masterTechnicalSkills.length > 0 ?
                            ajaxResponse.masterTechnicalSkills :
                            (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills :
                                []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse
                            .technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        renderComparison(comparison);
                        showComparisonSummary(comparison);
                    }, 100);
                }
            });

            // Listen for skill additions
            document.addEventListener('click', function(e) {
                if (comparisonActive && e.target.matches('#add_new_skill')) {
                    setTimeout(() => {
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                            .masterTechnicalSkills.length > 0 ?
                            ajaxResponse.masterTechnicalSkills :
                            (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills :
                                []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse
                            .technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        renderComparison(comparison);
                        showComparisonSummary(comparison);
                    }, 500);
                }
            });

            // Listen for skill removals
            document.addEventListener('click', function(e) {
                if (comparisonActive && e.target.matches('.remove-skill')) {
                    setTimeout(() => {
                        console.log('adfafdasfdasfasfasfasdfasdfsd');
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                            .masterTechnicalSkills.length > 0 ?
                            ajaxResponse.masterTechnicalSkills :
                            (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills :
                                []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse
                            .technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        renderComparison(comparison);
                        showComparisonSummary(comparison);
                    }, 100);
                }
            });

            // Listen for restored skills from removed skill rows
            document.addEventListener('click', function(e) {
                if (comparisonActive && e.target.matches('.restore-skill')) {
                    setTimeout(() => {
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                            .masterTechnicalSkills.length > 0 ?
                            ajaxResponse.masterTechnicalSkills :
                            (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills :
                                []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse
                            .technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        renderComparison(comparison);
                        showComparisonSummary(comparison);
                    }, 200);
                }
            });
        }

        function showComparisonSummary(results) {
            // Remove existing summary
            hideComparisonSummary();

            const removed = results.filter(r => r.status === 'removed').length;
            const added = results.filter(r => r.status === 'new').length;
            const levelChanged = results.filter(r => r.status === 'level_changed').length;

            if (removed > 0 || added > 0 || levelChanged > 0) {
                const summaryHtml = `
                    <div class="comparison-summary d-flex justify-content-between align-items-center">
                        <p>This view reflects the technical skills changes compared to the original mapping of JD.</p>
                        <div class="d-flex gap-2">
                            <div class="custom-tooltip">
                                <span><span class="levels new"></span> New</span>
                                <span><span class="levels removed"></span> Removed</span>
                                <span><span class="levels level-update"></span> Level Update</span>
                            </div>
                        </div>
                    </div>
                `;

                const container = document.getElementById('skills-container');
                container.insertAdjacentHTML('afterbegin', summaryHtml);
            }
        }

        function hideComparisonSummary() {
            const summary = document.querySelector('.comparison-summary');
            if (summary) {
                summary.remove();
            }
        }

        let comparisonActive = false;

        document.getElementById('comparisonToggle').addEventListener('change', function() {
            const ajaxResponse = @json($cachedData);
            // Use technical_skills as masterSkills if masterTechnicalSkills is not present or empty
            let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                .masterTechnicalSkills.length > 0 ?
                ajaxResponse.masterTechnicalSkills :
                (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
            const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
            console.log('masterSkills', masterSkills);
            console.log('cachedSkills', cachedSkills);

            if (this.checked) {
                // Get current form changes
                const currentFormSkills = getCurrentFormSkills();
                console.log('currentFormSkills', currentFormSkills);
                // Compare master vs (cached + current form changes)
                const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                renderComparison(comparison);
                comparisonActive = true;

                // Show summary of changes
                showComparisonSummary(comparison);

            } else {
                // Hide comparison and reset all styling
                resetComparisonStyling();
                comparisonActive = false;

                // Hide summary
                hideComparisonSummary();
            }
        });
        $(document).ready(function() {
            setupDynamicComparison();
        });

        // View Changes Modal Start
        // View Changes Modal functionality using ModalManager
        document.getElementById('viewChangesBtn').addEventListener('click', function() {
            const ajaxResponse = @json($cachedData);
            let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                .masterTechnicalSkills.length > 0 ?
                ajaxResponse.masterTechnicalSkills :
                (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
            const currentFormSkills = getCurrentFormSkills();

            // Get comparison results
            const comparison = compareSkills(masterSkills, [], currentFormSkills);

            // Open modal using ModalManager
            ModalManager.open({
                module: 'jobs',
                key: 'technical_skill_comparison',
                data: {
                    comparison: comparison,
                    masterSkills: masterSkills,
                    currentSkills: currentFormSkills
                },
                onSubmit(modalEl) {
                    // Handle any submission logic if needed
                    // For now, this modal is view-only, so just close it
                    ModalManager.close('technical_skill_comparison');
                },
                onShown: (modal) => {
                    // Populate the modal content after it's shown
                    populateViewChangesModalContent(modal, comparison);
                }
            });
        });

        function populateViewChangesModalContent(modalElement, results) {
            // Find the modal body container (adjust selector based on your modal structure)
            const modalContent = modalElement.querySelector('.modal-body') || modalElement.querySelector(
                '[data-modal-content]');

            if (!modalContent) {
                console.error('Modal content container not found');
                return;
            }

            modalContent.innerHTML = '';

            // Categorize results
            const newSkills = results.filter(r => r.status === 'new');
            const removedSkills = results.filter(r => r.status === 'removed');
            const levelChangedSkills = results.filter(r => r.status === 'level_changed');

            // Generate cards for each category
            if (newSkills.length > 0) {
                modalContent.appendChild(createSkillCard('New Skills', newSkills, 'success'));
            }

            if (removedSkills.length > 0) {
                modalContent.appendChild(createSkillCard('Removed Skills', removedSkills, 'danger'));
            }

            if (levelChangedSkills.length > 0) {
                modalContent.appendChild(createSkillCard('Skill Level Changes', levelChangedSkills, 'warning'));
            }

            // Show message if no changes
            if (newSkills.length === 0 && removedSkills.length === 0 && levelChangedSkills.length === 0) {
                modalContent.innerHTML = `
                <div class="text-center py-5">
                    <iconify-icon icon="garden:file-pdf-stroke-16" width="16" height="16" style="font-size: 48px;"></iconify-icon>
                    <h4 class="mt-3">No changes detected</h4>
                    <p class="text-muted">You haven’t made any updates to skills. Once you add, remove, or update a skill level, the changes will appear here.</p>
                </div>
            `;
            }

            // Initialize Bootstrap components in the modal
            initializeModalComponents(modalElement);
        }

        function initializeModalComponents(modalElement) {
            // Initialize any Bootstrap tooltips in the modal
            const tooltipTriggerList = modalElement.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(tooltipTriggerEl => {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Initialize accordion collapse functionality if needed
            const accordionElements = modalElement.querySelectorAll('.accordion');
            accordionElements.forEach(accordion => {
                // Bootstrap should handle this automatically, but you can add custom logic here if needed
            });
        }

        function createSkillCard(title, skills, variant) {
            const card = document.createElement('div');
            card.className = `card mb-4`;

            const cardHeader = document.createElement('div');
            cardHeader.className = `card-header bg-${variant} text-white`;
            cardHeader.innerHTML = `
                <h6 class="mb-0 d-flex gap-2 align-items-center">
                    ${title} <span>(${skills.length})</span>
                </h6>
            `;

            const cardBody = document.createElement('div');
            cardBody.className = 'card-body p-0';
            cardBody.style.setProperty('padding', '0', 'important');

            const accordion = document.createElement('div');
            accordion.className = 'accordion';
            accordion.id = `accordion${variant}${Date.now()}`; // Unique ID for each accordion

            skills.forEach((item, index) => {
                const accordionItem = createAccordionItem(item, index, accordion.id, variant);
                accordion.appendChild(accordionItem);
            });

            cardBody.appendChild(accordion);
            card.appendChild(cardHeader);
            card.appendChild(cardBody);

            return card;
        }

        function createAccordionItem(item, index, parentAccordionId, variant) {
            const accordionItem = document.createElement('div');
            accordionItem.className = 'accordion-item';

            const skill = item.skill;
            const accordionId = `${parentAccordionId}Item${index}`;

            // Determine skill type badge
            const skillType = skill.is_custom == 1 || skill.is_custom == 2 ? 'Company Skill' : 'Master Skill';
            const skillTypeBadge = skillType === 'Master Skill' ?
                `<span class="badge badge-soft badge-master" data-bs-toggle="tooltip" title="${skillType || ''}">${skillType}</span>` :
                `<span class="badge badge-soft badge-company" data-bs-toggle="tooltip" title="${skillType || ''}">${skillType}</span>`;

            // Level change indicator
            let levelIndicator = '';
            if (item.status === 'level_changed') {
                levelIndicator = `
                    <span class="d-flex align-items-center gap-1">
                    <span class="d-flex align-items-center gap-1" style="text-decoration: line-through; color: #757575; font-size: 16px; font-weight: 400; line-height: 36px;"><iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #99A1B7;"></iconify-icon> ${item.masterLevel}</span> <span class="d-flex align-items-center gap-1" style="color: #757575; font-size: 16px; font-weight: 400; line-height: 36px;"><iconify-icon icon="tabler:arrow-right" width="16" height="16"></iconify-icon></span>  <span class="d-flex align-items-center gap-1"><iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #F7941D;"></iconify-icon> ${item.currentLevel}
                    </span></span>
                `;
            } else if (skill.preferred_level) {
                levelIndicator =
                    `<span style="color: #757575; font-size: 16px; font-weight: 400; line-height: 36px;" class="d-flex align-items-center gap-1"><iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #F7941D;"></iconify-icon> ${skill.preferred_level}</span>`;
            }

            // Create sector and category badges
            const sectorBadge = skill.sector_name ?
                `<span class="badge badge-soft badge-green" data-bs-toggle="tooltip" title="${skill.sector_name || ''}">${skill.sector_name}</span>` :
                '';
            const categoryBadge = skill.category_name ?
                `<span class="badge badge-soft badge-purple" data-bs-toggle="tooltip" title="${skill.category_name || ''}">${skill.category_name}</span>` :
                '';

            accordionItem.innerHTML = ` 
                <h2 class="accordion-header" id="heading${accordionId}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#collapse${accordionId}" aria-expanded="false" 
                            aria-controls="collapse${accordionId}">
                            <span style="padding-left:23px">${cleanLabel(skill.name)}</span>
                        <div class="d-flex justify-content-between align-items-center w-100 me-3">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <iconify-icon icon="mage:plus-circle-fill" width="23" height="23"></iconify-icon>
                                ${skillTypeBadge}
                                ${sectorBadge}
                                ${categoryBadge}
                            </div>
                            <div class="flex-shrink-0">
                                ${levelIndicator}
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapse${accordionId}" class="accordion-collapse collapse" 
                    aria-labelledby="heading${accordionId}" data-bs-parent="#${parentAccordionId}">
                    <div class="accordion-body">
                        ${generateSkillDetails(skill, item)}
                    </div>
                </div>
            `;

            return accordionItem;
        }

        function generateSkillDetails(skill, item) {
            let content = '';
            console.log('response', skill, item);
            // Always show general description if available
            if (skill.description) {
                content += `
                    <div class="mb-4">
                        <p class="mb-0">${skill.description}</p>
                    </div>
                `;
            }

            // Show level change summary first for level changed skills


            // Determine which levels to show
            let levelsToShow = [];

            if (item.status === 'level_changed') {
                // For level changed skills, show the current level prominently
                levelsToShow.push({
                    level: item.currentLevel,
                    label: `Current Level ${item.currentLevel}`,
                    isPrimary: true,
                    alertClass: 'alert-success'
                });

                // Also show master level for comparison
                // if (item.masterLevel !== item.currentLevel) {
                //     levelsToShow.push({
                //         level: item.masterLevel,
                //         label: `Master Level ${item.masterLevel}`,
                //         isPrimary: false,
                //         alertClass: 'alert-info'
                //     });
                // }
            } else {
                // For new and removed skills, show their current/assigned level
                if (skill.preferred_level) {
                    levelsToShow.push({
                        level: skill.preferred_level,
                        label: `Level ${skill.preferred_level}`,
                        isPrimary: true,
                        alertClass: item.status === 'new' ? 'alert-success' : 'alert-danger'
                    });
                }
            }

            // Show all available levels if no specific level is set
            if (levelsToShow.length === 0) {
                for (let level = 1; level <= 6; level++) {
                    if (skill[`level_${level}_description`] ||
                        skill[`level_${level}_knowledge`] ||
                        skill[`level_${level}_ability`]) {
                        levelsToShow.push({
                            level: level,
                            label: `Level ${level}`,
                            isPrimary: level === 1,
                            alertClass: 'alert-secondary'
                        });
                    }
                }
            }

            // Display details for each level
            levelsToShow.forEach((levelInfo, index) => {
                const levelDesc = skill[`level_${levelInfo.level}_description`];
                const levelKnowledge = skill[`level_${levelInfo.level}_knowledge`];
                const levelAbility = skill[`level_${levelInfo.level}_ability`];

                // Skip if no data for this level
                if (!levelDesc && !levelKnowledge && !levelAbility) {
                    return;
                }

                // Create level container
                const containerClass = levelInfo.isPrimary ? `` : 'p-3 mb-3';
                const headerClass = levelInfo.isPrimary ? 'alert-heading' : 'text-primary';

                content += `<div class="${containerClass}">`;

                // Level header
                content += `
                    <h6 class="alert-heading d-flex gap-2 align-items-center mb-3">
                        <iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #F7941D;"></iconify-icon>
                        ${levelInfo.label}
                    </h6>
                `;

                // Level Description
                if (levelDesc) {
                    content += `
                        <div class="mb-5">
                            <p class="mb-0 mt-1">${levelDesc}</p>
                        </div>
                    `;
                }

                // Knowledge Section
                if (levelKnowledge && levelKnowledge.length > 0) {
                    const knowledgeItems = Array.isArray(levelKnowledge) ?
                        levelKnowledge.filter(k => k && k.trim()) :
                        String(levelKnowledge).split(';').filter(k => k && k.trim());

                    if (knowledgeItems.length > 0) {
                        content += `
                            <div class="mb-5">
                                    <h6 class="alert-heading mb-3">Knowledge:</h6>
                                <ul class="mb-0 mt-1 p-0">
                                    ${knowledgeItems.map(k => `<li style="list-style: none;" class="d-flex align-items-center gap-2"> <iconify-icon icon="material-symbols-light:check-circle-outline-rounded" width="16" height="16"></iconify-icon> ${k.trim()}</li>`).join('')}
                                </ul>
                            </div>
                        `;
                    }
                }

                // Ability Section
                if (levelAbility && levelAbility.length > 0) {
                    const abilityItems = Array.isArray(levelAbility) ?
                        levelAbility.filter(a => a && a.trim()) :
                        String(levelAbility).split(';').filter(a => a && a.trim());

                    if (abilityItems.length > 0) {
                        content += `
                            <div class="mb-0">
                                <h6 class="alert-heading mb-3">Ability:</h6>
                                <ul class="mb-0 mt-1 p-0">
                                    ${abilityItems.map(a => `<li style="list-style: none;" class="d-flex align-items-center gap-2"> <iconify-icon icon="material-symbols-light:check-circle-outline-rounded" width="16" height="16"></iconify-icon> ${a.trim()}</li>`).join('')}
                                </ul>
                            </div>
                        `;
                    }
                }

                content += `</div>`;
            });

            // // Show status-specific messages
            // if (item.status === 'new') {
            //     content += `
        //         <div class="alert alert-success">
        //             <h6 class="alert-heading">
        //                 <iconify-icon icon="material-symbols:add-circle" class="me-1"></iconify-icon>
        //                 New Skill Added
        //             </h6>
        //             <p class="mb-0">This skill has been added and was not present in the master technical skills mapping.</p>
        //         </div>
        //     `;
            // } else if (item.status === 'removed') {
            //     content += `
        //         <div class="alert alert-danger">
        //             <h6 class="alert-heading">
        //                 <iconify-icon icon="material-symbols:remove-circle" class="me-1"></iconify-icon>
        //                 Skill Removed
        //             </h6>
        //             <p class="mb-0">This skill was present in the master technical skills but has been removed from the current job configuration.</p>
        //         </div>
        //     `;
            // }

            return content || `
                <div class="text-center py-4">
                    <iconify-icon icon="material-symbols:info" class="text-muted" style="font-size: 24px;"></iconify-icon>
                    <p class="text-muted mb-0 mt-2">No detailed information available for this skill.</p>
                </div>
            `;
        }

        function getCardIcon(variant) {
            switch (variant) {
                case 'success':
                    return 'material-symbols:add-circle';
                case 'danger':
                    return 'material-symbols:remove-circle';
                case 'warning':
                    return 'material-symbols:change-circle';
                default:
                    return 'material-symbols:info';
            }
        }

        // Helper function if cleanLabel is not available in scope
        function cleanLabel(text) {
            let str = String(text || '').trim();
            return str.replace(/\s*\(([^)]*)\)\s*$/, (match, inner) => {
                if (inner.includes('-')) {
                    return '';
                }
                return ` (${inner})`;
            }).trim();
        }
        // View Changes Modal End
    </script>