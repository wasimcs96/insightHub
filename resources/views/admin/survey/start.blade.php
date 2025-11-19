@extends('admin.layout.app')

@section('title', 'Start Survey')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
               Survey start 
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Dashboard </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item capitalize text-muted">
                  My Survry</li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->

        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>
<section class="mt-30 quiz-form">
    <form action="{{ route('start.store', $survey->id) }}" method="post" class="">
        @csrf
      
        <div class="rounded-lg shadow-sm py-25 px-20">
            <div class="quiz-card">
                @foreach($survey->questions as $index => $question)
                    @if($question->type === 'multiple')
                        <div class="question-card rounded-sm border border-gray200 p-15 text-gray mb-3">
                            <p class="text-gray font-14 question-text">
                                <span>{{ trans('Question') }}: {{ $question->question }}</span>
                            </p>

                            <div class="answers d-flex flex-wrap align-items-center justify-content-between">
                                @foreach($question->answers as $answer)
                                    <div class="answer-item rounded-sm border border-gray200 p-15 text-gray mb-2">
                                        <input type="radio" id="answer-{{ $answer->id }}" name="question[{{ $question->id }}]" value="{{ $answer->id }}">
                                        <label for="answer-{{ $answer->id }}" class="text-gray font-14 ml-2">
                                            {{ $answer->answer }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @elseif($question->type === 'descriptive')
                        <div class="question-card rounded-sm border border-gray200 p-15 text-gray mb-3">
                            <p class="text-gray font-14 question-text">
                                <span>{{ trans('Question') }}: {{ $question->question }}</span>
                            </p>
                            <input type="text" class="form-control mt-2" name="question[{{ $question->id }}]" placeholder="{{ trans('Your answer here...') }}" required>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="d-flex align-items-center mt-15 justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary">{{ trans('public.finish') }}</button>
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
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .question-card {
        padding: 20px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
    }
    .question-text {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .answers {
        display: flex;
        flex-wrap: wrap;
    }
    .answer-item {
        padding: 10px;
        margin-right: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.2s;
    }
    .answer-item:hover {
        background-color: #e9ecef;
        transform: scale(1.05);
    }
    .answer-item input {
        margin-right: 8px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.2s;
    }
    .form-control:focus {
        border-color: #007bff;
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
</style>
@endsection

@section('scripts')
<script src="/assets/default/vendors/video/video.min.js"></script>
<script src="/assets/default/vendors/jquery.simple.timer/jquery.simple.timer.js"></script>
<script src="/assets/default/js/parts/quiz-start.min.js"></script>
@endsection