@extends('layout.app')

@section('app')

<div class="w-100 bg-purple-gradient py-5 border-radius-50 text-center">

    <div class="container">

        {{-- <a href="{{ url()->previous() ?? config('app.remote_base_url') }}" class="color-white text-white text-decoration-none fs-1-2 d-flex align-items-center fw-500 mb-5"><img src="/images/arrow-back.svg" class="me-3"> BACK</a> --}}
        <a href="#" onclick="javascript:window.history.back(-1);return false;" class="color-white text-white text-decoration-none fs-1-2 d-flex align-items-center fw-500 mb-5"><img src="/images/arrow-back.svg" class="me-3"> BACK</a>
        <h1 class="color-white fs-3-rem fw-600 my-3">{{ __("We have considered your best and great fit careers.")}}</h1>

    </div>

</div>

<div class="container py-5">

    <div class="bg-white rounded-custom p-3 p-lg-5 shadow my-3 my-lg-5">

        <h2 class="mb-3 fw-600">{{ __("Careers that fit your interests and preparation level")}}</h2>

        <div class="mb-5 d-flex align-items-center">

            <div class="d-flex align-items-center me-5">

                <img src="/images/star-icon-filled.svg" width="25">

                <div class="text-muted fs-1-rem fw-600 ms-2">{{ __("Best Fit")}}</div>

            </div>

            <div class="d-flex align-items-center">

                <img src="/images/star-icon-empty.svg" width="25">

                <div class="text-muted fs-1-rem fw-600 ms-2">{{ __("Great Fit")}}</div>

            </div>

        </div>

        @foreach($careers['career'] as $career)

        <div class="border-bottom mb-3">

            <div class="mb-3 d-flex align-items-center justify-content-between">

                <div class="d-flex align-items-center">

                    <img src="/images/star-icon-{{ $career['fit'] == 'Best' ? 'filled' : 'empty' }}.svg" width="25">

                    <div class="text-muted fs-1-rem fw-600 ms-3">{{ $career['title'] }}</div>

                </div>

                <div>

                    <a href="/quiz/onet-profiler/career/{{ $career['code'] }}" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{ __("Learn More")}}</a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

<div class="w-100 bg-purple-gradient py-5 text-center">

    <div class="container py-lg-5">

        <div class="row align-items-center mb-4">

            <div class="col-12 col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">

                <h1 class="color-white fs-3-rem fw-700">{{ __("Congratulations!")}}</h1>

                <h4 class="color-white fw-600 mb-4">{{ __("On exploring your career options")}}</h4>

                <p class="color-white fs-1-1 mb-5">{{ __("Now that you have seen a sample of best fit and great fit career options and learned more about them, bear these in mind in planning for future careers as well as looking for your first job.")}}</p>

                <a href="javascript:void(0);" onclick="eventCall('Complete Career Explorer')" class="btn btn-white shadow rounded-custom px-5 fs-1-2 mb-3 fw-600">{{ __("Finish")}}</a>




            </div>

            <div class="col-12 col-lg-6">

                <img src="/images/after-results.svg" class="intro-header-image mx-auto ms-lg-auto me-lg-0 d-block">

            </div>

        </div>

    </div>

</div>


@endsection
