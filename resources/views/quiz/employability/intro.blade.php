@extends('layout.app')

@section('app')

<div>

  <div class="w-100 bg-purple-gradient">

    <div class="container py-5">

      <a href="{{ route('employee.dashboard') }}" class="color-white text-white text-decoration-none fs-1-2 d-flex align-items-center fw-500 mb-5"><img src="/images/arrow-back.svg" class="me-3"> {{ __("BACK")}}</a>

      <div class="row align-items-center mb-4">

        <div class="col-12 col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">

          <h1 class="color-white fs-3-rem fw-700">{{ __("Design your")}}<br class="d-none d-lg-inline"> {{ __("Future Today")}}</h1>

          <p class="color-white fs-1-1">{{ __("Take your Employability test to discover what will make you highly employable and what you can do to unlock your full potential.")}}</p>

        </div>

        <div class="col-12 col-lg-6">

          <img src="/images/employability-main.svg" class="intro-header-image mx-auto ms-lg-auto me-lg-0 d-block">

        </div>

      </div>

      <div class="text-center">

        <a href="/quiz/{{ $quiz->name }}" class="btn btn-white shadow rounded-custom px-5 fs-2-rem mb-3 fw-600">{{ __("Take the test now")}}</a>

        <p class="color-white fs-1-1">{{ __("Only takes 10 mins")}}</p>

      </div>

    </div>

  </div>

  <div class="full-size-bg-img employability-bg-image py-5">

    <div class="container py-lg-5">

      <div class="row">

        <div class="col-12 col-lg-6">

          <h1 class="color-purple fs-3-rem fw-700 mb-4">{{ __("Employability Factors are used globally to discover dream careers")}}</h1>

          <div class="text-center text-lg-start">

            <a href="/quiz/{{ $quiz->name }}" class="btn btn-gradient shadow rounded-custom px-5 fs-1-5 mb-3 fw-600 text-white">{{ __("Complete your inventory")}}</a>

            <p class="color-purple fs-1-1">{{ __("Only takes 10 mins")}}</p>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div>

    <div class="container py-5">

      <h2 class="mb-4">{{ __("Discover which of the")}} <span class="color-yellow ">{{ __("16 factors")}}</span> {{ __("or competencies make you highly employable now and which skills you could focus on to enhance your employability.")}}</h2>

      <h1 class="color-purple fs-4-rem fw-700 mb-4">{{ __("Is it...")}}</h1>

      <div class="row mb-5">

        <div class="col-12 col-lg-4 mb-4 mb-lg-0">

          <div class="min-h-100 bg-purple-gradient-vertical d-flex align-items-center rounded-custom justify-content-between py-5">

            <div class="px-3 px-lg-5">

              <h1 class="color-white">{{ __("Creativity")}}</h1>

              <p class="color-white fs-1-2">{{ __("Thinking of new ideas & approaches.")}}</p>

            </div>

          </div>

        </div>

        <div class="col-12 col-lg-4 mb-4 mb-lg-0">

          <div class="min-h-100 bg-purple-gradient-vertical d-flex align-items-center rounded-custom justify-content-between py-5">

            <div class="px-3 px-lg-5">

              <h1 class="color-white">{{ __("Ethical Thinking")}}</h1>

              <p class="color-white fs-1-2">{{ __("Ethical standards of behaviour.")}}</p>

            </div>

          </div>

        </div>

        <div class="col-12 col-lg-4">

          <div class="min-h-100 bg-purple-gradient-vertical d-flex align-items-center rounded-custom justify-content-between py-5">

            <div class="px-3 px-lg-5">

              <h1 class="color-white">{{ __("Working with others")}}</h1>

              <p class="color-white fs-1-2">{{ __("Being part of a team.")}}</p>

            </div>

          </div>

        </div>

      </div>

      <div class="text-center">

        <a href="/quiz/{{ $quiz->name }}" class="btn btn-gradient shadow rounded-custom px-5 fs-1-5 mb-3 fw-600 text-white">{{ __("Take the test now")}}</a>

<p class="color-purple fs-1-1">{{ __("Only takes 10 mins")}}</p>

      </div>

    </div>

  </div>

</div>

@endsection
