@extends('layout.quiz')

@section('content')

<div class="text-center">

  <h1 class="text-white">{{ $questions['title'] }}</h1>

</div>

</div><!-- close parent div to get out of purple bacgkround -->
</div><!-- close parent div to get out of purple bacgkround -->

<div class="container py-5">

  <div class="mb-4 text-center">

    <h2 class="mb-0">Domains</h2>

  </div>

  <!-- <work-values-pie-chart :data='@json($questions)'></work-values-pie-chart> -->

      <div class="row">

        @foreach($questions['domains'] as $domain)

        <div class="col-12 col-lg-6 mb-4">

          <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center">

            <h4>{{ $domain['title'] }}</h4>

            <work-values-pie-chart :data='@json($questions)' domain='{{ $domain["title"] }}'></work-values-pie-chart>

            <p class="text-muted">Percentage of talents who have scored low, moderate or high in the {{ $domain["title"] }} domain</p>

            <a href="/analytics/{{ $questions['name'] }}/{{ $domain['id'] }}/values" class="btn btn-gradient rounded-custom px-3 text-white mb-0">Competencies Analysis</a>

          </div>

        </div>

        @endforeach

      </div>


</div>
@endsection
