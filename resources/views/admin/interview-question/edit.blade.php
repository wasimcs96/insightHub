@extends('admin.layout.app')

@section('title', 'Edit Interview Questions')

@section('styles')
    <style>
        .app-wrapper { margin-top: 90px !important; }
        .app-container { padding: 0px !important; margin: 0px 186px !important; }
        .heading { font-size: 22.75px; font-weight: 500; margin: 30px 0; }
        .top-card { padding: 24px; background: #FFF; border: 1px solid #F1F1F4; border-radius: 8px 8px 0 0; box-shadow: 0 3px 4px rgba(0, 0, 0, 0.03); }
        .inner-card { padding: 32px; background: #FFF; border: 1px solid #F1F1F4; border-top: none; border-radius: 0 0 8px 8px; box-shadow: 0 3px 4px rgba(0, 0, 0, 0.03); }
        .button { padding: 14px 20px; font-size: 14px; font-weight: 600; border-radius: 4px; }
        .btn-outline { border: 1px solid #F7941C; background: #fff; color: #F7941C; }
        .btn-disabled { background: #F1F1F4; border: 1px solid #DBDFE9; color: #99A1B7; pointer-events: none; }
        .btn-enabled { background: #F7941C; border: 1px solid #F7941C; color: #fff; }
        .form-label { font-size: 12px; font-weight: 500; }
        .input-div p { font-size: 14px; font-weight: 500; }
        .remove-btn { margin-top: 37px; }
        .back-btn{
             color: #F7941C;
        }
    </style>
@endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
       
        <div id="kt_app_content_container" class="app-container styles-edit">
            <a href="{{route('admin.interview-question.index')}}">
                <p class="d-flex align-items-center gap-3 back-btn"><iconify-icon icon="majesticons:arrow-left-line"
                    width="18" height="18"></iconify-icon> Back to List
            </p>
               </a>
            <h4 class="heading">Edit Interview Questions</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.interview-question.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="department_id" value="{{ $department_id }}">
                <input type="hidden" name="job_id" value="{{ $job_id }}">

                <!-- Role Info -->
                <div class="card-heading mb-9">
                    <div class="top-card">
                        <h3>Role Selected</h3>
                    </div>
                    <div class="inner-card">
                        <div class="row mb-7">
                            <div class="col-lg-6">
                                <label class="form-label">Department</label>
                                <select name="department_id" id="department" class="form-control @error('department_id') is-invalid @enderror" required>
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $department->id == old('department_id', $department_id) ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>
                    
                            <div class="col-lg-6">
                                <label class="form-label">Job</label>
                                <select name="job_id" id="job" class="form-control @error('job_id') is-invalid @enderror" required>
                                    <option value="">Select Job</option>
                                    @foreach($jobs as $job)
                                        <option value="{{ $job->id }}" {{ $job->id == old('job_id', $job_id) ? 'selected' : '' }}>
                                            {{ $job->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('job_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Question Section -->
                <div class="card-heading">
                    <div class="top-card">
                        <h3 class="mb-3">Interview Questions</h3>
                        <p class="m-0">Update the questions you've already created</p>
                    </div>
                    <div class="inner-card">
                        {{-- <div class="d-flex justify-content-end mb-3">
                            <button id="add-question-btn" type="button" class="btn btn-primary">Add Question</button>
                        </div> --}}

                        <div id="question-container" class="d-flex flex-column gap-3">
                            @foreach($questions as $index => $question)
                            <p class="m-0">Question {{ $index + 1 }}</p>
                            <input type="hidden" name="question_ids[]" value="{{ $question->id }}">
                            <input type="text" name="title[]" value="{{ $question->title }}" class="form-control" required>
                        @endforeach
                        </div>

                        @error('title') <div class="text-danger mt-2">{{ $message }}</div> @enderror

                        <div class="d-flex justify-content-end mt-4">
                            <button id="submit-btn" type="submit" class="button btn-enabled">Update Interview Questions</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const maxQuestions = 10;
    const container = document.getElementById("question-container");
    const addBtn = document.getElementById("add-question-btn");
    const submitBtn = document.getElementById("submit-btn");

    function updateLabels() {
        const questions = container.querySelectorAll(".input-div");
        questions.forEach((div, index) => {
            div.querySelector("p").textContent = `Question ${index + 1}`;
        });
    }

    function bindRemoveButtons() {
        container.querySelectorAll(".remove-btn").forEach(btn => {
            btn.onclick = function () {
                btn.closest(".input-div").remove();
                updateLabels();
                addBtn.disabled = container.children.length >= maxQuestions;
            };
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        bindRemoveButtons();
    });

    addBtn.addEventListener("click", () => {
        if (container.children.length >= maxQuestions) return;

        const div = document.createElement("div");
        div.className = "input-div d-flex align-items-start gap-2";

        div.innerHTML = `
            <div class="flex-grow-1">
                <p>Question ${container.children.length + 1}</p>
                <input type="text" class="form-control" name="title[]" placeholder="Enter Question Title" required>
            </div>
            <button type="button" class="btn btn-sm btn-danger remove-btn" title="Remove Question">&times;</button>
        `;

        container.appendChild(div);
        updateLabels();
        bindRemoveButtons();

        if (container.children.length >= maxQuestions) {
            addBtn.disabled = true;
        }
    });
</script>

<script>
    $(document).ready(function () {
        const selectedJobId = "{{ old('job_id', $job_id ?? '') }}";

        // Load jobs when department changes
        $('#department').on('change', function () {
            const deptId = $(this).val();
            $('#job').html('<option value="">Select Job</option>');

            if (deptId) {
                $.ajax({
                    url: '/admin/get-job-by-department/' + deptId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        data.forEach(function (job) {
                            const selected = job.id == selectedJobId ? 'selected' : '';
                            $('#job').append(`<option value="${job.id}" ${selected}>${job.title}</option>`);
                        });
                    },
                    error: function () {
                        alert('Could not fetch jobs.');
                    }
                });
            }
        });

        // Trigger load if editing with existing department_id
        const currentDept = $('#department').val();
        if (currentDept) {
            $('#department').trigger('change');
        }
    });
</script>


@endsection