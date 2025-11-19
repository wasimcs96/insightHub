<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("RESOURCES")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The")}} <strong>{{__("Resources")}}</strong> {{__("domain relates to the ability to use both internal resources (awareness, motivation and stress regulation) and external resources (help from others, financial support and knowledge) to achieve goals. This domain includes the ability to recognise your personal strengths and apply them effectively to make progress. It also relates to the ability to motivate and gain support from others, bringing people together to work towards an important goal.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse6');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse6">

    <h5 class="fw-600 text-muted mb-2">{{__("Self Awareness")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Self Awareness"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are good at knowing your own abilities. You can deliver presentations well and weigh the value of different options when decision making.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should motivate you to continue to develop the skills you already have and to identify those you need to learn.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Self Efficacy")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Self Efficacy"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are good at recognising and understanding when mistakes have been made when trying something new. This means that you are able to learn from your mistakes, while completing your work. You are able to push through difficulties to complete the given task.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should motivate you to continue trying new and more difficult work.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Financial and Economic Literacy")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Financial and Economic Literacy"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are good at developing budgets for projects and evaluating the costs and benefits of new ideas. You can also develop financial plans for long term projects.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should motivate you to develop your skills, enabling you to plan a career path involving financial planning.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Mobilising Others")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Mobilising Others"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are good at inspiring and motivating others to support and contribute to projects in which you are involved. You are also able to build a balanced team, by recognising the skills and weaknesses of individual team members.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should motivate you to consider a career which involves team work, allowing you to develop your skills for encouraging others.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted">{{__("Mobilising Resources")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Mobilising Resources"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are good at planning to use and gather the resources you need to complete your work. You can identify extra resources needed to overcome challenges found during the course of a project. You are able to find sponsors for a project and then manage the budget successfully.")}}</div>

        </div>

        <div>

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should motivate you to continue to develop your skills in resource management. You can do this by volunteering to help charities and youth groups in managing their resources.")}}</div>

        </div>

      </div>

    </div>






  </div>

</div>
