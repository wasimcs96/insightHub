@extends('layout.quiz')

@section('content')

<div class="text-center">

  <h1 class="text-white">Analytical Dashboard</h1>

</div>

</div><!-- close parent div to get out of purple bacgkround -->
</div><!-- close parent div to get out of purple bacgkround -->

<div class="container py-5">

  <div class="row">

    @foreach($quizzes as $quiz)

    <div class="col-12 col-lg-4 mb-4">

      <div class="rounded-custom bg-white p-3 py-5 p-xl-5 shadow text-center">

        <h3 class="mb-4">{{ $quiz->title }}</h3>

        <p class="text-muted fs-08">To learn more about the users’ core work values click on “view details” below</p>

        <p class="text-muted fs-1-1 fw-600">COMPLETION RATE</p>

        <progress-bar name='test' percent='{{ $quiz->completed / $totalUsers }}'></progress-bar>

        <h5 class="mb-4 mt-4">{{ $quiz->completed }} / {{ $totalUsers }}</h5>

        <a href="/analytics/{{ $quiz->name }}" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white" type="submit">View Details</a>

      </div>

    </div>

    @endforeach

  </div>



</div>
@endsection
