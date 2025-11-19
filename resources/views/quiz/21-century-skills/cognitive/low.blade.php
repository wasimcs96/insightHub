<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("COGNITIVE")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The Cognitive domain relates to the ability to obtain relevant information and use critical thinking to solve problems, make clear plans and manage your time and communicate effectively.")}}</div>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("It also relates to the ability to apply mental flexibility – creativity, imagination, seeing things from different perspectives and learning – to adapt to change and meet your goals.")}}</div>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("These skills will be important for all roles in the future of work.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse1');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse1">

    <h5 class="fw-600 text-muted mb-2">{{__("Critical Thinking")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I can use logical thinking to solve problems")}}</li>
      <li>{{__("I am aware of unconscious biases in my thinking and how they can impact problem solving")}}</li>
      <li>{{__("I can obtain relevant information to help me solve problems")}}</li>
      <li>{{__("I can weigh up the advantages and disadvantages of a decision or course of action")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Critical Thinking"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area that requires some attention. That’s ok; this is a skill that you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to solve problems using logical thinking, obtaining relevant information and having an awareness of the impact of cognitive biases is important in the modern workplace. Weighing up the advantages and disadvantages of a decision or course of action is also an important skill.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>





    <h5 class="fw-600 text-muted mb-2">{{__("Planning and Ways of Working")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I am good at planning my time effectively to get the most important work completed")}}</li>
      <li>{{__("I can prioritise my work so that I get the most important work completed first")}}</li>
      <li>{{__("When starting a project, I can create a plan to ensure that I stay on track")}}</li>
      <li>{{__("I can switch tasks if required")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Planning and Ways of Working"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area that requires some attention. That’s ok; this is a skill that you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to plan and prioritise your work efficiently to ensure its completion is important in the modern workplace. When starting a project, creating a plan to ensure that you stay on track, yet being flexible to switch tasks if required is also an important skill.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>




    <h5 class="fw-600 text-muted mb-2">{{__("Communication")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I am confident about speaking in public")}}</li>
      <li>{{__("When starting a new piece of work, I can ask the right questions so that I have all the information that I need")}}</li>
      <li>{{__("I can understand key messages and communicate them to others in ways that they can easily understand")}}</li>
      <li>{{__("I am good at listening and understanding the views of others")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Communication"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area that requires some attention. That’s ok; this is a skill that you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to understand key messages and communicate them to others in ways that they can easily understand, listen well and understand the views of others are all important skills in the workplace. Asking the right questions so that you have all the information you need when starting a new piece of work is also important. Being able to speak in public could be an important skill to acquire.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Mental Flexibility")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I can use my creativity and imagination to help me solve problems or come up with new ideas")}}</li>
      <li>{{__("I can use learning from one area and apply it to another area for positive results")}}</li>
      <li>{{__("I can easily adapt to change")}}</li>
      <li>{{__("I can see a situation from many perspectives and am open to new learning")}}</li>

    </ul>

    <div class="row align-items-center mb-0">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Mental Flexibility"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area that requires some attention. That’s ok; this is a skill that you can develop.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to use creativity and imagination to help solve problems or come up with new ideas, to use learning from one area and apply it to another area for positive results, to see a situation from many perspectives and to be open to new learning are all important skills in the workplace. To use these effectively, you should easily adapt to change.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







  </div>

</div>
