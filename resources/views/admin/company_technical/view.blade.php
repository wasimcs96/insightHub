@extends('admin.layout.app')

@section('title', 'Technical Skill Details')

@section('styles')
    <style>
        .ts-detail-main {
            display: flex;
            padding: 32px 24px;
            flex-direction: column;
            align-items: flex-start;
            gap: 24px;
            border-radius: 8px;
            background: #FFF;
        }

        .content-desc {
            gap: 24px;
        }

        .content-desc h1 {
            font-size: 28px;
            font-weight: 700;
            line-height: 39px;
            width: 100%;
        }

        .content-desc h1 span {
            padding: 8px 16px;
            gap: 8px;
            border-radius: 80px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            width: fit-content;
        }

        .custom-btn {
            padding: 12px 18px;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
        }

        .para {
            color: #071437;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .nav-pills {
            border-bottom: 1px solid #DBDFE9;
        }

        .nav-pills .nav-link {
            display: flex;
            padding: 12px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            color: #99A1B7;
            font-size: 17.55px;
            font-weight: 400;
            line-height: 23.4px;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            border-bottom: 3px solid #F7941C;
            color: #000;
            font-weight: 500;
            line-height: 21.06px;
            background-color: #fff;
            border-radius: 0;
        }

        .nav-link.active iconify-icon.star-active {
            color: #F3AC60;
        }

        .ts-detail-card .header {
            padding: 24px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            color: #071437;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
        }

        .ts-detail-card .inner-content {
            padding: 24px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .ts-detail-card .inner-content .para {
            color: #3E3E3E;
        }

        .see-more-btn {
            color: #F7941C;
            font-size: 14px;
            font-weight: 700;
            line-height: 20px;
            text-decoration-line: underline;
            cursor: pointer;
        }

        .pagination .page-link {
            color: #78829D;
            border: none;
            background: transparent;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .page-item:hover:not(.active):not(.offset):not(.disabled) .page-link {
            color: #78829D;
        }

        .pagination .page-item.active-custom .page-link {
            background-color: #FABB6E;
            color: white;
            border-radius: 6px;
            border: none;
            font-weight: 600;
        }

        .pagination .page-link:focus {
            box-shadow: none;
        }
    </style>

    <style>
        .modal-footer button {
            flex: 1 0 0;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
        }

        .custom-popup-body h4 {
            margin: 16px auto 13px auto;
            color: #071437;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .custom-popup-body p {
            color: #071437;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 16px;
        }

        .manually-radio {
            position: relative;
        }

        .manually-radio input[type="radio"] {
            display: none;
        }

        .manually-radio input[type="radio"]:checked+.manually-modal-inner {
            border: 2px solid #F7941C !important;
        }

        .manually-modal-inner {
            border-radius: 16px;
            border: 2px solid #F1F1F4;
            padding: 16px;
            flex: 1 0 0;
            height: 160px;
            cursor: pointer;
        }

        .manually-modal-inner:hover {
            border: 2px solid #F7941C;
        }

        .manually-modal-inner .line {
            height: 2px;
            width: 100%;
            display: block;
            background-color: #F1F1F4;
        }

        .orange-fill-popup {
            background: #F7941C;
            color: #FFF;
        }

        .orange-outline-popup {
            border: 1px solid #F7941C !important;
            background: #FFF;
            color: #F7941C;
        }

        .disable-grey-popup {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .grey-outline-popup {
            border: 1px solid #99A1B7 !important;
            background: #FFF;
            color: #78829D;
        }

        .modal-header h1 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .input-wrapper {
            height: 36px;
            padding: 0px 12px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        input:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }

        .modal-body h4 {
            color: #071437;
            text-align: center;
            font-size: 32.5px;
            font-style: normal;
            font-weight: 600;
            line-height: 39px;
        }

        .modal-body .para {
            color: #071437;
            text-align: center;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .bg-modal-content {
            padding: 12px 18px;
            background: #F1F1F4;
            color: #071437;
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 20px;
            overflow: scroll;
            max-height: 144px;
        }

        .badge-soft {
            padding: 8px 16px !important;
            border-radius: 80px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            line-height: 16px !important;
            max-width: 219px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 30.5px;

        }

        .badge-company {
            color: #A56313 !important;
            background-color: #FFF5DA !important;
        }

        .badge-master {
            color: #125A78 !important;
            background-color: #E3F7FF !important;
        }
        
        .badge-success {
            background: #DDF5E2;
            color: #196329;
        }

        .badge-warning {
            background: #F2EEFD;
            color: #6652A1;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Technical Skill Details
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
                    <li class="breadcrumb-item text-muted text-truncate" style="max-width: 60%; display: inline-block;" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ $skill->name }}" id="breadcrumbText">{{ $skill->name }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted" id="breadcrumbText"> View Technical Skill</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl">
            @if (session('alert'))
                <x-alert :type="session('alert.type')" :message="session('alert.message')" />
            @endif
            <div class="ts-detail-main">
                <div class="content-desc d-flex flex-column w-100">
                    <div class=" heading-btn d-flex justify-content-between gap-7 align-items-baseline">
                        {{-- {{ dd($skill) }} --}}
                        <h1 class="m-0  d-flex gap-5 align-items-center"><p class="m-0" style="max-width: 82%; word-break: break-all;">{{ $skill->name }}</p>
                            @if ($skill->is_custom == 0)
                                <span class="badge-soft  badge-master">Master Skill</span>
                            @else
                                <span class="badge-soft  badge-company">Company Skill</span>
                            @endif
                        </h1>

                        <div class="button-container d-flex align-items-center gap-3 w-50">
                            <button type="button" class="btn btn-danger border-0 rounded-1" data-bs-toggle="modal"
                                data-bs-target="#DeleteTechnicalSkillModal" style="font-size: 12px; height: 43.59px; background: #F24130;">
                                <i class="bi bi-trash me-1"></i> Delete Technical Skill
                            </button>
                            {{-- {{ dd($skill->customChildrenCount()) }} --}}

                            <button
                                type="button"
                                id="editTechSkillBtn"
                                style="height: 43.59px;"
                                class="custom-btn orange-fill border-0 d-flex align-items-center"
                                data-skill-id="{{ $skill->id }}"
                                data-skill-name="{{ $skill->name }}"
                                data-is-custom="{{ (int)($skill->is_custom ?? 0) }}"
                                data-skill-count="{{ (int)($skill->customChildrenCount() ?? 0) }}"
                            >
                            
                            @if ($skill->is_custom == 0)<iconify-icon icon="ic:round-plus" width="20" height="20"></iconify-icon> Create Company Skill @else <iconify-icon
                                    icon="meteor-icons:pencil" width="16" height="16"></iconify-icon> Edit Technical Skill @endif
                            </button>
                                 {{-- <button type="button" id="editTechSkillBtn" style="height: 43.59px;"
                                class="custom-btn orange-fill border-0 d-flex align-items-center"><iconify-icon
                                    icon="meteor-icons:pencil" width="16" height="16"></iconify-icon> Edit Technical
                                Skill</button> --}}
                        </div>

                    </div>
                    <p>Last Updated: {{ \App\Helpers\DateFormatHelper::formatDate($skill->updated_at) }}</p>
                    <div class="d-flex gap-4 align-items-center">
                        <span class="badge-soft badge-success">{{ $skill->sector->name ?? '' }}</span>
                        <span class="badge-soft badge-warning" style="max-width: fit-content;">{{ $categoryTitle }}</span>
                    </div>
                    <p class="m-0 para" style="word-break: break-word;">{{ $skill->description }}</p>
                </div>
                <div class="w-100">
                    <ul class="nav nav-pills mb-3 w-100" id="pills-tab" role="tablist">
                        @foreach ($levels as $index => $level)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                    id="pills-level-{{ $level['level'] }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-level-{{ $level['level'] }}" type="button" role="tab"
                                    aria-controls="pills-level-{{ $level['level'] }}"
                                    aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                    Level {{ $level['level'] }}
                                    <iconify-icon icon="material-symbols:star" class="star-active" width="16"
                                        height="16"></iconify-icon>
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($levels as $index => $level)
                            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                id="pills-level-{{ $level['level'] }}" role="tabpanel"
                                aria-labelledby="pills-level-{{ $level['level'] }}-tab" tabindex="0">
                                <div class="ts-detail-card mb-5">
                                    <div class="header">
                                        <p class="m-0">Technical Skill Details</p>
                                    </div>
                                    <div class="inner-content">
                                        <div class="mb-5">
                                            <p class="m-0 para"><b>Description</b></p>
                                            <p class="para">{{ $level['description'] }}</p>
                                        </div>

                                        <div class="mb-5">
                                            <p class="m-0 para"><b>Knowledge</b></p>
                                            <ul>
                                                @foreach (preg_split('/\s*;\s*/', $level['knowledge']) as $knowledge)
                                                    <li class="para">{{ $knowledge }}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div>
                                            <p class="m-0 para"><b>Abilities</b></p>
                                            <ul>
                                                @foreach (preg_split('/\s*;\s*/', $level['ability']) as $ability)
                                                    <li class="para">{{ $ability }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="ts-detail-card">
                                    <div class="header">
                                        <p class="m-0">Assigned Job Position(s) for Level {{ $level['level'] }}
                                        </p>
                                    </div>
                                    <div class="inner-content">
                                        {{-- {{ dd($jobsByLevel) }} --}}
                                        @if (isset($jobsByLevel[$level['level']]) && $jobsByLevel[$level['level']]->count())
                                            @foreach ($jobsByLevel[$level['level']] as $job)
                                            {{-- {{ dd($job) }} --}}
                                                <div class="mb-5">
                                                    <p class="m-0 para">
                                                        <a class="text-primary" href="/admin/saved-jobdescriptions?org_department={{ $job->department_id ?? ''}}&selected_job={{ $job->id ?? '' }}"><b>{{ $job->title }}</b></a>
                                                        <iconify-icon icon="solar:ranking-outline" width="16"
                                                            height="16" style="color: #F7941C;"></iconify-icon>
                                                        {{-- {{ $level['level'] }} --}}
                                                        {{ $job->level ?? '' }}
                                                    </p>
                                                    <p class="para">{{ $job->description }}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="para">No job position assigned for this level.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteTechnicalSkillModal" tabindex="-1" aria-labelledby="DeleteTechnicalSkillLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="position: absolute; right: 15px; top: 10px; z-index: 1;"></button>
                <div class="modal-body text-center pt-4">
                    <iconify-icon icon="ep:warning" width="70" height="70"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="my-5">Delete Technical Skill?</h4>
                    <p class="mx-12 my-5 para">This action will remove the technical skill, <b
                            id="skillToDeleteName">{{ $skill->name }}</b> from all associated job position listed below:.
                    </p>
                    <div class="bg-modal-content">
                        <p class="m-0" id="affectedJobList">
                            @if ($jobs->isNotEmpty())
                                {{ $jobs->pluck('title')->implode(', ') }}
                            @else
                                No jobs are associated with this skill.
                            @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <button class="btn btn-outline m-0" data-bs-dismiss="modal">Discard</button>
                        <form id="deleteSkillForm" method="POST"
                            action="{{ route('sector.skills.company.destroy', $skill->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" value="{{ $skill->is_custom ?? '' }}" name="skill_type" />
                            <button type="submit"
                                class="btn btn-danger text-white m-0"style="background: #F7941C;">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="duplicateAsNewSkill" tabindex="-1" aria-labelledby="duplicateAsNewSkillLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="m-0" id="duplicateAsNewSkillLabel">Duplicate as New Skill</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-popup-body">
                        <p class="m-0">Existing Technical Skill Title</p>
                        <p class="mb-7"><b>{{ $skill->name }}</b></p>
                        <label class="form-label">New Technical Skill Title</label>
                        <div class="input-wrapper d-flex">
                            <input type="text" id="skillInput" class="border-0 w-100"
                                placeholder="New Technical Skill Title" />
                        </div>
                        <small id="errorText" style="color: red; display: none; margin-top:3px;">This
                            field is required</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="fs-6 grey-outline-popup flex-grow-0 px-14"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="duplicateBtn"
                        class="text-center fs-6 orange-fill-popup flex-grow-0 px-14">
                        Duplicate
                    </button>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <div class="modal fade" id="editTechnicalSkill" tabindex="-1" aria-labelledby="editTechnicalSkillLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="custom-popup-body text-center m-auto">
                        <iconify-icon icon="jam:alert" width="70" height="70"
                            style="color: #F8BB86;"></iconify-icon>
                        <h4>Edit Technical Skill?</h4>
                        <p>Choose how you'd like to apply the changes to this technical skill.</p>
                        <form>
                            <div class="d-flex align-items-center justify-content-center gap-4 mb-5">
                                <label class="manually-radio w-100">
                                    <input type="radio" name="jdOption" value="custom">
                                    <div class="d-flex flex-column gap-3 manually-modal-inner">
                                        <p class="m-0 text-left fw-bold" style="text-align: left;">Duplicate as New Skill
                                        </p>
                                        <div class="line"></div>
                                        <p class="m-0 text-left" style="text-align: left;">Duplicate the existing
                                            technical skill
                                            in the Localised Technical Skill Library into a new entry.
                                        </p>
                                    </div>
                                </label>
                                <label class="manually-radio w-100">
                                    <input type="radio" name="jdOption" value="master">
                                    <div class="d-flex flex-column gap-3 manually-modal-inner">
                                        <p class="m-0 text-left fw-bold" style="text-align: left;">Overwrite Localised
                                            Technical
                                            Skill</p>
                                        <div class="line"></div>
                                        <p class="m-0 text-left" style="text-align: left;">Replace the existing skill in
                                            the
                                            Localised Technical Skill Library with the updated version.
                                            This will affect {{ count($jobsByLevel) }} job position(s) currently linked to
                                            it.</p>
                                    </div>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 justify-content-center">
                    <button type="button" class="fs-6 grey-outline-popup flex-grow-0 px-14"
                        data-bs-dismiss="modal">Cancel</button>

                    <button type="button" id="proceedBtnDuplicate"
                        class="text-center fs-6 orange-fill-popup flex-grow-0 px-14" data-bs-toggle="modal"
                        data-bs-target="#duplicateAsNewSkill" style="display: none;">Proceed</button>

                    <button type="button" id="proceedBtnOverwrite"
                        class="text-center fs-6 orange-fill-popup flex-grow-0 px-14"
                        style="display: none;">Proceed</button>

                    <button type="button" class="text-center fs-6 disable-grey-popup flex-grow-0 px-14" disabled
                        id="disabledProceedBtn">Proceed</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
  const btn = document.getElementById('editTechSkillBtn');
  if (!btn) return;

  // Helpers
  const toNumber = (v, d = 0) => {
    const n = Number(v);
    return Number.isFinite(n) ? n : d;
  };

  const redirect = (url, params = {}) => {
    const qs = new URLSearchParams(params).toString();
    window.location.href = qs ? `${url}?${qs}` : url;
  };

  const openChoiceModal = (jobLevelCount, onSubmit) => {
    ModalManager.open({
      module: 'company_skill_library',
      key: 'edit_technical_skill',
      data: { jobLevelCount },
      onSubmit(modalEl) {
        const selected = modalEl?.querySelector('.modal-body input[type="radio"]:checked');
        if (!selected) return;
        onSubmit(selected.value, modalEl);
      },
      onShown(modalEl) {
        const radios = modalEl?.querySelectorAll('.modal-body input[type="radio"]') ?? [];
        const proceedBtn = modalEl?.querySelector('#disabledProceedBtn');
        if (!proceedBtn) return;

        proceedBtn.disabled = true;
        radios.forEach(r => {
          r.addEventListener('change', () => {
            proceedBtn.disabled = !r.checked;
            proceedBtn.classList.toggle('disable-grey-popup', proceedBtn.disabled);
          });
        });
      }
    });
  };

  const closeBootstrapModal = (modalEl) => {
    try {
      const bsModal = bootstrap.Modal.getInstance(modalEl);
      if (bsModal) bsModal.hide();
    } catch (_) {}
  };

  const openDuplicateTitleModal = (prefillName, onValid) => {
    ModalManager.open({
      module: 'company_skill_library',
      key: 'duplicate_technical_skill',
      data: { skillName: prefillName },
      onSubmit(modalEl1) {
        const input = document.getElementById('skillInput');
        const errorText = document.getElementById('errorText');
        const newTitle = (input?.value || '').trim();

        if (!newTitle) {
          if (errorText) {
            errorText.textContent = 'This field is required';
            errorText.style.display = 'block';
          }
          return;
        }

        errorText.style.display = 'none';

        // Show loading state
        const submitButton = modalEl1.querySelector('[data-modal-submit]');
        const originalText = submitButton?.textContent || 'Duplicate';
        if (submitButton) {
          submitButton.disabled = true;
          submitButton.textContent = 'Validating...';
        }

        // Validate duplicate title via API
        const skillId = btn.dataset.skillId;
        const skillType = btn.dataset.isCustom;

        fetch(`/admin/company/sector-skills/validate-duplicate-title/${skillId}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            new_title: newTitle
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.exists) {
            // Show error if title exists
            if (errorText) {
              errorText.textContent = data.message || 'This title already exists. Please use a different title.';
              errorText.style.display = 'block';
            }

            // Make the field border red by adding is-invalid to the wrapper
            const wrapper = input?.closest('.manually-modal-inner') || input?.closest('.input-wrapper') || input?.parentElement;
            if (wrapper) wrapper.classList.add('is-invalid');

            // Ensure aria-invalid for accessibility
            if (input) input.setAttribute('aria-invalid', 'true');

            // Re-enable button
            if (submitButton) {
              submitButton.disabled = false;
              submitButton.textContent = originalText;
            }

            // Remove invalid state when user types
            if (input) {
              const clearInvalid = function() {
                if (this.value.trim()) {
                  if (errorText) errorText.style.display = 'none';
                  this.removeAttribute('aria-invalid');
                  if (wrapper) wrapper.classList.remove('is-invalid');
                  this.removeEventListener('input', clearInvalid);
                }
              };
              input.addEventListener('input', clearInvalid);
            }
          } else {
            // Title is available, proceed with duplicate
            if (errorText) errorText.style.display = 'none';
            onValid(newTitle);
          }
        })
        .catch(error => {
          console.error('Validation error:', error);
          if (errorText) {
            errorText.textContent = 'An error occurred while validating the title. Please try again.';
            errorText.style.display = 'block';
          }
          if (submitButton) {
            submitButton.disabled = false;
            submitButton.textContent = originalText;
          }
        });
      },
      onOpen(modalEl1) {
        // Add real-time validation to clear errors when user types
        const skillInput = modalEl1.querySelector('#skillInput');
        const errorText = modalEl1.querySelector('#errorText');

        if (skillInput && errorText) {
          // Clear error and invalid state when user types
          const handler = function() {
            if (this.value.trim()) {
              errorText.style.display = 'none';
              this.removeAttribute('aria-invalid');
              const wrapper = this.closest('.manually-modal-inner') || this.closest('.input-wrapper') || this.parentElement;
              if (wrapper) wrapper.classList.remove('is-invalid');
            }
          };
          skillInput.addEventListener('input', handler);
        }
      }
    });
  };

  const openCreateCompanySkillModal = (key, skillName, onSubmit) => {
    ModalManager.open({
      module: 'company_skill_library',
      key,
      data: { skillName },
      onSubmit
    });
  };

  btn.addEventListener('click', function () {
    const skillId = btn.dataset.skillId;
    const skillName = btn.dataset.skillName || '';
    const isCustom = toNumber(btn.dataset.isCustom, 0);       // 0 = master, non-zero = custom
    const childCount = toNumber(btn.dataset.skillCount, 0);   // how many company-specific children exist
console.log('is_cusomttt',isCustom);
    // When the skill IS custom (non-zero): ask user Duplicate vs Overwrite
    if (isCustom !== 0) {
      const jobLevelCount = {{ count($jobsByLevel) }};
      openChoiceModal(jobLevelCount, (choice, modalEl) => {
        if (choice === 'duplicate') {
          closeBootstrapModal(modalEl);
          openDuplicateTitleModal(skillName, (newTitle) => {
            redirect(`/admin/company/sector-skills/duplicate/${skillId}`, {
              duplicate: 'true',
              skill_type:isCustom,
              new_title: newTitle
            });
          });
        } else if (choice === 'overwrite') {
          redirect(`/admin/company/sector-skills/edit/${skillId}`, {
              duplicate: 'false',
              skill_type:isCustom,
            });
        }
      });
      return;
    }

    // When the skill is NOT custom (i.e., master skill):
    // If it already has company children, open the "create_company_technical_skill" modal (turn into company copy).
    // Otherwise open "create_another_company_technical_skill".
    const modalKey = childCount > 0
      ? 'create_another_company_technical_skill'
      : 'create_company_technical_skill';

    openCreateCompanySkillModal(modalKey, skillName, () => {
      redirect(`/admin/company/sector-skills/duplicate/${skillId}`, {
        duplicate: 'true',
        skill_type: isCustom
      });
    });
  });
});
</script>
@endsection