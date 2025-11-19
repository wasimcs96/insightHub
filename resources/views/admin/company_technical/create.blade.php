@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')

@section('styles')
    <style>
        .btn.btn-light-danger,
        .btn-icon.btn-light-danger {
            display: flex;
            padding: 14px 20px !important;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 2px solid #F7941C !important;
            background: #FFF;
            color: #F7941C;
        }

        .btn-icon.btn-light-danger:hover,
        .btn.btn-light-danger:hover:not(.btn-active) {
            background-color: #F7941C !important;
            color: #fff !important;
        }

        .input-group-text i {
            color: #f7941d;
        }

        .btn-light-danger.disabled {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            border: 2px solid #C8C8C9 !important;
            background: #FFF !important;
            color: #C8C8C9 !important;
        }

        .add-level-btn {
            padding: 14px 20px !important;
            gap: 8px;
            background: #fff !important;
            border-radius: 4px;
            border: 1px dashed #F7941C !important;
            color: #F7941C !important;
            width: 100%;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        /* invalid UI */
        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: .875rem;
            margin-top: .25rem;
        }

        .is-invalid+.invalid-feedback {
            display: block;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Add Technical Skill
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/company/sector-skills?tab=title" class="text-muted text-hover-primary"> Company
                            Technical Skills</a>
                    </li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumbText">Create New Technical Skill</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        {{-- Laravel validation errors (server-side) --}}
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('sector.skills.company.store') }}" method="POST" id="techSkillForm" novalidate>
            @csrf
            <input type="hidden" name="custom" value="1">

            <div class="card mb-4">
                <div class="card-header align-items-center">
                    <h3 class="m-0">Add Technical Skill</h3>
                </div>
                <div class="card-body">
                    <div class="mb-7">
                        <label for="name" class="form-label">Technical Skill Title</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">This field is required.</div>
                        @enderror
                    </div>

                    <div class="mb-7">
                        <label for="description" class="form-label">Technical Skill Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">This field is required.</div>
                        @enderror
                    </div>

                    {{-- @php
                    $preselectedCategoryId = request('category_id');
                @endphp      --}}
                    <div class="mb-7">
                        <label for="sector" class="form-label">Technical Skill Sector</label>
                        <select name="sector_id" id="sector" class="form-select @error('sector_id') is-invalid @enderror" required>
                            <option value="">Select Technical Skill Sector</option>
                            @foreach ($sectors as $sector)
                                <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>
                                    {{ $sector->name ?? '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('sector_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">This field is required.</div>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="form-label">Technical Skill Category</label>
                        <select name="category_id" id="category" class="form-select @error('category_id') is-invalid @enderror" required disabled>
                            <option value="">Select Technical Skill Category</option>
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">This field is required.</div>
                        @enderror
                    </div>


                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header align-items-center">
                    <h4 class="m-0">Levels</h4>
                </div>
                <div class="card-body" id="selectedLevels">
                    <!-- Buttons / Level cards injected by JS -->
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header align-items-center">
                    <h3 class="level-title m-0">Create Technical Skill?</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="/admin/company/sector-skills?tab=title" class="btn btn-danger"><i
                                class="bi bi-trash me-1"></i> Discard</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <template id="levelTemplate">
        <div class="level-card mt-5 card mb-5">
            <div class="card-header align-items-center">
                <h3 class="level-title m-0">Level</h3>
                <button type="button" class="btn btn-light-danger remove-level">
                    <iconify-icon icon="ph:trash-bold" width="16" height="16"></iconify-icon>
                </button>
            </div>
            <div class="card-body">
                <div class="mb-7">
                    <label class="form-label mb-5">Level Description</label>
                    <input type="text" class="form-control level-desc-input" placeholder="Level Description">
                    <div class="invalid-feedback">This field is required.</div>
                </div>

                <div class="mb-7">
                    <label class="form-label mb-5">Knowledge</label>
                    <div class="knowledge-group"></div>
                    <button type="button" class="btn btn-primary add-knowledge mt-5">+ Add Knowledge</button>
                </div>

                <div>
                    <label class="form-label mb-5">Abilities</label>
                    <div class="ability-group"></div>
                    <button type="button" class="btn btn-primary add-ability mt-5">+ Add Ability</button>
                </div>
            </div>
        </div>
    </template>

    <div class="modal fade" id="DeleteTechnicalSkillLevelModal" tabindex="-1"
        aria-labelledby="DeleteTechnicalSkillLevelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="position: absolute; right: 15px; top: 10px; z-index: 1;"></button>
                <div class="modal-body text-center pt-4">
                    <iconify-icon icon="ep:warning" width="70" height="70"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="my-5">Clear All Input for This Level?</h4>
                    <p class="mx-12 my-5">You have entered details for this level. Deleting it will <b>remove all inputs
                            and
                            cannot be undone.</b></p>
                    <div class="bg-moda-content">
                        <p class="m-0">Are you sure you want to proceed?</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <button class="btn btn-outline m-0" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary text-white m-0">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let existingLevels = []; // current numeric level list

            /* ---------- helpers to toggle validation UI ---------- */
            function markInvalid(input, message = 'This field is required.') {
                input.classList.add('is-invalid');
                const msg = input.nextElementSibling;
                if (msg && msg.classList.contains('invalid-feedback')) msg.textContent = message;
            }

            function clearInvalid(input) {
                input.classList.remove('is-invalid');
            }

            // clear errors live as user types (delegated so it works for dynamic inputs)
            document.getElementById('selectedLevels').addEventListener('input', (e) => {
                const el = e.target;
                if (el.matches('input[type="text"], textarea')) {
                    if (el.value.trim() !== '') clearInvalid(el);
                }
            });

            // also clear for the top form fields
            document.querySelectorAll('#name, #description, #category, #sector').forEach(el => {
                el.addEventListener('input', () => {
                    if (el.value.trim() !== '') clearInvalid(el);
                });
                el.addEventListener('change', () => {
                    if (el.value.trim() !== '') clearInvalid(el);
                });
            });

            /* ---------- Add Level button ---------- */
            function createAddLevelButton(level) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'add-level-btn';
                btn.dataset.level = level;
                btn.textContent = `Add Level ${level}`;
                btn.addEventListener('click', function() {
                    addLevel(level);
                });
                return btn;
            }

            /* ---------- Remove buttons enable/disable ---------- */
            function updateRemoveButtons() {
                const cards = document.querySelectorAll('.level-card');
                const count = cards.length;

                cards.forEach((card, index) => {
                    const removeBtn = card.querySelector('.remove-level');
                    if (!removeBtn) return;

                    if (count === 1) {
                        removeBtn.disabled = true;
                        removeBtn.classList.add('disabled');
                    } else if (count === 2) {
                        removeBtn.disabled = false;
                        removeBtn.classList.remove('disabled');
                    } else {
                        if (index === 0 || index === count - 1) {
                            removeBtn.disabled = false;
                            removeBtn.classList.remove('disabled');
                        } else {
                            removeBtn.disabled = true;
                            removeBtn.classList.add('disabled');
                        }
                    }
                });
            }

            /* ---------- Insert card in numeric order ---------- */
            function insertLevelCard(levelCard, level) {
                const container = document.getElementById('selectedLevels');
                const levelCards = Array.from(container.querySelectorAll('.level-card'));
                const addButtons = Array.from(container.querySelectorAll('.add-level-btn'));

                let insertBeforeEl = null;

                for (const card of levelCards) {
                    const cardLevel = parseInt(card.id.replace('level-card-', ''));
                    if (cardLevel > level) {
                        insertBeforeEl = card;
                        break;
                    }
                }
                if (!insertBeforeEl) {
                    for (const button of addButtons) {
                        const buttonLevel = parseInt(button.dataset.level);
                        if (buttonLevel > level) {
                            insertBeforeEl = button;
                            break;
                        }
                    }
                }
                if (insertBeforeEl) container.insertBefore(levelCard, insertBeforeEl);
                else container.appendChild(levelCard);
            }

            /* ---------- Add a level card ---------- */
            function addLevel(level) {
                const template = document.querySelector('#levelTemplate');
                const clone = template.content.cloneNode(true);
                const levelCard = clone.querySelector('.level-card');
                levelCard.id = `level-card-${level}`;
                clone.querySelector('.level-title').textContent = `Level ${level}`;

                // description field
                const descInput = clone.querySelector('.level-desc-input');
                descInput.name = `level_${level}_description`;
                descInput.setAttribute('required', 'required');

                const knowledgeGroup = clone.querySelector('.knowledge-group');
                const abilityGroup = clone.querySelector('.ability-group');

                // helper: add input row (with error node)
                const createInputRow = (group, type) => {
                    if (group.querySelectorAll('input').length >= 6) return;
                    const row = document.createElement('div');
                    row.className = 'd-flex align-items-center mb-2';
                    row.innerHTML = ` 
                    <button type="button" class="btn btn-icon btn-light-danger me-5" onclick="this.parentElement.remove()">
                        <iconify-icon icon="ph:trash-bold" width="16" height="16"></iconify-icon>
                    </button>
                    <div class="flex-grow-1">
                        <input type="text" class="form-control"
                            name="level_${level}_${type}[]"
                            placeholder="Enter ${type.charAt(0).toUpperCase() + type.slice(1)}">
                        <div class="invalid-feedback">This field is required.</div>
                    </div>
                `;
                    group.appendChild(row);

                    // Add event listener to dynamically added inputs
                    const newInput = row.querySelector('input');
                    newInput.addEventListener('input', function() {
                        if (this.value.trim() !== '') {
                            clearInvalid(this); // Clear validation when user types
                        }
                    });
                };

                // initial one row each
                createInputRow(knowledgeGroup, 'knowledge');
                createInputRow(abilityGroup, 'ability');

                // add-more handlers
                clone.querySelector('.add-knowledge').addEventListener('click', function() {
                    createInputRow(knowledgeGroup, 'knowledge');
                });
                clone.querySelector('.add-ability').addEventListener('click', function() {
                    createInputRow(abilityGroup, 'ability');
                });

                // remove-level handler
                clone.querySelector('.remove-level').addEventListener('click', function() {
                    const hasInputValues = () => {
                        if (descInput.value.trim() !== '') return true;
                        const kInputs = levelCard.querySelectorAll(
                            '.knowledge-group input[type="text"]');
                        for (const i of kInputs) {
                            if (i.value.trim() !== '') return true;
                        }
                        const aInputs = levelCard.querySelectorAll('.ability-group input[type="text"]');
                        for (const i of aInputs) {
                            if (i.value.trim() !== '') return true;
                        }
                        return false;
                    };

                    if (hasInputValues()) {
                        const deleteModal = new bootstrap.Modal(document.getElementById(
                            'DeleteTechnicalSkillLevelModal'));
                        const confirmBtn = deleteModal._element.querySelector('.btn-primary');

                        const cardToRemove = levelCard;
                        const levelToRemove = level;

                        confirmBtn.onclick = function() {
                            cardToRemove.remove();
                            existingLevels = existingLevels.filter(l => l !== levelToRemove);
                            updateLevelDisplay();
                            updateRemoveButtons();
                            deleteModal.hide();
                            confirmBtn.onclick = null;
                        };

                        deleteModal.show();
                    } else {
                        levelCard.remove();
                        existingLevels = existingLevels.filter(l => l !== level);
                        updateLevelDisplay();
                        updateRemoveButtons();
                    }
                });

                // place it in the right spot
                insertLevelCard(levelCard, level);

                // track level numbers
                if (!existingLevels.includes(level)) {
                    existingLevels.push(level);
                    existingLevels.sort((a, b) => a - b);
                }

                updateLevelDisplay();
                updateRemoveButtons();
            }

            /* ---------- Render Add Level buttons ---------- */
            function updateLevelDisplay() {
                const container = document.getElementById('selectedLevels');

                // remove all buttons
                container.querySelectorAll('.add-level-btn').forEach(btn => btn.remove());

                // if no levels, show Add Level 1
                if (existingLevels.length === 0) {
                    container.appendChild(createAddLevelButton(1));
                    return;
                }

                const firstLevel = existingLevels[0];
                if (firstLevel > 1) {
                    const prevLevel = firstLevel - 1;
                    if (prevLevel >= 1) container.insertBefore(createAddLevelButton(prevLevel), container
                        .firstChild);
                }

                for (let i = 0; i < existingLevels.length - 1; i++) {
                    const current = existingLevels[i];
                    const next = existingLevels[i + 1];
                    if (next - current > 1) {
                        const nextCard = document.getElementById(`level-card-${next}`);
                        if (nextCard) nextCard.before(createAddLevelButton(current + 1));
                    }
                }

                const lastLevel = existingLevels[existingLevels.length - 1];
                if (lastLevel < 6) container.appendChild(createAddLevelButton(lastLevel + 1));
            }

            /* ---------- Client-side validation for levels ---------- */
            function validateLevelFields() {
                let valid = true;
                const levelCards = document.querySelectorAll('.level-card');

                levelCards.forEach(card => {
                    const descInput = card.querySelector('.level-desc-input');
                    const knowledgeInputs = card.querySelectorAll('.knowledge-group input');
                    const abilityInputs = card.querySelectorAll('.ability-group input');

                    // Validate Level Description
                    if (!descInput.value.trim()) {
                        markInvalid(descInput);
                        valid = false;
                    }

                    // Validate Knowledge Inputs
                    knowledgeInputs.forEach(input => {
                        if (!input.value.trim()) {
                            markInvalid(input);
                            valid = false;
                        }
                    });

                    // Validate Ability Inputs
                    abilityInputs.forEach(input => {
                        if (!input.value.trim()) {
                            markInvalid(input);
                            valid = false;
                        }
                    });
                });

                return valid;
            }

            /* ---------- Initialize ---------- */
            updateLevelDisplay();
            updateRemoveButtons();
            
            // Check if we have old level data to restore (validation errors)
            const hasOldLevelData = @json(old());
            
            // Filter level-related data from old input
            const levelKeys = Object.keys(hasOldLevelData).filter(key => key.startsWith('level_'));
            
            if (levelKeys.length > 0) {
                // Restore old level data
                const levelNumbers = new Set();
                levelKeys.forEach(key => {
                    const match = key.match(/level_(\d+)_/);
                    if (match) levelNumbers.add(parseInt(match[1]));
                });
                
                [...levelNumbers].sort().forEach(level => {
                    addLevel(level);
                    const card = document.getElementById(`level-card-${level}`);
                    if (card) {
                        // Restore description
                        const descInput = card.querySelector('.level-desc-input');
                        if (descInput && hasOldLevelData[`level_${level}_description`]) {
                            descInput.value = hasOldLevelData[`level_${level}_description`];
                        }
                        
                        // Restore knowledge
                        const knowledgeGroup = card.querySelector('.knowledge-group');
                        const knowledgeData = hasOldLevelData[`level_${level}_knowledge`] || [];
                        knowledgeGroup.innerHTML = ''; // Clear initial
                        knowledgeData.forEach(knowledge => {
                            const row = document.createElement('div');
                            row.className = 'd-flex align-items-center mb-2';
                            row.innerHTML = ` 
                                <button type="button" class="btn btn-icon btn-light-danger me-5" onclick="this.parentElement.remove()">
                                    <iconify-icon icon="ph:trash-bold" width="16" height="16"></iconify-icon>
                                </button>
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control" name="level_${level}_knowledge[]" 
                                           placeholder="Enter Knowledge" value="${knowledge}">
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            `;
                            knowledgeGroup.appendChild(row);
                        });
                        
                        // Restore abilities
                        const abilityGroup = card.querySelector('.ability-group');
                        const abilityData = hasOldLevelData[`level_${level}_ability`] || [];
                        abilityGroup.innerHTML = ''; // Clear initial
                        abilityData.forEach(ability => {
                            const row = document.createElement('div');
                            row.className = 'd-flex align-items-center mb-2';
                            row.innerHTML = ` 
                                <button type="button" class="btn btn-icon btn-light-danger me-5" onclick="this.parentElement.remove()">
                                    <iconify-icon icon="ph:trash-bold" width="16" height="16"></iconify-icon>
                                </button>
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control" name="level_${level}_ability[]" 
                                           placeholder="Enter Ability" value="${ability}">
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            `;
                            abilityGroup.appendChild(row);
                        });
                    }
                });
            } else {
                addLevel(1); // Always start with Level 1 if no old data
            }

            // Guard submit: ensure at least one level and it's valid
            document.getElementById('techSkillForm').addEventListener('submit', function(e) {
                let isValid = true;

                // Validate the main form fields (name, description, category)
                ['#name', '#description', '#category','#sector'].forEach(sel => {
                    const el = document.querySelector(sel);
                    if (!el.value.trim()) {
                        markInvalid(el);
                        isValid = false;
                    } else {
                        clearInvalid(el); // Clear invalid class when user types something
                    }
                });

                // Validate all levels
                if (!validateLevelFields()) {
                    isValid = false;
                }

                // Prevent form submission if invalid
                if (!isValid) {
                    e.preventDefault();
                    const firstInvalid = document.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });


            // Handle preserving old values on validation errors
            const oldSectorId = '{{ old('sector_id') }}';
            const oldCategoryId = '{{ old('category_id') }}';
            
            // If there's an old sector value, trigger the category loading
            if (oldSectorId) {
                setTimeout(function() {
                    $('#sector').val(oldSectorId).trigger('change');
                }, 100);
            }

            $(document).on('change', '#sector', function() {
                const sectorId = $(this).val();
                const $category = $('#category');

                console.log('Sector changed to:', sectorId);
                console.log('Old category ID:', oldCategoryId);

                // Reset category select to a loading/empty state
                $category.prop('disabled', true).empty()
                    .append('<option value="">Loading...</option>');

                // No sector selected → reset and disable category
                if (!sectorId) {
                    $category.empty()
                        .append('<option value="">Select Technical Skill Category</option>')
                        .prop('disabled', true);
                    return;
                }

                $.ajax({
                    url: '/admin/ajax/technical-skill-category/' + sectorId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log('Categories response:', response);
                        $category.empty().append(
                            '<option value="">Select Technical Skill Category</option>');

                        if (Array.isArray(response) && response.length) {
                            response.forEach(function(category) {
                                const selected = oldCategoryId == category.id ? ' selected' : '';
                                console.log('Category ID:', category.id, 'Selected:', selected);
                                $category.append(
                                    '<option value="' + category.id + '"' + selected + '>' + (
                                        category.title || '') + '</option>'
                                );
                            });
                            $category.prop('disabled', false);
                            
                            // Double-check the selection after adding all options
                            if (oldCategoryId) {
                                $category.val(oldCategoryId);
                            }
                        } else {
                            $category.append(
                                '<option value="">No categories available</option>');
                            $category.prop('disabled', true);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', xhr, status, error);
                        $category.empty()
                            .append('<option value="">Failed to load categories</option>')
                            .prop('disabled', true);
                        alert('Failed to fetch categories');
                    }
                });
            });


        });
    </script>
@endsection
