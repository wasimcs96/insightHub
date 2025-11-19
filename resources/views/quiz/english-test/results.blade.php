@extends('layout.app')

@section('app')

<div class="w-100 bg-purple-gradient py-5 border-radius-50 text-center">

  <div class="container py-5">
  
    <a href="{{ config('app.remote_base_url') }}" class="color-white text-white text-decoration-none fs-1-2 d-flex align-items-center fw-500 mb-5"><img src="/images/arrow-back.svg" class="me-3"> BACK</a> 

    <h1 class="color-white fs-7-rem fw-600">Well Done!</h1>

    <p class="color-white fs-1-1 fw-600">for completing your English Skills Test</p>

  </div>

</div>

<div class="py-5 bg-light">

  <div class="container">

    <div class="text-center mb-5">

      <h1 class="purple-gradient-text fw-600 fs-3-rem mb-5">Your English Skills are</h1>

      <a href="#results" class="btn btn-gradient shadow rounded-custom px-5 fs-1-2 mb-3 fw-600 text-white">Find out now</a>

    </div>

    <div class="row">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0 ms-auto">

        <div class="border-radius-20 bg-white overflow-hidden min-h-100">

          <img src="/images/work-values-test-2.jpg" class="w-100">

          <div class="p-3">

            <p class="color-purple fw-700 fs-1-1">Get your results</p>

            <p class="fw-600 color-dark-gray mb-5">Will receive separate scores for English Grammar and Comprehension from levels of one to five.</p>

          </div>

        </div>

      </div>

      <div class="col-12 col-lg-1">


      </div>

      <div class="col-12 col-lg-4 me-auto">

        <div class="border-radius-20 bg-white overflow-hidden min-h-100">

          <img src="/images/work-values-test-1.jpg" class="w-100">

          <div class="p-3">

            <p class="color-purple fw-700 fs-1-1">Your next steps</p>

            <p class="fw-600 color-dark-gray mb-5">Discover how you can improve your English proficiency.</p>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<div class="container py-5" id="results">

  <div class="bg-white rounded-custom shadow p-3 p-lg-5 mb-5 text-start">

    <img src="/images/english-test/visual-eng-english-grammar.svg" class="d-block mb-3 mx-auto me-lg-auto ms-lg-0" width="200">

    <h2 class="text-black mb-4 fw-600 text-center text-lg-start">English Grammar Feedback</h2>

    <div class="row align-items-center">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        @php

        $percent = $valueAnswers['Grammar'] * 100 / 20;

        switch(true){

          case $percent < 50:

          $result = 1;

          break;

          case $percent >= 50 && $percent < 60:

          $result = 2;

          break;

          case $percent >= 60 && $percent < 75:

          $result = 3;

          break;

          case $percent >= 75 && $percent < 90:

          $result = 4;

          break;

          case $percent >= 90:

          $result = 5;

          break;

        }

        @endphp

        <english-test-gauge-chart color="#FB8E40" max="5" val="{{ $result }}"></english-test-gauge-chart>

      </div>

      <div class="col-12 col-lg-8">

        @include('quiz.english-test.results.grammar.level-'.$result)

      </div>

    </div>

  </div>


  <div class="bg-white rounded-custom shadow p-3 p-lg-5 mb-5 text-start">

    <img src="/images/english-test/visual-eng-english-reading-comp.svg" class="d-block mb-3 mx-auto me-lg-auto ms-lg-0" width="200">

    <h2 class="text-black mb-4 fw-600 text-center text-lg-start">English Reading and Comprehension Feedback</h2>

    <div class="row align-items-center">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        @php

        $percent = $valueAnswers['Comprehension'] * 100 / 30;

        switch(true){

          case $percent < 50:

          $result = 1;

          break;

          case $percent >= 50 && $percent < 60:

          $result = 2;

          break;

          case $percent >= 60 && $percent < 75:

          $result = 3;

          break;

          case $percent >= 75 && $percent < 90:

          $result = 4;

          break;

          case $percent >= 90:

          $result = 5;

          break;

        }

        @endphp

        <english-test-gauge-chart color="#71ADD9" max="5" val="{{ $result }}"></english-test-gauge-chart>



      </div>

      <div class="col-12 col-lg-8">

        @include('quiz.english-test.results.comprehension.level-'.$result)

      </div>

    </div>



  </div>

</div>
<div class="w-100 bg-purple-gradient py-5 text-center">

  <div class="container py-lg-5">

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">

        <h1 class="color-white fs-3-rem fw-700">Congratulations!</h1>

        <h4 class="color-white fw-600 mb-4">On completing the English Skills Test!</h4>

        <p class="color-white fs-1-1 mb-5">Now that you now know your level of English, give attention to moving on to a higher level of proficiency.</p>

        <a href="{{ config('app.remote_base_url') }}" class="btn btn-white shadow rounded-custom px-5 fs-1-2 mb-3 fw-600">Finish</a>

      </div>

      <div class="col-12 col-lg-6">

        <img src="/images/after-results.svg" class="intro-header-image mx-auto ms-lg-auto me-lg-0 d-block">

      </div>

    </div>

  </div>

</div>


@endsection
