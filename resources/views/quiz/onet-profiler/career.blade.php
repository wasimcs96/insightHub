@extends('layout.app')

@section('app')

<div class="w-100 bg-purple-gradient py-5 border-radius-50 text-center">
  <div class="container">
    {{-- Return Back  --}}
    {{-- <a href="{{ url()->previous() ?? config('app.remote_base_url') }}" class="color-white text-white text-decoration-none fs-1-2 d-flex align-items-center fw-500 mb-5"><img src="/images/arrow-back.svg" class="me-3"> BACK</a> --}}
    <a href="#" onclick="javascript:window.history.back(-1);return false;" class="color-white text-white text-decoration-none fs-1-2 d-flex align-items-center fw-500 mb-5"><img src="/images/arrow-back.svg" class="me-3"> BACK</a>
    <h1 class="color-white fs-4-rem fw-600">{{ __("Career Explorer")}}</h1>

  </div>

</div>

<div class="container py-5">

  <h1 class="color-purple fw-600 mb-5 color-purple">{{ $career['career']['title'] }}</h1>

  <div class="row mb-4">

    @if($career['career']['what_they_do'])
    <div class="col-12 col-lg-6 mb-4 mb-lg-0">

      <div>

         <h3 class="fw-600">{{ __("What they do?")}}</h3>

         <div class="text-muted fs-1-1">{{ $career['career']['what_they_do'] }}</div>

      </div>

    </div>
    @endif

    @if($career['career']['on_the_job'])
    <div class="col-12 col-lg-6">

      <div>

         <h3 class="fw-600">{{ __("On the job, you would:")}}</h3>

         <ul class="text-muted fs-1-1">
          @if(isset($career['career']) && isset($career['career']['on_the_job']) && isset($career['career']['on_the_job']['task']))
            @foreach($career['career']['on_the_job']['task'] as $task)

             <li>{{ $task }}</li>

            @endforeach
          @endif


         </ul>

      </div>

    </div>
    @endif

  </div>


  <div class="row mb-4">

    @if($career['knowledge'])
    <div class="col-12 col-lg mb-4 mb-lg-0">

      <div class="border shadow rounded p-3 min-h-100">

         <h3 class="fw-600 color-purple mb-4">{{ __("Knowledge")}}</h3>
         @if(isset($career['knowledge']) && isset($career['knowledge']['group']))
         @foreach($career['knowledge']['group'] as $value)

         <h5 class="fw-600">{{ $value['title']['name'] }}</h5>

         <ul class="text-muted fs-1-1">
          @if(isset($value['element']))
           @foreach($value['element'] as $val)

           <li>{{ $val['name'] }}</li>

           @endforeach
          @endif
         </ul>

         @endforeach
         @endif
      </div>

    </div>
    @endif

    @if($career['skills'])
    <div class="col-12 col-lg mb-4 mb-lg-0">

      <div class="border shadow rounded p-3 min-h-100">

         <h3 class="fw-600 color-purple mb-4">{{ __("Skills")}}</h3>
         @if(isset($career['skills']) && isset($career['skills']['group']))
         @foreach($career['skills']['group'] as $value)

         <h5 class="fw-600">{{ $value['title']['name'] }}</h5>

         <ul class="text-muted fs-1-1">
          @if(isset($value['element']))
           @foreach($value['element'] as $val)

           <li>{{ $val['name'] }}</li>

           @endforeach
          @endif
         </ul>

         @endforeach
         @endif
      </div>

    </div>
    @endif

    @if($career['abilities'])
    <div class="col-12 col-lg">

      <div class="border shadow rounded p-3 min-h-100">

         <h3 class="fw-600 color-purple mb-4">{{ __("Abilities")}}</h3>
         @if(isset($career['abilities']) && isset($career['abilities']['group']))
         @foreach($career['abilities']['group'] as $value)

         <h5 class="fw-600">{{ $value['title']['name'] }}</h5>

         <ul class="text-muted fs-1-1">
          @if(isset($value['element']))
           @foreach($value['element'] as $val)

           <li>{{ $val['name'] }}</li>

           @endforeach
          @endif
         </ul>

         @endforeach
         @endif
      </div>

    </div>
    @endif

  </div>

  <div class="row mb-4">

    @if($career['personality'])
    <div class="col-12 col-lg mb-4 mb-lg-0">

      <div class="border shadow rounded p-3 min-h-100">

         <h3 class="fw-600 color-purple mb-4">{{ __("Personality")}}</h3>

         @if($career['personality']['top_interest'])
         <div class="text-muted fs-1-1">{{ $career['personality']['top_interest']['description'] }}</div>
         @endif

         <ul class="text-muted fs-1-1">
          @if(isset($career['personality']) && isset($career['personality']['work_styles']) && isset($career['personality']['work_styles']['element']))
           @foreach($career['personality']['work_styles']['element'] as $value)

           <li>{{ $value['name'] }}</li>

           @endforeach
          @endif
         </ul>

      </div>

    </div>
    @endif

    @if($career['technology'])
    <div class="col-12 col-lg">

      <div class="border shadow rounded p-3 min-h-100">

         <h3 class="fw-600 color-purple mb-4">{{ __("Technology")}}</h3>

         <div class="text-muted fs-1-1 mb-4">{{ __("You might use software like this on the job:")}}</div>


         <ul class="text-muted fs-1-1">
          @if(isset($career['technology']) && isset($career['technology']['category']))
           @foreach($career['technology']['category'] as $value)

           <li class="color-purple fw-600">

             {{ $value['title']['name'] }}

             @if($value['example'])

             <ul class="text-muted fs-1-1">

               @foreach($value['example'] as $val)

               <li class="fw-400">
                 {{ $val['name'] }}
               </li>

               @endforeach
               

             </ul>

             @endif

           </li>

           @endforeach
           @endif
         </ul>

      </div>

    </div>
    @endif

  </div>


  <div class="row mb-4">

    @if($career['education'] && isset($career['education']['education_usually_needed']))
    <div class="col-12 col-lg mb-4 mb-lg-0">

      <div class="border shadow rounded p-3 min-h-100">

        <h3 class="fw-600 color-purple mb-4">{{ __("Education")}}</h3>

        <ul class="text-muted fs-1-1">
          @if(isset($career['education']) && isset($career['education']['education_usually_needed']) && isset($career['education']['education_usually_needed']['category']))
          @foreach($career['education']['education_usually_needed']['category'] as $value)

          <li>{{ $value }}</li>

          @endforeach
          @endif
        </ul>

      </div>

    </div>
    @endif

    @if($career['job_outlook'])
    <div class="col-12 col-lg mb-4 mb-lg-0">

      <div class="border shadow rounded p-3 min-h-100">

        <h3 class="fw-600 color-purple mb-4">{{ __("Job Outlook")}}</h3>

        <div class="d-flex align-items-center mb-4">

          <h4 class="color-purple fw-600 mb-0">{{ $career['job_outlook']['outlook']['category'] }}</h4>

          <div class="text-muted flex-fill fs-1-1 mb-0 ms-3">{{ $career['job_outlook']['outlook']['description'] }}</div>

        </div>

        <!-- <h4 class="fw-600 text-muted mb-4">Salary</h4> -->

      </div>

    </div>
    @endif

    @if($career['explore_more'] && isset($career['explore_more']['careers']))
    <div class="col-12 col-lg">

      <div class="border shadow rounded p-3 min-h-100">

        <h3 class="fw-600 color-purple mb-4">{{ __("Explore")}}</h3>

        <ul class="text-muted fs-1-1">
        @if(isset($career['explore_more']) && isset($career['explore_more']['careers']) && isset($career['explore_more']['careers']['career']))
          @foreach($career['explore_more']['careers']['career'] as $value)

          <li class="text-muted fw-600">{{ $value['title'] }}</li>

          @endforeach
        @endif
        </ul>

        <div class="text-muted fs-1-1 mb-4">{{ __("You might like a career in one of these industries:")}}</div>

        <ul class="text-muted fs-1-1">
          @if(isset($career['explore_more']) && isset($career['explore_more']['industries']) && isset($career['explore_more']['industries']['industry']))
          @foreach($career['explore_more']['industries']['industry'] as $value)

          <li class="text-muted fw-600">{{ $value['title'] }}</li>

          @endforeach
          @endif


        </ul>
        <!-- <h4 class="fw-600 text-muted mb-4">Salary</h4> -->

      </div>

    </div>
    @endif

  </div>

</div>
@endsection
