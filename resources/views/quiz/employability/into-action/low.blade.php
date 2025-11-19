<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("INTO ACTION")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The")}} <strong>{{__("Into Action")}}</strong> {{__("domain relates to your ability to use ideas and opportunities combined with the appropriate internal and external resources, to develop effective plans and strategies that will help you make progress and achieve your goals. This includes the ability to take the initiative, persevere through periods of uncertainty and learn from your experience to develop your knowledge and skills.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse7');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse7">

    <h5 class="fw-600 text-muted mb-2">{{__("Motivation and Perseverance")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Motivation and Perseverance"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to work hard and remain motivated is an important skill in the workplace. Success in achieving your goals and much of your progress will depend on these characteristics. It is important to make the effort to overcome challenges, so that goals can be reached and progress made.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about the importance of motivation and hard work in many areas of life. Reflect on an occasion when you have worked have and have been pleased with the resulting success. Learn from those around you whose hard work and persistent motivation have brought them success.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Working with Others")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Working with Others"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to work in a team is an important skill in the workplace. Many tasks are completed and goals reached through teamwork and networking with other people. There is often a need to work with diverse people, who have different and complementary skillsets.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about the importance of teamwork in different areas of life. Reflect on an occasion when you have seen successful teamwork or experienced working in a team where goals were met successfully. Learn from others around who are good team players, by observing how they respond to different challenges.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Planning and Management")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Planning and Management"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to plan projects is a useful skill in the workplace. It can help to define achievable goals, incorporate short-term milestones for progress and allow ideas to be evaluated. Planning skills can also be used in many different work situations.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about the importance of planning in different areas of life. Reflect on an occasion when successful planning resulted in a positive outcome. Learn from others around you who plan projects and events successfully.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Learning Through Experience")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Learning Through Experience"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being aware of what you are learning whilst working on a project is an important skill, as it will help you to make improvements in yourself and in your skill-set. Once the project is completed, identify what you have learnt from the experience. You can learn from success and from mistakes, so make sure you reflect on both of these aspects of your work.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about how you can become aware of what you are learning in your work. Reflect on an occasion when you have learnt something specific from a particular experience. Learn by observing others who make the most of every learning experience.")}}</div>

        </div>

      </div>

    </div>






    <h5 class="fw-600 text-muted mb-2">{{__("Coping with Uncertainty Ambiguity and Risk")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Coping with Uncertainty Ambiguity and Risk"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being aware of and adapting in changing circumstances is an important skill to develop. When you have completed a project, look back at times when you found it hard to change your plans or make a decision when the circumstances were unclear. It is important to have clear goals and targets in work, so make sure these are defined before you begin a project.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Think about the importance of flexibility in work situations. Reflect on occasions when you have been able to change plans and the success you achieved. Learn from those around you who are able to show clear decision making in ambiguous situations.")}}</div>

        </div>

      </div>

    </div>





    <h5 class="fw-600 text-muted mb-2">{{__("Taking the Initiative")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <div class="row align-items-center mb-0">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <employability-horizontal-bar-chart :data='@json($data)' domain="{{ $domain }}" value="Taking the Initiative"></employability-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area you should give some attention to. That’s ok; this is a skill you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to take responsibility and initiative are important skills in the workplace. Learn to identify areas where you know you could bring improvement and develop plans to do so. Work with others to see your plans carried out. When you meet challenges at work, take responsibility to meet them through reflection and planning. Ensure you consider the resources you will need.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("Think about the need for taking responsibility for change in the work environment. Reflect on an occasion when you have successfully affected change. Learn from others around you who like to take responsibility and enjoy taking the initiative.")}}</div>

        </div>

      </div>

    </div>


  </div>

</div>
