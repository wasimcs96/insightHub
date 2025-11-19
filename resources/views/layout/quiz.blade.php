@extends('layout.app')

@section('app')
<div class="w-100 bg-purple-gradient pt-5 border-radius-50 h-300">

  <x-header />

  <div class="container mt-5">

    @yield('content', 'Default content')

  </div>

</div>
@endsection
