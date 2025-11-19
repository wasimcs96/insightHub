<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("IDEAS AND OPPORTUNITIES")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The")}} <strong>{{__("Ideas and Opportunities")}}</strong> {{__("domain relates to the ability to identify the ideas and opportunities that will be most helpful in bringing value to your work and achieving your goals. An important part of this is the ability to develop a clear vision and to capitalise on ideas and opportunities to reach successful outcomes.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse2');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse2">

    <h5 class="fw-600 text-muted mb-2">{{__("Spotting Opportunities")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Spotting Opportunities"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to spot opportunities.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that at times you will see opportunities, which will benefit yourself and other people. You may also be able to engage in problem-solving to improve your own performance in work.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware this is an important skill, learn to identify, create and act on opportunities that will help you reach your goals.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Creativity")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Creativity"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to generate new ideas and persuade people to get involved in projects.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that at times you are able to contribute to idea generation, to problem-solving and can persuade others to get involved in projects.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware this is an important skill, learn to take opportunities to contribute your ideas for projects. This will help you to make progress towards your goals.")}}</div>

        </div>

      </div>

    </div>



    <h5 class="fw-600 text-muted mb-2">{{__("Valuing Ideas")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Valuing Ideas"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to evaluate and implement ideas.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that at times you will be able to assess the value of ideas. You can also support and implement ideas in order to complete a project.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware this is an important skill, practise using your abilities to assess the value of ideas. Develop the confidence to implement these ideas in projects, so that you can reach your goals.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Vision")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Vision"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to envision and inspire.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that to some degree you are able to build a vision of the future that reflects how you would like to live and inspires others. You may also be able to make appropriate decisions to ensure you achieve your goal.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware this is an important skill, take steps to develop your imaginary thinking so that you begin to construct a vision for the future. Also, strengthen your decision making skills to ensure they can bring about practical change.")}}</div>

        </div>

      </div>

    </div>





    <h5 class="fw-600 text-muted mb-2">{{__("Ethical and Sustainable Thinking")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-0">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Ethical and Sustainable Thinking"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate awareness of the importance ethical and sustainable values in work.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that to some degree you are guided by standards of integrity and ethical values in your behaviour and work. You may also promote these values and sustainable practices in the work setting.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware this is an important characteristic for work, think about how you can increase your knowledge of ethical values. Learn how you might promote these values in the work place as you strengthen your commitment to them.")}}</div>

        </div>

      </div>

    </div>





  </div>

</div>
