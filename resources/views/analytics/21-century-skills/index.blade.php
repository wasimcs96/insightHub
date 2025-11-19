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

        <div class="border-bottom mb-3 text-start">

          <div class="d-flex justify-content-between align-items-center ">

            <div class="text-muted fw-600 fs-1-rem">COGNITIVE</div>

            <a href="JavaScript:;" @click="collapse('custom-collapse1');$event.target.innerText == 'Learn More' ? $event.target.innerText = 'Close' : $event.target.innerText = 'Learn More'" class="btn btn-gradient rounded-custom px-5 text-white mb-3">Learn More</a>

          </div>

          <div class="custom-collapse mb-3" id="custom-collapse1">

            <p class="text-muted">The Cognitive domain relates to the ability to obtain relevant information and use critical thinking to solve problems, make clear plans and manage one’s time and communicate effectively.</p>

            <p class="text-muted">It also relates to the ability to apply mental flexibility – creativity, imagination, seeing things from different perspectives and learning – to adapt to change and meet one’s goals.</p>

          </div>

        </div>

        <div class="border-bottom mb-3 text-start">

          <div class="d-flex justify-content-between align-items-center ">

            <div class="text-muted fw-600 fs-1-rem">INTERPERSONAL</div>

            <a href="JavaScript:;" @click="collapse('custom-collapse2');$event.target.innerText == 'Learn More' ? $event.target.innerText = 'Close' : $event.target.innerText = 'Learn More'" class="btn btn-gradient rounded-custom px-5 text-white mb-3">Learn More</a>

          </div>

          <div class="custom-collapse mb-3" id="custom-collapse2">

            <p class="text-muted">The Interpersonal domain describes the ability to relate to others and build relationships with colleagues and clients, enhancing motivation and engagement so that others work together towards inspiring goals.</p>

            <p class="text-muted">It also relates to the skills required for effective teamwork including listening to, coaching, collaborating alongside and problem solving with, a diverse group of people.</p>

          </div>

        </div>

        <div class="border-bottom mb-3 text-start">

          <div class="d-flex justify-content-between align-items-center ">

            <div class="text-muted fw-600 fs-1-rem">SELF-LEADERSHIP</div>

            <a href="JavaScript:;" @click="collapse('custom-collapse3');$event.target.innerText == 'Learn More' ? $event.target.innerText = 'Close' : $event.target.innerText = 'Learn More'" class="btn btn-gradient rounded-custom px-5 text-white mb-3">Learn More</a>

          </div>

          <div class="custom-collapse mb-3" id="custom-collapse3">

            <p class="text-muted">This domain relates to the ability to use self-awareness, self-management including looking after one’s wellbeing and building stress resilience, and the setting and meeting important goals.</p>

            <p class="text-muted">This domain also refers to the skills required for entrepreneurship including the ability to take appropriate risks, be innovate and infuse one’s work with energy, passion and optimism.</p>

          </div>

        </div>

        <div class="text-start">

          <div class="d-flex justify-content-between align-items-center ">

            <div class="text-muted fw-600 fs-1-rem">DIGITAL</div>

            <a href="JavaScript:;" @click="collapse('custom-collapse4');$event.target.innerText == 'Learn More' ? $event.target.innerText = 'Close' : $event.target.innerText = 'Learn More'" class="btn btn-gradient rounded-custom px-5 text-white mb-3">Learn More</a>

          </div>

          <div class="custom-collapse mb-3" id="custom-collapse4">

            <p class="text-muted">This domain relates to the ability to use digital technologies in the course of one’s work to gather information, communicate with others and enhance insights into relevant trends.</p>

            <p class="text-muted">A key part of this domain refers to the ability to adapt to new technologies as the pace of change will be accelerated in the future of work.</p>

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

            <twenty-first-century-doghnut-chart :data='@json($questions)' domain='{{ $domain["title"] }}'></twenty-first-century-doghnut-chart>

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
