@extends('admin.layout.app')
 
@section('title', 'Technical Assessment')
@section('styles')
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
    </style>
@endsection
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 ">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack ">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Technical Assessment
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/dashboard" class="text-muted text-hover-primary">
                            @if (auth()->user()->isEmployee())
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
                        Technical Assessment
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::PageContent-->
    <div class="container py-5" style="margin-top:50px">
        <div class="row">
            <!-- Title Section begin -->
            <div class="textbox-center" style="text-align: center">
                <div class="card-title" style="margin-top: 0px;">Job Technical Assessment</div>
                <div class="card-desc" style="margin-bottom: 30px;">
                    Read each question carefully and select ONE answer.
                </div>
            </div>
            <!-- Title Section end -->
            <!-- Assessment Section begin -->
            <div class="container py-5 center" style="margin-bottom: 50px;">
                <div class="row">
                    <div class="col-12 col-lg-9 mx-auto" style="align-content: center;">
                        <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow mb-5 quiz-form quiz-card">

                            @php
                                use App\Models\TechnicalQuestionUserResponse;
                                
                                // Check if questions exist for this assessment
                                $hasQuestions = isset($technicalAss) && count($technicalAss) > 0;
                                
                                // Count user responses to determine if assessment is completed
                                $userResponses = TechnicalQuestionUserResponse::where('user_id', auth()->id())
                                    ->whereNotNull('master_technical_question_id')
                                    ->count();
                                
                                $isCompleted = $userResponses > 0;
                            @endphp

                            {{-- Scenario 2: No Technical Assessment Assigned --}}
                            @if (!$hasQuestions)
                                <div class="alert alert-warning p-4" style="text-align: center;">
                                    <h4 class="alert-heading mb-3">No Assessment Available</h4>
                                    <p class="mb-0">
                                        No technical assessment is available for your job position at this time.
                                    </p>
                                </div>
                                <div class="text-center mt-4">
                                    <a href="/dashboard" class="btn btn-secondary">Back to Dashboards</a>
                                </div>

                            {{-- Scenario 4: Assessment Completed --}}
                            @elseif ($isCompleted)
                                <div class="alert alert-success p-4" style="text-align: center;">
                                    <h4 class="alert-heading mb-3">✓ Assessment Completed</h4>
                                    <p class="mb-0">
                                        You have successfully completed the technical assessment for your position.
                                        Thank you for your participation!
                                    </p>
                                </div>
                                <div class="text-center mt-4">
                                    <a href="/dashboard" class="btn btn-secondary">Back to Dashboards</a>
                                </div>

                            {{-- Scenario 3: Pending Assessment (Show Form) --}}
                            @else
                                <form
                                    action="{{ (isset($application_id) && $application_id) ? route('employee.job-application.technicalAss.store', ['id' => $job_id]) : route('employee.technicalAss.store', ['id' => $job_id]) }}"
                                    method="post" class="">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="job_id" value="{{ $job_id }}">
                                    <input type="hidden" name="application_id" value="{{ $application_id ?? '' }}">

                                    @foreach ($technicalAss as $key => $question)
                                    <fieldset class="question-step question-step-{{ $key + 1 }}">
                                        
                                            <div class="">

                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                    <div class="">
                                                        <h3 class="font-weight-bold font-16 text-dark">
                                                          Question {{ $key+1}}:  {{ $question->title }}</h3>
                                                    </div>
                                                    <div class="border border-1 border-gray200 fs-2 fw-bolder p-2 rounded-4 rounded-sm text-gray">
                                                        {{ $key + 1 }}/{{ $technicalAss->count() }}
                                                    </div>
                                                </div>
 
 
                                               
 
                                                <div class="question-multi-answers mt-35">
                                                 
 
                                                    @for ($i = 1; $i <= 4; $i++)
                                                    <div class="align-content-center answer-item border border-gray200 d-flex flex-nowrap mb-2 rounded-sm text-gray">
                                                        <input class="form-check-input" id="option-{{ $question->id }}-{{ $i }}" type="radio" id="option-{{ $question->id }}-{{ $i }}" name="question[{{ $question->id }}][answer]" value="option_{{$i}}">
                                                        <label for="option-{{ $question->id }}-{{ $i }}" class="text-gray font-14 ml-2">
                                                            {{ $question->{'option_' . $i} }}
                                                        </label>
                                                    </div>
                                                @endfor
                                                </div>
 
                                            </div>
                                       
                                    </fieldset>
                                @endforeach
 
                                    <div class="d-flex align-items-center mt-30 justify-content-end mt-4" >
                                        <button type="button"
                                            class="previous btn btn-sm btn-primary me-10">Previous Question</button>
                                        <button type="button"
                                            class="next btn btn-sm btn-primary mr-auto me-10">Next Question</button>
                                        <button type="submit"
                                            class="finish btn btn-sm btn-danger me-10">Finish</button>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- Assessment Section end -->
        </div>
    </div>
    <!--end::PageContent-->
 
@endsection
 
 
 
@section('scripts')
    {{-- <script src="/assets/default/js/parts/assessment-start.min.js"></script> --}}
    <script>
        !function(t) {
            "use strict";
            jQuery().startTimer && t(".timer").startTimer({
                onComplete: function(i) {
                    i.addClass("text-danger"), t(".quiz-form form").trigger("submit")
                }
            });
    
            var i, o, e, n, s = 1;
    
            // Function to manage button states
            function updateButtons() {
                var totalQuestions = t(".question-step").length; // Get total number of questions
                var currentQuestion = s; // Get current question index
                
                // Disable "Next" button on the last question
                if (currentQuestion >= totalQuestions) {
                    t(".next").prop("disabled", true);
                } else {
                    t(".next").prop("disabled", false);
                }
                
                // Disable "Finish" button until the last question
                if (currentQuestion < totalQuestions) {
                    t(".finish").prop("disabled", true); // Disable Finish button if not on last question
                } else {
                    t(".finish").prop("disabled", false); // Enable Finish button on last question
                }
                
                // Disable "Previous" button on the first question
                if (currentQuestion <= 1) {
                    t(".previous").prop("disabled", true);
                } else {
                    t(".previous").prop("disabled", false);
                }
            }
    
            // Update button states on page load
            updateButtons();
    
            t("body").on("click", ".next", function() {
                i = t(".question-step-" + s);
                o = t(".question-step-" + (s + 1));
                if (o.length < 1) return;
                
                // Show the next question
                o.show();
                i.animate({
                    opacity: 0
                }, {
                    step: function(t) {
                        n = 1 - t;
                        i.css({
                            display: "none",
                            position: "relative"
                        });
                        o.css({
                            opacity: n
                        });
                    },
                    duration: 600
                });
                s += 1;
                updateButtons(); // Update button states after moving to next question
            });
    
            t("body").on("click", ".previous", function() {
                i = t(".question-step-" + s);
                e = t(".question-step-" + (s - 1));
                if (e.length < 1) return;
    
                // Show the previous question
                e.show();
                i.animate({
                    opacity: 0
                }, {
                    step: function(t) {
                        n = 1 - t;
                        i.css({
                            display: "none",
                            position: "relative"
                        });
                        e.css({
                            opacity: n
                        });
                    },
                    duration: 600
                });
                s--;
                updateButtons(); // Update button states after moving to previous question
            });
    
            var r = {
                autoplay: !1,
                preload: "auto"
            };
            var p = t(".video-js");
            p.length && p.each(function(i) {
                var o = p[i],
                    e = t(o).attr("id");
                videojs(e, r);
            });
        }(jQuery);
    </script>
    
@endsection
