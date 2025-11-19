@extends('layout.app')

@section('style')
    <style>
        /* Custom sizes for radio buttons */
        .radio-size-small { width: 20px; height: 20px; }
        .radio-size-medium { width: 30px; height: 30px; }
        .radio-size-large { width: 40px; height: 40px; }
        .example-label {font-weight: bold; font-size: 16px; color: #333; margin-bottom: 10px;}

        /* Additional styles */
        .card-title {
            color: #F6931D;
            font-size: 38px;
            font-weight: bold;
        }

        .card-desc {
            color: #807E7E;
            font-size: 18px;
        }

        .progress-bar-status {
            height: 100%;
            background-color: #F6931D;
            border-radius: 10px;
            transition: width 0.4s ease;
        }

        .color-yellow {
            color: #F6931D;
        }

        .progress-container {
            position: fixed;
            top: 52px;
            z-index: 100;
            background: #f8f9fa; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            width: 100%;
        }

        .progress-bar-container {
            width: 100%;
            height: 20px; /* Adjust as needed */
            background-color: #e0e0e0; /* Gray background */
            /* border-radius: 10px; */
            overflow: hidden;
        }

        .card, .lg-custom {
            border: none !important;
            box-shadow: none !important;
        }

        .container-fluid, .row, .col-md-12 {
            padding: 0;
            margin: 0;
        }

        .textbox-center {
            text-align: center;
            padding-top: 70px; 
            background: #f8f9fa;
        }

        .example-container {
            display: flex;
            justify-content: center; 
            align-items: center;   
            margin-top: 20px; 
        }

        .radioexample-container {
            display: flex; 
            flex-direction: column;
            align-items: center;
            background-color: #FFFFFF;
            width: 650px;
            margin-bottom: 70px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .circle-row{
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 10px;
        }

        .circle-container {
            display: flex;
            flex-direction: column; 
            align-items: center; 
            cursor: pointer;    
        }

        .circle-1 {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 6px solid #717171;
        }

        .circle-2 {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 6px solid #AAAAAA;
        }

        .circle-3 {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 6px solid #D1D1D1;
        }

        .circle-4 {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 6px solid #FDBB6D;
        }

        .circle-5 {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 6px solid #F6931D;
        }

        .circle-container p {
            margin-top: 20px;
            color: #807E7E;
            font-weight: bold;
        }

        .submit-btn {
            padding: 15px 30px;
            font-size: 20px;
            background-color: #F6931D;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-top: 20px;
        }

        .custom-question-style {
            margin-bottom: 40px;
            color: #807E7E;
            font-weight: bold;
            font-size: 20px;
            text-align: center;
        }

        .custom-answer-style-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-answer-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            flex-direction: column;
        }

        .custom-radio-btn {
            appearance: none;
            background-color: #f0f0f0;
            border: 2px solid #ccc;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            position: relative;
            cursor: pointer;
            margin-right: 10px;
            outline: none;
            transition: all 0.3s ease;
        }

        .custom-radio-btn:checked {
            background-color: #4caf50; /* Customize this color */
            border-color: #4caf50;
        }

        .custom-radio-btn:checked::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            background-color: white;
            border-radius: 50%;
        }

        .custom-radio-description {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
            text-align: center;
        }

        .radio-container input[type="radio"] {
            display: none;
        }

        .radio-container input[type="radio"]:checked + div {
            background-color: #F6931D;
            border: 2px solid #FDBB6D;
        }

        .radio-container label {
            cursor: pointer;
        }

        .circle-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer; 
        }

        .radio-container {
            display: flex;
            gap: 50px;
            background-color: transparent;
            width: 650px;
            height: 150px;
            /* margin-bottom: 70px; */
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .circle-1, .circle-2, .circle-3, .circle-4, .circle-5 {
            border-radius: 50%;
            border: 6px solid;
        }

        .circle-1 { width: 60px; height: 60px; border-color: #717171; }
        .circle-2 { width: 50px; height: 50px; border-color: #AAAAAA; }
        .circle-3 { width: 40px; height: 40px; border-color: #D1D1D1; }
        .circle-4 { width: 50px; height: 50px; border-color: #FDBB6D; }
        .circle-5 { width: 60px; height: 60px; border-color: #F6931D; }

        .custom-radio-description {
            margin-top: 20px;
            color: #807E7E;
            font-weight: bold;
        }
        .progress-bar-status{
            fill: #F6931D;
            background-color: #F6931D;
        }

        /* Mobile adjustments */
        @media (max-width: 768px) {
            .card-title {font-size: 24px;}
            .card-desc {font-size: 14px;}
            .submit-btn {font-size: 16px; padding: 10px 20px;}
            .radioexample-container {width: 100%; padding: 10px;}
            .circle-container p {font-size: 12px;}
            .circle-1, .circle-2, .circle-3, .circle-4, .circle-5 {width: 40px; height: 40px;}
            .custom-question-style {font-size: 16px;}
            .radio-container {gap: 30px;}
            .textbox-center {margin-top: 50px;}
        }
         
        @media (max-width: 576px) {
            .card-title {font-size: 20px;}
            .card-desc {font-size: 12px;}
            .submit-btn {font-size: 14px; padding: 8px 16px;}
            .circle-1, .circle-2, .circle-3, .circle-4, .circle-5 {width: 30px; height: 30px;}
            .circle-container p {font-size: 10px;}
            .radio-container {gap: 20px;}
            .custom-question-style {font-size: 14px;}
            .textbox-center {margin-top: 30px;}
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .card-title { font-size: 32px; }
            .card-desc { font-size: 18px; }
        }

        @media (min-width: 993px) {
            .card-title { font-size: 40px; }
            .card-desc { font-size: 20px; }
            .progress-bar .status { height: 25px; }
        }
        .shadow-lg{
            box-shadow: none !important;
        }

        .fixed-height {
            align-items: center;
    height: 74px;
    display: flex;
    margin: auto;
        }
    </style>
@endsection

@section('app')
<div class="container-fluid" style="margin-top:120px;" >
    <div class="row">
        <!-- Progress Bar Section -->
        <div class="col-md-12 mb-0">
            <div class="progress-container p-3 p-lg-4">
                <div class="d-flex align-items-center justify-content-center" v-cloak style="max-width: 80%; margin: 0 auto;">
                    <div class="flex-fill">
                        <div class="progress-bar-container">
                            <div class="progress-bar-status" :style="{ width: completedPercent + '%', backgroundColor: '#F6931D' }"></div>
                        </div>
                    </div>
                    
                    <div class="ms-3 text-center">
                        <div class="fs-1 fw-700" style="
                        height: 36px;
                        color:#F6931D;
                    ">
                            @{{ (completedPercent || 0).toFixed(1) }}%
                        </div>
                        <div class="fs-4 card-desc">{{ __('Completed') }}</div>
                    </div>
                </div>
            </div>                
        </div>

        <!-- Title Section -->
        <div class="textbox-center">
            <div class="card-title">Personality and Motivation Test</div>
            <div class="card-desc">
                Discover how your personality traits impact your motivation<br>
                and how to develop the best blend of traits for success in your career
            </div>
            <div class="example-container" style="margin-bottom: 20px;">
                <div class="radioexample-container">
                    <div class="example-label" style="font-weight: bold; margin-bottom: 10px; align-self: flex-start; padding-left: 30px; padding-top:20px; color: #888;">
                        Assessment Scale Options:
                    </div>
                    <div class="circle-row align-items-center">
                        <div class="circle-container">
                            <div class="fixed-height">
                            <div class="circle-1"></div></div>
                            <p>Very<br>Inaccurate</p>
                        </div>
                        <div class="circle-container">
                            <div class="fixed-height">
                            <div class="circle-2"></div></div>
                            <p>Moderately<br>Inaccurate</p>
                        </div>
                        <div class="circle-container">
                            <div class="fixed-height">
                            <div class="circle-3"></div></div>
                            <p>Neither Accurate<br>Nor Inaccurate</p>
                        </div>
                        <div class="circle-container">
                            <div class="fixed-height">
                            <div class="circle-4"></div></div>
                            <p>Moderately<br>Accurate</p>
                        </div>
                        <div class="circle-container">
                            <div class="fixed-height">
                            <div class="circle-5"></div></div>
                            <p>Very<br>Accurate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assessment Section -->
        <div class="container py-0 center textbox-center" style="margin-bottom: 50px;">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto" style="display: flex; justify-content: center;">
                    <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow mb-5 border-bottom">
                        <form action="/quiz/{{ $questions['name'] }}" method="POST">
                            @csrf
                            <div class="mb-5">
                                @foreach($questionsOnly as $k => $question)
                                    <div class="mb-4 pb-4 border-bottom" style="justify-content: center;">
                                        <p class="custom-question-style" id="{{ strtolower(str_replace(' ', '-', $question['title'])) }}">
                                            {{ __($question['title']) }}
                                        </p>
                                        <div class="radio-container">
                                            @if($question['minPoints'] < $question['maxPoints'])
                                                @for($i = $question['minPoints']; $i <= $question['maxPoints']; $i++)
                                                    <label class="circle-container">
                                                        <input type="radio" id="test{{ $k.'-'.$question['id'].'-'.$i }}" value="{{ $i }}" name="answers[{{ $question['id'] }}]" @change="calculateCompletedPerc()" {{ $question['answer'] && $question['answer']['answer'] == $i ? "checked" : "" }}>
                                                        <div class="circle-{{ $i }}"></div>
                                                        <p>{!! $i == 1 ? __('Very')."<br>".__('Inaccurate') : ($i == 5 ? __('Very')."<br>".__('Accurate') : "<div style='visibility:hidden; height:0;'>".__('Very')."<br>".__('Accurate')."</div>") !!}</p>
                                                    </label>
                                                @endfor
                                            @else
                                            @php
                                                $circleClasses = [
                                                5 => 'circle-1',
                                                4 => 'circle-2',
                                                3 => 'circle-3',
                                                2 => 'circle-4',
                                                1 => 'circle-5'
                                                ];
                                            @endphp
                                                @for($i = $question['minPoints']; $i >= $question['maxPoints']; $i--)
                                                @php
                                                    $circleClass = $circleClasses[$i] ?? 'circle-1'; // Default to 'circle-1' if not found
                                                @endphp
                                                <label class="circle-container">
                                                    <input type="radio" id="test{{ $k.'-'.$question['id'].'-'.$i }}" value="{{ $i }}" name="answers[{{ $question['id'] }}]" @change="calculateCompletedPerc()" {{ $question['answer'] && $question['answer']['answer'] == $i ? "checked" : "" }}>
                                                    <div class="{{ $circleClass }}"></div>
                                                    <p>{!! $i == 5 ? __('Very')."<br>".__('Inaccurate') : ($i == 1 ? __('Very')."<br>".__('Accurate') : "<div style='visibility:hidden; height:0;'>".__('Very')."<br>".__('Accurate')."</div>") !!}</p>
                                                </label>
                                            @endfor
                                            @endif
                                        </div>
                                        <div class="alert alert-danger mt-4 mb-0 fw-700" role="alert" v-if="errors && errors['answers[{{ $question['id'] }}]']" v-cloak>
                                            {{ __("You've missed a question, please answer all the questions.") }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <button class="submit-btn" name="submit" type="submit" value="submit" eventLabel="Complete Personality & Motivation" @click="submitForm">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    export default {
        data() {
            return {
                totalQuestions: 120,  // Total number of questions
                answeredQuestions: 0, // Number of answered questions
                completedPercent: 0,  // Completed percentage
            };
        },
        methods: {
            // This method will be triggered whenever a user selects an option
            calculateCompletedPerc() {
                // Calculate answered questions by checking how many have answers
                let answeredCount = 0;
                document.querySelectorAll('input[type="radio"]').forEach((input) => {
                    if (input.checked) {
                        answeredCount++;
                    }
                });

                // Update the answeredQuestions and completedPercent
                this.answeredQuestions = answeredCount / 5; // Since 5 radio buttons per question
                this.completedPercent = (this.answeredQuestions / this.totalQuestions) * 100;
            },

            // Method to handle form submission (optional)
            submitForm(e) {
                // Add form submission logic here
                if (this.answeredQuestions < this.totalQuestions) {
                    e.preventDefault();
                    alert("Please answer all questions before submitting.");
                }
            }
        }
    }
</script>

@endsection
