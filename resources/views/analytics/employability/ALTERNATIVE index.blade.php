@extends('layout.quiz')

@section('content')

<div class="text-center">

  <h1 class="text-white">{{ $questions['title'] }}</h1>

</div>

</div><!-- close parent div to get out of purple bacgkround -->
</div><!-- close parent div to get out of purple bacgkround -->

<div class="container py-5">

  <div class="row">

    <div class="col-12 col-lg-6 mb-4 mb-lg-0">

      <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center">

        <h4>Top Score Percentage of Each Domain</h4>

        <twenty-first-century-doghnut-chart-totals :data='@json($questions)'></twenty-first-century-doghnut-chart-totals>
		
<!-- @MIHAJLO: PLEASE REPLACE ABOVE CHART WITH THE SAME LOGIC FOR EMPLOYABILITY, USERS WHO HAVE SCORED TOP PERCENTAGE FOR EACH DOMAIN -->

        <div class="border-bottom mb-3 text-start">

          <div class="d-flex justify-content-between align-items-center ">

            <div class="text-muted fw-600 fs-1-rem">IDEAS AND OPPORTUNITIES</div>

            <a href="JavaScript:;" @click="collapse('custom-collapse1');$event.target.innerText == 'Learn More' ? $event.target.innerText = 'Close' : $event.target.innerText = 'Learn More'" class="btn btn-gradient rounded-custom px-5 text-white mb-3">Learn More</a>

          </div>

          <div class="custom-collapse mb-3" id="custom-collapse1">

            <p class="text-muted">The Ideas and Opportunities domain relates to the ability to identify the ideas and opportunities that will be most helpful in bringing value to talents' work and achieving their goals. An important part of this is the ability to develop a clear vision and to capitalise on ideas and opportunities to reach successful outcomes.</p>

          </div>

        </div>

        <div class="border-bottom mb-3 text-start">

          <div class="d-flex justify-content-between align-items-center ">

            <div class="text-muted fw-600 fs-1-rem">RESOURCES</div>

            <a href="JavaScript:;" @click="collapse('custom-collapse2');$event.target.innerText == 'Learn More' ? $event.target.innerText = 'Close' : $event.target.innerText = 'Learn More'" class="btn btn-gradient rounded-custom px-5 text-white mb-3">Learn More</a>

          </div>

          <div class="custom-collapse mb-3" id="custom-collapse2">

            <p class="text-muted">The Resources domain relates to the ability to use both internal resources (awareness, motivation and stress regulation) and external resources (help from others, financial support and knowledge) to achieve goals. This domain includes the ability to recognise talents' personal strengths and apply them effectively to make progress. It also relates to the ability to motivate and gain support from others, bringing people together to work towards an important goal.</p>

          </div>

        </div>

        <div class="border-bottom mb-3 text-start">

          <div class="d-flex justify-content-between align-items-center ">

            <div class="text-muted fw-600 fs-1-rem">INTO ACTION</div>

            <a href="JavaScript:;" @click="collapse('custom-collapse3');$event.target.innerText == 'Learn More' ? $event.target.innerText = 'Close' : $event.target.innerText = 'Learn More'" class="btn btn-gradient rounded-custom px-5 text-white mb-3">Learn More</a>

          </div>

          <div class="custom-collapse mb-3" id="custom-collapse3">

            <p class="text-muted">The Into Action domain relates to talents' ability to use ideas and opportunities combined with the appropriate internal and external resources, to develop effective plans and strategies that will help one make progress and achieve their goals. This includes the ability to take the initiative, persevere through periods of uncertainty and learn from their experiences to develop their knowledge and skills. </p>

          </div>

        </div>

      </div>

    </div>

    <div class="col-12 col-lg-6">

      <div class="row">

        @foreach($questions['domains'] as $domain)

        <div class="col-12 col-lg-6 mb-4">

          <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center">

            <h4>{{ $domain['title'] }}</h4>

            <employability-doghnut-chart :data='@json($questions)' domain='{{ $domain["title"] }}'></employability-doghnut-chart>

            <p class="text-muted">Percentage of talents who have scored low, moderate or high in the {{ $domain["title"] }} domain</p>

            <a href="/analytics/{{ $questions['name'] }}/{{ $domain['id'] }}/values" class="btn btn-gradient rounded-custom px-3 text-white mb-0">Competencies Analysis</a>

          </div>

        </div>

        @endforeach

      </div>

    </div>

  </div>



</div>
@endsection

