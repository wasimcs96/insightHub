<div class="bg-white rounded-custom p-3 p-lg-5 shadow mb-5">

  <div class="mb-4">

    <h4 class="text-black mb-3 fw-600">{{__("DIGITAL")}}</h4>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("This domain relates to the ability to use digital technologies in the course of your work to gather information, communicate with others and enhance insights into relevant trends.")}}</div>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("A key part of this domain refers to the ability to adapt to new technologies as the pace of change will be accelerated in the future of work.")}}</div>

  </div>

  <div class="mb-3">

    <div class="text-muted fs-1-rem">{{__("The last two factors in the Digital domain refer specifically to the ability to develop and use specialised technology skills. These may only be relevant to those considering a career in the digital field.")}}</div>

  </div>

  <div>

    <a href="JavaScript:;" @click="collapse('custom-collapse10');$event.target.innerText == '{{ __('Your Results')}}' ? $event.target.innerText = '{{ __('Hide Results')}}' : $event.target.innerText = '{{ __('Your Results')}}'" class="btn btn-gradient rounded-custom px-5 fs-1-1 text-white">{{__("Your Results")}}</a>

  </div>


  <div class="custom-collapse mb-3 mt-5" id="custom-collapse10">

    <h5 class="fw-600 text-muted mb-2">{{__("Digital Fluency")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I can find, evaluate, utilise, share, and create content using information technologies and the Internet.")}}</li>
      <li>{{__("I can collaborate with other and complete work using digital devices and technology")}}</li>
      <li>{{__("I can use technology to gather information, learn new things and develop new skills")}}</li>
      <li>{{__("I understand the importance of managing myself professionally and ethically via online and digital mediums")}}</li>

    </ul>


    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Digital Fluency"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area that may require some attention, depending on your chosen career.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to use technology and interact professionally in the digital world are important skills to some extent, in all careers in the future of work.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("Take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Software Use")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I can adapt to using new software in my work")}}</li>
      <li>{{__("I can understand how new software can integrate with established ways of working")}}</li>
      <li>{{__("I am open to learning how to use new software in my work")}}</li>
      <li>{{__("I am confident in learning how to use new software and digital systems")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Software Use"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area that may require some attention, depending on your chosen career.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to learn about, adapt to and integrate new software into your work, are important skills to some extent, in all careers in the future of work.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("If you think this could be significant for your career, take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Software Development")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I can develop new digital systems to enhance work practices")}}</li>
      <li>{{__("I have the ability to read and understand computer code in digital systems")}}</li>
      <li>{{__("I have the ability to create and adapt computer code")}}</li>
      <li>{{__("I can create digital programmes to solve problems or automate tasks")}}</li>

    </ul>

    <div class="row align-items-center mb-4">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Software Development"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area that may require some attention, depending on your chosen career.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to develop digital systems, understand and develop computer code and create digital programmes to solve problems are valuable assets if you see digital skills as a core element of your chosen career.")}}</div>

        </div>

        <div class="mb-5">

          <div class="text-muted fs-1-rem">{{__("If you think this could be significant for your career, take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>







    <h5 class="fw-600 text-muted mb-2">{{__("Understanding Digital Systems")}}</h5>

    <h5 class="text-muted mb-3 fw-600">{{__("Low")}}</h5>

    <ul class="text-muted fs-1-rem mb-4">

      <li>{{__("I understand how to use Cybersecurity programmes")}}</li>
      <li>{{__("I understand how to streamline operations or systems using digital platforms or solutions (Tech Translation and Enablement) ")}}</li>
      <li>{{__("I understand Smart systems and how to use them")}}</li>
      <li>{{__("I understand how to use digital data to gain insights in my field of work")}}</li>

    </ul>

    <div class="row align-items-center mb-0">

      <div class="col-12 col-lg-4 mb-4 mb-lg-0">

        <twenty-first-century-horizontal-bar-chart class="mb-3" :data='@json($data)' domain="{{ $domain }}" value="Understanding Digital Systems"></twenty-first-century-horizontal-bar-chart>

      </div>

      <div class="col">

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("This is an area that may require some attention, depending on your chosen career.")}}</div>

        </div>

        <div class="mb-3">

          <div class="text-muted fs-1-rem">{{__("Being able to use, understand and develop digital systems, and use data to gain insights are valuable assets if you see digital skills as a core element of your chosen career.")}}</div>

        </div>

        <div class="mb-0">

          <div class="text-muted fs-1-rem">{{__("If you think this could be significant for your career, take every opportunity to develop these skills to enhance your prospects for the world of work in the future.")}}</div>

        </div>

      </div>

    </div>

  </div>

</div>
