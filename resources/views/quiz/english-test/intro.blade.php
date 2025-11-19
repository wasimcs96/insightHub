@extends('layout.app')

@section('app')

<div>

  <div class="w-100 bg-purple-gradient">

    <div class="container py-5">

      <a href="{{ route('employee.dashboard') }}" class="color-white text-white text-decoration-none fs-1-2 d-flex align-items-center fw-500 mb-5"><img src="/images/arrow-back.svg" class="me-3"> BACK</a>

      <div class="row align-items-center mb-4">

        <div class="col-12 col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">

          <h1 class="color-white fs-3-rem fw-700">Design your<br class="d-none d-lg-inline"> Future Today</h1>

          <p class="color-white fs-1-1">Find out your level of English proficiency and how to improve it to maximise your career options.</p>

        </div>

        <!-- <div class="col-12 col-lg-6">

          <img src="/images/english-main.svg" class="intro-header-image mx-auto ms-lg-auto me-lg-0 d-block">

        </div> -->

      </div>

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

      </div> 

      <div class="text-center">

        <a class="btn btn-white shadow rounded-custom px-5 fs-2-rem mb-3 fw-600" data-bs-toggle="modal" data-bs-target="#confirmationModal">Take the test now</a>

        <p class="color-white fs-1-1">Only takes 30 mins</p>

      </div>

    </div>

  </div>

  <!-- <div class="full-size-bg-img english-bg-image py-5">

    <div class="container py-lg-5">

      <div class="row">

        <div class="col-12 col-lg-6">

          <h1 class="color-purple fs-3-rem fw-700 mb-4">English is an international language and opens career opportunities in Malaysia and globally</h1>

          <div class="text-center text-lg-start">

            <a class="btn btn-gradient shadow rounded-custom px-5 fs-1-5 mb-3 fw-600 text-white" data-bs-toggle="modal" data-bs-target="#confirmationModal">Take the test now</a>

            <p class="color-purple fs-1-1">Only takes 30 mins</p>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div>

    <div class="container py-5">

      <h2 class="mb-4">Discover your <span class="color-yellow ">level of proficiency</span> in English Grammar & Comprehension and how to improve your English skills.</h2>

      <div class="row justify-content-center mb-5">

        <div class="col-12 col-lg-4 mb-4 mb-lg-0">

          <div class="min-h-100 bg-purple-gradient-vertical d-flex align-items-center rounded-custom justify-content-between py-5">

            <div class="px-3 px-lg-5">

              <h1 class="color-white">Grammar</h1>

              <p class="color-white fs-1-2">Using everyday English.</p>

            </div>

          </div>

        </div>

        <div class="col-12 col-lg-4">

          <div class="min-h-100 bg-purple-gradient-vertical d-flex align-items-center rounded-custom justify-content-between py-5">

            <div class="px-3 px-lg-5">

              <h1 class="color-white">Comprehension</h1>

              <p class="color-white fs-1-2">Reading & understanding English tests.</p>

            </div>

          </div>

        </div>

      </div>
      <div class="text-center">

        <a class="btn btn-gradient shadow rounded-custom px-5 fs-1-5 mb-3 fw-600 text-white" data-bs-toggle="modal" data-bs-target="#confirmationModal">Take the test now</a>

<p class="color-purple fs-1-1">Only takes 30 mins</p>
      </div>

    </div>

  </div> -->

</div>

<!-- confirmation modal --> 
<div class="modal" tabindex="-1" role="dialog" id="confirmationModal">
  <div class="modal-dialog modal-dialog-centered rounded" role="document">
    <div class="modal-content" style="border-radius: 50px">
      <div class="modal-body text-center" style="padding-top:32px">
        <h4>Please note that this is a timed test. Once you click “Start Test”, the timer will begin and cannot be paused.  </h4>        
        <h4>Kindly do not refresh or navigate away from the page as the timer will continue to run.</h4>        
      </div>
      <div class="modal-footer justify-content-center" style="border-top: 0 none">
        <a href="/quiz/{{ $quiz->name }}" class="btn btn-gradient rounded-custom px-5 fs-1-4 mb-3 fw-300 text-white">Start Test</a>
        <button type="button" class="btn btn-white rounded-custom px-5 fs-1-4 mb-3 fw-300" style="border-color:#D63382;color:#D63382 !important" data-bs-dismiss="modal">Maybe Later</button>
      </div>
    </div>
  </div>
</div>

@endsection
