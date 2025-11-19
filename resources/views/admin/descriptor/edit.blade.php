@extends('admin.layout.app')

@section('title', 'Create Leave')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Descriptor Edit
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Dashboard </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/descriptors/index" class="capitalize text-muted text-hover-primary">
                        My Descriptor
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{ !empty($user) ? 'Edit Descriptor' : 'Edit Descriptor' }}
                </li>
            </ul>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a href="{{ route('descriptors.index') }}" class="btn btn-primary d-flex align-items-center">
                    <iconify-icon icon="weui:back-filled"></iconify-icon>
                    Back To List
                </a>
            </div>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('descriptors.update', $descriptor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- This is important for update method -->
                    <div class="row">
                        <!-- Name Field -->
                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Name</label>
                            <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $descriptor->name) }}" placeholder="Enter Name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Job Requirement Level</label>
                            <input type="number" name="job_requirement_level" class="form-control form-control-solid @error('job_requirement_level') is-invalid @enderror" 
                                   value="{{ old('job_requirement_level', $descriptor->job_requirement_level) }}" placeholder="Enter Job Requirement Level" required>
                            @error('job_requirement_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Population Score Level</label>
                            <input type="number" name="population_score_level" class="form-control form-control-solid @error('population_score_level') is-invalid @enderror" 
                                   value="{{ old('population_score_level', $descriptor->population_score_level) }}" placeholder="Enter Population Score Level" required>
                            @error('population_score_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">User Score Level</label>
                            <input type="number" name="user_score_level" class="form-control form-control-solid @error('user_score_level') is-invalid @enderror" 
                                   value="{{ old('user_score_level', $descriptor->user_score_level) }}" placeholder="Enter User Score Level" required>
                            @error('user_score_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Job Requirement Level Description</label>
                            <input type="text" name="job_requirement_level_description" class="form-control form-control-solid @error('job_requirement_level_description') is-invalid @enderror" 
                            value="{{ old('job_requirement_level_description', $descriptor->job_requirement_level_description) }}" placeholder="Enter Job Requirement Level Description" required>
                            @error('job_requirement_level_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Population Score Level Description</label>
                            <input type="text" name="population_score_level_description" class="form-control form-control-solid @error('population_score_level_description') is-invalid @enderror" 
                             value="{{ old('population_score_level_description', $descriptor->population_score_level_description) }}" placeholder="Enter Population Score Level Description" required>
                            @error('population_score_level_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">User Score Level Description</label>
                            <input type="text" name="user_score_level_description" class="form-control form-control-solid @error('user_score_level_description') is-invalid @enderror" 
                             value="{{ old('user_score_level_description', $descriptor->user_score_level_description) }}" placeholder="Enter User Score Level Description" required>
                            @error('user_score_level_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="col-lg-6 mb-5">
                            <label for="user_type" class="fw-semibold fs-6">User Type</label>
                            <select class="form-control" id="user_type" name="user_type" required>
                                <option value="employee" {{ $descriptor->user_type == 'employee' ? 'selected' : '' }}>Employee</option>
                                <option value="candidate" {{ $descriptor->user_type == 'candidate' ? 'selected' : '' }}>Candidate</option>
                            </select>
                            @error('user_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="col-lg-6 mb-5">
                            <label for="assessment_type" class="fw-semibold fs-6">Assessment Type</label>
                            <select id="assessment_type" name="assessment_type" class="form-control">
                                <option value="ocean" {{ $descriptor->assessment_type == 'ocean' ? 'selected' : '' }}>OCEAN</option>
                                <option value="riasec" {{ $descriptor->assessment_type == 'riasec' ? 'selected' : '' }}>RIASEC</option>
                                <option value="cognitive" {{ $descriptor->assessment_type == 'cognitive' ? 'selected' : '' }}>Cognitive</option>
                            </select>
                            @error('assessment_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="col-lg-6 mb-5">
                            <label for="result_type" class="fw-semibold fs-6">Result Type</label>
                            <select id="result_type" name="result_type" class="form-control">
                                <option value="domains" {{ $descriptor->result_type == 'domains' ? 'selected' : '' }}>Domains</option>
                                <option value="all_facets" {{ $descriptor->result_type == 'all_facets' ? 'selected' : '' }}>All Facets</option>
                                <option value="job_match_rate" {{ $descriptor->result_type == 'job_match_rate' ? 'selected' : '' }}>Job Match Rate</option>
                                <option value="cognitive_assessment" {{ $descriptor->result_type == 'cognitive_assessment' ? 'selected' : '' }}>Cognitive Assessment</option>
                                <option value="technical_assessment" {{ $descriptor->result_type == 'technical_assessment' ? 'selected' : '' }}>Technical Assessment</option>
                                <option value="growth_potential" {{ $descriptor->result_type == 'growth_potential' ? 'selected' : '' }}>Growth Potential</option>
                                <option value="organization_fit_forecast" {{ $descriptor->result_type == 'organization_fit_forecast' ? 'selected' : '' }}>Organization Fit Forecast</option>
                                <option value="flight_risk" {{ $descriptor->result_type == 'flight_risk' ? 'selected' : '' }}>Flight Risk</option>
                                <option value="soft_skills" {{ $descriptor->result_type == 'soft_skills' ? 'selected' : '' }}>Soft Skills</option>
                                <option value="ccs" {{ $descriptor->result_type == 'ccs' ? 'selected' : '' }}>CCS</option>
                            </select>
                            @error('result_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="col-lg-6 mb-5">
                            <label for="analysis" class="fw-semibold fs-6">Analysis</label>
                            <textarea id="analysis" name="analysis" class="form-control" rows="3">{{ old('analysis', $descriptor->analysis) }}</textarea>
                            @error('analysis')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="col-lg-6 mb-5">
                            <label for="analysis_population" class="fw-semibold fs-6">Analysis (Population-Based)</label>
                            <textarea id="analysis_population" name="analysis_population" class="form-control" rows="3">{{ old('analysis_population', $descriptor->analysis_population) }}</textarea>
                            @error('analysis_population')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-5">
                            <label class="fw-semibold fs-6">Is Descriptor</label>
                            <div class="form-check">
                                <input type="checkbox" name="is_descriptor" id="is_descriptor" value="1" class="form-check-input" 
                                    {{ isset($descriptor) && $descriptor->is_descriptor == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_descriptor">Check if applicable</label>
                            </div>
                            @error('is_descriptor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
