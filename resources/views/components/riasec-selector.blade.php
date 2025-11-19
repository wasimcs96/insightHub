@props([
    'selectedRiasec' => [],
    'showGenerateButton' => true,
    'generateButtonText' => 'Generate RIASEC For Job Position',
    'generateButtonId' => 'generate-riasec',
    'selectId' => 'riasec',
    'selectName' => 'riasec[]',
    'required' => true,
    'placeholder' => 'Select Riasec',
    'validationMessage' => 'Please select at least 3 RIASEC values',
    'tooltipTitle' => 'Represents the strongest personality traits based on the RIASEC model. Order matters—the first type has the greatest influence. Job matches are more accurate when the top traits and their order align.',
    'generateTooltipTitle' => 'The current RIASEC code is based on the selected role from the Master or Company JD. You may also generate a new code tailored to this job and select the most suitable one for implementation.',
    'masterId' => null,
    'currentTop3Riasec' => '',
    'jobProfileFieldId' => 'job_profile',
    'jobDescriptionFieldId' => 'jobRoleDescription',
    'jdType'=>'jdType',
    'jdTitle'=>'jdTitle'
    
])

<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h3 class="card-title d-flex align-items-center gap-1">
            Top 3 RIASEC 
            <iconify-icon 
                icon="material-symbols:info-outline" 
                width="16" 
                height="16" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="{{ $tooltipTitle }}">
            </iconify-icon>
        </h3>
    </div>

    <div class="card-body py-5">
        <div class="d-flex align-items-start gap-3" id="riasec-block">
            <div class="fv-row fv-plugins-icon-container flex-grow-1">
                @php
                    // Normalize selected codes to uppercase to match constants values (R, I, A, S, E, C)
                    $selectedNormalized = array_map(function($v){ return is_string($v) ? strtoupper($v) : $v; }, (array)($selectedRiasec ?? []));
                @endphp
                <select 
                    id="{{ $selectId }}" 
                    name="{{ $selectName }}" 
                    class="form-select @error('riasec') is-invalid @enderror" 
                    data-placeholder="{{ $placeholder }}"
                    data-preselected='@json($selectedNormalized)'
                    multiple 
                    @if($required) required @endif>
                    
                    @foreach (config('constants.RIASEC_CODES') as $key => $value)
                        <option 
                            value="{{ $value }}" 
                            class="dark:bg-slate-700"
                            @if(in_array($value, $selectedNormalized)) selected @endif>
                            {{ $key . '(' . $value . ')' ?? '-' }}
                        </option>
                    @endforeach
                </select>

                @error('riasec')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                
                <div id="riasecValidationMessage" class="text-danger mt-2" style="display: none;">
                    {{ $validationMessage }}
                </div>
                
                <div id="riasecMaxLimitMessage" class="text-danger mt-2" style="display: none;">
                    You can select up to three RIASEC values only. Please remove one to add another.
                </div>
            </div>
            
            @if($showGenerateButton)
                <div class="fv-row fv-plugins-icon-container flex-shrink-0" style="min-width: 280px;">
                    <button 
                        id="{{ $generateButtonId }}" 
                        type="button" 
                        class="btn btn-primary d-flex align-items-center gap-2 w-100 justify-content-center h-100"
                        style="min-height: 38px;">
                        <span class="generate-label">{{ $generateButtonText }}</span>
                        <iconify-icon 
                            icon="material-symbols:info-outline" 
                            width="16" 
                            height="16" 
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="{{ $generateTooltipTitle }}">
                        </iconify-icon>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const $riasec = $('#{{ $selectId }}');
    let selectedOrder = [];
    let riasecRequest = null;
    
    // Initialize Select2 for RIASEC selector
    if ($riasec.length) {
        $riasec.select2({
            placeholder: '{{ $placeholder }}',
            allowClear: false,
            maximumSelectionLength: 3,
            width: '100%',
            closeOnSelect: false,
            // Add custom selection handler to prevent 4th selection
            templateSelection: function(data) {
                return data.text;
            }
        });

        // Robust initial selection sync: use data-preselected and DOM selected options
        (function syncInitialSelection() {
            // Prefer preselected dataset from Blade (normalized)
            let preselected = $riasec.data('preselected');
            if (!Array.isArray(preselected)) preselected = [];
            // Also read any <option selected> present in DOM
            const domSelected = $riasec.find('option:selected').map(function() { return this.value; }).get();
            const initialSelected = [...new Set([...(preselected || []), ...(domSelected || [])])];

            if (initialSelected.length) {
                // Delay a tick in case other scripts re-init select2
                setTimeout(function() {
                    const valid = initialSelected.filter(function(val) {
                        return $riasec.find('option[value="' + val + '"]').length > 0;
                    });
                    selectedOrder = [...valid];
                    $riasec.val(valid).trigger('change.select2');
                    reorderOptions();
                    const validationMessage = $('#riasecValidationMessage');
                    const maxLimitMessage = $('#riasecMaxLimitMessage');
                    if (validationMessage.length) {
                        if (valid.length < 3) {
                            validationMessage.show();
                            maxLimitMessage.hide();
                            $riasec.addClass('is-invalid');
                        } else {
                            validationMessage.hide();
                            maxLimitMessage.hide();
                            $riasec.removeClass('is-invalid');
                        }
                    }
                }, 0);
            }
        })();

        // Add event listener to prevent selection beyond 3 items at the Select2 level
        $riasec.on('select2:selecting', function(e) {
            const currentValues = $(this).val() || [];
            const maxLimitMessage = $('#riasecMaxLimitMessage');
            
            // Prevent selection if already at maximum limit (3 items)
            if (currentValues.length >= 3) {
                e.preventDefault();
                
                // Close the dropdown
                $(this).select2('close');
                
                // Show error message
                maxLimitMessage.show();
                $(this).addClass('is-invalid');
                
                return false;
            }
        });

        // Initialize selected order from current values
        selectedOrder = $riasec.val() ? [...$riasec.val()] : [];

        // Handle selection validation and limit to 3 options with inline error message
        $riasec.on('change', function() {
            const selectedValues = $(this).val() || [];
            const validationMessage = $('#riasecValidationMessage');
            const maxLimitMessage = $('#riasecMaxLimitMessage');
            
            // Show error message and prevent selection of 4th item
            if (selectedValues.length > 3) {
                // Show the max limit error message
                maxLimitMessage.show();
                $(this).addClass('is-invalid');
                
                // Remove the last selected item to maintain 3-item limit
                let currentValues = selectedValues.slice(0, 3);
                $(this).val(currentValues).trigger('change.select2');
                return;
            }
            
            // Hide max limit message and remove invalid class if count is exactly 3
            if (selectedValues.length === 3) {
                maxLimitMessage.hide();
                validationMessage.hide();
                $(this).removeClass('is-invalid');
            }
            
            // Validation for minimum 3 selections
            if (selectedValues.length < 3) {
                validationMessage.show();
                $(this).addClass('is-invalid');
                // Hide max limit message when showing min validation
                maxLimitMessage.hide();
            }
        });

        // Handle selection order preservation with 3-item limit enforcement
        $riasec.on('select2:select', function(e) {
            const currentValues = $(this).val() || [];
            const maxLimitMessage = $('#riasecMaxLimitMessage');
            
            // Prevent selection if already at maximum limit (3 items)
            if (currentValues.length > 3) {
                e.preventDefault();
                
                // Show error message
                maxLimitMessage.show();
                $(this).addClass('is-invalid');
                
                // Remove the just-selected item to maintain limit
                const newId = e.params.data.id;
                const limitedValues = currentValues.filter(val => val !== newId);
                $(this).val(limitedValues).trigger('change.select2');
                return false;
            }
            
            const id = e.params.data.id;
            if (!selectedOrder.includes(id)) {
                selectedOrder.push(id);
            }
            reorderOptions();
        });

        // Handle unselection
        $riasec.on('select2:unselect', function(e) {
            const id = e.params.data.id;
            selectedOrder = selectedOrder.filter(val => val !== id);
            reorderOptions();
        });

        // Note: Removed select2:close handler - max limit message should persist after closing dropdown

        // Function to reorder options based on selection order
        function reorderOptions() {
            // Detach all selected <option>s and re-append in order
            const selectedOptions = selectedOrder.map(val =>
                $riasec.find('option[value="' + val + '"]').detach()
            );
            $riasec.append(selectedOptions).trigger('change.select2');
        }
    }

    // Dynamic RIASEC Modal Content Generator for ModalManager
    window.RiasecModalGenerator = {
        // Default template structure for RIASEC options
        defaultTemplate: {
            containerClass: 'manually-radio w-100',
            innerClass: 'd-flex flex-column gap-3 manually-modal-inner h-100',
            titleClass: 'm-0 text-left fw-bolder fs-2 d-flex justify-content-between gap-5 align-items-center',
            badgeClasses: {
                master: 'jd-badge text-center span-truncate master-jd-badge',
                custom: 'jd-badge text-center span-truncate enter-jr-badge',
                default: 'jd-badge text-center span-truncate'
            },
            contentClass: 'modal-content-riasec d-flex flex-column',
            headingClass: 'm-0 heading',
            subHeadingClass: 'm-0 sub-heading',
            paraClass: 'm-0 para'
        },

        // Generate HTML for RIASEC options from JSON data
        generateOptionsHTML: function(data, template = null) {
            const tmpl = template || this.defaultTemplate;
            let html = '';
            
            data.forEach((item, index) => {
                const displayTitle = this.processTitle(item.title, item.jobRole);
                console.log(item,"=============================================================");
                
                const badgeClass = item.badge_class ? `jd-badge text-center span-truncate ${item.badge_class}` : (tmpl.badgeClasses[item.badge_type] || tmpl.badgeClasses.default);

                if (item.show === false || item.show === "false" || item.show === 0 || item.show === "0" || !item.show) {
                    html += `
                        <label class="${tmpl.containerClass} disabled">
                            <input type="radio" name="jdOptionRiasec" value="" id="jdOption${index}" disabled>
                                <div class="placeholder-card">
                                <span class="${badgeClass}">${item.badge}</span>
                                <div>Not Available</div>
                            </div>
                        </label>
                    `;
                } else {
                    html += `
                        <label class="${tmpl.containerClass}">
                            <input type="radio" name="jdOptionRiasec" value="${item.code}" id="jdOption${index}">
                            <div class="${tmpl.innerClass}">
                                <p class="${tmpl.titleClass}" style="overflow-wrap: anywhere;">
                                    <span>${displayTitle}</span>
                                    <span class="${badgeClass}">${item.badge}</span>
                                </p>
                                <div class="line"></div>
                                <div class="${tmpl.contentClass}">
                                    <p class="${tmpl.headingClass}">${item.code}</p>
                                    ${this.generateDetailsHTML(item.details, tmpl)}
                                </div>
                            </div>
                        </label>
                    `;
                }
            });
            
            return html;
        },

        // Generate details section HTML
        generateDetailsHTML: function(details, template) {
            return details.map(detail => `
                <div class="d-flex flex-column">
                    <p class="${template.subHeadingClass}">${detail.sub_heading}</p>
                    <p class="${template.paraClass}">${detail.para}</p>
                </div>
            `).join('');
        },

        // Process title with job role integration
        processTitle: function(title, jobRole) {
            if (title.includes('-')) {
                return title.split('-')[0].trim() + ' ' + (jobRole || '');
            }
            return title;
        },

        // Populate modal with dynamic content
        populateModal: function(data, template = null) {
            const optionsContainer = document.getElementById('dynamic-riasec-options');
            if (optionsContainer) {
                optionsContainer.innerHTML = this.generateOptionsHTML(data, template);
                
                // Re-initialize event handlers after populating content
                this.initializeRadioHandlers();
            }
        },

        // Initialize radio button event handlers
        initializeRadioHandlers: function() {
            const proceedBtn = document.getElementById('proceedBtn');
            const radioButtons = document.querySelectorAll('input[name="jdOptionRiasec"]');
            
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    const anyChecked = document.querySelectorAll('input[name="jdOptionRiasec"]:checked').length > 0;
                    if (proceedBtn) {
                        proceedBtn.disabled = !anyChecked;
                    }

                    // Toggle selected class on outer label to show outline only outside
                    const labels = document.querySelectorAll('label.manually-radio');
                    labels.forEach(lbl => lbl.classList.remove('selected'));
                    const currentLabel = this.closest('label.manually-radio');
                    if (currentLabel) currentLabel.classList.add('selected');
                });
            });
        },

        // Get selected RIASEC code
        getSelectedCode: function() {
            const selectedRadio = document.querySelector('input[name="jdOptionRiasec"]:checked');
            return selectedRadio ? selectedRadio.value : null;
        }
    };

    // Generate RIASEC button click handler
    $('#{{ $generateButtonId }}').on('click', function() {
        const jobProfile = $('#{{ $jobProfileFieldId }}').val();
        const jobDescription = $('#{{ $jobDescriptionFieldId }}').val();
        
        if (!jobProfile || !jobDescription) {
            alert('Please fill in the job profile and job description fields first.');
            return;
        }

        // Show loading state without removing the info icon
        $(this).prop('disabled', true).find('.generate-label').text('Generating...');
        
        // AJAX call to generate RIASEC data
        $.ajax({
            url: '{{ route("get.riasec.data") }}',
            type: 'POST',
            data: {
                type:"{{ $jdType }}",
                job_profile: jobProfile,
                job_description: jobDescription,
                master_id: '{{ $masterId }}',
                current_top3_riasec: '{{ $currentTop3Riasec }}',
                jdTitle:'{{ $jdTitle }}',
                _token: '{{ csrf_token() }}',
                 top3riasec: '{{ $currentTop3Riasec }}',
            },
            success: function(response) {
                console.log(response,"======",response.status_code);
                
                if (response && Array.isArray(response) && response.length > 0) {
                    // Use ModalManager to open the RIASEC modal
                    ModalManager.open({
                        module: 'jobs',
                        key: 'generate_riasec',
                        data: {},
                        onShown: function(modalEl) {
                            // Populate modal with dynamic content after it's shown
                            window.RiasecModalGenerator.populateModal(response);
                        },
                        onSubmit: function(modalEl) {
                            // Handle the proceed button click
                            const selectedCode = window.RiasecModalGenerator.getSelectedCode();
                            if (selectedCode) {
                                updateRiasecDropdown(selectedCode);
                                const bsModal = bootstrap.Modal.getInstance(modalEl);
                                bsModal.hide();
                            }
                        }
                    });
                } else {
                    alert('Failed to generate RIASEC data. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                console.error('RIASEC generation error:', error);
                alert('An error occurred while generating RIASEC data. Please try again.');
            },
            complete: function() {
                // Reset button state and restore label text (icon remains intact)
                const $btn = $('#{{ $generateButtonId }}');
                $btn.prop('disabled', false).find('.generate-label').text('{{ $generateButtonText }}');
            }
        });
    });

    // Function to update RIASEC dropdown with selected code
    function updateRiasecDropdown(selectedCode) {
        if (selectedCode && selectedCode.length >= 3) {
            const codes = selectedCode.split('');
            const $riasecSelect = $('#{{ $selectId }}');
            
            // Clear current selection
            $riasecSelect.val(null).trigger('change');
            selectedOrder = [];
            
            // Add codes in sequence
            codes.forEach((code, index) => {
                if (index < 3) { // Limit to 3 codes
                    selectedOrder.push(code);
                    $riasecSelect.find('option[value="' + code + '"]').prop('selected', true);
                }
            });
            
            // Update the select2 display
            $riasecSelect.trigger('change');
            reorderOptions();
        }
    }



    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>
@endpush