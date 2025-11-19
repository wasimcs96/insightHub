@extends('layout.app')

@section('app')

<div class="w-100 bg-purple-gradient py-5 border-radius-50 text-center">

  <div class="container">

    <a href="{{ config('app.remote_base_url') }}" class="color-white text-white text-decoration-none fs-1-2 d-flex align-items-center fw-500 mb-5"><img src="/images/arrow-back.svg" class="me-3"> BACK</a>

    <h1 class="color-white fs-7-rem fw-600">{{ __("Well Done!")}}</h1>

    <p class="color-white fs-1-1 fw-600">{{ __("for completing your Work Interests test")}}</p>

  </div>

</div>

<div class="py-5 bg-light">

  <div class="container">

    <div class="text-center mb-5">

      <h1 class="purple-gradient-text fw-600 fs-3-rem mb-5">{{ __("Your RIASEC Work Interests are")}}</h1>

      <a href="#results" class="btn btn-gradient shadow rounded-custom px-5 fs-1-2 mb-3 fw-600 text-white">{{ __("Find out now")}}</a>

    </div>

    <div class="row">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0 ms-auto">

        <div class="border-radius-20 bg-white overflow-hidden min-h-100">

          <img src="/images/work-values-test-2.jpg" class="w-100">

          <div class="p-3">

            <p class="color-purple fw-700 fs-1-1">{{ __("Get your results")}}</p>

            <p class="fw-600 color-dark-gray mb-5">{{ __("Discover your best fit and great fit career suggestions.")}}</p>

          </div>

        </div>

      </div>

      <div class="col-12 col-lg-1">


      </div>

      <div class="col-12 col-lg-4 me-auto">

        <div class="border-radius-20 bg-white overflow-hidden min-h-100">

          <img src="/images/work-values-test-1.jpg" class="w-100">

          <div class="p-3">

            <p class="color-purple fw-700 fs-1-1">{{ __("Your next steps")}}</p>

            <p class="fw-600 color-dark-gray mb-5">{{ __("Choose your Job Zone and go on to the Career Explorer.")}}</p>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>


<div class="container py-5" id="results">

  <interest-riasec-chart class="mb-5" :data='@json($results)' type='api'></interest-riasec-chart>

<form action="/quiz/onet-profiler/careers" method="get">

  @csrf

  @if($errors->any())

  <div class="alert alert-danger mt-4 mb-5 fw-700" role="alert">

    {{ __("Please select job zone.")}}

  </div>

  @endif

  <div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

    <div class="border-bottom mb-3">

      <div class="mb-3 d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center">

          <div class="me-3">

            <input type="radio" id="zone1" value="1" name="jobZone">

            <label for="zone1">&nbsp;</label>

          </div>

          <div class="text-muted fs-1-rem fw-600">{{ __("Job Zone One: Little or No Preparation Needed")}}</div>

        </div>

        <div>

          <a href="JavaScript:;" @click="collapse('custom-collapse1');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{ __("Learn More")}}</a>

        </div>

      </div>


      <div class="custom-collapse mb-3 mt-5" id="custom-collapse1">

        <h5 class="fw-600 text-muted">{{ __("Experience")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Little or no previous work-related skill, knowledge, or experience is needed for these careers. For example, a person can become a waiter or waitress even if he/she has never worked before.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Education")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Some of these careers may need a high school diploma or GED certificate.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Job Training")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Employees in these careers need from a few days to a few months of training. Usually, an experienced worker can show you how to do the job.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Examples")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("These careers involve following instructions and helping others. Examples include food preparation workers, dishwashers, sewing machine operators, landscaping and groundskeeping workers, logging equipment operators, and baristas.")}}</div>

        </div>

      </div>

    </div>


    <div class="border-bottom mb-3">

      <div class="mb-3 d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center">

          <div class="me-3">

            <input type="radio" id="zone2" value="2" name="jobZone">

            <label for="zone2">&nbsp;</label>

          </div>

          <div class="text-muted fs-1-rem fw-600">{{ __("Job Zone Two: Some Preparation Needed")}}</div>

        </div>

        <div>

          <a href="JavaScript:;" @click="collapse('custom-collapse2');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{ __('Learn More')}}</a>

        </div>

      </div>


      <div class="custom-collapse mb-3 mt-5" id="custom-collapse2">

        <h5 class="fw-600 text-muted">{{ __("Experience")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Some previous work-related skill, knowledge, or experience is usually needed. For example, it would help a teller to have experience working with the public.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Education")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("These careers usually need a high school diploma.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Job Training")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Employees in these careers need from a few months to one year of working with experienced employees. An apprenticeship program may be available for these careers.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Examples")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("These careers often involve using your knowledge and skills to help others. Examples include orderlies, counter and rental clerks, customer service representatives, security guards, upholsterers, and tellers.")}}</div>

        </div>

      </div>

    </div>


    <div class="border-bottom mb-3">

      <div class="mb-3 d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center">

          <div class="me-3">

            <input type="radio" id="zone3" value="3" name="jobZone">

            <label for="zone3">&nbsp;</label>

          </div>

          <div class="text-muted fs-1-rem fw-600">{{ __("Job Zone Three: Medium Preparation Needed")}}</div>

        </div>

        <div>

          <a href="JavaScript:;" @click="collapse('custom-collapse3');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{ __("Learn More")}}</a>

        </div>

      </div>


      <div class="custom-collapse mb-3 mt-5" id="custom-collapse3">

        <h5 class="fw-600 text-muted">{{ __("Experience")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Previous work-related skill, knowledge, or experience is needed for these careers. For example, an electrician must be in an apprenticeship for three to four years or have several years of job training. You may need to pass a test to get a license to do the job.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Education")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Most of these careers need vocational school training, on-the-job experience, or an associate's degree.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Job Training")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Employees in these careers need one or two years of training. Both on-the-job experience and informal training with experienced workers may be needed. An apprenticeship program may be a good choice for these careers.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Examples")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("These careers usually involve using communication and organizational skills to coordinate, supervise, manage, or train others to accomplish goals. Examples include hydroelectric production managers, travel guides, electricians, agricultural technicians, barbers, court reporters, and medical assistants.")}}</div>

        </div>

      </div>

    </div>


    <div class="border-bottom mb-3">

      <div class="mb-3 d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center">

          <div class="me-3">

            <input type="radio" id="zone4" value="4" name="jobZone">

            <label for="zone4">&nbsp;</label>

          </div>

          <div class="text-muted fs-1-rem fw-600">{{ __("Job Zone Four: High Preparation Needed")}}</div>

        </div>

        <div>

          <a href="JavaScript:;" @click="collapse('custom-collapse4');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{ __("Learn More")}}</a>

        </div>

      </div>


      <div class="custom-collapse mb-3 mt-5" id="custom-collapse4">

        <h5 class="fw-600 text-muted">{{ __("Experience")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Long term work-related skill, knowledge, or experience is needed for these careers. For example, an accountant must complete four years of college and work several years in the field to be qualified for the job.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Education")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Most of these careers need a four-year bachelor's degree, but some do not.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Job Training")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Employees in these careers need several years of work-related experience and training. Both on-the-job and classroom job training may be needed.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Examples")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Many of these careers involve coordinating, supervising, managing, or training others. Examples include real estate brokers, sales managers, database administrators, graphic designers, chemists, art directors, and cost estimators.")}}</div>

        </div>

      </div>

    </div>


    <div>

      <div class="mb-3 d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center">

          <div class="me-3">

            <input type="radio" id="zone5" value="5" name="jobZone">

            <label for="zone5">&nbsp;</label>

          </div>

          <div class="text-muted fs-1-rem fw-600">{{ __("Job Zone Five: Extensive Preparation Needed")}}</div>

        </div>

        <div>

          <a href="JavaScript:;" @click="collapse('custom-collapse5');$event.target.innerText == '{{ __('Learn More')}}' ? $event.target.innerText = '{{ __('Close')}}' : $event.target.innerText = '{{ __('Learn More')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{ __("Learn More")}}</a>

        </div>

      </div>


      <div class="custom-collapse mb-3 mt-5" id="custom-collapse5">

        <h5 class="fw-600 text-muted">{{ __("Experience")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Extensive skill, knowledge, and experience are needed for these careers. Many require more than five years of experience. For example, surgeons must complete four years of college and an additional five to seven years of specialized medical training to be able to do their job.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Education")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Most of these careers need a graduate school education. For example, they may require a master's degree, and some require a Ph.D., M.D., or J.D. (law degree).")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Job Training")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("Employees may need some on-the-job training. However, the person will usually have the needed skills, knowledge, work-related experience, and training before starting the job.")}}</div>

        </div>

        <h5 class="fw-600 text-muted">{{ __("Examples")}}</h5>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{ __("These careers often involve coordinating, training, supervising, or managing the activities of others to accomplish goals. Very advanced communication and organizational skills are required. Examples include pharmacists, lawyers, astronomers, biologists, clergy, neurologists, and veterinarians.")}}</div>

        </div>

      </div>

    </div>

  </div>

  <button class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white d-block mx-auto shadow" @click="$event.target.classList.add('spinner', 'spinner-light', 'spinner-right');$event.target.disabled=true;$event.target.closest('form').submit()">{{ __("Submit")}}</button>

</form>

  <!-- <onet-polar-chart class="mb-5" :data='@json($results)'></onet-polar-chart> -->

</div>



@endsection
