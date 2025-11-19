@extends('layout.app')

@section('app')

<div>

  <div class="w-100 bg-purple-gradient" style="    height: 100vh;">

    <div class="container py-5" style="    padding-top: 8rem !important;
    padding-bottom: 8rem !important;">



      <div class="row align-items-center mb-4">

        <div class="col-12 col-lg-12 mb-4 mb-lg-0 text-center text-lg-start">

          <h1 class="color-white fs-3-rem fw-700 text-center">Select Language for the Test</h1>

          {{-- <p class="color-white fs-1-1">Select Language for the Test</p> --}}

        </div>

        <!-- <div class="col-12 col-lg-6">

          <img src="/images/english-main.svg" class="intro-header-image mx-auto ms-lg-auto me-lg-0 d-block">

        </div> -->

      </div>

      <div class="row mb-5 justify-content-center">
<div class="col-lg-8">
        <select class="form-select form-select-lg mb-3" aria-label="Large select example" style="
        border-radius: 44px;
    ">
            <option value="en">English</option>
            <option value="my">Malay</option>
          </select>
        </div>
      </div> 

      <div class="text-center">

        <!-- <a class="btn btn-white shadow rounded-custom px-5 fs-2-rem mb-3 fw-600" data-bs-toggle="modal" data-bs-target="#confirmationModal">Take the test now</a> -->
        <a href="/quiz/cognitive-ability-assessment" class="btn btn-white shadow rounded-custom px-5 fs-2-rem mb-3 fw-600">Take the test now</a>
        <p class="color-white fs-1-1">Only takes 15 mins</p>

      </div>

    </div>

  </div>

</div>


@endsection
