<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("INTO ACTION")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The")}} <strong>{{__("Into Action")}}</strong> {{__("domain relates to your ability to use ideas and opportunities combined with the appropriate internal and external resources, to develop effective plans and strategies that will help you make progress and achieve your goals. This includes the ability to take the initiative, persevere through periods of uncertainty and learn from your experience to develop your knowledge and skills.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse9');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse9">

    <h5 class="fw-600 text-muted mb-2">{{__("Motivation and Perseverance")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Motivation and Perseverance"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are motivated and work hard to achieve your goals. When facing challenges you will work even harder to ensure your goals are met. Being aware of your strengths enables you to make progress at work.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should give you greater confidence that your motivation and hard work will bring success. Your ability to overcome challenges is an added bonus!")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Working with Others")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Working with Others"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are able to form teams and work with networks of people in order to meet the needs of a project. You are a good team player and have confidence in your ability to work with diverse individuals and groups in order to achieve a common goal.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should encourage you to develop your skills further. Find areas of life where you can practise your ability to work in teams, perhaps by volunteering for a charity project. This may also help you to develop leadership skills.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Planning and Management")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Planning and Management"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are able to plan projects, define priorities and give achievable milestones for progress. You can set clear goals at the beginning of a project, which you aim to achieve and are able to maximise the value of ideas you have encountered.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should help you to develop these skills further. Learn from those around you, who set goals and plan for other people. Develop your own plans for different areas of life, such as social events or events for a charity.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Learning Through Experience")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

      <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Learning Through Experience"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are able to improve, reflect and identify areas of learning when you have completed a project. You find ways of improving yourself by reflecting on what you have learnt from projects. You learn from experience by reflecting on mistakes and successes after completing a project. You can also identify precise areas of new learning.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should help you to learn in many situations. It could make you more adaptable as you learn different skills in particular projects. This will help you achieve your goals. Your skills to learn from your experience are a bonus to be enjoyed!")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Coping with Uncertainty Ambiguity and Risk")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

      <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Coping with Uncertainty Ambiguity and Risk"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are able to use your best judgment and the available information to make decisions, especially when the situation is ambiguous or uncertain. You are also adaptable when circumstances change and can change your plans in the course of completing your work. Alongside this, you have a clear idea of the goals and targets you aim to achieve.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should encourage you continue to develop your flexibility and understanding of uncertain situations. Your ability to remain on track to achieve your set goals is a valuable strength, which enables you to remain focused.")}}</div>

        </div>

      </div>

    </div>





    <h5 class="fw-600 text-muted mb-2">{{__("Taking the Initiative")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("High")}}</h5>

    <div class="row align-items-center">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

      <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Taking the Initiative"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area of strength for you.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You are able to take responsibility in meeting challenges at work and in the past you have initiated action to make improvements in school or work. You have also used different types of resources effectively to achieve your goals to bring change.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("Knowing this is an area of strength should help you to continue to influence your work environment in this way. Taking initiative is an important skill in the workplace and your experience will give you a good foundation to build on.")}}</div>

        </div>

      </div>

    </div>






  </div>

</div>
