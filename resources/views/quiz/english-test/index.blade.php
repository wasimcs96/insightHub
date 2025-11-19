@extends('layout.app')

@section('app')

<div class="full-size-bg-img work-values-bg-image-test py-5">

    <div class="container">

        <!-- <h1 class="color-white fs-3-rem fw-700 mb-5">Design your future today!<br class="d-none d-lg-inline"> English Skills Test</h1>

    <div class="row mb-5">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <div class="border-radius-20 bg-white overflow-hidden min-h-100">

          <img src="/images/work-values-test-1.jpg" class="w-100">

          <div class="p-3">

            <p class="color-purple fw-700 fs-1-1">Complete your assessment</p>

            <p class="fw-600 color-dark-gray mb-5">To find out your level of English Grammar and Comprehension.</p>

          </div>

        </div>

      </div>

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <div class="border-radius-20 bg-white overflow-hidden min-h-100">

          <img src="/images/work-values-test-2.jpg" class="w-100">

          <div class="p-3">

            <p class="color-purple fw-700 fs-1-1">Get your results</p>

            <p class="fw-600 color-dark-gray mb-5">Discover your level of proficiency in English Grammar and Comprehension.</p>

          </div>

        </div>

      </div>

      <div class="col-12 col-lg-4">

        <div class="border-radius-20 bg-white overflow-hidden min-h-100">

          <img src="/images/work-values-test-3.jpg" class="w-100">

          <div class="p-3">

            <p class="color-purple fw-700 fs-1-1">Your next steps</p>

            <p class="fw-600 color-dark-gray mb-5">Access feedback on how to improve your level of English.</p>

          </div>

        </div>

      </div>

    </div> -->

        <div class="text-center">

            <h1 class="color-white fw-700 mb-4">Welcome to the English Skills Test</h1>

            <p class="color-white fw-600 fs-1-1">Complete Part One on English Grammar before moving on to Part Two on Comprehension.<br>This test is timed and should take no more than 30 minutes and must be completed at one sitting.</p>

        </div>

    </div>

</div>


<div class="container py-5">

    <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow mb-4 text-center sticky-top z-index-10000">

        <h2 class="fw-600 mb-0">
            <count-down timer='{{ $timer }}' redirect='/quiz/{{ $questions["name"] }}/results'></count-down>
        </h2>

    </div>

    <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow mb-4">

        @if(!is_null($valueAnswers['Grammar']))

        <h5 class="fw-600 mb-4">English: global language & essential skill for employment</h5>

        <h5 class="mb-4">In the 17th century, during the time of Shakespeare, there were approximately six million English speakers in the world. (Source: The Cambridge Encyclopedia of the English Language, 2003). "Between 1600 and 1950 the total number of English speakers increased almost fiftyfold, to around 250 million," according to linguist and one of the world’s leading English language specialists, David Crystal. </h5>

        <h5 class="mb-4">Today, more than one billion people speak English as their main language and approximately 1.5billion are learning it. (Source: British Council). That means around 30% of the world’s population can communicate in English, making it a truly global language. </h5>

        <h5 class="mb-4">The world’s best universities teach in English, the top 100 employers pay higher salaries for multi-skilled staff who speak English and jobseekers with competency in English get the best jobs. So why has English become the global lingua franca*?</h5>

        <h5 class="mb-4">The British empire undeniably helped spread the language, but English has become a global language relatively recently. “Over the last few decades, the USA and its culture have totally dominated our everyday lives”, according to Michelle Connolly, an expert in global language. “We eat their food, we watch their movies, we read their websites: we need to use their language to access their culture. There’s even an apocryphal tale that Bill Gates was going to choose Spanish as the navigational language of Microsoft; at that time, there were more native speakers of Spanish in the world than there were native speakers of English. If he had, I think we’d all be saying ‘hola’ instead of ‘hello’!”, Connolly. </h5>

        <h5 class="mb-4">The English language is highly dynamic and still evolving. “It is a hybrid language which has taken a lot of its vocabulary and grammar from other languages”, David Crystal again. “Being so flexible and absorbent keeps it alive and vibrant, relevant and fun, to people all over the world”. </h5>

        <h5 class="mb-4">The rising global business market where English is the accepted language is probably the most significant factor why it is now the lingua franca. “If you want to join the global workforce then you will be highly competent in English,” Alison Chan, global recruitment specialist with HSBC. “The global workplace is desirable, competitive and lucrative. The top executives and highest paid staff are fluent in English and multi-skilled. They have excellent interpersonal skills, competency in a range of soft skills and expertise in their own field. And as I tell anyone looking for a good job today: you need as many skills as you can give yourself and I want to see English in your top three”.</h5>

        <h5>There are half a dozen official languages of the UN, of which English is only one; however, English is the official language of ASEAN, the Association of Southeast Asian Nations. When it was created in 1967 by Indonesia, Malaysia and Singapore, the stated objective of the Association was to stimulate economic development in the region. More than 50 years later, economic development and the rise of the importance of English in the region have gone hand in hand – at an exponentially healthy rate.</h5>

        @else

        <h5 class="fw-600">The test will close down after 30 minutes.</h5>

        <h5 class="fw-600 mb-4">You cannot pause, save or stop the test.</h5>

        <h5 class="mb-0">If you are unsure of the correct answer to a question, you may leave it blank and move on. Part One must be completed before you move on to Part Two, even if you have left a question unanswered.</h5>

        @endif

    </div>

    <div class="d-flex mb-4">

        <div class="d-flex align-items-center me-5">

            <div class="wizard-cirle border {{ is_null($valueAnswers['Grammar']) ? 'active' : 'complete' }}">{!! is_null($valueAnswers['Grammar']) ? '1' : "&#10004;" !!}</div>

            <div class="ms-2 text-muted fw-600">Grammar</div>

        </div>

        <div class="d-flex align-items-center me-5">

            <div class="wizard-cirle border {{ is_null($valueAnswers['Comprehension']) && !is_null($valueAnswers['Grammar']) ? 'active' : '' }}">2</div>

            <div class="ms-2 text-muted fw-600">Comprehension</div>

        </div>

    </div>

    <div class="row">

        <div class="col-12 col-lg-8">


            <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow mb-5">

                <form action="/quiz/{{ $questions['name'] }}" method="POST">

                    <input type="hidden" value="{{ is_null($valueAnswers['Grammar']) ? 'Grammar' : 'Comprehension'}}" name="type">

                    <div class="mb-5">

                        @foreach($questions['domains'] as $domain)

                        @foreach($domain['values'] as $value)

                        @if(is_null($valueAnswers["Grammar"]))

                        @if($value['title'] == 'Comprehension')

                        @continue

                        @endif

                        @else

                        @if($value['title'] == 'Grammar')

                        @continue

                        @endif

                        @endif

                        @foreach($value['questions'] as $question)

                        <div class="mb-5" ref="question{{ $question['id'] }}">

                            <input type="radio" id="test{{ $question['id'] }}" value="0" class="d-none" name="answers[{{ $question['id'] }}]" checked>

                            <p class="fs-1-1 fw-600 color-black english-test-anchor" id="{{ strtolower(str_replace(' ', '-', $question['title'])) }}">{{ $question['title'] }}</p>

                            @foreach($question['options'] as $i => $option)

                            <div class="d-flex align-items-center mb-3">

                                <div>

                                    <input type="radio" id="test{{ $question['id'] }}-{{ $i }}" value="{{ $option }}" name="answers[{{ $question['id'] }}]" @change="calculateCompletedPerc()">

                                    <label for="test{{ $question['id'].'-'.$i }}">&nbsp;</label>

                                </div>

                                <div class="ms-3 color-black">{{ $i }}</div>

                            </div>

                            @endforeach

                        </div>

                        @endforeach



                        @endforeach

                        @endforeach

                    </div>

                    <div class="d-flex align-items-center justify-content-between">

                        <button class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white" type="submit" value="submit" @click="checkFormWithTimer">Submit</button>

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

                        <div class="fs-08">Completed</div>

                    </div>

                    <a href="JavaScript:;" class="ms-3 d-lg-none" @click="showNavigation = !showNavigation">

                        <img :src="'/images/'+(showNavigation ? 'down-chevron.svg' : 'up-chevron.svg')" width="30">

                    </a>

                </div>

                <div class="d-lg-block scrollable-navigation" :class="{'d-block' : showNavigation, 'd-none' : !showNavigation}">

                    <div class="mb-3">

                        <h3 class="fw-600">Navigation</h3>

                    </div>


                    <div class="d-flex align-content-start flex-wrap mx--8">

                        @php
                        $counter = 1;
                        @endphp


                        @foreach($questions['domains'] as $domain)

                        @foreach($domain['values'] as $value)

                        @if(is_null($valueAnswers["Grammar"]))

                        @if($value['title'] == 'Comprehension')

                        @continue

                        @endif

                        @else

                        @if($value['title'] == 'Grammar')

                        @continue

                        @endif

                        @endif

                        @foreach($value['questions'] as $question)

                        <a href="#{{ strtolower(str_replace(' ', '-', $question['title'])) }}" class="navigation-circle m-2 fw-600 text-decoration-none" :class="{'active' : $refs.question{{ $question['id'] }} && checkSelectedInputs($refs.question{{ $question['id'] }}) }" @click="showNavigation = false">{{ $counter }}</a>

                        @php

                        $counter++;

                        @endphp

                        @endforeach


                        @endforeach

                        @endforeach


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
