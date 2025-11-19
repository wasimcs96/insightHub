<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("INTERPERSONAL")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The Interpersonal domain describes the ability to relate to others and build relationships with colleagues and clients, enhancing motivation and engagement so that others work together towards inspiring goals.")}}</div>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("It also relates to the skills required for effective teamwork including listening to, coaching, collaborating alongside and problem solving with, a diverse group of people.")}}</div>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("These skills will be important for all roles in the future of work")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse6');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse6">

    <h5 class="fw-600 text-muted mb-2">{{__("Mobilising Systems")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I can role model positive behaviour to others")}}</li>
      <li>{{__("I can negotiate with others so that everyone feels that they have gained a positive result")}}</li>
      <li>{{__("I can create an inspiring vision around a project or idea to build motivation and engagement in others")}}</li>
      <li>{{__("I can gain the information required to understand how organisations work and what is required of me")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Mobilising Systems"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have some ability in this area. Developing this skill will position you well to access opportunities in the world of work for the future.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to be a role model of positive behaviour, negotiating with others so that everyone feels that they have gained a positive result and creating an inspiring vision around a project or idea to build motivation and engagement in others are all important skills in the modern workplace. Gaining the information required to understand how organisations work and what is required of you is also significant.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Developing Relationships")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I have empathy for others and can put myself in their position to understand their point of view")}}</li>
      <li>{{__("I can build trusting relationship with others by being open, honest and supportive")}}</li>
      <li>{{__("I can demonstrate humility in my interactions with others")}}</li>
      <li>{{__("I am sociable and can easily build relationships with other students, work colleagues or clients")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Developing Relationships"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have some ability in this area. Developing this skill will position you well to access opportunities in the world of work for the future.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to have empathy for others by putting yourself in their position to understand their point of view, build trusting relationship with others by being open, honest and supportive and demonstrate humility in your interactions with others are important skills in the workplace. Being sociable opens the way to building relationships with work colleagues or clients.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Effective Teamwork")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("When working in a group I ensure that others feel included and their views are heard")}}</li>
      <li>{{__("I get to know people as individuals and understand what motivates them")}}</li>
      <li>{{__("I am good at supporting others to resolve conflicts")}}</li>
      <li>{{__("I am comfortable working with a diverse group of people towards a common goal")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Effective Teamwork"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have some ability in this area. Developing this skill will position you well to access opportunities in the world of work for the future.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to work with a diverse group of people towards a common goal and ensure that they feel included and their views are heard is important in the workplace today. Getting to know people as individuals, understanding what motivates them and supporting them to resolve conflicts are significant skills for the workplace.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Coaching Others")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <ul class="text-muted fs-1-rem mb-0">

      <li>{{__("I can help others think about what they want to achieve")}}</li>
      <li>{{__("I am good at empowering others by helping them focus on their strengths")}}</li>
      <li>{{__("I can help others set goals for themselves")}}</li>
      <li>{{__("I can facilitate others to develop skills and knowledge")}}</li>

    </ul>

    <div class="row align-items-center mb-0">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Coaching Others"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have some ability in this area. Developing this skill will position you well to access opportunities in the world of work for the future.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to help others think about what they want to achieve, to empower them by helping them focus on their strengths, to help set goals for themselves and to facilitate the development of their skills and knowledge are all important coaching skills needed in the workplace today.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>






  </div>

</div>
