@extends('layout.app')

@section('app')

<div>

  <div class="w-100 bg-purple-gradient">

    <div class="container py-5">

      <a href="{{ config('app.remote_base_url') }}" class="color-white text-white text-decoration-none fs-1-2 d-flex align-items-center fw-500 mb-5"><img src="/images/arrow-back.svg" class="me-3"> BACK</a>

      <div class="row align-items-center mb-4">

        <div class="col-12 col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">

          <h1 class="color-white fs-3-rem fw-700">{{ __("Design your")}}<br class="d-none d-lg-inline"> {{ __("Future Today")}}</h1>

          <p class="color-white fs-1-1">{{ __("Our Careers Explorer uses your attitude to a variety of areas to help you understand more about what careers may be a good fit for you.")}}</p>

        </div>

        <div class="col-12 col-lg-6">

          <img src="/images/career-explorer-main2.svg" class="intro-header-image mx-auto ms-lg-auto me-lg-0 d-block">

        </div>

      </div>

      <div class="text-center">

        <a href="/quiz/interest-riasec" class="btn btn-white shadow rounded-custom px-5 fs-2-rem mb-3 fw-600">{{ __("Take the test now")}}</a>

        <p class="color-white fs-1-1">{{ __("Only takes 10 mins")}}</p>

      </div>

    </div>

  </div>

  <div class="full-size-bg-img careers-bg-image py-5">

    <div class="container py-lg-5">

      <div class="row">

        <div class="col-12 col-lg-6">

          <h1 class="color-purple fs-3-rem fw-700 mb-4">{{ __("You have not yet taken the Work Interests questionnaire.")}}</h1>

<h3 class="color-purple fs-1.5-rem fw-500 mb-4">{{ __("Please click here to take the test and see which career may be best for you.")}}</h3>

          <div class="text-center text-lg-start">

            <a href="/quiz/interest-riasec" class="btn btn-gradient shadow rounded-custom px-5 fs-1-5 mb-3 fw-600 text-white">{{ __("Take the test now")}}</a>

            <p class="color-purple fs-1-1">{{ __("Only takes 10 mins")}}</p>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

@endsection
