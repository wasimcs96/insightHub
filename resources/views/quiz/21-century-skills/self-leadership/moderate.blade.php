<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("SELF-LEADERSHIP")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("This domain relates to the ability to use self-awareness, self-management including looking after your wellbeing and building stress resilience, and the setting and meeting important goals.")}}</div>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("These skills will be important for all roles in the future of work.")}}</div>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("This domain also refers to the skills required for entrepreneurship including the ability to take appropriate risks, be innovate and infuse your work with energy, passion and optimism.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse8');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse8">

    <h5 class="fw-600 text-muted mb-2">{{__("Self-Awareness")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I can understand my emotions and how the impact me")}}</li>
      <li>{{__("I know what triggers my emotional responses")}}</li>
      <li>{{__("I can calm myself down when feeling stressed")}}</li>
      <li>{{__("I know my strengths and how to maximise them")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Self-Awareness"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have some ability in this area. Developing this skill will position you well to access opportunities in the world of work for the future.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to understand your emotions, how they impact you and knowing how to calm yourself down when you are feeling stressed is important for your health, wellbeing, and your performance at work.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Self-Management")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I can look after my physical and psychological wellbeing")}}</li>
      <li>{{__("I know how to motivate myself so that I make progress towards my goals")}}</li>
      <li>{{__("I am confident in my abilities to make progress towards my goals")}}</li>
      <li>{{__("I have integrity and adhering to my core values is important to me")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Self-Management"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have some ability in this area. Developing this skill will position you well to access opportunities in the world of work for the future.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to look after your wellbeing, motivate yourself and make progress towards your goals is important for your ability to secure employment and progress in your career.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Entrepreneurship")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <ul class="text-muted fs-1-rem mb-0">

      <li>{{__("I have the courage to take appropriate risks when developing a new idea or product")}}</li>
      <li>{{__("I am comfortable with change and can come up with innovative solutions")}}</li>
      <li>{{__("I am not afraid to do things differently if the old ways are no longer working")}}</li>
      <li>{{__("I have energy, passion, positivity and optimism in my approach to my work")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Entrepreneurship"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have some ability in this area. Developing this skill will position you well to access opportunities in the world of work for the future.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to take appropriate risks, innovate, adapt to change and apply positive energy towards your work is important for your ability to secure employment, progress in your career and stay ahead of the competition.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Goal Achievement")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Moderate")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I can set my own goals and take responsibility for their achievement")}}</li>
      <li>{{__("I persevere and make progress towards important goals despite facing challenges")}}</li>
      <li>{{__("I can keep working towards important goals in periods of uncertainty")}}</li>
      <li>{{__("I am always learning and developing my skills")}}</li>

    </ul>

    <div class="row align-items-center mb-0">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Goal Achievement"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("You have some ability in this area. Developing this skill will position you well to access opportunities in the world of work for the future.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to take responsibility for setting and working towards your goals, persevering, especially during periods of uncertainty and committing to your professional development is important for your ability to secure employment and progress in your career.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>


  </div>

</div>
