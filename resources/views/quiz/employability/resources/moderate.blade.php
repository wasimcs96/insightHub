<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("RESOURCES")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The")}} <strong>{{__("Resources")}}</strong> {{__("domain relates to the ability to use both internal resources (awareness, motivation and stress regulation) and external resources (help from others, financial support and knowledge) to achieve goals. This domain includes the ability to recognise your personal strengths and apply them effectively to make progress. It also relates to the ability to motivate and gain support from others, bringing people together to work towards an important goal.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse5');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse5">

    <h5 class="fw-600 text-muted mb-2">{{__("Self Awareness")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Self Awareness"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to understand yourself.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that you have some understanding of your own abilities and have some skill to evaluate different viewpoints when making decisions. You also have some ability in making presentations.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now you are aware that this is an important skill, you will find it helpful to.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Self Efficacy")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Self Efficacy"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to believe you can complete work successfully, even when facing difficulties.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that at times you may see when a mistake has been made, allowing you to learn and continue your work.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware this is an important skill work with others who are able to encourage you to keep moving forward with tasks. This will make you more confident in your ability.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Financial and Economic Literacy")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Financial and Economic Literacy"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability for financial planning.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that at times you will be able to develop budgets for short and long-term projects. You may also be able to evaluate the costs and benefits of new ideas.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware this is an important skill, develop your ability by practising financial planning on a small scale. Work with and observe others who already work in this area.")}}</div>

        </div>

      </div>

    </div>




    <h5 class="fw-600 text-muted mb-2">{{__("Mobilising Others")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Mobilising Others"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to encourage and inspire others.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that at times you are able to encourage others to contribute to and support projects in which you are involved. You may also be able to assemble a well-balanced team, which takes into account individual strengths and weaknesses.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware this is an important skill develop your team building skills by working with and observing others who work in successful teams.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Mobilising Resources")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-0">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Mobilising Resources"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to use and gather resources.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that at times you are able to plan projects appropriate to the resources you have and are able to gather. You may also understand how to budget for a project, after finding sponsors.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware that this is an important skill, learn how to manage the resources needed in small projects you may be working in now. Observe people who manage resources in different situations (teams, voluntary organisations) to learn the skills needed.")}}</div>

        </div>

      </div>

    </div>

  </div>

</div>
