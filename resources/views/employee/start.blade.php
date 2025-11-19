<!-- resources/views/employee/survey/start.blade.php -->

@extends('employee.layout.app')

@section('title', 'Survey')
@section('content')

<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack ">

        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Dashboard
            </h1>
            <!--end::Title-->

            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/dashboard" class="text-muted text-hover-primary">
                        @if(auth()->user()->isEmployee())
                            Employee
                        @else
                            Candidate
                        @endif
                    </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    Survey
                </li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
<div class="cognitive-card d-flex flex-column align-items-center justify-content-center text-center">
    {{-- <h1 class="cognitive-text">
        Cognitive Ability Test
    </h1>
    
    <p class="para-text">
        Read each question carefully and select ONE answer.
    </p> --}}
    <div class="row-div">
        <div>
            <div class="header-text">Survey</div>
            <div class="header-sub">We Use The Survey Data To Improve Our Services.</div>
        </div>
      
    </div>
    {{-- <img id="imageAs" src="{{ asset('admin/media/logos/Line.png') }}" alt="Line"> --}}
</div>

<section class="mt-30 quiz-form">
    <form action="{{ route('employee.survey.store', $survey->id) }}" method="post" class="">
        @csrf

            <div class="quiz-card">
                @foreach($survey->questions as $index => $question)
                    @if($question->type === 'multiple')
                        <div class="question-card rounded-sm gray200 text-gray mb-3">
                            <p class="text-gray font-14 question-text">
                                <span>{{ trans('Question') }}: {{ $question->question }}</span>
                            </p>
                        </div>

                            <div class="answers d-flex flex-wrap align-items-center justify-content-between">
                            <h6>SELECT ONLY ONE</h6>

                                @foreach($question->answers as $answer)
                                    <div class="form-check form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-30px w-30px" type="radio" id="answer-{{ $answer->id }}" name="question[{{ $question->id }}][answer_id]" value="{{ $answer->id }}" id="" required>
                                        <label for="answer-{{ $answer->id }}" class="form-check-label" for="">
                                            {{ $answer->answer }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                    @elseif($question->type === 'descriptive')
                        <div class="question-card rounded-sm gray200 text-gray mb-3">
                            <p class="text-gray font-14 question-text">
                                <span>{{ trans('Question') }}: {{ $question->question }}</span>
                            </p>
                            <textarea class="form-control mt-2" name="question[{{ $question->id }}][answer]" placeholder="{{ trans('Your answer here...') }}" cols="5" rows="5" required></textarea>
                            {{-- <input type="text" class="form-control mt-2" name="question[{{ $question->id }}][answer]" placeholder="{{ trans('Your answer here...') }}" required> --}}
                        </div>
                    @endif
                @endforeach
                <div class="d-flex align-items-center mt-15 justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary">{{ trans('Save') }}</button>
                </div>
            </div>
     
    </form>
</section>
@endsection

@section('styles')
<style>
   
   .quiz-form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }
    .quiz-card {
        margin-top: 10px;

        background-color: #fff;
        padding: 20px;
        border-radius: 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .question-card {
        padding: 20px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
        width: 100%;

    }
    .question-text {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 100px;
    }
    .answers {
    width: 100%;
    margin-top: 20px;
}

.form-check {
    width: 100%;
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f9f9f9;
    cursor: pointer;
    transition: background-color 0.2s, transform 0.2s;
}

.form-check:hover {
    background-color: #e9ecef;
    /* transform: scale(1.05); */
}

.form-check input {
    margin-right: 10px;
}

.form-check label {
    font-size: 16px;
    color: #333;
}

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.2s;
    }
    .form-control:focus {
        border-color: #333;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    } 
    
    .cognitive-card {
        height: 150px;
        background-image: url({{ asset('admin/media/logos/Line.png') }});
            background-position: center Right; /* Position the image */
            background-repeat: no-repeat; /* No repeating the image */
            background-size: contain; /* Size the image */
        background-color: #444CE7; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px
}

.cognitive-text {
    font-size: 24px; /* Adjust as needed */
    /* color: #ddd; */
    margin-bottom: 10px;
    color: #ddd;
    
    
    /* Space between heading and paragraph */
}

.para-text {
    font-size: 16px; /* Adjust as needed */
    color: #ddd;
    /* color: #ddd Optional text color */
}

#imageAs{
    height: 100px;
    margin-left: 1240px;
   
}


.header-text {
    font-weight: 600;
    font-size: 20px;
    color: white;
    /* height: ; */
}

.header-sub {
    font-weight: 400;
    font-size: 15px;
    color: #FFFFFF;
    /* height: 2px; */
}

.row-div{
    margin-right: 1100px;
}



</style>
@endsection

@section('scripts')
<script src="/assets/default/vendors/video/video.min.js"></script>
<script src="/assets/default/vendors/jquery.simple.timer/jquery.simple.timer.js"></script>
<script src="/assets/default/js/parts/quiz-start.min.js"></script>

@endsection
