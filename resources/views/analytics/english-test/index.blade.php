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

        <english-test-doghnut-chart-totals :data='@json($questions)'></english-test-doghnut-chart-totals>

        <div class="text-start">

          <div class="text-muted fw-600 fs-1-rem">Level 1</div>

          <p class="text-muted">Talents who have demonstrated basic knowledge of English Grammar and/or basic understanding of a text in English.</p>

          <div class="text-muted fw-600 fs-1-rem">Level 2</div>

          <p class="text-muted">Talents who have demonstrated average knowledge of English Grammar and/or average understanding of a text in English.</p>

          <div class="text-muted fw-600 fs-1-rem">Level 3</div>

          <p class="text-muted">Talents who have demonstrated above average knowledge of English Grammar and/or above average understanding of a text in English.</p>

          <div class="text-muted fw-600 fs-1-rem">Level 4</div>

          <p class="text-muted">Talents who have demonstrated good knowledge of English Grammar and/or good understanding of a text in English.</p>

          <div class="text-muted fw-600 fs-1-rem">Level 5</div>

          <p class="text-muted mb-0">Talents who have demonstrated excellent knowledge of English Grammar and/or excellent understanding of a text in English.</p>

        </div>

      </div>

    </div>

    <div class="col-12 col-lg-6">

      <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center mb-4">

        <h4>English Grammar</h4>

        <english-test-doghnut-chart-totals :data='@json($questions)' type='Grammar'></english-test-doghnut-chart-totals>

        <p class="text-muted mb-0">Percentage of talents who have scored Level 1, Level 2, Level 3, Level 4 or Level 5 in the English Grammar Test</p>

      </div>

      <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center">

        <h4>English Reading and Comprehension</h4>

        <english-test-doghnut-chart-totals :data='@json($questions)' type='Comprehension'></english-test-doghnut-chart-totals>

        <p class="text-muted mb-0">Percentage of talents who have scored Level 1, Level 2, Level 3, Level 4 or Level 5 in the English Reading and Comprehension Test</p>

      </div>

    </div>

  </div>


</div>
@endsection
