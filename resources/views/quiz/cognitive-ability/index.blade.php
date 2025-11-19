{{-- @php
    use App\Models\QuizDomainValueAnswer; // Adjust the namespace as necessary

    $answersGiven = QuizDomainValueAnswer::where('user_id', auth()->user()->id)
                    ->where('quiz_domain_value_question_id', '>', 376)
                    ->count();
    $isCognitiveAbilityCompleted = auth()->user()->is_cognitive_ability_completed;

@endphp --}}

@extends('layout.app')

@section('style')
<style>
    .timer {
        text-align: right;
    }

    .underline {
        text-decoration: underline;
    }

    #timer {
        font-size: 20px;
        font-weight: 700;
        padding: 5px !important;
        background-color: #f7931e;
        border-radius: 7px;
        color: #fff !important;
    }
</style>
<style>
    .card-title {
        color: #F6931D;
        font-size: 38px;
        font-weight: bold;
    }


    .card-desc {
        color: #807E7E;
        font-size: 18px;
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

    .all-btn {
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

    .answer-item {
        width: 100%;
        padding: 15px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.2s;
    }

    .answer-item:hover {
        background-color: #e9ecef;
        /* transform: scale(1.05); */
    }

    .answer-item input {
        margin-right: 10px;
    }


    .answer-item input {
        margin-right: 10px;
    }

    .answer-item label {
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
        background-position: center Right;
        /* Position the image */
        background-repeat: no-repeat;
        /* No repeating the image */
        background-size: contain;
        /* Size the image */
        background-color: #444CE7;
        border-bottom-left-radius: 24px;
        border-bottom-right-radius: 24px
    }

    .cognitive-text {
        font-size: 24px;
        /* Adjust as needed */
        /* color: #ddd; */
        margin-bottom: 10px;
        color: #ddd;
    }

    .para-text {
        font-size: 16px;
        /* Adjust as needed */
        color: #ddd;
        /* color: #ddd Optional text color */
    }

    #imageAs {
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

    .row-div {
        margin-right: 1100px;
    }

    .quiz-form fieldset:not(:first-of-type) {
        display: none;
    }

    .question-invalid {
        display: none;
    }
    
    .btn-quiz{
        background-color: #F6931D;
        padding: 6px 0px;
        width: 165px;
        border-radius: 20px;
        border-color: none;
        border-width: 0;
        color: white;
        font-size: 16px;
        font-weight: 400;
        }
        .finish:disabled {
    display: none;
}

    .next:disabled {
            background-color: gray;
        }
</style>
@endsection


@section('app')
    
    <div class="container py-5"style="margin-top: 50px">

        <div class="row">

            <div class="col-12 col-lg-12">

                <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow mb-5">
                    <div class="fs-1 fw-700 text-center" style="color: #f7931e;">Question <span class="question-number">1</span></div>
                    <div style="display: flex; justify-content: end; margin-bottom: 12px;"><span id="timer"
                            class="timer" data-minutes-left="15:00"></span></div>
                    <form action="/quiz/cognitive-ability-assessment/" method="POST" class="quiz-form">
                        {{ csrf_field() }}

                        <input type="hidden" name="time_taken" value="" id="timeTakenInput">
                        <input type="hidden" name="is_timer_completed" value="0" id="timercompleted">
                        {{-- <input type="hidden" name="job_id" value="{{ $job_id }}"> --}}
                        @foreach ($questions as $key => $question)
                            {{-- {{ dd($questions) }} --}}
                            <fieldset class="question-step question-step-{{ $key + 1 }}">

                                <div class="">

                                    <div class="d-flex align-items-center justify-content-between mb-5">
                                        <div class="">
                                            <h3 class="font-weight-bold font-16 text-dark">
                                                Question {{ $key + 1 }}: {!! $question['title'] !!}</h3>
                                            @if ($question['do_question_have_image'])
                                                <img src="{{ asset($question['question_image_url']) }}" alt=""
                                                    style="width: 500px;">
                                            @endif
                                            <div class="question-invalid " id="question-required-{{ $question['id'] }}"
                                                style="
                                                color: red;
                                                font-size: large;
                                                margin-top: 18px;
                                                ">
                                                Please answer this question before proceeding.</div>
                                        </div>
                                        <div
                                            class="border border-1 border-gray200 fs-2 fw-bolder p-2 rounded-4 rounded-sm text-gray">
                                            {{ $key + 1 }}/{{ $questions->count() }}
                                        </div>
                                    </div>




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

                            </fieldset>
                        @endforeach

                        <div class="d-flex align-items-center mt-30 justify-content-end mt-4">
                            <button type="button"
                                class="previous mx-3 btn-quiz rounded-custom text-white me-10 d-none">Previous
                                Question</button>
                            <button type="button"
                                class="next  mx-3 btn-quiz rounded-custom text-white mr-auto me-10">Next
                                Question</button>
                            <button type="submit"
                                class="finish mx-3 btn btn-sm btn-danger rounded-custom px-5 fs-1-1 text-white mr-auto me-10" style="background: red !important">Finish</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection

@push('script')
    {{-- <script>
    $(document).ready(function() {

        // Block right-click context menu
        $("body").on("contextmenu", function(e) {
            return false;
        });

        // Block keyboard events
        $("body").bind("keyup keydown", function(e) {
            // Prevent default behavior for all keys
            e.preventDefault();
            return false;
        });

        // Block browser refresh
        // $(window).bind('beforeunload', function() {
        //     return "Are you sure you want to leave? Your progress may be lost.";
        // });

        // Block specific refresh shortcuts
        $(document).keydown(function(e) {
            // Block F5
            if (e.keyCode == 116) {
                e.preventDefault();
                return false;
            }
            // Block Ctrl + R
            if (e.ctrlKey && e.keyCode == 82) {
                e.preventDefault();
                return false;
            }
        });



    });
</script> --}}




    <script>
        (function($) {
            "use strict";

            const userID = "{{ $userID }}"; // Unique user identifier
            const quizID = "{{ $quizID ?? 'cognitive' }}"; // Unique quiz identifier
            const timerElement = $("#timer");
            const timerCompletedInput = $("#timercompleted");
            const quizForm = $(".quiz-form");
            const timeTakenInput = $("#timeTakenInput"); // Hidden input for time taken

            // Unique storage keys per user and quiz
            const storageKey = `quizStartTime_${userID}_${quizID}`;
            const durationKey = `quizDuration_${userID}_${quizID}`;
            const lastQuestionKey = `lastQuestion_${userID}_${quizID}`;
            const answersKey = `savedAnswers_${userID}_${quizID}`;
            const timeTakenKey = `timeTaken_${userID}_${quizID}`;
            const questionOrderKey = `questionOrder_${userID}_${quizID}`;
            const totalDuration = 15 * 60; // 15 minutes in seconds
            let questionStartTime = Date.now();
            let s = 1; // Default question number

            // Reset storage if missing
            function resetStorage() {
                localStorage.setItem(storageKey, Date.now());
                localStorage.setItem(durationKey, totalDuration);
                localStorage.setItem(lastQuestionKey, "1");
                localStorage.setItem(answersKey, JSON.stringify({}));
                localStorage.setItem(timeTakenKey, JSON.stringify({}));
                localStorage.setItem(questionOrderKey, JSON.stringify([]));
            }

            // Function to load and reorder questions on page refresh
            function loadAndReorderQuestions() {
                const questionOrder = JSON.parse(localStorage.getItem(questionOrderKey));

                if (questionOrder && questionOrder.length > 0) {
                    // Reorder questions based on saved order
                    questionOrder.forEach((questionId, index) => {
                        const questionStep = $(`.question-step-${index + 1}`);
                        questionStep.attr("data-question-id", questionId);
                    });
                }
            }

            // Store the question order in localStorage when the questions are first loaded
            function storeQuestionOrder() {
                const questionOrder = [];

                $(".question-step").each(function() {
                    questionOrder.push($(this).data("question-id"));
                });

                localStorage.setItem(questionOrderKey, JSON.stringify(questionOrder));
            }

            // Start or resume the timer
            function startTimer() {
                let storedStartTime = localStorage.getItem(storageKey);
                let storedDuration = localStorage.getItem(durationKey);

                if (!storedStartTime || !storedDuration) {
                    resetStorage();
                    storedStartTime = Date.now();
                    storedDuration = totalDuration;
                }

                let elapsedTime = Math.floor((Date.now() - storedStartTime) / 1000);
                let remainingTime = storedDuration - elapsedTime;

                if (remainingTime <= 0) {
                    timerCompletedInput.val("1");
                    timerElement.text("00:00");
                    autoFillUnattemptedQuestions();
                    injectTimeTakenToForm(); // Inject time taken values before submission
                    quizForm.trigger("submit");
                    return;
                }

                // Timer countdown
                const interval = setInterval(() => {
                    elapsedTime = Math.floor((Date.now() - storedStartTime) / 1000);
                    remainingTime = storedDuration - elapsedTime;

                    if (remainingTime <= 0) {
                        clearInterval(interval);
                        timerElement.text("00:00");
                        timerCompletedInput.val("1");
                        autoFillUnattemptedQuestions();
                        injectTimeTakenToForm(); // Inject time taken values before submission
                        quizForm.trigger("submit");
                        return;
                    }

                    let minutes = Math.floor(remainingTime / 60);
                    let seconds = remainingTime % 60;
                    timerElement.text(
                        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`);
                }, 1000);
            }

            // Store the last viewed question
            function saveProgress() {
                localStorage.setItem(lastQuestionKey, s);
            }

            // Store selected answers
            function saveAnswer(questionId, answerValue) {
                let savedAnswers = JSON.parse(localStorage.getItem(answersKey)) || {};
                savedAnswers[questionId] = answerValue;
                localStorage.setItem(answersKey, JSON.stringify(savedAnswers));
            }

            // Store time spent on a question
            function saveTimeTaken(questionId) {
                let timeTakenData = JSON.parse(localStorage.getItem(timeTakenKey)) || {};

                // Extract only the numeric question ID
                let cleanQuestionId = questionId.replace(/answers\[(\d+)\]/, "$1");

                let timeSpent = Math.floor((Date.now() - questionStartTime) / 1000);
                timeTakenData[cleanQuestionId] = timeSpent; // Store only the clean ID

                localStorage.setItem(timeTakenKey, JSON.stringify(timeTakenData));
                questionStartTime = Date.now(); // Reset time for next question
            }

            // Load last viewed question
            function loadProgress() {
                let savedQuestion = localStorage.getItem(lastQuestionKey);
                if (savedQuestion) {
                    s = parseInt(savedQuestion, 10);
                    showQuestion(s);
                    document.getElementsByClassName('question-number')[0].textContent = s ;
                }
            }

            // Load saved answers and auto-select them
            function loadAnswers() {
                let savedAnswers = JSON.parse(localStorage.getItem(answersKey)) || {};
                $.each(savedAnswers, function(questionId, answerValue) {
                    $(`input[name='answers[${questionId}]'][value='${answerValue}']`).prop("checked", true);
                });
            }

            // Show the given question step
            function showQuestion(questionNumber) {
                $(".question-step").hide();
                $(".question-step-" + questionNumber).show();
                s = questionNumber;
                updateButtons();
            }

            // Mark unattempted questions with 0 before submission
            function autoFillUnattemptedQuestions() {
                let savedAnswers = JSON.parse(localStorage.getItem(answersKey)) || {};
                let timeTakenData = JSON.parse(localStorage.getItem(timeTakenKey)) || {};

                $(".question-step").each(function() {
                    let questionId = $(this).find("input[type='radio']").attr("name");

                    if (questionId) {
                        // Extract only the numeric question ID
                        let cleanQuestionId = questionId.replace(/answers\[(\d+)\]/, "$1");

                        // if (!savedAnswers[cleanQuestionId]) {
                        //     savedAnswers[cleanQuestionId] = "0"; // Default answer for unattempted question
                        // }
                        if (!timeTakenData[cleanQuestionId]) {
                            timeTakenData[cleanQuestionId] = 0; // Default time spent is 0
                        }
                    }
                });

                localStorage.setItem(answersKey, JSON.stringify(savedAnswers));
                localStorage.setItem(timeTakenKey, JSON.stringify(timeTakenData));
            }


            // Inject time taken values into hidden form input
            function injectTimeTakenToForm() {
                let timeTakenData = JSON.parse(localStorage.getItem(timeTakenKey)) || {};
                timeTakenInput.val(JSON.stringify(timeTakenData));
            }

            // Clear localStorage when quiz is submitted
            quizForm.on("submit", function() {
                autoFillUnattemptedQuestions();
                injectTimeTakenToForm(); // Inject time data before submission
                localStorage.removeItem(storageKey);
                localStorage.removeItem(durationKey);
                localStorage.removeItem(lastQuestionKey);
                localStorage.removeItem(answersKey);
                localStorage.removeItem(timeTakenKey);
            });

            // Handle "Next" button click
            $("body").on("click", ".next", function() {
                let currentStep = $(".question-step-" + s);
                let nextStep = $(".question-step-" + (s + 1));

                if (nextStep.length < 1) return;

                let questionId = currentStep.find("input[type='radio']").attr("name");

                console.log(questionId);
                let selectedAnswer = currentStep.find("input[name='" + questionId + "']:checked").val();
                console.log(selectedAnswer);
                if (!selectedAnswer) {
                    // Show a message or alert to indicate the question is required
                    document.getElementById(
                        "question-required-" + questionId.replace("answers[", "").replace("]", "")
                    )?.classList.remove("question-invalid");

                    // alert("Please answer this question before proceeding.");
                    return; // Prevent moving to the next question
                }

                saveTimeTaken(questionId);

                console.log('questioncoutn',s+1);
                document.getElementsByClassName('question-number')[0].textContent = s + 1;
                nextStep.show();
                currentStep.hide();

                s += 1;
                updateButtons();
                saveProgress();
            });

            // Handle "Previous" button click
            $("body").on("click", ".previous", function() {
                let currentStep = $(".question-step-" + s);
                let prevStep = $(".question-step-" + (s - 1));

                if (prevStep.length < 1) return;

                let questionId = currentStep.find("input[type='radio']").attr("name");
                saveTimeTaken(questionId);

                prevStep.show();
                currentStep.hide();

                s -= 1;
                updateButtons();
                saveProgress();
            });

            // Save selected answers when a radio button is clicked
            $("body").on("change", "input[type='radio']", function() {
                let questionId = $(this).attr("name").replace("answers[", "").replace("]", "");
                let answerValue = $(this).val();
                saveAnswer(questionId, answerValue);
                saveTimeTaken(questionId);
            });

            // Update button states
            function updateButtons() {
                let totalQuestions = $(".question-step").length;
                $(".next").prop("disabled", s >= totalQuestions);
                $(".finish").prop("disabled", s < totalQuestions);
                $(".previous").prop("disabled", s <= 1);
            }

            // Initialize the quiz
            startTimer();
            loadProgress();
            loadAnswers();
            storeQuestionOrder();
            loadAndReorderQuestions();
        })(jQuery);
    </script>
@endpush