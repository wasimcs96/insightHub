@extends('admin.layout.app')

@section('title', 'Potentials')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-7 flex-column justify-content-center my-0">
                Growth Potential

            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-8 my-0 pt-1">

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Dashboard </a>
                </li>
                {{-- <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    Shortlists </li> --}}
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->
        <form class="d-flex align-items-center overflow-auto" action="">
            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Age:</span>
            <!--end::Label-->
            @php
            $employees = \App\Models\User::where('is_personality_motivation_completed', 1)
            ->where('is_work_interest_completed', 1)
            ->where('is_cognitive_ability_completed', 1)
            ->get();
            @endphp
            <!--begin::Select-->
            {{-- <form action="d-flex align-items-center overflow-auto"> --}}
            <select class="form-select form-select-sm w-125px form-select-solid me-6" data-control="select2" data-placeholder="Select Age" data-hide-search="true" name="age" id="age">
                <option selected="Selected" value="" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    Select Age</option>
                <option @if (request('age')=='15_20' ) selected @endif value="15_20" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    15 - 20 Years
                </option>
                <option @if (request('age')=='21_25' ) selected @endif value="21_25" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    21 - 25 Years</option>
                <option @if (request('age')=='26_30' ) selected @endif value="26_30" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    26 - 30 Years</option>
                <option @if (request('age')=='31_35' ) selected @endif value="31_35" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    31 - 35 Years</option>
                <option @if (request('age')=='36_40' ) selected @endif value="36_40" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    36 - 40 Years</option>
                <option @if (request('age')=='40_100' ) selected @endif value="40_100" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    40 + Years</option>
            </select>
            <!--end::Select-->
            <!--begin::Separartor-->
            <div class="bullet bg-secondary h-35px w-1px mx-6"></div>
            <!--end::Separartor-->
            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Gender:</span>
            <!--end::Label-->

            <!--begin::Select-->
            <select class="form-select form-select-sm w-125px form-select-solid me-6" data-control="select2" data-placeholder="Select Gender" data-hide-search="true" name="gender" id="gender">
                <option selected="selected" value="" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    Select Gender</option>
                <option @if (request('gender')=='0' ) selected @endif value="0" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    Male
                </option>
                <option @if (request('gender')==1) selected @endif value="1" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    Female</option>
            </select>
            <!--end::Select-->
            <!--begin::Label-->
            <!--begin::Separartor-->
            <div class="bullet bg-secondary h-35px w-1px mx-6"></div>
            <!--end::Separartor-->
            @php
            $education_levels = \App\Models\MasterEducationLevel::all();
            @endphp
            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Education Level:</span>
            <!--end::Label-->

            <!--begin::Select-->
            <select class="form-select form-select-sm w-125px form-select-solid me-6" data-control="select2" data-placeholder="Select Education Level" data-hide-search="true" name="education_level" id="education_level">
                <option selected="selected" value="" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    Select Education Level</option>
                @foreach($education_levels as $education_level)
                <option value="{{ $education_level->id }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600" {{
                        request('education_level')==$education_level->id ? 'selected' : '' }}>{{ $education_level->name
                        ?? '' }}</option>
                @endforeach

            </select>

            <div class="bullet bg-secondary h-35px w-1px mx-6"></div>
            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Work Experience:</span>
            <!--end::Label-->

            <!--begin::Select-->
            <select class="form-select form-select-sm w-125px form-select-solid me-6" data-control="select2" data-placeholder=" Select Work Experience" data-hide-search="true" name="work_experience" id="work_experience">
                <option value="" selected="selected" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    Select Work Experience
                </option>
                <option @if (request('work_experience')=='0_3' ) selected @endif value="0_3" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    0 - 3 Years</option>

                <option @if (request('work_experience')=='3_5' ) selected @endif value="3_5" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    3 - 5 Years
                </option>
                <option @if (request('work_experience')=='5_100' ) selected @endif value="5_100" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    5 + Years
                </option>

            </select>

            <div class="bullet bg-secondary h-35px w-1px mx-6"></div>
            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block"> Select Potential:</span>
            <!--end::Label-->

            <!--begin::Select-->
            <select class="form-select form-select-sm w-125px form-select-solid me-6" data-control="select2" data-placeholder=" Select Work Experience" data-hide-search="true" name="work_experience" id="work_experience">
                <option value="" selected="selected" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    Select Potential
                </option>
                <option @if (request('potential')=='3' ) selected @endif value="3" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    Super High Potential
                </option>

                <option @if (request('potential')=='2' ) selected @endif value="2" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    High Potential
                </option>

                <option @if (request('potential')=='1' ) selected @endif value="1" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                    Low Potential
                </option>


            </select>
            <!--begin::Actions-->
            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-sm btn-icon btn-light-primary me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                    <iconify-icon icon="mingcute:filter-line" class="fa-2x"></iconify-icon>
                </button>

                <a href="/admin/potentials" class="btn btn-sm btn-icon btn-light me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset">
                    <iconify-icon icon="bx:reset" class="fa-2x"></iconify-icon>
                </a>
                {{-- <button class="btn btn-sm btn-icon btn-light-success " value="export" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Reset">
                        <iconify-icon icon="clarity:export-line" class="fa-2x"> </iconify-icon>
                    </button> --}}
            </div>
            {{--
            </form> --}}
            <!--end::Actions-->
        </form>
        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>

<div id="kt_app_content" class="app-content  flex-column-fluid ">

    <div id="kt_app_content_container" class="app-container  w-100 ">
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Employee Listings</span>

                    {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                </h3>
                {{-- <div class="card-toolbar">
                    <a href="#" class="btn btn-sm btn-light-primary">
                        <i class="ki-duotone ki-plus fs-2"></i> New Member
                    </a>
                </div> --}}
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-325px rounded-start">User</th>
                                <th class="min-w-125px text-center">Level</th>

                                <th class="min-w-125px text-center">Position</th>
                                <th class="min-w-125px text-center">Age</th>


                                <th class="min-w-200px text-center">Phone</th>
                                <th class="min-w-150px text-center">City</th>
                                <th class="min-w-200px text-center rounded-end">Potential</th>
                                <th class="min-w-200px text-center rounded-end">Education Level</th>
                                <th class="min-w-200px text-center rounded-end">Learning Institution</th>
                                <th class="min-w-200px text-center rounded-end">Scope Of Study</th>
                                <th class="min-w-200px text-center rounded-end"> Work Experience in IT</th>
                                <th class="min-w-200px text-center rounded-end">Action</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            @foreach($potentials as $potential)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div class="symbol symbol-50px me-5">
                                            <img src="{{asset($potential->profile_picture)}}" onerror="this.src='{{ asset('admin/media/avatars/default-avatar.png') }}'" class="" alt="" />

                                        </div>

                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="/admin/employee-details/{{$potential->id}}" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">{{ $potential->first_name ?? ''}} {{ $potential->last_name ?? '' }}</a>
                                            <span class="text-muted fw-semibold text-muted d-block fs-7">{{ strtolower($potential->email) ?? ''}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $potential->job_position->level ?? '1' }}</span>

                                </td>
                                <td>
                                    <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $potential->job_position->title ?? 'N/A' }}</span>

                                </td>
                                <td>
                                    <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $potential->age ?? ''}}</span>

                                </td>


                                <td>

                                    <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $potential->mobile_number ?? ''}}</span>
                                </td>

                                <td>
                                    <span class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $potential->city ?? ''}}</span>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-center text-hover-primary d-block mb-1 fs-6">
                                        @if($potential->potential == 3)
                                        <iconify-icon icon="codicon:verified-filled" class="toolTip onTop" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Super High Potential " data-tippy-theme="dark" style="background: #08d36e;border-radius: 50%;font-size: x-large;"></iconify-icon>


                                        @elseif($potential->potential == 2)
                                        <iconify-icon icon="codicon:verified" class="toolTip onTop" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="High Potential"  style="background: #16b7f9;border-radius: 50%;font-size: x-large;"></iconify-icon>

                                        @else
                                        <iconify-icon icon="solar:verified-check-broken" class="toolTip onTop" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Low Potential " data-tippy-theme="dark" style="background: #9ba9a2;border-radius: 50%;font-size: x-large;"></iconify-icon>

                                        @endif
                                    </span>
                                </td>
                                {{-- <td>
                                    <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $potential->home_address ?? ''}}</span>

                                </td> --}}

                                <td>

                                    <span class="text-gray-900 fw-bold text-center text-hover-primary d-block mb-1 fs-6">{{ $potential->education_level_check->name ?? ''}}</span>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-center text-hover-primary d-block mb-1 fs-6">{{ $potential->higher_learning->name ?? ''}}</span>
                                </td>
                                <td>
                                    <span class="text-gray-900 fw-bold text-center text-hover-primary d-block mb-1 fs-6">{{ $potential->scope->name ?? ''}}</span>
                                </td>
                                <td>
                                    <span class="text-gray-900 fw-bold text-center text-hover-primary d-block mb-1 fs-6">{{ $potential->year_of_experience_in_it_sector ?? ''}}</span>
                                </td>
                                <td class="text-center">
                                    <a href="/admin/employee-details/{{$potential->id}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <iconify-icon icon="fluent:eye-20-regular"></iconify-icon>
                                    </a>

                                    {{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </a>

                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span><span class="path5"></span></i> </a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->

                </div>
                {{ $potentials->links() }}

                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
    </div>

</div>

{{-- {{dd($labels)}} --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    function exportToExcel() {
        // Select the table element
        var table = document.getElementById('table');

        // Convert table to worksheet
        // var ws = XLSX.utils.table_to_sheet(table, {autoWidth: true});
        // Convert table to worksheet
        var ws = XLSX.utils.table_to_sheet(table);

        // Calculate column widths
        var colWidths = [];
        var rows = XLSX.utils.sheet_to_json(ws, {
            header: 1
        });
        rows.forEach(function(row) {
            row.forEach(function(cell, colIndex) {
                var cellText = cell ? cell.toString() : '';
                var cellLength = cellText.length;
                colWidths[colIndex] = (colWidths[colIndex] || 0) < cellLength ? cellLength : (colWidths[colIndex] || 0);
            });
        });

        // Apply calculated column widths to the worksheet
        ws['!cols'] = colWidths.map(function(width) {
            return {
                wch: width
            };
        });

        // Create a workbook and add the worksheet
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

        // Save the workbook as a file
        XLSX.writeFile(wb, 'potential_employees.xlsx');
    }

</script>


@endsection
