<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("RESOURCES")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The")}} <strong>{{__("Resources")}}</strong> {{__("domain relates to the ability to use both internal resources (awareness, motivation and stress regulation) and external resources (help from others, financial support and knowledge) to achieve goals. This domain includes the ability to recognise your personal strengths and apply them effectively to make progress. It also relates to the ability to motivate and gain support from others, bringing people together to work towards an important goal.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse4');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse4">

    <h5 class="fw-600 text-muted mb-2">{{__("Self Awareness")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Self Awareness"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to understand and know your own areas of competence will help you plan your career path. The ability to think through different options before making a decision will enable you to be confident in your choices.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about how you could develop your self-awareness. Reflect on occasions when you have been aware of your ability to complete a task. Learn from others who demonstrate self-awareness in their work.")}}</div>

        </div>

      </div>

    </div>



    <h5 class="fw-600 text-muted mb-2">{{__("Self Efficacy")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Self Efficacy"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to believe in your ability to successfully complete your work will help you approach new projects with confidence. It will also help you to recognise that mistakes can be learning experiences, not disasters!")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about how you can learn to boost your confidence in work. Reflect on occasions when you have successfully completed work, despite difficulties. Learn from others who use their confident belief to realise success.")}}</div>

        </div>

      </div>

    </div>



    <h5 class="fw-600 text-muted mb-2">{{__("Financial and Economic Literacy")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Financial and Economic Literacy"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to understand the financial implications of work projects may be important in helping you achieve your goals. Learning how to evaluate the costs of new projects will enable you to plan your own career path more accurately.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about how you could learn new skills in this area. Reflect on occasions when you have successfully made financial plans. Learn from and observe others who work in financial planning.")}}</div>

        </div>

      </div>

    </div>



    <h5 class="fw-600 text-muted mb-2">{{__("Mobilising Others")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Mobilising Others"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to encourage others to be involved in a team for a project can be a useful skill in many areas of work. Learning to recognise different skill sets in others may also help you to bring together a balanced team, when approaching new work.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about how you could learn to give others encouragement and motivation. Reflect on situations where you have been a member of a successful team and consider why it worked. Learn from others who are inspirational in leading a team.")}}</div>

        </div>

      </div>

    </div>



    <h5 class="fw-600 text-muted mb-2">{{__("Mobilising Resources")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-0">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Mobilising Resources"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to resource a project can be an important skill to bring to your work. Successful management of resources and finance are necessary in most areas of work.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("Think about how you could be involved in resource management now; perhaps by volunteering with a charitable organisation. Reflect on occasions when you have successfully planned and resourced an activity. Learn from others who are skilled in this area.")}}</div>

        </div>

      </div>

    </div>

  </div>

</div>
