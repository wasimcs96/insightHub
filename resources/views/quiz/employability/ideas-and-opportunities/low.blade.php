<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("IDEAS AND OPPORTUNITIES")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The")}} <strong>{{__("Ideas and Opportunities")}}</strong> {{__("domain relates to the ability to identify the ideas and opportunities that will be most helpful in bringing value to your work and achieving your goals. An important part of this is the ability to develop a clear vision and to capitalise on ideas and opportunities to reach successful outcomes.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse1');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse1">

    <h5 class="fw-600 text-muted mb-2">{{__("Spotting Opportunities")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Spotting Opportunities"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to identify, create and act on opportunities is important in helping you reach your goals. Learning to problem- solve can also improve your performance in work and bring benefits for others.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about how you could be more proactive in your work to benefit yourself and others. Reflect on occasions when you have successfully spotted opportunities and acted on them. Learn from others around you who are using this skill.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Creativity")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Creativity"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to contribute ideas and to solve problems are important skills when involved in work projects. Development in these skills will help you reach your goals and improve your work performance.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about how you could be more proactive in contributing ideas. Reflect on occasions when you have successfully contributed your ideas to a project or to solve a problem. Learn from others around you who are good at contributing their ideas and influencing others to get involved in projects.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Valuing Ideas")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Valuing Ideas"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to evaluate, support and implement ideas are important skills in many work areas. Having the confidence to assess the value of ideas will help you to understand the way to use these ideas in projects and improve your own work performance.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about how you could improve how you evaluate ideas. Reflect on occasions when you have been able to do this successfully. Learn from others around you who demonstrate the ability to evaluate and implement new ideas.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Vision")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Vision"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to imagine a future for yourself and others is an important skill. It helps to reach set goals and improve performance at work. Making the appropriate decisions to achieve these outcomes is a valuable skill to develop.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about how you could develop a vision for the future, in which you would like to live. Reflect on an occasion when you have successfully brought a vision for a project or action to reality. Learn from others around you who are inspirational and good at making decisions to reach their future goals.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Ethical and Sustainable Thinking")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-0">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Ethical and Sustainable Thinking"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Knowing reasons for ethical thinking and personal integrity is important in the workplace. Living by them and promoting them is equally important, as this will help you reach your own goals. Promoting sustainable practices is an important part of the modern workplace, so developing your awareness of this area may help you to improve your work performance.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("Think about how you could formulate values for your personal integrity and for ethical standards that could guide your behaviour. Reflect on when you have seen adherence to ethical standards impact people and situations, positively or negatively. Learn from others around you who live by ethical standards you can aspire to.")}}</div>

        </div>

      </div>

    </div>






  </div>

</div>
