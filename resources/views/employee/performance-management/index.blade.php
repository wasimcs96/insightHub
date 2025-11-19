@extends('employee.layout.app')

@section('title', 'Roles')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Include SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<!--end::Toolbar container-->
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">

        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Performance
            </h1>
            <!--end::Title-->

            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Admin </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    Performance </li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
<!--begin::Main-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">
    <div class="app-container  container-xxl   " id="kt_app_content_container">
        <div class="step-bar-wrapper card-body">
            <form id="performanceForm" action="{{ route('performance.management.performanceStepOnePost') }}" method="POST">
                @csrf

                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column"><span class="card-label fw-bold fs-1 mb-1">Performance</span></h3>
                        <div class="card-toolbar">
                            <div id="note" class="alert alert-warning" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="card-body px-6 pb-6">
                        <div class="row g-5 g-xl-10 mb-5 mb-xl-10" id="card_content">
                            <div class="col-lg-12">
                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                    <div class="objectives-container">
                                        <div class="row objective-row mb-3" data-objective-index="0">
                                            <div class="col-lg-6 pe-3">
                                                <h5 class="mb-2">Objective</h5>
                                                <input type="hidden" name="objectives[0][id]" value="new">
                                                <input id="name" type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[0][title]" placeholder="Objective" value="">
                                            </div>
                                            <div class="col-lg-6">
                                                <h5 class="mb-2">Weightage</h5>
                                                <p>Max Weightage 100%</p>
                                                <input type="number" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[0][weightage]" placeholder="Weightage" value="">
                                            </div>
                                            <div class="kpi-container">
                                                <div class="row kpi-row mb-3" data-kpi-index="0">
                                                    <div class="col-lg-3">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                            <h5 for="kpi" class="mb-2">KPI</h5>
                                                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[0][kpis][0][title]" placeholder="Enter KPI">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                            <h5 for="base_target" class="mb-2">Base Target</h5>
                                                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[0][kpis][0][base_target]" placeholder="Enter Base Target">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                            <h5 for="stretch_target" class="mb-2">Stretch Target</h5>
                                                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[0][kpis][0][stretch_target]" placeholder="Enter Stretch Target">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                            <h5 for="employee_planning" class="mb-2">Employee Planning</h5>
                                                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[0][kpis][0][employee_planning]" placeholder="Enter Employee Planning">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-secondary add-kpi" data-objective-index="0">Add KPI</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="add_new_objective" class="btn btn-primary">Add New Objective</button>
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
                                    <th class="min-w-100px">Employee Planning</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($user['technical_skills'] as $index => $skill)
                                @php
                                $approvedRating = null;
                                $remark = null;

                                foreach ($skillReviews as $review) {
                                    foreach ($review->details as $detail) {
                                        if ($detail->name == $skill['name']) {
                                            $approvedRating = $detail->level;
                                            $remark = $detail->remark;
                                            break 2;
                                        }
                                    }
                                }

                                $gap = $approvedRating !== null && $skill['pivot']['level'] !== null ? $approvedRating - $skill['pivot']['level'] : null;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $skill['name'] }}</td>
                                    <td>{{ $approvedRating }}</td>
                                    <td>{{ $skill['pivot']['level'] }}</td>
                                    <td>{{ $gap }}</td>
                                    <td><input type="text" class="form-control" placeholder="Enter planning" name="technical_skills[{{ $skill['name'] }}][plan]"></td>
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
                                <th class="min-w-100px">Employee Planning</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($user['skills'] as $index => $skill)
                            @php
                            $approvedRating = null;
                            $remark = null;

                            foreach ($skillReviews as $review) {
                                foreach ($review->details as $detail) {
                                    if ($detail->name == $skill['title']) {
                                        $approvedRating = $detail->level;
                                        $remark = $detail->remark;
                                        break 2;
                                    }
                                }
                            }

                            $gap = $approvedRating !== null && $skill['level'] !== null ? $approvedRating - $skill['level'] : null;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $skill['title'] }}</td>
                                <td>{{ $approvedRating }}</td>
                                <td>{{ $skill['level'] }}</td>
                                <td>{{ $gap }}</td>
                                <td><input type="text" class="form-control" placeholder="Enter planning" name="soft_skills[{{ $skill['title'] }}][plan]"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    var objectiveCount = 1;

    $('#add_new_objective').click(function() {
        var currentObjectives = $('.objectives-container .objective-row').length;
        if (currentObjectives >= 5) {
            alert('You can only add up to 5 objectives.');
            return;
        }

        var newIndex = objectiveCount++;
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
                <div class="kpi-container">
                    <div class="row kpi-row mb-3" data-kpi-index="0">
                        <div class="col-lg-3">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <h5 for="kpi" class="mb-2">KPI</h5>
                                <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${newIndex}][kpis][0][title]" placeholder="Enter KPI">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <h5 for="base_target" class="mb-2">Base Target</h5>
                                <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${newIndex}][kpis][0][base_target]" placeholder="Enter Base Target">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <h5 for="stretch_target" class="mb-2">Stretch Target</h5>
                                <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${newIndex}][kpis][0][stretch_target]" placeholder="Enter Stretch Target">
                            </div>
                        </div>
                         <div class="col-lg-3">
                            <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                <h5 for="employee_planning" class="mb-2">Employee Planning</h5>
                                <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${newIndex}][kpis][0][employee_planning]" placeholder="Enter Employee Planning">
                            </div>
                        </div>
                        <div class="col-lg-12" style="margin-top: 8px;">
                            <button type="button" class="btn btn-danger remove-kpi" title="Remove KPI">Remove KPI</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button type="button" class="btn btn-secondary add-kpi" data-objective-index="${newIndex}">Add KPI</button>
                </div>
                <div class="col-lg-12" style="margin-top: 8px;">
                    <button type="button" class="btn btn-danger remove-objective" title="Remove objective">Remove Objective</button>
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
        var kpiContainer = $(this).closest('.objective-row').find('.kpi-container');
        var currentKpis = kpiContainer.find('.kpi-row').length;
        if (currentKpis >= 5) {
            alert('You can only add up to 5 KPIs per objective.');
            return;
        }

        var kpiIndex = currentKpis;
        var newKpiHtml = `
            <div class="row kpi-row mb-3" data-kpi-index="${kpiIndex}">
                <div class="col-lg-3">
                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                        <h5 for="kpi" class="mb-2">KPI</h5>
                        <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${objectiveIndex}][kpis][${kpiIndex}][title]" placeholder="Enter KPI">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                        <h5 for="base_target" class="mb-2">Base Target</h5>
                        <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${objectiveIndex}][kpis][${kpiIndex}][base_target]" placeholder="Enter Base Target">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                        <h5 for="stretch_target" class="mb-2">Stretch Target</h5>
                        <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${objectiveIndex}][kpis][${kpiIndex}][stretch_target]" placeholder="Enter Stretch Target">
                    </div>
                </div>
                  <div class="col-lg-3">
                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                        <h5 for="employee_planning" class="mb-2">Employee Planning</h5>
                        <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" name="objectives[${objectiveIndex}][kpis][${kpiIndex}][employee_planning]" placeholder="Enter Employee Planning">
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 8px;">
                    <button type="button" class="btn btn-danger remove-kpi" title="Remove KPI">Remove KPI</button>
                </div>
            </div>
        `;

        kpiContainer.append(newKpiHtml);
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
                    $('#performanceForm').submit(); // Submit the form
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
