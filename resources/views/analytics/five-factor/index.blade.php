@extends('layout.quiz')

@section('content')

<div class="text-center">

  <h1 class="text-white">{{ $questions['title'] }}</h1>

</div>

</div><!-- close parent div to get out of purple bacgkround -->
</div><!-- close parent div to get out of purple bacgkround -->

<div class="container py-5">



  <div class="row">

    @foreach($questions['domains'] as $domain)

      @foreach($domain['values'] as $value)

      <div class="col-12 col-lg-4 mb-4">

        <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center">

          <h4>{{ $value['title'] }}</h4>

          <five-factor-pie-chart :data='@json($questions)' value='{{ $value["title"] }}'></five-factor-pie-chart>

        </div>

      </div>

      @endforeach

    @endforeach

  </div>



</div>
@endsection
