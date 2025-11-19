@extends('employee.layout.app')

@section('title', 'Mid Year KPI')

@section('content')
<div class="container">
    <h1>Mid Year KPI</h1>

    @if (isset($kpi))
    <h2>Mid-Year KPI</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Objective</th>
                <th>Weightage</th>
                <th>KPI</th>
                <th>Base Target</th>
                <th>Stretch Target</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kpi->objectives as $objective)
            @foreach ($objective->keys as $key)
            <tr>
                <td>{{ $objective->title }}</td>
                <td>{{ $objective->weightage }}</td>
                <td>{{ $key->title }}</td>
                <td>{{ $key->base_target }}</td>
                <td>{{ $key->stretch_target }}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    @else
    <form id="kpiForm" action="{{ route('performance.management.saveMidKpi') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">
        <div class="card card-xl-stretch mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column"><span class="card-label fw-bold fs-1 mb-1">Performance</span></h3>
            </div>
            <div class="card-body px-6 pb-6">
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10" id="card_content">
                    <div class="col-lg-12">
                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                            <div class="objectives-container">
                                <div class="critical-function row mb-3">
                                    <div class="accordion accordion-icon-collapse col-lg-12" id="kt_accordion_3">
                                        <div class="mb-5">

                                            @foreach ($objectives as $objectiveIndex => $objective)
                                            <div class="accordion-header collapsed py-3 d-flex align-items-start" data-bs-toggle="collapse" data-bs-target="#kt_accordion_3_item_{{ $objectiveIndex }}">
                                                <span class="accordion-icon"></span>
                                                <div class="col-lg-6 pe-3">
                                                    <h5 class="mb-2">Objective</h5>
                                                    <input type="hidden" name="objectives[{{ $objectiveIndex }}][id]" value="{{ $objective->id }}">
                                                    <input id="name" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[{{ $objectiveIndex }}][title]" placeholder="Objective" value="{{ $objective->objectives }}" readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="mb-2">Weightage</h5>
                                                    <input type="number" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[{{ $objectiveIndex }}][weightage]" placeholder="Weightage" value="{{ $objective->weightage }}" readonly>
                                                </div>
                                            </div>
                                            <div class="row kpi-row mb-3">
                                                @foreach ($objective->keys as $keyIndex => $key)
                                                <div class="row mb-3 mt-2">
                                                    <!-- KPI Input -->
                                                    <div class="col-lg-4">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                            <h5 class="mb-2">KPI</h5>
                                                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][kpi]" placeholder="Enter KPI" value="{{ $key->kpi }}">
                                                        </div>
                                                    </div>

                                                    <!-- Base Target Input -->
                                                    <div class="col-lg-4">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                            <h5 class="mb-2">Base Target</h5>
                                                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][base_target]" placeholder="Enter Base Target" value="{{ $key->base_target }}">
                                                        </div>
                                                    </div>

                                                    <!-- Stretch Target Input -->
                                                    <div class="col-lg-4">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                            <h5 class="mb-2">Stretch Target</h5>
                                                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][stretch_target]" placeholder="Enter Stretch Target" value="{{ $key->stretch_target }}">
                                                        </div>
                                                    </div>

                                                    <!-- Rating Section -->
                                                    <div class="col-lg-4">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                            <h5 class="mb-2">Rating</h5>
                                                            @for ($i = 1; $i <= 4; $i++)
                                                                <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][rating]" id="kpi_rating_{{ $objectiveIndex }}_{{ $keyIndex }}_{{ $i }}" value="{{ $i }}" 
                                                                @if(isset($key->rank))
                                                                    @if($i == $key->rank) checked @endif
                                                                @elseif($i == 1) checked @endif>
                                                                <label class="form-check-label" for="kpi_rating_{{ $objectiveIndex }}_{{ $keyIndex }}_{{ $i }}">{{ $i }}</label>
                                                            </div>
                                                            @endfor
                                                        </div>
                                                    </div>

                                                    <!-- KPI Remarks Section -->
                                                    <div class="col-lg-4">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                            <h5 class="mb-2">Remarks</h5>
                                                            <textarea class="form-control form-control-solid" name="objectives[{{ $objectiveIndex }}][kpis][{{ $keyIndex }}][employee_planning]" placeholder="Enter Remarks..." rows="3">{{ $key->employee_planning ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="separator separator-dashed"></div>
                                                @endforeach
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-secondary add-kpi" data-objective-index="{{ $objectiveIndex }}">Add KPI</button>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="card card-xl-stretch mb-xl-8">
    <header class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Technical Skills Reviews</h4>
    </header>
    <div class="flex-lg-row-fluid card card-body mt-3">
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0" style="background-color: #f7941d;color: white !important;border-radius: 44px;">
                    <th class="min-w-115px">Sr No</th>
                    <th class="min-w-125px">Skill</th>
                    <th class="min-w-100px">AR (Approved Rating)</th>
                    <th class="min-w-100px">JD</th>
                    <th class="min-w-100px">GAP</th>
                    <th class="min-w-100px">Remarks</th>
                    <th class="min-w-100px">Rating</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">

                @foreach ($technicalSkills as $index => $skill)
                @php
                // Initialize the variables for approved rating, remark, and review date
                $approvedRating = null;
                $remark = null;

                // Check if skillReviews is not null
                if ($skillReviews) {
                // Loop through the skill reviews to find a matching skill name
                foreach ($skillReviews->details as $detail) {
                if ($detail->name == $skill['name']) {
                $approvedRating = $detail->level;
                $remark = $detail->remark;
                break; // Exit the loop once a match is found
                }
                }
                }

                // Calculate the gap between approved rating and JD level
                $gap = $approvedRating !== null && $skill['level'] !== null ? $approvedRating - $skill['level'] : null;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $skill['name'] }}</td>
                    <td>{{ $approvedRating }}</td>
                    <td>{{ $skill['level'] }}</td>
                    <td>{{ $gap }}</td>
                    <td><input type="text" class="form-control" placeholder="Enter planning" name="technical_skills[{{ $skill['name'] }}][plan]" value="{{ $skill['remark'] ?? '' }}"></td>
                    <td>
                        <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">
                            <select name="technical_skills[{{ $skill['name'] }}][level]" class="form-control form-control-solid mb-3 mb-lg-0 col-lg-6">
                                <option value="">Select Rating</option>
                                @for ($i = 1; $i <= 6; $i++) <option value="{{ $i }}" @if($i==($skill['level'] ?? '' )) selected @endif>{{ $i }}</option>
                                    @endfor
                            </select>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="score-section"></div>
    </div>
</div>

<div class="flex-lg-row-fluid card card-body mt-3">
    <h3>Soft Skills Reviews</h3>
    <table class="table align-middle table-row-dashed fs-6 gy-5">
        <thead>
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0" style="background-color: #f7941d;color: white !important;border-radius: 44px;">
                <th class="min-w-115px">Sr No</th>
                <th class="min-w-125px">Skill</th>
                <th class="min-w-100px">AR (Approved Rating)</th>
                <th class="min-w-100px">JD</th>
                <th class="min-w-100px">GAP</th>
                <th class="min-w-100px">Remarks</th>
                <th class="min-w-100px">Rating</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 fw-semibold">

            @foreach ($softSkills as $index => $skill)
            @php
            // Initialize the variables for approved rating, remark, and review date
            $approvedRating = null;
            $remark = null;

            // Check if skillReviews is not null and has the details property
            if ($skillReviews) {
            // Loop through the skill reviews to find a matching skill name
            foreach ($skillReviews->details as $detail) {
            if ($detail->name == $skill['name']) {
            $approvedRating = $detail->level;
            $remark = $detail->remark;
            break; // Exit the loop once a match is found
            }
            }
            }

            // Calculate the gap between approved rating and JD level
            $gap = $approvedRating !== null && $skill['level'] !== null ? $approvedRating - $skill['level'] : null;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $skill['name'] }}</td>
                <td>{{ $approvedRating }}</td>
                <td>{{ $skill['level'] }}</td>
                <td>{{ $gap }}</td>
                <td><input type="text" class="form-control" placeholder="Enter plan" name="soft_skills[{{ $skill['name'] }}][plan]" value="{{ $remark ?? '' }}"></td>
                <td>
                    <div class="fv-row mb-5 fv-plugins-icon-container col-lg-5">
                        <select name="soft_skills[{{ $skill['name'] }}][level]" class="form-control form-control-solid mb-3 mb-lg-0 col-lg-6">
                            <option value="">Select Rating</option>
                            @for ($i = 1; $i <= 3; $i++) <option value="{{ $i }}" @if($i==($skill['level'] ?? '' )) selected @endif>{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<div class="text-end mt-4">
    <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
</div>
</form>
@endif
</div>
@endsection

@section('scripts')
<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#add_new_objective').click(function() {
            var currentObjectives = $('.objectives-container .objective-row').length;
            if (currentObjectives >= 5) {
                alert('You can only add up to 5 objectives.');
                return;
            }

            var newIndex = currentObjectives;
            var newObjectiveHtml = `
                <div class="row objective-row mb-3" data-objective-index="${newIndex}">
                    <div class="col-lg-6 pe-3">
                        <h5 class="mb-2">Objective</h5>
                        <input type="hidden" name="objectives[${newIndex}][id]" value="new">
                        <input id="name" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${newIndex}][title]" placeholder="Objective" value="">
                    </div>
                    <div class="col-lg-6">
                        <h5 class="mb-2">Weightage</h5>
                        <input type="number" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${newIndex}][weightage]" placeholder="Weightage" value="">
                    </div>
                    <div class="row kpi-row mb-3">
                        <div class="col-lg-4">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <h5 for="kpi" class="mb-2">KPI</h5>
                                <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${newIndex}][kpis][0][title]" placeholder="Enter KPI">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <h5 for="base_target" class="mb-2">Base Target</h5>
                                <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${newIndex}][kpis][0][base_target]" placeholder="Enter Base Target">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <h5 for="stretch_target" class="mb-2">Stretch Target</h5>
                                <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${newIndex}][kpis][0][stretch_target]" placeholder="Enter Stretch Target">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <h5 for="rating" class="mb-2">Rating</h5>
                                @for ($i = 1; $i <= 4; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="objectives[${newIndex}][kpis][0][rating]" id="kpi_rating_${newIndex}_0_${i}" value="${i}" @if($i == 1) checked @endif>
                                    <label class="form-check-label" for="kpi_rating_${newIndex}_0_${i}">${i}</label>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="margin-top: 8px;">
                        <button type="button" class="btn btn-danger remove-objective" title="Remove objective">Remove</button>
                    </div>
                </div>
            `;

            $('.objectives-container').append(newObjectiveHtml);
        });

        // Handle removal of objectives
        $('.objectives-container').on('click', '.remove-objective', function() {
            $(this).closest('.objective-row').remove();
        });

        // Handle addition of KPI fields
        $('.objectives-container').on('click', '.add-kpi', function() {
            var objectiveIndex = $(this).data('objective-index');
            var objectiveRow = $(this).closest('.objective-row');
            var currentKpis = objectiveRow.find('.kpi-row').length;
            if (currentKpis >= 5) {
                alert('You can only add up to 5 KPIs per objective.');
                return;
            }

            var kpiIndex = currentKpis;
            var newKpiHtml = `
                <div class="row kpi-row mb-3">
                    <div class="col-lg-4">
                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                            <h5 for="kpi" class="mb-2">KPI</h5>
                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${objectiveIndex}][kpis][${kpiIndex}][title]" placeholder="Enter KPI">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                            <h5 for="base_target" class="mb-2">Base Target</h5>
                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${objectiveIndex}][kpis][${kpiIndex}][base_target]" placeholder="Enter Base Target">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                            <h5 for="stretch_target" class="mb-2">Stretch Target</h5>
                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${objectiveIndex}][kpis][${kpiIndex}][stretch_target]" placeholder="Enter Stretch Target">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                            <h5 for="rating" class="mb-2">Rating</h5>
                            @for ($i = 1; $i <= 4; $i++)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="objectives[${objectiveIndex}][kpis][${kpiIndex}][rating]" id="kpi_rating_${objectiveIndex}_${kpiIndex}_${i}" value="${i}" @if($i == 1) checked @endif>
                                <label class="form-check-label" for="kpi_rating_${objectiveIndex}_${kpiIndex}_${i}">${i}</label>
                            </div>
                            @endfor
                        </div>
                    </div>
                    <div class="col-lg-12" style="margin-top: 8px;">
                        <button type="button" class="btn btn-danger remove-kpi" title="Remove KPI">Remove KPI</button>
                    </div>
                </div>
            `;

            $(this).before(newKpiHtml);
        });

        // Handle removal of KPI fields
        $('.objectives-container').on('click', '.remove-kpi', function() {
            $(this).closest('.kpi-row').remove();
        });

        // SweetAlert2 confirmation before submitting the form
        $('#submitBtn').click(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Check for blank fields in objectives and KPIs
            let isValid = true;
            $('.objective-row').each(function() {
                let objectiveTitle = $(this).find('input[name^="objectives"][name$="[title]"]').val().trim();
                let objectiveWeightage = $(this).find('input[name^="objectives"][name$="[weightage]"]').val().trim();
                if (!objectiveTitle || !objectiveWeightage) {
                    isValid = false;
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please fill all objective fields (Objective and Weightage).',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return false; // Exit the loop
                }

                $(this).find('.kpi-row').each(function() {
                    let kpiTitle = $(this).find('input[name$="[title]"]').val().trim();
                    let baseTarget = $(this).find('input[name$="[base_target]"]').val().trim();
                    if (!kpiTitle || !baseTarget) {
                        isValid = false;
                        Swal.fire({
                            title: 'Error!',
                            text: 'Please fill all KPI fields (KPI and Base Target).',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return false; // Exit the loop
                    }
                });

                if (!isValid) return false; // Exit the outer loop if inner validation fails
            });

            if (!isValid) return; // If any field is invalid, stop further processing

            // Calculate the total weightage
            let totalWeightage = 0;
            $('input[name^="objectives"][name$="[weightage]"]').each(function() {
                let weightage = parseInt($(this).val()) || 0;
                totalWeightage += weightage;
            });

            // Check if the total weightage is 100
            if (totalWeightage === 100) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#kpiForm').submit(); // Submit the form
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'The total weightage of all objectives must be 100.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>

@endsection
