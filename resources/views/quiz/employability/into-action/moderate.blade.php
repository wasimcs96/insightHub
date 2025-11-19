<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("INTO ACTION")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The")}} <strong>{{__("Into Action")}}</strong> {{__("domain relates to your ability to use ideas and opportunities combined with the appropriate internal and external resources, to develop effective plans and strategies that will help you make progress and achieve your goals. This includes the ability to take the initiative, persevere through periods of uncertainty and learn from your experience to develop your knowledge and skills.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse8');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse8">

    <h5 class="fw-600 text-muted mb-2">{{__("Motivation and Perseverance")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Motivation and Perseverance"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to work hard and maintain motivation.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that at times you are able to give maximum effort and remain motivated in your work. You can also show some ability to overcome challenges when working, showing some confidence in your own strengths.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware that this is an important skill, try to ensure that you maintain your motivation as this will enable you to work harder. Achieving your goals and making progress will renew your motivation.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Working with Others")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Working with Others"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to work in a team or network.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that you can sometimes adapt to working with others in a team, in order to achieve the desired goal. You may also be able to form a team of individuals with diverse skills to ensure the needs of a project are met. You do have some confidence in your ability in this area.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware that this is an important skill, identify when team working is the best option for particular tasks. Make sure you are aware of the skills you bring to the team and how they can be used to bring successful results.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Planning and Management")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Planning and Management"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to develop plans for a project.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that you can sometimes set goals you want to achieve before beginning a project. You may be able to develop plans, which define priorities and give achievable milestones for progress. Within the plan, you may also be able to maximise the value of ideas you have encountered.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware that this is an important skill, learn to develop your planning ability. Observe people around you who plan successfully and find situations where you can use your planning ability to help others.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Learning Through Experience")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Learning Through Experience"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to learn and improve whilst working on a project.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that you have some ability to reflect on the successful aspects of a project and on the mistakes made once you have finished the work. You also have some ability to identify what you have learnt in a project and to use this to improve yourself.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware that this is an important skill, ensure that you take time to reflect and think during the process of the project. Make notes to remind yourself of what you have learnt and use these in further project work. Learning from experience is a valuable skill to develop.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Coping with Uncertainty Ambiguity and Risk")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Coping with Uncertainty Ambiguity and Risk"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to make decisions in unclear situations and to change plans in the course of your work.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that you have some ability to use available information and your best judgment to make decisions when faced with ambiguous or uncertain situations. You may be able to adapt your plans when circumstances change in the course of your work. Your goals and targets are sometimes clear.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware that this is an important skill, develop your flexibility and be ready to change plans when it is necessary. Uncertain situations at work can strengthen your ability to adapt and help you to ensure that your goals are clear enough to be achieved.")}}</div>

        </div>

      </div>

    </div>





    <h5 class="fw-600 text-muted mb-2">{{__("Taking the Initiative")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <div class="row align-items-center mb-0">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Taking the Initiative"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have a moderate ability to take initiative and responsibility for challenges in work.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This means that you may, in the past, have initiated action to make improvements at school or work and that you may have accepted some responsibility to meet challenges. You may also have achieved your goals using different types of resources successfully.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("Now that you are aware that this is an important skill, learn to take on greater responsibility for meeting challenges as this will increase your confidence. This may encourage you to begin to take the initiative in areas you believe could be improved. Gaining this skill will help you to achieve your goals.")}}</div>

        </div>

      </div>

    </div>


  </div>

</div>
