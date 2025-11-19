@extends('layout.app')

@section('app')

<div class="w-100 bg-purple-gradient py-5 border-radius-50 text-center">

  <h1 class="color-white fs-7-rem fw-600">{{__("Well Done!")}}</h1>

  <p class="color-white fs-1-1 fw-600">{{__("for completing your Future of Work test")}}</p>

</div>

<div class="py-5 bg-light">

  <div class="container">

    <div class="text-center mb-5">

      <h1 class="purple-gradient-text fw-600 fs-3-rem mb-5">{{__("Your Future of Work competencies are")}}</h1>

      <a href="#results" class="btn btn-gradient shadow rounded-custom px-5 fs-1-2 mb-3 fw-600 text-white">{{__("Find out now")}}</a>

    </div>

    <div class="row">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0 ms-auto">

        <div class="border-radius-20 bg-white overflow-hidden min-h-100">

          <img src="/images/work-values-test-2.jpg" class="w-100">

          <div class="p-3">

            <p class="color-purple fw-700 fs-1-1">{{__("Get your results")}}</p>

            <p class="fw-600 color-dark-gray mb-5">{{__("These charts indicate which of the 4 domains and 16 competencies you are high, moderate and low in.")}}</p>

          </div>

        </div>

      </div>

      <div class="col-12 col-lg-1">


      </div>

      <div class="col-12 col-lg-4 me-auto">

        <div class="border-radius-20 bg-white overflow-hidden min-h-100">

          <img src="/images/work-values-test-1.jpg" class="w-100">

          <div class="p-3">

            <p class="color-purple fw-700 fs-1-1">{{__("Your next steps")}}</p>

            <p class="fw-600 color-dark-gray mb-5">{{__("Under")}} <i>{{__("learn more")}}</i> {{__("discover feedback on what each value means and how it impacts your career plan.")}}</p>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<div class="container py-5" id="results">

  @php

  $total = 0;

  @endphp

  @foreach($questionsOnly as $question)

  @php

  $total += $question['answer']['answer'];

  @endphp

  @endforeach

  @php

  $total = $total * 100 / 320;

  @endphp

  <div class="bg-white rounded-custom shadow p-3 p-lg-5 mb-5 text-start">

    @if($total < 33)

    <h3 class="mb-5 text-muted text-center fw-600">{{__("You have a low overall level of future of work skills. Find out more below about how you can improve on these to become highly employable in the future world of work.")}}</h3>

    @elseif($total >= 33 && $total <= 67)

    <h3 class="mb-5 text-muted text-center fw-600">{{__("You have a moderate overall level of future of work skills. Find out more below about how you can improve on these to become highly employable in the future world of work.")}}</h3>

    @else

    <h3 class="mb-5 text-muted text-center fw-600">{{__("You have a high overall level of future of work skills. Find out more below about how you can improve on these to become highly employable in the future world of work.")}}</h3>

    @endif

    <div class="row">

      @foreach($questions['domains'] as $domain)

      <div class="col-12 col-lg-3 mb-4">

        <twenty-first-century-gauge-chart :data='@json($questions)' domain="{{ $domain['title'] }}" color="{{ $domain['color'] }}"></twenty-first-century-gauge-chart>

      </div>

      @endforeach

    </div>

    <twenty-first-century-bar-chart class="mb-5" :data='@json($questions)'></twenty-first-century-bar-chart>

    <div class="d-flex align-items-center justify-content-center mb-5">

      @foreach($questions['domains'] as $domain)

      <div class="mx-3-chart d-lg-flex-chart">

        <div class="legend-square-chart me-2" style="background:{{ $domain['color'] }}"></div>

        <div class="text-muted fw-600 fs-08 ">{{ __($domain['title']) }}</div>

      </div>

      @endforeach

    </div>

  </div>

  @foreach($questions['domains'] as $domain)

    @php

    $totalScore = 0;

    @endphp

    @foreach($domain['values'] as $value)

    @php

    $totalScore += $value["answers_sum_answer"] * 100 / 80;

    @endphp

    @endforeach

    @include('quiz.21-century-skills.'.strtolower(str_replace(' ','-',$domain['title'])).'.'.($totalScore <= 33 ? 'low' : ($totalScore > 33 && $totalScore <= 67 ? 'moderate' : 'high')),['data' => $questions, 'domain' => $domain['title']])

  @endforeach

</div>

<div class="w-100 bg-purple-gradient py-5 text-center">

  <div class="container py-lg-5">

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">

        <h1 class="color-white fs-3-rem fw-700">{{__("Congratulations!")}}</h1>

        <h4 class="color-white fw-600 mb-4">{{__("On completing the Future of Work test!")}}</h4>

        <p class="color-white fs-1-1 mb-5">{{__("Now that you now know where you are already competent to take opportunities in the future, give attention to how you can improve the competencies you are weaker in to increase your option for career progression")}}</p>

        <a href="{{ config('app.remote_base_url') }}" class="btn btn-white shadow rounded-custom px-5 fs-1-2 mb-3 fw-600">{{__("Finish")}}</a>

      </div>

      <div class="col-12 col-lg-6">

        <img src="/images/after-results.svg" class="intro-header-image mx-auto ms-lg-auto me-lg-0 d-block">

      </div>

    </div>

  </div>

</div>


@endsection
