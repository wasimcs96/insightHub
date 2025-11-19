@extends('layout.quiz')

@section('content')

<div class="text-center">

  <h1 class="text-white">{{ $questions['title'] }}</h1>

</div>

</div><!-- close parent div to get out of purple bacgkround -->
</div><!-- close parent div to get out of purple bacgkround -->

<div class="container py-5">

  <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center mb-5">

    <interest-riasec-double-bar-chart :data='@json($questions)'></interest-riasec-double-bar-chart>

  </div>

  <div class="row mb-4">

    <div class="col-12 col-lg-4 mb-4 mb-lg-0">

      <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center min-h-100">

        <div class="mb-4">

          <div class="mb-4">

            <img src="/images/realistic-practical.svg">

          </div>

          <h2 class="text-black mb-0 fw-600">Realistic (Practical)</h2>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">Enjoy practical, hands-on work with materials and nature; problem-solving in real life</div>

        </div>

      </div>

    </div>

    <div class="col-12 col-lg-4 mb-4 mb-lg-0">

      <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center min-h-100">

        <div class="mb-4">

          <div class="mb-4">

            <img src="/images/investigative-thinker.svg">

          </div>

          <h2 class="text-black mb-0 fw-600">Investigative (Thinker)</h2>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">Enjoy like working with theory and abstract problem-solving, research and intellectual inquiry, investigating ideas</div>

        </div>

      </div>

    </div>

    <div class="col-12 col-lg-4">

      <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center min-h-100">

        <div class="mb-4">

          <div class="mb-4">

            <img src="/images/artistic-creative.svg">

          </div>

          <h2 class="text-black mb-0 fw-600">Artistic (Creative)</h2>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">Enjoy working in the arts and in creative work that involves designing new approaches, solutions or products</div>

        </div>

      </div>

    </div>

  </div>

  <div class="row mb-4">

    <div class="col-12 col-lg-4 mb-4 mb-lg-0">

      <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center min-h-100">

        <div class="mb-4">

          <div class="mb-4">

            <img src="/images/social-helper.svg">

          </div>

          <h2 class="text-black mb-0 fw-600">Social (Helper)</h2>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">Enjoy helping, serving and assisting other people and promoting others' welfare</div>

        </div>

      </div>

    </div>

    <div class="col-12 col-lg-4 mb-4 mb-lg-0">

      <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center min-h-100">

        <div class="mb-4">

          <div class="mb-4">

            <img src="/images/realistic-practical.svg">

          </div>

          <h2 class="text-black mb-0 fw-600">Realistic (Practical)</h2>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">Enjoy practical, hands-on work with materials and nature; problem-solving in real life</div>

        </div>

      </div>

    </div>

    <div class="col-12 col-lg-4">

      <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center min-h-100">

        <div class="mb-4">

          <div class="mb-4">

            <img src="/images/enterprising-persuader.svg">

          </div>

          <h2 class="text-black mb-0 fw-600">Enterprising (Persuader)</h2>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">Enjoy leading, motivating and influencing others and taking a lead in starting and initiating projects</div>

        </div>

      </div>

    </div>

  </div>

</div>
@endsection
