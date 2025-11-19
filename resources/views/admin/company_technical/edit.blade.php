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

        /* .level-card {
                                                    border: 2px dashed #f7941d;
                                                    padding: 20px;
                                                    margin-bottom: 20px;
                                                    border-radius: 6px;
                                                } */

        .btn-light-danger.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: #f8f9fa !important;
            color: #6c757d !important;
            border-color: #dee2e6 !important;
        }

        .add-level-btn {
            padding: 14px 20px;
            gap: 8px;
            background: #fff;
            border-radius: 4px;
            border: 1px dashed #F7941C;
            color: #F7941C;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        #OverwriteCompanySkillConfirmModal h4 {
            color: #071437;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }

        #OverwriteCompanySkillConfirmModal p {
            color: #071437;
            text-align: center;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: 24px;
        }

        .custom-btn {
            /* height: 35px; */
            padding: 14px 20px;
            background: #F7941C;
            justify-content: center;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            width: fit-content;
        }

        .custom-btn.orange-fill,
        .orange-fill-popup {
            background: #F7941C;
            color: #FFF;
            border: 1px solid #F7941C !important;
        }

        .grey-outline-popup {
            border: 1px solid #99A1B7 !important;
            background: #FFF;
            color: #78829D;

        }

        .bg-modal-content {
            padding: 12px 18px;
            background: #F1F1F4;
            color: #071437;
            text-align: center;
            margin-bottom: 24px;
            overflow: scroll;
            max-height: 144px;
        }

        .bg-modal-content p {
            font-size: 14px !important;
            font-weight: 400 !important;
            line-height: 20px !important;
        }

        .readonly-select {
            pointer-events: none;
            background-color: #e9ecef;
            /* mimic disabled */
        }
    </style>
@endsection

@section('content')
    @php
        if (request()->get('skill_type') == 0) {
            $pageTitle = 'Create Company Skill';
            $skillTitle = $skill->name ?? '';
        } else {
            $skillTitle = old('name', old('new_title', $skill->name ?? ''));
            $pageTitle = 'Edit Technical Skill - ' . (request()->get('duplicate') === '1' ? 'Create New' : 'Overwrite');
        }

    @endphp
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    {{-- {{Edit Technical Skill - {{ request()->get('duplicate') ? 'Duplicate' : 'Overwrite' }}}} --}}
                    {{ $pageTitle ?? '' }}
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/company/sector-skills?tab=title" class="text-muted text-hover-primary"> Company
                            Technical Skills</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    {{-- <li class="breadcrumb-item text-muted" id="breadcrumbText">@if (request()->get('skill_type') == 0) Create Company Skill @else  @endif</li> --}}
                    <li class="breadcrumb-item text-muted" id="breadcrumbText">{{ $pageTitle ?? '' }}</li>

                </ul>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <form action="{{ route('sector.skills.company.update', $skill->id) }}" id="editForm" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="custom" value="1">
            <input type="hidden" name="is_duplicate" value="{{ request()->get('duplicate') }}">
            <input type="hidden" name="type" value="{{ request()->get('skill_type') }}">
            <input type="hidden" name="current_skill_id" value="{{$skill->id ?? ''}}">


            <div class="card mb-4">
                <div class="card-header align-items-center">
                    <h3 class="m-0">
                        {{ $pageTitle ?? '' }}

                        {{-- Edit Technical Skill - {{ request()->get('duplicate') ? 'Duplicate' : 'Overwrite' }} --}}
                    </h3>
                </div>
                <div class="card-body">
                    {{-- <div class="mb-7">
                        <label for="name" class="form-label">Technical Skill Title</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $skillTitle ?? '' }}" required>

                    </div> --}}
                    <div class="mb-7">
                        <label for="name" class="form-label">Technical Skill Title</label>
                        <input
                            type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ $skillTitle ?? '' }}"required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-7">
                        <label for="description" class="form-label">Technical Skill Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control" required>{{ old('description', $skill->description ?? '') }}</textarea>
                    </div>

                    {{-- <div>
                        <label for="category" class="form-label">Technical Skill Category</label>
                        <select name="category_id" id="category" class="form-select"
                            {{ isset($skill) && $skill->category_id ? 'disabled' : '' }}>
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ isset($skill) && $skill->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Hidden input to ensure the category_id is sent in the request -->
                        <input type="hidden" name="category_id" value="{{ isset($skill) ? $skill->category_id : '' }}">
                    </div> --}}
                    @php
                        $selectedSectorId = old('sector_id', $skill->sector->id ?? '');
                        $selectedCategoryId = old('category_id', $skill->category->id ?? '');
                        $lockSelections = $selectedSectorId && $selectedCategoryId; // lock only if both exist
                    @endphp
                    {{-- {{ dd($selectedCategoryId) }} --}}
                    <div class="mb-7">
                        <label for="sector" class="form-label">Technical Skill Sector</label>
                        <select name="sector_id" id="sector"
                            class="form-select {{ $lockSelections ? 'readonly-select' : '' }}" required>
                            <option value="">Select Technical Skill Sector</option>
                            @foreach ($sectors as $sector)
                                <option value="{{ $sector->id }}"
                                    {{ (string) $sector->id === (string) $selectedSectorId ? 'selected' : '' }}>
                                    {{ $sector->name ?? '' }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">This field is required.</div>
                        {{-- No hidden input needed since we are NOT disabling --}}
                    </div>

                    <div>
                        <label for="category" class="form-label">Technical Skill Category</label>
                        <select name="category_id" id="category"
                            class="form-select {{ $lockSelections ? 'readonly-select' : '' }}" required>
                            <option value="">Select Technical Skill Category</option>
                            {{-- Options will be populated by JS --}}
                        </select>
                        <div class="invalid-feedback">This field is required.</div>
                    </div>


                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header align-items-center">
                    <h4 class="m-0">Levels</h4>
                </div>
                <div class="card-body" id="selectedLevels">
                    @php
                        // Determine existing levels from model AND from old input (in case of validation fail)
                        $existingLevels = [];
                        for ($i = 1; $i <= 6; $i++) {
                            $desc_old = old('level_' . $i . '_description', null);
                            $know_old = old('level_' . $i . '_knowledge', null);
                            $abil_old = old('level_' . $i . '_ability', null);

                            $desc_model = $skill->{'level_' . $i . '_description'} ?? '';
                            $know_model = $skill->{'level_' . $i . '_knowledge'} ?? '';
                            $abil_model = $skill->{'level_' . $i . '_ability'} ?? '';

                            $hasOld = false;
                            if (!is_null($desc_old) && $desc_old !== '') $hasOld = true;
                            if (is_array($know_old) && count(array_filter($know_old)) > 0) $hasOld = true;
                            if (!is_array($know_old) && !is_null($know_old) && $know_old !== '') $hasOld = true;
                            if (is_array($abil_old) && count(array_filter($abil_old)) > 0) $hasOld = true;
                            if (!is_array($abil_old) && !is_null($abil_old) && $abil_old !== '') $hasOld = true;

                            if ($hasOld || !empty($desc_model) || !empty($know_model) || !empty($abil_model)) {
                                $existingLevels[] = $i;
                            }
                        }
                        // Ensure deterministic order
                        sort($existingLevels);
                    @endphp

                    @foreach ($existingLevels as $index => $level)
                        @php
                            // Prefer old() values if present (old can be array for knowledge/ability)
                            $desc_model = $skill->{'level_' . $level . '_description'} ?? '';
                            $know_model = $skill->{'level_' . $level . '_knowledge'} ?? '';
                            $abil_model = $skill->{'level_' . $level . '_ability'} ?? '';

                            $desc = old('level_' . $level . '_description', $desc_model);
                            $know_old = old('level_' . $level . '_knowledge', null);
                            $abil_old = old('level_' . $level . '_ability', null);

                            if (!is_null($know_old)) {
                                // old value may be an array
                                $know_values = is_array($know_old) ? array_filter($know_old) : preg_split('/\s*;\s*/', $know_old);
                            } else {
                                $know_values = $know_model !== '' ? preg_split('/\s*;\s*/', $know_model) : [];
                            }

                            if (!is_null($abil_old)) {
                                $abil_values = is_array($abil_old) ? array_filter($abil_old) : preg_split('/\s*;\s*/', $abil_old);
                            } else {
                                $abil_values = $abil_model !== '' ? preg_split('/\s*;\s*/', $abil_model) : [];
                            }
                        @endphp

                        <div class="level-card mt-5 card mb-5" id="level-card-{{ $level }}">
                            <!-- Your existing level card content here -->
                            <div class="card-header align-items-center">
                                <h3 class="level-title m-0">Level {{ $level }}</h5>
                                    <button type="button"
                                        class="btn btn-light-danger remove-level btn-delete-level"><iconify-icon
                                            icon="ph:trash-bold" width="16" height="16"></iconify-icon></button>
                            </div>
                            <div class="card-body">
                                <div class="mb-7">
                                    <label class="form-label mb-6">Level Description</label>
                                    <input type="text" class="form-control level-desc-input"
                                        name="level_{{ $level }}_description"
                                        value="{{ old('level_' . $level . '_description', $desc) }}">
                                </div>

                                <div class="mb-7">
                                    <label class="form-label mb-6">Knowledge</label>
                                    <div class="knowledge-group">
                                        @foreach ($know_values as $knowledge)
                                            @if(trim($knowledge) === '')
                                                @continue
                                            @endif
                                            <div class="d-flex align-items-center mb-6">
                                                <button type="button" class="btn btn-icon btn-light-danger me-5"
                                                    onclick="this.parentElement.remove()">
                                                    <iconify-icon icon="ph:trash-bold" width="16"
                                                        height="16"></iconify-icon>
                                                </button>
                                                <input type="text" class="form-control"
                                                    name="level_{{ $level }}_knowledge[]"
                                                    value="{{ $knowledge }}">

                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary add-knowledge">+ Add
                                        Knowledge</button>
                                </div>

                                <div>
                                    <label class="form-label mb-6">Abilities</label>
                                    <div class="ability-group">
                                        @foreach ($abil_values as $ability)
                                            @if(trim($ability) === '')
                                                @continue
                                            @endif
                                            <div class="d-flex align-items-center mb-6">
                                                <button type="button" class="btn btn-icon btn-light-danger me-5"
                                                    onclick="this.parentElement.remove()">
                                                    <iconify-icon icon="ph:trash-bold" width="16"
                                                        height="16"></iconify-icon>
                                                </button>
                                                <input type="text" class="form-control"
                                                    name="level_{{ $level }}_ability[]"
                                                    value="{{ $ability }}">

                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary add-ability">+ Add
                                        Ability</button>
                                </div>
                            </div>
                        </div>

                        @php
                            $nextLevel = $level + 1;
                            $showAddButton = false;
                            $buttonLevel = null;

                            for ($i = 1; $i <= 6; $i++) {
                                if (!in_array($i, $existingLevels)) {
                                    $buttonLevel = $i;
                                    break;
                                }
                            }

                            if ($buttonLevel && $buttonLevel == $level + 1) {
                                $showAddButton = true;
                            }

                            if (empty($existingLevels) && $index === 0) {
                                $showAddButton = true;
                                $buttonLevel = 1;
                            }
                        @endphp

                        @if ($showAddButton)
                            <button type="button" class="w-100 add-level-btn"
                                data-next-level="{{ $buttonLevel }}"><iconify-icon icon="ic:round-plus" width="16"
                                    height="16"></iconify-icon> Add Level
                                {{ $buttonLevel }}</button>
                        @endif
                    @endforeach

                    @if (empty($existingLevels))
                        <button type="button" class="w-100 add-level-btn" data-next-level="1"><iconify-icon
                                icon="ic:round-plus" width="16" height="16"></iconify-icon> Add Level
                            1</button>
                    @endif
                </div>
            </div>


            <div class="card mt-4">
                <div class="card-header align-items-center">
                    <h3 class="level-title m-0">Create Technical Skill?</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary" id="submitBtn">Confirm Changes</button>
                        {{-- <button type="submit" id="realSubmitBtn" style="display: none;"></button> --}}
                        <a href="{{ route('sector.skills.company.view', ['id' => $skill->id]) }}" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> Discard
                        </a>
                    </div>
                </div>
            </div>


        </form>
    </div>

    <template id="levelTemplate">
        <div class="level-card mt-5 card mb-5">
            <div class="card-header align-items-center">
                <h3 class="level-title m-0">Level</h5>
                    <button type="button" class="btn btn-light-danger remove-level"><iconify-icon icon="ph:trash-bold"
                            width="16" height="16"></iconify-icon></button>
            </div>
            <div class="card-body">
                <div class="mb-7">
                    <label class="form-label mb-5">Level Description</label>
                    <input type="text" class="form-control level-desc-input" placeholder="Level Description">
                </div>

                <div class="mb-7">
                    <label class="form-label mb-5">Knowledge</label>
                    <div class="knowledge-group"></div>
                    <button type="button" class="btn btn-primary add-knowledge mt-5" data-initialized="false">+ Add Knowledge</button>
                </div>

                <div>
                    <label class="form-label mb-5">Abilities</label>
                    <div class="ability-group"></div>
                    <button type="button" class="btn btn-primary add-ability mt-5" data-initialized="false">+ Add Ability</button>
                </div>
            </div>
        </div>
    </template>

    <div class="modal fade" id="OverwriteCompanySkillConfirmModal" tabindex="-1" aria-labelledby="EditTsfromMSLLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 610px;">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style=" position: absolute; right: 15px; top: 10px; z-index: 1;"></button>
                <div class="modal-body text-center pt-4">
                    <iconify-icon icon="ep:warning" width="70" height="70"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="my-5">Overwrite Technical Skill?</h4>
                    <p class="mx-12 my-5">You're about to overwrite the localised version of <b
                            id="overwriteCompanySkillName">Aircraft Dispatch</b> in the skill library. <br><br> This action
                        will update the skill details across all associated job descriptions listed below.</p>
                    <div class="bg-modal-content">
                        <p class="m-0" id="affectedJobList">
                            @if ($jobs->isNotEmpty())
                                {{ $jobs->pluck('title')->implode(', ') }}
                            @else
                                No jobs are associated with this skill.
                            @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <button class="custom-btn grey-outline-popup" data-bs-dismiss="modal">Cancel</button>
                        <button id="OverwriteContinueEditSkillBtn" class="custom-btn orange-fill">Overwrite</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ==========================================
    // GLOBAL VARIABLES AND STATE MANAGEMENT
    // ==========================================
    window.hasTriedSubmit = false;
    window.validationRound = 0;
    
    let originalFormState = {};
    let isFormChanged = false;
    
    const $sector = $('#sector');
    const $category = $('#category');
    const LOCK = @json((bool) $lockSelections);
    const initialSectorId = @json((string) $selectedSectorId);
    const initialCategoryId = @json((string) $selectedCategoryId);
    const form = document.getElementById('editForm');
    // ==========================================
    // FORM VALIDATION FUNCTIONS
    // ==========================================
    function clearLevelErrors(levelCard) {
        levelCard.querySelectorAll('.invalid-feedback').forEach(n => n.remove());
        levelCard.querySelectorAll('.is-invalid').forEach(n => n.classList.remove('is-invalid'));
    }

    function addInlineError(targetEl, msg) {
        targetEl.classList.add('is-invalid');
        const fb = document.createElement('div');
        fb.className = 'invalid-feedback d-block';
        fb.textContent = msg;
        targetEl.insertAdjacentElement('afterend', fb);
    }

    function addGroupError(groupEl, msg) {
        const fb = document.createElement('div');
        fb.className = 'invalid-feedback d-block mt-2';
        fb.textContent = msg;

        const next = groupEl.nextElementSibling;
        if (next && next.matches('button.add-knowledge, button.add-ability, .add-knowledge, .add-ability')) {
            next.before(fb);
        } else {
            groupEl.insertAdjacentElement('afterend', fb);
        }
    }

    function ensureNoDuplicateGroupError(groupEl) {
        const next = groupEl.nextElementSibling;
        if (next && next.classList.contains('invalid-feedback')) next.remove();
    }

    function validateGroup(groupEl, labelText = 'This field', opts = { enforceAll: false }) {
        const inputs = Array.from(groupEl.querySelectorAll('input[type="text"]'));
        const currentRound = window.validationRound;

        const eligible = opts.enforceAll ? 
            inputs : 
            inputs.filter(inp => Number(inp.dataset.round || 0) < currentRound);

        eligible.forEach(inp => {
            const empty = (inp.value || '').trim() === '';
            inp.classList.toggle('is-invalid', empty);
        });

        const checkSet = opts.enforceAll ? inputs : eligible;
        const allFilled = checkSet.length > 0 && checkSet.every(inp => (inp.value || '').trim() !== '');

        ensureNoDuplicateGroupError(groupEl);
        if (!allFilled) {
            addGroupError(groupEl, 'This field is required.');
            return false;
        }
        return true;
    }

    function validateAllLevels() {
        const levelCards = Array.from(document.querySelectorAll('.level-card'));
        let firstErrorEl = null;
        let allValid = true;

        levelCards.forEach((levelCard) => {
            clearLevelErrors(levelCard);

            const descInput = levelCard.querySelector('.level-desc-input');
            if (!descInput || !descInput.value.trim()) {
                allValid = false;
                addInlineError(descInput, 'This field is required.');
                if (!firstErrorEl) firstErrorEl = descInput;
            }

            const knowledgeGroup = levelCard.querySelector('.knowledge-group');
            if (!validateGroup(knowledgeGroup, 'Knowledge', { enforceAll: true })) {
                allValid = false;
                if (!firstErrorEl) firstErrorEl = knowledgeGroup;
            }

            const abilityGroup = levelCard.querySelector('.ability-group');
            if (!validateGroup(abilityGroup, 'Ability', { enforceAll: true })) {
                allValid = false;
                if (!firstErrorEl) firstErrorEl = abilityGroup;
            }
        });

        return { valid: allValid, firstErrorEl };
    }

    // ==========================================
    // IMPROVED FORM CHANGE DETECTION
    // ==========================================
    function captureFormState() {
        const formData = {};
        
        // Capture regular form fields
        form.querySelectorAll('input:not([type="hidden"]), select, textarea').forEach(field => {
            if (field.type === 'checkbox' || field.type === 'radio') {
                formData[field.name || field.id] = field.checked;
            } else {
                formData[field.name || field.id] = field.value || '';
            }
        });
        
        // Capture level card data with more detailed tracking
        document.querySelectorAll('.level-card').forEach(card => {
            const levelId = card.id;
            const knowledgeInputs = Array.from(card.querySelectorAll('.knowledge-group input[type="text"]'));
            const abilityInputs = Array.from(card.querySelectorAll('.ability-group input[type="text"]'));
            
            formData[levelId] = {
                description: card.querySelector('.level-desc-input')?.value || '',
                knowledge: knowledgeInputs.map(input => (input.value || '').trim()).filter(v => v !== ''),
                abilities: abilityInputs.map(input => (input.value || '').trim()).filter(v => v !== '')
            };
        });
        
        console.log('Captured form state:', formData);
        return formData;
    }

    function hasFormChanged() {
        const currentState = captureFormState();
        
        console.log('Comparing states...');
        console.log('Original:', originalFormState);
        console.log('Current:', currentState);
        
        // Compare regular fields
        for (const [key, value] of Object.entries(currentState)) {
            if (typeof value === 'object' && value !== null) {
                // Handle level data comparison
                const original = originalFormState[key];
                if (!original) {
                    console.log(`Level ${key} is new`);
                    return true;
                }
                
                if (original.description !== value.description) {
                    console.log(`Description changed for ${key}`);
                    return true;
                }
                
                if (JSON.stringify(original.knowledge.sort()) !== JSON.stringify(value.knowledge.sort())) {
                    console.log(`Knowledge changed for ${key}`);
                    return true;
                }
                
                if (JSON.stringify(original.abilities.sort()) !== JSON.stringify(value.abilities.sort())) {
                    console.log(`Abilities changed for ${key}`);
                    return true;
                }
            } else if (originalFormState[key] !== value) {
                console.log(`Field ${key} changed from "${originalFormState[key]}" to "${value}"`);
                return true;
            }
        }
        
        // Check if level cards were added/removed
        const originalLevelKeys = Object.keys(originalFormState).filter(k => k.startsWith('level-card-'));
        const currentLevelKeys = Object.keys(currentState).filter(k => k.startsWith('level-card-'));
        
        if (originalLevelKeys.length !== currentLevelKeys.length) {
            console.log('Number of levels changed');
            return true;
        }
        
        // Check if level numbers changed
        const originalLevels = originalLevelKeys.sort();
        const currentLevels = currentLevelKeys.sort();
        
        if (JSON.stringify(originalLevels) !== JSON.stringify(currentLevels)) {
            console.log('Level numbers changed');
            return true;
        }
        
        console.log('No changes detected');
        return false;
    }

    // ==========================================
    // SECTOR/CATEGORY DROPDOWN MANAGEMENT
    // ==========================================
    function setCatState(disabled, placeholder) {
        const shouldDisable = LOCK ? false : !!disabled;
        $category.prop('disabled', shouldDisable)
            .empty()
            .append('<option value="">' + (placeholder || 'Select Technical Skill Category') + '</option>');
    }

    function fetchCategories(sectorIds, preselectId) {
        if (!sectorIds) {
            setCatState(true);
            return;
        }
        const list = Array.isArray(sectorIds) ? sectorIds.join(',') : sectorIds;

        setCatState(true, 'Loading...');
        $.ajax({
            url: '/admin/ajax/technical-skill-category/' + list,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $category.prop('disabled', false);
                $category.empty().append('<option value="">Select Technical Skill Category</option>');

                if (!Array.isArray(res) || !res.length) {
                    setCatState(false, 'No categories available');
                    return;
                }

                res.forEach(function(c) {
                    const opt = $('<option/>', {
                        value: c.id,
                        text: c.title || ''
                    });
                    if (preselectId && String(c.id) === String(preselectId)) {
                        opt.prop('selected', true);
                    }
                    $category.append(opt);
                });
            },
            error: function() {
                setCatState(false, 'Failed to load categories');
                console.error('Failed to fetch categories');
            }
        });
    }

    // ==========================================
    // LEVEL MANAGEMENT FUNCTIONS (keeping existing ones)
    // ==========================================
    function updateRemoveButtons() {
        const levelCards = document.querySelectorAll('.level-card');
        const levelCount = levelCards.length;

        levelCards.forEach((card, index) => {
            const removeBtn = card.querySelector('.remove-level');
            if (!removeBtn) return;

            if (levelCount === 1) {
                removeBtn.disabled = true;
                removeBtn.classList.add('disabled');
            } else if (levelCount === 2) {
                removeBtn.disabled = false;
                removeBtn.classList.remove('disabled');
            } else {
                if (index === 0 || index === levelCount - 1) {
                    removeBtn.disabled = false;
                    removeBtn.classList.remove('disabled');
                } else {
                    removeBtn.disabled = true;
                    removeBtn.classList.add('disabled');
                }
            }
        });
    }

    function updateAddLevelButtons() {
        document.querySelectorAll('.add-level-btn').forEach(btn => btn.remove());

        const existingLevels = Array.from(document.querySelectorAll('.level-card'))
            .map(card => parseInt(card.id.replace('level-card-', '')))
            .sort((a, b) => a - b);

        if (existingLevels.length === 0) {
            const addBtn = createAddLevelButton(1);
            document.getElementById('selectedLevels').appendChild(addBtn);
            return;
        }

        const missingLevels = [];
        for (let i = 1; i <= 6; i++) {
            if (!existingLevels.includes(i)) {
                missingLevels.push(i);
            }
        }

        if (missingLevels.length === 0) return;

        for (let i = 0; i < existingLevels.length - 1; i++) {
            const current = existingLevels[i];
            const next = existingLevels[i + 1];

            if (next - current > 1) {
                const levelToAdd = current + 1;
                const addBtn = createAddLevelButton(levelToAdd);
                const levelCard = document.getElementById(`level-card-${next}`);
                if (levelCard) {
                    levelCard.before(addBtn);
                }
            }
        }

        const lastLevel = existingLevels[existingLevels.length - 1];
        if (lastLevel < 6) {
            const addBtn = createAddLevelButton(lastLevel + 1);
            document.getElementById('selectedLevels').appendChild(addBtn);
        }

        const firstLevel = existingLevels[0];
        if (firstLevel > 1) {
            const prevLevel = firstLevel - 1;
            if (prevLevel >= 1) {
                document.getElementById('selectedLevels').insertBefore(
                    createAddLevelButton(prevLevel),
                    document.querySelector('.level-card')
                );
            }
        }
    }

    function createAddLevelButton(level) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'w-100 add-level-btn';
        btn.dataset.nextLevel = level;
        btn.innerHTML = `<iconify-icon icon="ic:round-plus" width="16" height="16"></iconify-icon> Add Level ${level}`;

        btn.addEventListener('click', function() {
            addLevel(level);
        });

        return btn;
    }

    function addLevel(level) {
        const template = document.querySelector('#levelTemplate');
        const clone = template.content.cloneNode(true);
        const levelCard = clone.querySelector('.level-card');
        levelCard.id = `level-card-${level}`;
        clone.querySelector('.level-title').textContent = `Level ${level}`;

        const descInput = clone.querySelector('.level-desc-input');
        descInput.name = `level_${level}_description`;

        const knowledgeGroup = clone.querySelector('.knowledge-group');
        const abilityGroup = clone.querySelector('.ability-group');

        const createInputRow = (group, type) => {
            console.log(`Creating ${type} input row for level ${group} and ${level}`);
            const row = document.createElement('div');
            row.className = 'd-flex align-items-center mb-6';
            row.innerHTML = ` 
                <button type="button" class="btn btn-icon btn-light-danger me-5" 
                        onclick="this.parentElement.remove()">
                    <iconify-icon icon="ph:trash-bold" width="16" height="16"></iconify-icon>
                </button>
                <input type="text" class="form-control" 
                    name="level_${level}_${type}[]" 
                    placeholder="Enter ${type.charAt(0).toUpperCase() + type.slice(1)}">
            `;
            group.appendChild(row);
            
            const newInput = row.querySelector('input[type="text"]');
            newInput.dataset.round = String(window.validationRound);
        };

        createInputRow(knowledgeGroup, 'knowledge');
        createInputRow(abilityGroup, 'ability');

        clone.querySelector('.add-knowledge').addEventListener('click', function() {
            createInputRow(knowledgeGroup, 'knowledge');
        });

        clone.querySelector('.add-ability').addEventListener('click', function() {
            createInputRow(abilityGroup, 'ability');
        });

        clone.querySelector('.remove-level').addEventListener('click', function() {
            handleRemoveLevel(this.closest('.level-card'));
        });

        const existingLevels = Array.from(document.querySelectorAll('.level-card'))
            .map(card => parseInt(card.id.replace('level-card-', '')))
            .sort((a, b) => a - b);

        let insertBefore = null;
        for (const existingLevel of existingLevels) {
            if (existingLevel > level) {
                insertBefore = document.getElementById(`level-card-${existingLevel}`);
                break;
            }
        }

        if (insertBefore) {
            insertBefore.before(levelCard);
        } else {
            document.getElementById('selectedLevels').appendChild(levelCard);
        }

        updateAddLevelButtons();
        updateRemoveButtons();
        initializeKnowledgeAbilityButtons(levelCard);
    }

    function handleRemoveLevel(levelCard) {
        const levelIdMatch = levelCard.id.match(/level-card-(\d+)/);
        if (levelIdMatch) {
            const level = levelIdMatch[1];
            const removedInput = document.createElement('input');
            removedInput.type = 'hidden';
            removedInput.name = `removed_levels[]`;
            removedInput.value = level;
            document.querySelector('form').appendChild(removedInput);
        }

        levelCard.remove();
        updateAddLevelButtons();
        updateRemoveButtons();
    }

    function initializeKnowledgeAbilityButtons(levelCard = null) {
        const cards = levelCard ? [levelCard] : document.querySelectorAll('.level-card');
        
        cards.forEach(card => {
            const knowledgeGroup = card.querySelector('.knowledge-group');
            const abilityGroup = card.querySelector('.ability-group');
            const levelMatch = card.id.match(/level-card-(\d+)/);
            if (!levelMatch) return;
            const level = levelMatch[1];

            const addKnowledgeBtn = card.querySelector('.add-knowledge');
            const addAbilityBtn = card.querySelector('.add-ability');
            
            if (addKnowledgeBtn && !addKnowledgeBtn.hasAttribute('data-initialized')) {
                addKnowledgeBtn.setAttribute('data-initialized', 'true');
                addKnowledgeBtn.addEventListener('click', function() {
                    const row = document.createElement('div');
                    row.className = 'd-flex align-items-center mb-6';
                    row.innerHTML = `
                        <button type="button" class="btn btn-icon btn-light-danger me-5" onclick="this.parentElement.remove()">
                            <iconify-icon icon="ph:trash-bold" width="16" height="16"></iconify-icon>
                        </button>
                        <input type="text" class="form-control" placeholder="Enter Knowledge" name="level_${level}_knowledge[]">
                    `;
                    knowledgeGroup.appendChild(row);
                    const newInput = row.querySelector('input[type="text"]');
                    newInput.dataset.round = String(window.validationRound);
                });
            }

            if (addAbilityBtn && !addAbilityBtn.hasAttribute('data-initialized')) {
                addAbilityBtn.setAttribute('data-initialized', 'true');
                addAbilityBtn.addEventListener('click', function() {
                    const row = document.createElement('div');
                    row.className = 'd-flex align-items-center mb-6';
                    row.innerHTML = `
                        <button type="button" class="btn btn-icon btn-light-danger me-5" onclick="this.parentElement.remove()">
                            <iconify-icon icon="ph:trash-bold" width="16" height="16"></iconify-icon>
                        </button>
                        <input type="text" class="form-control" placeholder="Enter Ability" name="level_${level}_ability[]">
                    `;
                    abilityGroup.appendChild(row);
                    const newInput = row.querySelector('input[type="text"]');
                    newInput.dataset.round = String(window.validationRound);
                });
            }
        });
    }

    // ==========================================
    // EVENT LISTENERS
    // ==========================================
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
            e.preventDefault();
            return false;
        }
    });

    document.addEventListener('input', function(e) {
        if (!window.hasTriedSubmit) return;

        if (e.target.matches('.level-desc-input')) {
            const inp = e.target;
            const empty = (inp.value || '').trim() === '';
            inp.classList.toggle('is-invalid', empty);
            
            const next = inp.nextElementSibling;
            if (!empty && next && next.classList.contains('invalid-feedback')) {
                next.remove();
            }
        }

        if (e.target.matches('.knowledge-group input[type="text"], .ability-group input[type="text"]')) {
            const group = e.target.closest('.knowledge-group, .ability-group');
            validateGroup(group, group.classList.contains('knowledge-group') ? 'Knowledge' : 'Ability', {
                enforceAll: false
            });

            const next = group.nextElementSibling;
            if (next && next.classList.contains('invalid-feedback')) {
                const ok = validateGroup(group, '', { enforceAll: false });
                if (ok) next.remove();
            }
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-level')) {
            e.preventDefault();
            const levelCard = e.target.closest('.level-card');
            handleRemoveLevel(levelCard);
        }
    });

    // ==========================================
    // FIXED MAIN SUBMIT LOGIC
    // ==========================================
    const submitBtn = document.getElementById('submitBtn');
    const overwriteBtn = document.getElementById('OverwriteContinueEditSkillBtn');

    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        console.log('Submit button clicked');
        
        // Step 1: Validation
        window.hasTriedSubmit = true;
        window.validationRound += 1;

        const { valid, firstErrorEl } = validateAllLevels();
        if (!valid) {
            console.log('Validation failed');
            if (firstErrorEl && typeof firstErrorEl.scrollIntoView === 'function') {
                firstErrorEl.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
            return;
        }

        console.log('Validation passed');

        // Step 2: Check for changes
        isFormChanged = hasFormChanged();
        console.log('Form changed:', isFormChanged);
        
        if (!isFormChanged) {
            console.log('No changes detected - showing modal');
            
            // Try ModalManager first, fallback to alert if not available
            if (typeof ModalManager !== 'undefined') {
                ModalManager.open({
                    module: 'company_skill_library',
                    key: "technical_skill_no_changes_detected",
                    data: {},
                    onSubmit(modalEl1) {
                        console.log('No changes modal submitted');
                    }
                });
            } else {
                // Fallback alert if ModalManager is not available
                alert('No changes detected. Please make some changes before submitting.');
            }
            return;
        }

        console.log('Changes detected, proceeding with submission logic');

        // Step 3: Handle submission based on mode
        const urlParams = new URLSearchParams(window.location.search);
        const isDuplicate = urlParams.get('duplicate');;
        
        console.log('Is duplicate mode:', isDuplicate);

        if (isDuplicate == true) {
            console.log('Submitting form directly (duplicate mode)');
            document.getElementById('editForm').submit();
        } else {
            console.log('Showing overwrite modal');
            document.getElementById('overwriteCompanySkillName').textContent = 
                document.getElementById('name').value;
            
            const modal = new bootstrap.Modal(document.getElementById('OverwriteCompanySkillConfirmModal'));
            modal.show();
        }
    });

    // Handle overwrite confirmation
    overwriteBtn.addEventListener('click', function() {
        console.log('Overwrite confirmed, submitting form');
        document.getElementById('editForm').submit();
    });

    // ==========================================
    // INITIALIZATION
    // ==========================================
    
    // Initialize sector/category dropdowns
    if (initialSectorId) {
        fetchCategories(initialSectorId, initialCategoryId);
    } else {
        setCatState(!LOCK, 'Select Technical Skill Category');
    }

    if (!LOCK) {
        $sector.on('change', function() {
            const val = $(this).val();
            if (!val) {
                setCatState(true);
                return;
            }
            fetchCategories(val, null);
        });
    } else {
        $sector.prop('disabled', false).addClass('readonly-select');
        $category.prop('disabled', false).addClass('readonly-select');
    }

    updateRemoveButtons();
    updateAddLevelButtons();
    initializeKnowledgeAbilityButtons();

    // Capture initial form state with increased delay
    setTimeout(() => {
        originalFormState = captureFormState();
        console.log('Initial form state captured:', originalFormState);
    }, 1000);
});

// Clear validation error while typing in Technical Skill Title
document.getElementById('name')?.addEventListener('input', function() {
    const value = (this.value || '').trim();
    if (value !== '') {
        this.classList.remove('is-invalid'); // remove invalid style
        const next = this.nextElementSibling;
        if (next && next.classList.contains('invalid-feedback')) {
            next.remove(); // remove error message
        }
    }
});

</script>

@endsection
