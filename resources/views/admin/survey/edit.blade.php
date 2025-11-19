@extends('admin.layout.app')

@section('title', 'Edit Survey')

@section('styles')
{{-- Uncomment if needed --}}
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Edit Survey
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('survey.index') }}" class="capitalize text-muted text-hover-primary">My Surveys</a>
                </li>
                <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                <li class="breadcrumb-item text-muted">Edit Survey</li>
            </ul>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body">
                <form class="form" action="{{ route('survey.update', $survey->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-7">
                        <div class="col-lg-6">
                            <label class="fw-semibold fs-6 mb-2">Survey Title</label>
                            <input type="text" name="title" value="{{ old('title', $survey->title) }}"
                                class="form-control form-control-solid @error('title') is-invalid @enderror"
                                placeholder="Enter Survey Title" required>
                            @error('title')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label class="fw-semibold fs-6 mb-2">Survey Description</label>
                            <input type="text" name="description" value="{{ old('description', $survey->description) }}"
                                class="form-control form-control-solid @error('description') is-invalid @enderror"
                                placeholder="Enter Survey Description" required>
                            @error('description')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-25 mb-3">
                        <button type="button" class="btn btn-sm btn-primary add-both-btn">{{ trans('Add MCQ Questions') }}</button>
                    </div>
                    
                    <div id="questions-container">
                        <div id="mcq-questions-container">
                            @foreach($survey->questions as $index => $question)
                                @if($question->type == 'multiple')
                                    <div class="question-answer-set mb-3">
                                        <input type="hidden" name="question_types[]" value="multiple">
                                        <div class="form-group">
                                            <label>{{ trans('MCQ Question') }}</label>
                                            <input type="text" class="form-control" name="questions[]" value="{{ $question->question }}" required>
                                        </div>
                                        <div class="answers-container">
                                            @foreach($question->answers as $answer)
                                                <div class="form-group answer-input">
                                                    <label>{{ trans('Survey Option') }}</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="answers[{{ $index }}][]" value="{{ $answer->answer }}" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-danger remove-answer-btn" type="button">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button type="button" class="btn btn-sm btn-primary add-answer-btn">{{ trans('Add More Options') }}</button>
                                            <button type="button" class="btn btn-danger remove-question-btn">{{ trans('Remove Question') }}</button>
                                        </div>
                                        <hr>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-primary mb-3 add-descriptive-btn">{{ trans('Add Descriptive Questions') }}</button>

                        <div id="descriptive-questions-container">
                            @foreach($survey->questions as $index => $question)
                                @if($question->type == 'descriptive')
                                    <div class="question-answer-set mb-3">
                                        <input type="hidden" name="question_types[]" value="descriptive">
                                        <div class="form-group">
                                            <label>{{ trans('Descriptive Question') }}</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="questions[]" value="{{ $question->question }}" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger remove-description-btn" type="button">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <hr> --}}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="submit" class="btn btn-sm btn-primary mb-3">{{ trans('Save Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


                    <script>
document.addEventListener('DOMContentLoaded', function () {
    const mcqQuestionsContainer = document.getElementById('mcq-questions-container');
    const descriptiveQuestionsContainer = document.getElementById('descriptive-questions-container');
    const addBothBtn = document.querySelector('.add-both-btn');
    const addDescriptiveBtn = document.querySelector('.add-descriptive-btn');

    // Event listener for adding MCQ questions
    addBothBtn.addEventListener('click', function () {
        addMcqQuestion(mcqQuestionsContainer.children.length);
    });

    // Event listener for adding Descriptive questions
    addDescriptiveBtn.addEventListener('click', addDescriptiveQuestion);

    // Function to add an MCQ question
    function addMcqQuestion(questionIndex) {
        const questionHtml = `
            <div class="question-answer-set mb-3">
                <input type="hidden" name="question_types[]" value="multiple">
                <div class="form-group">
                    <label>{{ trans('MCQ Question') }}</label>
                    <input type="text" class="form-control" name="questions[]" required>
                </div>
                <div class="answers-container">
                    <div class="form-group answer-input">
                        <label>{{ trans('Survey Option') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="answers[${questionIndex}][]" required>
                            <div class="input-group-append">
                                <button class="btn btn-danger remove-answer-btn" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-sm btn-primary add-answer-btn">{{ trans('Add More Options') }}</button>
                    <button type="button" class="btn btn-danger remove-question-btn">{{ trans('Remove Question') }}</button>
                </div>
                <hr>
            </div>
        `;

        mcqQuestionsContainer.insertAdjacentHTML('beforeend', questionHtml);
    }

    // Function to add a Descriptive question
    function addDescriptiveQuestion() {
        const questionHtml = `
            <div class="question-answer-set mb-3">
                <input type="hidden" name="question_types[]" value="descriptive">
                <div class="form-group">
                    <label>{{ trans('Descriptive Question') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="questions[]" required>
                        <div class="input-group-append">
                            <button class="btn btn-danger remove-description-btn" type="button">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        `;

        descriptiveQuestionsContainer.insertAdjacentHTML('beforeend', questionHtml);
    }

    // Event delegation for handling clicks on dynamically added elements
    document.body.addEventListener('click', function (event) {
        const target = event.target.closest('button'); // Adjust to target the closest button

        // Remove question
        if (target && target.matches('.remove-question-btn')) {
            target.closest('.question-answer-set').remove();
        }

        // Remove descriptive question
        if (target && target.matches('.remove-description-btn')) {
            target.closest('.question-answer-set').remove();
        }

        // Remove answer
        if (target && target.matches('.remove-answer-btn')) {
            target.closest('.answer-input').remove();
        }

        // Add more answer fields
        if (target && target.matches('.add-answer-btn')) {
            const questionSet = target.closest('.question-answer-set');
            const questionIndex = Array.from(mcqQuestionsContainer.children).indexOf(questionSet);
            const answersContainer = questionSet.querySelector('.answers-container');

            const answerHtml = `
                <div class="form-group answer-input">
                    <label>{{ trans('Survey Option') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="answers[${questionIndex}][]" required>
                        <div class="input-group-append">
                            <button class="btn btn-danger remove-answer-btn" type="button">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;

            answersContainer.insertAdjacentHTML('beforeend', answerHtml);
        }
    });
});


</script>



