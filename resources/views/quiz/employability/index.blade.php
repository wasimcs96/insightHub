@extends('layout.app')

@section('app')

<div class="full-size-bg-img work-values-bg-image-test py-5">

    <div class="container">

        <h1 class="color-white fs-3-rem fw-700 mb-5">{{ __("Design your future today!")}}<br class="d-none d-lg-inline"> {{ __("Your Employability Factors")}}
        </h1>

        <div class="row mb-5">

            <div class="col-12 col-lg-4 mb-4 mb-lg-0">

                <div class="border-radius-20 bg-white overflow-hidden min-h-100">

                    <img src="/images/work-values-test-1.jpg" class="w-100">

                    <div class="p-3">

                        <p class="color-purple fw-700 fs-1-1">{{ __("Complete your assessment")}}</p>

                        <p class="fw-600 color-dark-gray mb-5">{{ __("To find out how employable you are now and what employers are looking for.")}}</p>

                    </div>

                </div>

            </div>

            <div class="col-12 col-lg-4 mb-4 mb-lg-0">

                <div class="border-radius-20 bg-white overflow-hidden min-h-100">

                    <img src="/images/work-values-test-2.jpg" class="w-100">

                    <div class="p-3">

                        <p class="color-purple fw-700 fs-1-1">{{ __("Get your results")}}</p>

                        <p class="fw-600 color-dark-gray mb-5">{{ __("Where you are already highly employable and what to focus on to increase your employability.")}}</p>

                    </div>

                </div>

            </div>

            <div class="col-12 col-lg-4">

                <div class="border-radius-20 bg-white overflow-hidden min-h-100">

                    <img src="/images/work-values-test-3.jpg" class="w-100">

                    <div class="p-3">

                        <p class="color-purple fw-700 fs-1-1">{{ __("Your next steps")}}</p>

                        <p class="fw-600 color-dark-gray mb-5">{{ __("Feedback on how your results will help you find the right career match for you.")}}</p>

                    </div>

                </div>

            </div>

        </div>

        <div class="text-center">

            <h1 class="color-white mb-4">{{ __("Welcome to Employability Test")}}</h1>

            <p class="fw-600 fs-1-1">{{ __("Take your time to read each statement.")}}<br>{{ __("Indicate which statement best matches your view of yourself using one of the five options.")}}<br>{{ __("Relax, be honest, go with the answer that feels right for you and remember, there are no wrong answers!")}}</p>

            <p class="fw-600 fs-1-1">{{ __("This questionnaire will take you around 10 minutes to complete.")}}</p>

        </div>

    </div>

</div>

<div class="container py-5">

    <div class="row">

        <div class="col-12 col-lg-8">

            <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow mb-5">

                <div class="p-3 border mb-5 bg-white shadow position-relative rounded-1-3">

                    <div class="w-100 h-100 position-asbolute top-0 left-0"></div>

                    <div class="d-flex justify-content-between colorful-radios">

                        <div class="text-center me-lg-5">

                            <input type="radio" value="0" checked="true">

                            <label>&nbsp;</label>

                            <div class="fw-500 lh-1 mt-2 fs-xxs-07">{{ __("Strongly")}}<br>{{ __("Disagree")}}</div>

                        </div>

                        <div class="text-center me-lg-5">

                            <input type="radio" value="1" checked="true">

                            <label>&nbsp;</label>

                            <div class="fw-500 lh-1 mt-2 fs-xxs-07">{{ __("Disagree")}}</div>

                        </div>

                        <div class="text-center me-lg-5">

                            <input type="radio" value="2" checked="true">

                            <label>&nbsp;</label>

                            <div class="fw-500 lh-1 mt-2 fs-xxs-07">{{ __("Unsure")}}</div>

                        </div>

                        <div class="text-center me-lg-5">

                            <input type="radio" value="3" checked="true">

                            <label>&nbsp;</label>

                            <div class="fw-500 lh-1 mt-2 fs-xxs-07">{{ __("Agree")}}</div>

                        </div>

                        <div class="text-center">

                            <input type="radio" value="4" checked="true">

                            <label>&nbsp;</label>

                            <div class="fw-500 lh-1 mt-2 fs-xxs-07">{{ __("Strongly")}}<br>{{ __("Agree")}}</div>

                        </div>

                    </div>

                </div>

                <form action="/quiz/{{ $questions['name'] }}" method="POST">

                    @php

                    $questions = [];

                    shuffle($questionsOnly);

                    @endphp

                    <div class="mb-5">

                        @foreach($questionsOnly as $k => $question)

                        @php

                        $questions[] = $question;

                        @endphp

                        <div class="mb-4 pb-4 border-bottom">

                            <p class="fs-1-1 color-black" id="{{ strtolower(str_replace(' ', '-', $question['title'])) }}">{{ __($question['title']) }}</p>

                            <div class="d-flex justify-content-between justify-content-lg-start colorful-radios">

                                @for($i = $question['minPoints']; $i <= $question['maxPoints']; $i++ ) <div class="text-center me-lg-5">

                                    <input type="radio" id="test{{ $question['id'].'-'.$i }}" value="{{ $i }}" ref="question{{ $question['id'] }}{{ $i }}" name="answers[{{ $question['id'] }}]" @change="calculateCompletedPerc()" {{ $question['answer'] && $question['answer']['answer'] == $i ? "checked" : "" }}>

                                    <label for="test{{ $question['id'].'-'.$i }}">&nbsp;</label>

                                    <div class="fw-500 lh-1 mt-2 fs-xxs-07">{!! $i == 1 ? __("Strongly")."<br>". __("disagree") : ($i == 5 ? __("Strongly")."<br>".__("agree") : "<div style='visibility:hidden'>".__("Strongly")."<br>".__("agree")."</div>") !!}</div>

                            </div>

                            @endfor

                        </div>

                        <div class="alert alert-danger mt-4 mb-0 fw-700" role="alert" v-if="errors && errors['answers[{{ $question['id'] }}]']" v-cloak>

                            {{ __("You've missed a question, please answer all the questions.")}}

                        </div>

                    </div>

                    @endforeach

            </div>


            <div class="d-flex align-items-center justify-content-between">

                <button class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white" name="submit" type="submit" value="submit" eventLabel="Complete Employability" @click="submitForm">{{ __("Submit")}}</button>


                <button class="fw-600 fs-1-1 text-black save-continue-btn" name="submit" type="submit" value="submit_continue" eventLabel="Complete Employability" @click="submitForm">{{ __("Save and continue later")}}</button>



            </div>



            </form>

        </div>

    </div>

    <div class="col-12 col-lg-4">

        <div class="rounded-lg-custom bg-white p-3 p-lg-5 shadow sticky-top mb-lg-5 position-sm-fixed navigation border-top">

            <div class="d-flex align-items-center mb-lg-3" v-cloak>

                <div class="flex-fill">

                    <div class="progress-bar">

                        <div class="status" :style="{width : completedPercent+'%'}"></div>

                    </div>

                </div>

                <div class="color-yellow  ms-3 text-center">

                    <div class="fs-lg-1-1 fs-08 fw-700">@{{ completedPercent.toFixed(2) }}%</div>

                    <div class="fs-08">{{ __("Completed")}}</div>

                </div>

                <a href="JavaScript:;" class="ms-3 d-lg-none" @click="showNavigation = !showNavigation">

                    <img :src="'/images/'+(showNavigation ? 'down-chevron.svg' : 'up-chevron.svg')" width="30">

                </a>

            </div>

            <div class="d-lg-block scrollable-navigation" :class="{'d-block' : showNavigation, 'd-none' : !showNavigation}">

                <div class="mb-3">

                    <h3 class="fw-600">{{ __("Navigation")}}</h3>

                </div>


                <div class="d-flex align-content-start flex-wrap mx--8">

                    @php
                    $counter = 1;
                    @endphp

                    @foreach($questions as $k => $question)

                    <a href="#{{ strtolower(str_replace(' ', '-', $question['title'])) }}" class="navigation-circle m-2 fw-600 text-decoration-none" :class="{'active' : ($refs.question{{ $question['id'] }}1 && $refs.question{{ $question['id'] }}1.checked) || ($refs.question{{ $question['id'] }}2 && $refs.question{{ $question['id'] }}2.checked) || ($refs.question{{ $question['id'] }}3 && $refs.question{{ $question['id'] }}3.checked) || ($refs.question{{ $question['id'] }}4 && $refs.question{{ $question['id'] }}4.checked) || ($refs.question{{ $question['id'] }}5 && $refs.question{{ $question['id'] }}5.checked)}" @click="showNavigation = false">{{ $counter }}</a>

                    @php

                    $counter++;

                    @endphp

                    @endforeach


                </div>

            </div>

        </div>

    </div>

</div>

</div>

@endsection
