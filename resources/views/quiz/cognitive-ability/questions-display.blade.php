@extends('layout.app')

@section('style')
<style>
    .question-card {
        margin-top: 10px;
        background-color: #fff;
        padding: 20px;
        border-radius: 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .question-text {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
    }
    .answer-item {
        padding: 15px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
    }
    .answer-item:hover {
        background-color: #e9ecef;
    }
    .answer-item input {
        margin-right: 10px;
    }
    .answer-item label {
        font-size: 16px;
        color: #333;
    }
</style>
@endsection

@section('app')
<div class="container py-5" style="margin-top: 50px">
    <div class="row">
        <div class="col-12">
            <div class="rounded-custom bg-white p-3 py-5 shadow mb-5">
                <div class="fs-1 fw-700 text-center" style="color: #f7931e;">Cognitive Ability Questions</div>

                {{-- Loop through each question --}}
                @foreach ($questions as $key => $question)
                <div class="question-card">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <h3 class="font-weight-bold font-16 text-dark">Question {{ $key + 1 }}: {!! $question->title !!}</h3>
                    </div>

                    {{-- Check if question has an image --}}
                    @if ($question->do_question_have_image)
                    <div class="mb-3">
                        <img src="{{ asset($question['question_image_url']) }}" alt="" style="width: 500px;">
                    </div>
                    @endif

                    {{-- Display options --}}
                    <div class="question-multi-answers mt-35">
                        @foreach ($question['options'] as $i => $option)
                            @if ($question['do_options_have_image'])
                                <div class="d-flex align-items-center mb-3">
                                    <div>
                                        <input type="radio"
                                            id="option-{{ $question['id'] }}-{{ $i }}"
                                            value="{{ $option }}"
                                            name="answers[{{ $question['id'] }}]">
                                        <label
                                            for="option-{{ $question['id'] }}-{{ $i }}">&nbsp;</label>
                                    </div>
                                    <div class="ms-3 color-black">
                                        <img src="{{ asset($i) }}" alt="" style="width: 60px;">
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center mb-3">
                                    <div>
                                        <input type="radio"
                                            id="option-{{ $question['id'] }}-{{ $i }}"
                                            value="{{ $option }}"
                                            name="answers[{{ $question['id'] }}]">
                                        <label
                                            for="option-{{ $question['id'] }}-{{ $i }}">&nbsp;</label>
                                    </div>
                                    <div class="ms-3 color-black">{{ __($i) }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
