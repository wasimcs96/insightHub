@extends('layout.app')

@section('app')
<div>

  <div class="w-100 bg-purple-gradient">

    <div class="container py-5">

      

      <div class="row align-items-center mb-4">

        <div class="col-12 col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">

        <h1 class="color-white fs-3-rem fw-700">{{ __("Your result for") }} <br class="d-none d-lg-inline"> {{ __("Cognitive Ability Assessment") }}</h1>

          <!-- <p class="color-white fs-1-1">Find out your level of Cognitive Ability and how to improve it to maximise your career options.</p> -->

        </div>

        <!-- <div class="col-12 col-lg-6">

          <img src="/images/english-main.svg" class="intro-header-image mx-auto ms-lg-auto me-lg-0 d-block">

        </div> -->

      </div>

      <!-- <div class="row mb-5">

        <div class="col-12 col-lg-4 mb-4 mb-lg-0">

          <div class="border-radius-20 bg-white overflow-hidden min-h-100">

            <img src="/images/work-values-test-1.jpg" class="w-100">

            <div class="p-3">

              <p class="color-purple fw-700 fs-1-1">Complete your assessment</p>

              <p class="fw-600 color-dark-gray mb-5">To find out your level of Cognitive Ability.</p>

            </div>

          </div>

        </div>

        <div class="col-12 col-lg-4 mb-4 mb-lg-0">

          <div class="border-radius-20 bg-white overflow-hidden min-h-100">

            <img src="/images/work-values-test-2.jpg" class="w-100">

            <div class="p-3">

              <p class="color-purple fw-700 fs-1-1">Get your results</p>

              <p class="fw-600 color-dark-gray mb-5">Discover your level of Cognitive Ability.</p>

            </div>

          </div>

        </div>

        <div class="col-12 col-lg-4">

          <div class="border-radius-20 bg-white overflow-hidden min-h-100">

            <img src="/images/work-values-test-3.jpg" class="w-100">

            <div class="p-3">

              <p class="color-purple fw-700 fs-1-1">Your next steps</p>

              <p class="fw-600 color-dark-gray mb-5">Access feedback on how to improve your level of Cognitive Ability.</p>

            </div>

          </div>

        </div>

      </div>  -->

      <div class="text-center">

        <!-- <a class="btn btn-white shadow rounded-custom px-5 fs-2-rem mb-3 fw-600" data-bs-toggle="modal" data-bs-target="#confirmationModal">Take the test now</a> -->
        <a class="btn btn-white shadow rounded-custom px-5 fs-2-rem mb-3 fw-600">{{ __("Score")}}: {{ __("Not Eligible") }}</a>
        <p class="color-white fs-1-1">{{ __("Level") }}: {{ __("You are not eligible to give this assessment") }}</p>

      </div>

    </div>

  </div>


</div>




@endsection
