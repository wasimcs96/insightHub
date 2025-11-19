@extends('admin.layout.app')

@section('title', 'Edit Technical Questions')

@section('content')
@section('style')
<style>
    .error-message {
    color: red;
    font-size: 0.875rem;
}
/* <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> */
</style>

@endsection
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Technical Assessment Edit
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
                    <a href="/admin/technical/assessment/index" class="capitalize text-muted text-hover-primary">
                        My Assessment
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{ !empty($user) ? 'Edit Assessment' : 'Edit Assessment' }}
                </li>
            </ul>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a href="{{ route('technicalAss.index') }}" class="btn btn-primary d-flex align-items-center">
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
                <form class="form" id="technical-form" action="{{ route('technical.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-7">
                        <!-- Business Unit -->
                        <div class="col-lg-3">
                            <label class="fw-semibold fs-6 mb-2 form-label" for="business_unit">Business Unit</label>
                            <select name="business_unit_id" id="business_unit" class="form-control">
                                <option value="">Select Business Unit</option>
                                @if(!empty($businessUnits))
                                    @foreach($businessUnits as $bu)
                                        <option value="{{ $bu->id }}" {{ old('business_unit_id', $selectedBusinessUnitId ?? '') == $bu->id ? 'selected' : '' }}>{{ $bu->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Company / Division -->
                        <div class="col-lg-3">
                            <label class="fw-semibold fs-6 mb-2 form-label" for="company">Company / Division</label>
                            <select name="company_id" id="company" class="form-control">
                                <option value="">Select Company/Division</option>
                                {{-- divisions will be populated by AJAX; we can optionally render a selected division if available --}}
                            </select>
                        </div>

                        <!-- Department -->
                        <div class="col-lg-3">
                            <label class="fw-semibold fs-6 mb-2 form-label" for="department">Department</label>
                            <select name="department_id" id="department" class="form-control">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id', $departmentId) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Job Dropdown -->
                        <div class="col-lg-3">
                            <label class="fw-semibold fs-6 mb-2 form-label" for="job">Job</label>
                            <select name="job_id" id="job" class="form-control">
                                <option value="">Select Job</option>
                                @foreach($jobs as $jobItem)
                                    <option value="{{ $jobItem->id }}" {{ old('job_id', $job->id) == $jobItem->id ? 'selected' : '' }}>
                                        {{ $jobItem->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Add Question Button -->
                  

                    <!-- Questions Section -->
                    <div id="questions-container">
                        {{-- If old inputs exist after validation failure, prefer rendering old inputs so user's typed values are preserved --}}
                        @php
                            $oldTitles = old('titles');
                        @endphp

                        @if($oldTitles && is_array($oldTitles))
                            @foreach($oldTitles as $index => $oldTitle)
                                @php
                                    $oldLevels = old('levels', []);
                                    $oldQuestionNumbers = old('question_numbers', []);
                                    $oldScores = old('scores', []);
                                    $oldOptions = old('options', []);
                                    $oldCorrect = old('correct_answer', []);
                                @endphp
                                <div class="fv-row mb-7 row question-item" data-question-index="{{ $index }}">
                                    <input type="hidden" name="question_ids[]" value="{{ old('question_ids.' . $index) ?? '' }}">
                                    <div class="input-area col-xl-3">
                                        <label for="titles[{{ $index }}]" class="form-label">{{ trans('Title') }}</label>
                                        <input type="text" class="form-control" name="titles[{{ $index }}]" value="{{ $oldTitle }}" placeholder="Enter Title" required>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="levels[{{ $index }}]" class="form-label">{{ trans('Level') }}</label>
                                        <select class="form-control" name="levels[{{ $index }}]" id="levels[{{ $index }}]" required>
                                            <option value="" disabled>Select Level</option>
                                            <option value="1" {{ ($oldLevels[$index] ?? '') == '1' ? 'selected' : '' }}>Level 1</option>
                                            <option value="2" {{ ($oldLevels[$index] ?? '') == '2' ? 'selected' : '' }}>Level 2</option>
                                            <option value="3" {{ ($oldLevels[$index] ?? '') == '3' ? 'selected' : '' }}>Level 3</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="question_numbers[{{ $index }}]" class="form-label">{{ trans('Question Number') }}</label>
                                        <input type="number" class="form-control" name="question_numbers[{{ $index }}]" value="{{ $oldQuestionNumbers[$index] ?? '' }}" placeholder="Enter Question Number" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="scores[{{ $index }}]" class="form-label">{{ trans('Score') }}</label>
                                        <input type="number" class="form-control" name="scores[{{ $index }}]" value="{{ $oldScores[$index] ?? '' }}" placeholder="Enter Score" required>
                                    </div>

                                    <div class="col-lg-12 mt-5">
                                        <div class="options-container">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button type="button" class="btn btn-sm btn-primary mb-3 add-option-btn">
                                                    <i class="fas fa-plus-circle"></i> {{ trans('Add Option') }}
                                                </button>
                                            </div>
                                            @php $optionsForQuestion = $oldOptions[$index] ?? []; @endphp
                                            @if(!empty($optionsForQuestion))
                                                @foreach($optionsForQuestion as $optIndex => $opt)
                                                    <div class="form-group d-flex align-items-center mb-3 option-item">
                                                        <span class="option-label mr-2">{{ chr(65 + $optIndex) }}.</span>
                                                        <input type="text" class="form-control mr-3" name="options[{{ $index }}][{{ $optIndex }}][text]" value="{{ $opt['text'] ?? '' }}" placeholder="Enter Option" required>
                                                        <div class="form-check mr-3">
                                                            <input type="checkbox" class="form-check-input" name="correct_answer[{{ $index }}]" value="{{ $optIndex }}" {{ (isset($oldCorrect[$index]) && (string)$oldCorrect[$index] === (string)$optIndex) ? 'checked' : '' }}>
                                                            <label class="form-check-label">{{ trans('Correct') }}</label>
                                                        </div>
                                                        <button type="button" class="btn btn-danger btn-sm remove-option-btn">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @else
                                                {{-- fallback: show 4 empty options if none present --}}
                                                @for ($i = 0; $i < 4; $i++)
                                                    <div class="form-group d-flex align-items-center mb-3 option-item">
                                                        <span class="option-label mr-2">{{ chr(65 + $i) }}.</span>
                                                        <input type="text" class="form-control mr-3" name="options[{{ $index }}][{{ $i }}][text]" value="" placeholder="Enter Option" required>
                                                        <div class="form-check mr-3">
                                                            <input type="checkbox" class="form-check-input" name="correct_answer[{{ $index }}]" value="{{ $i }}">
                                                            <label class="form-check-label">{{ trans('Correct') }}</label>
                                                        </div>
                                                        <button type="button" class="btn btn-danger btn-sm remove-option-btn">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                @endfor
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Remove Question Button -->
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-danger remove-question-btn">{{ trans('Remove Question') }}</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach($technicalAss as $index => $question)
                                <div class="fv-row mb-7 row question-item" data-question-index="{{ $index }}">
                                    <input type="hidden" name="question_ids[]" value="{{ $question->id }}">
                                    <div class="input-area col-xl-3">
                                        <label for="titles[{{ $index }}]" class="form-label">{{ trans('Title') }}</label>
                                        <input type="text" class="form-control" name="titles[{{ $index }}]" value="{{ $question->title }}" placeholder="Enter Title" required>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="levels[{{ $index }}]" class="form-label">{{ trans('Level') }}</label>
                                        <select class="form-control" name="levels[{{ $index }}]" id="levels[{{ $index }}]" required>
                                            <option value="" disabled>Select Level</option>
                                            <option value="1" {{ old("levels.$index", $question->level) == '1' ? 'selected' : '' }}>Level 1</option>
                                            <option value="2" {{ old("levels.$index", $question->level) == '2' ? 'selected' : '' }}>Level 2</option>
                                            <option value="3" {{ old("levels.$index", $question->level) == '3' ? 'selected' : '' }}>Level 3</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="question_numbers[{{ $index }}]" class="form-label">{{ trans('Question Number') }}</label>
                                        <input type="number" class="form-control" name="question_numbers[{{ $index }}]" value="{{ $question->question_number }}" placeholder="Enter Question Number" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="scores[{{ $index }}]" class="form-label">{{ trans('Score') }}</label>
                                        <input type="number" class="form-control" name="scores[{{ $index }}]" value="{{ $question->score }}" placeholder="Enter Score" required>
                                    </div>

                                    <div class="col-lg-12 mt-5">
                                        <div class="options-container">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button type="button" class="btn btn-sm btn-primary mb-3 add-option-btn">
                                                    <i class="fas fa-plus-circle"></i> {{ trans('Add Option') }}
                                                </button>
                                            </div>
                                            @for ($i = 1; $i <= 4; $i++)
                                                <div class="form-group d-flex align-items-center mb-3 option-item">
                                                    <span class="option-label mr-2">{{ chr(64 + $i) }}.</span>

                                                    <input type="text" class="form-control mr-3" name="options[{{ $index }}][{{ $i - 1 }}][text]" value="{{ $question->{'option_' . $i} }}" placeholder="Enter Option" required>
                                                    <div class="form-check mr-3">
                                                        <input type="checkbox" class="form-check-input" name="correct_answer[{{ $index }}]" value="{{ $i - 1 }}" {{ $question->correct_answer === 'option_' . $i ? 'checked' : '' }}>
                                                        <label class="form-check-label">{{ trans('Correct') }}</label>
                                                    </div>
                                                    <button type="button" class="btn btn-danger btn-sm remove-option-btn">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    <!-- Remove Question Button -->
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-danger remove-question-btn">{{ trans('Remove Question') }}</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" id="add-question-btn" class="btn btn-sm btn-primary mb-3 add-both-btn">
                                <i class="fas fa-plus-circle"></i> {{ trans('Add Technical Question') }}
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="submit" class="btn btn-sm btn-primary mb-3">{{ trans('Update Questions') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const questionsContainer = document.getElementById('questions-container');
    const addBothBtn = document.querySelector('.add-both-btn');
    const form = document.querySelector('.form'); // Reference to the form element

    let questionCount = {{ $technicalAss->count() }}; // Start with the existing count of questions

    // Attach event listeners to existing remove buttons and radio buttons
    attachListeners();

    // Add form submit validation
    form.addEventListener('submit', function (e) {
        let valid = true; // Flag to track form validity
        const questionItems = document.querySelectorAll('.question-item'); // Get all question items

        questionItems.forEach((questionItem, index) => {
            // clean previous inline error markers
            questionItem.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            const existingError = questionItem.querySelector('.error-message');
            if (existingError) existingError.remove();

            const title = questionItem.querySelector(`input[name="titles[${index}]"]`);
            const level = questionItem.querySelector(`select[name="levels[${index}]"]`);
            const qnum = questionItem.querySelector(`input[name="question_numbers[${index}]"]`);
            const score = questionItem.querySelector(`input[name="scores[${index}]"]`);
            const optionInputs = questionItem.querySelectorAll(`input[name^="options[${index}]"]`);
            const checkboxes = questionItem.querySelectorAll('.form-check-input');

            // Title
            if (!title || !title.value.trim()) {
                valid = false;
                if (title) title.classList.add('is-invalid');
            }

            // Level
            if (!level || !level.value) {
                valid = false;
                if (level) level.classList.add('is-invalid');
            }

            // Question number
            if (!qnum || !qnum.value) {
                valid = false;
                if (qnum) qnum.classList.add('is-invalid');
            }

            // Score
            if (!score || !score.value) {
                valid = false;
                if (score) score.classList.add('is-invalid');
            }

            // Options: ensure at least 2 options, and each option text non-empty
            let optionEmpty = false;
            optionInputs.forEach(inp => {
                if (!inp.value || !inp.value.trim()) optionEmpty = true;
            });
            if (optionInputs.length < 2 || optionEmpty) {
                valid = false;
                questionItem.querySelectorAll('input[type="text"]').forEach(i => i.classList.add('is-invalid'));
            }

            // At least one correct selection
            const isChecked = Array.from(checkboxes).some(cb => cb.checked);
            if (!isChecked) {
                valid = false;
                const errorHtml = `<span class="error-message" style="color: red;">Please select one correct answer.</span>`;
                questionItem.querySelector('.options-container').insertAdjacentHTML('beforeend', errorHtml);
            }
        });

        if (!valid) {
            e.preventDefault(); // Prevent form submission if invalid
            // scroll to first error for better UX
            const firstInvalid = document.querySelector('.is-invalid, .error-message');
            if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    // --- BU -> Division -> Department -> Job wiring ---
    const selectedBU = '{{ old('business_unit_id', $selectedBusinessUnitId ?? '') }}';
    const selectedDivision = '{{ old('company_id', $selectedDivisionId ?? '') }}';
    const selectedDepartment = '{{ old('department_id', $departmentId ?? '') }}';
    const selectedJob = '{{ old('job_id', $job->id ?? '') }}';

    function loadDivisions(buId, selectedDivId) {
        if (!buId) {
            $('#company').html('<option value="">Select Company/Division</option>');
            return;
        }
        $.get('/admin/get-companies-by-bu/' + buId, function (data) {
            $('#company').html('<option value="">Select Company/Division</option>');
            $.each(data, function (i, division) {
                const sel = (selectedDivId && String(selectedDivId) === String(division.id)) ? 'selected' : '';
                $('#company').append(`<option value="${division.id}" ${sel}>${division.head_of_division || division.name || division.title || 'Division'}</option>`);
            });
            // Set the select value and load departments if a division was selected
            if (selectedDivId) {
                $('#company').val(selectedDivId);
                loadDepartments(selectedDivId, selectedDepartment);
            }
        });
    }

    function loadDepartments(divisionId, selectedDeptId) {
        if (!divisionId) {
            $('#department').html('<option value="">Select Department</option>');
            return;
        }
        $.get('/admin/get-departments-by-company/' + divisionId, function (data) {
            $('#department').html('<option value="">Select Department</option>');
            $.each(data, function (i, dept) {
                const sel = (selectedDeptId && String(selectedDeptId) === String(dept.id)) ? 'selected' : '';
                $('#department').append(`<option value="${dept.id}" ${sel}>${dept.name}</option>`);
            });
            // Set the select value and load jobs if a department was selected
            if (selectedDeptId) {
                $('#department').val(selectedDeptId);
                loadJobs(selectedDeptId, selectedJob);
            }
        });
    }

    function loadJobs(departmentId, selectedJobId) {
        if (!departmentId) {
            $('#job').html('<option value="">Select Job</option>');
            return;
        }
        $.get('/admin/get-jobs-by-department/' + departmentId, function (data) {
            $('#job').html('<option value="">Select Job</option>');
            $.each(data, function (i, job) {
                const sel = (selectedJobId && String(selectedJobId) === String(job.id)) ? 'selected' : '';
                $('#job').append(`<option value="${job.id}" ${sel}>${job.title}</option>`);
            });
            // Set the select value if a job was selected
            if (selectedJobId) {
                $('#job').val(selectedJobId);
            }
        });
    }

    // On page load, set business unit and populate the cascade
    $(document).ready(function () {
        const currentBU = $('#business_unit').val();
        
        if (currentBU && selectedDivision) {
            // Clear pre-populated department/job options
            $('#department').html('<option value="">Select Department</option>');
            $('#job').html('<option value="">Select Job</option>');
            
            // Load the cascade chain with preserved selections
            loadDivisions(currentBU, selectedDivision);
        }
    });

    // business unit change -> load divisions
    $(document).on('change', '#business_unit', function () {
        const bu = $(this).val();
        $('#company').html('<option value="">Select Company/Division</option>');
        $('#department').html('<option value="">Select Department</option>');
        $('#job').html('<option value="">Select Job</option>');
        if (bu) {
            loadDivisions(bu, null);
        }
    });

    // company change -> load departments
    $(document).on('change', '#company', function () {
        const division = $(this).val();
        $('#department').html('<option value="">Select Department</option>');
        $('#job').html('<option value="">Select Job</option>');
        if (division) {
            loadDepartments(division, null);
        }
    });

    // department change -> load jobs
    $(document).on('change', '#department', function () {
        const departmentId = $(this).val();
        $('#job').html('<option value="">Select Job</option>');
        if (departmentId) {
            loadJobs(departmentId, null);
        }
    });

    // Add new question
    addBothBtn.addEventListener('click', function () {
        const questionIndex = questionCount; // Use current count for indexing
        const questionHtml = `
            <div class="fv-row mb-7 row question-item" data-question-index="${questionIndex}">
                <div class="input-area col-xl-3">
                    <label for="titles[${questionIndex}]" class="form-label">{{ trans('Title') }}</label>
                    <input type="text" class="form-control" name="titles[${questionIndex}]" placeholder="Enter Title" required>
                </div>
                <div class="col-lg-3">
                    <label for="levels[${questionIndex}]" class="form-label">{{ trans('Level') }}</label>
                    <select class="form-control" name="levels[${questionIndex}]" required>
                        <option value="">Select Level</option>
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label for="question_numbers[${questionIndex}]" class="form-label">{{ trans('Question Number') }}</label>
                    <input type="number" class="form-control" name="question_numbers[${questionIndex}]" placeholder="Enter Question Number" required>
                </div>
                <div class="col-lg-3">
                    <label for="scores[${questionIndex}]" class="form-label">{{ trans('Score') }}</label>
                    <input type="number" class="form-control" name="scores[${questionIndex}]" placeholder="Enter Score" required>
                </div>

                <div class="col-lg-12 mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-primary mb-3 add-option-btn">
                            <i class="fas fa-plus-circle"></i> {{ trans('Add Option') }}
                        </button>
                    </div>
                    <div class="options-container mb-4">
                        <!-- Option inputs will be appended here one by one -->
                    </div>
                </div>

                <!-- Remove Question Button -->
                <div class="d-flex justify-content-end mt-3 col-12">
                    <button type="button" class="btn btn-danger remove-question-btn">{{ trans('Remove Question') }}</button>
                </div>
            </div>
        `;
        
        const questionSet = document.createElement('div');
        questionSet.innerHTML = questionHtml;
        questionsContainer.appendChild(questionSet);
        
        questionCount++;

        // Attach event listeners to the new question and options
        attachListeners();
    });

    function attachListeners() {
        // Attach remove question event
        document.querySelectorAll('.remove-question-btn').forEach(btn => {
            btn.removeEventListener('click', removeQuestion);
            btn.addEventListener('click', removeQuestion);
        });

        // Attach remove option event
        document.querySelectorAll('.remove-option-btn').forEach(btn => {
            btn.removeEventListener('click', removeOption);
            btn.addEventListener('click', removeOption);
        });

        // Attach add option event
        document.querySelectorAll('.add-option-btn').forEach(btn => {
            btn.removeEventListener('click', addOption);
            btn.addEventListener('click', addOption);
        });

        // Ensure only one checkbox is selected as correct answer per question
        document.querySelectorAll('.question-item').forEach(item => {
            const checkboxes = item.querySelectorAll('.form-check-input');
            checkboxes.forEach(cb => {
                cb.addEventListener('change', function () {
                    if (this.checked) {
                        checkboxes.forEach(other => {
                            if (other !== this) {
                                other.checked = false;
                            }
                        });

                        const errorContainer = item.querySelector('.error-message');
                        if (errorContainer) {
                            errorContainer.remove(); // Remove error message if checkbox is selected
                        }
                    }
                });
            });
        });
    }

    function removeQuestion(e) {
        e.target.closest('.question-item').remove();
    }

    function removeOption(e) {
        e.target.closest('.option-item').remove();
    }

    function addOption(e) {
        const optionsContainer = e.target.closest('.question-item').querySelector('.options-container');
        const questionIndex = e.target.closest('.question-item').getAttribute('data-question-index') || questionCount - 1;
        const optionCount = optionsContainer.querySelectorAll('.option-item').length;

        if (optionCount < 4) {
            const optionLabel = String.fromCharCode(65 + optionCount); // Generate label A, B, C, D based on option count

            const optionHtml = `
                <div class="form-group d-flex align-items-center mb-3 option-item">
                    <span class="option-label mr-2">${optionLabel}.</span>
                    <input type="text" class="form-control mr-3" name="options[${questionIndex}][${optionCount}][text]" placeholder="Enter Option" required>
                    <div class="form-check mr-3">
                        <input type="checkbox" class="form-check-input" name="correct_answer[${questionIndex}]" value="${optionCount}">
                        <label class="form-check-label">{{ trans('Correct') }}</label>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-option-btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            optionsContainer.insertAdjacentHTML('beforeend', optionHtml);

            // Reattach listeners
            attachListeners();
        } else {
            alert('{{ trans('Maximum 4 options allowed') }}');
        }
    }
});

</script>

@endsection
