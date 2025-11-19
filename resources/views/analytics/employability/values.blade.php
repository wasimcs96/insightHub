@extends('layout.quiz')

@section('content')

<div class="text-center">

  <h1 class="text-white mb-3">{{ $questions['title'] }}</h1>

  <h3 class="text-white">{{ $quizDomain['title'] }} Domain Details</h3>

</div>

</div><!-- close parent div to get out of purple bacgkround -->
</div><!-- close parent div to get out of purple bacgkround -->

<div class="container py-5">


  <div class="mb-4 text-center">

    <h2 class="mb-0">Factors</h2>

  </div>

  <div class="row">

    @foreach($questions['domains'] as $domain)

      @if($domain['id'] == $quizDomain->id)

      @foreach($domain['values'] as $value)

      <div class="col-12 col-lg-4 mb-4">

        <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center">

          <h4 class=" text-center">{{ $value['title'] }}</h4>

          <employability-doghnut-chart :data='@json($questions)' value='{{ $value["title"] }}'></employability-doghnut-chart>

          <p class="text-muted fs-08 mt-3 text-center">Percentage of talents who have scored low, moderate or high in the {{ $value["title"] }} factor</p>

          <p class="text-muted">{{ __('analytics.values')[$value["title"]][0] }}</p>

          <p class="text-muted">{{ __('analytics.values')[$value["title"]][1] }}</p>

        </div>

      </div>

      @endforeach

      @endif

    @endforeach

  </div>



</div>
@endsection
