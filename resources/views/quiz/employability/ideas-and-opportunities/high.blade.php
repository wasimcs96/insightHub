<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("IDEAS AND OPPORTUNITIES")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The")}} <strong>{{__("Ideas and Opportunities")}}</strong> {{__("domain relates to the ability to identify the ideas and opportunities that will be most helpful in bringing value to your work and achieving your goals. An important part of this is the ability to develop a clear vision and to capitalise on ideas and opportunities to reach successful outcomes.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse3');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse3">

    <h5 class="fw-600 text-muted mb-2">{{__("Spotting Opportunities")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Spotting Opportunities"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are good at spotting opportunities, which other people may not see, bringing benefits to yourself and others. You have the ability to create opportunities and to problem-solve in order to improve your performance in school or work.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should motivate you to attain your goals by continuing to look for, create and act on opportunities presented to you.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Creativity")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Creativity"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are good at brain storming to generate new ideas and finding ways to meet challenges at school or work. You have the ability to persuade people to get involved in projects.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should motivate you to contribute your ideas and influence the development of projects. This will help you attain your goals.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Valuing Ideas")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Valuing Ideas"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are good at estimating the value of ideas and finding solutions to problems in your work.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should motivate you to support and implement valuable ideas for projects. Strength in this area will help you to attain your goals.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Vision")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Vision"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are good at building a vision of the future that inspires other people and reflects the future in which you would like to live. You are also able to understand what decisions need to be made to achieve that vision for your life.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should motivate you to develop vision for yourself and others, including making the appropriate decisions to achieve your goal.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Ethical and Sustainable Thinking")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Ethical and Sustainable Thinking"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You know why integrity and ethical behaviour is important. Your own behaviour reflects this and you take responsibility to promote and advance ethical practices in work.")}}</div>

        </div>

        <div>

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should encourage and motivate you to promote ethical and sustainable behaviour, thinking and practice in work settings.")}}</div>

        </div>

      </div>

    </div>






  </div>

</div>
