@extends('admin.layout.app')

@section('title', 'KPI Review')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="d-flex flex-column flex-lg-row mb-17">
            <div class="flex-lg-row-fluid">
                <form id="kpiReviewForm" action="{{ route('admin.performance.management.updateSkills', $kpiId) }}" method="POST">
                    @csrf <!-- Add CSRF token for form security -->
                    <div class="flex-lg-row-fluid card card-body">
                        <h4 class="fs-3 text-gray-800 w-bolder mb-6 mt-4">KPI Review</h4>
                        @foreach ($objectives as $objectiveIndex => $objective)
                        <div class="py-3 d-flex align-items-start">
                            <div class="col-lg-6 pe-3">
                                <h5 class="mb-2 mt-2">Objective</h5>
                                <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[{{ $objectiveIndex }}][objectives]" value="{{ $objective->objectives }}" readonly>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="mb-2 mt-2">Weightage</h5>
                                <input type="number" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[{{ $objectiveIndex }}][weightage]" value="{{ $objective->weightage }}" readonly>
                            </div>
                        </div>
                        @foreach ($objective->keys as $keyIndex => $key)
                        <div class="row kpi-row mb-3 mt-2">
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                    <h5 class="mb-2 mt-2">KPI</h5>
                                    <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][kpi]" value="{{ $key->kpi }}" readonly>
                                    <input type="hidden" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][id]" value="{{ $key->id }}">
                                    <input type="hidden" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][base_target]" value="{{ $key->base_target }}">
                                    <input type="hidden" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][stretch_target]" value="{{ $key->stretch_target }}">
                                    <div class="mb-3">
                                        <strong>Base Target:</strong> {{ $key->base_target }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Stretch Target:</strong> {{ $key->stretch_target }}
                                    </div>
                                    <input type="hidden" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][employee_planning]" value="{{ $key->employee_planning }}">
                                    <div class="mb-3">
                                        <strong>Employee Planning:</strong> {{ $key->employee_planning }}
                                    </div>
                                </div>
                            </div>
                            @php
                            $maxLevel = 4; // Assuming maximum level is 4
                            @endphp
                            <div class="col-lg-6">
                                <div class="row">
                                    @for ($i = 1; $i <= $maxLevel; $i++)
                                        <div class="col-lg-3">
                                            <div class="d-flex flex-column-reverse form-check form-check-custom form-check-warning form-check-solid">
                                                <input class="mt-12 form-check-input checkbox_tech" type="radio" id="{{ $key->id }}_rate{{ $i }}" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][rating]" value="{{ $i }}" @if (isset($key->rank) && $i == $key->rank) checked @elseif (!isset($key->rank) && $i == 1) checked @endif />
                                                <label for="{{ $key->id }}_rate{{ $i }}" class="fs-5 fw-bold">{{ $i }}</label>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <p class="fs-5 fw-semibold">Manager Evaluation</p>
                                <textarea type="text" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][manager_evaluation]" placeholder="Manager Evaluation..." class="form-control form-control-solid" data-kt-autosize="true">{{ $key->manager_evaluation ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="separator separator-dashed"></div>
                        @endforeach
                        @endforeach
                    </div>

                    <div class="flex-lg-row-fluid card card-body mt-5">
                        <h4 class="fs-3 text-gray-800 w-bolder mb-6 mt-4">Technical Skills</h4>
                        @php
                        $maxLevel = 6;
                        @endphp
                        @foreach ($technicalSkills as $index => $skill)
                        <input type="hidden" value="{{ $skill->name }}" name="technical_skills[]">
                        <div class="skill-row justify-content-between mb-8 mt-8">
                            <div class="col-lg-2">
                                <label for="{{ $skill->name }}" class="fw-bold text-gray-800 fs-5">{{ $skill->name }}</label>
                            </div>
                            <div class="rating justify-content-around col-lg-12">
                                @for ($i = 1; $i <= $maxLevel; $i++)
                                    <div class="d-flex flex-column-reverse form-check form-check-custom form-check-warning form-check-solid">
                                        <input class="mt-10 form-check-input checkbox_tech" type="radio" id="{{ $skill->name }}_rate{{ $i }}" name="technical_levels[{{ $skill->name }}]" value="{{ $i }}" @if ($i==$skill->level) checked @elseif (!isset($skill->level) && $i == 1) checked @endif />
                                        <label for="{{ $skill->name }}_rate{{ $i }}" class="fs-5 fw-bold">{{ $i }}</label>
                                    </div>
                                @endfor
                                <div class="col-lg-3">
                                    <p class="fs-5 fw-semibold">Employee Remark</p>
                                    <textarea type="text" readonly name="technical_remarks[{{ $skill->name }}]" placeholder="Employee Remark..." class="form-control form-control-solid" data-kt-autosize="true">{{ $skill->remark ?? '' }}</textarea>
                                </div>
                                <div class="col-lg-3">
                                    <p class="fs-5 fw-semibold">Manager Evaluation</p>
                                    <textarea type="text" name="technical_evaluation[{{ $skill->name }}]" placeholder="Manager Evaluation..." class="form-control form-control-solid" data-kt-autosize="true">{{ $skill->evaluation ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed"></div>
                        @endforeach
                    </div>

                    <div class="flex-lg-row-fluid card card-body mt-5">
                        <h4 class="fs-3 text-gray-800 w-bolder mb-6 mt-4">Soft Skills</h4>
                        @php
                        $maxLevel = 3;
                        $levelLabels = ['Basic', 'Intermediate', 'Advanced'];
                        @endphp
                        @foreach ($softSkills as $index => $skill)
                        <input type="hidden" value="{{ $skill->name }}" name="soft_skills[]">
                        <div class="skill-row justify-content-between mb-8 mt-8">
                            <div class="col-lg-2">
                                <label for="soft_skill_{{ $skill['id'] }}" class="fw-bold text-gray-800 fs-5">{{ $skill['name'] }}</label>
                            </div>
                            <div class="rating justify-content-around col-lg-12">
                                @for ($i = 1; $i <= $maxLevel; $i++)
                                    @if(isset($levelLabels[$i - 1]))
                                    <div class="d-flex flex-column-reverse form-check form-check-custom form-check-warning form-check-solid" style="padding-left: 67px !important;">
                                        <input class="mt-10 form-check-input checkbox_soft" type="radio" id="soft_skill_{{ $skill['name'] }}_rate{{ $i }}" name="soft_levels[{{ $skill['name'] }}]" value="{{ $i }}" @if (isset($skill['level']) && $i==$skill['level']) checked @elseif (!isset($skill['level']) && $i==1) checked @endif />
                                        <label for="soft_skill_{{ $skill['name'] }}_rate{{ $i }}" class="fs-5 fw-bold w-100" style="border-radius: 16px;padding: 0px 10px 1px 10px;color:#344054">
                                            {{ $i }}
                                        </label>
                                        {{ $levelLabels[$i - 1] }}
                                    </div>
                                    @endif
                                @endfor
                                <div class="col-lg-3">
                                    <p class="fs-5 fw-semibold">Employee Remark</p>
                                    <textarea type="text" readonly name="soft_remarks[{{ $skill['name'] }}]" placeholder="Employee Remark..." class="form-control form-control-solid" data-kt-autosize="true">{{ $skill->remark ?? '' }}</textarea>
                                </div>
                                <div class="col-lg-3">
                                    <p class="fs-5 fw-semibold">Manager Evaluation</p>
                                    <textarea type="text" name="soft_evaluation[{{ $skill['name'] }}]" placeholder="Manager Evaluation..." class="form-control form-control-solid" data-kt-autosize="true">{{ $skill->evaluation ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed"></div>
                        @endforeach
                    </div>

                    @if ($managerApproved)
                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('submitBtn').addEventListener('click', function(e) {
        e.preventDefault();

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to submit?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('kpiReviewForm');
                form.submit();
            }
        })
    });
</script>
@endsection
